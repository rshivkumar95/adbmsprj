
<?php

session_start();

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);



if($_SESSION['login']==1)
{
	  echo "<script>window.location.href='dashboard.php'</script>";	
}


if(isset($_POST['login']))
{
	

                  
					$email=$_POST['email'];
					$password=$_POST['password'];
					
					
					/*$query="SELECT * FROM register where email='$email'";
					$res = mysql_query($query) or die(mysql_error());


					while ($row = mysql_fetch_array ($res))
					{
						print_r($row);
						if($password==$row['password'] && $row['isC']=="NO")
						{
							
							if($row['user']=="JobSeeker")
							{
								   $regid=$row['id'];
								   $query1="SELECT * FROM `resumes` WHERE `reg_id`='$regid'";
								   $res1=mysql_query($query1) or die(mysql_error());
								   $data=mysql_fetch_assoc($res1);
								   //print_r($data);
								  $regid=$data['user_id'];
								  $_SESSION['userid']=$regid;
								  // $_SESSION['userid'];
								// echo $regid;
								   $_SESSION['login'] = 1;
								   $_SESSION['email']=$email;
								    $_SESSION['user_type']=$row['user'];
								//echo "JobSeeker";
								  //  print_r($_SESSION);
								

								echo "<script>alert('Login Successfull!!');window.location.href='buildresume.php'</script>";
							}
							else if($row['user']="Company")
							{
							    echo "<script>alert('Login Successfull!!');window.location.href='buildcompany.php'</script>";

							}

						}*/

						/*elseif ($password==$row['password'] && $row['isC']=="YES") 
						{//
							$_SESSION['login'] = 1;
							$_SESSION['email']=$email;
							$_SESSION['user_type']=$row['user'];
							echo $regid=$row['id'];
						   /* $query1="SELECT * FROM `resumes` WHERE `reg_id`='$regid'";
								   $res1=mysql_query($query1) or die(mysql_error());
								   $data=mysql_fetch_assoc($res1);
								   //print_r($data);
								  $regid=$data['user_id'];
								  $_SESSION['userid']=$regid;
							
							echo "<script>alert('Login Successfull!!');window.location.href='dashboard.php'</script>";
								
						}*/

						$result = $session->execute(new Cassandra\SimpleStatement("SELECT * from naukridhanda.register WHERE email='$email' ;"));

                    	if($result->count()!=0)
                    	{
                    		if($password==$result[0]['password'])
                    		{
                    			$_SESSION['email']=$email;
                    			$_SESSION['login'] = 1;

                    			if($result[0]['isc']=='NO')
                    			{
                    				echo "<script>window.location.href='buildprofile.php'</script>";
                    			}
                    			else
                    			{
                    				echo "<script>window.location.href='dashboard.php'</script>";
                    			}

                    		}
                    		else
                    		{

                        	echo "<script>alert('Wrong Password!!');window.location.href='login.php'</script>";

                    		}

                    	}
                        else
                        {
                        	echo "<script>alert('Wrong Email ID!!');window.location.href='login.php'</script>";
                        }
						
					

					
}



if(isset($_POST['register1']))
{
	include("config.php");

                  
					$email=$_POST['email1'];
					$user=$_POST['user1'];
					$password=$_POST['password1'];
					$repeat_password=$_POST['password2'];

                    if ($password!=$repeat_password) 
                    {
                    	# code...
                    	echo "<script>alert('Error ! Password Not Match !');window.location.href='login.php'</script>";
                    }
                    else
                    {
                    	$result = $session->execute(new Cassandra\SimpleStatement("SELECT * from naukridhanda.register where email='$email';"));

                    	if($result->count()==0)
                    	{

						$statement = $session->execute(new Cassandra\SimpleStatement("INSERT INTO register (email,isC,password) VALUES ('$email','NO','$password')")); 

						$statement = $session->execute(new Cassandra\SimpleStatement("INSERT INTO resumes (email) VALUES ('$email')")); 
													
							
							echo "<script>alert('Registered Successfully!!');window.location.href='login.php'</script>";
						
						}
						else
						{
							echo "<script>alert('Email Already Registered !');window.location.href='login.php';</script>";
						}
					}

}


?>


<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>


<!-- Map -->
<style>
           #map {
        height: 400px;
        width: 100%;
       }
    </style>
    


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
			 


			<!--<ul class="responsive float-right">
				<li><a href="login.php"><i class="fa fa-lock"></i> Log In</a></li>
			</ul>-->

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
<div id="titlebar" class="single" style="padding: 25px;">
	<div class="container">

		<div class="sixteen columns">
			<h2>Sign Up / Login</h2>
			
		</div>

	</div>
</div>


<!-- Content
================================================== -->

<!-- Container -->
<div class="container">

	<div class="my-account">

		<ul class="tabs-nav">
			<li class=""><a href="#tab1">Login</a></li>
			<li><a href="#tab2">Register</a></li>
		</ul>

		<div class="tabs-container">
			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">
				<form method="post" class="login">

					<p class="form-row form-row-wide">
						<label for="email">Email:
							<i class="ln ln-icon-Male"></i>
							<input type="email" class="input-text" name="email" id="email" value="" required="" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="password">Password:
							<i class="ln ln-icon-Lock-2"></i>
							<input class="input-text" type="password" name="password" id="password" required="" />
						</label>
					</p>
					
					<p class="form-row">
						<input type="submit" class="button border fw margin-top-10" name="login" value="Login" />

						<label for="rememberme" class="rememberme">
						<!--input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label-->
					</p>

					<!--p class="lost_password">
						<a href="#" >Lost Your Password?</a>
					</p-->
					
				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">

				<form method="post" class="register">
					
					
				<p class="form-row form-row-wide">
					<label for="email2">Email Address:
						<i class="ln ln-icon-Mail"></i>
						<input type="text" class="input-text" name="email1" id="email1" value="" />
					</label>
				</p>

				<!--p class="form-row form-row-wide">
						<label for="usertype">I am:
							
							<select name="user1" class="input-text" style="padding: 12px;">
								 <option readonly>Choose One</option>
								 <option>JobSeeker</option>
								 <option>Company</option>
								 <option>Entreprenure</option>
								 <option>Raw Material Provider</option>
							</select>
						</label>
					</p-->

				<p class="form-row form-row-wide">
					<label for="password1">Password:
						<i class="ln ln-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password1" id="password1"/>
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="password2">Repeat Password:
						<i class="ln ln-icon-Lock-2"></i>
						<input class="input-text" type="password" name="password2" id="password2"/>
					</label>
				</p>

				<p class="form-row">
					<input type="submit" class="button border fw margin-top-10" name="register1" value="Register" />
				</p>

				</form>
			</div>
		</div>
	</div>
</div>



<!-- Footer
================================================== -->
<div class="margin-top-30"></div>


<div id="footer" style="padding: 0px;">
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

<!-- Mirrored from www.vasterad.com/themes/workscout/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Sep 2016 06:45:33 GMT -->
</html>