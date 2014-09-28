<?php


class ApiTestController extends BaseController {
    
    public $layout = 'module';
    
    public function actionIndex() {
        $render = array(
            'result' => '',
            'url' => '',
            'api_name' => '',
            'params' => ''
        );
        if (isset($_POST['url'])) {
            $render['url'] = $url = trim($_POST['url']);
            $render['api_name'] = $apiName = trim($_POST['api_name']);
            $render['params'] = $params = trim($_POST['params']);
            eval('$params =' . $params . ';');
            
            $render['result'] = API_Client::call($url, $apiName, $params);
            $render['exception'] = API_Client::getLastException();
        }
        
        $this->render('index', $render);
    }
    
}
