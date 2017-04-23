<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
<script src="operations/fusionchart/js/jquery-3.2.1.min.js"></script>

<script>
	
	$(document).ready(function(){		
	
	function generatecosine(){

	$.ajax
		({
			url: 'http://localhost:8081/temp/Temp',
			 headers: { 'Access-Control-Allow-Origin' : '*' },
			type:'POST',
			cache: false,
			success: function(r)
			{
				insertcosine();
				
			}
		});			
	}

	function insertcosine(){

	$.ajax
		({
			url: 'operations/insertSimilarity.php',		
			type:'POST',
			cache: false,
			success: function(r)
			{
				alert("Job Completed !");
				
			}
		});			
	}




	
	generatecosine();

});



</script>
</html>