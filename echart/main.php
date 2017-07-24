<?php
require_once (dirname(__FILE__)).'\emysql.php';
require_once (dirname(__FILE__)).'\Conclass.php';
require_once (dirname(__FILE__)).'\fenyelei1.php';
$config = array(
    'db_name' => 'zhidao',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => ''
);
$db1=con::connectMysql($config);
$db2=con::connectMysql($config)->db();
var_dump($db1);
var_dump($db2);
$qquery_result=($db1->query("excel","","" ));
 $pageSize =5;
$page=1;
if (isset($_GET['page'])) {
   
    $page = $_GET['page'];

    
    if (empty($page) || $page <= 0 || !is_numeric($page)) {
        $page = 1;
    } else {
        $page = intval($page);
    }
}


$totalSql = "SELECT COUNT(*) FROM excel ";


$total = mysqli_fetch_array(mysqli_query($db, $totalSql))[0];


// if ($total != 0) {
//     $pageAbsolute = ceil($total / $pageSize);
// }


$num = ($page - 1) * $pageSize;
//include('fenyelei1.php');    //引入类

//$p=new Page(总页数,显示页数,当前页码,每页显示条数,[链接]);
//连接不设置则为当前链接
//$page=isset($_GET['page']) ? $_GET['page'] : 1;
$p=new Page($total,2,$page,5);

$limit = "$num, $pageSize";
$re_sql="select * from excel  order by exid limit $limit";
$re_result=mysqli_query($db, $re_sql);
 echo 'userip='. $_SERVER["REMOTE_ADDR"];
?>
<html>
<head>
 <script src="js/echarts.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/echarts.js"></script>
     <meta charset="utf-8">

</head>
<body>
<table width="100%" >
<tr>
<th style="border:1px solid blue" width="18%">id</th>
<th style="border:1px solid blue" width="18%">address</th>
<th style="border:1px solid blue" width="18%">issue</th>
<th style="border:1px solid blue" width="18%">status</th>
<th style="border:1px solid blue" width="18%">month</th>


</tr>
<!-- <html> -->
<?php while($rows=mysqli_fetch_array($re_result, MYSQLI_ASSOC)):?>
<tr>
<th style="border:1px solid blue" width="18%" ><a href="details.php?issueid= (<?php echo $rows['exid'] ?>)"><?php echo $rows['exid']?></a></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['exname']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['issue']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['status']?></th>
<th style="border:1px solid blue" width="18%"><?php echo $rows['month']?></th>
</tr>
<?php endwhile;?>
</table>
<!-- 显示分页 -->

<?php 
$sql="select exname from excel group by exname ";
$resultt=mysqli_query($db,$sql);
foreach ($resultt as $row){
    
    echo  $row['exname'];
}


?>
 <div id="page">
        <ul>
         
            
            <?php
              echo $p->showPages(1);
            ?>
        </ul>
    </div>
   
   <!-- echart显示 -->
   
       <div id="main1" style="width: 400px;height:400px;"></div>
	         <div id="main2" style="width: 500px;height:400px"></div>
	          <div id="main" style="width:100%;height:400px;"></div>
    <script type="text/javascript">
        // 鍩轰簬鍑嗗濂界殑dom锛屽垵濮嬪寲echarts瀹炰緥
        var myChart = echarts.init(document.getElementById('main'));
        var myChart1 = echarts.init(document.getElementById('main1'));
        var myChart2 = echarts.init(document.getElementById('main2'));
 // 鍒濆鍖栦袱涓暟缁勶紝鐩涜浠庢暟鎹簱涓幏鍙栧埌鐨勬暟鎹?
  var names = [], ages = [], alls=[];
 function ObjStory(value,name) //
  {
      this.name = name;
      this.value= value;  
  }  
//   alls.push(new ObjStory(130,'鐜?')	);
//   alls.push(new ObjStory(10,'鏉?')	);
    //璋冪敤ajax鏉ュ疄鐜板紓姝ョ殑鍔犺浇鏁版嵁
    function getusers() {
        $.ajax({
            type: "post",
            async: false,
            url: "data.php",
         data: {},
            dataType: "json",
            success: function(result){
                if(result){
                    for(var i = 0 ; i < result.length; i++){
						
								ages.push(result[i].age);
								names.push(result[i].name);
                       //names.push(result[i].name);
                        //ages.push(result[i].age);//楗肩姸鍥鹃渶			            
						alls.push(new ObjStory(result[i].age,result[i].name));//数组合并为数组内部的对象
								
                    }
                }
            },
            error: function(errmsg) {
                alert("Ajax鑾峰彇鏈嶅姟鍣ㄦ暟鎹嚭閿欎簡锛?"+ errmsg);
            }
        });
    return alls;

    }

    // 鎵ц寮傛璇锋眰
    getusers(); 
