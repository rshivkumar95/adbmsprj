$(function(){
	  $.ajax({
	    url: 'getSkillsData.php',
	    type: 'GET',
	    success : function(data) {
	     
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Skill wise Jobs",
	        "xAxisName": "Skills",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'skills',
	        width: '450',
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
