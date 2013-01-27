<?php 
require_once 'basecontroller.php';

class SatellitesController extends BaseController {

    function __construct() {
        parent::__construct();
    }
    
    public function getdata($parameters) {
        $catalogNumber = $parameters['catalognumber'];
        
        $satData = Catalog::find('first', array('conditions' => array('norad = ?', $catalogNumber), 'include' => array('site')));
   //  prd($satData); 
        $data = Array();
        $data[] = Array('field'=>'noradid', 'value'=>$satData->norad);
        $data[] = Array('field'=>'name', 'value'=>$satData->name);
        $data[] = Array('field'=>'owner', 'value'=>$satData->owner);
        $data[] = Array('field'=>'Launch date', 'value'=>$satData->launchdate);
        $data[] = Array('field'=>'Launch Site', 'value'=>$satData->site->location);
        $data[] = Array('field'=>'period', 'value'=>$satData->period);
        $data[] = Array('field'=>'inclination', 'value'=>$satData->inclination);
        $data[] = Array('field'=>'apogee', 'value'=>$satData->apogee);
        $data[] = Array('field'=>'perigee', 'value'=>$satData->perigee);
        
        /*
        $sat->norad = $this->getField($satellite,'norad');
        $sat->multiple = $this->getField($satellite,'multiple');
        $sat->payload = $this->getField($satellite,'payload');
        $sat->operationalstatus = $this->getField($satellite,'operationalstatus');
        $sat->name = $this->getField($satellite,'name');
        $sat->owner = $this->getField($satellite,'owner');
        $sat->launchdate = $this->getField($satellite,'launchdate');
        $sat->site_id = $this->getField($satellite,'launchsite');
        $sat->decaydate = $this->getField($satellite,'decaydate');
        $sat->period = $this->getField($satellite,'period');
        $sat->inclination = $this->getField($satellite,'inclination');
        $sat->apogee = $this->getField($satellite,'apogee');
        $sat->perigee = $this->getField($satellite,'perigee');
        $sat->radarcrosssection = $this->getField($satellite,'radarcrosssection');
        $sat->status = $this->getField($satellite,'status');
        */   
        $this->sendXHRData($data);          
    }  
}