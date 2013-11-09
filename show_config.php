<?php
@header("Content-type: text/html; charset=utf-8");
@header('Access-Control-Allow-Origin: *');

include 'config.php';

echo json_encode(array('status' => 'ok', 'info' => array(
      'weixin_name' => $weixin_name,
      'wxh'         => $wxh,
      'huati'       => $huati    
      )));
exit();
?>
