<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>数据展示 test</title>
    <script src="incubator-echarts-master/dist/echarts.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body>
    <div id="table1" style="height:800px"></div>
    <div id="table2" style="height:800px"></div>
    <script type="text/javascript">
        var arr1 = new Array(),
            arr2 = new Array(),
            arr3 = new Array(),
            arr4 = new Array();
        var man = 0,
            women = 0,
            level1 = 0,
            level2 = 0,
            level3 = 0,
            level4 = 0,
            level5 = 0;

        function arrTest() {
            $.ajax({
                type: "post",
                async: false,
                url: "test.php",
                data: {},
                dataType: "json",
                success: function(result) {
                    //alert(JSON.stringify(result));
                    if (result) {
                        for (var i = 0; i < result.length; i++) {
                            arr1.push(result[i].time);
                            arr2.push(result[i].sum);
                            arr3.push(result[i].sex);
                            arr4.push(result[i].level);
                        }
                    }
                },
                error: function(errorMsg) {
                    alert("Ajax获取服务器数据出错了！" + errorMsg);
                    //myChart.hideLoading();
                }
            })
            return arr1, arr2, arr3, arr4;
        };

        function dataTest(arr3, arr4) {
            for (var i = 0; i < arr3.length; i++) {
                if (arr3[i] == 0)
                    man++;
                else if (arr3[i] == 1)
                    women++;
            }
            for (var i = 0; i < arr3.length; i++) {
                if (arr4[i] == 1)
                    level1++;
                else if (arr4[i] == 2)
                    level2++;
                else if (arr4[i] == 3)
                    level3++;
                else if (arr4[i] == 4)
                    level4++;
                else if (arr4[i] == 5)
                    level5++;
            }
            return man, women, level1, level2, level3, level4, level5;
        }
        arrTest();
        dataTest(arr3, arr4);
        var option1 = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['男', '女', '等级一', '等级二', '等级三', '等级四', '等级五']
            },
            series: [{
                    name: '性別',
                    type: 'pie',
                    selectedMode: 'single',
                    radius: [0, '30%'],

                    label: {
                        normal: {
                            position: 'inner'
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    data: [{
                            value: man,
                            name: '男',
                            selected: true
                        },
                        {
                            value: women,
                            name: '女'
                        }
                    ]
                },
                {
                    name: '言论等级',
                    type: 'pie',
                    radius: ['40%', '55%'],
                    label: {
                        normal: {
                            formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                            backgroundColor: '#eee',
                            borderColor: '#aaa',
                            borderWidth: 1,
                            borderRadius: 4,
                            // shadowBlur:3,
                            // shadowOffsetX: 2,
                            // shadowOffsetY: 2,
                            // shadowColor: '#999',
                            // padding: [0, 7],
                            rich: {
                                a: {
                                    color: '#999',
                                    lineHeight: 22,
                                    align: 'center'
                                },
                                // abg: {
                                //     backgroundColor: '#333',
                                //     width: '100%',
                                //     align: 'right',
                                //     height: 22,
                                //     borderRadius: [4, 4, 0, 0]
                                // },
                                hr: {
                                    borderColor: '#aaa',
                                    width: '100%',
                                    borderWidth: 0.5,
                                    height: 0
                                },
                                b: {
                                    fontSize: 16,
                                    lineHeight: 33
                                },
                                per: {
                                    color: '#eee',
                                    backgroundColor: '#334455',
                                    padding: [2, 4],
                                    borderRadius: 2
                                }
                            }
                        }
                    },
                    data: [{
                            value: level1,
                            name: '等级一'
                        },
                        {
                            value: level2,
                            name: '等级二'
                        },
                        {
                            value: level3,
                            name: '等级三'
                        },
                        {
                            value: level4,
                            name: '等级四'
                        },
                        {
                            value: level5,
                            name: '等级五'
                        }
                    ]
                }
            ]
        };
        var option2 = {
            title: {
                text: '各个发帖时间点以及数量'
            },
            xAxis: {
                data: arr1,
                axisLabel: {
                    inside: true,
                    textStyle: {
                        color: '#fff'
                    }
                },
                axisTick: {
                    show: false
                },
                axisLine: {
                    show: false
                },
                z: 10
            },
            yAxis: {
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    textStyle: {
                        color: '#999'
                    }
                }
            },
            dataZoom: [{
                type: 'inside'
            }],
            series: [{ // For shadow
                    type: 'bar',
                    itemStyle: {
                        normal: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    barGap: '-100%',
                    barCategoryGap: '40%',
                    data: arr2,
                    animation: false
                },
                {
                    type: 'bar',
                    itemStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [{
                                        offset: 0,
                                        color: '#83bff6'
                                    },
                                    {
                                        offset: 0.5,
                                        color: '#188df0'
                                    },
                                    {
                                        offset: 1,
                                        color: '#188df0'
                                    }
                                ]
                            )
                        },
                        emphasis: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [{
                                        offset: 0,
                                        color: '#2378f7'
                                    },
                                    {
                                        offset: 0.7,
                                        color: '#2378f7'
                                    },
                                    {
                                        offset: 1,
                                        color: '#83bff6'
                                    }
                                ]
                            )
                        }
                    },
                    data: arr2,
                }
            ]
        };





        var myChart1 = echarts.init(document.getElementById('table1'));
        var myChart2 = echarts.init(document.getElementById('table2'));
        myChart1.setOption(option1);
        myChart2.setOption(option2);
    </script>
</body>

</html>