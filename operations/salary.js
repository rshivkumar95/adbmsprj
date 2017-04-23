$(function(){
	  $.ajax({
	    url: 'getSalaryData.php',
	    type: 'GET',
	    success : function(data) {
	    
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Package wise Jobs",
	        "xAxisName": "Package (L.A.)",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'package',
	        width: '550',
	        height: '350',
	        dataFormat: 'json',
	        dataSource: {
	          "chart": chartProperties,
	          "data": chartData
	        }
	      });
	      apiChart.render();
	    }
	  });
	});