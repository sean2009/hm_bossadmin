<?php
error_reporting(0);
include_once('RabbitMQCommand.php');

$configs = array('host'=>'192.168.0.156','port'=>5672,'username'=>'xp','password'=>'xp','vhost'=>'/');
$exchange_name = 'class-e-1';
$queue_name = 'class-q-1';
$route_key = 'class-r-1';
$ra = new RabbitMQCommand($configs,$exchange_name,$queue_name,$route_key);

class A{
    function processMessage($envelope, $queue) {
        $msg = $envelope->getBody();
        $envelopeID = $envelope->getDeliveryTag();
        $pid = posix_getpid();
        file_put_contents("/app/bossadmin/log{$pid}.log", $msg.'|'.$envelopeID.''."\r\n",FILE_APPEND);
        $queue->ack($envelopeID);
    }
}
$a = new A();

$s = $ra->run(array($a,'processMessage'),false);