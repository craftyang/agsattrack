    <div id="help-window" class="easyui-window" data-options="title:'Help',closed:true, resizable:false, minimizable:false,maximizable:false, collapsible: false" style="width:900px;height:600px;padding:0px">
        <div class="easyui-layout" data-options="fit:true">
            <div data-options="region:'center',border:false" style="background:#fff;border:1px solid #ccc;">
                <div class="easyui-layout" data-options="fit:true">
                    <div data-options="region:'west',split:true,title:'Topics'" style="width:200px;overflow:auto">
                        <ul id="help-tree" class="easyui-tree">  
                            <li>  
                                <span>Help Topics</span>  
                                <ul>  
                                    <li>  
                                        <span>Introduction</span>  
                                        <ul>  
                                            <li>  
                                                <span><a href="help/whatis.html" class="tree-help-item">What is AgSatTrack</a></span>  
                                            </li>   
                                        </ul>                  
                                    </li>
                                    <li>  
                                        <span>How To</span>  
                                        <ul>  
                                            <li>  
                                                <span><a href="help/loadgroups.html" class="tree-help-item">Load Groups</a></span>  
                                            </li>  
                                        </ul>                  
                                    </li>                
                                </ul>  
                            </li>  
                        </ul>                    
                    </div>
                    <div data-options="region:'center',title:'Help'">
                        <div id="help-content" style="padding:2px">
                        </div>
                    </div>
                </div>
            </div>
            <div data-options="region:'south',border:false" style="text-align:right;padding:5px 0;">
                <a class="easyui-linkbutton" href="javascript:void(0)" onclick="jQuery('#help-window').window('close');">Ok</a>
            </div>
        </div>
    </div>