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

$getjobid=$_GET['jobid'];

        
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/green.css" id="colors">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
			<style type="text/css">
				#sidejob:hover{

					border-bottom: 1px solid red;
					border-top: 1px solid red;
				}
			</style>
			
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

				<li><a href="dashboard.php">Home</a>
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
				
				<h3>Job Description</h3>

					
			</div>
			<br>
			

		</div>

		
	</div>
</div>



<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="col-sm-7">
	<div class="padding-right">
		
		
		
		<ul id="job-list" class="job-list full">

       <?php
//$email=$_SESSION['email'];


  // $limit = 999999999;
       	 //include('operations/recommendation.php');


       //	 echo $key = array_search($getjobid, $recomd); 

          $statement = new Cassandra\SimpleStatement("SELECT * FROM jobs where jobid=$getjobid");
    		$result    = $session->execute($statement);  

                  
                 foreach ($result as $obj){

                 		if($obj['jobid']==$getjobid)
                 		{
                 	
                 	

       ?>

			<li><a>
				<div class="job-list-content">
					<h4><span class="full-time" style="background: #18b0c9;"><?php

						/*$matches = array();
						preg_match('/www([0-9]+)com/', $obj['link'], $matches);
						//preg_match('~//(\w+)\/~', $obj['link'], $m );
						var_dump($matches);*/
						$parse = parse_url($obj['link']);
						print $parse['host'];

					?>
						
					</span></h4>
					<h3 style="margin-bottom: 0px;margin-top: 0px;"><?php if($obj['jobtitle']!="") echo $obj['jobtitle']; else echo "Job Position Not Revealed";?></h3>
					<p style="margin-top: 0px;"><?php echo $obj['cmpname']; ?></p>
					<div class="job-icons">
						<h4><i class="fa fa-briefcase"></i> Experience : <?php echo $obj['experience']; ?></h4>
						<h4><i class="fa fa-map-marker"></i> Location : <?php echo $obj['cmplocation']; ?></h4>
						<h4><i class="fa fa-money"></i> Package : <?php if($obj['salary']=="") echo "Not Disclosed by Recruiter"; else echo trim($obj['salary']); ?></h4>
					</div>

					<h4>
					Required Skills : <br>
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
				<a target="_blank"  href="<?php echo $obj['link'];  ?>" style=""><h4 style=""><span class="full-time" style="font-size: 15px;background-color:#18c96f;padding-top: 10px;padding-bottom: 10px;float: right;">APPLY</span></h4></a>
				</a>

				<div class="clearfix"></div>
			</li>

			<?php
		}

		}
		//echo $pagination->createLinks(); 





       ?>
      

			

		</ul>
		<div class="clearfix"></div>

		<h3>Recommendations</h3>
<?php
		 $limit=12;
		 include('operations/recommendation.php');
		 shuffle($recomd);
		 $i=0;
		 foreach ($recomd as $obj){

		 	if($i==0)
		 		 echo "<div class='row'>";
		 ?>

		  <div id="sidejob" class="col-sm-4" style="">
		  <a href="viewjob.php?jobid=<?php echo $obj['jobid']; ?>">
		  	<h4><?php if($obj['jobtitle']!="") echo $obj['jobtitle']; else echo "Job Position Not Revealed";?></h4>
		  	<p><?php echo $obj['cmpname']; ?></p>
		  	<div class="job-icons">
						
						<span><i class="fa fa-map-marker"></i> Location : <?php echo $obj['cmplocation']; ?></span>
						
					</div>
		  </a>
		  </div>
		  

		  <?php 
		  $i++;
		  if($i==3)
		  {
		 		 echo "</div>";
		 		 $i=0;
		 		}
 			}
		  ?>

		

	</div>
	</div>


	<!-- Widgets -->
	<div class="col-sm-5">

		 <h3>Recommendations</h3>
<?php
		 $limit=15;
		 include('operations/recommendation.php');
		 shuffle($recomd);
		 foreach ($recomd as $obj){


		 ?>

		  <div id="sidejob" class="" style="padding: 10px;">
		  <a href="viewjob.php?jobid=<?php echo $obj['jobid']; ?>">
		  	<h4><?php if($obj['jobtitle']!="") echo $obj['jobtitle']; else echo "Job Position Not Revealed";?></h4>
		  	<p><?php echo $obj['cmpname']; ?></p>
		  </a>
		  </div>
		  

		  <?php 
 			}
		  ?>
		  
            
		
  		
		

		

		








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
