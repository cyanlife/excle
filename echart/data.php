<?php
header('Content-Type:text/html;charset=utf-8');
$ddb = mysqli_connect('localhost', 'root', '', 'zhidao');


if (mysqli_connect_errno() > 0) {
    exit('database false'.mysqli_connect_errno());
}
mysqli_set_charset($ddb, 'UTF8');
$sql='SELECT *
FROM excel_num   ';


$csql="select count(*) from zhidao_ask where users_id=18";
$ccsql='select *    FROM excel ';
$csql="select count(*) from zhidao_ask where users_id=18";
$cresult=mysqli_query($ddb, $csql);
$crows=mysqli_fetch_array($cresult)[0];
//echo $crows;
$result=mysqli_query($ddb, $sql);
class User{
    public $age;
    public $name;
}
$data=array();
 while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $user=new User();
    $user->age=$rows['enum'];
    $user->name=$rows['name'];
    //$user->name=mb_substr($rows[''], 1,4,'utf-8');
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
