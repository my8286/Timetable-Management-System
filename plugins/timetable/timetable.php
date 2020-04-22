<?php
      //session_start();
    //  $prin=$_SEssION['principal'];
	  
      $con= mysqli_connect("localhost","root","");
      mysqli_select_db($con,"gpm"); 
?>
<html>
<head>
<style>
@media screen and (-webkit-min-device-pixel-ratio:0) {
.font{
	font-size:70%;	
	font-family: verdana;
	font-size-adjust: 0.28;
	border:0px solid white;
}
ul{
    line-height: 50%;
}
.font-color{
	color:red;
}
</style>
</head>
<body>
<?php

if(isset($_REQUEST["timeTable"]) and isset($_REQUEST["shift"]) and isset($_REQUEST["dept"]) and isset($_REQUEST["st"]))
{
	function th($s,$y,$teacher,$room,$subject,$room_id,$department)
	{
		global $year;
		global $shift;
		global $dept;
		global $day;
		global $st;
		global $con;
		$q=mysqli_query($con,"select * from room where room_id=$room_id") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$room_dept=$row['dept'];
		}
		if($room_dept!=$dept and $room_dept!='new' and $dept!='sc')
		{
			$room=$room."-".$room_dept;
		}

		if($room!='new')
		{
			?>
			<ul class="list-inline text-center font">
				<li><?php echo strtoupper($teacher);?></li>
			</ul>
			<ul class="list-inline text-center font">
				<li><?php echo strtoupper($subject);?></li>
			</ul>
			<ul class="list-inline text-center font">
				<?php
				if($dept!='sc'){?>
					<li id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>" contenteditable><?php echo strtoupper($room); ?></li>
				<?php }
				else if($dept=='sc')
				{?>
					<li id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>"><?php echo strtoupper($room); ?></li>
				<?php } ?>
			</ul><?php
		
			if(($year=='default' or $shift=='default') and $dept!='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo strtoupper($y."".$s)."|TH";?></li>
				</ul>
				<?php
			}
			else if(($year=='default' or $shift=='default') and $dept=='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo strtoupper($y."".$s)."|".strtoupper($room_dept);?></li>
				</ul>
				<?php
			}
			else if($year!='default' and $shift!='default' and $dept=='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo "DEPT-".strtoupper($department);?></li>
				</ul>
				<?php
			}
		}
		else if($room=='new')
		{
			?>
			<ul class="list-inline text-center font">
				<li><?php echo strtoupper($teacher);?></li>
			</ul>
			<ul class="list-inline text-center font">
				<li><?php echo strtoupper($subject);?></li>
			</ul>
			<ul class="list-inline text-center font">
				<?php
				if($dept!='sc'){?>
					<li class="new" id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>" contenteditable><?php echo strtoupper($room); ?></li>
				<?php }
				else if($dept=='sc')
				{?>
					<li class="new" id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>"><?php echo strtoupper($room); ?></li>
				<?php } ?>
			</ul><?php
		
			if(($year=='default' or $shift=='default') and $dept!='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo strtoupper($y."".$s)."|TH";?></li>
				</ul>
				<?php
			}
			else if(($year=='default' or $shift=='default') and $dept=='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo strtoupper($y."".$s)."|".strtoupper($department);?></li>
				</ul>
				<?php
			}
			else if($year!='default' and $shift!='default' and $dept=='sc')
			{?>
				<ul class="list-inline text-center font">
					<li><?php echo "DEPT-".strtoupper($department);?></li>
				</ul>
				<?php
			}
		}
	}
	function pr($s,$y,$teacher,$room,$subject,$batch,$room_id,$department)
	{	
		global $year;
		global $shift;
		global $dept;
		global $day;
		global $st;

		?> 
		<table>
			<tr class="text-center font">
				<td><?php echo strtoupper($batch)."|";?></td>
				<td><?php echo strtoupper($teacher)."|";?></td>
				<td><?php echo strtoupper($subject)."|";?></td>
				<?php
				if($dept!='sc'){?>
					<td id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>" contenteditable><?php echo strtoupper($room); ?></td>
				<?php }
				else if($dept=='sc')
				{?>
					<td id="editRoom" data-id_room="<?php echo $room_id; ?>" data-id_room2="<?php echo $day."".$st; ?>" data-id_room3="<?php echo $y; ?>" data-id_room4="<?php echo $s; ?>"><?php echo strtoupper($room); ?></td>
				<?php } ?>
			</tr><?php
			if(($year=='default' or $shift=='default') and $dept!='sc')
			{?>
			   <tr class="font">
				 <td colspan=4><center><?php echo strtoupper($y."".$s)."| PR";?></center></td>
			 </tr>
			<?php
			} 
			else if(($year=='default' or $shift=='default') and $dept=='sc')
			{?>
			   <tr class="font">
				 <td colspan=4><center><?php echo strtoupper($y."".$s)."|".strtoupper($department);?></center></td>
			 </tr>
			<?php
			}
			else if($year!='default' and $shift!='default' and $dept=='sc')
			{?>
			   <tr class="font">
				 <td colspan=4><center><?php echo "DEPT-".strtoupper($department);?></center></td>
			 </tr>
			<?php
			}
			?>
		</table>
		<?php	
	}
    $year=$_REQUEST["year"];
    $shift =$_REQUEST["shift"];
    $st=$_REQUEST["st"];
    $et=$_REQUEST["et"];
    $day=$_REQUEST["day"];
	$dept=$_REQUEST["dept"];
	$teacher_id=$_REQUEST["teacher"];
	$room_id=$_REQUEST["room"];
	$sem=$_REQUEST["sem"];
    $type="n";
	//echo "$sem";
	//echo " type=".$type." shift=".$shift." year=".$year." teacher=".$teacher_id." room_id=".$room_id." dept=".$dept." st=".$st." day=".$day; 
	if($dept=='sc')
	{
		$col='dept2';
	}
	else
	{
		$col='dept';
	}
	if($shift!='default' and $year!='default' and $teacher_id=='default' and $room_id=='default') // by shift & year
	{
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$i=0;
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}  
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}		
		}
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
	{ 
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);	
			}
		}
		else if($type=='pr')
		{

			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
	{
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}  		
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	  
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}  
		if($type=='th')
		{	
	//echo "$type $st $et $day $shift $room_id";
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}	
	} 
	else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}  
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			 $q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}	
	} 
	else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
	{  
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}  
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			 $q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}	
	}
	else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
	{ 
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
	{ 
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and room_id='$room_id' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		if($type=='th')
		{	
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
			}
		}
		else if($type=='pr')
		{
			$q=mysqli_query($con,"select m.dept,m.shift,m.batch,t.teacher_code,r.room_no,r.room_id,s.subject_name,s.year from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.".$col."='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			   pr($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['batch'],$row['room_id'],$row['dept']);
			}
		}
	}
	
	
}
//----------------------------------------------------------------
if(isset($_REQUEST['deleteTable']))
{
	$year=$_REQUEST['year'];
	$shift=$_REQUEST['shift'];
	$dept=$_REQUEST['dept'];
	$teacher_id=$_REQUEST['teacher'];
	$sem=$_REQUEST['sem'];
	echo "<br>dept1=$dept year=$year shift=$shift teacher=$teacher_id ";
	if($dept!='sc')
	{
		if($year!='default' and $shift!='default' and $teacher_id=='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and shift='$shift' and dept='$dept' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
				mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift' and dept='$dept'") or die (mysqli_error());
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift' and dept='$dept'") or die (mysqli_error());
			}
		}
		else if($year!='default' and $shift!='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift' and batch='$batch' and dept='$dept'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
			}
		}
		else if($year!='default' and $shift=='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and teacher_id=$teacher_id and dept='$dept' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and batch='$batch' and dept='$dept'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
			}
		}
		else if($year=='default' and $shift!='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift' and batch='$batch' and dept='$dept'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
			}
		}
		else if($year=='default' and $shift=='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and batch='$batch'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id") or die (mysqli_error());
			}
		}
	}
	else if($dept=='sc')
	{
		if($year!='default' and $shift!='default' and $teacher_id=='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and shift='$shift' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
				mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift'") or die (mysqli_error());
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift'") or die (mysqli_error());
			}
		}
		else if($year!='default' and $shift!='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift' and batch='$batch'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id") or die (mysqli_error());
			}
		}
		else if($year!='default' and $shift=='default' and $teacher_id!='default')
		{
			mysqli_query($con,"delete from main_table where year='$year' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where year='$year' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and batch='$batch'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id") or die (mysqli_error());
			}
		}
		else if($year=='default' and $shift!='default' and $teacher_id!='default')
		{
			//echo "$shift $teacher_id $dept $sem";
			mysqli_query($con,"delete from main_table where shift='$shift' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			$q=mysqli_query($con,"select * from subject where dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and shift='$shift' and batch='$batch'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and shift='$shift' and teacher_id=$teacher_id") or die (mysqli_error());
			}
		}
		else if($year=='default' and $shift=='default' and $teacher_id!='default')
		{
		
			mysqli_query($con,"delete from main_table where teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
			echo "$dept";
			$q=mysqli_query($con,"select * from subject where dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$subject_id=$row['subject_id'];
				echo "----$dept tea=$teacher_id sub=$subject_id";
				$q2=mysqli_query($con,"select * from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$batch=$row['batch'];
					echo "-----$batch";
					mysqli_query($con,"update subject set status=0 where subject_id=$subject_id") or die (mysqli_error());
					mysqli_query($con,"delete from assign_subject where subject_id=$subject_id and batch='$batch'") or die (mysqli_error());
				}
				mysqli_query($con,"delete from teacher_subject where subject_id=$subject_id and teacher_id=$teacher_id") or die (mysqli_error());
			}
		}
		
	}
}
//----------------------------------------------------------------
if(isset($_REQUEST['deptTeacherName']))  //for check teachers name
{
	$teacher_id=$_REQUEST["teacher"];   
	$q=mysqli_query($con,"select * from teacher where teacher_id=$teacher_id") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
		if($row['designation']=="visitor")
			echo " ".strtoupper($row['teacher_code'])." : ".strtoupper($row['first_name'])."  ".strtoupper($row['last_name'])." ";
		else if($row['designation']=="hod")
			echo "HOD : ".strtoupper($row['first_name'])." ".strtoupper($row['last_name'])."(".strtoupper($row['teacher_code']).")";
		else if($row['designation']=="professor")
			echo "Prof. : ".strtoupper($row['first_name'])." ".strtoupper($row['last_name'])."(".strtoupper($row['teacher_code']).")";
	}
}
//--------------------------------------------------------------
if(isset($_REQUEST['deptRoomNumber']))  //for check room number
{
	$room_id=$_REQUEST["room_id"];
	$q=mysqli_query($con,"select * from room where room_id=$room_id ") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
	    echo strtoupper($row['room_no']);
	}
}
//-------------------------------------------------------------			
if(isset($_REQUEST['deptTeacher']))  //for check dept teachers
{
	$dept=$_REQUEST['dept'];
	?>
	<option value="default">Teacher</option>
	<?php
	$q=mysqli_query($con,"select * from teacher where dept='$dept'") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
	 ?>
       <option value="<?php echo $row['teacher_id'];?>"><?php echo strtoupper($row['teacher_code']);?></option>
     <?php
	}
}
//------------------------------------------------------			
if(isset($_REQUEST['deptRoom']))  //for check dept room
{
	$dept=$_REQUEST['dept'];
	?><option value="default">Room</option>
	<?php
	$q=mysqli_query($con,"select * from room where dept='$dept'") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
	  ?>
        <option value="<?php echo $row['room_id'];?>"><?php echo strtoupper($row['room_no']);?></option>
     <?php
	}
}
//--------------------------------------------------------
if(isset($_REQUEST['subject']))  //for check dept subject
{
	$dept=$_REQUEST['dept'];
	?><option value="default">Subject</option>
	<?php
	$q=mysqli_query($con,"select * from subject where dept='$dept'") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
		$cntr=0;
		$subject_id=$row['subject_id'];
		$type=$row['type'];
		$subject_name=$row['subject_name'];
		$q2=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$cntr++;
		}
		if(($cntr!=8 and $type=='both') or ($cntr!=6 and $type=='pr') or ($cntr!=2 and $type=='th'))
		{
		?>
			<option value="<?php echo $subject_id;?>"><?php echo strtoupper($subject_name);?></option>
		<?php
		}
	}
}
//--------------------------------------------------------
if(isset($_REQUEST['emptyShift']))  //for avail shift
{
	$dept=$_REQUEST['dept'];
	$subject_id=$_REQUEST['sub'];
	$s=array("fs","ss");
	$cntr2=0;
	$fs=0;
	$ss=0;
	$q=mysqli_query($con,"select * from subject where subject_id=$subject_id") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{	
		$type=$row['type'];
		for($i=0;$i<2;$i++)
		{
			$shift=$s[$i];
			$cntr=0;
		//	echo "---------$shift";
			$q2=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$shift' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				$cntr++;
				echo "----------".$row['shift'];
			}
			if(($cntr!=4 and $type=='both') or ($cntr!=3 and $type=='pr') or ($cntr!=1 and $type=='th'))
			{
				$cntr2++;
				if($shift=='fs')
					$fs=1;
				else if($shift=='ss')
					$ss=1;
			}
		}
		echo "fs=$fs ss=$ss cntr=$cntr2 ";
		if($cntr2==2 and $fs==1 and $ss==1)
		{
			?>
				<option value="default">Shift</option>
			<?php
		}
		if($fs==1)
		{
			?>
				<option value="fs">First Shift</option>
			<?php
		}
		if($ss==1)
		{
			?>
				<option value="ss">Second Shift</option>
			<?php
		}
		if($cntr2==2)
		{
			?>
				<option value="<?php echo "both";?>"><?php echo "Both Shift";?></option>
			<?php
		}
	}
}
//--------------------------------------------------------
if(isset($_REQUEST['type']))  //for avail type
{
	$dept=$_REQUEST['dept'];
	$subject_id=$_REQUEST['sub'];
	$shift=$_REQUEST['s'];
	$q=mysqli_query($con,"select * from subject where subject_id=$subject_id") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	
	$th=0;
	$prA=0;
	$prB=0;
	$prC=0;

	if($shift=='both')
	{
		if($type=='both' or $type=='th')
		{
			for($i=0;$i<2;$i++)
			{
				if($i==0)
					$s='fs';
				else
					$s='ss';
				$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$s' and type='th' and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{	
					$th++;
				}
			}
		}

		if($type=='both' or $type=='pr')
		{
			for($i=0;$i<2;$i++)
			{
				if($i==0)
					$s='fs';
				else
					$s='ss';
				$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$s' and type='pr' and batch='a' and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{	
					$prA++;
				}
				$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$s' and type='pr' and batch='b' and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{	
					$prB++;
				}
				$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$s' and type='pr' and batch='c' and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{	
					$prC++;
				}
			}
			
		}
		if($type=='both' and $th==0 and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="default">Type</option>
			<?php
		}
		if(($type=='both' or $type=='th') and $th==0)
		{
			?>
			<option value="th">Theory</option>
			<?php
		}
		if(($type=='both' or $type=='th') and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="pr">Practical</option>
			<?php
		}
		if($type=='both' and $th==0 and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="both">Both Type</option>
			<?php
		}
	}
	else
	{
		if($type=='both' or $type=='th')
		{
			$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$shift' and type='th' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$th++;
			}
		}
		if($type=='both' or $type=='pr')
		{
			$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$shift' and type='pr' and batch='a' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$prA++;
			}
			$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$shift' and type='pr' and batch='b' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$prB++;
			}
			$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and shift='$shift' and type='pr' and batch='c' and dept='$dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$prC++;
			}
		}
		echo "shift=$shift subject=$subject_id";
		if($type=='both' and $th==0 and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="default">Type</option>
			<?php
		}
		if(($type=='both' or $type=='th') and $th==0)
		{
			?>
			<option value="th">Theory</option>
			<?php
		}
		if(($type=='both' or $type=='pr') and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="pr">Practical</option>
			<?php
		}
		
		if($type=='both' and $th==0 and ($prA==0 or $prB==0 or $prC==0))
		{
			?>
			<option value="both">Both Type</option>
			<?php
		}
	}
}
?>
</body>
</html>