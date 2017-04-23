<?php

session_start();

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);


$email=$_SESSION['email'];
if($_SESSION['login']!=1)
{
	 echo "<script>window.location.href='login.php'</script>";	
}


        
?>



<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/workscout/browse-jobs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:21 GMT -->
<head>

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

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

				<li><a href="dashboard.php" id="current">Home</a>
				</li>
				<li><a href="jobs.php">Jobs</a>
				</li>
				
				<li><a href="profile.php">Profile</a>
				</li>
				<li><a href="analysis.php">Analysis</a>
				</li>

				
			</ul>

           
			<ul class="responsive float-right">
				<?php
					if($_SESSION['login']!=1)
					{
           		?>
				<li><a href="login.php#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="login.php"><i class="fa fa-lock"></i> Log In</a></li>
				<?php
					}
					else
					{
				?>
				<li><a href="logout.php"><i class="fa fa-user"></i>Logout</a></li>
					
           		<?php

					}
				?>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>
<?php

	$result = $session->execute(new Cassandra\SimpleStatement("SELECT * from naukridhanda.resumes WHERE email='$email' ;"));

  

?>

<!-- Profile photo
================================================== -->
<div  class="resume" style="background: none repeat scroll 0% 0% rgba(242, 242, 242, 1);padding:20px;">
	<div class="container">
		<div class="nine columns">
			<div class="resume-titlebar">
				<style>
				    img.one {
                   height: 150px;
                   width: 110px;
                    }
                </style>
                   <img class="one" src="<?php echo $result[0]["photo"]; ?>"><br><br>
	            
				 <div class="resumes-list-content">
					<h4><?php echo $result[0]["name"]; ?><span><?php echo $result[0]["jobtitle"]; ?> </span></h4>
					<span class="icons"><i class="fa fa-map-marker"></i><?php echo $result[0]["location"]; ?></span>
					<span class="icons"><a href=""><i class="fa fa-envelope"></i> <?php echo $result[0]["email"]; ?></span>
				
					<div class="skills">
						<?php
						$skills=explode(',',$result[0]["skill"]);
						
						foreach($skills as $skill)
						{
							
							echo "<span>".$skill."</span>";
						}
                        ?>

						
					</div>
                    

					

				</div>

					
			</div>
			<br>
			

		</div>

		
	</div>
</div>



<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="ten columns">
	<div class="padding-right">
		
		
		<h3>Recommended Jobs For You</h3>
		<ul id="job-list" class="job-list full">

       <?php
$email=$_SESSION['email'];


    $limit = 10;
       	 include('operations/recommendation.php');




            

                  
                 foreach ($recomd as $obj){


                 	
                 	

       ?>

			<li><a href="viewjob.php?jobid=<?php echo $obj['jobid']; ?>">
				<div class="job-list-content">
					<h4 style="margin-bottom: 0px;"><?php if($obj['jobtitle']!="") echo $obj['jobtitle']; else echo "Job Position Not Revealed";?></h4>
					<p style="margin-top: 0px;"><?php echo $obj['cmpname']; ?></p>
					<div class="job-icons">
						<span><i class="fa fa-briefcase"></i><?php echo $obj['experience']; ?></span>
						<span><i class="fa fa-map-marker"></i><?php echo $obj['cmplocation']; ?></span>
						<span><i class="fa fa-money"></i><?php if($obj['salary']=="") echo "Not Disclosed by Recruiter"; else echo trim($obj['salary']); ?></span>
					</div>

					<h4>
                    <?php
                              
                              $skills=explode(',', $obj['skills']);

                              foreach ($skills as $skill) {
                              	


                    ?>


					<span class="full-time"><?php echo $skill; ?></span>
                    <?php

                     }
                    ?>

					</h4>
				</div>
				</a>
				<div class="clearfix"></div>
			</li>

			<?php

		}
		//echo $pagination->createLinks(); 





       ?>
      

			

		</ul>
		<div class="clearfix"></div>


		

	</div>
	</div>


	<!-- Widgets -->
	<div class="four columns">

		
  		<div class="row">
  				<div id="skills">Skills Chart</div>
  		</div>
		

		

		








	</div>
	<!-- Widgets / End -->


</div>


<!-- Footer
================================================== -->
<div class="margin-top-25"></div>


<div id="footer" style="padding: 0">
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



<script src="operations/fusionchart/js/jquery-3.2.1.min.js"></script>
	  <script src="operations/fusionchart/js/fusioncharts.js"></script>
	  <script src="operations/fusionchart/js/fusioncharts.charts.js"></script>
	  <script src="operations/fusionchart/js/themes/fusioncharts.theme.ocean.js"></script>
	  <script src="operations/fusionchart/js/themes/fusioncharts.theme.zune.js"></script>
	  <script src="operations/fusionchart/js/themes/fusioncharts.theme.carbon.js"></script>

<script src="operations/skills.js"></script>


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


<!-- Style Switcher
================================================== -->



</body>

<!-- Mirrored from www.vasterad.com/themes/workscout/browse-jobs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:21 GMT -->
</html>