//document.write(result);
	/**var option = {
    title : {
        text: '鏌愮珯鐐圭敤鎴疯闂潵婧?',
        subtext: '绾睘铏氭瀯',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: names
    },
    series : [
        {
            name: '璁块棶鏉ユ簮',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data: result,
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

	
myChart.setOption(option);
        // 鎸囧畾鍥捐〃鐨勯厤缃」鍜屾暟鎹?
		/**************************************************鏌辩姸鍥?*******************************************************/
		/*  var option = {
            title : { 
                text : '鏂囩珷闃呰閲忓垎甯冨浘'
            },
            tooltip : {
                show : true
            },
            legend : {
                data : [ '闃呰閲?' ]
            },
            xAxis :  {
                data : names
				  //data: ["琛～","缇婃瘺琛?","闆汉琛?","瑁ゅ瓙","楂樿窡闉?","琚滃瓙"]
            } ,
            yAxis : {
      
            } ,
            series : [ {
                "name" : "闃呰閲?",
                "type" : "bar",
                
                "data" : ages
            } ]
           
        };*/
//myChart.setOption(option); 
/**************************************************楗肩姸鍥?*******************************************************/
/**var option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        x: 'left',
        data:names
    },
    series: [
        {
            name:'璁块棶鏉ユ簮',
            type:'pie',
            radius: ['50%', '70%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '30',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data:ages
        }
    ]
};
myChart.setOption(option);**/
/*
 * 楗煎浘
 */

 var base = +new Date(1968, 9, 3);
 var oneDay = 24 * 3600 * 1000;
 var date = [];

 var data = [Math.random() * 300];

 for (var i = 1; i < 20000; i++) {
     var now = new Date(base += oneDay);
     date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'));
     data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
 }

 option = {
     tooltip: {
         trigger: 'axis',
         position: function (pt) {
             return [pt[0], '10%'];
         }
     },
     title: {
         left: 'center',
         text: '大数据量面积图',
     },
     toolbox: {
         feature: {
             dataZoom: {
                 yAxisIndex: 'none'
             },
             restore: {},
             saveAsImage: {}
         }
     },
     xAxis: {
         type: 'category',
         boundaryGap: false,
         data: date
     },
     yAxis: {
         type: 'value',
         boundaryGap: [0, '100%']
     },
     dataZoom: [{
         type: 'inside',
         start: 0,
         end: 10
     }, {
         start: 0,
         end: 10,
         handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
         handleSize: '80%',
         handleStyle: {
             color: '#fff',
             shadowBlur: 3,
             shadowColor: 'rgba(0, 0, 0, 0.6)',
             shadowOffsetX: 2,
             shadowOffsetY: 2
         }
     }],
     series: [
         {
             name:'模拟数据',
             type:'line',
             smooth:true,
             symbol: 'none',
             sampling: 'average',
             itemStyle: {
                 normal: {
                     color: 'rgb(255, 70, 131)'
                 }
             },
             areaStyle: {
                 normal: {
                     color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                         offset: 0,
                         color: 'rgb(255, 158, 68)'
                     }, {
                         offset: 1,
                         color: 'rgb(255, 70, 131)'
                     }])
                 }
             },
             data: data
         }
     ]
 };

    
    myChart.setOption(option);
    myChart.on('click', function (params) {
        window.open('filter.php?filtername=' + encodeURIComponent(params.name));
    });
 /*
饼图2

    
    */
    option1 = {
    	    tooltip: {
    	        trigger: 'item',
    	        formatter: "{a} <br/>{b}: {c} ({d}%)"
    	    },
    	    legend: {
    	        orient: 'vertical',
    	        x: 'left',
    	        data:names
    	    },
    	    series: [
    	        {
    	            name:'访问来源',
    	            type:'pie',
    	            radius: ['50%', '70%'],
    	            avoidLabelOverlap: false,
    	            label: {
    	                normal: {
    	                    show: false,
    	                    position: 'center'
    	                },
    	                emphasis: {
    	                    show: true,
    	                    textStyle: {
    	                        fontSize: '30',
    	                        fontWeight: 'bold'
    	                    }
    	                }
    	            },
    	            labelLine: {
    	                normal: {
    	                    show: false
    	                }
    	            },
    	            data:alls
    	        }
    	    ]
    	};

    	                    
   
myChart1.setOption(option1);
myChart1.on('click', function (params) {
    window.open('filter.php?filtername=' + encodeURIComponent(params.name));
});
/*
 * 统计饼图 3
 */
 option2 = {
		    title : {
		        text: '某站点用户访问来源',
		        subtext: '纯属虚构',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data:names
		    },
		    series : [
		        {
		            name: '访问来源',
		            type: 'pie',
		            radius : '55%',
		            center: ['50%', '60%'],
		            data:alls,
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
		};
myChart2.setOption(option2)
 console.log(alls[0]);
 
    </script>
    
</body>
</html>
