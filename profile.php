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

//$getjobid=$_GET['jobid'];

        
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
				
				<li><a href="profile.php" id="current">Profile</a>
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

	

  

?>

<!-- Profile photo
================================================== -->
<div  class="resume" style="background: none repeat scroll 0% 0% rgba(242, 242, 242, 1);padding:20px;">
	<div class="container">
		<div class="nine columns">
			<div class="resume-titlebar">
				
				<h3>My Profile</h3>

					
			</div>
			<br>
			

		</div>

		
	</div>
</div>



<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="col-sm-12">
	<div class="padding-right">
		
		
		
		<ul id="job-list" class="job-list full">

       <?php
//$email=$_SESSION['email'];


  // $limit = 999999999;
       	 //include('operations/recommendation.php');


       //	 echo $key = array_search($getjobid, $recomd); 

          $result = $session->execute(new Cassandra\SimpleStatement("SELECT * from naukridhanda.resumes WHERE email='$email' ;"));

                  
                // foreach ($result as $obj){

            ?>


            <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <h4 style="margin: 0;">Profile Photo</h4>
            	<img src="<?php echo $result[0]["photo"]; ?>" style="height:200px;width:200px;margin: 0;padding: 0;">
            </div>
            <div class="col-sm-4">
            </div>
                
            	
            </div>

            <div class="row"> 
            	<h5>Name : <strong><?php echo $result[0]["name"]; ?></strong></h5>
            	<h5 style="margin:0;">Position : <strong><?php echo $result[0]["jobtitle"]; ?></strong></h5>
            	<h5 style="margin:0;">Location : <strong><?php echo $result[0]["location"]; ?></strong></h5>
            	<h5 style="margin:0;">Email: <strong><?php echo $result[0]["email"]; ?></strong></h5>
            	<div class="skills">
						<?php
						$skills=explode(',',$result[0]["skill"]);
						
						foreach($skills as $skill)
						{
							
							echo "<span>".$skill."</span>";
						}
                        ?>

						
					</div>

					<?php
						/*$eduid=$email."%";
						$edu = $session->execute(new Cassandra\SimpleStatement("SELECT * from naukridhanda.education WHERE eduid>='$eduid' ;"));

						foreach ($edu as $edu1) {

							var_dump($edu1);
							# code...
						}*/
					?>
            </div>
            


<?php
//}
?>

		

		

	</div>
	</div>


	<!-- Widgets -->
	
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
