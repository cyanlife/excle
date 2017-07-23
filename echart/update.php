<?php
header("Content-Type: text/html; charset=UTF-8");
require_once (dirname(__FILE__)).'\Conclass.php';;
if ($_POST['editname']==null){
    echo "<script>alert('不能为空');history.back();</script>";
}
include_once dirname((__FILE__)).'\emysql.php';
$editid= $_GET['num'];
$editname=$_POST['editname'];
$currentname=$_GET['currentname'];
echo $editid."</br>";
echo $editname."</br>";
echo $currentname;

$con=new con("localhost","root","","zhidao");
$con->connectMysql();
$con->update("excel_num", "name", $editname, "id", $editid);
$con->update("excel", "exname", $editname, "exname", $currentname);
// $sql="update excel_num
//     set name='{$editname}' where id='{$editid}'";
//   $ssql="update excel  
//     set exname='{$editname}' where exname='{$currentname}'";
//    $result=mysqli_query($db, $sql);
//    $result1=mysqli_query($db, $ssql);
//     if (mysql_affected_rows) {
      
//         //查找到数据，就累计+1
    
//         //累加SQL
//         echo "<script>alert('修改成功');history.back();</script>";
    
//         //执行累加
//         mysqli_query($db, $updateSql);
//     } else {
//         //没数据，就返回报错
//          echo "<script>alert('未修改成功');history.back();</script>";
//     }