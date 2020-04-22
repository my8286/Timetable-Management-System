<?php
$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"gpm"); 
/*
		$con= mysqli_connect("localhost","id4012998_my","root123");
		mysqli_select_db($con,"id4012998_gpm");
		*/

if(isset($_REQUEST['add_teacher']))
{
	$fn=strtolower($_REQUEST['fn']);
	$mn=strtolower($_REQUEST['mn']);
	$ln=strtolower($_REQUEST['ln']);
	$tc=strtolower($_REQUEST['tc']);
	$dept=strtolower($_REQUEST['dept']);
	$des=strtolower($_REQUEST['des']);
	$phone=strtolower($_REQUEST['phone']);
	$email=strtolower($_REQUEST['email']);
	$gender=strtolower($_REQUEST['gender']);
	mysqli_query($con,"insert into teacher (first_name,middle_name,last_name,teacher_code,dept,designation,gender,phone_no,email) values ('$fn','$mn','$ln','$tc','$dept','$des','$gender','$phone','$email')") or die (mysqli_error());
}
//--------------------------------------------
if(isset($_REQUEST['add_subject']))
{
	$sn=strtolower($_REQUEST['sn']);
	$sc=strtolower($_REQUEST['sc']);
	$dept=strtolower($_REQUEST['dept']);
	$type=strtolower($_REQUEST['st']);
	$year=strtolower($_REQUEST['sy']);
	$th=strtolower($_REQUEST['th']);
	$pr=strtolower($_REQUEST['pr']);
	$sem=strtolower($_REQUEST['sem']);
	mysqli_query($con,"insert into subject (subject_name,subject_code,dept,year,type,theory_time,practical_time,semester) values ('$sn','$sc','$dept','$year','$type',$th,$pr,'$sem')") or die (mysqli_error());	
}
//--------------------------------------------
if(isset($_REQUEST['add_room']))
{
	$rn=strtolower($_REQUEST['room_no']);
	$dept=$_REQUEST['dept'];
	$type=$_REQUEST['type'];
	mysqli_query($con,"insert into room (room_no,type,dept) values ('$rn','$type','$dept')") or die (mysqli_error());	
}
//--------------------------------------------
if(isset($_REQUEST['checkDesignation']))
{
	$dept=$_REQUEST['dept'];
	$cntr=0;
	$q=mysqli_query($con,"select * from teacher where designation='hod' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	if($cntr==0)
		echo 'yes';
}
//------------------------------------------------------------
	function shift($con,$shift)
	{
		if($shift=='fs')
		{
			$s='ss';
		}
		else
		{
			$s='fs';
		}
		return $s;
	}
	//------------------------------------------------------------------
	function time12($con,$st,$day,$room,$shift,$subject_dept)
	{
		$shift2=shift($con,$shift);
		$st2=even_odd($con,$st);
		$et2=$st2+1;
		$cntr=0;
		$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift2' and dept='$subject_dept' and room_id=$room") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		if($cntr==0)
		{
			return 'yes';
		}
		else
		{
			return 'no';
		}	
	}
	//-------------------------
	function even_odd($con,$st)
	{
		if($st%2==0)
		{
			$st2=$st+1;
		}
		else
		{
			$st2=$st-1;
		}
		return $st2;
	}
//------------------------------------------------
if(isset($_REQUEST['roomId']))  //for verify room 
{
	$new_room=$_REQUEST["new_room"];
	$dept=$_REQUEST["dept"];
	$id=0;
	$q=mysqli_query($con,"select * from room where room_no='$new_room' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$id=$row['room_id'];
	}
	echo $id;
}
//--------------------------------------------------------
if(isset($_REQUEST['roomNewId']))  //for verify room 
{
	$new_room=$_REQUEST["new_room"];
	$dept=$_REQUEST["dept"];
	$st=$_REQUEST["time"];
	$day=$_REQUEST["day"];
	$shift=$_REQUEST["shift"];
	$sem=$_REQUEST["sem"];
	$et=$st+1;
	$id=0;
	$cntr=0;
	$q=mysqli_query($con,"select * from room where room_no='$new_room' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$id=$row['room_id'];
		$cntr++;
	}
	if($cntr>0)
	{
		//echo "id=$id st=$st et=$et shift=$shift day=$day sem=$sem ";
		$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and semester='$sem' and room_id=$id") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$id=0;
		} 
		if($st==12 or $st==13) 
		{
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			$shift2=shift($con,$shift);
			$q=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift2' and semester='$sem' and room_id=$id") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$id=0;
			}
		}
	}
	echo $id;
}
//---------------------------------------------------------
if(isset($_REQUEST['insertRoom']))  //for check dept subject
{
	$dept=$_REQUEST['dept'];
	$type=$_REQUEST['insertRoom'];
	?><option value="default"><?php echo strtoupper($type);?> Room</option>
	<?php
	$q=mysqli_query($con,"select * from room where dept='$dept' and type='$type'") or die (mysqli_error());
    while($row=mysqli_fetch_array($q))
	{
	 ?>
        <option value="<?php echo $row['room_id'];?>"><?php echo strtoupper($row['room_no']);?></option>
     <?php
	}
	
}
//--------------------------------------------------------------
if(isset($_REQUEST['fetch_subject']))  //for check dept subject
{
	$dept=$_REQUEST['dept'];
	$year=$_REQUEST['year'];
	$sem=$_REQUEST['sem'];
	?><option value="default">Subject</option>
	<?php

		$q=mysqli_query($con,"select * from subject where dept='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr=0;
			$subject_id=$row['subject_id'];
			$type=$row['type'];
			$subject_name=$row['subject_name'];
			$q2=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and dept='$dept'") or die (mysqli_error());
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
//-------------------------------------------------------------------
if(isset($_REQUEST['fetch_subjectSC']))  //for check dept subject
{
	$dept=$_REQUEST['dept'];
	$dept2=$_REQUEST['dept2'];
	$sem=$_REQUEST['sem'];
	
	//echo "$dept $dept2  $sem";
	?><option value="default">Subject</option>
	<?php
	
	$q=mysqli_query($con,"select * from subject where dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr=0;
		$subject_id=$row['subject_id'];
		$type=$row['type'];
		$subject_name=$row['subject_name'];
		//echo "--------ggg----";
		$q2=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and dept='$dept2'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$cntr++;  
			//echo "-------tttttttttttttttt---";			
		} 
		if(($cntr!=8 and $type=='both') or ($cntr!=6 and $type=='pr') or ($cntr!=2 and $type=='th'))
		{
		?>
			<option value="<?php echo $subject_id;?>"><?php echo strtoupper($subject_name);?></option>
		<?php
		}
	}
		
}
//-------------------------------------------------------------
if(isset($_REQUEST['fetch_teacher']))  //for check dept subject
{
	$dept=$_REQUEST['dept'];
	$teacher=$_REQUEST['teacher'];
	?><option value="default">Teacher</option>
	<?php
	if($teacher!='default')
	{
		$q=mysqli_query($con,"select * from teacher where dept='$dept' and designation='$teacher' order by teacher_code asc") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
		?>
			<option value="<?php echo $row['teacher_id'];?>"><?php echo strtoupper($row['teacher_code']);?></option>
		<?php
		}
	}
	else if($teacher=='default')
	{
		$q=mysqli_query($con,"select * from teacher where dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
		?>
			<option value="<?php echo $row['teacher_id'];?>"><?php echo strtoupper($row['teacher_code']);?></option>
		<?php
		}
	}
}
//------------------------------------------------------------
if(isset($_REQUEST['modifyRoom']))  //for modify room number
{
	function pr_id($con,$st,$et,$day,$teacher_id,$room_id,$shift,$year,$dept)
	{
		if($st%2==0)
		{
			$st2=$st+1;
			$et2=$st+2;
		}
		else
		{
			$st2=$st-1;
			$et2=$st;
		}
		echo ">>>>>>>st=$st2 et=$et2 day=$day year=$year shift=$shift tid=$teacher_id room=$room_id";
		$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and room_id=$room_id and shift='$shift' and year='$year' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			return $row['sr_no'];
		}	
	}
	
