            <div class="ribbon-tab" id="format-tab">
                <span class="ribbon-title">Home</span>

                <div class="ribbon-section">
                    <span class="section-title" data-tab="home">View</span>
                    <div class="ribbon-button ribbon-button-large" id="view-select" data-type="dropdownmenu">
                        <span class="button-title">Select <img src="js/ribbon/arrow_down.png"></span> 
                        <span class="button-help"><strong>Select view.</strong><br /><br />Selects the view you wish to display.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/view.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/view.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/view.png" />
                        <div class="ribbon-menu ribbon-menu-closed">
                            <div class="title">Select View</div>
                            <ul>
                                <li class="satview" data-options="0"><img src="images/ribbon/list.png"><span>List View</span></li>
                                <li class="satview" data-options="2"><img src="images/ribbon/table.png"><span>Passes View</span></li>
                                <li class="satview" id="satview3d" data-options="1"><img src="images/ribbon/globe.png"><span>3D View</span></li>
                                <li class="satview" data-options="3"><img src="images/ribbon/polar.png"><span>Polar View</span></li>
                                <li class="satview" data-options="4"><img src="images/ribbon/sky.png"><span>Sky View</span></li>
                                <li class="satview" data-options="5"><img src="images/ribbon/timeline.png"><span>Timeline View</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ribbon-button ribbon-button-large view-reset">
                        <span class="button-title">Reset</span>
                        <span class="button-help"><strong>Reset view.</strong><br /><br />Resets the current view to its defaults.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/reset.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/reset.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/reset.png" />
                    </div>
                </div>


                <div class="ribbon-section">
                    <span class="section-title">Satellites</span>
                    
                    <div class="ribbon-fl">
                        <div class="ribbon-button ribbon-button-large" id="sat-group-selector"  data-type="dropdownmenu">
                            <span class="button-title">Groups <img src="js/ribbon/arrow_down.png"></span> 
                            <span class="button-help"><strong>Select Satellite Group.</strong><br /><br />Selects the group of satellites.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/group.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/group.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/group.png" />
                            <div class="ribbon-menu ribbon-menu-closed">
                                <div class="title">Select Group</div>
                                <div id="sat-group-selector-listbox"></div>
                            </div>
                        </div>
                        <div class="ribbon-button ribbon-button-large" id="sat-selector" data-type="dropdownmenustay">
                            <span class="button-title">Select <img src="js/ribbon/down.png" /></span> 
                            <span class="button-help"><strong>Select Satellites.</strong><br /><br />Selects the satellites to display and show orbits for.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/satellite.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/satellite.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/satellite.png" />
                            <div class="ribbon-menu ribbon-menu-closed">
                                <div class="title">Select Satellite</div>
                                <div id="ag-satselector"> </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="ribbon-fl">
                        <div class="ribbon-button ribbon-button-small" id="sat-display-all">
                            <span class="button-title"></span>
                            <span class="button-help"><strong>Display All Satellites.</strong><br /><br />Display all satellites in the current group.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/satellite_all.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/satellite_all.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/satellite_all.png" />
                        </div>
                        <div class="ribbon-button ribbon-button-small" id="sat-display-none">
                            <span class="button-title"></span> 
                            <span class="button-help"><strong>Remove All Satellites.</strong><br /><br />Remove all satellites from display.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/satellite_delete_all.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/satellite_delete_all.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/satellite_delete_all.png" />
                        </div>                     
                    </div>                  
                </div>
