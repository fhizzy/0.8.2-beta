<?php
/**
 *  XML map class for the Data View definitions
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

include_once CLASSES_PATH . '/module_map.class.php';

/**
 * XML Map class specific to parsing DataView files
 */
class DataViewMap extends XMLMap {
var $moduleID;
var $name;
var $rootElement = 'DataView';

/**
 * Constructor
 */
function DataViewMap($fileName)
{
    $this->XMLFileName = $fileName;
    $this->parseXMLFile();

    $fileNameParts = explode('_', basename($fileName));
    $this->moduleID = $fileNameParts[0];
    $this->name = $fileNameParts[1];
}

function &generateDataView(){
    $element = $this;//$this->selectFirstElement($this->rootElement);
    return $element->createObject($this->moduleID);
}

} //end class DataViewMap
?>