<?php
include('plugins/timetable/connection.php');
ob_start();
session_start();
    $con= mysqli_connect("localhost","root","");
        mysqli_select_db($con,"gpm");
            if(isset($_POST['submit']))
			{
				$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db')); 
			    $email=$_POST['Email'];
				$pass=$_POST['Password'];
				$c=0;
				$q=mysqli_query($con,"select * from teacher where email='$email'");
			    while($row=mysqli_fetch_array($q))
				{
					$c++;
				    if ($pass==$row['password'])  
				    {   
						if($row['designation']=='hod' and $row['dept']!='sc')
						{
							$_SESSION['designationHOD']=$row['designation'];
							$_SESSION['first_nameHOD']=$row['first_name'];
							$_SESSION['last_nameHOD']=$row['last_name'];
							$_SESSION['deptHOD']=$row['dept'];
							$_SESSION['phoneHOD']=$row['phone_no'];
							$_SESSION['emailHOD']=$row['email'];
							$_SESSION['passwordHOD']=$row['password'];
							$_SESSION['hod']='hod';
							header('Location:hod.php');
						}
						else if($row['designation']=='admin')
						{
							$_SESSION['designation']=$row['designation'];
							$_SESSION['first_name']=$row['first_name'];
							$_SESSION['last_name']=$row['last_name'];
							$_SESSION['phone']=$row['phone_no'];
							$_SESSION['email']=$row['email'];
							$_SESSION['admin']='admin';
							$_SESSION['password']=$row['password'];
							
							header('Location:admin.php');
						}
						else if($row['designation']=='hod' and $row['dept']=='sc')
						{
							$_SESSION['designationSC']=$row['designation'];
							$_SESSION['first_nameSC']=$row['first_name'];
							$_SESSION['last_nameSC']=$row['last_name'];
							$_SESSION['deptSC']=$row['dept'];
							$_SESSION['phoneSC']=$row['phone_no'];
							$_SESSION['emailSC']=$row['email'];
							$_SESSION['passwordSC']=$row['password'];
							$_SESSION['hodsc']='hodsc';
							header('Location:hodsc.php');
						}
				    }
			        else 
				    {    
				        echo '<script>alert("Invalid Password '.$pass.'!")</script>';	
				    }
					
				}
				if($c==0)
				{
					echo '<script>alert("invalid email !")</script>';
				}
			}			
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Government Polytechnic Mumbai</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="dist/img/card.png" type="image/gif">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="web/css/flexslider.css" type="text/css" media="screen" /> <!-- Flexslider-CSS -->
<link href="web/css/font-awesome.css" rel="stylesheet"><!-- Font-awesome-CSS --> 
<link href="web/css/style.css" rel='stylesheet' type='text/css'/><!-- Stylesheet-CSS -->
<link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>	
</head>
<body>
	<h1></h1><br>
	<div class="main-agile">
		<div class="content-wthree">
			<div class="about-middle">
			<section class="slider">
			<div class="flexslider">
				<ul class="slides">
				  <li>
					<div class="banner-bottom-2">			  		
						<div class="about-midd-main">
							<img class="agile-img" src="web/images/gpmlogo.gif" alt="gpmlogo " class="img-responsive">
							<h4>Government Polytechnic Mumbai</h4>
							<p> Government Polytechnic Mumbai is one of the leading Polytechnics in the state of Maharashtra, India.
							This website is use for the purpose of Generating Time Table and manage it.</p>
						</div>
					</div>
				  </li>
				</ul>
			</div>
			<div class="clear"> </div>
		  </section>
		</div>
		<div class="new-account-form">
		<h2 class="heading-w3-agile">Log In</h2>
			<form action="#" method="post">
			<div class="inputs-w3ls">
				<p>Email</p>
				<i class="fa fa-envelope" aria-hidden="true"></i>
					<input type="email" class="email" name="Email" placeholder="" required="">
			</div>
			<div class="inputs-w3ls">
				<p>Password</p>
				<i class="fa fa-unlock-alt" aria-hidden="true"></i>
					<input type="password" class="password" name="Password" placeholder="" required="">
			</div>
					<label class="anim">
					</label> 
						<input type="submit" name="submit" value="Sign in">  
			</form> 
		</div>
		<div class="clear"> </div>

		</div>
	</div>
	<div class="footer-w3l">
		<p class="agileinfo"> <strong>Copyright &copy; 2017-2018, <a href="">Manish Kumar Yadav & Team</a>.</strong> All rights reserved.</a></p>
	</div>
<script src="web/js/jquery.min.js"></script>
<script>
</script>
	<!-- FlexSlider -->
				  <script defer src="web/js/jquery.flexslider.js"></script>
				  <script type="text/javascript">
					$(function(){
					 
					});
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				  </script>
		<!-- FlexSlider -->

</body>
</html>