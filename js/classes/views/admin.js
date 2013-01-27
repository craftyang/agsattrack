var AGADMIN = function() {
    'use strict';

    var _render = false;

    function resize(width, height) {
        if (typeof width === 'undefined' || typeof height === 'undefined') {
            var parent = jQuery('#admin');
            width = parent.width();
            height = parent.height();
        }
        
        if (width !== 0 && height !== 0) {

        }          
    }
     
    jQuery(document).bind('agsattrack.adminupdatecatalog', function(event) {
        if (_render) {
            var ctrl = getBusyOverlay(document.documentElement, {color:'black', opacity:0.5, text: 'Updating Catalog Please Wait ...'});
            jQuery.getJSON('/admin/UpdateCatalog', function(data) {
                ctrl.remove();    
            });
        }
    });
            
    return {

        startRender : function() {
            _render = true;
            resize();
        },

        stopRender : function() {
            _render = false;
        },

        resizeView : function(width, height) {
            resize(width, height);     
        },
            
        init : function() {
            
        }    
    };
};