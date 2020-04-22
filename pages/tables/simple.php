<?php
 session_start();
  if(isset($_SESSION['admin']))
  {
	if(isset($_SESSION['designation'],$_SESSION['first_name'],$_SESSION['last_name'],$_SESSION['phone'],$_SESSION['email']))
	{
		$dept="admin";
		$con= mysqli_connect("localhost","root","");
        mysqli_select_db($con,"gpm"); 
		/*
		$con= mysqli_connect("localhost","id4012998_my","root123");
		mysqli_select_db($con,"id4012998_gpm");
		*/
		if(isset($_POST['logout']))
		{
			session_unset(); 
			session_destroy();
			header("Location:../../index.php");
		}
	    $hodName="_____________________";
		$prinName="_____________________";
		$incharge="_________________";

    }
}
else
{
	header("Location:../../index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Government Ploytechnic Mumbai</title>
	<link rel="icon" href="../../dist/img/card.png" type="image/gif">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable='no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
	<style>
	.loader {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	padding-top: 300px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
	}
		/* The Modal (background) */
	.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	padding-top: 250px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
	background-color: #fefefe;
	margin: auto;
	padding: 20px;
	border: 1px solid #888;
	width: 20%;
	}

	/* The Close Button */
	.close {
	color: #aaaaaa;
	float: right;
	font-size: 28px;
	font-weight: bold;
	}

	.close:hover,
	.close:focus {
	color: #000;
	text-decoration: none;
	cursor: pointer;
	}

/*---------------------------------------------*/

#subLoader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
 /* box-shadow: 0px 0px 150px 55px red;*/
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
.shadow-loader77{
	position:fixed;
	margin-top:-60px;
	margin-left:5px;
	width:10px;
	box-shadow: 0px 0px 150px 55px red;
	animation: shadowLoader 3s alternate infinite;
}
@keyframes shadowLoader 55 {
			100%{box-shadow: 0px 0px 150px 55px red;}
			75%{box-shadow: 0px 0px 150px 55px yellow}
			50%{box-shadow: 0px 0px 150px 55px lime}
			25%{box-shadow: 0px 0px 150px 55px blue}
			0%{box-shadow: 0px 0px 150px 55px orange}
		}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg);border-top: 16px solid lime; }
  25% { border-top: 16px solid yellow; }
  75% { border-top: 16px solid cyan; }
  100% { transform: rotate(360deg);border-top: 16px solid green;}
}
/*-------------------------------------------------------*/
	/* The Modal (background) */
	.password-modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	padding-top: 250px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.password-modal-content {
	background-color: #fefefe;
	margin: auto;
	padding: 20px;
	border: 1px solid #888;
	width: 20%;
	}

