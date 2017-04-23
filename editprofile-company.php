<?php

include("config.php");

if(isset($_POST['submit']))
{
	

   function GetImageExtension($imagetype)
   	 {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
     }

	 
	 
	 
   if (!empty($_FILES["Company_Logo"]["name"])) {

	$file_name=$_FILES["Company_Logo"]["name"];
	$temp_name=$_FILES["Company_Logo"]["tmp_name"];
	$imgtype=$_FILES["Company_Logo"]["type"];
	$ext= GetImageExtension($imgtype);
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path = "images/".$imagename;
	  }

if(!(GetImageExtension($imgtype)))
{
      echo "invalid image !(only bmp,gif,jpg,png images supported)";
}

else
{
				if(move_uploaded_file($temp_name, $target_path)) {

				 	
                  
					
					$Company_Website=$_POST['Company_Website'];
					$Company_Details=$_POST['Company_Details'];
					$Company_Headquarter=$_POST['Company_Headquarter'];
					$Company_Type=$_POST['Company_Type'];
					$Company_Number=$_POST['Company_Number'];
					$Company_Twittername=$_POST['Company_Twittername'];
					$Company_Size=$_POST['Company_Size'];
					$Company_Specialities=$_POST['Company_Specialities'];
					$Company_Logo=$target_path;
					$email=$_SESSION['email'];
 					
                    //$query1="UPDATE `Company` SET `Company_Website`='$Company_Website',`Company_Details`='$Company_Details',`Company_Headquarter`='$Company_Headquarter',`Company_Type`='$Company_Type',`Company_Number`='$Company_Number',`Company_Twittername`='$Company_Twittername',`Company_Size`='$Company_Size',`$Company_Specialities`='$Company_Specialities',`Company_Logo`='$Company_Logo' WHERE `email`='$email'";
					$query1="UPDATE `Company` SET `Company_Website`='$Company_Website',`Company_Details`='$Company_Details',`Company_Headquarter`='$Company_Headquarter',`Company_Type`='$Company_Type',`Company_Number`='$Company_Number',`Company_Twittername`='$Company_Twittername',`Company_Size`='$Company_Size',`Company_Specialities`='$Company_Specialities',`Company_Logo`='$Company_Logo' WHERE `email`='$email'";
                    $res1 = mysql_query($query1);
                     if($res1)
                        {
                        	   echo "<script type='text/javascript'>alert('PROFILE UPDATED!'); window.location.href='dashboard-company.php';</script>";  
                        }

          		
				}
				else
				{

				   exit("Error While adding Company");
				} 

}

}

/*$email=$_SESSION['email'];

$query="SELECT * FROM `Company` WHERE `email`='$email'";
 //$query="SELECT * FROM buildprofile WHERE `email`='$email'";
  $result=mysql_query($query) or die (mysql_error());
   
  if (mysql_num_rows($result)>0)
   {
    
   $row = mysql_fetch_assoc($result);
    {*/


?>






<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/workscout/add-job.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:23 GMT -->
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

</head>

<body>
<div id="wrapper">



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

				<li><a href="index.php" id="current">Training</a>
				</li>

				<li><a href="#">Applied Jobs</a>
					<!--<ul>
						<li><a href="job-seeker.php">For Job Seekers</a></li>
						<li><a href="employer.php">For Employers</a></li>
						<li><a href="Enterprenuer.php">For Enterpreneur</a></li>
						<li><a href="training-providers.php">For Training Provider</a></li>
						
					</ul>-->
				</li>

				<li><a href="career-path.php">Career Path</a>
				</li>
				
				<li><a href="companies.php">Companies</a>
				</li>
				<li><a href="about-us.php">Edit profile</a>
				</li>

				
			</ul>

              <?php
              		if($_SESSION['login'] = 1)
              			{
              			
              ?>
              <ul class="responsive float-right">
				<li><a href="logout.php"><i class="fa fa-user"></i>Logout</a></li>
				<?php
					}
					else{
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
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i>Update Profile (Company)</h2>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">

            <form method="POST" action="<?=$_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">



		<!-- Company Details -->
			<div class="divider"><h3>Company Details</h3></div>

			

			<!-- Website -->
			<div class="form">
				<h5>Website <span>(optional)</span></h5>
				<input type="text" name="Company_Website" placeholder="http://" required="">
			</div>

			<!-- Company Details  -->
			<div class="form">
				<h5>Company Details </h5>
				<textarea name="Company_Details" cols="40" rows="3" id="comment" spellcheck="true" required=""></textarea>
			</div>

                        <!-- company Headquarter -->
			<div class="form">
				<h5>Company Headquarter </h5>
				<input type="text" name="Company_Headquarter" placeholder="Enter the headquarter of company" required="">
			</div>
                           
                        <!-- company Type -->
			<div class="form">
				<h5>Company Type </h5>
				<input type="text" name="Company_Type" placeholder="Enter type of company" required="">
			</div>

                        <!-- Company Contact number -->
			<div class="form">
				<h5>Contact number </h5>
				<input type="text" name="Company_Number" placeholder="Enter 10 digit number" required="">
			</div>

                        <!-- Twitter -->
			<div class="form">
				<h5>Twitter Username <span>(optional)</span></h5>
				<input type="text" name="Company_Twittername" placeholder="@yourcompany">
			</div>

                         <!-- company Size -->
			<div class="form">
				<h5>Company Size </h5>
				<input type="text" name="Company_Size" placeholder="Enter no of people work in company" required="">
			</div>

                        

                        <!-- company Specialities -->
			<div class="form">
				<h5>Company Specialities </h5>
				<textarea name="Company_Specialities" cols="40" rows="3" id="comment" spellcheck="true" required="" ></textarea>
			</div>

			<!-- Logo -->
			<div class="form">
				<h5>Logo</h5>
				
				    <input type="file" name="Company_Logo" required=""/>
				    <i class="fa fa-upload"></i> 
				
				
				
			</div>


			<div class="divider margin-top-0"></div>
			<input type="submit" name="submit" class="button big margin-top-5" value="Submit" >
			
         
           </form>

		</div>
	</div>

</div>





<!-- Footer
================================================== -->
<div class="margin-top-60"></div>


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


<!-- WYSIWYG Editor -->
<script type="text/javascript" src="scripts/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript" src="scripts/jquery.sceditor.js"></script>


<!-- Style Switcher
================================================== -->



</body>

<!-- Mirrored from www.vasterad.com/themes/workscout/add-job.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:23 GMT -->
</html>


