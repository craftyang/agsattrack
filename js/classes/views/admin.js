var AGADMIN = function() {
    'use strict';

    var _render = false;
    var _editingRow = null;
    
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
            var ctrl = getBusyOverlay(document.documentElement, {color:'black', opacity:0.5, text: 'Updating Catalog Please Wait This Will Take A Few Minutes...'});
            jQuery.getJSON('/admin/UpdateCatalog', function(data) {
                ctrl.remove();    
            });
        }
    });

    jQuery(document).bind('agsattrack.adminchangeview', function(event, view) {
        jQuery('#admintabs').tabs('select', parseInt(view,10));
        if (parseInt(view,10) === 2) {
            jQuery('#admin-elements-add').enable();     
        }
    });         
         
         


    jQuery(document).bind('agsattrack.adminelementgroupedit', function(event, view) {
        var row = jQuery('#element-groups-grid').datagrid('getSelected');
        var rowIndex = jQuery('#element-groups-grid').datagrid('getRowIndex', row);
        jQuery('#element-groups-grid').datagrid('beginEdit', parseInt(rowIndex,10));
    });          
    jQuery(document).bind('agsattrack.adminelementgroupcancel', function(event, view) {
        var rowIndex = jQuery('#element-groups-grid').datagrid('getRowIndex', _editingRow);
        jQuery('#element-groups-grid').datagrid('cancelEdit', parseInt(rowIndex,10));
    });  
    jQuery(document).bind('agsattrack.adminelementgroupsave', function(event, view) {
        var rowIndex = jQuery('#element-groups-grid').datagrid('getRowIndex', _editingRow);
        jQuery('#element-groups-grid').datagrid('endEdit', parseInt(rowIndex,10));
        var rows = jQuery('#element-groups-grid').datagrid('getRows');
        jQuery.getJSON('/admin/UpdateGroup?group='+rows[rowIndex].id+'&name='+rows[rowIndex].name, function(data) {
         //   jQuery('#element-groups-grid').datagrid('reload');
        });        
    });  
    jQuery(document).bind('agsattrack.adminelementgroupdelete', function(event, view) {
        var row = jQuery('#element-groups-grid').datagrid('getSelected');
        var rowIndex = jQuery('#element-groups-grid').datagrid('getRowIndex', row);
        jQuery.messager.confirm('Confirm','Are you sure?',function(r){
            if (r){
                jQuery.getJSON('/admin/DeleteGroup?group='+row.id, function(data) {
                    jQuery('#element-groups-grid').datagrid('reload');
                });
            }
        });

    }); 
    jQuery(document).bind('agsattrack.adminelementgroupadd', function(event, view) {
        var row = jQuery('#element-groups-grid').datagrid('getSelected');
        if (row){
            var index = jQuery('#element-groups-grid').datagrid('getRowIndex', row);
        } else {
            index = 0;
        }
        jQuery('#element-groups-grid').datagrid('insertRow', {
            index: index,
            row:{
                id:''
            }
        });
        jQuery('#element-groups-grid').datagrid('selectRow',index);
        jQuery('#element-groups-grid').datagrid('beginEdit',index);
        
    }); 
                         
    function updateActions(index){
        jQuery('#element-groups-grid').datagrid('updateRow',{
            index: index,
            row:{}
        });
    }

            
    return {

        startRender : function() {
            _render = true;
            resize();
            jQuery('#body').layout('collapse','west'); 
        },

        stopRender : function() {
            _render = false;
        },

        resizeView : function(width, height) {
            resize(width, height);     
        },
            
        init : function() {
            jQuery('#catalog-grid').datagrid({  
                url:'/admin/GetCatalog',
                pagination: true,
                fit: true,
                pageSize: 20,
                columns:[[  
                    {field:'id',title:'ID',width:100},  
                    {field:'norad',title:'Norad Id',width:100},  
                    {field:'operationalstatus',title:'Status',width:100,align:'right'},  
                    {field:'name',title:'Name',width:100},  
                    {field:'owner',title:'Owner',width:100},  
                    {field:'launchdate',title:'Launch Date',width:100},  
                    {field:'site_id',title:'Launch Site',width:100},  
                    {field:'decaydate',title:'Decay Date',width:100},  
                    {field:'period',title:'Period',width:100},  
                    {field:'inclination',title:'Inclination',width:100},  
                    {field:'apogee',title:'Apogee',width:100},  
                    {field:'perigee',title:'Perigee',width:100},  
                    {field:'radarcrosssection',title:'Cross Section',width:100},  
                    {field:'status',title:'status',width:100}
                ]]  
            });
            
            jQuery('#element-groups-grid').datagrid({  
                url:'/admin/GetGroups',
                pagination: true,
                fit: true,
                pageSize: 20,
                singleSelect: true,
                columns:[[  
                    {field:'id',title:'ID',width:100,editor: {type: 'text', options: {required:true}}},  
                    {field:'name',title:'Name',width:250,editor: {type: 'text', options: {required:true}}}
                ]],
                onSelect : function(index) {
                    if (typeof this.editing === 'undefined' || !this.editing) {
                        jQuery('#admin-elements-edit').enable();      
                        jQuery('#admin-elements-delete').enable();
                    }
                },
                onBeforeEdit : function(index,row){
                    this.editing = true;
                    _editingRow = row;
                    jQuery('#admin-elements-edit').disable();      
                    jQuery('#admin-elements-add').disable();      
                    jQuery('#admin-elements-save').enable();      
                    jQuery('#admin-elements-cancel').enable(); 
                    row.editing = true;
                    updateActions(index);
                },
                onAfterEdit:function(index,row){
                    this.editing = false;
                    _editingRow = null;
                    jQuery('#admin-elements-edit').enable();      
                    jQuery('#admin-elements-save').disable();      
                    jQuery('#admin-elements-cancel').disable(); 
                    jQuery('#admin-elements-delete').enable();
                    jQuery('#admin-elements-add').enable();
                    row.editing = false;
                    updateActions(index);
                },
                onCancelEdit:function(index,row){
                    this.editing = false;
                    _editingRow = null;
                    jQuery('#admin-elements-edit').enable();      
                    jQuery('#admin-elements-save').disable();      
                    jQuery('#admin-elements-cancel').disable(); 
                    jQuery('#admin-elements-delete').enable();
                    jQuery('#admin-elements-add').enable();
                    row.editing = false;
                    updateActions(index);
                }
            });
                         
        }    
    };
};