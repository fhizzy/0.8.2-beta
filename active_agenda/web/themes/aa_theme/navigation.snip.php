<?php
/**
 * HTML/PHP layout template for the Navigation frame
 *
 * NOTE that this template is different in that it only customizes the <BODY> part 
 * of the document (excluding the BODY tag itself. <HEADER> is declared in 
 * web/navigation.php
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

if(!defined('EXEC_STATE') || EXEC_STATE != 1){
    print gettext("This file should not be accessed directly.");
    trigger_error("This file should not be accessed directly.", E_USER_ERROR);
    exit;
}
?>

<table id="nav_table" cellspacing="0">
<tr>

<td id="nav_menu">
    <img src="<?php echo $theme_web; ?>/img/nav_starthere.gif"><br />
    Main Menu
</td>

<td class="navicon">
    <a href="#" onclick="parent.frames[1].location = 'home.php'" title="Home - Dashboard">
        <img src="<?php echo $theme_web; ?>/img/nav_dashboard.gif"><br />
        Dashboard
    </a>
</td>

<td id="nav_sitename">
    <h1><?=SITE_NAME ?></h1>
    <?php echo $user_info;?>
</td>

<td class="navicon" id="nav_guide">
    <a href="quickstart_guide.pdf" target="_blank" title="Quick Start Guide">
        <img src="<?php echo $theme_web; ?>/img/nav_quick_guide.gif"><br />
        Quick Guide
    </a>
</td>

<td class="navicon">
    <a href="mailto:inquiries@activeagenda.net" title="Email Us!">
        <img src="<?php echo $theme_web; ?>/img/nav_email.gif"><br />
        Email Us!
    </a>
</td>

<td class="navicon">
    <a href="http://www.activeagenda.net/discussions/" target="_blank" title="Dicusssion Forums">
        <img src="<?php echo $theme_web; ?>/img/nav_discussions.gif"><br />
        Forums
    </a>
</td>

<td class="navicon" id="nav_bugreport">
    <a href="http://bugs.activeagenda.net/" target="_blank" title="File a Bug Report or Feature Request">
        <img src="<?php echo $theme_web; ?>/img/nav_bugreport.gif"><br />
        Report Bug
    </a>
</td>

<td class="navicon">
    <a href="#" title="Look up a term in the Glossary" onclick="open('glossary.php', 'glossary', 'toolbar=0,scrollbars=1,width=600,height=600');">
        <img src="<?php echo $theme_web; ?>/img/nav_glossary.gif"><br />
        Glossary
    </a>
</td>

<td class="navicon">
    <a href="#" onclick="parent.frames[1].location.reload()">
        <img src="<?php echo $theme_web; ?>/img/nav_reload_page.gif" title="Reload the page below"><br />
        Reload
    </a>
</td>

<td class="navicon">
    <a href="logout.php">
        <img src="<?php echo $theme_web; ?>/img/nav_exit.gif" title="Log out"><br />
        Log Out
    </a>
</td>
</tr>
</table>