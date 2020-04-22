<?php 
include('connection.php'); 
$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db'));

function check_room($con,$st,$et,$day,$year,$shift,$dept,$semester)
{
	$cntr=0;
	global $one;
	$room='';
	$id=0;
	$q= mysqli_query($con,"select r.dept,m.type,m.sr_no,m.room_id from main_table m,room r where m.start_time=$st and m.end_time=$et and m.day='$day' and m.year='$year' and m.shift='$shift' and m.type='th' and r.dept='$dept' and m.dept='$dept' and m.semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
		$one++;
		$room=$row['room_id'];
		$id=$row['sr_no'];
		echo $row['dept'];
		return array($cntr,$one,$room,$id);
	}
	return array($cntr,$one,$room,$id);
}
function config_room($con,$year,$shift,$dept,$semester)
{
	$days=array('mon','tue','wed','thu','fri');
	$cntr=0;
	global $one;
	$room='';
	$id=0;
	for($i=0;$i<5;$i++)
	{
		for($j=8;$j<18;$j++)
		{
			$st=$j;
			$et=$st+1;
			$day=$days[$i];
			
			$result=check_room($con,$st,$et,$day,$year,$shift,$dept,$semester);
			
			$cntr=$result[0];
			$one=$result[1];
			$current_room=$result[2];
			$id=$result[3];
			
			if($cntr>0 and $one==1)
			{
				$first_room=$current_room;	
			}
			else if($cntr>0 and $one>1)
			{
				if($first_room!=$current_room)
				{
					echo "$st $et $day $current_room $first_room </br>";
				}
			}
		}
	}
}
$one=0;
config_room($con,'fy','fs','if','even');

?>