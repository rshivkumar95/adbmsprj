s
<?php
/*
if($_SESSION['login']==1)
{
	header("location:my-account.php");

}
*/

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

				 	include("config.php");

                  
					$Company_Name=$_POST['Company_Name'];
					$Company_Website=$_POST['Company_Website'];
					$Company_Details=$_POST['Company_Details'];
					$Company_Headquarter=$_POST['Company_Headquarter'];
					$Company_Type=$_POST['Company_Type'];
					$Company_Number=$_POST['Company_Number'];
					$Company_Twittername=$_POST['Company_Twittername'];
					$Company_Size=$_POST['Company_Size'];
					$Company_Found_In=$_POST['Company_Found_In'];
					$Company_Specialities=$_POST['Company_Specialities'];
					$Company_Logo=$target_path;
					$email=$_SESSION['email'];
 					
                         
					$query = "INSERT INTO `Company` (Company_Name,Company_Website,Company_Details,Company_Headquarter,Company_Type,Company_Number,Company_Twittername,Company_Size,Company_Found_In,Company_Specialities,Company_Logo,email) VALUES ('$Company_Name','$Company_Website','$Company_Details','$Company_Headquarter','$Company_Type','$Company_Number','$Company_Twittername','$Company_Size','$Company_Found_In','$Company_Specialities','$Company_Logo','$email')";  
          $res = mysql_query($query);
          if($res)
            {
            	$query1="UPDATE `register` SET `isC`='YES' WHERE `email`='$email'";
                        $res1=mysql_query($query1) or die(mysql_error());

                        if($res1)
                        {
                        	echo "inserted";
                        }

              
              echo "<script type='text/javascript'>alert('Company Added !'); window.location.href='dashboard-company.php';</script>";  
              
            }
			else
			{
				echo "Ohh Noo";
			}		
					
				}
				else
				{

				   exit("Error While adding Company");
				} 

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
			<h1><a href="index-2.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="index-2.html">Home</a>
					<ul>
						<li><a href="index-2.html">Home #1</a></li>
						<li><a href="index-3.html">Home #2</a></li>
						<li><a href="index-4.html">Home #3</a></li>
						<li><a href="index-5.html">Home #4</a></li>
						<li><a href="index-6.html">Home #5</a></li>
					</ul>
				</li>

				<li><a href="#">Pages</a>
					<ul>
						<li><a href="job-page.html">Job Page</a></li>
						<li><a href="job-page-alt.html">Job Page Alternative</a></li>
						<li><a href="resume-page.html">Resume Page</a></li>
						<li><a href="shortcodes.html">Shortcodes</a></li>
						<li><a href="icons.html">Icons</a></li>
						<li><a href="pricing-tables.html">Pricing Tables</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</li>

				<li><a href="#">For Candidates</a>
					<ul>
						<li><a href="browse-jobs.html">Browse Jobs</a></li>
						<li><a href="browse-categories.html">Browse Categories</a></li>
						<li><a href="add-resume.html">Add Resume</a></li>
						<li><a href="manage-resumes.html">Manage Resumes</a></li>
						<li><a href="job-alerts.html">Job Alerts</a></li>
					</ul>
				</li>

				<li><a href="#" id="current">For Employers</a>
					<ul>
						<li><a href="add-job.html">Add Job</a></li>
						<li><a href="manage-jobs.html">Manage Jobs</a></li>
						<li><a href="manage-applications.html">Manage Applications</a></li>
						<li><a href="browse-resumes.html">Browse Resumes</a></li>
					</ul>
				</li>

				<li><a href="blog.html">Blog</a></li>
			</ul>


			<ul class="responsive float-right">
				<li><a href="my-account.html#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="my-account.html"><i class="fa fa-lock"></i> Log In</a></li>
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
			<h2><i class="fa fa-plus-circle"></i>  Company Registration</h2>
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
			<div class="notification notice closeable margin-bottom-40">
				<p><span>Have an account?</span> If you don’t have an account you can create one below by entering your email address. A password will be automatically emailed to you.</p>
			</div>


            <form method="POST" action="<?=$_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">



		<!-- Company Details -->
			<div class="divider"><h3>Company Details</h3></div>

			<!-- Company Name -->
			<div class="form">
				<h5>Company Name</h5>
				<input type="text" name="Company_Name" placeholder="Enter the name of the company" required="">
			</div>

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

                        <!-- company founded in -->
			<div class="form">
				<h5>Company founded in </h5>
				<input type="text" name="Company_Found_In" placeholder="Enter year when company founded in" required="">
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


