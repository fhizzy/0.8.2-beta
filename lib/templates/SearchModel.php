<?php
/**
 *  Template file for generated files (alt. a generated file)
 *
 *  PHP version 4
 *
 *
 * LICENSE NOTE:
 *
 * Copyright  2003-2007 Active Agenda Inc., All Rights Reserved.
 *
 * Unless explicitly acquired and licensed from Licensor under a "commercial license",
 * the contents of this file are subject to the Reciprocal Public License ("RPL")
 * Version 1.4, or subsequent versions as allowed by the RPL,and You may not copy
 * or use this file in either source code or executable form, except in compliance
 * with the terms and conditions of the RPL. You may obtain a copy of the RPL from
 * Active Agenda Inc. at http://www.activeagenda.net/license.
 *
 * All software distributed under the Licenses is provided strictly on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, AND ACTIVE AGENDA
 * INC. HEREBY DISCLAIMS ALL SUCH WARRANTIES, INCLUDING WITHOUT LIMITATION, ANY 
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT,
 * OR NON-INFRINGEMENT. See the Licenses for specific language governing rights and
 * limitations under the Licenses.
 *
 *
 * @author         Mattias Thorslund <mthorslund@activeagenda.net>
 * @copyright      2003-2007 Active Agenda Inc.
 * @license        http://www.activeagenda.net/license  RPL 1.4
 * @version        SVN: $Revision: 499 $
 * @last-modified  SVN: $Date: 2007-02-16 13:43:40 -0800 (Fri, 16 Feb 2007) $
 */


    //list of objects containing the field information
    /**fields**/

    /**ownerField**/
    
    //phrases for field names, in field order (note: phrases are used in search filter)
    /**phrases**/

    $tabsQSargs = $qsArgs;
    unset($tabsQSargs['scr']);
    unset($tabsQSargs['gid']);
    unset($tabsQSargs['grw']);
    $tabsQS = MakeQS($tabsQSargs);


    $pageTitle = gettext("/**module_name**/");
    $screenPhrase = gettext("/**screen_phrase**/");
    global $SQLBaseModuleID;
    $SQLBaseModuleID = $ModuleID;

    $search = $_SESSION['Search_'.$ModuleID];
    
    if(empty($_POST['Search']) && empty($_POST['Chart'])){
        $values = $search->searchValues;
    } else {
        $values = $_POST;
    }
    
    //populate data array with posted values
    foreach($fields as $fieldName=>$value){
        $data[$fieldName] = $values[$fieldName];
    }



    //if the form was posted
    if((!empty($_POST['Search'])) || (!empty($_POST['Chart']))){


        //List fields (used for generating the complete SQL search statement):
        /**list_fields**/


        //link fields (fields that provide a URL, and not necessarily displayed
        //as a separate column in the list screen
        /**linkFields**/


        //create a Search definition object
        $search = new Search(
            $ModuleID,
            $listFields,
            $fields,
            $_POST
        );


        //then post it to the Search session object.
        $_SESSION['Search_'.$ModuleID] = $search;


        //redirect depending on what submit buton was pressed by the user.
        if(!empty($_POST['Search'])){

            $RedirectTo = "list.php?mdl=$ModuleID";
            header("Location:" . $RedirectTo);
            exit;
            

        } else {

            //handle "Chart" (TO DO)
            $RedirectTo = "charts.php?mdl=$ModuleID";
            header("Location:" . $RedirectTo);
            exit;

        }

    }

    //moved down from above
    $qs = MakeQS($qsArgs);

    //links for rendering the form
    $targetlink = "search.php?$qs";
    $cancellink = "list.php?$qs";

    $tabs['List'] = Array("list.php?$qs", gettext("List|View the list of /**plural_record_name**/"));
    $tabs['Search'] = Array("", gettext("Search"));
    $tabs['Charts'] = Array("charts.php?$tabsQS", gettext("Charts|View charts"));



    ob_start();
    $content = '';
    foreach($fields as $key => $field){
        if (!$field->isSubField()){
            $content .= $field->searchRender(&$data, &$phrases);
        }
    }
    ob_end_clean();
    
    $content = renderSearchForm($content, $targetlink, $chartLink, $ModuleID);

    //insert code to enable calendar controls
    /**dateFields**/
    
   // $content .= debug_r($search->searchValues, "searchValues");

?>
