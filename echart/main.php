<?php
require_once (dirname(__FILE__)).'\emysql.php';
require_once (dirname(__FILE__)).'\Conclass.php';
require_once (dirname(__FILE__)).'\fenyelei1.php';
$con=new con("localhost","root","","zhidao");
$con->connectMysql();
$qquery_result=($con->query("excel"));
 $pageSize =5;
// //褰撳墠椤电爜

// //鎬婚〉鐮佸垵濮嬩负1
// $pageAbsolute = 1;

//鍏堝垽鏂璸age 鏄惁瀛樺湪
if (isset($_GET['page'])) {
    //灏嗗緱鍒扮殑椤电爜璧嬪�肩粰鍙橀噺
    $page = $_GET['page'];

    //濡傛灉椤甸潰鍊间负绌烘垨灏忎簬闆舵垨涓嶆槸鏁板瓧锛屽垯榛樿涓�1
    if (empty($page) || $page <= 0 || !is_numeric($page)) {
        $page = 1;
    } else {
        $page = intval($page);
    }
}

//鎬昏褰曟暟鐨凷QL
$totalSql = "SELECT COUNT(*) FROM excel ";

//寰楀埌鎬昏褰曟暟
$total = mysqli_fetch_array(mysqli_query($db, $totalSql))[0];

// //寰楀埌鎬婚〉鐮�
// if ($total != 0) {
//     $pageAbsolute = ceil($total / $pageSize);
// }

//璁＄畻褰撳墠椤电爜鍦ㄤ粠绗嚑鏉″紑濮�
$num = ($page - 1) * $pageSize;
//include('fenyelei1.php');    //引入类

//$p=new Page(总页数,显示页数,当前页码,每页显示条数,[链接]);
//连接不设置则为当前链接
//$page=isset($_GET['page']) ? $_GET['page'] : 1;
$p=new Page($total,2,$page,5);

$limit = "$num, $pageSize";
$re_sql="select * from excel  order by exid limit $limit";
$re_result=mysqli_query($db, $re_sql);
?>


<!-- <html> -->
<?php while($rows=mysqli_fetch_array($re_result, MYSQLI_ASSOC)):?>
<table width="800px" >
<td style="border:1px solid blue" width="18%"><?php echo $rows['exid']?></td>
<td style="border:1px solid blue" width="18%"><?php echo $rows['exname']?></td>
<td style="border:1px solid blue" width="18%"><?php echo $rows['issue']?></td>
<td style="border:1px solid blue" width="18%"><?php echo $rows['status']?></td>
<td style="border:1px solid blue" width="18%"><?php echo $rows['month']?></td>
</table>
<?php endwhile;?>
<!-- 显示分页 -->
 <div id="page">
        <ul>
         
            
            <?php
              echo $p->showPages(1);
            ?>
        </ul>
    </div>
    
    
    </div>
<!-- </html> -->