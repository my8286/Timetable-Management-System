<?php 
session_start();
include('../../plugins/timetable/connection.php'); 
if(isset($_SESSION['designationHOD'],$_SESSION['first_nameHOD'],$_SESSION['last_nameHOD'],$_SESSION['deptHOD']))
{
	$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db'));

//*************************************************************************
	$dept=$_SESSION['deptHOD'];

//*************************************************************************
		
	if($dept=='if')
	{
		$department='Information Teachnology(IF)';
	}
	else if($_SESSION['deptHOD']=='co')
	{
		$department='Computer Science(CO)';
	}
	else if($_SESSION['deptHOD']=='me')
	{
		$department='Mechanical Department(ME)';
	}
//*************************************************************************
	$hodName=ucfirst($_SESSION['first_nameHOD'])." ".ucfirst($_SESSION['last_nameHOD']);
	$prinName="________________";
	$incharge="__________________";
	
	$q=mysqli_query($con,"select * from content where field='hod' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$hodName=$row['value'];
	}
	$q=mysqli_query($con,"select * from content where field='principal' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$prinName=$row['value'];
	}
	$q=mysqli_query($con,"select * from content where field='incharge' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$incharge=$row['value'];
	}
}


?>