//--------------------------------------
	$new_room=$_REQUEST["new_room"];
	$old_room=$_REQUEST["room_id"];
	$year=$_REQUEST["year"];
	$shift=$_REQUEST["shift"];
	$dept=$_REQUEST["dept"];
	$st=$_REQUEST["time"];
	$day=$_REQUEST["day"];
	$et=$st+1;
	$old_cntr1=0;
	$old_cntr2=0;
	$new_cntr1=0;
	$new_cntr2=0;
	//echo "st==$st";
	//echo "st=$st et=$et day=$day year=$year shift=$shift room_id=$old_room room=$new_room";
	$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and dept='$dept' and room_id=$old_room") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
		$old_id1=$row['sr_no'];
		$old_cntr1++;
		if($row['type']=='pr')
		{
			$old_cntr2++;
			$old_id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$shift,$year,$dept);
			echo "----------$old_id2";
		}
	}
	$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and dept='$dept' and room_id=$new_room") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$new_id1=$row['sr_no'];
		$new_cntr1++;
		if($row['type']=='pr')
		{
			$new_cntr2++;
			$new_id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept);
		}
	} 
	if(($st==12 or $st==13 ) and $type=='th') 
	{
		$val=time12($con,$st,$day,$new_room,$shift,$dept);
		if($val=='no')
		{
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			$shift2=shift($con,$shift);
			$q=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift2' and dept='$dept' and room_id=$new_room") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{	
				$id=$row['sr_no'];
				mysqli_query($con,"update main_table set room_id=$old_room where sr_no=$id")or die (mysqli_error());
			}
		}
	}
	mysqli_query($con,"update main_table set room_id=$new_room where sr_no=$old_id1")or die (mysqli_error());
	if($old_cntr2>0)
	{
		mysqli_query($con,"update main_table set room_id=$new_room where sr_no=$old_id2")or die (mysqli_error());
	}
	if($new_cntr1>0)
	{
		mysqli_query($con,"update main_table set room_id=$old_room where sr_no=$new_id1")or die (mysqli_error());
	}
	if($new_cntr2>0)
	{
		echo ">>>>>>>>$old_room  $new_id2<<<<<<<";
		mysqli_query($con,"update main_table set room_id=$old_room where sr_no=$new_id2")or die (mysqli_error());
	}
}

