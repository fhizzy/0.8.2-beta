<?php
/**
 *  Abstract class for documentation purposes
 *
 *  The descendants of the MetaDoc class provide ways to extract 
 *  documentation from the objects they represent. This information
 *  (along with HTML formatting) can is used for populating the 
 *  Support Documentation module.
 *
 *  PHP version 4
 *
 *
 *  LICENSE NOTE:
 *
 *  Copyright  2003-2007 Active Agenda Inc., All Rights Reserved.
 *
 *  Unless explicitly acquired and licensed from Licensor under a "commercial license",
 *  the contents of this file are subject to the Reciprocal Public License ("RPL")
 *  Version 1.4, or subsequent versions as allowed by the RPL,and You may not copy
 *  or use this file in either source code or executable form, except in compliance
 *  with the terms and conditions of the RPL. You may obtain a copy of the RPL from
 *  Active Agenda Inc. at http://www.activeagenda.net/license.
 *
 *  All software distributed under the Licenses is provided strictly on an "AS IS"
 *  basis, WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, AND ACTIVE AGENDA
 *  INC. HEREBY DISCLAIMS ALL SUCH WARRANTIES, INCLUDING WITHOUT LIMITATION, ANY 
 *  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT,
 *  OR NON-INFRINGEMENT. See the Licenses for specific language governing rights and
 *  limitations under the Licenses.
 *
 *
 * @author         Mattias Thorslund <mthorslund@activeagenda.net>
 * @copyright      2003-2007 Active Agenda Inc.
 * @license        http://www.activeagenda.net/license  RPL 1.4
 * @version        SVN: $Revision: 499 $
 * @last-modified  SVN: $Date: 2007-02-16 13:43:40 -0800 (Fri, 16 Feb 2007) $
 */

class MetaDoc {
    var $_contents = array();
    var $kind = 'unknown';
    
    function getContent(){
        $content = '';
        
        foreach ($this->_contents as $item){
            if(is_object($item)){
                $content .= $item->getContent();
            } else {
                $content .= $item;
            }
        }
        
        return $content;
    }

}


class ScreenDoc extends MetaDoc {
    function ScreenDoc($element, $moduleID){
    
        $this->kind = 'screen';
        
        $shortPhrase = ShortPhrase($element->attributes['phrase']);
        $longPhrase = LongPhrase($element->attributes['phrase']);
        
        $html = '';
        $html .= "<h2>$shortPhrase Screen</h2>";
        if($longPhrase != $shortPhrase){
            $html .= "<i>$longPhrase</i>";
        }

        $this->_contents[] = $html;
        
        $currentKind = '';
        
        foreach($element->c as $sub_element){
            if('RecordSummaryFieldsRef' != $sub_element->type){
        
                $subDoc = $sub_element->createDoc($moduleID);
                
                if($currentKind != $subDoc->kind){
                    //check if   we're switching from screen fields to grid, etc -- add table/titles accordingly
                    switch($subDoc->kind){
                    case 'screenfield':
                        $this->_contents[] = "<h3>Fields:</h3>";
                        $this->_contents[] = "<table><tr>";
                        $this->_contents[] = "<th>Title</th>";
                        $this->_contents[] = "<th>Type</th>";
                        $this->_contents[] = "<th>Attributes</th>";
                        $this->_contents[] = "</tr>";
                        break;
                    case 'grid':
                    
                        $this->_contents[] = "</table>";
                    break;
                    case 'customcode':
                        $this->_contents[] = "\n";
                        
                        break;
                    default:
                        print_r($subDoc);
                        die("{$subDoc->kind} unknown kind of documentation object");
                    }
                    
                    
                    $currentKind = $subDoc->kind;
                } 
            
                $this->_contents[] = $subDoc;
                
            }
        }
        
        $this->_contents[] = "</table>\n";
    }
}


