            <div class="ribbon-tab" id="3d-tab">
                <span class="ribbon-title" data-tab="3d">3D View</span>
                
                <div class="ribbon-section">                

                </div>
                                                    
                <div class="ribbon-section">
                    <span class="section-title">View Options</span>

                    <div class="ribbon-fl">
                        <div class="ribbon-button ribbon-button-large ribbon-fl viewswitcher" data-tab="1">
                            <span class="button-title">Switch to<br />This View</span> 
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/switch.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/switch.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/switch.png" />
                        </div>
                                            
                        <div class="ribbon-button ribbon-button-large view-reset" id="3d-view-reset">
                            <span class="button-title">Reset</span> 
                            <span class="button-help"><strong>Reset view.</strong><br /><br />Resets the 3d view to its defaults.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/reset.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/reset.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/reset.png" />
                        </div>
                                            
                        <div class="ribbon-button ribbon-button-large" id="3d-projection" data-type="dropdownmenu">
                            <span class="button-title">Views <img src="js/ribbon/arrow_down.png"></span> <span class="button-help"></span>
                            <span class="button-help"><strong>Select view.</strong><br /><br />Choose from 3d, 2d or 2.5d views.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/viewselect.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/viewselect.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/viewselect.png" />
                            <div class="ribbon-menu ribbon-menu-closed">
                                <div class="title">Select View</div>
                                <ul>
                                    <li class="3dview" data-options="twod"><img src="images/ribbon/list.png"><span>2D View</span></li>
                                    <li class="3dview" data-options="twopointfived"><img src="images/ribbon/table.png"><span>2.5D View</span></li>
                                    <li class="3dview" data-options="threed"><img src="images/ribbon/globe.png"><span>3D View</span></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="ribbon-button ribbon-button-large" id="3d-provider" data-type="dropdownmenu">
                            <span class="button-title">Provider <img src="js/ribbon/arrow_down.png"></span> 
                            <span class="button-help"><strong>Map Provider.</strong><br /><br />Select the provider for the globe rendering.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/tile.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/tile.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/tile.png" />
                            <div class="ribbon-menu ribbon-menu-closed">
                                <div class="title">Select Provider</div>
                                <ul>
                                    <li class="tile" data-options="staticImage"><img src="images/ribbon/list.png"><span>Static Image</span></li>
                                    <li class="tile" data-options="bing"><img src="images/ribbon/table.png"><span>Bing maps</span></li>
                                    <li class="tile" data-options="osm"><img src="images/ribbon/globe.png"><span>Open StreetMap</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ribbon-fl" style="width:30px;">
                        <div class="ribbon-button ribbon-button-small ribbon-button-small-active ribbon-fl" unselectable="on" data-type="togglebutton" data-event="agsattrack.showatmosphere">
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-normal" src="js/ribbon/icons/normal/atmoshpere-16.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-hot" src="js/ribbon/icons/normal/atmoshpere-16.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-disabled" src="js/ribbon/icons/normal/atmoshpere-16.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show Atmoshpere.</strong><br /><br />Toggle displaying the atmoshpere.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>
                        <div class="ribbon-button ribbon-button-small ribbon-button-small-active ribbon-fl" unselectable="on" data-type="togglebutton" data-event="agsattrack.showskybox">
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-normal" src="js/ribbon/icons/normal/cube.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-hot" src="js/ribbon/icons/normal/cube.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-disabled" src="js/ribbon/icons/normal/cube.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show Skybox.</strong><br /><br />Toggle displaying the skybox.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>                                             
                        <div class="ribbon-button ribbon-button-small ribbon-fl" unselectable="on" data-type="togglebutton" data-event="agsattrack.showfps">
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-normal" src="js/ribbon/icons/normal/fps.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-hot" src="js/ribbon/icons/normal/fps.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-disabled" src="js/ribbon/icons/normal/fps.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show FrameRate.</strong><br /><br />Display the frame rate.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>                                             

                    </div>
                    <div class="ribbon-fl" style="width:30px;">
                        <div class="ribbon-button ribbon-button-small ribbon-fl" unselectable="on" data-type="togglebutton" data-event="agsattrack.showmousepos">
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-normal" src="js/ribbon/icons/normal/mousepos.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-hot" src="js/ribbon/icons/normal/mousepos.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-disabled" src="js/ribbon/icons/normal/mousepos.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show Mouse Pos.</strong><br /><br />Toggle displaying the lat and lon of the mouse position.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>

                        <div class="ribbon-button ribbon-button-small ribbon-button-small-active ribbon-fl" unselectable="on" data-type="togglebutton" data-event="agsattrack.showsatlabels">
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-normal" src="js/ribbon/icons/normal/label.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-hot" src="js/ribbon/icons/normal/label.png" />
                            <img class="ribbon-icon ribbon-button-small-no-title ribbon-disabled" src="js/ribbon/icons/normal/label.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show Satellite Labels.</strong><br /><br />Toggle displaying the name of the satellites.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>
                        
                    </div>                                        
                </div>


                <div class="ribbon-section">
                    <span class="section-title">Follow</span>
                    <div class="ribbon-button ribbon-button-large" id="3d-follow-sat" data-type="grouptogglebutton" data-event="agsattrack.followsatellite" data-group="follow">
                        <span class="button-title">From<br />Satellite</span> 
                        <span class="button-help"><strong>Follow Satellite.</strong><br /><br />Follows the selected satellite, looking at your location.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>                        
                        <img class="ribbon-icon ribbon-normal" src="/js/ribbon/icons/normal/orbit.png" />
                        <img class="ribbon-icon ribbon-hot" src="/js/ribbon/icons/hot/orbit.png" />
                        <img class="ribbon-icon ribbon-disabled" src="/js/ribbon/icons/disabled/orbit.png" />
                    </div>
                    <div class="ribbon-button ribbon-button-large" id="3d-follow-obs" data-type="grouptogglebutton" data-event="agsattrack.followsatelliteobs" data-group="follow">
                        <span class="button-title">From<br />Home</span> 
                        <span class="button-help"><strong>Follow Satellite.</strong><br /><br />Follows the selected satellite, looking from your location. This will ONLY work when the satellite is visible.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>                        
                        <img class="ribbon-icon ribbon-normal" src="/js/ribbon/icons/normal/follow-obs.png" />
                        <img class="ribbon-icon ribbon-hot" src="/js/ribbon/icons/hot/follow-obs.png" />
                        <img class="ribbon-icon ribbon-disabled" src="/js/ribbon/icons/disabled/follow-obs.png" />
                    </div>                                                         
                </div>
                
                <div style="float:right;">
                    <a href="http://cesium.agi.com/" target="_blank"><img src="/images/cesium_logo.svg" width="300" /></a>
                </div>
                
            </div>