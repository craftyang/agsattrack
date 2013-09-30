var AGOPTIONSEDITOR = function() {
    'use strict';
    
    function init3DOptions() {
        var _threeDOptions = AGSETTINGS.getViewSettings('threed');    
    
        jQuery('#options-3d-view option[value="' + _threeDOptions.view + '"]').attr('selected', true);
        jQuery('#options-3d-provider option[value="' + _threeDOptions.provider + '"]').attr('selected', true);
        jQuery('#options-3d-provider').on('change', function() {
            var value = jQuery('#options-3d-provider').find(":selected").val();
            if (value === 'staticimage') {
                jQuery('#3d-options-static-map-fieldset').removeProp("disabled");
            } else {
                jQuery('#3d-options-static-map-fieldset').prop("disabled", "disabled");;
            }
        }).trigger('change');
                
        if (_threeDOptions.useTerrainProvider) {
            jQuery('#options-3d-terrainprovider').prop('checked', true);
        } else {
            jQuery('#options-3d-terrainprovider').prop('checked', false);
        }

        jQuery('#options-3d-view-staticimage option[value="' + _threeDOptions.staticimage + '"]').attr('selected', true);
        jQuery('#options-3d-view-staticimage').on('change', function() {
            var image = jQuery('#options-3d-view-staticimage').find(":selected").val();
            jQuery('#options-3d-view-staticimage-image').attr('src','images/maps/' + image);
        }).trigger('change');
        
        jQuery('#options-3d-sat-icon-unselected').ddslick();
        jQuery('#options-3d-sat-icon-selected').ddslick();
        
        jQuery('#options-3d-sat-icon-unselected').ddslick('select', {index: _threeDOptions.unselectedIcon});
        jQuery('#options-3d-sat-icon-selected').ddslick('select', {index: _threeDOptions.selectedIcon});
         
        jQuery('#options-3d-sat-icon-unselected-size option[value="' + _threeDOptions.unselectedIconSize + '"]').attr('selected', true);
        jQuery('#options-3d-sat-icon-selected-size option[value="' + _threeDOptions.selectedIconSize + '"]').attr('selected', true);
    
        jQuery('#options-3d-sat-label-unselected-size option[value="' + _threeDOptions.unselectedLabelSize + '"]').attr('selected', true);
        jQuery('#options-3d-sat-label-selected-size option[value="' + _threeDOptions.selectedLabelSize + '"]').attr('selected', true);    
        
        jQuery('#options-3d-view-followobs-height').val(_threeDOptions.followobsheight);
        jQuery('#options-3d-view-followsat-height').val(_threeDOptions.followsatheight);
        
        jQuery('#options-3d-view-show-cities').prop('checked', _threeDOptions.showCities);
        jQuery('#options-3d-view-show-cities').on('change', function(){
            if (jQuery('#options-3d-view-show-cities').prop('checked')) {
                jQuery('#options-3d-view-city-pop-limit').enable();
                jQuery('#options-3d-view-city-font-size').enable();
                jQuery('#options-3d-view-city-font-colour').enable();            
            } else {
                jQuery('#options-3d-view-city-pop-limit').disable();
                jQuery('#options-3d-view-city-font-size').disable();
                jQuery('#options-3d-view-city-font-colour').disable();                  
            }    
        }).trigger('change');
        
        jQuery('#options-3d-view-city-pop-limit').val(_threeDOptions.cityPopulation);
        jQuery('#options-3d-view-city-font-size').val(_threeDOptions.cityFontSize);
        jQuery('#options-3d-view-city-font-colour').val(_threeDOptions.cityLabelColour);
                
        jscolor.init();              
    }
    
    function save3DOptions() {
        var _threeDOptions = AGSETTINGS.getViewSettings('threed');         
        
        _threeDOptions.staticimage = jQuery('#options-3d-view-staticimage').find(":selected").val();
  
        
        var ddData = $('#options-3d-sat-icon-unselected').data('ddslick');
        _threeDOptions.unselectedIcon = ddData.selectedIndex;
        var ddData = $('#options-3d-sat-icon-selected').data('ddslick');
        _threeDOptions.selectedIcon = ddData.selectedIndex;
        _threeDOptions.unselectedIconSize = jQuery('#options-3d-sat-icon-unselected-size').find(":selected").val();
        _threeDOptions.selectedIconSize = jQuery('#options-3d-sat-icon-selected-size').find(":selected").val();
        _threeDOptions.unselectedLabelSize = jQuery('#options-3d-sat-label-unselected-size').find(":selected").val();
        _threeDOptions.selectedLabelSize = jQuery('#options-3d-sat-label-selected-size').find(":selected").val();
        _threeDOptions.unselectedLabelColour = jQuery('#3d-label-colour-unselected')[0].color.toString();     
        _threeDOptions.selectedLabelColour = jQuery('#3d-label-colour-selected')[0].color.toString();     
        _threeDOptions.view = jQuery('#options-3d-view').find(":selected").val();
        _threeDOptions.provider = jQuery('#options-3d-provider').find(":selected").val();
        
        _threeDOptions.useTerrainProvider = jQuery('#options-3d-terrainprovider').prop('checked');                
        _threeDOptions.showCities = jQuery('#options-3d-view-show-cities').prop('checked');
        _threeDOptions.cityLabelColour = jQuery('#options-3d-view-city-font-colour')[0].color.toString();     
        _threeDOptions.cityFontSize = jQuery('#options-3d-view-city-font-size').val();
        _threeDOptions.cityPopulation = jQuery('#options-3d-view-city-pop-limit').val();
        
        AGSETTINGS.setViewSettings('threed', _threeDOptions);        
    }
    
    function initPolarOptions() {
        var _polarPreview = null;

        var polarOptions = AGSETTINGS.getViewSettings('polar'); 
        
        jQuery('#polar-background-color').val(polarOptions.colours.background);
        jQuery('#polar-border-color').val(polarOptions.colours.border);
        jQuery('#polar-gradient-start').val(polarOptions.colours.gradientstart);
        jQuery('#polar-gradient-end').val(polarOptions.colours.gradientend);
        jQuery('#polar-grid').val(polarOptions.colours.grid);
        jQuery('#polar-text').val(polarOptions.colours.text);
        jQuery('#polar-degrees-text').val(polarOptions.colours.degcolour);
                
        if (_polarPreview === null) {
            _polarPreview = AGVIEWS.getNewView('polar','polar-preview');
            _polarPreview.init(AGVIEWS.modes.PREVIEW);
            _polarPreview.startRender();

        }
        
        jQuery('.polarcolour').on('change', function(e){
            var colours = {
                background: jQuery('#polar-background-color')[0].color.toString(),
                border: jQuery('#polar-border-color')[0].color.toString(),
                grid: jQuery('#polar-grid')[0].color.toString(),
                text: jQuery('#polar-text')[0].color.toString(),
                degcolour: jQuery('#polar-degrees-text')[0].color.toString(),
                gradientstart: jQuery('#polar-gradient-start')[0].color.toString(),
                gradientend: jQuery('#polar-gradient-end')[0].color.toString()
            }
            _polarPreview.setPreviewColours(colours);                
        }); 
        
        jQuery('#polar-reset-colours').on('click', function(e){
            jQuery('#polar-background-color').val(polarOptions.defaultColours.background);
            jQuery('#polar-border-color').val(polarOptions.defaultColours.border);
            jQuery('#polar-gradient-start').val(polarOptions.defaultColours.gradientstart);
            jQuery('#polar-gradient-end').val(polarOptions.defaultColours.gradientend);
            jQuery('#polar-grid').val(polarOptions.defaultColours.grid);
            jQuery('#polar-text').val(polarOptions.defaultColours.text);
            jQuery('#polar-degrees-text').val(polarOptions.defaultColours.degcolour);
            _polarPreview.setPreviewColours(polarOptions.defaultColours);           
        });
                   
        jscolor.init();                  
    }
    
    function initPassesOptions() {
        var passesOptions = AGSETTINGS.getViewSettings('passes'); 
                
        jQuery('#options-passes-view-bottomleft option[value="' + passesOptions.bottomleft + '"]').attr('selected', true);
        jQuery('#options-passes-view-bottomright option[value="' + passesOptions.bottomright + '"]').attr('selected', true);    
    }
    
    return {
        
        init3DOptions : function() {
            init3DOptions();    
        },
        
        save3DOptions : function() {
            save3DOptions();    
        },
                
        initPolarOptions : function() {
            initPolarOptions();    
        },
        
        initPassesOptions : function() {
            initPassesOptions();    
        }
        
    };
    
};