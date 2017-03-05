<?php
/**
 * Provides the Notification List screen
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
 * author         Mattias Thorslund <mthorslund@activeagenda.net>
 * copyright      2003-2007 Active Agenda Inc.
 * license        http://www.activeagenda.net/license
 **/

//general settings
require_once '../config.php';
set_include_path(PEAR_PATH . PATH_SEPARATOR . get_include_path());

//classes
require_once CLASSES_PATH . '/grids.php';
require_once CLASSES_PATH . '/modulefields.php';

//startup
require_once INCLUDE_PATH . '/page_startup.php';
include_once $theme .'/component_html.php';


$messages = array(); 
$GlobalModuleID = 'modnr'; 

$tabsQSargs = $qsArgs;
unset($tabsQSargs['scr']);
unset($tabsQSargs['gid']);
unset($tabsQSargs['grw']);
$tabsQS = MakeQS($tabsQSargs);

//generic tabs
$tabs = array();
$tabs['List'] = Array("list.php?$tabsQS", gettext("List|View the list"));
$tabs['Search'] = Array("search.php?$tabsQS", gettext("Search|Go to the search screen"));
$tabs['Charts'] = Array("charts.php?$tabsQS", gettext("Charts|View charts"));

//sets $editGrid, $gridPluralName:
$grid_filename = GENERATED_PATH . '/modnr/modnr_GlobalEditGrid.gen';


//check for cached pages
if (!file_exists($grid_filename)){
    trigger_error("Could not find grid file '$grid_filename'.", E_USER_ERROR);
}


//sets $editGrid, $gridPluralName
include $grid_filename;

//insert dynamic data
$replFields = array('/**DynamicModuleID**/');
$replValues = array($ModuleID);

$editGrid->insertSQL    = str_replace($replFields, $replValues, $editGrid->insertSQL);
$editGrid->updateSQL    = str_replace($replFields, $replValues, $editGrid->updateSQL);
$editGrid->deleteSQL    = str_replace($replFields, $replValues, $editGrid->deleteSQL);
$editGrid->logSQL       = str_replace($replFields, $replValues, $editGrid->logSQL);
$editGrid->ParentRowSQL = str_replace($replFields, $replValues, $editGrid->ParentRowSQL);

//handle grid form
$editGrid->handleForm();

//display edit grid
$content .= $editGrid->render('notificationSetup.php', $qsArgs);

$jsIncludes = '<script type="text/javascript" src="3rdparty/calendar.js"></script>'."\n";
$LangPrefix = substr($User->Lang, 0, 2);
$jsIncludes .= '<script type="text/javascript" src="3rdparty/lang/calendar-'.$LangPrefix.'.js"></script>'."\n";
$jsIncludes .= '<script type="text/javascript" src="3rdparty/calendar-setup.js"></script>'."\n";


//$jsIncludes
$moduleInfo = GetModuleInfo($ModuleID);
$title = $moduleInfo->getProperty('moduleName');
$globalDiscussions = DISCUSSION_LINK_GLOBAL . $moduleInfo->getProperty('globalDiscussionAddress');
$localDiscussions = DISCUSSION_LINK_LOCAL . $moduleInfo->getProperty('localDiscussionAddress');

$subtitle = '';//sprintf(gettext("Manage %s for this %s:"), $gridPluralName, $singularRecordName);
//$user_info
$screenPhrase = ShortPhrase($screenPhrase);
//$messages  //any error messages, acknowledgements etc.
$content .= '<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
//$globalDiscussions
//$localDiscussions

include_once $theme . '/search.template.php';
?>