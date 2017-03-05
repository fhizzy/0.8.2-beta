/**
 * Tab effects JS functions for s2a/Active Agenda
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

function attachTabEffects()
{
    var rootdiv = document.getElementById('tabcontainer');
    if(rootdiv){ //popup screen may have no tabs
        var tabs = rootdiv.getElementsByTagName('DIV');
        for(tabID in tabs){
            if(tabs[tabID].className != 'tabsel' && tabs[tabID].className != 'tabb'){
                tabs[tabID].onmouseover=tabover;
                tabs[tabID].onmouseout=tabout;
            }
        }
    }
}
function tabover(){
    this.origClass = this.className;
    this.className = this.className+'hi';
}
function tabout(){
    if(this.origClass){
        this.className = this.origClass;
    }
}

function sbMsg (msg){
    if (msg != ''){
        window.status = msg;
    } else {
        window.status = defaultMessage;
    }
    return true;
}

function setupTabTooltips(){
    contextElements = YAHOO.util.Dom.getElementsByClassName('tabb', 'a', 'tabcontainer');
    YAHOO.activeagenda.tabtooltip = new YAHOO.widget.Tooltip("tt", { context:contextElements, width:220 } );
}

function setupFormTooltips(containerID){
    contextElements = YAHOO.util.Dom.getElementsByClassName('flbl', 'td', 'content');
    YAHOO.activeagenda.formtooltip = new YAHOO.widget.Tooltip("ttf", { context:contextElements, width:320 } );
}