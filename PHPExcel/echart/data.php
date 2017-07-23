<?php
header('Content-Type:text/html;charset=utf-8');
$db = mysqli_connect('localhost', 'root', '', 'zhidao');


if (mysqli_connect_errno() > 0) {
    exit('database false'.mysqli_connect_errno());
}
mysqli_set_charset($db, 'UTF8');
$sql='SELECT *
FROM zhidao_ask order by reading  desc limit 10';


$csql="select count(*) from zhidao_ask where users_id=18";
$ccsql='select *    FROM zhidao_ask left JOIN user 
ON zhidao_ask.users_id=user.id and user.id=18';
$csql="select count(*) from zhidao_ask where users_id=18";
$cresult=mysqli_query($db, $csql);
$crows=mysqli_fetch_array($cresult)[0];
//echo $crows;
$result=mysqli_query($db, $sql);
class User{
    public $age;
    public $name;
}
$data=array();
 while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $user=new User();
    $user->age=$rows['reading'];
    $user->name=mb_substr($rows['title'], 1,4,'utf-8');
    //echo mb_substr($rows['title'], 1,4,'utf-8');
    $data[]=$user;
    //echo $rows['nickname'];
    
 }
echo  json_encode($data,JSON_UNESCAPED_UNICODE);
/*
 * hicharts数据获取
 */

// while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
//     $arr[] = array(
//         $rows['reading'],intval($rows['id'])
//     );
// }
// echo  json_encode($arr);