class GridDoc extends MetaDoc {
    function GridDoc($element, $moduleID){
        $this->kind = 'grid';
        
        $subModuleID = $element->attributes['moduleID'];        
       // print "generating documentation for {$subModuleID} grid\n";


        if(count($element->c) == 0){
        
            $subModule = GetModule($subModuleID);

            $exports_element = $subModule->_map->selectFirstElement('Exports');
            if(empty($exports_element)){
                die("Can't find an Exports section in the $subModuleID module.");
            }
            
            $grid_element = $exports_element->selectFirstElement($element->type);
            if(empty($grid_element)){
                die("Can't find a matching edit grid in the $subModuleID module.");
            }
            
            //copy all the fields of the imported grid to the current element
            $element->c = $grid_element->c;
            
            //copy attributes but allow existing attributes to override
            foreach($grid_element->attributes as $attrName => $attrValue){
                if(empty($element->attributes[$attrName])){
                    $element->attributes[$attrName] = $attrValue;
                }
            }
        }

        
        $shortPhrase = ShortPhrase($element->attributes['phrase']);
        $longPhrase = LongPhrase($element->attributes['phrase']);
        
        $html = '';
        $html .= "<h2>$shortPhrase grid</h2>";
        $html .= "<i>$longPhrase</i>";
        
        $this->_contents[] = "<h3>$shortPhrase Grid</h3>";
        if($longPhrase != $shortPhrase){
            $this->_contents[] = "<i>$longPhrase</i>";
        }
        $this->_contents[] = "<table><tr>";
        $this->_contents[] = "<th>Title</th>";
        $this->_contents[] = "<th>Type</th>";
        $this->_contents[] = "<th>Attributes</th>";
        $this->_contents[] = "</tr>";
        
//        print_r($element);
//die('grid fields above');
        
        
        //check for a grid form...if exists, then use it, else use regular fields
        $form_element = $element->selectFirstElement('GridForm');
        if(empty($form_element)){
            $form_element =& $element;
        }
        
        foreach($form_element->c as $sub_element){
            switch($sub_element->type){
            case 'OrderByField':
            case 'VerticalFormat':
            case 'SearchForm':
            case 'Conditions':
            case 'AvailbleListConditions':
                continue 2;
                break;
            default:
                break;
            }
            $subDoc = $sub_element->createDoc($subModuleID);
            $this->_contents[] = $subDoc;
        }
        
        $this->_contents[] = "</table>\n";
    }
}

class ScreenFieldDoc extends MetaDoc {
    function ScreenFieldDoc($element, $moduleID){
        $this->kind = 'screenfield';
        
//print "ScreenFieldDoc for {$element->type} {$moduleID}.{$element->name}\n";
        
        //have to exclude CheckBoxFields named "Checked": they don't have a corresponding ModuleField...
        if(!('Checked' == $element->name) && ('CheckBoxField' != $element->type)){
            $moduleField = GetModuleField($moduleID, $element->name);
            $shortPhrase = ShortPhrase($moduleField->phrase);
            $longPhrase = LongPhrase($moduleField->phrase);
            
            $attributes = '';
            foreach($element->attributes as $aName => $aValue){
                $attributes .= "$aName: $aValue\n";
            }
            
            $this->_contents[] = "<tr>";
            $this->_contents[] = "<td class=\"name\">$shortPhrase</td>";
            $this->_contents[] = "<td>{$element->type}</td>";
            $this->_contents[] = "<td>$attributes</td>";
            $this->_contents[] = "</tr>";
            $this->_contents[] = "<tr><td colspan=\"3\"><i>$longPhrase</i></td></tr>";
            $this->_contents[] = "<tr><td class=\"blank\" colspan=\"3\">&nbsp;</td></tr>";
        }
    }
}

class CustomCodeDoc extends MetaDoc {
    function CustomCodeDoc($element, $moduleID){
        $this->kind = 'customcode';
        
        //$this->_contents[] = "\n";
        $this->_contents[] = "<b>Custom code: {$element->attributes['location']}</b>";
        $this->_contents[] = "<pre>";
        
        foreach($element->c as $sub_element){
            $this->_contents[] = $sub_element->getContent();
        }
        $this->_contents[] = "</pre>";
        //$this->_contents[] = "\n";
        
        
    }
}

?>