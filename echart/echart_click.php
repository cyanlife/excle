<?php ?>
<html>
<head>
<meta charset='utf-8'> 

</head>
<script type="text/javascript" src="http://echarts.baidu.com/doc/asset/js/jquery.js"></script>
    <script src="http://echarts.baidu.com/doc/asset/js/esl/esl.js" type="text/javascript"></script>   
   <script src="js/echarts.js"></script>
    <h2>饼图-实现点击事件+提示框样式</h2><input type="button" value="请点击我" />
     <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="height:600px;width:800px;border:1px solid #e1e1e1;"></div>
    <div id="main1" style="height:600px;width:800px;border:1px solid #e1e1e1; display:none;"></div>
    
    <script type="text/javascript">
        $(document).ready(function () {


            $("input").click(function () {
                test1(1);
            });


        });
        function test1(n) {
            alert(n);
            test();
        }


        function test() {


            require.config({
                paths: {
                    echarts: 'http://echarts.baidu.com/doc/example/www/js/echarts-map',
                    'echarts/chart/pie': 'http://echarts.baidu.com/doc/example/www/js/echarts-map',
                    'echarts/chart/map': 'http://echarts.baidu.com/doc/example/www/js/echarts-map'
                }
            });


            require(
                    [
                        'echarts',
                        'echarts/chart/pie',
                        'echarts/chart/map'
                    ],
                function (ec) {


                    // 基于准备好的dom，初始化echarts图表
                    var myChart = ec.init(document.getElementById('main'));
                    var myChart2 = ec.init(document.getElementById('main1'));


                    option = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)",
                            borderWidth: 1,
                            borderColor: 'red',
                            borderRadius: 4,
                            backgroundColor: '#f1f1f1',
                            textStyle: {
                                color: 'green',
                                fontFamily: 'Arial',
                                fontSize: 14


                            }
                        },
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['直接访问', '邮件营销', '联盟广告', '视频广告', '搜索引擎']
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                mark: { show: true },
                                dataView: { show: true, readOnly: false },
                                restore: { show: true },
                                saveAsImage: { show: true }
                            }
                        },
                        calculable: true,
                        series: [
                                    {
                                        name: '访问来源',
                                        type: 'pie',
                                        radius: ['50%', '70%'],
                                        itemStyle: {
                                            normal: {
                                                label: {
                                                    show: false
                                                },
                                                labelLine: {
                                                    show: false
                                                }
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    position: 'center',
                                                    textStyle: {
                                                        fontSize: '30',
                                                        fontWeight: 'bold'
                                                    }
                                                }
                                            }
                                        },
                                        data: [
                                            { value: 335, name: '直接访问' },
                                            { value: 310, name: '邮件营销' },
                                            { value: 234, name: '联盟广告' },
                                            { value: 135, name: '视频广告' },
                                            { value: 1548, name: '搜索引擎' }
                                        ]
                                    }
                                ]
                    };


                    var ecConfig = require('echarts/config');
                    function eConsole(param) {
                        var str = param.name + ":" + param.value;
                        alert(str);
                        $("#main1").css({ "display": "block" });
                        setTimeout(function(){test1(3);},200);
                    }




                    myChart.on(ecConfig.EVENT.CLICK, eConsole);
                    //myChart.on(ecConfig.EVENT.PIE_SELECTED, eConsole2);


                    myChart.setOption(option,true);


                });
        }
    </script> 