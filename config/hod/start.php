<?php
include('hod.php');  
if(isset($_SESSION['hod']) and $_SESSION['hod']=='hod')
{
	
	if(isset($_POST['logout']))
	{
		session_unset(); 
		session_destroy();
		header("Location:../../index.php");
	}
}
else
{
	header("Location:../../index.php");
}
?>