//------------------------------------------------------------
if(isset($_REQUEST['modifyNewRoom']))  //for modify room number
{
	$new_room=$_REQUEST["new_room"];
	$old_room=$_REQUEST["room_id"];
	$year=$_REQUEST["year"];
	$shift=$_REQUEST["shift"];
	$sem=$_REQUEST["sem"];
	$dept=$_REQUEST["dept"];
	$st=$_REQUEST["time"];
	$day=$_REQUEST["day"];
	$et=$st+1;
	$time12=true;
	$cntr=0;
	//echo "st==$st";
	//echo "st=$st et=$et day=$day y=$year s=$shift dept=$dept room=$new_room";
	$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and semester='$sem' and room_id=$new_room") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	} 
	if($st==12 or $st==13) 
	{
		$temp_st=even_odd($con,$st);
		$temp_et=$temp_st+1;
		$shift2=shift($con,$shift);
		$q=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift2' and semester='$sem' and room_id=$new_room") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			$time12=false;
		}
	}
	if($time12==true and $cntr==0)
	{
		//echo "-----------------------------";
		mysqli_query($con,"update main_table set room_id=$new_room where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'")or die (mysqli_error());
	}
}
//-------------------------------
if(isset($_REQUEST['loadCounter']))
{
	$year=$_REQUEST["year"];
    $shift =$_REQUEST["shift"];
	$dept=$_REQUEST["dept"];
	$teacher_id=$_REQUEST["teacher"];
	$room_id=$_REQUEST["room"];
	$sem=$_REQUEST["sem"];
	$type=$_REQUEST['types'];
    $cntr=0;
	//echo "$sem";
	//echo "-----------------".$_REQUEST['loadCounter'];
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
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and year='$year' and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
	{  
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;			
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
	{  
		$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
	{  
		$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and room_id=$room_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
	{
		
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;			
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
	{  
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}  
		echo $cntr;
	} 
	else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
	{  
		$q=mysqli_query($con,"select type from main_table where teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;
	} 
	else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
	{  
		$q=mysqli_query($con,"select type from main_table where room_id=$room_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;
	}
	else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id=$room_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where room_id='$room_id' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
		
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and teacher_id=$teacher_id and type='$type' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
}
//-------------------------------
if(isset($_REQUEST['loadCounterAll']))
{
	$year=$_REQUEST["year"];
    $shift =$_REQUEST["shift"];
	$dept=$_REQUEST["dept"];
	$teacher_id=$_REQUEST["teacher"];
	$room_id=$_REQUEST["room"];
	$sem=$_REQUEST["sem"];
	//$type=$_REQUEST['types'];
    $cntr=0;
	//echo "$sem";
	//echo "-----------------".$_REQUEST['loadCounter'];
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
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and year='$year' and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
	{  
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;			
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
	{  
		$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
	{  
		$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
	{
		
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;			
	}
	else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
	{  
		$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}  
		echo $cntr;
	} 
	else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
	{  
		$q=mysqli_query($con,"select type from main_table where teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;
	} 
	else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
	{  
		$q=mysqli_query($con,"select type from main_table where room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		} 
		echo $cntr;
	}
	else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id=$room_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
	else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where room_id='$room_id' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
		
	}
	else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
	{ 
		$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and teacher_id=$teacher_id and ".$col."='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		echo $cntr;
	}
}
//-------------------------------
if(isset($_REQUEST['loadCounterMasterThPr']))
{
	$sem=$_REQUEST["sem"];
	$dept=$_REQUEST["dept"];
	$type=$_REQUEST['type'];
    $cntr=0;
	$q=mysqli_query($con,"select type from main_table where type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	echo $cntr;
}
//-------------------------------
if(isset($_REQUEST['loadCounterMasterAll']))
{
	$sem=$_REQUEST["sem"];
	$dept=$_REQUEST["dept"];
    $cntr=0;
	$q=mysqli_query($con,"select type from main_table where dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	echo $cntr;
}
//-------------------------------------
function contentDB($con,$field,$dept)
{
	$cntr=0;
	$q=mysqli_query($con,"select value from content where field='$field' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		echo $row['value'];
		$cntr++;
	}
	
	if($cntr==0 and $field=='hod')
	{
		$q=mysqli_query($con,"select * from teacher where designation='$field' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			echo $row['first_name']." ".$row['last_name'];
		}
	}
	else if($cntr==0)
	{
		echo "_________________";
	}
}
//--------------------------------------
if(isset($_REQUEST['fetch_content']))
{
	$dept=$_REQUEST['dept'];
	$field=$_REQUEST['field'];
		contentDB($con,$field,$dept);
}
//----------------------------------
if(isset($_REQUEST['mail']))
{
	$dept=$_REQUEST['dept'];
	?>
	<option value="default">Mail To</option>
	<?php 
		$q=mysqli_query($con,"select teacher_code,email from teacher where dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{?>
			<option value="<?php echo $row['email']?>"><?php echo strtoupper($row['teacher_code']);?></option>
		<?php
		}
		
}
?>