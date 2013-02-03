            <div title="Debug View" width=1000 height=600 id="debug">   
                <table id="debuggrid" class="easyui-treegrid" style="width:600px;height:400px"  
                        data-options="idField:'id',treeField:'satellite',title:'Satellite Data'">  
                    <thead>  
                        <tr>  
                            <th data-options="field:'satellite',width:250">Satellite</th>  
                            <th data-options="field:'orbits',width:60,align:'right'">Orbits</th>  
                            <th data-options="field:'orbitno',width:80">Orbit Number</th>  
                            <th data-options="field:'aos',width:120">AoS</th>  
                            <th data-options="field:'los',width:120">LoS</th>  
                            <th data-options="field:'points',width:80">Points</th>  
                            <th data-options="field:'calctime',width:110">Calc Time (ms)</th>  
                        </tr>  
                    </thead>  
                </table>                      
            </div> 