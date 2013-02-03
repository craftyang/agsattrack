            <div title="Settings" width=1000 height=600 id="options">
                <div id="window-preferences-tabs" class="easyui-tabs" data-options="fit:true">
                    <div title="General" data-options="" style="padding: 20px;">
                        <div class="icon32" id="icon-options-general"><br></div>
                        <h2>General Options</h2>

                        <h3>Views</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Switch to view on tab select</th>
                                <td>
                                    <input type="checkbox" id="switchtabonclick" value="on">
                                    <p class="description">Enabling this option will cause the current view to be switched when you click on the views in the ribbon bar.</p>
                                </td>
                            </tr>                          
                        </table>
                                                
                        <h3>Popup Help</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Show Popup Help</th>
                                <td>
                                    <input type="checkbox" id="popuphelp-show" value="on">
                                    <p class="description"><strong>NOTE:</strong> You will need to refresh the page to enable the popup help after enabling this option.</p>
                                </td>
                            </tr>                          
                        </table>
                        
                        <h3>Debugging</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Enable Debug View</th>
                                <td>
                                    <input type="checkbox" id="debugger-show" value="on" class="options-cb">
                                    <p class="description"><strong>NOTE:</strong> You will need to refresh the page to enable the debugger after enabling this option.</p>
                                </td>
                            </tr>                          
                        </table>
                                                
                    </div>
                    
                    <div title="Observer" data-options="" style="padding: 20px;">
                    
                    
                        <div class="icon32" id="icon-options-general"><br></div>
                        <h2>Observer Options</h2>
                        
                        <h3>Home Location</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Use Browser To Find Location</th>
                                <td>
                                    <input type="checkbox" id="observergelocate" value="on">
                                    <p class="description">Selecting this option will attempt to use the browsers inbuilt Geo Location. If you do not select this option you can manually specify your location below.</p>
                                </td>
                            </tr>                          
                            <tr valign="top">
                                <th>Location name</th>
                                <td>
                                    <input size=15 id="observername" class="observerhome">
                                    <button type="submit" id="geoshow"><img src="/images/geo.png" width=16> Select On Map</button>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>Location Latitude</th>
                                <td>
                                    <input size=20 id="observerlatitude" class="observerhome">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>Location Longitude</th>
                                <td>
                                    <input size=20 id="observerlongitude" class="observerhome">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>Location Altitude</th>
                                <td>
                                    <input size=10 id="observeraltitude" class="observerhome">
                                </td>
                            </tr>                                                       
                        </table>                      
                    </div>
                    <div title="Satellites" data-options="" style="padding: 20px;">
                        <div class="icon32" id="icon-options-general"><br></div>
                        <h2>Satellite Options</h2>
                        
                        <h3>Position Calculations</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Calculate Every (Seconds)</th>
                                <td>
                                    <input id="window-preferences-calc-timer" class="easyui-numberspinner" style="width: 60px;" required="required" data-options="min:1,max:50,editable:false">
                                    <p class="description">If you have a slower PC then try increasing this value to improve performance.</p>
                                    </td>
                            </tr>
                            <tr valign="top">
                                <th>AoS When Above (In Degrees)</th>
                                <td>
                                    <input id="window-preferences-aos" class="easyui-numberspinner" style="width: 60px;" required="required" data-options="min:-10,max:100,editable:false">
                                </td>
                            </tr>
                        </table>
                        
                        <h3>Satellite Groups</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th>Default TLE Group</th>
                                <td>
                                    <select id="options-sat-group-selector-listbox"></select>
                                    <p class="description">Select the satellite group to load at startup.</p>
                                </td>
                            </tr>                          
                            <tr valign="top">
                                <th>Auto Add From TLE Group</th>
                                <td>
                                    <input type="checkbox" id="sats-autoadd" value="on">
                                    <p class="description">Automatically add all of the satellites in a group when its selected. <strong>NOTE:</strong> This will also add all of the satellites from the default group when the page is loaded.</p>
                                </td>
                            </tr>                          
                        </table>
                    </div>
                    
                    <div title="Views" data-options="" style="padding: 0px;">
                        <div id="window-preferences-tabs-views" class="easyui-tabs" data-options="fit:true">
                            <div title="Polar View" data-options="" style="padding: 5px;">
                                <div class="icon32" id="icon-options-general"><br></div>
                                <h2>Polar View Options</h2>
                                
                                <table width="100%">
                                    <tr>
                                        <td rowspan="2" width="50%" valign="top">
                                            <h3>View Colours</h3>
                                            <table width="100%">
                                                <tr>
                                                    <th width="50%">Background Colour</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-background-color" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Border Colour</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-border-color" type="text" value="" /></td>
                                                </tr>                                                
                                                <tr>
                                                    <th width="50%">Gradient Start</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-gradient-start" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Gradient End</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-gradient-end" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Grid Colour</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-grid" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Text Colour</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-text" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Degree Text Colour</th>
                                                    <td width="50%"><input class="color polarcolour" id="polar-degrees-text" type="text" value="" /></td>
                                                </tr>
                                                <tr>
                                                    <th width="50%">Reset Colours To Defaults</th>
                                                    <td width="50%"><button id="polar-reset-colours">Default</button></td>
                                                </tr>                                                  
                                            </table>

                                        </td>
                                        <td width="50%">
                                            <div id="polar-preview" style="width:400px; height:400px"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div title="Passes View" data-options="" style="padding: 5px;">
                                <div class="icon32" id="icon-options-general"><br></div>
                                <h2>Passes View Options</h2>
                                <h3>Default views</h3>
                                <p>The passes view has two views that can be set by default. Select the default views to be shown below. The views can be altered on the passes ribbon tab. <strong>NOTE:</strong> You will need to refresh the page for these settinsg to take effect.</p>
                                <table class="form-table">
                                    <tr valign="top">
                                        <th>Bottom Left View</th>
                                        <td>
                                            <select class="options-cb" id="options-passes-view-bottomleft">
                                                <option value="3d">3D View</option>
                                                <option value="polar">Polar View</option>
                                                <option value="sky">Sky View</option>
                                                <option value="azel">Az/El View</option>
                                            </select>
                                        </td>
                                    </tr>                          
                                    <tr valign="top">
                                        <th>Bottom Right View</th>
                                        <td>
                                            <select class="options-cb" id="options-passes-view-bottomright">
                                                <option value="3d">3D View</option>
                                                <option value="polar">Polar View</option>
                                                <option value="sky">Sky View</option>
                                                <option value="azel">Az/El View</option>                                               
                                            </select>
                                        </td>
                                    </tr>                          
                                </table>                                
                            </div>
                        </div>
                    </div>                    
                    
                </div>
            </div>