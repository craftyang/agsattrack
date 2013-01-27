<?php 
require_once 'basecontroller.php';

class ElementsController extends BaseController {

    function __construct() {
        parent::__construct();
    }
    
    public function getGroups() {
        $groups = Array();
        foreach (Tlegroup::find('all') as $group) {
            $groups[] = Array(
                'id'=>$group->id,
                'name'=>$group->name,
                'selected' => ($group->default?true:false)
            );
        }
        $this->sendXHRData($groups);
    }
    
    public function getElements($parameters) {
        $keysId = $parameters['group'];
        $keps = Kep::find('first', array('conditions' => array('kepsgroup = ?', $keysId)));
        
        $data = Array(
            'id' => $keysId,
            'keps' => $keps->elements
        );        
        $this->sendXHRData($data);
    }   
}