<!--
                <div class="ribbon-section">
                    <span class="section-title">View Speed</span>

                    <div class="ribbon-button ribbon-button-large" id="speed-fast-back" data-group="speed-group" data-type="buttongroup">
                        <span class="button-title">Back<br /> Fast</span>
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/backfast.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/backfast.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/backfast.png" />
                    </div>

                    <div class="ribbon-button ribbon-button-large" id="speed-normal-back" data-group="speed-group" data-type="buttongroup">
                        <span class="button-title">Back<br /> Normal</span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/back.png" />
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/back.png" />
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/back.png" />
                    </div>

                    <div class="ribbon-button ribbon-button-large" id="speed-pause" data-group="speed-group" data-type="buttongroup">
                        <span class="button-title">Pause</span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/pause.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/pause.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/pause.png" />
                    </div>

                    <div class="ribbon-button ribbon-button-large ribbon-button-large-active" id="speed-normal-forward" data-group="speed-group" data-type="buttongroup">
                        <span class="button-title">Normal</span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/normal.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/normal.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/normal.png" />
                    </div>

                    <div class="ribbon-button ribbon-button-large" id="speed-fast-forward" data-group="speed-group" data-type="buttongroup">
                        <span class="button-title">Forward<br /> Fast</span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/forwardfast.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/forwardfast.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/forwardfast.png" />
                    </div>
                </div>
-->

                <div class="ribbon-section">
                    <span class="section-title">Settings</span>
                    <div style="float:left">
                        <div class="ribbon-button ribbon-button-large" id="options">
                            <span class="button-title">Options</span> <span
                                class="button-help"></span> <img
                                class="ribbon-icon ribbon-normal"
                                src="js/ribbon/icons/normal/settings.png" /> <img
                                class="ribbon-icon ribbon-hot"
                                src="js/ribbon/icons/hot/settings.png" /> <img
                                class="ribbon-icon ribbon-disabled"
                                src="js/ribbon/icons/disabled/settings.png" />
                        </div>
                    </div>
                    <div style="float:left">                    
                        <div class="ribbon-button ribbon-button-small disabled" id="options-save" unselectable="on">
                            <span class="button-help" unselectable="on"></span>
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/save.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/save.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/save.png" />
                            <span class="button-title" unselectable="on">Save</span>
                        </div>
                    </div>
                </div>

                <div class="ribbon-section">
                    <span class="section-title">User</span>
                    <div style="float:left">                    
                        <div class="ribbon-button ribbon-button-large" id="user-login" data-event="agsattrack.login">
                            <span class="button-title">Login</span> 
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/login.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/login.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/login.png" />
                        </div>
                        <div class="ribbon-button ribbon-button-large" id="user-logout" data-event="agsattrack.logout">
                            <span class="button-title">Logout</span> 
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/logout.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/logout.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/logout.png" />
                        </div>
                        <div class="ribbon-button ribbon-button-large" id="user-register" data-event="agsattrack.register">
                            <span class="button-title">Register</span> 
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/register.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/register.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/register.png" />
                        </div>
                    </div>
                    <div style="float:left">
                        <div class="ribbon-button ribbon-button-small" id="user-myaccount">
                            <span class="button-help" unselectable="on"></span>
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/myaccount-16.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/myaccount-16.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/myaccount-16.png" />
                            <span class="button-title" unselectable="on">My Account</span>
                        </div>                    
                    </div>                     
                </div>
                                    
                <div class="ribbon-section">
                    <span class="section-title">Help</span>
                    <div style="float:left">
                        <div class="ribbon-button ribbon-button-large" id="help-help">
                            <span class="button-title">Help</span> 
                                <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/help.png" /> 
                                <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/help.png" /> 
                                <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/help.png" />
                        </div>
                    </div>
                    <div style="float:left">                    
                        <div class="ribbon-button ribbon-button-small" id="help-tour" unselectable="on">
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/tour.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/tour.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/tour.png" />
                            <span class="button-title" unselectable="on">Tour</span>
                        </div>
                        <div class="ribbon-button ribbon-button-small" id="help-contact" unselectable="on">
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/email.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/email.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/email.png" />
                            <span class="button-title" unselectable="on">Contact</span>
                        </div>
                        <div class="ribbon-button ribbon-button-small disabled" id="help-forum" unselectable="on">
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/forum.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/forum.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/forum.png" />
                            <span class="button-title" unselectable="on">Community</span>
                        </div>                                                  
                    </div>
                </div>                
            </div>