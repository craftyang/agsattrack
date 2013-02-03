<?php

class ElementsController extends Controller {

    public function actionGetSatelliteData($group) {
        
        $keps = Keps::model()->findByPk($group);
        
        $data = Array(
            'id' => $group,
            'keps' => $keps->elements
        );
                
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($data);
        Yii::app()->end();
    }
    	
    public function actionGetElements($group) {
        
        $keps = Keps::model()->findByPk($group);
        
        $data = Array(
            'id' => $group,
            'keps' => $keps->elements
        );
                
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($data);
        Yii::app()->end();
	}

	public function actionGetGroups() {
        
        $groups = Tlegroups::model()->findAll();
        $groupData = Array();
        foreach ($groups as $group) {
            $groupData[] = Array(
                'id'=>$group->id,
                'name'=>$group->name,
                'selected' => ($group->default?true:false)
            ); 
        }        
        $this->renderPartial('/ajax', Array('data'=>$groupData));  
	}

	public function actionIndex() {
		$this->render('index');
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