/*----------------------------------------------------*/
		@media screen and (max-width: 640px) {
			table{
				overflow-x: auto;
			}
		}
		@media print
		{
			p,table,#labelDept{
				color:black;
				background-color:white;
			}
		}
		p{
			color:white;
		}
		#labelDept2{
			font-size:15px;
			font-family: verdana;
		}
		.border{
		  border : 1px solid black;
		  border-collapse: collapse;
		  animation: border 14s alternate infinite; 
		}
		
		@keyframes border  {
			0%{border :1px solid hotpink}
			25%{border :1px solid red}
			50%{border :1px solid lime}
			75%{border :1px solid blue}
			100%{border :1px solid yellow}
		}
		.current
		{
			 animation: currentColor 3s alternate infinite;
		}
		@keyframes currentColor  {
			100%{background-color : hotpink}
			75%{background-color :red}
			50%{background-color :lime}
			25%{background-color :blue}
			0%{background-color :yellow}
		}
		.new
		{
			 animation: newColor 3s alternate infinite; 
		}
		@keyframes newColor {
			750%{color : hotpink}
			0%{color :red}
			100%{color :lime}
			25%{color :blue}
			50%{color :yellow}
		}
	</style>
  </head>
  <body class="skin-blue sidebar-collapse fixed">
    <div class="wrapper">
      
      <header class="main-header">
        <a href="../../admin.php" class="logo"><b> GP </b>Mumbai</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
            <div class="navbar-custom-menu" >
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a>
								<i class="ion ion-person"></i>
								<span class="hidden-xs"><?php echo strtoupper($_SESSION['first_name'])." ".strtoupper($_SESSION['last_name']);?></span>
							</a>
						</li>
						<!---logout--->
					    <li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle">
								<form method="post" style="margin-top:-55%;padding-top:39%"> 
									<button type="submit" name="logout" style="background-color:transparent" ><i class="fa fa-bell-o"></i></button>
								</form>
							</a>    
						</li>
					</ul>
				</div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
         				<ul class="sidebar-menu">
						<li class="treeview">
							<a href="../../admin.php">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-edit"></i> <span>Forms</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="../forms/teacherform.php"><i class="fa fa-circle-o"></i> Teacher </a></li>
								<li><a href="../forms/subjectform.php"><i class="fa fa-circle-o"></i> Subject </a></li>
								<li><a href="../forms/roomform.php"><i class="fa fa-circle-o"></i> Room </a></li>
							</ul>
						</li>
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-table"></i> <span>Time Table</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li class="active"><a href="#"><i class="fa fa-circle-o"></i> Simple</a></li>
								<li><a href="master.php"><i class="fa fa-circle-o"></i> Master</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-database"></i> <span>Data Table</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu ">
								<li>
									<a href="../forms/teachersubject.php"><i class="fa fa-circle-o"></i>Teacher</a>
								</li>
								<li>
									<a href="../forms/assignsubject.php"><i class="fa fa-circle-o"></i>Subject</a>
								</li>         
							</ul>
						</li>
						<li class="treeview">
							<a href="simplesc.php">
								<i class="fa fa-table"></i> <span>Science Department</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							
						</li>
				</ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Simple Table
			<small style="color:black;font-size:20px;" id="labelDept"></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../../admin.php">Time Table</a></li>
            <li class="active">Simple Table</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box" style="overflow-x: auto;">
                <div id="hide" class="box-header">
                  <h3 class="box-title">Select Data &nbsp; &nbsp; </h3>
				  <select id="year" onchange="timeTable()">
						<option value="default">Year</option>
						<option value="fy">FY</option>
						<option value="sy">SY</option>
						<option value="ty">TY</option>
					</select>
					<select id="shift" onchange="timeTable()">
						<option value="default">Shift</option>
						<option value="fs">FS</option>
						<option value="ss">SS</option>
					</select>
					<select id="dept" onchange="fetch()">
						<option value="default">Dept</option>
						<option value="if">IF</option>
						<option value="co">CO</option>
						<option value="ec">EC</option>
						<option value="me">ME</option>
						<option value="lt">LT</option>
						<option value="rt">RT</option>
						<option value="ce">CE</option>
						<option value="is">IS</option>
						<option value="ee">EE</option>
						<option value="sc">SC</option>
					</select>
					<select id="teacher" onchange="timeTable()">
				        <option value="default">Teacher</option>
                    </select> 
					<select id="room" onchange="timeTable()">
				        <option value="default">Room</option>
                    </select>
					<select id="sem" onchange="timeTable()">
				        <option value="odd">Odd</option>
						<option value="even">Even</option>
                    </select>
					<select id="mail" style="margin-right:.2%" class="pull-right btn bg-blue" onchange="sendMail('mail')">
						<option value="default"> Mail To</option>
						
					</select>
					<button onclick="adjust()" class="pull-right btn bg-blue" style="margin-right:.2%"><span class="glyphicon glyphicon-refresh"></span> &nbsp; Refresh</button>
					<button onclick="passModal()" class="pull-right btn bg-blue" style="margin-right:.2%"><span class="glyphicon glyphicon-trash"></span> &nbsp; Delete</button>
					<button onclick="takePrint()" id="print" class="pull-right btn bg-blue" style="margin-right:.2%"><span class="glyphicon glyphicon-print"></span>&nbsp; Print</i></button>
				</div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table border" style="background-color:black;color:white">
                    <thead class="border">
						<tr class="border">
							<th colspan=11 class="border"><center style="font-size:20px"></center></th>
						</tr>
						<tr class="border">
							<th colspan=2 class="border"><center><span id="labelTeacher"></span></center></th>
							<th colspan=7 class="border">
								<center><h8><span id="labelYear"></span>&nbsp; <span id="labelShift"></span>&nbsp; <span id="labelRoom"></span> </h8></center>
							</th>
							<th colspan=2 class="border"><center>LOAD : <span id="total">0</span> ( TH=<span id="totalTH">0</span>,PR=<span id="totalPR">0</span> )</center></th>
						</tr>
						
                      <tr class="border">
                        <th class="border" rowspan=2>DAY/TIME</th>
						<th class="border" rowspan=2>8 To 9 AM</th>
						<th class="border" rowspan=2>9 To 10 AM</th>
						<th class="border" rowspan=2>10 To 11 AM</th>
						<th class="border" rowspan=2>11 To 12 PM</th>
						<th class="border">12:30 To 1:30 PM</th>
						<th class="border">1:30 To 2:30 PM</th>
						<th class="border"rowspan=2>2:30 To 3:30 PM</th> 
						<th class="border" rowspan=2>3:30 To 4:30 PM</th>
						<th class="border" rowspan=2>4:30 To 5:30 PM</th>
						<th class="border" rowspan=2>5:30 To 6:30 PM</th>
                      </tr>
						<tr class="border">
					
							<th class="border">12:00 To 1 PM</th>
							<th class="border">1 To 2 PM</th>
						</tr>
                    </thead>
                    <tbody class="tbody border">
							<tr class="border">
							<th class="border">MONDAY</th>
								<td class="border" data-id="mon8" id="mon8" ondrop="drop(event,8,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon9" id="mon9" ondrop="drop(event,9,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon10" id="mon10" ondrop="drop(event,10,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon11" id="mon11" ondrop="drop(event,11,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon12" id="mon12" ondrop="drop(event,12,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon13" id="mon13" ondrop="drop(event,13,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon14" id="mon14" ondrop="drop(event,14,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon15" id="mon15" ondrop="drop(event,15,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon16" id="mon16" ondrop="drop(event,16,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="mon17" id="mon17" ondrop="drop(event,17,'mon')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr class="border">
								<th class="border">TUESDAY</th>
								<td class="border" data-id="tue8" id="tue8" ondrop="drop(event,8,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue9" id="tue9" ondrop="drop(event,9,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue10" id="tue10" ondrop="drop(event,10,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue11" id="tue11" ondrop="drop(event,11,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue12" id="tue12" ondrop="drop(event,12,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue13" id="tue13" ondrop="drop(event,13,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue14" id="tue14" ondrop="drop(event,14,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue15" id="tue15" ondrop="drop(event,15,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)"  ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue16" id="tue16" ondrop="drop(event,16,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="tue17" id="tue17" ondrop="drop(event,17,'tue')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr class="border">
								<th class="border">WEDNESDAY</th>
								<td class="border" data-id="wed8" id="wed8" ondrop="drop(event,8,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed9" id="wed9" ondrop="drop(event,9,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed10" id="wed10" ondrop="drop(event,10,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed11" id="wed11" ondrop="drop(event,11,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed12" id="wed12" ondrop="drop(event,12,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed13" id="wed13" ondrop="drop(event,13,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed14" id="wed14" ondrop="drop(event,14,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed15" id="wed15" ondrop="drop(event,15,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed16" id="wed16" ondrop="drop(event,16,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="wed17" id="wed17" ondrop="drop(event,17,'wed')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr class="border">
								<th class="border">THURSDAY</th>
								<td class="border" data-id="thu8" id="thu8" ondrop="drop(event,8,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu9" id="thu9" ondrop="drop(event,9,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu10" id="thu10" ondrop="drop(event,10,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu11" id="thu11" ondrop="drop(event,11,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu12" id="thu12" ondrop="drop(event,12,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu13" id="thu13" ondrop="drop(event,13,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu14" id="thu14" ondrop="drop(event,14,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu15" id="thu15" ondrop="drop(event,15,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu16" id="thu16" ondrop="drop(event,16,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="thu17" id="thu17" ondrop="drop(event,17,'thu')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr class="border">
								<th class="border">FRIDAY</th>
								<td class="border" data-id="fri8" id="fri8" ondrop="drop(event,8,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri9" id="fri9" ondrop="drop(event,9,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri10" id="fri10" ondrop="drop(event,10,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri11" id="fri11" ondrop="drop(event,11,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri12" id="fri12" ondrop="drop(event,12,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri13" id="fri13" ondrop="drop(event,13,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri14" id="fri14" ondrop="drop(event,14,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri15" id="fri15" ondrop="drop(event,15,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri16" id="fri16" ondrop="drop(event,16,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="fri17" id="fri17" ondrop="drop(event,17,'fri')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr class="border">
								<th class="border">SATURDAY</th>
								<td class="border" data-id="sat8" id="sat8" ondrop="drop(event,8,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat9" id="sat9" ondrop="drop(event,9,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat10" id="sat10" ondrop="drop(event,10,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat11" id="sat11" ondrop="drop(event,11,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat12" id="sat12" ondrop="drop(event,12,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat13" id="sat13" ondrop="drop(event,13,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat14" id="sat14" ondrop="drop(event,14,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat15" id="sat15" ondrop="drop(event,15,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat16" id="sat16" ondrop="drop(event,16,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
								<td class="border" data-id="sat17" id="sat17" ondrop="drop(event,17,'sat')" ondragstart="drag(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" draggable="true"></td>
							</tr>
							<tr>
								<th colspan=11>
									<div class="box-body">
										<div class="container">
											<div class="row">
												<div class="col-sm-4"><p class="pull-left">Time Table Incharge</div>
												<div class="col-sm-4"><center><p>Head Of Department</p></center></div>
												<div class="col-sm-4"><center><p>Principal</p></center></div>
											</div>
											<div class="row">
												<div class="col-sm-4"><p class="pull-left contentVal" id="incharge" contenteditable></p></div>
												<div class="col-sm-4"><center><p class="contentVal" id="hodName" contenteditable></p></center></div>
												<div class="col-sm-4"><center><p class="contentVal" id="principal" contenteditable></p></center></div>
											</div>
										</div>
									</div>
								</th>
							</tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>IF</b> GPM
        </div>
        <strong>Copyright &copy; 2017-2018, <a class="new">Manish Kumar Yadav & Team </a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
	<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close">&times;</span>
		<form action="#" onsubmit="return newRoomValidation()" method="post">
			<div class="form-group">
				<label for="room">Room No.</label>
				<input type="text" id="roomNo" class="form-control">
			</div>
			<div class="form-group">
				<label for="dept">Department</label>
				<select id="newDept" class="form-control">
					<option value="default">Dept</option>
					<option value="if">IF</option>
					<option value="co">CO</option>
					<option value="ec">EC</option>
					<option value="me">ME</option>
					<option value="lt">LT</option>
					<option value="rt">RT</option>
					<option value="ce">CE</option>
					<option value="is">IS</option>
					<option value="ee">EE</option>
				</select>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="submit" value="OK" class="form-control btn btn-primary">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<button onclick="passCancel('myModal')" class="form-control btn btn-primary">cancel</button>
					</div>
				</div>

			</div>
		</form>
	  </div>
	</div>
	<!----- Spinner ------>
	<div id="myLoader" class="loader">
	  <center>
		<div id="subLoader">
			<div class="shadow-loader"></div>
		</div>
		</center>
	</div>
	<!-- confirmation modal -->
	<div id="myPass" class="password-modal">
	  <!-- Modal content -->
	  <div class="password-modal-content">
		<form action="#" onsubmit="return deleteConfirm()" method="post">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" class="form-control" placeholder="Enter password ">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="submit" value="OK" class="form-control btn btn-primary">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<button onclick="passCancel('myPass')" class="form-control btn btn-primary">cancel</button>
					</div>
				</div>

			</div>
		</form>
	  </div>
	</div>
    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
	 <!-- Time Table -->
    <script src="../../plugins/timetable/timetable.js" type="text/javascript"></script>
    <!-- page script --->
	<script src="../../dist/js/allpages.js" type="text/javascript"></script>
	<!----update-->
	<script src="../../dist/js/update.js" type="text/javascript"></script>
	<script>
	var id,old_room,roomYear,roomShift;
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	$(document).on('click', '#editRoom',function(){
	  old_room=$(this).data("id_room");
	   id=$(this).data("id_room2");
	   roomYear=$(this).data("id_room3");
	   roomShift=$(this).data("id_room4");
	   new_room=$(this).text();
	   if(new_room=="NEW")
	   {
		   //alert(roomYear+""+roomShift);
			modal.style.display = "block";
       }
	  });
	 function newRoomValidation()
	 {
		 //alert();
		var r = document.getElementById("roomNo");
		var d = document.getElementById("newDept"); 
		if(inputBoth(r,"Room No"))  
		{  
			if(select(d,"Department"))  
			{  	
				newRoomId(id,old_room,roomYear,roomShift);
				//alert(id+""+old_room);
			}
		}
		return false;
	 }
	
	function passCancel(id)  {
		document.getElementById(id).style.display = "none";
	}
	
	span.onclick = function() {
		modal.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
			document.getElementById("myPass").style.display = "none";
		}
	}
		myPass=document.getElementById("myPass");
	window.onclick = function(event) {
		if (event.target == myPass) {
			myPass.style.display = "none";
		}
	}
