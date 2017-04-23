$(function(){
	  $.ajax({
	    url: 'getJobtitleData.php',
	    type: 'GET',
	    success : function(data) {
	    
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Job Title wise Jobs",
	        "xAxisName": "job Title",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'jobtitle',
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