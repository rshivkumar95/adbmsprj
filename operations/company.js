$(function(){
	  $.ajax({
	    url: 'getCompanyData.php',
	    type: 'GET',
	    success : function(data) {
	     
	      chartData = data;
	      var chartProperties = {
	        "caption": "Top Company wise Jobs",
	        "xAxisName": "Company",
	        "yAxisName": "Jobs",
	        "rotatevalues": "1",
	        "theme": "ocean"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'company',
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