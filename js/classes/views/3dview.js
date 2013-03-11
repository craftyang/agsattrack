/*
Copyright 2013 Alex Greenland

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */
 
/* Options for JSHint http://www.jshint.com/
* 
* Last Checked: 19/01/2013
* 
*/
/*global AGSatTrack, AGSETTINGS, AGIMAGES, AGUTIL, Cesium */ 
 
var AG3DVIEW = function(element) {
    'use strict';

    var ellipsoid =null;
    var canvas = null;
    var scene = null;
    var transitioner = null;
    var cb = null;
    var observerBillboards = null;
    var _render = false;
    var satBillboards = null;
    var planetsBillboards = null;
    var _satNameLabels = null;
    var gridRefresh = 1;
    var gridRefreshCounter = 0;
    var orbitLines = null;
    var selectedLines = null;
    var passLines = null;
    var footprintCircle = null;
    var updateCounter = 0;
    var clock = null;
    var _selected = null;
    var _follow = false;
    var _followFromObserver = false;
    var TILE_PROVIDERS = null;
    var _skyAtmosphere;
    var _skybox;
    var _fps = null;
    var _labels = null;
    var _mousePosLabel = null;
    var _showMousePos = false;
    var _element;
    var _showSatLabels = true;
    var _singleSat;
    var _mode;
    var _settings = AGSETTINGS.getViewSettings('threed');
    var _currentProvider = 'staticimage'
        
    if (typeof element === 'undefined') {
        _element = '3d';    
    } else {
        _element = element;
    }
        
    /*
    jQuery(window).resize(function() {
        if (canvas === null) {
            return;
        }
        var height = jQuery('.layout-panel-center').innerHeight();
        var width = jQuery('.layout-panel-center').innerWidth();

        if (canvas.width === width && canvas.height === height) {
            return;
        }

        canvas.width = width;
        canvas.height = height;

        scene.getCamera().frustum.aspectRatio = width / height;
    });
      */
    function resize(width, height) {
        if (typeof width === 'undefined' || typeof height === 'undefined') {
            var parent = jQuery('#'+_element);
            width = parent.width();
            height = parent.height();
        }

        if (width !== 0 && height !== 0) {
            canvas.width = width;
            canvas.height = height;

            scene.getCamera().frustum.aspectRatio = width / height;
        }          
    }
    
    

    jQuery(document).bind('agsattrack.settingssaved',
            function(e, observer) {
                if (AGSETTINGS.getHaveWebGL()) {
                    _settings = AGSETTINGS.getViewSettings('threed');
                    TILE_PROVIDERS.staticimage.provider =  new Cesium.SingleTileImageryProvider({
                        url : 'images/maps/' + _settings.staticimage
                    });
                    if (_currentProvider == 'staticimage') {
                        setProvider(_currentProvider);
                    }
                    createSatellites();
                    setTerrainProvider(_settings.useTerrainProvider);
                }
            }); 
       
       

    jQuery(document).bind('agsattrack.locationAvailable',
            function(e, observer) {
                if (AGSETTINGS.getHaveWebGL()) {
                    plotObservers();
                }
            }); 
                            
    jQuery(document).bind('agsattrack.locationUpdated',
            function(e, observer) {
                if (AGSETTINGS.getHaveWebGL()) {
                    plotObservers();
                }
            });    

    jQuery(document).bind('agsattrack.resetview',
            function(e, observer) {
                if (_render) {
                    if (AGSETTINGS.getHaveWebGL()) {
                        _followFromObserver = false;
                        _follow = false;
                        AGSatTrack.getTles().resetAll();
                        plotObservers();
                        updateSatellites();
                    }
                }
            }); 
                
    jQuery(document).bind('agsattrack.showsatlabels',
            function(e, state) {
                if (AGSETTINGS.getHaveWebGL()) {
                    _showSatLabels = state;
                    createSatelliteLabels();
                }
            });    
    
    jQuery(document).bind('agsattrack.followsatellite',
            function(e, follow) {
                if (AGSETTINGS.getHaveWebGL()) {
                    _follow = follow;
                    if (_render) {
                        plotObservers();
                        updateSatellites();
                    }                    
                }
            });
    
    jQuery(document).bind('agsattrack.followsatelliteobs',
            function(e, follow) {
                if (AGSETTINGS.getHaveWebGL()) {
                    _followFromObserver = follow;
                    if (_render) {
                        plotObservers();
                        updateSatellites();
                    }                    
                }
            });    

    jQuery(document).bind('agsattrack.showatmosphere',
            function(e, state) {
                if (AGSETTINGS.getHaveWebGL()) {
                    if (state) {
                        scene.skyAtmosphere = _skyAtmosphere;    
                    } else {
                        scene.skyAtmosphere = undefined;    
                    }
                }
            });

    jQuery(document).bind('agsattrack.showskybox',
            function(e, state) {
                if (AGSETTINGS.getHaveWebGL()) {
                    if (state) {
                        scene.skyBox = _skybox;
                    } else {
                        scene.skyBox = undefined;                           
                    }
                }
            });
            
    jQuery(document).bind('agsattrack.showfps',
            function(e, state) {
                if (AGSETTINGS.getHaveWebGL()) {
                    if (state) {
                        _fps = new Cesium.PerformanceDisplay();                         
                        scene.getPrimitives().add(_fps);    
                    } else {
                        scene.getPrimitives().remove(_fps);                               
                    }
                }
            });            
                
    jQuery(document).bind('agsattrack.showmousepos',
            function(e, state) {
                if (AGSETTINGS.getHaveWebGL()) {
                    _showMousePos = state;
                }
            }); 
                
    /**
     * Listen for any changes in the tile provider.
     */
    jQuery(document).bind(
            'agsattrack.changetile',
            function(event, provider) {
                if (AGSETTINGS.getHaveWebGL()) {
                    if (scene.mode !== Cesium.SceneMode.MORPHING) {
                        setProvider(provider);
                    }
                }
            });

    jQuery(document).bind('agsattrack.satsselectedcomplete', function() {
        if (_render && _mode !== AGVIEWS.modes.SINGLE) {
            if (AGSETTINGS.getHaveWebGL()) {        
                createSatellites();
            }
        }
    });

    jQuery(document).bind('agsattrack.updatesatdata',
            function(event, selected) {
                if (_render) {
                    if (AGSETTINGS.getHaveWebGL()) { 
                        updateSatellites();
                    }
                }
            });

    /**
     * Listen for requests to change the view.
     */
    jQuery(document).bind('agsattrack.change3dview', function(event, view) {
        if (AGSETTINGS.getHaveWebGL()) {
            setView(view);
        }
    });

    jQuery(document).bind('agsattrack.showterrain', function(event, state) {
        if (AGSETTINGS.getHaveWebGL()) {
            setTerrainProvider(state);
        }
    });    

    function setView(view) {
        if (scene.mode !== Cesium.SceneMode.MORPHING) {
            switch (view) {
            case 'twod':
                transitioner.morphTo2D();
                jQuery('#3d-projection').setTitle('Views', '<br /> 2d view' );
                setButtonsState(false);
                break;
            case 'twopointfived':
                transitioner.morphToColumbusView()();
                jQuery('#3d-projection').setTitle('Views', '<br /> 2.5d view' ); 
                setButtonsState(false);
                break;
            case 'threed':
                transitioner.morphTo3D();
                jQuery('#3d-projection').setTitle('Views', '<br /> 3d view' );                     
                setButtonsState(true);
                break;
            }
        }
    }
    
    function setButtonsState(state) {
        if (state) {
            jQuery('#3d-sat-finder').combo('enable');
            jQuery('#3d-follow-obs').enable();
            jQuery('#3d-follow-sat').enable();
            jQuery('#3d-skybox').enable();
            jQuery('#3d-atmosphere').enable();
        } else {
            jQuery('#3d-sat-finder').combo('disable');
            jQuery('#3d-follow-obs').disable();
            jQuery('#3d-follow-sat').disable();
            jQuery('#3d-skybox').disable();
            jQuery('#3d-atmosphere').disable();
        }
    }
    
    function setProvider(provider) {
        if (typeof TILE_PROVIDERS[provider] !== 'undefined') {
            cb.getImageryLayers().removeAll();
            cb.getImageryLayers().addImageryProvider(TILE_PROVIDERS[provider].provider);
            jQuery('#3d-provider').setTitle('Provider', '<br />' + TILE_PROVIDERS[provider].toolbarTitle );
            _currentProvider = provider;        
        }
    } 
     
    /**
     * Plot the observers.
     */
    function plotObservers() {
        observerBillboards.removeAll();
        var observers = AGSatTrack.getObservers();
        for ( var i = 0; i < observers.length; i++) {
            var observer = observers[i];
            if (observer.isReady()) {
                var target = ellipsoid
                        .cartographicToCartesian(Cesium.Cartographic
                                .fromDegrees(observer.getLon(), observer
                                        .getLat()));
                var eye = ellipsoid
                        .cartographicToCartesian(Cesium.Cartographic
                                .fromDegrees(observer.getLon(), observer
                                        .getLat(), 1e7));
                var up = new Cesium.Cartesian3(0, 0, 1);
                
                
                var textureAtlas = scene.getContext().createTextureAtlas({
                    image : AGIMAGES.getImage('home')
                });
                observerBillboards.setTextureAtlas(textureAtlas);
                observerBillboards.modelMatrix = Cesium.Transforms.eastNorthUpToFixedFrame(target);
                observerBillboards.add({
                    imageIndex : 0,
                    position : new Cesium.Cartesian3(0.0, 0.0, 0.0)
                });        
        
                // Point the camera at us and position it directly above us if
                // we are the first observer
                if (i === 0) {
                    scene.getCamera().controller.lookAt(eye, target, up);
                }
            }
        }
        scene.getPrimitives().add(observerBillboards);
    }

    /**
     * Render the scene.
     * 
     * There is a NASTY hack in here to stop Cesium messing up when tabs are
     * switched
     */
    var _debugCounter = 0;     
    function renderScene() {
        
        (function tick() {
            if (_render) {
                if (AGSETTINGS.getDebugLevel() > 0) {                
                    _debugCounter++;
                    if (_debugCounter > 100) {
                        _debugCounter = 0;
                        console.log('3d Animate');
                    }
                }                 
                scene.initializeFrame();
             //   try {
                    scene.render();
        //        } catch (err) {
                    // See told you it was a nasty hack !
          //      }
                Cesium.requestAnimationFrame(tick);
            }
        }());
        
    }
    
    function createSatelliteLabels() {
        var satellites = AGSatTrack.getSatellites();
        var now = new Cesium.JulianDate();        
        var cpos;

       var okToCreate = false;
        
        if (_mode !== AGVIEWS.modes.SINGLE) {
            satellites = AGSatTrack.getSatellites();
            okToCreate = true;
        } else {
            if (_singleSat !== null) {
                okToCreate = true;
                satellites = [_singleSat];
            }    
        }
                
        _satNameLabels.removeAll();
        if (okToCreate) {
            if (_showSatLabels) {     
                _satNameLabels.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                        Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                        Cesium.Cartesian3.ZERO); 
                for ( var i = 0; i < satellites.length; i++) {
                    if (satellites[i].isDisplaying()) {
                        cpos = new Cesium.Cartesian3(satellites[i].get('x'), satellites[i].get('y'), satellites[i].get('z'));
                        cpos = cpos.multiplyByScalar(1000);               
                        cpos = cpos.multiplyByScalar(30/1000+1); 
                        var satLabel = _satNameLabels.add({
                          show : true,
                          position : cpos,
                          text : satellites[i].getName(),
                          font : _settings.unselectedLabelSize + 'px sans-serif',
                          fillColor : Cesium.Color.fromCssColorString('#'+_settings.unselectedLabelColour),
                          outlineColor : _settings.unselectedLabelColour,
                          style : Cesium.LabelStyle.FILL,
                          scale : 1.0
                        });
                        satLabel.satelliteindex = i;
                    }
                }
            }
        } 
    }
    
    function createSatellites() {
        var billboard;
        var image = new Image();
        var pos;
        var now = new Cesium.JulianDate();
        var cpos;
        var satellites;
        var okToCreate = false;
        
        if (_mode !== AGVIEWS.modes.SINGLE) {
            satellites = AGSatTrack.getSatellites();
            okToCreate = true;
        } else {
            if (_singleSat !== null) {
                okToCreate = true;
                satellites = [_singleSat];
            }    
        }

        var satdata = [];
        for ( var i = 0; i < satellites.length; i++) {
            var satObject = {
                value : satellites[i].getCatalogNumber(),
                text : satellites[i].getName()
            };
            satdata.push(satObject);
        }            
        jQuery('#3d-sat-finder').combobox('loadData',satdata );
                
        satBillboards.removeAll();

        if (okToCreate) {
            satBillboards.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                    Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                    Cesium.Cartesian3.ZERO);        

            for ( var i = 0; i < satellites.length; i++) {
                if (satellites[i].isDisplaying()) {
                    cpos = new Cesium.Cartesian3(satellites[i].get('x'), satellites[i].get('y'), satellites[i].get('z'));
                    cpos = cpos.multiplyByScalar(1000);               
                    billboard = satBillboards.add({
                        imageIndex : (satellites[i].getCatalogNumber() === '25544'?2:0),
                        position : cpos                   
                    });
                    billboard.satelliteName = satellites[i].getName();
                    billboard.satelliteCatalogId = satellites[i].getCatalogNumber();
                    billboard.satelliteindex = i;
                }
            }
            scene.getPrimitives().add(satBillboards);

            var satUnselected = 'satellite' + _settings.unselectedIcon + _settings.unselectedIconSize;
            var satSelected = 'satellite' + _settings.selectedIcon + _settings.selectedIconSize;

            var satUnselectedGrey = 'satellitegrey' + _settings.unselectedIcon + _settings.unselectedIconSize;
            var satSelectedGrey = 'satellitegrey' + _settings.selectedIcon + _settings.selectedIconSize;

            var textureAtlas = scene.getContext().createTextureAtlas({
                images : [
                    AGIMAGES.getImage(satUnselected), 
                    AGIMAGES.getImage(satSelected),
                    AGIMAGES.getImage('iss16'),
                    AGIMAGES.getImage('iss32'),
                    AGIMAGES.getImage(satUnselectedGrey),                     
                    AGIMAGES.getImage(satSelectedGrey)
                    ] 
            });
            satBillboards.setTextureAtlas(textureAtlas);
        }
        createSatelliteLabels();
    }

    function updateSatellites() {
        var now = new Cesium.JulianDate();
        var pos, newpos, bb;
        var following = AGSatTrack.getFollowing();
        var target;
        var up;
        var satellites;
        var okToUpdate = false;
        var eye;
                
        if (_mode !== AGVIEWS.modes.SINGLE) {
            satellites = AGSatTrack.getSatellites();
            okToUpdate = true;
        } else {
            if (_singleSat !== null) {
                satellites = [_singleSat];    
                okToUpdate = true;
            }
        }
                
        if (following !== null && (_follow || _followFromObserver)) {
            var observer = AGSatTrack.getObservers()[0];

            if (_followFromObserver) {
                eye = ellipsoid.cartographicToCartesian(Cesium.Cartographic.fromDegrees(observer.getLon(), observer.getLat(), 100));
                target = new Cesium.Cartesian3(following.get('x'), following.get('y'), following.get('z'));
                target = target.multiplyByScalar(1000);
                up = Cesium.Cartesian3.UNIT_X;                                
            } else {
                target = ellipsoid.cartographicToCartesian(Cesium.Cartographic.fromDegrees(observer.getLon(), observer.getLat(), 100));
                eye = new Cesium.Cartesian3(following.get('x'), following.get('y'), following.get('z'));
                eye = target.multiplyByScalar(1000);                                                    
                up = Cesium.Cartesian3.UNIT_X;                                
            } 
                       
            scene.getCamera().controller.lookAt(eye, target, up);                                      

        }
        
        satBillboards.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                Cesium.Cartesian3.ZERO);
        _satNameLabels.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                Cesium.Cartesian3.ZERO);
        for ( var i = 0; i < satBillboards.getLength(); i++) {
            bb = satBillboards.get(i);
     
            var offset = 4;
            var visibility = satellites[bb.satelliteindex].get('visibility');
            if ( visibility == 'Daylight' || visibility == 'Visible') {
                offset = 0;
            }
            
            if (satellites[bb.satelliteindex].getSelected()) {
                if (satellites[i].getCatalogNumber() === '25544') {
                    bb.setImageIndex(3);    
                } else {
                    bb.setImageIndex(1 + offset);    
                }
            } else {
                if (satellites[i].getCatalogNumber() === '25544') {
                    bb.setImageIndex(2);    
                } else {
                    bb.setImageIndex(0 + offset);    
                }   
            }
            newpos = new Cesium.Cartesian3(satellites[bb.satelliteindex].get('x'), satellites[bb.satelliteindex].get('y'), satellites[bb.satelliteindex].get('z'));
            newpos = newpos.multiplyByScalar(1000);
            bb.setPosition(newpos);

            if (_showSatLabels) {             
                newpos = newpos.multiplyByScalar(30/1000+1);            
                var satLabel = _satNameLabels.get(i);
                if (satellites[bb.satelliteindex].getSelected()) {
                    satLabel.setFont(_settings.selectedLabelSize + 'px sans-serif');
                    satLabel.setFillColor(Cesium.Color.fromCssColorString('#'+_settings.selectedLabelColour));
                } else {
                    satLabel.setFont(_settings.unselectedLabelSize + 'px sans-serif');
                    satLabel.setFillColor(Cesium.Color.fromCssColorString('#'+_settings.unselectedLabelColour));
                }
                satLabel.setPosition(newpos);
            }
        }
        
        setupOrbit();
    }

    function drawFootprint() {
        var footPrint;
        
        footprintCircle.removeAll();
        var selected = AGSatTrack.getTles().getSelected();
        for (var i=0; i< selected.length; i++) {
            footPrint = footprintCircle.add();
            var now = new Cesium.JulianDate();
            footPrint.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                    Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                    Cesium.Cartesian3.ZERO);

            footPrint.setPositions(Cesium.Shapes.computeCircleBoundary(ellipsoid, ellipsoid
                    .cartographicToCartesian(new Cesium.Cartographic.fromDegrees(
                            selected[i].get('longitude'), selected[i].get('latitude'))),
                    selected[i].get('footprint') * 500));  
   /*                 
 var ellipse = new Cesium.Polygon();
         ellipse.setPositions(Cesium.Shapes.computeEllipseBoundary(
            ellipsoid, ellipsoid.cartographicToCartesian(
                new Cesium.Cartographic.fromDegrees(
                            satInfo.longitude, satInfo.latitude)), satInfo.footprint * 500,
                    satInfo.footprint * 500, Cesium.Math.toRadians(60)));
        scene.getPrimitives().add(ellipse);
        debugger;
 */                                     
        }

    }

    function satelliteClickDetails(scene) {
        var handler = new Cesium.ScreenSpaceEventHandler(scene.getCanvas());

        handler.setInputAction(function(click) {
            var pickedObject = scene.pick(click.position);
            if (pickedObject) {
                var selected = pickedObject.satelliteCatalogId;
                jQuery(document).trigger('agsattrack.satclicked', {catalogNumber: selected});
            }
        }, Cesium.ScreenSpaceEventType.LEFT_CLICK);
    }

    function mouseMoveDetails(scene, ellipsoid) {
        var handler = new Cesium.ScreenSpaceEventHandler(scene.getCanvas());
        handler.setInputAction(function(movement) {
            if (_showMousePos) {
                var cartesian = scene.getCamera().controller.pickEllipsoid(movement.endPosition, ellipsoid);
                if (cartesian && !isNaN(cartesian.x)) {
                    var cartographic = ellipsoid.cartesianToCartographic(cartesian);
                    _mousePosLabel.setShow(true);
                    var lon = Cesium.Math.toDegrees(cartographic.longitude).toFixed(2);
                    var lat = Cesium.Math.toDegrees(cartographic.latitude).toFixed(2);
                    
                    _mousePosLabel.setText('(' + AGUTIL.convertDecDegLon(lon, false) + ', ' + AGUTIL.convertDecDegLat(lat, false) + ')');
                    _mousePosLabel.setPosition(cartesian);
                } else {
                    _mousePosLabel.setText('');
                }
            }
        }, Cesium.ScreenSpaceEventType.MOUSE_MOVE);
    }
        
    function resetOrbit() {
        orbitLines.removeAll();
        passLines.removeAll();
        footprintCircle.removeAll();
    }

    function setupOrbit() {
        resetOrbit();
        var selected = AGSatTrack.getTles().getSelected();
        for (var i=0; i< selected.length; i++) {
            addOrbitLine(selected[i]);    
        }
        drawFootprint();
    }
    
    function plotLine(cartPoints, colour, polylineCollection, width, showSsp) {
        var pos;
        var points = [];
        var selectedPoints = [];
        var lastPos;
        var now = new Cesium.JulianDate();
        var cartographic;
        var target;
        
        polylineCollection.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                Cesium.Cartesian3.ZERO);
      
        lastPos = cartPoints[0];
        for ( var i = 0; i < cartPoints.length; i++) {    
            if (checkOkToPlot(lastPos, cartPoints[i])) {
                pos = new Cesium.Cartesian3(cartPoints[i].x, cartPoints[i].y, cartPoints[i].z);
                pos = pos.multiplyByScalar(1000);
                points.push(pos);
                
                /**
                * Add the lines from satelite point to ssp
                */
                if (showSsp) {
                    selectedPoints = [];
                    selectedPoints.push(pos);
                    cartographic = ellipsoid.cartesianToCartographic(pos);
                    target = ellipsoid.cartographicToCartesian(new Cesium.Cartographic(cartographic.longitude, cartographic.latitude, 0));                       selectedPoints.push(target);
                    polylineCollection.add({
                        positions : selectedPoints,
                        width : 1,
                        color : colour
                    });
                }
                
            }
            lastPos = cartPoints[i];
        } 
        
        polylineCollection.add({
            positions : points,
            width : width,
            color : colour
        });
                                          
    }
    
    /**
    * Check a point is ok to plot, i.e. its more than 'range' units away from the last point
    */
    function checkOkToPlot(lastPos, pos) {
        var result = false;
        var range = 5;
        
        if (Math.abs(lastPos.x - pos.x) > range || Math.abs(lastPos.y - pos.y) > range || Math.abs(lastPos.z - pos.z) > range ) {
            result = true;
        }
        return result;  
    }
    
    
    function addOrbitLine(sat) {    
        var orbit = sat.getOrbitData();
        
        if (typeof orbit !== 'undefined' && typeof orbit.points[0] !== 'undefined') {
            if (sat.isGeostationary() && sat.get('elevation') > 0) {
                plotLine(orbit.points, Cesium.Color.GREEN, passLines, 1, false);
            } else {
                var pass = sat.getNextPass();
                plotLine(orbit.points, Cesium.Color.RED, passLines, 1, false);
                if (parseInt(sat.get('orbitnumber'),10) === parseInt(pass.orbitNumber,10)) {
                    plotLine(pass.pass, Cesium.Color.GREEN, passLines, 2, true);
                }
            }
        }
        
        /*
        if (typeof (orbit[0]) !== 'undefined') {

            var now = new Cesium.JulianDate();
            orbitLines.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                    Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                    Cesium.Cartesian3.ZERO);
            passLines.modelMatrix = Cesium.Matrix4.fromRotationTranslation(
                    Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                    Cesium.Cartesian3.ZERO);
                    
            var points = [];
            var pointsAOS = [];
            for ( var i = 0; i < orbit.length; i++) {
                pos = new Cesium.Cartesian3(orbit[i].x, orbit[i].y, orbit[i].z)
                pos = pos.multiplyByScalar(1000);
                points.push(pos);
                
                if (orbit[i].el >= AGSETTINGS.getAosEl()) {
                    pos = new Cesium.Cartesian3(orbit[i].x, orbit[i].y, orbit[i].z)
                    pos = pos.multiplyByScalar(1000);
                    pointsAOS.push(pos);
                    plottingAos = true;
                }
                
                if (plottingAos && orbit[i].el <= AGSETTINGS.getAosEl()) {
                    plottingAos = false;
                    passLines.add({
                        positions : pointsAOS,
                        width : 3,
                        color : Cesium.Color.GREEN
                    });
                    pointsAOS = [];
                }
                
                
            }
            
        //    var segments = Cesium.PolylinePipeline.wrapLongitude(ellipsoid, points);
        //    for (var i=0; i < segments.length; i++) {

            if (plottingAos) {
                passLines.add({
                    positions : pointsAOS,
                    width : 3,
                    color : Cesium.Color.GREEN
                });
            }        
      
                orbitLines.add({
                    positions : points,
                    width : 1,
                    color : Cesium.Color.RED
                });
      
        //    }


        }
*/
    }

    function disableInput(scene) {
        var controller = scene.getScreenSpaceCameraController();
        controller.enableTranslate = false;
        controller.enableZoom = false;
        controller.enableRotate = false;
        controller.enableTilt = false;
        controller.enableLook = false;
    }

    function enableInput(scene) {
        var controller = scene.getScreenSpaceCameraController();
        controller.enableTranslate = true;
        controller.enableZoom = true;
        controller.enableRotate = true;
        controller.enableTilt = true;
        controller.enableLook = true;
    }
    
    function setTerrainProvider(useTerrainProvider) {
        var terrainProvider;
        
        if (useTerrainProvider) {
            terrainProvider = new Cesium.CesiumTerrainProvider({
                url : 'http://cesium.agi.com/smallterrain'
            });
        } else {
            terrainProvider = new Cesium.EllipsoidTerrainProvider({
                ellipsoid : Cesium.Ellipsoid.WGS84
            });    
        }
        var centralBody = scene.getPrimitives().getCentralBody();
        centralBody.terrainProvider = terrainProvider;
        jQuery('#3d-show-terrain').setButtonState(useTerrainProvider);
    }
        
    function init3DView() {
        
        ellipsoid = Cesium.Ellipsoid.WGS84;
        cb = new Cesium.CentralBody(ellipsoid);
        observerBillboards = new Cesium.BillboardCollection();
        satBillboards = new Cesium.BillboardCollection();
        planetsBillboards = new Cesium.BillboardCollection();
        orbitLines = new Cesium.PolylineCollection();
        selectedLines = new Cesium.PolylineCollection();
        passLines = new Cesium.PolylineCollection();
        footprintCircle = new Cesium.PolylineCollection();
        clock = new Cesium.Clock();
        _satNameLabels = new Cesium.LabelCollection();

        TILE_PROVIDERS = {
            'bing' : {
                provider : new Cesium.BingMapsImageryProvider({
                    url : 'http://dev.virtualearth.net',
                    mapStyle : Cesium.BingMapsStyle.AERIAL,
                    proxy : Cesium.FeatureDetection.supportsCrossOriginImagery() ? undefined : new Cesium.DefaultProxy('/proxy/')
                }),
                toolbarTitle : 'Bing Maps'                       
            },
            'osm' : {
                provider : new Cesium.OpenStreetMapImageryProvider({
                    url : 'http://otile1.mqcdn.com/tiles/1.0.0/osm'
                }),
                toolbarTitle : 'Open Street maps'                
            },
            'staticimage' : { 
                provider : new Cesium.SingleTileImageryProvider({
                    url : 'images/maps/' + _settings.staticimage
                }),
                toolbarTitle : 'Static Image'
            },
            'arcgis' : {
                provider : new Cesium.ArcGisMapServerImageryProvider(
                    {url: 'http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer',
                    proxy: new Cesium.DefaultProxy('http://cesium.agi.com/proxy/')
                }),
                toolbarTitle : 'Arc Gis'                
            }            
        };
           
        canvas = jQuery('<canvas/>', {
            'id' : 'glCanvas'+_element,
            'class' : 'fullsize'
        }).appendTo('#'+_element)[0];

        scene = new Cesium.Scene(canvas);
      
      /*  
        switch (_settings.view) {
            case 'twod':
                scene.mode = Cesium.SceneMode.SCENE2D
                jQuery('#3d-projection').setTitle('Views', '<br /> 2d view' ); 
                break;
            case 'twopointfived':
                scene.mode = Cesium.SceneMode.COLUMBUS_VIEW
                jQuery('#3d-projection').setTitle('Views', '<br /> 2.5d view' ); 
                break;
            case 'threed':
                scene.mode = Cesium.SceneMode.SCENE3D
                jQuery('#3d-projection').setTitle('Views', '<br /> 3d view' );                     
                break;
        }        
        */
        transitioner = new Cesium.SceneTransitioner(scene, ellipsoid);

        cb.getImageryLayers().addImageryProvider(TILE_PROVIDERS[_settings.provider].provider);
        cb.showSkyAtmosphere = true;
        
        scene.getPrimitives().setCentralBody(cb);

        setTerrainProvider(_settings.useTerrainProvider);
                
        _skyAtmosphere = new Cesium.SkyAtmosphere();
        scene.skyAtmosphere = _skyAtmosphere;
        
        var imageryUrl = 'images/';
        _skybox = new Cesium.SkyBox({
            positiveX : imageryUrl + 'skybox/tycho2t3_80_px.jpg',
            negativeX : imageryUrl + 'skybox/tycho2t3_80_mx.jpg',
            positiveY : imageryUrl + 'skybox/tycho2t3_80_py.jpg',
            negativeY : imageryUrl + 'skybox/tycho2t3_80_my.jpg',
            positiveZ : imageryUrl + 'skybox/tycho2t3_80_pz.jpg',
            negativeZ : imageryUrl + 'skybox/tycho2t3_80_mz.jpg'
        });
        scene.skyBox = _skybox;
        
        _labels = new Cesium.LabelCollection(undefined);        
        _mousePosLabel = _labels.add({
            font : '18px sans-serif',
            fillColor : 'black',
            outlineColor : 'black',
            style : Cesium.LabelStyle.FILL
        });
        scene.getPrimitives().add(_satNameLabels);
                
     /*   scene.getCamera().controller.lookAt(new Cesium.Cartesian3(4000000.0, -15000000.0,  10000000.0), // eye
            Cesium.Cartesian3.ZERO, // target
            new Cesium.Cartesian3(-0.1642824655609347, 0.5596076102188919, 0.8123118822806428)); // up
       */
        satelliteClickDetails(scene);
        mouseMoveDetails(scene, ellipsoid);
        scene.getPrimitives().add(orbitLines);
        scene.getPrimitives().add(selectedLines);
        scene.getPrimitives().add(passLines);
        scene.getPrimitives().add(footprintCircle);
        scene.getPrimitives().add(_labels);
        scene.getPrimitives().add(planetsBillboards);
        
        jQuery(window).trigger('resize');
        
        plotObservers();
        
        jQuery('#3d-provider').setTitle('Provider', '<br />' + TILE_PROVIDERS[_currentProvider].toolbarTitle ); 
        jQuery('#3d-projection').setTitle('Views', '<br /> 3d view' ); 
        
        jQuery('#3d-sat-finder').combobox({
            onSelect : function(record){
                var sat = AGSatTrack.getSatelliteByName(record.value);
                jQuery(document).trigger('agsattrack.satclicked', {catalogNumber: record.value});

                var camera = scene.getCamera();

                var now = new Cesium.JulianDate(); 
                camera.transform = Cesium.Matrix4.fromRotationTranslation(
                        Cesium.Transforms.computeTemeToPseudoFixedMatrix(now),
                        Cesium.Cartesian3.ZERO); 
                                
                var pos = new Cesium.Cartesian3(sat.get('x'), sat.get('y'), sat.get('z'));
                pos = pos.multiplyByScalar(1050);  

                disableInput(scene);
                var flight = Cesium.CameraFlightPath.createAnimation(scene.getFrameState(), {
                    destination : pos,
                    onComplete : function() {
                        enableInput(scene);
                    }
                });
                scene.getAnimations().add(flight);
 
            }
        });
    }
    
    /**
    * Disable 3d view if there is no WebGL support
    */
    function initNo3DView() {
        /**
        * Add a sorry message to the view
        */
        jQuery('<div style="padding:20px"><img src="/images/ie.jpg" width=128 style="float:left" /><h1>3D View Not Supported</h1><p>Sorry the 3D view is not supported in your browser.</p><p>Recent versions of Chrome, Firefox, and Safari are supported. Internet Explorer is supported by using the <a target="_blank" href="http://www.google.com/chromeframe">Chrome Frame plugin</a>, which is a one-time install that does not require admin rights</p></div>', {
            'id' : 'glCanvas',
            'class' : 'fullsize'
        }).appendTo('#3d');

        /**
        * Disable all of the toolbar buttons                
        */
        jQuery('#satview3d').hide();
        jQuery('#3d-view-reset').disable();
        jQuery('#3d-projection').disable();
        jQuery('#3d-provider').disable();
        jQuery('#3d-follow').disable();
    }
    
    return {
        startRender : function() {
            if (AGSETTINGS.getHaveWebGL()) {
                _render = true;
                resize();
                renderScene();
                createSatellites();
            }
        },

        stopRender : function() {
            _render = false;
        },

        destroy : function() {
            _render = false;
            jQuery('#'+_element).html('');    
        },
                
        resizeView : function(width, height) {
            if (AGSETTINGS.getHaveWebGL()) {
                resize(width, height);     
            }
        },
        
        reDraw : function() {
            
        },
             
        init : function(mode) {
            if (AGSETTINGS.getHaveWebGL()) {
                if (typeof mode === 'undefined') {
                    mode = AGVIEWS.modes.DEFAULT;    
                }
                _mode = mode;                
                init3DView();
            }
        },
        
        reset : function() {
            _singleSat = null;
            createSatellites();
            updateSatellites();              
        },
        
        postInit : function() {
            if (!AGSETTINGS.getHaveWebGL()) {
                initNo3DView();
            }            
        },
        
        setSingleSat : function(satellite) {
            _singleSat = satellite;
            createSatellites();
            updateSatellites();            
        },
        
        setPassToShow : function(passToShow) {
        }
                
    };
};