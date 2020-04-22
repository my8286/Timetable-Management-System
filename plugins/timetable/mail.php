<html>
<head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
    <style> 
       table,tr,td {
   text-align: center;   
} 
    </style>
</head>
<body>
<?php

$con= mysqli_connect("localhost","id4012998_my","root123");
mysqli_select_db($con,"id4012998_gpm");

if(isset($_REQUEST['sendMail']))
{
	function th($s,$y,$teacher,$room,$subject,$room_id,$department)
	{
		global $year;
		global $shift;
		global $dept;
		if($year!="default" and $shift!="default")
		{
			$val=
			'<table>
				<tr class="text-center font"><td>'.strtoupper($teacher).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($subject).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($room).'</td></tr>
			</table>';
		}
		else if(($year=='default' or $shift=='default') and $dept!='sc')
		{
			$val=
			'<table>
				<tr class="text-center font"><td>'.strtoupper($teacher).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($subject).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($room).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($y).''.strtoupper($s).' | TH</td></tr>
			</table>';
		}
		else if(($year=='default' or $shift=='default') and $dept=='sc')
		{
			$val=
			'<table>
				<tr class="text-center font"><td>'.strtoupper($teacher).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($subject).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($room).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($y).''.strtoupper($s).' | '.strtoupper($department).'</td></tr>
			</table>';
		}
		else if($year!='default' and $shift!='default' and $dept=='sc')
		{
			$val=
			'<table>
				<tr class="text-center font"><td>'.strtoupper($teacher).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($subject).'</td></tr>
				<tr class="text-center font"><td>'.strtoupper($room).'</td></tr>
				<tr class="text-center font"><td> DEPT-'.strtoupper($department).'</td></tr>
			</table>';
		}
		return $val;
		
	} 
	//--------------------------------------------------------------
	function pr($i,$s,$y,$teacher,$room,$subject,$batch,$department)
	{	
		global $year;
		global $shift;
		global $dept;
		if($year!='default' and $shift!='default')
		{
			if($i==1)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
				</table>';
			}
			else if($i==2)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
				</table>';
			}
			else if($i==3)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
						<tr class="text-center font">
						<td>'.$batch[2].'|</td>
						<td>'.$teacher[2].'|</td>
						<td>'.$subject[2].'|</td>
						<td >'.$room[2].'</td>
					</tr>
				</table>';
			}
		}
		else if(($year=='default' or $shift=='default') and $dept!='sc')
		{
			if($i==1)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | PR</center></td>
					</tr>
				</table>';
			}
			else if($i==2)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | PR</center></td>
					</tr>
				</table>';
			}
			else if($i==3)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[2].'|</td>
						<td>'.$teacher[2].'|</td>
						<td>'.$subject[2].'|</td>
						<td >'.$room[2].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | PR</center></td>
					</tr>
				</table>';
			}
		} 
		else if(($year=='default' or $shift=='default') and $dept=='sc')
		{
			if($i==1)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | '.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
			else if($i==2)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | '.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
			else if($i==3)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[2].'|</td>
						<td>'.$teacher[2].'|</td>
						<td>'.$subject[2].'|</td>
						<td >'.$room[2].'</td>
					</tr>
					<tr>
						<td colspan=4><center>'.strtoupper($y.''.$s).' | '.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
		}
		else if($year!='default' and $shift!='default' and $dept=='sc')
		{
			if($i==1)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr>
						<td colspan=4><center>DEPT-'.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
			else if($i==2)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr>
						<td colspan=4><center>DEPT-'.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
			else if($i==3)
			{
				$val='<table>
					<tr class="text-center font">
						<td>'.$batch[0].'|</td>
						<td>'.$teacher[0].'|</td>
						<td>'.$subject[0].'|</td>
						<td >'.$room[0].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[1].'|</td>
						<td>'.$teacher[1].'|</td>
						<td>'.$subject[1].'|</td>
						<td >'.$room[1].'</td>
					</tr>
					<tr class="text-center font">
						<td>'.$batch[2].'|</td>
						<td>'.$teacher[2].'|</td>
						<td>'.$subject[2].'|</td>
						<td >'.$room[2].'</td>
					</tr>
					<tr>
						<td colspan=4><center> DEPT-'.strtoupper($department).'</center></td>
					</tr>
				</table>';
			}
		}
		return $val;	
	}
	//----------------------     
	function fetch($day,$st)
	{
		$et=$st+1; 
		global $year;
		global $shift;
		global $dept;
		global $teacher_id;
		global $room_id;
		global $con;
		global $sem;
		$type='null';
		$i=0;
		if($dept!='sc')
		{
	
			if($shift!="default" and $year!="default" and $teacher_id=="default" and $room_id=="default") 
			{
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and  m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						return th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				
				}
				else if($type=='pr')
				{
					$i=0;
					$batch=array();
					$teacher_code=array();
					$subject_name=array();
					$room_no=array();
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.dept='$dept'and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
			{  
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
			{  
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}	
				}
			}
			else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
			{ 
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
			{  
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);	
					}
				}
				else if($type=='pr')
				{

					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
			{
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}  		
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			  
			}
			else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
			{  
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}  
				if($type=='th')
				{	
			//echo "$type $st $et $day $shift $room_id";
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			} 
			else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
			{  
			 //echo "----$st $et $day $teacher_id $dept $sem ----";
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					 $q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			} 
			else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
			{  
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					 $q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			}
			else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
			{ 
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
			{ 
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
			{ 
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and room_id='$room_id' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
			{ 
				$q=mysqli_query($con,"select type from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$row['dept']);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
		}
		else if($dept=='sc')
		{
			if($shift!='default' and $year!='default' and $teacher_id=='default' and $room_id=='default') // by shift & year
			{
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$i=0;
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.dept2='$dept'and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
					   $batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}	
				}
			}
			else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
			{ 
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and room_id=$room_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);	
					}
				}
				else if($type=='pr')
				{

					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.year='$year' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
			{
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}  		
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			  
			}
			else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and room_id=$room_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}  
				if($type=='th')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.shift='$shift' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			} 
			else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.dept,m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					 $q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and t.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			} 
			else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
			{  
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$room_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}  
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					 $q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and r.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}	
			}
			else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
			{ 
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id=$room_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
			{ 
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
			{ 
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and room_id='$room_id' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
			else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
			{ 
				$q=mysqli_query($con,"select type,dept from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and room_id='$room_id' and teacher_id=$teacher_id and dept2='$dept' and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
					$type=$row['type'];
					$department=$row['dept'];
				}
				if($type=='th')
				{	
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' ") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						th($row['shift'],$row['year'],$row['teacher_code'],$row['room_no'],$row['subject_name'],$row['room_id'],$department);
					}
				}
				else if($type=='pr')
				{
					$q=mysqli_query($con,"select m.*,t.*,r.*,s.* from main_table m,teacher t,room r,subject s where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.room_id=$room_id and m.teacher_id=$teacher_id and m.dept2='$dept' and t.teacher_id=m.teacher_id and r.room_id=m.room_id and s.subject_id=m.subject_id and m.semester='$sem' order by batch asc") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))
					{
						$batch[$i]=strtoupper($row['batch']);
						$teacher_code[$i]=strtoupper($row['teacher_code']);
						$subject_name[$i]=strtoupper($row['subject_name']);
						$room_no[$i++]=strtoupper($row['room_no']);
						$s=$row['shift'];
						$d=$row['dept'];
						$y=$row['year'];
					}
					if($i>0)
					{
						return pr($i,$s,$y,$teacher_code,$room_no,$subject_name,$batch,$d);
					}
				}
			}
		}
	}
	
