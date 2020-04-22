<?php
$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"gpm");

if(isset($_REQUEST['swap_button']))
{
	function move_pr($con,$id1,$id2,$teacher_id,$room_id,$subject_id,$shift,$subject_year,$batch,$subject_dept)
    {
		global $execution;
		$st1=0;
		$et1=0;
		$st2=0;
		$et2=0;
		$days=array("mon","tue","wed","thu","fri","sat");
		$fs_time=array(8,10,12,14,16);
		$ss_time=array(12,14,16,10,8);
		$day_cntr=0;
		$time_cntr=0;
		$time_cntr2=0;
		$room_status='no';
		$subject_type='pr';
		$dt='no';
		$prev_cntr=0;
		$next_cntr=0;
		$room_id=0;
		$day;
		$room;
		$room_no2='y'; 
		//-------------------------------START for check ROOM 2 available or not-----------------------------
		while($room_no2!='')
		{   
			$room_no1='y'; 
			//-------------------------------START for check ROOM 1 available or not-----------------------------
			while($room_no1!='')
			{
                $teacher_code2='y';
				//-------------------------------START for check TEACHER 2 available or not-----------------------------
				while($teacher_code2!='')
				{   
					$teacher_code1='y';
					//-------------------------------START for check TEACHER 1 available or not-----------------------------
					while($teacher_code1!='')
					{
					    $time2='y';
						//-------------------------------START for start_time/SPAce 2 available or not------------------------------
						while($time2!='')
						{
                            $time='y';
							//-------------------------------START for start_time/SPAce 1 available or not-----------------------------
						    while($time!='')
						    {  
								if($day_cntr!=count($days) and ($time_cntr!=count($fs_time) or $time_cntr!=count($ss_time)))
								{
									
									$day=$days[$day_cntr];
									if($shift=='fs')
									{
										$st1=$fs_time[$time_cntr];
										$et1=$st1+1;
									}
									else if($shift=='ss')
									{
										$st1=$ss_time[$time_cntr];
										$et1=$st1+1;
									}
									$dc=$day_cntr;
									$day_cntr++;
									if($day_cntr>=count($days)-1)
									{
										$day_cntr=0;
										$time_cntr++;
									}
								}
								else
								{	
									if(($time_cntr<count($fs_time) or $time_cntr2<count($ss_time)))
									{
										$day=$days[(count($days)-1)];
										if($shift=='fs')
										{
											$st1=$fs_time[$time_cntr2];
											$et1=$st1+1;
										}
										else if($shift=='ss')
										{
											$st1=$ss_time[$time_cntr2];
											$et1=$st1+1;
										}
									}
									$dc=5;
									$time_cntr2++;
								}
								if(($time_cntr2>count($fs_time) or $time_cntr2>count($ss_time)))
								{
									$dt='yes';
									$execution=false;
								}
								$pr_status=practical_status($con,$day,$days,$dc,$subject_id,$shift,$subject_year,$batch,$subject_dept);
								if($pr_status=='yes' and $dt!='yes')
								{
									if($room_id==0)
									{
										$room = empty_room($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept);
										if($room!=0)
										{
											$room_status='yes';
										} 
										else
										{
											$room_status='no';
										}
									}
									else
									{
										$room=$room_id;
										$room_status=0;
									} 
									if($room_status=='yes')
									{
										$pr_cntr=no_of_practical($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept);
										if($pr_cntr<2)
										{
											$time=time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept);
											//echo " -----time=".$time;
										}
										else
										{
											$time='no';
										}
									}
									else
									{
										$time='no';
									}
								}
								else
								{
									$time='no';
								}
								if($dt=='yes')
								{
								   $time='';
								}
							}
                            //-----------------------------END for check start_time/spacce 1 available or not----------------------------------
							if($dt=='yes')
							{
								$time2='';
							}
							else
							{
								$st2=$st1+1;
								$et2=$et1+1; 
								$time2=time_status($con,$st2,$et2,$day,$shift,$subject_year,$batch,$subject_dept);
							}
						}
                        //------------------------------END for check start_time/space 2 available or not-------------------------
						if($dt=='yes')
						{
							$teacher_code1='';
						}
						else
						{
							$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept'") or die (mysqli_error());
							$row=mysqli_fetch_array($q);
							$teacher_code1=$row['teacher_id'];
						}						
					}
					//-------------------------------END for check TEACHER 1 available or not-----------------------------
					if($dt=='yes')
					{
						$teacher_code2='';
					}
					else
					{
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept'") or die (mysqli_error());
						$row=mysqli_fetch_array($q);
						$teacher_code2=$row['teacher_id'];
					}	
				}
				//-------------------------------END for check TEACHER 2 available or not-----------------------------	
				if($dt=='yes')
				{
					$room_no1='';
				}
				else
				{
					$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and dept='$subject_dept'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$room_no1=$row['room_id'];
				}
			}
			//------------------------------END for check ROOM 1 available or not------------------------------
			if($dt=='yes')
			{
				$room_no2='';
			}
			else
			{
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and room_id=$room and dept='$subject_dept'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no2=$row['room_id'];	
			}	
			
		}
		//----------------------------END for check ROOM 2 available or not------------------------------
		if($dt!='yes')
		{
			echo "<br><br>room no ".$room." and teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." and from ".$st2." to ".$et2." on day ".$day." batch ".$batch;
			update_back($con,$id1,$id2,$st1,$et1,$day,$room,$subject_type);
		}
		else
		{
			echo "no space available";
		}
	} 
