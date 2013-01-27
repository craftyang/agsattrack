var AGMYACCOUNT = function() {
    'use strict';

    var _render = false;

    function resize(width, height) {
        if (typeof width === 'undefined' || typeof height === 'undefined') {
            var parent = jQuery('#myaccount');
            width = parent.width();
            height = parent.height();
        }
        
        if (width !== 0 && height !== 0) {

        }          
    }
        
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