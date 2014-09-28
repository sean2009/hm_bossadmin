<?php
/**
 * 从服务端获取数据
 * @author xiaopeng
 *
 */
Yii::import('yii_ext_lib.library.yar.API_Client');

class MessageWebService {
    /*
     * 发送短信
     */
    public static function sendSms($mobiles, $content, $send_type, $max = 12) {
        $params = array(
            'mobiles' => $mobiles,
            'content' => $content,
            'send_type' => $send_type,
            'max' => $max,
        );
        return API_Client::call(API_MESSAGE_URL, 'message/sendSms', $params);
    }
    
    /*
     * 发送短信
     */
    public static function sendEmail($mail_title, $mail_content, $mail_to) {
        $params = array(
            'mail_title' => $mail_title,
            'mail_content' => $mail_content,
            'mail_to' => $mail_to,
        );
        return API_Client::call(API_MESSAGE_URL, 'message/sendEmail', $params);
    }
}