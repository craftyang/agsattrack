<?php
class SatellitesController extends Controller {
    
	public function actionGetData($catalogNumber) {

        $satData = Catalog::model()->find("norad = '".$catalogNumber."'");

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
                
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($data);
        Yii::app()->end();
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