            <div class="ribbon-tab" id="passes-tab">
                <span class="ribbon-title" data-tab="passes">Passes View</span>
                
                <div class="ribbon-section">
                    <span class="section-title">View Options</span>
                    <div class="ribbon-button ribbon-button-large ribbon-fl viewswitcher" data-tab="2">
                        <span class="button-title">Switch to<br />This View</span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/switch.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/switch.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/switch.png" />
                    </div>
                    <div class="ribbon-button ribbon-button-large view-reset">
                        <span class="button-title">Reset<br />View
                        </span> <span class="button-help"></span> 
                        <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/reset.png" /> 
                        <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/reset.png" /> 
                        <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/reset.png" />
                    </div>  
                 </div>                
                      
                <div class="ribbon-section">
                    <span class="section-title">View Layout</span>
                    <div style="width: 100px; float:left;">
                        <table width="100%">
                            <tr>
                                <td colspan="2" style="border:1px solid #ccc" align="center">Pass Table</td>
                            </tr>
                            <tr>
                                <td width="50%" style="border:1px solid #ccc">
                                
                                    <div class="ribbon-button ribbon-button-small" id="passes-bl-view-select" data-type="dropdownmenu" data-event="agsattrack.passesblview">
                                        <span class="button-title"><img src="/js/ribbon/arrow_down-16.png"></span> 
                                        <img class="ribbon-icon ribbon-normal" src="/images/ribbon/polar.png" /> 
                                        <img class="ribbon-icon ribbon-hot" src="/images/ribbon/polar.png" /> 
                                        <img class="ribbon-icon ribbon-disabled" src="/images/ribbon/polar.png" />
                                        <div class="ribbon-menu ribbon-menu-wide ribbon-menu-closed">
                                            <div class="title">Select Bottom left View</div>
                                            <ul>
                                                <li class="passesbl" data-event-param="3d" data-icon="/images/ribbon/globe.png"><img src="/images/ribbon/globe.png"><span>3D View</span></li>
                                                <li class="passesbl" data-event-param="polar" data-icon="/images/ribbon/polar.png"><img src="/images/ribbon/polar.png"><span>Polar View</span></li>
                                                <li class="passesbl" data-event-param="sky" data-icon="/images/ribbon/sky.png"><img src="/images/ribbon/sky.png"><span>Sky View</span></li>
                                                <li class="passesbl" data-event-param="azel" data-icon="/images/ribbon/azel-16.png"><img src="/images/ribbon/azel-16.png"><span>Az/El View</span></li>
                                            </ul>
                                        </div>
                                    </div>                                
                                </td>
                                <td style="border:1px solid #ccc">
                                    <div class="ribbon-button ribbon-button-small" id="passes-br-view-select" data-type="dropdownmenu" data-event="agsattrack.passesbrview">
                                        <span class="button-title"><img src="/js/ribbon/arrow_down-16.png"></span> 
                                        <img class="ribbon-icon ribbon-normal" src="/images/ribbon/sky.png" /> 
                                        <img class="ribbon-icon ribbon-hot" src="/images/ribbon/sky.png" /> 
                                        <img class="ribbon-icon ribbon-disabled" src="/images/ribbon/sky.png" />
                                        <div class="ribbon-menu ribbon-menu-wide ribbon-menu-closed">
                                            <div class="title">Select Bottom Right View</div>
                                            <ul>
                                                <li class="passesbl" data-event-param="3d" data-icon="/images/ribbon/globe.png"><img src="/images/ribbon/globe.png"><span>3D View</span></li>
                                                <li class="passesbl" data-event-param="polar" data-icon="/images/ribbon/polar.png"><img src="/images/ribbon/polar.png"><span>Polar View</span></li>
                                                <li class="passesbl" data-event-param="sky" data-icon="/images/ribbon/sky.png"><img src="/images/ribbon/sky.png"><span>Sky View</span></li>
                                                <li class="passesbl" data-event-param="azel" data-icon="/images/ribbon/azel-16.png"><img src="/images/ribbon/azel-16.png"><span>Az/El View</span></li>
                                            </ul>
                                        </div>
                                    </div>                                 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                                               
                <div class="ribbon-section">
                    <span class="section-title">Satellite</span>
                    <select id="passes-sat"></select>
                </div>
                
                <div class="ribbon-section" id="passes-available" style="display: none">
                    <span class="section-title">Available Passes</span>
                    <select id="passes-passes"></select>
                </div>                
                
            </div>