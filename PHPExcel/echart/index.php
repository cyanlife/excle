<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="js/echarts.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/echarts.js"></script>
	<!--<script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>-->
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 800px;height:400px;"></div>
       <div id="main1" style="width: 100%;height:400px;"></div>
	  
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        var myChart1 = echarts.init(document.getElementById('main1'));
 // 初始化两个数组，盛装从数据库中获取到的数据
  var names = [], ages = [], alls=[];
 function ObjStory(value,name) //声明对象
  {
      this.name = name;
      this.value= value;  
  }  
//   alls.push(new ObjStory(130,'王')	);
//   alls.push(new ObjStory(10,'李')	);
    //调用ajax来实现异步的加载数据
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
                        //ages.push(result[i].age);//饼状图需			            
						alls.push(new ObjStory(result[i].age,result[i].name));
								
                    }
                }
            },
            error: function(errmsg) {
                alert("Ajax获取服务器数据出错了！"+ errmsg);
            }
        });
    return alls;

    }

    // 执行异步请求
    getusers(); 
//document.write(result);
	/**var option = {
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
        data: names
    },
    series : [
        {
            name: '访问来源',
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
        // 指定图表的配置项和数据
		/**************************************************柱状图*******************************************************/
		/*  var option = {
            title : { 
                text : '文章阅读量分布图'
            },
            tooltip : {
                show : true
            },
            legend : {
                data : [ '阅读量' ]
            },
            xAxis :  {
                data : names
				  //data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            } ,
            yAxis : {
      
            } ,
            series : [ {
                "name" : "阅读量",
                "type" : "bar",
                
                "data" : ages
            } ]
           
        };*/
//myChart.setOption(option); 
/**************************************************饼状图*******************************************************/
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
            data:ages
        }
    ]
};
myChart.setOption(option);**/
/*
 * 饼图
 */

    option = {
		    title : {
		        text: '问答网站热门问题10',
		        subtext: 'cyanlife',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient : 'vertical',
		        x : 'left',
		        data:[]
		    },
		    toolbox: {
		        show : true,
		        feature : {
		            mark : {show: true},
		            dataView : {show: true, readOnly: false},
		            magicType : {
		                show: true, 
		                type: ['pie', 'funnel'],
		                option: {
		                    funnel: {
		                        x: '25%',
		                        width: '50%',
		                        funnelAlign: 'left',
		                        max: 1548
		                    }
		                }
		            },
		            restore : {show: true},
		            saveAsImage : {show: true}
		        }
		    },
		    calculable : true,
		    series : [
		        {
		            name:'访问来源',
		            type:'pie',
		            radius : '55%',
		            center: ['50%', '60%'],
		            data:alls
		            
		        }
		    ]
		    
		};
    
    myChart.setOption(option);
/*饼图2
    */
    option = {
    	    tooltip : {
    	        trigger: 'item',
    	        formatter: "{a} <br/>{b} : {c} ({d}%)"
    	    },
    	    legend: {
    	        orient : 'vertical',
    	        x : 'left',
    	        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    	    },
    	    toolbox: {
    	        show : true,
    	        feature : {
    	            mark : {show: true},
    	            dataView : {show: true, readOnly: false},
    	            magicType : {
    	                show: true, 
    	                type: ['pie', 'funnel'],
    	                option: {
    	                    funnel: {
    	                        x: '25%',
    	                        width: '50%',
    	                        funnelAlign: 'center',
    	                        max: 1548
    	                    }
    	                }
    	            },
    	            restore : {show: true},
    	            saveAsImage : {show: true}
    	        }
    	    },
    	    calculable : true,
    	    series : [
    	        {
    	            name:'访问来源',
    	            type:'pie',
    	            radius : ['50%', '70%'],
    	            itemStyle : {
    	                normal : {
    	                    label : {
    	                        show : false
    	                    },
    	                    labelLine : {
    	                        show : false
    	                    }
    	                },
    	                emphasis : {
    	                    label : {
    	                        show : true,
    	                        position : 'center',
    	                        textStyle : {
    	                            fontSize : '30',
    	                            fontWeight : 'bold'
    	                        }
    	                    }
    	                }
    	            },
    	            data:alls
    	        }
    	    ]
    	};
    	                    
   
myChart1.setOption(option);

 console.log(alls[0]);
 
    </script>
</body>
</html>