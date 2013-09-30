var AGOPTIONSWINDOW = function(element, params) {

    var _element = element;
    var _bodyElement;
    var _view = null;
    var _currentOptions = null;
    var _optionsWindows = {
        '3d' : {
            'name' : '3d',
            'template' : '/templates/3d-options.html',
            'title' :  '&nbsp;&nbsp;3D View Options',
            'classInfo' : {
                'classname' : 'AGOPTIONSEDITOR',
                'init' : 'init3DOptions',
                'save' : 'save3DOptions'
            }
        },
        'polar' : {
            'name' : 'polar',
            'template' : '/templates/polar-options.html',
            'title' :  '&nbsp;&nbsp;Polar View Options',
            'classInfo' : {
                'classname' : 'AGOPTIONSEDITOR',
                'init' : 'initPolarOptions',
                'save' : ''    
            }
        },
        'passes' : {
            'name' : 'passes',
            'template' : '/templates/passes-options.html',
            'title' :  '&nbsp;&nbsp;Passes View Options',
            'classInfo' : {
                'classname' : 'AGOPTIONSEDITOR',
                'init' : 'initPassesOptions',
                'save' : ''    
            }
        }         
    };

    jQuery(_element).window({  
        width:800,  
        height:600,
        title: '&nbsp;',
        iconCls: 'options-icon',  
        modal:false,
        minimizable: false,
        maximizable : false  
    });
                
    function setupOptionsWindow(params) {
        if (_currentOptions === null || params.type !== _currentOptions.name) {

            _currentOptions = _optionsWindows[params.type];
            _currentOptions.classInfo.classInstance = new window[_currentOptions.classInfo.classname];            

            jQuery(_element).window('setTitle', _currentOptions.title);                 
            _bodyElement = jQuery(_element).window('body')[0].id;
            jQuery('#'+_bodyElement).load(_currentOptions.template, function(){
                _currentOptions.classInfo.classInstance[_currentOptions.classInfo.init]();    
                jQuery.parser.parse('#'+_bodyElement);        

                jQuery('.options-save').on('click', function(){
                    _currentOptions.classInfo.classInstance[_currentOptions.classInfo.save]();
                    AGSETTINGS.saveSettings();
                    jQuery(_element).window('close');              
                });
                jQuery('.options-cancel').on('click', function(){
                    jQuery(_element).window('close');    
                });            
            });
        } else {
            _currentOptions.classInfo.classInstance[_currentOptions.classInfo.init]();    
        }

       
    }
    
    setupOptionsWindow(params);
    
    return {
        init : function(params) {
            setupOptionsWindow(params);
            jQuery(_element).window('open');    
        }    
    };
};