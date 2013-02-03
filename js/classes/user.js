/*
Copyright 2013 Alex Greenland

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */
 
var AGUSER = function() {
    var _loggedIn = AGISLOGGEDIN;
    var _admin = AGISADMIN;
    
   
    jQuery(document).bind('agsattrack.login', function(event, selection) {
        jQuery('#loginbox').load('/site/login', function(){
            jQuery('#dialog-login').dialog('open');    
        });      
    });

    jQuery(document).bind('agsattrack.register', function(event, selection) {
        jQuery('#loginbox').load('/site/register', function(){
            jQuery('#dialog-register').dialog('open');    
        });      
    });
        
    jQuery(document).bind('agsattrack.logout', function(event, selection) {
        jQuery.getJSON('/site/logout', function(data) {
            _loggedIn = false;
            updateRibbon();            
        });         
    });
        
    function updateRibbon() {
        switch (_loggedIn) {
            case true:
                jQuery('#user-login').hide();
                jQuery('#user-logout').show();
                jQuery('#user-register').hide();
                jQuery('#user-myaccount').show();
                jQuery('#ribbon-tab-header-9').show();
                if (_admin) {
                    jQuery('#ribbon-tab-header-10').show();
                } else {
                    jQuery('#ribbon-tab-header-10').hide();
                }
                break;
                
            case false:
                jQuery('#user-login').show();
                jQuery('#user-logout').hide();            
                jQuery('#user-register').show();
                jQuery('#user-myaccount').hide();
                jQuery('#ribbon-tab-header-9').hide();
                jQuery('#ribbon-tab-header-10').hide();
                break;
        }    
    }
    
    updateRibbon();
     
    return {
    
        
    };
    
};