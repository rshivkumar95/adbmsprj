
<?php

include("config.php");
session_start();

if($_SESSION['login']==1)
{
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
	

	 if (!empty($_FILES["JobSeeker_Photo"]["name"])) {
	$file_name=$_FILES["JobSeeker_Photo"]["name"];
	$temp_name=$_FILES["JobSeeker_Photo"]["tmp_name"];
	$imgtype=$_FILES["JobSeeker_Photo"]["type"];
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
		if(move_uploaded_file($temp_name, $target_path)) 
		{

				 	
				 	
				 	$Job_title=$_POST['Job_title'];
					$JobSeeker_Location=$_POST['JobSeeker_Location'];
					$JobSeeker_Photo=$target_path;
					$Skills=$_POST['Skills'];
					$email=$_SESSION['email'];

                   // $query = "INSERT INTO `buildprofile` (name,job_title,location,photo,skill,email) VALUES ('$JobSeeker_Name','$Job_title','$JobSeeker_Location','$JobSeeker_Photo','$Skills','$email')";
					$query1="UPDATE `buildprofile` SET `job_title`='$Job_title',`location`='$JobSeeker_Location',`photo`='$JobSeeker_Photo',`skill`='$Skills'  WHERE `email`='$email' ";

                     $res1 = mysql_query($query1) or die(mysql_error());

                     if($res1)
                     {
                     	echo "<script>alert('profile updated');window.location.href='dashboard-jobseeker.php'</script>";
                     }
                     else
                     {
                     	echo "Error";
                     }
                    
		}
	}



}



}




?>



<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/workscout/add-resume.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:22 GMT -->
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
			<h2><i class="fa fa-plus-circle"></i>Update Profile</h2>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">

			
              <form method="POST"  enctype="multipart/form-data">

			

			
			<!-- job_title -->
			<div class="form">
				<h5>Job_Title</h5>
				<input class="search-field" name="Job_title" type="text" placeholder="software developer " required="" />
			</div>



			<!-- Location -->
			<div class="form">
				<h5>Location</h5>
				<input class="search-field" name="JobSeeker_Location" type="text" placeholder="e.g. London, UK" required="" />
			</div>

		     <!-- Photo -->
			<div class="form">
				<h5>Photo<span>(Optional)</span></h5>
				    <input type="file" name="JobSeeker_Photo" />
				    <i class="fa fa-upload"></i> 
			</div>

            <!-- Skills -->
			<div class="form">
				<h5>Skills</h5>
				<input class="search-field" name="Skills" type="text" placeholder="enter comma after every skill" required="" />
			</div>



			
			<div class="divider margin-top-0"></div>
			<input type="submit" name="submit" class="button big margin-top-5" value="submit" >
			
         
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


<script type="text/javascript">
    
      
      function addEducation(divName)
      {
      	var counter = 1;
        var limit = 5;
	     if (counter == limit)  
	     {
	          alert("You have reached the limit of adding " + counter + " inputs");
	     }
	     else 
	     {


	          var newdiv = document.createElement('div');
	          newdiv.className = "form boxed";
	          newdiv.innerHTML="<a href='#' class='close-form remove-box button'><i class='fa fa-close'></i></a>";
	          newdiv.innerHTML = "<input class='search-field' id='schoolname"+(counter+1)+"' name='schoolname[]' type='text' placeholder='School Name' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='qualification"+(counter+1)+"' name='qualification[]' type='text' placeholder='Qualification(s)' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='date"+(counter+1)+"' name='date[]' type='text' placeholder='Start / end date' value=''/>";
	          newdiv.innerHTML += "<textarea name='desc[]' id='desc"+(counter+1)+"' cols='30' rows='10' placeholder='Notes (optional)'></textarea>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }
      }


      function addExperience(divName)
      {
      	var counter = 1;
        var limit = 5;
	     if (counter == limit)  
	     {
	          alert("You have reached the limit of adding " + counter + " inputs");
	     }
	     else 
	     {


	          var newdiv = document.createElement('div');
	          newdiv.className = "form boxed";
	          newdiv.innerHTML="<a href='#' class='close-form remove-box button'><i class='fa fa-close'></i></a>";
	          newdiv.innerHTML = "<input class='search-field' id='employer1"+(counter+1)+"' name='employer[]' type='text' placeholder='Employer' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='jobtitle1"+(counter+1)+"' name='jobtitle[]' type='text' placeholder='jobtitle' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='date1"+(counter+1)+"' name='date11[]' type='text' placeholder='Start / end date' value=''/>";
	          newdiv.innerHTML += "<textarea name='desc11[]' id='desc"+(counter+1)+"' cols='30' rows='10' placeholder='Notes (optional)'></textarea>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }
      }
   </script>


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

<!-- Mirrored from www.vasterad.com/themes/workscout/add-resume.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:23 GMT -->
</html>
