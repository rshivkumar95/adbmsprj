
<?php


session_start();
echo $userid=$_SESSION['userid'];
print_r($_SESSION);
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
	$target_path = "images/dp/".$imagename;
	  }

		if(!(GetImageExtension($imgtype)))
		{
     		 echo "invalid image !(only bmp,gif,jpg,png images supported)";
		}

	else
	{
		if(move_uploaded_file($temp_name, $target_path)) 
		{

				 	include("config.php");
				 	$JobSeeker_Name=$_POST['JobSeeker_Name'];
				 	$Job_title=$_POST['Job_title'];
					$JobSeeker_Location=$_POST['JobSeeker_Location'];
					$JobSeeker_Photo=$target_path;
					$Skills=$_POST['Skills'];
					$email=$_SESSION['email'];
					$userid=$_SESSION['userid'];
                    $query = "UPDATE `resumes` SET name='$JobSeeker_Name',job_title='$jobtitle',location='$JobSeeker_Location',photo='$JobSeeker_Photo',skill='$Skills',email='$email' WHERE `user_id`='$userid'";

                     $res = mysql_query($query) or die(mysql_error());
                     if($res)
                     {
                     	$query= "SELECT * FROM `resumes` ORDER BY user_id DESC LIMIT 1";
                     	$res=mysql_query($query);
                     	$result=mysql_fetch_array($res);
                     	$JobSeekerId=$result['user_id'];
                     	for($i=0;$i<count($_POST['schoolname']);$i++)
                     	{
                     		$schoolname=$_POST['schoolname'][$i];
							$qualification=$_POST['qualification'][$i];
							$date=$_POST['date'][$i];
							$desc=$_POST['desc'][$i];

							$query="INSERT INTO `education`(`user_id`, `school_name`, `qualification`, `end_date`, `notes`) VALUES ('$JobSeekerId','$schoolname','$qualification','$date','$desc')";
							$res=mysql_query($query) or die(mysql_error());
                     	}

                     	for($i=0;$i<count($_POST['employer']);$i++)
                     	{
                     		$employer=$_POST['employer'][$i];
							$jobtitle=$_POST['jobtitle'][$i];
							$date11=$_POST['date11'][$i];
							$desc11=$_POST['desc11'][$i];

							$query="INSERT INTO `experiance`(`user_id`, `employer`, `job_title`, `end_date`, `notes`) VALUES ('$JobSeekerId','$employer','$jobtitle','$date11','$desc11')";
							$res=mysql_query($query) or die(mysql_error());
							
					
                     	}

						$query="UPDATE `register` SET `isC`='YES' WHERE `email`='$email'";
                        $res=mysql_query($query) or die(mysql_error());

                        if($res)
                        {
                        	
                        }

                     	 
                     	

                     	echo "<script>alert('Data inserted Successfully!!');window.location.href='dashboard.php'</script>";
                     	//echo " Data inserted";
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
<link rel="stylesheet" href="css/jquery.tag-editor.css">

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


<!-- Header
================================================== 
<header class="sticky-header">
<div class="container">
	<div class="sixteen columns">

		
		<div id="logo">
			<h1><a href="index-2.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

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
						<li><a href="resume-page.php">Resume Page</a></li>
						<li><a href="shortcodes.html">Shortcodes</a></li>
						<li><a href="icons.html">Icons</a></li>
						<li><a href="pricing-tables.html">Pricing Tables</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</li>

				<li><a href="#" id="current">For Candidates</a>
					<ul>
						<li><a href="browse-jobs.html">Browse Jobs</a></li>
						<li><a href="browse-categories.html">Browse Categories</a></li>
						<li><a href="add-resume.html">Add Resume</a></li>
						<li><a href="manage-resumes.html">Manage Resumes</a></li>
						<li><a href="job-alerts.html">Job Alerts</a></li>
					</ul>
				</li>

				<li><a href="#">For Employers</a>
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

		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>-->
<div class="clearfix"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i> Add Resume</h2>
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


			<!-- Linked In -->
			<div class="form">
				
				<a class="button linkedin-btn">Complete your profile</a>
			</div>

			<!-- Email -->
			<div class="form">
				<h5>Your Name</h5>
				<input class="search-field" name="JobSeeker_Name" type="text" placeholder="Your full name" required="" />
			</div>

			
			<!-- job_title -->
			<div class="form">
				<h5>Current Position</h5>
				<input class="search-field" name="Job_title" type="text" placeholder="Eg. software developer " required="" />
			</div>



			<!-- Location -->
			<div class="form">
				<h5>City</h5>
				<input class="search-field" name="JobSeeker_Location" type="text" placeholder="e.g. Pune" required="" />
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
				<input class="search-field" id="Skills" name="Skills" style="text-transform: uppercase;" type="text" placeholder="Eg. PHP, MYSQL" required="" />
			</div>

			<!-- Education -->
			<div class="form with-line">
				<h5>Education <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Education -->
					<div id="Education">
					<div class="form boxed">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" id="schoolname1" name="schoolname[]" type="text" placeholder="School Name" value=""/>
						<input class="search-field" id="qualification1" name="qualification[]" type="text" placeholder="Qualification(s)" value=""/>
						<input class="search-field" id="date1" name="date[]" type="text" placeholder="Completion Year" value=""/>
						<textarea name="desc[]" id="desc1" cols="30" rows="10" placeholder="Notes (optional)"></textarea>
					</div>
					</div>

					<a class="button gray" onclick="addEducation('Education');"><i class="fa fa-plus-circle"></i> Add Education</a>
				</div>
			</div>


			<!-- Experience  -->
			<div class="form with-line">
				<h5>Experience <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Experience -->
					<div id="Experience">
					<div class="form boxed">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" id="employer1" name="employer[]" type="text" placeholder="Company" value=""/>
						<input class="search-field" id="jobtitle1" name="jobtitle[]" type="text" placeholder="Job Title" value=""/>
						<input class="search-field" id="date1" name="date11[]" type="text" placeholder="Duration (Eg. 1 Year)" value=""/>
						<textarea name="desc11[]" id="desc1" cols="30" rows="10" placeholder="Notes (optional)"></textarea>
					</div>
                    </div>
					<a class="button gray" onclick="addExperience('Experience')"><i class="fa fa-plus-circle"></i> Add Experience</a>
				</div>
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
	          newdiv.innerHTML += "<input class='search-field' id='date"+(counter+1)+"' name='date[]' type='text' placeholder='Completion Year' value=''/>";
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
	          newdiv.innerHTML = "<input class='search-field' id='employer1"+(counter+1)+"' name='employer[]' type='text' placeholder='Company' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='jobtitle1"+(counter+1)+"' name='jobtitle[]' type='text' placeholder='jobtitle' value=''/>";
	          newdiv.innerHTML += "<input class='search-field' id='date1"+(counter+1)+"' name='date11[]' type='text' placeholder='Duration (Eg. 1 Year)' value=''/>";
	          newdiv.innerHTML += "<textarea name='desc11[]' id='desc"+(counter+1)+"' cols='30' rows='10' placeholder='Notes (optional)'></textarea>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }
      }
   </script>

   <script>
   	 $(function() {
            
            $('Skills').tagEditor({
                placeholder: 'Enter tags ...',
                autocomplete: { source: googleSuggest, minLength: 3, delay: 250, html: true, position: { collision: 'flip' } }
            });

            
            });
   </script>


<!-- Scripts
================================================== -->
<script src="js/jquery.caret.min.js"></script>
    <script src="js/jquery.tag-editor.js"></script>

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

</html>