//------------------------
	search('hod');
	contentFetch();
	function deptVal()
	{
		return document.getElementById("dept").value;;
	}
	function userPass()
	{
		return '<?php echo $_SESSION['password'];?>';
	}
	function takePrint() 
	{
		document.getElementById("hide").style.display ="none";
		window.print();
		document.getElementById("hide").style.display ="block";
	}
var id1,id2,time1,time2,day1,day2;
function allowDrop(ev) {
    ev.preventDefault();
	ev.target.style.backgroundColor = "black";//"rgba(255,51,0,0.5)";
}
function dragLeave(ev)
{
   ev.target.style.backgroundColor = "black";// "rgba(255,255,255,0.7)";
  // alert();
}

function drag(ev) {
	id1=ev.target.id;
	day1= id1.substring(0,3);
	time1= id1.substring(3,6);
    document.getElementById(id1).style.backgroundColor = "red";
	document.getElementById(id1).style.color = "white";
	ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev,time,day) {
	time2=time;
	day2=day;
	id2=day2+""+time2;
	document.getElementById(id1).style.backgroundColor = "black";
	document.getElementById(id1).style.color = "white";
	document.getElementById(id2).style.backgroundColor = "black";
	document.getElementById(id2).style.color = "white";
	year = document.getElementById("year").value; 
	shift = document.getElementById("shift").value;
	//alert(shift+"   " +year);
	swap(shift,year,'simple');
}
function swap(shift,year,type)
{
	if(day1!=day2 || time1!=time2)
	{
		var con = confirm("Do you want remove lecture? ");
		if (con == true)
		{
			dept = deptVal();
			teacher = document.getElementById("teacher").value;
			room = document.getElementById("room").value;
			//alert(" dept"+dept+" room="+room+" teacher"+teacher);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					alert(this.responseText);
					if(type=='simple')
						timeTable();
					else
						master();
				}
			};
			xhttp.open("GET", "../../plugins/timetable/swap.php?swap_button=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&time1="+time1+"&&time2="+time2+"&&day1="+day1+"&&day2="+day2+"&&teacher="+teacher+"&&room="+room, true);
			xhttp.send(); 
		}
	}
}
currentDate();
semester();
var mon;
function currentDate()
{
	var today = new Date();    
	var month = new Array(12);
    month[0] = "Jan";
    month[1] = "Feb";
    month[2] = "Mar";
    month[3] = "Apr";
    month[4] = "May";
    month[5] = "Jun";
    month[6] = "Jul";
	month[7] = "Aug";
	month[8] = "Sep";
	month[9] = "Oct";
	month[10] = "Nov";
	month[11] = "Dec";
	var m = month[today.getMonth()];
	var mon=today.getMonth();
  // document.getElementById("totalTH").innerHTML = mon;
    //dd = today.getDate();
	//dd = dd<10? "0"+dd:dd;
	 var weekday = new Array(7);            // for check weekday
	   weekday[0] = "sun";
	   weekday[1] = "mon";
	   weekday[2] = "tue";
	   weekday[3] = "wed";
	   weekday[4] = "thu";
	   weekday[5] = "fri";
	   weekday[6] = "sat";
     var day = weekday[today.getDay()];

	var hour = today.getHours(); 
	nextid=day+""+hour;
	if(hour<19 && hour>7)
		document.getElementById(nextid).className = "current";
}
function semester()
{
	if(mon>=0 && mon<=5)
	{
		document.getElementById("sem").selectedIndex = 0;
	}
	else
	{
		document.getElementById("sem").selectedIndex = 1;
	}
}
function sendMail(val)
{	
	var mail=document.getElementById("mail").value;
	//alert(mail);
	if(mail == "default" && val=="mail")
	{
	}
	else
	{
		var sem=document.getElementById("sem").value;
		var year=document.getElementById("year").value;
		var shift=document.getElementById("shift").value;
		var teacher=document.getElementById("teacher").value;
		var room=document.getElementById("room").value;
		dept=document.getElementById("dept").value;
		fmail='<?php $_SESSION['email']; ?>';
		var xhttp = new XMLHttpRequest(); 
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
			}
		};
		xhttp.open("GET", "../../plugins/timetable/mail.php?sendMail=1&&year="+year+"&&shift="+shift+"&&dept="+dept+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem+"&&to="+mail+"&&val="+val+"&&from="+fmail, true);
		xhttp.send();
	}
}

function contentFetch()
{
	//alert(); 
	document.getElementById("incharge").innerHTML = "<?php echo $incharge;?>";
	document.getElementById("hodName").innerHTML = "<?php echo $hodName;?>";
	document.getElementById("principal").innerHTML = "<?php echo $prinName;?>";
}
function fetch()
{
	dept=document.getElementById("dept").value;
	field="hod";
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
			document.getElementById("hodName").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?fetch_content=1&&dept="+dept+"&&field="+field, true);
	xhttp.send();
	
	field="principal";
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
			document.getElementById("principal").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?fetch_content=1&&dept="+dept+"&&field="+field, true);
	xhttp.send();
	
	field="incharge";
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
			document.getElementById("incharge").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?fetch_content=1&&dept="+dept+"&&field="+field, true);
	xhttp.send();
	
	
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
			document.getElementById("mail").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?mail=1&&dept="+dept, true);
	xhttp.send();
	
	search();	
		
}
	</script>

  </body>
</html>

