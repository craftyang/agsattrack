<?php

class AdminController extends Controller {
    private $catalogUrl = 'http://celestrak.com/pub/satcat.txt';
    private $catalogFields = Array(
        'designator' => Array(
            'start' => 1,
            'end' => 11,
            'trim' => true
        ),
        'norad' => Array(
                'start' => 14,
                'end' => 18
        ),
        'multiple' => Array(
                'start' => 20,
                'end' => 20
        ),
        'payload' => Array(
                'start' => 21,
                'end' => 21
        ),
        'operationalstatus' => Array(
                'start' => 22,
                'end' => 22
        ),
        'name' => Array(
                'start' => 24,
                'end' => 47
        ),
        'owner' => Array(
                'start' => 50,
                'end' => 54
        ),
        'launchdate' => Array(
                'start' => 57,
                'end' => 66
        ),
        'launchsite' => Array(
                'start' => 69,
                'end' => 73
        ),
        'decaydate' => Array(
                'start' => 76,
                'end' => 85
        ),
        'period' => Array(
                'start' => 88,
                'end' => 94
        ),
        'inclination' => Array(
                'start' => 97,
                'end' => 101
        ),
        'apogee' => Array(
                'start' => 104,
                'end' => 109
        ),
        'perigee' => Array(
                'start' => 112,
                'end' => 117
        ),
        'radarcrosssection' => Array(
                'start' => 120,
                'end' => 127
        ),
        'status' => Array(
                'start' => 130,
                'end' => 132
        )                                                                                                
    );
    
    private function getData($url) {
 /*       
        $test = '1957-001A    00001   D SL-1 R/B                  CIS    1957-10-04  TYMSC  1957-12-01     96.2   65.1     938     214   20.4200     
1957-001B    00002  *D SPUTNIK 1                 CIS    1957-10-04  TYMSC  1958-01-03     96.1   65.0     945     227     N/A       
1957-002A    00003  *D SPUTNIK 2                 CIS    1957-11-03  TYMSC  1958-04-14    103.7   65.3    1659     211    0.0800     
1958-001A    00004  *D EXPLORER 1                US     1958-02-01  AFETR  1970-03-31     88.5   33.1     215     183     N/A       
1958-002B    00005  *  VANGUARD 1                US     1958-03-17  AFETR                132.8   34.2    3837     654    0.1178     
1958-003A    00006  *D EXPLORER 3                US     1958-03-26  AFETR  1958-06-28    103.6   33.5    1739     117     N/A       
1958-004A    00007   D SL-1 R/B                  CIS    1958-05-15  TYMSC  1958-12-03    102.7   65.1    1571     206     N/A       
1958-004B    00008  *D SPUTNIK 3                 CIS    1958-05-15  TYMSC  1960-04-06     88.4   65.1     255     139   11.8400     
1958-005A    00009  *D EXPLORER 4                US     1958-07-26  AFETR  1959-10-23     92.8   50.2     585     239     N/A       
1958-006A    00010  *D SCORE                     US     1958-12-18  AFETR  1959-01-21     98.2   32.3    1187     159     N/A       
1959-001A    00011  *  VANGUARD 2                US     1959-02-17  AFETR                121.7   32.9    2958     553    0.3810     
1959-001B    00012     VANGUARD R/B              US     1959-02-17  AFETR                126.1   32.9    3346     556    0.5254 
1998-058B    25502     ATLAS 2A CENTAUR R/B      US     1998-10-20  AFETR                372.5   27.0   21249     291   15.7640     
1998-059A    25503  *  MAQSAT 3 & ARIANE 5 R/B   FR     1998-10-21  FRGUI                641.2    6.8   35513     995   29.3490 ';
        
        $return = explode("\n",$test);
        return $return;
*/        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $tmp = curl_exec($ch);
        curl_close($ch);
        if ($tmp != false){
            $return = explode("\n",$tmp);
            return $return;
        }        
    }
    
    private function getCatalogField($catalogEntry, $fieldName) {
        if (isset($this->catalogFields[$fieldName])) {
            $start = $this->catalogFields[$fieldName]['start'];    
            $end = $this->catalogFields[$fieldName]['end'];

            $field = substr($catalogEntry, $start-1, ($end-$start)+1);
            
            if (isset($this->catalogFields[$fieldName]['trim']) && $this->catalogFields[$fieldName]['trim']) {
                $field = trim($field);
            }
            return $field;
        } else {
            return '';
        }
    }
    
