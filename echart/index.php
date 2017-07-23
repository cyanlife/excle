<?php 
require (dirname(__FILE__)).'\emysql.php';
require (dirname(__FILE__)).'\class.php';

$b=new x;
$nsql="select * from num";
$nresult=mysqli_query($db, $nsql);
//while($nrow=mysqli_fetch_array($nresult,MYSQLI_ASSOC)): 

// for($i=0;$i<4;$i++){
//  'num'. $i= $b->num($nrow['name'][$i]);
// }
$bnum=$b->num('Bejing');
$cnum=$b->num('Shenzhen');
$dnum=$b->num('SH');
$enum=$b->num('Wuxi');
echo $bnum."</br>".$cnum."</br>".$dnum;
//$isql="insert into excel_num(name,enum) values ('Bejing','$bnum'),('Shenzhen','$cnum'),('SH','$dnum'),('Wuxi','$enum')";
$iisql="UPDATE excel_num 
SET enum = CASE id
WHEN 1 THEN '$bnum' 
WHEN 2 THEN '$cnum' 
WHEN 3 THEN '$dnum' 
WHEN 4 THEN '$enum' 
END where id IN(1,2,3,4)
 ";

mysqli_query($db, $iisql);
if(mysqli_query($db, $iisql)){
   echo"<script>alert('success')</script>";
}else{
    echo"<script>alert('wrong')</script>";
}
?>
