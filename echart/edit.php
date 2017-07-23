<?php 
require_once (dirname(__FILE__)).'\emysql.php';
header("Content-Type: text/html; charset=UTF-8");
?>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
 
$sql="select * from excel_num";
$result=mysqli_query($db, $sql);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)):?>
<a><?php echo $row['name']?></a> 
<form method="post" action="update.php?num=<?php echo $row['id']?>&currentname=<?php echo $row['name']?>">
<input type="text" name="editname" placeholder="要替换的值">
<input type="submit" value="edit" > 

</form>
<?php endwhile;?>
<script>
document.getElementById()

</script>
</body>
</html>