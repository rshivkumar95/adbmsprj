$(function(){
	  $.ajax({
	    url: 'getExperienceData.php',
	    type: 'GET',
	    success : function(data) {
	    
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Experience wise Jobs",
	        "xAxisName": "Experience",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'experience',
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