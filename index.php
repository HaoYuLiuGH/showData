<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>数据展示 test</title>
    <script src="incubator-echarts-master/dist/echarts.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body>
    <div id="main" style="height:400px"></div>
    <script type="text/javascript">
        
        var arr1=new Array(),arr2=new Array();
        function arrTest()
        {
          $.ajax
          ({
            type: "post",
            async: false,
            url: "test.php",
            data: {},
            dataType: "json",
            success: function(result)
            {
              //alert(JSON.stringify(result));
              if (result) 
              {
                for (var i = 0; i < result.length; i++) 
                {
                    arr1.push(result[i].name);
                    arr2.push(result[i].age);
                }
              }
            },
            error: function(errorMsg)
            {
                alert("Ajax获取服务器数据出错了！"+ errorMsg);
                myChart.hideLoading();
            }
          })
          return arr1,arr2;
        }
        
        arrTest();
        var  myChart = echarts.init(document.getElementById('main'));
        var option = { 
            color: ['#3398DB'],
            title:
            {  
                text: '各个发帖时间点以及数量'  
            },  
            tooltip : 
            {
                trigger: 'axis',
                axisPointer : 
               {                           // 坐标轴指示器，坐标轴触发有效
                   type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
               }
            }, 
            grid: 
            {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            legend: 
            {  
                data:['时间点']  
            },  
            xAxis: [
                {  
                    type : 'category',  
                    data : arr1,
                    axisTick: 
                    {
                        alignWithLabel: true
                    }
                }
                ],  
            yAxis: [{  
                type : 'value'  
            }
            ],  
            series: [
                {  
                    name : "时间点",  
                    type : "line",  
                    barWidth: '60%',
                    data : arr2 
            }
            ]  
        };  
          
          myChart.setOption(option);
    
</script>
</body>
</html>

