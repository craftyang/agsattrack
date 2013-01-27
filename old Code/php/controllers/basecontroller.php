<?php
$basePath = dirname(dirname(__FILE__));
require_once $basePath . '/libs/php-activerecord/ActiveRecord.php';

class TestLogger
{
    function log($data) {
        echo('<pre>');
        echo($data);
        echo('</pre>');
    }
}

class BaseController {
    function __construct() {
        
        ActiveRecord\Config::initialize(function($cfg)
        {
            $basePath = dirname(dirname(__FILE__));
            $cfg->set_model_directory($basePath . '/models');
            $cfg->set_connections(array('development' => 'mysql://alex_agsattrack:Xac06T9TQe@127.0.0.1/alex_agsattrack'));
            //$cfg->set_logging(true);
            //$cfg->set_logger(new TestLogger);
        });

    }    
    
    public function sendError($code, $errorText) {
        $result = Array(
            'error'=>true,
            'code'=>$code,
            'text'=>$errorText
        );
        $this->sendXHRData($result);
    }
    
    public function sendXHRData($data) {
        header('Content-type: application/json');
        echo(json_encode($data));        
        die();
    }        
}
