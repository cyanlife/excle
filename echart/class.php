<?php
class x{

    function num($ename){
        require (dirname(__FILE__)).'\emysql.php';
        $esql="select count(*) from excel where exname='$ename'";
        $eresult=mysqli_query($db, $esql);
        $row=mysqli_fetch_array($eresult)[0];
        return $row;
    }
}
$filename=dirname(__FILE__).'\file.xls';
echo filesize($filename);