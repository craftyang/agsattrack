            <div title="Passes" style="overflow: hidden" id="passes">
                
                <div id="pass-info-geostationary" class="hidden">
                    <h1>The selected satellite is Geostationary</h1>
                    <p>A geostationary orbit, or Geostationary Earth Orbit (GEO), is a circular orbit 35,786 kilometres (22,236 mi) above the Earth's equator and following the direction of the Earth's rotation. An object in such an orbit has an orbital period equal to the Earth's rotational period (one sidereal day), and thus appears motionless, at a fixed position in the sky, to ground observers. Communications satellites and weather satellites are often given geostationary orbits, so that the satellite antennas that communicate with them do not have to move to track them, but can be pointed permanently at the position in the sky where they stay.</p>
                    <img src="/images/orbits.png "/>
                </div>

                <table width="98%" height="100%" id="pass-info-table">
                    <tr>
                        <td height="50%" width="100%" colspan="2" valign="top">                    
                            <table id="passesgrid" class="easyui-datagrid" title="Passes" data-options="rownumbers:true, singleSelect:true, autoRowHeight:false, pagination:true, pageSize:20">
                                <thead>
                                    <tr>
                                        <th field="date" width="170">Date</th>
                                        <th field="az" width="70">Azimuth</th>
                                        <th field="el" width="70">Elevation</th>
                                        <th field="viz" width="70">Visibility</th>
                                        <th field="range" width="60" align="right">Range</th>
                                        <th field="footprint" width="60" align="right">Footprint</th>
                                        <th field="doppler" width="105" align="right">Doppler Shift (Hz)</th>
                                        <th field="loss" width="105" align="right">Signal Loss (dB)</th>
                                        <th field="delay" width="105" align="right">Signal Delay (ms)</th>
                                    </tr>
                                </thead>
                            </table>                        
                        </td>
                    </tr>
                    <tr>
                        <td height="50%" width="50%" class="backblack"><div id="passbottomleft"></div></td>
                        <td height="50" width="50%" class="backblack"><div id="passbottomright"></div></td>
                    </tr>                    
                </table>
            </div>