$(function(){
	  $.ajax({
	    url: 'getLocationData.php',
	    type: 'GET',
	    success : function(data) {
	    
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Location wise Jobs",
	        "xAxisName": "Location",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'location',
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