//-------------------------------
function loadCounter($type)
{
	global $year;
	global $shift;
	global $dept;
	global $teacher_id;
	global $room_id;
	global $con;
	global $sem;
    $cntr=0;
	//echo "$sem";
	//echo "-----------------".$_REQUEST['loadCounter'];
	//echo " type=".$type." shift=".$shift." year=".$year." teacher=".$teacher_id." room_id=".$room_id." dept=".$dept." st=".$st." day=".$day; 
	if($dept!='sc')
	{
		if($shift!='default' and $year!='default' and $teacher_id=='default' and $room_id=='default') // by shift & year
		{
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and year='$year' and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
		{  
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;			
		}
		else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
		{  
			$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
	    	return $cntr;
		}
		else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
		{  
			$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and room_id=$room_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
		{
			
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;			
		}
		else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
		{  
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}  
			return $cntr;
		} 
		else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
		{  
			$q=mysqli_query($con,"select type from main_table where teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;
		} 
		else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
		{  
			$q=mysqli_query($con,"select type from main_table where room_id=$room_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;
		}
		else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id=$room_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
		{ 
			$q=mysqli_query($con,"select type from main_table where room_id='$room_id' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
			
		}
		else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and teacher_id=$teacher_id and type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
	}
}
//-------------------------------
function loadCounterAll()
{
	global $year;
	global $shift;
	global $dept;
	global $teacher_id;
	global $room_id;
	global $con;
	global $sem;
    $cntr=0;
	//echo "$sem";
	//echo "-----------------".$_REQUEST['loadCounter'];
	//echo " type=".$type." shift=".$shift." year=".$year." teacher=".$teacher_id." room_id=".$room_id." dept=".$dept." st=".$st." day=".$day; 
	if($dept!='sc')
	{
		if($shift!='default' and $year!='default' and $teacher_id=='default' and $room_id=='default') // by shift & year
		{
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $teacher_id!='default' and $year=='default' and $room_id=='default') // by teacher & shift
		{  
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;			
		}
		else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id=='default') // by year & shift & teacher
		{  
			$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by all
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and shift='$shift' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $year!='default' and $room_id!='default' and $teacher_id=='default') // by room & year & shift
		{  
			$q=mysqli_query($con,"select type from main_table where year='$year' and shift='$shift' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift!='default' and $room_id!='default' and $teacher_id!='default' and $year=='default') // by room & shift & teacher
		{
			
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;			
		}
		else if ($shift!='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room & shift
		{  
			$q=mysqli_query($con,"select type from main_table where shift='$shift' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}  
	        return $cntr;
		} 
		else if ($shift=='default' and $room_id=='default' and $teacher_id!='default' and $year=='default') // by teacher
		{  
			$q=mysqli_query($con,"select type from main_table where teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;
		} 
		else if ($shift=='default' and $room_id!='default' and $teacher_id=='default' and $year=='default') // by room
		{  
			$q=mysqli_query($con,"select type from main_table where room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			} 
			return $cntr;
		}
		else if ($shift=='default' and $year!='default' and $teacher_id=='default' and $room_id!='default') // by room & year
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id=='default')// by teacher & year
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
		else if ($shift=='default' and $year=='default' and $teacher_id!='default' and $room_id!='default')// by teacher & room
		{ 
			$q=mysqli_query($con,"select type from main_table where room_id='$room_id' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
			
		}
		else if ($shift=='default' and $year!='default' and $teacher_id!='default' and $room_id!='default')// by year & teacher & room
		{ 
			$q=mysqli_query($con,"select type from main_table where year='$year' and room_id='$room_id' and teacher_id=$teacher_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			return $cntr;
		}
	}
}
//-------------------------------
function loadCounterMasterThPr()
{
	$sem=$_REQUEST["sem"];
	$dept=$_REQUEST["dept"];
	//$type=$_REQUEST['type'];
    $cntr=0;
	$q=mysqli_query($con,"select type from main_table where type='$type' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	return $cntr;
}
//-------------------------------
function loadCounterMasterAll()
{
	$sem=$_REQUEST["sem"];
	$dept=$_REQUEST["dept"];
    $cntr=0;
	$q=mysqli_query($con,"select type from main_table where dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	return $cntr;
}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------

	echo $_REQUEST['year']."".$_REQUEST['room']."".$_REQUEST['shift']."".$_REQUEST['teacher'];
	if($_REQUEST['teacher']!='default' or $_REQUEST['room']!='default' or $_REQUEST['shift']!='default' or $_REQUEST['year']!='default' or $_REQUEST['dept'])
	{
	    echo "-------------------";
		$teacher_id=$_REQUEST['teacher'];
		$room_id=$_REQUEST['room'];
		$shift=$_REQUEST['shift'];
		$year=$_REQUEST['year'];
		$dept=$_REQUEST['dept'];
		$sem=$_REQUEST['sem'];
		$years='';
		$shifts='';
		$rooms='';
		$teacher='';
		
		$total=loadCounterAll();
			echo "------$total------";
	
		$totalTH=loadCounter('th');
		$totalPR=loadCounter('pr');
		//------------------------------------------
		if($dept=='if')
		{
			$department='Information Teachnology(IF)';
		}
		else if($dept=='co')
		{
			$department='Computer Science(CO)';
		}
		else if($dept=='me')
		{
			$department='Mechanical Department(ME)';
		}
		//--------------
		if($shift=='fs')
		{
			$shifts='First Shift';
		}
		else if($shift=='ss')
		{
			$shifts='Second Shift';
		}
		//-------------
		if($year=='fy')
		{
			$years='First Year';
		}
		else if($year=='sy')
		{
			$years='Second Year';
		}
		else if($year=='ty')
		{
			$years='Third Year';
		}
		//----------------------
		if($room_id !='default')
		{
			$q=mysqli_query($con,"select room_no from room where room_id=$room_id") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
			    $rooms="Room No.".$row['room_no'];   
			}
		}
		if($teacher_id!='default')
		{
			$q=mysqli_query($con,"select * from teacher where teacher_id=$teacher_id") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				if($row['designation']=="visitor")
					$teacher=" ".strtoupper($row['teacher_code'])." : ".strtoupper($row['first_name'])."  ".strtoupper($row['last_name'])." ";
				else if($row['designation']=="hod")
					$teacher="HOD : ".strtoupper($row['first_name'])." ".strtoupper($row['last_name'])."(".strtoupper($row['teacher_code']).")";
				else if($row['designation']=="professor")
					$teacher="Prof. : ".strtoupper($row['first_name'])." ".strtoupper($row['last_name'])."(".strtoupper($row['teacher_code']).")";
			}
		}
		//$to = $_REQUEST['to'];
		$to = "manishyadav7208@gmail.com";
		$subject = "Government Polytechnic Mumbai< Department Of ".$department." Time Table >";

		
		echo $to."-------------";
		$message = '
		<html>
		<head>
		<style>
		.border{
			  border : 1px solid white;
			  border-collapse: collapse;
			 
			}
			 
			 #grad{
				background-color: #cccccc;
				color:white;
				background-image: radial-gradient(cyan 1%, blue, cyan);
			}
		 #fg{
			  background-image: url("poly.png");
				background-repeat: no-repeat, repeat;
				color:white;
			}
			#dept{
				font-size:20px;
			}
		</style>
		<head>
		<body>
		 <table class="border" id="grad">
			<thead class="border">
				<tr class="border">
					<th colspan=11 class="border"><h1><center id="dept">Department Of '.$department.'</center></h1></th>
				</tr>
				<tr class="border">
					<th colspan=2 class="border"><center>'.$teacher.'</center></th>
					<th colspan=7 class="border"><h3>
						<center><span>'.$years.'</span>&nbsp; <span>'.$shifts.'</span> &nbsp;<span>'.$rooms.'</span></center></h3>
					</th>
					<th colspan=2 class="border"><center>LOAD : <span>'.$total.'</span> ( TH=<span>'.$totalTH.'</span>,PR=<span>'.$totalPR.'</span> )</center></th>
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
				<td class="border"><center>'.fetch("mon",8).'</center></td>
				<td class="border"><center>'.fetch("mon",9).'</center></td>
				<td class="border"><center>'.fetch("mon",10).'</center></td>
				<td class="border"><center>'.fetch("mon",11).'</center></td>
				<td class="border"><center>'.fetch("mon",12).'</center></td>
				<td class="border"><center>'.fetch("mon",13).'</center></td>
				<td class="border"><center>'.fetch("mon",14).'</center></td>
				<td class="border"><center>'.fetch("mon",15).'</center></td>
				<td class="border"><center>'.fetch("mon",16).'</center></td>
				<td class="border"><center>'.fetch("mon",17).'</center></td>
			</tr>
			<tr class="border">
				<th class="border">TUESDAY</th>
			    <td class="border"><center>'.fetch("tue",8).'</center></td>
				<td class="border"><center>'.fetch("tue",9).'</center></td>
				<td class="border"><center>'.fetch("tue",10).'</center></td>
				<td class="border"><center>'.fetch("tue",11).'</center></td>
				<td class="border"><center>'.fetch("tue",12).'</center></td>
				<td class="border"><center>'.fetch("tue",13).'</center></td>
				<td class="border"><center>'.fetch("tue",14).'</center></td>
				<td class="border"><center>'.fetch("tue",15).'</center></td>
				<td class="border"><center>'.fetch("tue",16).'</center></td>
				<td class="border"><center>'.fetch("tue",17).'</center></td>
			</tr>
			<tr class="border">
				<th class="border">WEDNESDAY</th>
				<td class="border"><center>'.fetch("wed",8).'</center></td>
				<td class="border"><center>'.fetch("wed",9).'</center></td>
				<td class="border"><center>'.fetch("wed",10).'</center></td>
				<td class="border"><center>'.fetch("wed",11).'</center></td>
				<td class="border"><center>'.fetch("wed",12).'</center></td>
				<td class="border"><center>'.fetch("wed",13).'</center></td>
				<td class="border"><center>'.fetch("wed",14).'</center></td>
				<td class="border"><center>'.fetch("wed",15).'</center></td>
				<td class="border"><center>'.fetch("wed",16).'</center></td>
				<td class="border"><center>'.fetch("wed",17).'</center></td>
			</tr>
			<tr class="border">
				<th class="border">THURSDAY</th>
			    <td class="border"><center>'.fetch("thu",8).'</center></td>
				<td class="border"><center>'.fetch("thu",9).'</center></td>
				<td class="border"><center>'.fetch("thu",10).'</center></td>
				<td class="border"><center>'.fetch("thu",11).'</center></td>
				<td class="border"><center>'.fetch("thu",12).'</center></td>
				<td class="border"><center>'.fetch("thu",13).'</center></td>
				<td class="border"><center>'.fetch("thu",14).'</center></td>
				<td class="border"><center>'.fetch("thu",15).'</center></td>
				<td class="border"><center>'.fetch("thu",16).'</center></td>
				<td class="border"><center>'.fetch("thu",17).'</center></td>
			</tr>
			<tr class="border">
				<th class="border">FRIDAY</th>
				<td class="border"><center>'.fetch("fri",8).'</center></td>
				<td class="border"><center>'.fetch("fri",9).'</center></td>
				<td class="border"><center>'.fetch("fri",10).'</center></td>
				<td class="border"><center>'.fetch("fri",11).'</center></td>
				<td class="border"><center>'.fetch("fri",12).'</center></td>
				<td class="border"><center>'.fetch("fri",13).'</center></td>
				<td class="border"><center>'.fetch("fri",14).'</center></td>
				<td class="border"><center>'.fetch("fri",15).'</center></td>
				<td class="border"><center>'.fetch("fri",16).'</center></td>
				<td class="border"><center>'.fetch("fri",17).'</center></td>
			    
			</tr>
			<tr class="border">
				<th class="border">SATURDAY</th>
			   	<td class="border"><center>'.fetch("sat",8).'</center></td>
				<td class="border"><center>'.fetch("sat",9).'</center></td>
				<td class="border"><center>'.fetch("sat",10).'</center></td>
				<td class="border"><center>'.fetch("sat",11).'</center></td>
				<td class="border"><center>'.fetch("sat",12).'</center></td>
				<td class="border"><center>'.fetch("sat",13).'</center></td>
				<td class="border"><center>'.fetch("sat",14).'</center></td>
				<td class="border"><center>'.fetch("sat",15).'</center></td>
				<td class="border"><center>'.fetch("sat",16).'</center></td>
				<td class="border"><center>'.fetch("sat",17).'</center></td>
			</tr>
		</tbody>
	</table>
	<table>
			<tr>
			    <th colspan=4><center>Time Table Incharge</center></th>
			    <th colspan=3><center>Head Of Department</center></th>
			    <th colspan=4><center>Principal</center></th>
			</tr>
			<tr>
			    <td colspan=4><center>________________</center></td>
			     <td colspan=3><center>DR. Rajesh Patil</center></td>
			    <td colspan=4><center>________________</center></td>
			</tr>
  </table>
<body>
</html>
';
			

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <manishyadav8286@gmail.com>' . "\r\n";
		$headers .= 'Cc: manishyadav8286@gmail.com' . "\r\n";

		mail($to,$subject,$message,$headers);
		echo "mail sent";		
	}
}
?>
</body>
</html>