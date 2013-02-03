            <div class="ribbon-tab" id="list-tab">
                <span class="ribbon-title" data-tab="list">List View</span>
                
                <div class="ribbon-section">
                    <span class="section-title">View Options</span>
                    
                    <div class="ribbon-fl" unselectable="on">            
                        <div class="ribbon-button ribbon-button-large ribbon-fl viewswitcher" data-tab="0">
                            <span class="button-title">Switch to<br />This View</span> 
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/switch.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/switch.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/switch.png" />
                        </div>
                        
                        <div class="ribbon-button ribbon-button-large view-reset" id="list-view-reset">
                            <span class="button-title">Reset</span> 
                            <span class="button-help"><strong>Reset view.</strong><br /><br />Resets the list view to its defaults.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for more information</span></span>                        
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/normal/reset.png" /> 
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/hot/reset.png" /> 
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/reset.png" />
                        </div>
                                                
                    </div>

                    <div class="ribbon-fl" style="width:30px;">
                        <div class="ribbon-button ribbon-button-small ribbon-fl ribbon-button-small-active" id="list-view-show-aos" unselectable="on" data-type="togglebutton" data-event="agsattrack.showaos">
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/disabled/arrow_up.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/disabled/arrow_up.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/arrow_up.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show AoS.</strong><br /><br />Show Aquisition of Satellite times in the list display.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>
                        
                        <div class="ribbon-button ribbon-button-small ribbon-fl ribbon-button-small-active" id="list-view-show-events" unselectable="on" data-type="togglebutton" data-event="agsattrack.showevents">
                            <img class="ribbon-icon ribbon-normal" src="js/ribbon/icons/disabled/show-events-16.png" />
                            <img class="ribbon-icon ribbon-hot" src="js/ribbon/icons/disabled/show-events-16.png" />
                            <img class="ribbon-icon ribbon-disabled" src="js/ribbon/icons/disabled/show-events-16.png" />
                            <span class="button-title" unselectable="on"></span>
                            <span class="button-help"><strong>Show Events.</strong><br /><br />calculate events for all satellites.<br /><hr><img src="js/ribbon/help-16.png" class="ribbon-help-small"/><span> See Help for mor information</span></span>                        
                        </div>                        
                        
                        
                    </div>
                </div>
            </div>