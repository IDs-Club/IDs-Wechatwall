<?php
include_once('db.php'); //连接数据库 
$action = $_GET['action']; 
if($action==""){ //读取数据，返回json 
    $query = mysql_query("select * from weixin_wall where status=0 and num>0"); 
        while($row=mysql_fetch_array($query)){ 
        $arr[] = array( 
          'id' => $row['num'],
            'avatar' => "<img width='100' height='100' src='$row[avatar]'><p>",
          'nickname' => $row['nickname'],
          'content' => "：".msubstr($row['content'],0,185)."</p>"
        ); 
    } 
    echo json_encode($arr); 
}else{ //标识中奖号码 
    $id = $_POST['id']; 
    $sql = "update weixin_wall set status=1 where num=$id"; 
    $query = mysql_query($sql); 
    if($query){ 
        echo '1'; 
    } 
} 

?>