//--------------------------------------------------------------------------------------------------------
function practical_status($con,$day,$days,$day_cntr,$subject_id,$shift,$subject_year,$batch,$subject_dept)
{	
	$yesterday=0;
	$tomorrow=0;
	$today=0;
	if($day_cntr>0)   //----------practical status----------
	{
		$prev_day=$days[$day_cntr-1];
		$q=mysqli_query($con,"select * from main_table where day='$prev_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$yesterday++;
		}
	}
	if($day_cntr<5)
	{
		$next_day=$days[$day_cntr+1];
		$q=mysqli_query($con,"select * from main_table where day='$next_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$tomorrow++;
		}
	}
	$no_of_pr=0;
	$current_day=$days[$day_cntr];
	$q=mysqli_query($con,"select * from main_table where subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$no_of_pr++;
	}
	$current=$days[$day_cntr];
	$q=mysqli_query($con,"select * from main_table where day='$current' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	if(($yesterday==0 and $tomorrow==0 and $today==0) or $no_of_pr>=4 or $current_day=='sat')
	{
		return 'yes';
	}
	else
	{
		return 'no';	 
	}
}
//------------------------------------------------------------------------------
function no_of_practical($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept)
{
	$pr_cntr=0;
	$run=0;
	if($st1==8)
	{
		$q=mysqli_query($con,"select distinct year,shift from main_table where start_time=$st1 and end_time=$et1 and day='$day' and type='pr' and dept='$subject_dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			if(($row['year']!=$subject_year and $row['shift']!=$shift) or ($row['year']==$subject_year and $row['shift']!=$shift) or ($row['year']!=$subject_year and $row['shift']==$shift))
			{
				$pr_cntr++;
			}
		}
		return $pr_cntr;
	}
	else
	{
		return 0;
	}	
}
//---------------------------------------------------------------------------------
function time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept)
{
	$count=0;
	$type='null';
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	if($type=='pr')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{   
			$count++;
		}
		if($count==0)
		{
			return '';
		}
		else
		{
			return 'no';
		}
	}
	else if($type=='th')
	{
		return 'no';
	}
	else 
	{
		return '';
	}
}
//----------------------------------------------------end of pr function------------------------------------------------
function move_th($con,$st,$et,$temp_day,$id1,$teacher_id,$room_id,$subject_id,$shift,$subject_year,$batch,$subject_dept)
{

	$teacher_code='y';
	$time='y';
	$room_no='y';
	$time12='y';;
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15,16,17);
	$ss_time=array(12,13,14,15,16,17,11,10,9,8);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	$batch='null';
	$dt='no';
	global $execution;
	$id2=0;
	/*	while($time12!='')
	{ */
		$room_no='y'; 
		//-------------------------------START for check room available or not-----------------------------
		while($room_no!='')
		{
			$teacher_code='y';
			//-------------------------------START for check TEACHER 1 available or not-----------------------------
			while($teacher_code!='')
			{
                $time='y';
				//-------------------------------START for start_time/SPAce 1 available or not-----------------------------
				while($time!='')
				{ 
					if($day_cntr!=count($days) and ($time_cntr!=count($fs_time) or $time_cntr!=count($ss_time)))
					{
						$day=$days[$day_cntr];
						if($shift=='fs')
						{
							$st1=$fs_time[$time_cntr];
							$et1=$st1+1;
						}
						else if($shift=='ss')
						{
							$st1=$ss_time[$time_cntr];
							$et1=$st1+1;
						}
						$day_cntr++;
						if($day_cntr==count($days)-1)
						{
							$day_cntr=0;
							$time_cntr++;
						}
					}
					else
					{	
						if(($time_cntr<count($fs_time) or $time_cntr2<count($ss_time)))
						{
							$day=$days[(count($days)-1)];
							if($shift=='fs')
							{
								$st1=$fs_time[$time_cntr2];
								$et1=$st1+1;
							}
							else if($shift=='ss')
							{
								$st1=$ss_time[$time_cntr2];
								$et1=$st1+1;
							}
						}
						$time_cntr2++;
					}
					if(($time_cntr2>count($fs_time) or $time_cntr2>count($ss_time)))
					{
						$dt='yes';
						$execution=false;
					}
					//echo "  st1 ".$st1." day ".$day;
					$room=empty_room($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept);
					if($room!=0 and $dt!='yes' and $st1!=$st and $et1!=$et and $day!=$temp_day)
					{
						$q= mysqli_query($con,"select start_time from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
						$row=mysqli_fetch_array($q);								
						if($row['start_time']=='')
						{
							$time='';
						}
					}
					else if($dt=='yes')	
					{
						$time='';
					}						
				}
                //---------------------------END for check TIME available or not-----------------------
				if($dt=='yes')
				{
					$teacher_code='';
				}
				else
				{
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code=$row['teacher_id'];
				}
			}
			//-------------------------END for check TEACHER available or not-------------------------	
				if($dt=='yes')
				{
					$room_no='';
				}
				else
				{			
					$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and dept='$subject_dept'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$room_no=$row['room_id'];
				}
		}
		//-----------------------END for check ROOM available or not-------------------------
	/*	if(($st1==12 or $st1==13) and $dt!='yes')
		{
			$time12=time12($con,$st1,$day,$teacher_id,$room,$shift,$subject_dept);
		}
		else
		{
			$time12='';
		}
	} */ 
	if($dt!='yes')
	{	
		echo "<br><br>room no ".$room." and teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." on day ".$day;
		update_back($con,$id1,$id2,$st1,$et1,$day,$room,$subject_type);
	}
	else if($dt=='yes')
	{
		echo "no space available";
	}
}
//-----------------------------
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
function time12($con,$st,$day,$teacher_id,$room,$shift,$subject_dept)
{
	$shift2=shift($con,$shift);
	$st2=even_odd($con,$st);
	$et2=$st2+1;
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift2' and dept='$subject_dept' and ( teacher_id=$teacher_id or room_id=$room)") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	if($cntr==0)
	{
		return '';
	}
	else
	{
		return 'no';
	}	
}
//--------------------------end of th function-------------------------
function update_back($con,$id1,$id2,$st1,$et1,$day,$room,$subject_type) 
{
	$st2=$st1+1;            //--------------update back-----------------
	$et2=$et1+1;
	//echo "--id2=".$id2." type".$subject_type;
		mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$id1") or die (mysqli_error());
	if($subject_type=='pr')
		mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day',room_id=$room where sr_no=$id2") or die (mysqli_error());
}
function update_back_room($con,$id1,$id2,$room,$subject_type)
{
	mysqli_query($con,"update main_table set room_id=$room where sr_no=$id1") or die (mysqli_error());
	if($subject_type=='pr')
		mysqli_query($con,"update main_table set room_id=$room where sr_no=$id2") or die (mysqli_error());
}
//---------------------------------------------------------------------------
function empty_room($con,$st,$et,$day,$type,$teacher_id,$shift,$subject_dept)
{
	$room=0;
	$q1=mysqli_query($con,"select room_id from room where type='$type' and dept='$subject_dept'");
	while($row=mysqli_fetch_array($q1))
	{ 
		$count=0;
		$temp_room=$row['room_id'];
		$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$subject_dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$count++;
		}
		if($count==0)
		{
			if($type=='th' and ($st==12 or $st==13))
			{
				$t12=time12($con,$st,$day,$teacher_id,$temp_room,$shift,$subject_dept);
				if($t12=='')
				{
					return $temp_room;
				}
			}
			else
			{
				return $temp_room;
			}
		}		
	}
	return $room;
}
//----------------end of common functions---------------
function check_type($con,$st,$et,$day,$year,$shift,$dept)
{
	$type='th';
	$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	return $type;
}
//-----------------------------------------------------------------------
function pr_id($con,$st,$et,$day,$teacher_id,$room_id,$shift,$year,$dept)
{
	$st2=even_odd($con,$st);
	$et2=$st2+1;
	$id;
	$q2=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		return $row['sr_no'];
	}
}
//----------------------------------------------
function th_id($con,$st,$day,$shift,$year,$dept)
{
	$temp_st=even_odd($con,$st);
	$temp_et=$temp_st+1;
	$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift' and year='$year' and type='th' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		move_th($con,$temp_st,$temp_et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
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
//----------------------------------------------------------------------------------
function block($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
//------------------------------------------------------------------------------------------
function block_teacher($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
	//------------------------------------------------------------------------------------------
function block_teacherYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
//------------------------------------------------------------------------------------------
function block_room($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$room_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
//----------------------------------------------------------------------------------------------
function block_roomYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$room_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
//-----------------------------------------------------------------------------------------------------------------
function block_teacher_roomYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher_id,$room_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	}
//-------------------------------------------------------------------------------------------------------------------
function block_teacher_room_year($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher_id,$room_id,$dept,$type1)
	{
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$dept,$type1);
		}
	} 
//-----------------------------------------------------------------------------------
function check_back($con,$st,$et,$day,$shift,$year,$teacher_id,$room_id,$dept,$type1)
{
	
	if($type1=='pr')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and dept='$dept' and (teacher_id=$teacher_id or room_id=$room_id)") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			if($row['type']=='pr')
			{
				$room=0;
				$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept);
				if($row['room_id']==$room_id)
				{
					$room=empty_room($con,$st,$et,$day,'pr',$teacher_id,$row['shift'],$dept);
				}
				if($room==0)
				{
					move_pr($con,$row['sr_no'],$id2,$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
				}
				else if($room!=0)
				{
					update_back_room($con,$row['sr_no'],$id2,$room,'pr');
				}
			}
			else if($row['type']=='th')
			{
				move_th($con,$st,$et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
			}
		}
		$temp_st=even_odd($con,$st);
		$temp_et=$temp_st+1;
		$q=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and dept='$dept' and (teacher_id=$teacher_id or room_id=$room_id)") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			if($row['type']=='th')
			{
				move_th($con,$temp_st,$temp_et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
			}
		}
	}
	else if($type1=='th')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and dept='$dept' and (teacher_id=$teacher_id or room_id=$room_id)") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			if($row['type']=='pr')
			{
				$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept);
				move_pr($con,$row['sr_no'],$id2,$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
			}
			else if($row['type']=='th')
			{ 
				$room=0;
				if($row['room_id']==$room_id)
				{
					$room=empty_room($con,$st,$et,$day,'th',$teacher_id,$row['shift'],$dept);
				}
				if($room==0)
				{
					move_th($con,$st,$et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
				}
				else if($room!=0)
				{
					update_back_room($con,$row['sr_no'],0,$room,'th');
				}
			}
		}	
		if($st==12 or $st==13)
		{
			$t12=time12($con,$st,$day,$teacher_id,$room_id,$shift,$dept);
			if($t12=='no')
			{
				$shift2=shift($con,$shift);
				$temp_st=even_odd($con,$st);
				$temp_et=$temp_st+1;
				$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift2' and (teacher_id=$teacher_id or room_id=$room_id) and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					if($row['type']=='th')
					{
						$room=0;
						if($row['room_id']==$room_id)
						{
							$room=empty_room($con,$st,$et,$day,'th',$teacher_id,$row['shift'],$dept);
						}
						if($room==0)
						{
							move_th($con,$temp_st,$temp_et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
						}
						else if($room!=0)
						{
							update_back_room($con,$row['sr_no'],0,$room,'th');
						}
					}
				}
			}
		}	
	}
}
//--------------------------------------------------------------------------------------
function replace($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//---------------------------------------------------------------------------------------------------------
function replace_teacher($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//---------------------------------------------------------------------------------------------------------
function replace_teacherYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//-------------------------------------------------------------------------------------------------
function replace_room($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//--------------------------------------------------------------------------------------------------------
function replace_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//---------------------------------------------------------------------------------------------------------------
function replace_teacher_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$room_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//---------------------------------------------------------------------------------------------------------------------------
function replace_teacher_room_year($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$room_id,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$dept);
	}
}
//---------------------------------------------------------------------------------------------------
function replace_type($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept)
{
	if($type1=='pr' and $type2=='pr')
	{
		replace_pr($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept);
	}
	else 
	{
		replace_all($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept);
	}
}
//-------------------------------------------------------------------------------------------------
function replace_pr($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and type='pr' and batch='$batch' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$room=0;
		$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept);
		if($row['room_id']==$room_id)
		{
			$room=empty_room($con,$st,$et,$day,'pr',$teacher_id,$shift,$dept);
		}
		if($room==0)
		{
			move_pr($con,$row['sr_no'],$id2,$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
		}
		else if($room!=0)
		{
			update_back_room($con,$row['sr_no'],$id2,$room,'pr');
		}
	}
}
//--------------------------------------------------------------------------------------------------
function replace_all($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept)
{
	if($type1=='th' and $type2=='pr')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept);
			move_pr($con,$row['sr_no'],$id2,$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
		}
	}
	else if($type1=='pr' and $type2=='th')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			move_th($con,$temp_st,$temp_et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
		}
		th_id($con,$st,$day,$shift,$year,$dept);
	}
	else if($type1=='th' and $type2=='th')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			//echo " st=".$st." et".$et." day".$day." type1".$type1." type2".$type2;
			move_th($con,$st,$et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
		}
		if($st==12 or $st==13)
		{
			//echo " executed";
			$t12=time12($con,$st,$day,$teacher_id,$room_id,$shift,$dept);
			if($t12=='no')
			{
				$s=shift($con,$shift);
				$temp_st=even_odd($con,$st);
				$temp_et=$temp_st+1;
				
				$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$s' and (teacher_id='$teacher_id' or room_id='$room_id') and dept='$dept'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					if($row['type']=='th')
					{
						move_th($con,$temp_st,$temp_et,$day,$row['sr_no'],$row['teacher_id'],$row['room_id'],$row['subject_id'],$row['shift'],$row['year'],$row['batch'],$dept);
					}
				}
			}
		}
	}
}
//------------------------------------------------------------------------------------
function update($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept)
{
	$cntr1=0;
	$cntr2=0;
	echo "$st1 $et1 $day1 $year  $shift $dept";
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//----------------------------------------------------------------------------------------------------------
function update_teacher($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and year='$year' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//------------------------------------------------------------------------------------------------------------
function update_teacherYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//--------------------------------------------------------------------------------------------------
function update_room($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and year='$year' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		for($i=0;$i<$cntr2;$i++)
		{	
			$id=$ids2[$i];
			mysqli_query($con,"update main_table set start_time=$temp_st2,end_time=$temp_et2,day='$day2' where sr_no=$id")or die (mysqli_error());
		}
	}
	for($i=0;$i<$cntr1;$i++)
	{	
		$id=$ids1[$i];
		mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day2' where sr_no=$id")or die (mysqli_error());
	}
}
//------------------------------------------------------------------------------------------------------
function update_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and shift='$shift' and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//--------------------------------------------------------------------------------------------------------------------------
function update_teacher_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$room_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//--------------------------------------------------------------------------------------------------------------------------
function update_teacher_room_year($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher_id,$room_id,$dept)
{
	$cntr1=0;
	$cntr2=0;
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$ids1[$cntr1++]=$row['sr_no'];
	}
	if($type1=='pr')
	{
		$temp_st1=even_odd($con,$st1);
		$temp_et1=$temp_st1+1;
		$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and shift='$shift' and year='$year' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids2[$cntr2++]=$row['sr_no'];
		}
		$temp_st2=even_odd($con,$st2);
		$temp_et2=$temp_st2+1;
		updateLecture($con,$temp_st2,$temp_et2,$day2,$ids2,$cntr2);
	}
	updateLecture($con,$st2,$et2,$day2,$ids1,$cntr1);
}
//-------------------------------------------------
function updateLecture($con,$st,$et,$day,$ids,$cntr)
{
	for($i=0;$i<$cntr;$i++)
	{	
		$id=$ids[$i];
		mysqli_query($con,"update main_table set start_time=$st,end_time=$et,day='$day' where sr_no=$id")or die (mysqli_error());
	}
}
//---------end of function---------	
	$year=$_REQUEST["year"];
    $shift=$_REQUEST["shift"];
	$dept=$_REQUEST["dept"];
	$teacher=$_REQUEST["teacher"];
	$room=$_REQUEST["room"];
	$st1=$_REQUEST["time1"];
    $st2=$_REQUEST["time2"];
    $day1=$_REQUEST["day1"];
	$day2=$_REQUEST["day2"];
	$execution=true;
		$et1=$st1+1;
		$et2=$st2+1;
	//echo " st1".$st1." et1".$et1." st2".$st2." et2".$et2." shift".$shift;
	$type1=check_type($con,$st1,$et1,$day1,$year,$shift,$dept);
	$type2=check_type($con,$st2,$et2,$day2,$year,$shift,$dept);
	if($shift!='default' and $dept!='default' and $year!='default' and $teacher=='default' and $room=='default')
	{
		replace($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept);
		if($execution==true)
			block($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$dept,$type1);
		if($execution==true)
			update($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year!='default' and $teacher!='default' and $room=='default')
	{
		replace_teacher($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$dept);
		if($execution==true)
			block_teacher($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher,$dept,$type1);
		if($execution==true)
			update_teacher($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year=='default' and $teacher!='default' and $room=='default')
	{
		replace_teacherYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$dept);
		if($execution==true)
			block_teacherYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher,$dept,$type1);
		if($execution==true)
			update_teacherYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year!='default' and $teacher=='default' and $room!='default')
	{
		replace_room($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room,$dept);
		if($execution==true)
			block_room($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$room,$dept,$type1);
		if($execution==true)
			update_room($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year=='default' and $teacher=='default' and $room!='default')
	{
		replace_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room,$dept);
		if($execution==true)
			block_roomYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$room,$dept,$type1);
		if($execution==true)
		update_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$room,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year=='default' and $teacher!='default' and $room!='default')
	{
		replace_teacher_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$room,$dept);
		if($execution==true)
			block_teacher_roomYear($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher,$room,$dept,$type1);
		if($execution==true)
			update_teacher_roomYear($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$room,$dept);
	}
	else if($shift!='default' and $dept!='default' and $year!='default' and $teacher!='default' and $room!='default')
	{
		replace_teacher_room_year($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$room,$dept);
		if($execution==true)
			block_teacher_room_year($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$teacher,$room,$dept,$type1);
		if($execution==true)
			update_teacher_room_year($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$teacher,$room,$dept);
	}
}
?>