    private function parseCatalog($catalog) {
        foreach ($catalog as $satellite) {
            $designator = $this->getCatalogField($satellite,'designator');
            
            $sat = Catalog::model()->findByPk($designator);
            if ($sat === null) {
                $sat = new Catalog();
                $sat->id = $designator;
            }          
    
            $sat->norad = $this->getCatalogField($satellite,'norad');
            $sat->multiple = $this->getCatalogField($satellite,'multiple');
            $sat->payload = $this->getCatalogField($satellite,'payload');
            $sat->operationalstatus = $this->getCatalogField($satellite,'operationalstatus');
            $sat->name = $this->getCatalogField($satellite,'name');
            $sat->owner = $this->getCatalogField($satellite,'owner');
            $sat->launchdate = $this->getCatalogField($satellite,'launchdate');            
            $sat->site_id = $this->getCatalogField($satellite,'launchsite');
            $sat->decaydate = $this->getCatalogField($satellite,'decaydate');
            $sat->period = $this->getCatalogField($satellite,'period');
            $sat->inclination = $this->getCatalogField($satellite,'inclination');
            $sat->apogee = $this->getCatalogField($satellite,'apogee');
            $sat->perigee = $this->getCatalogField($satellite,'perigee');
            $sat->radarcrosssection = $this->getCatalogField($satellite,'radarcrosssection');
            $sat->status = $this->getCatalogField($satellite,'status');
            $sat->save();
                
        }
    }
                    
	public function actionUpdateCatalog() {
        $result = 'no';
        if(Yii::app()->user->checkAccess('updateCatalog')) {
            set_time_limit(0);
            $catalog = $this->getData($this->catalogUrl);
            $this->parseCatalog($catalog);
            $result = 'yes';
        }
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($result);
        Yii::app()->end();
    }

	public function actionUpdateElements()
	{
		$this->render('updateElements');
	}

    public function actionGetCatalog() {
        if(isset($_POST['page'])) {
            $page = intval($_POST['page']);
        } else {
            $page = 1;
        }
        if(isset($_POST['rows'])) {
            $rows = intval($_POST['rows']);
        } else {
            $rows = 10;
        }
        
        $criteria = new CDbCriteria();
        $criteria->limit = $rows;
        $criteria->offset = ($page-1) * $rows;
                    
        $rows = Catalog::model()->findAll($criteria);
        $totalRows = Catalog::model()->count();
        
        $catalogRows = Array();
        foreach ($rows as $row) {
            $rowData = Array();
            foreach($row as $key=>$value) {
                $rowData[$key] = $value;
            }
            $catalogRows[] = $rowData;
        }
        $data = Array(
            'total' => $totalRows,
            'rows' => $catalogRows
        );
        $this->renderPartial('/ajax', Array('data'=>$data));              
    }

    public function actionUpdateGroup($group, $name) {
        if(Yii::app()->user->checkAccess('updateGroups')) {        
            $groupRecord = Tlegroups::model()->findByPk($group);
            if ($groupRecord === NULL) {
                $groupRecord = new Tlegroups();
            }
            $groupRecord->id = $group;
            $groupRecord->name = $name;
            $groupRecord->save();
            $result = true;
        } else {
            $result = false;
        }
        $data = Array(
            'result' => $result
        );                
        $this->renderPartial('/ajax', Array('data'=>$data));    
    }
        
    public function actionDeleteGroup($group) {
        if(Yii::app()->user->checkAccess('updateGroups')) {        
            $groupRecord = Tlegroups::model()->findByPk($group);
            if ($groupRecord !== NULL) {
                $result = true;
                $groupRecord->delete(); 
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        $data = Array(
            'result' => $result
        );                
        $this->renderPartial('/ajax', Array('data'=>$data));       
    }
    
    public function actionGetGroups() {
        
        $groups = Tlegroups::model()->findAll();
        $totalRows = Tlegroups::model()->count();        
        $groupData = Array();
        foreach ($groups as $group) {
            $groupData[] = Array(
                'id'=>$group->id,
                'name'=>$group->name
            ); 
        }
        $data = Array(
            'total' => $totalRows,
            'rows' => $groupData
        );                
        $this->renderPartial('/ajax', Array('data'=>$groupData));  
    }
        
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}