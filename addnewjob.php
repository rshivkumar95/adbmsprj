
<?php

include("config.php");

 if($_SESSION['login'] == 0)
   {
	    echo "<script type='text/javascript'>alert('You need to login first!'); window.location.href='my-account.php';</script>";  
   }


   $email=$_SESSION['email'];
   $query="SELECT * FROM `Company` WHERE `email`='$email'";
   $result=mysql_query($query)or die (mysql_error());
   if (mysql_num_rows($result)>0)
   {
       $row = mysql_fetch_assoc($result); 
    	{
           $Company_Id=$row["Company_id"];
           $Company_Name=$row["Company_Name"];
    	}
   }

    		 
 			
if(isset($_POST['submit']))
{

					$Job_Title=$_POST['Job_Title'];
					$Job_location=$_POST['Job_Location'];
					$Salary=$_POST['Salary'];
					$Experiance=$_POST['Experiance'];
					$Skills=$_POST['Skills'];
					$Job_Description=$_POST['Job_Description'];
					$Closing_Date=$_POST['Closing_Date'];
					$Job_Type=$_POST['Job_Type'];
					$Posted_Date=date("Y/m/d");
					
					
					
			
                         
		$query1 = "INSERT INTO `Addjob` (Company_Id,Job_Title,Job_location,Job_Type,Salary,Experiance,Skills,Job_Description,Posted_Date,Closing_Date,Company_Name) VALUES ('$Company_Id','$Job_Title','$Job_location','$Job_Type','$Salary','$Experiance','$Skills','$Job_Description','$Posted_Date','$Closing_Date','$Company_Name')";  
          $res1 = mysql_query($query1);
          if($res1)
            {
              echo "<script type='text/javascript'>alert('Job Added !'); window.location.href='dashboard-company.php';</script>";  
            }
			else
			{
				echo "Ohh Noo Error!!!";
			}
					
	}			
				





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


			
              <ul class="responsive float-right">
				<li><a href="logout.php"><i class="fa fa-user"></i>Logout</a></li>
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

<!-- Titlebar
================================================== -->
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i> Add Job</h2>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">

			<!-- Notice -->
			 <form method="POST" action="<?=$_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

			<!-- Title -->
			<div class="form">
				<h5>Job Title</h5>
				<input class="search-field" Name="Job_Title" type="text" placeholder="" required="" value=""/>
			</div>

			
			<!-- Skill -->
			<div class="form">
				<h5>Required Skills</h5>
				<input class="search-field" Name="Skills" type="text" placeholder="skills seperated by comma" required="" value=""/>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Location </h5>
				<input class="search-field" type="text" Name="Job_Location" placeholder="e.g. London" required="" value="">
			</div>

			<!-- Job Type -->
			<div class="form">
				<h5>Job Type</h5>
				<select data-placeholder="Full-Time" name="Job_Type" class="chosen-select-no-single" required="">
					<option>Full-Time</option>
					<option>Part-Time</option>
					<option>Internship</option>
					<option>Freelance</option>
				</select>
			</div>

			<!-- Salary -->
			<div class="form">
				<h5>Salary </h5>
				<input class="search-field" type="text" Name="Salary" placeholder="" required="" value="">
			</div>

			<!-- Experiance -->
			<div class="form">
				<h5>Experiance </h5>
				<input class="search-field" type="text" Name="Experiance" placeholder="" required="" value="">
			</div>

			
			<!-- Description -->
			<div class="form">
				<h5>Job Description</h5>
				<textarea class="WYSIWYG" name="Job_Description" cols="40" rows="3" id="summary" spellcheck="true" required=""></textarea>
			</div>


			<!-- TClosing Date -->
			<div class="form">
				<h5>Closing Date <span>(optional)</span></h5>
				<input data-role="date" type="text" name="Closing_Date" placeholder="yyyy-mm-dd">
			</div>


		     
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
