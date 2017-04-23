<?php

include('config.php');



?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/workscout/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:44:50 GMT -->
<head>


<!-- Map -->
<style>
           #map {
        height: 400px;
        width: 100%;
       }
    </style>
    <script>
      var map;

      function initialize() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: new google.maps.LatLng(2.8,-187.3),
          mapTypeId: 'terrain'
        });

        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');
        // (In this example we use a locally stored copy instead.)
        // script.src = 'http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp';
        script.src = 'https://developers.google.com/maps/documentation/javascript/tutorials/js/earthquake_GeoJSONP.js';
        document.getElementsByTagName('head')[0].appendChild(script);
      }

      // Loop through the results array and place a marker for each
      // set of coordinates.
      window.eqfeed_callback = function(results) {
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1],coords[0]);
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
        }
      }
	  
	  
    </script>


<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Naukri Dhanda</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/green.css" id="colors">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="sticky-header">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="index.php"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="index.php" id="current">Home</a>
				</li>

				<li><a href="#">How It Works</a>
					<ul>
						<li><a href="job-seeker.php">For Job Seekers</a></li>
						<li><a href="employer.php">For Employers</a></li>
						<li><a href="Enterprenuer.php">For Enterpreneur</a></li>
						<li><a href="training-providers.php">For Training Provider</a></li>
						
					</ul>
				</li>

				<li><a href="career-path.php">Career Path</a>
				</li>
				
				<li><a href="companies.php">Companies</a>
				</li>
				<li><a href="about-us.php">About Us</a>
				</li>

				
			</ul>


			<?php
              		if($_SESSION['login'] == 1)
              			{
              			
              ?>
              <ul class="responsive float-right">
				<li><a href="logout.php"><i class="fa fa-user"></i>Logout</a></li>
				<?php
					}
					else if($_SESSION['login'] == 0){
				?>
			  <ul class="responsive float-right">
				<li><a href="my-account.php#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="my-account.php"><i class="fa fa-lock"></i> Log In</a></li>
			  </ul>
			   <?php 
			    }
			   ?>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span><a href="browse-jobs.html"></a></span>
			<h2><center>How Enterprenuer Module Works</center></h2>
		</div>

		

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Recent Jobs -->
	<div class="sixteen  columns">
	<div class="padding-right" >
		
		<!-- Company Info -->
		<!--<div class="company-info">
			<img src="images/company-logo.png" alt="">
			<div class="content">
				<h4>King LLC</h4>
				<span><a href="#"><i class="fa fa-link"></i> Website</a></span>
				<span><a href="#"><i class="fa fa-twitter"></i> @kingrestaurants</a></span>
			</div>
			<div class="clearfix"></div>
		</div>-->

		<p class="margin-reset">
			 Entrepreneurs is person who want to start their own business. For them we are analyzing the area wise stats for that business and suggest him best place to start his business.Also we suggest various raw material provider which are required for entrepreneurs to build their business.    
			</p>

		<br>
		<p> <strong>Flow of Enterprenuer Module</strong> ::</p>

		<!--<ul class="list-1">
			<li>Executing the Food Service program, including preparing and presenting our wonderful food offerings
			to hungry customers on the go!
			</li>
			<li>Greeting customers in a friendly manner and suggestive selling and sampling items to help increase sales.</li>
			<li>Keeping our Store food area looking terrific and ready for our valued customers by managing product 
			inventory, stocking, cleaning, etc.</li>
			<li>We’re looking for associates who enjoy interacting with people and working in a fast-paced environment!</li>
		</ul>-->
		
		<br>

		<h4 class="margin-bottom-10">Process</h4>

		<ul class="list-1">
			<li>Our system will find area wise stats for the business.</li>
			<li>By analyzing location our system  will suggest best business to start in particular location.</li>
		</ul>

	</div>
	</div>


</div>


<!-- Footer
================================================== -->
<div class="margin-top-50"></div>


<div id="footer">
	<!-- Main -->
	

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				
				<div class="copyrights">&copy;  Copyright 2016 by <a href="#">NaukriDhanda.com</a>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/custom.js"></script>
<script src="scripts/jquery.superfish.js"></script>
<script src="scripts/jquery.themepunch.tools.min.js"></script>
<script src="scripts/jquery.themepunch.revolution.min.js"></script>
<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="scripts/jquery.flexslider-min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/jquery.magnific-popup.min.js"></script>
<script src="scripts/waypoints.min.js"></script>
<script src="scripts/jquery.counterup.min.js"></script>
<script src="scripts/jquery.jpanelmenu.js"></script>
<script src="scripts/stacktable.js"></script>
<script src="scripts/headroom.min.js"></script>






</body>

<!-- Mirrored from www.vasterad.com/themes/workscout/job-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:04 GMT -->
</html>