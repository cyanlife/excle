<?php
require_once (dirname(__FILE__)).'\Conclass.php';
$req_value=$_GET['filtername'];
if (isset($_GET['filtername'])){
echo   $req_value;
}else{
    $req_value=wuxi;
}
$config = array(
    'db_name' => 'zhidao',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => ''
);
$con=con::connectMysql($config);
var_dump($con);
$qquery_result=($con->query("excel","exname",$req_value));
 ?>
<table width="100%" >
<tr>
<th style="border:1px solid blue" width="18%">id</th>
<th style="border:1px solid blue" width="18%">address</th>
<th style="border:1px solid blue" width="18%">issue</th>
<th style="border:1px solid blue" width="18%">status</th>
<th style="border:1px solid blue" width="18%">month</th>
</tr>
<?php foreach ($qquery_result as $rows){?>
    <tr>
    <th style="border:1px solid blue" width="18%" ><a href="details.php?issueid=<?php echo $rows['exid']?>"><?php echo $rows['exid']?></a></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['exname']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['issue']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['status']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['month']?></th>
</tr>



<?php } ?>

</table>

