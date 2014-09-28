<?php

class MiddlewareWebService extends BaseWebService {

    public static function getErrorLogs($data = array()) {
        $params = array(
            'type' => $data['type'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'page' => $data['page'],
            'page_size' => $data['page_size'],
        );
        $return = API_Client::call(API_MESSAGE_URL, 'middleware/get', $params);
        return $return['response'];
    }

}
