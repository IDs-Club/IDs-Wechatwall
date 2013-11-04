<?php
@header("Content-type: text/html; charset=utf-8");
 
include '../config.php';

/** 
* PHP获取字符串中英文混合长度  
* @param $str string 字符串 
* @param $$charset string 编码 
* @return 返回长度，1中文=1位，2英文=1位 
*/  
function msubstr($str, $start, $len) {  
    $tmpstr = "";  
    $strlen = $start + $len;  
    for($i = 0; $i < $strlen; $i++){  
        if(ord(substr($str, $i, 1)) > 127){  
            $tmpstr.=substr($str, $i, 3);  
            $i+=2;  
        }else  
            $tmpstr.= substr($str, $i, 1);  
    }  
    return $tmpstr;  
} 

?>