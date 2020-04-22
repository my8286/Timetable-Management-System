<?php
$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"gpm");

if(isset($_REQUEST['swap_button']))
{
	function pr($con,$id1,$id2,$st,$tday,$teacher_id,$subject_id,$room_id,$subject_year,$shift,$batch,$subject_dept,$subject_dept2)
    {
		$st1=0;
		$et1=0;
		$st2=0;
		$et2=0;
		$days=array("mon","tue","wed","thu","fri","sat");
		$fs_time=array(8,10,12,14);
		$ss_time=array(16,14,12,10);
		$day_cntr=0;
		$time_cntr=0;
		$time_cntr2=0;
		global $new_room;
		global $execution;
		global $sem;
		$temp_st=even($con,$st);
		$room_status='no';
		$subject_type='pr';
		$dt='no';
		$prev_cntr=0;
		$next_cntr=0;
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
									$dt='yes';
									$execution=false;
								}
								if(($time_cntr2>count($fs_time)-1) or ($time_cntr2>count($ss_time)-1))
								{
									$dt='yes';
								}
								$prev=true;
								if($prev==true)
								{
						
									if($room_id==0)
									{
										$room=empty_room($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2,$sem);
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
									//echo "  r=$room_status ";
									if($room_status=='yes')
									{
										$pr_cntr=1;//no_of_practical($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept);
										//echo "<br>st=$st1 day=$day  pr_cntr=$pr_cntr ";
										if($pr_cntr<2)
										{
											move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
											move_theory($con,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
											check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
											check_back_theoryPR($con,$teacher_id,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
											$h8=true;//hours8($con,$st1,$day,$teacher_id,$subject_dept,$subject_dept2);
											if($h8==true)
											{
												$time=time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept,$sem);
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
								}
								else
								{
									$time='no';
								}
								if($dt=='yes')
								   $time='';
							}
                            //-----------------------------END for check start_time/space 1 available or not----------------------------------
							if($dt=='yes')
							{
								$time2='';
							}
							else
							{
								$st2=$st1+1;
								$et2=$et1+1; 
								$time2=time_status($con,$st2,$et2,$day,$shift,$subject_year,$batch,$subject_dept,$sem);
							}
						}
                        //------------------------------END for check start_time/space 2 available or not-------------------------
						if($dt=='yes')
						{
							$teacher_code1='';
						}
						else
						{
							//echo " $st1 $et1 $day $teacher_id $subject_dept $subject_dept2";
							if($subject_dept2=='sc')
							{
								//echo "--pr---$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
							}
							else
							{
								check_back_pr_teacher($con,$temp_st,$tday,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2,$sem);
							}
							move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
							move_theory_back($con,$st2,$et2,$st1,$et1,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$sem);
							$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
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
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
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
					$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
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
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no2=$row['room_id'];	
			}	
		}
		//----------------------------END for check ROOM 2 available or not------------------------------
		if($dt!='yes')
		{
			//echo "<br>----".strtoupper($subject_year)."".strtoupper($shift)." PR Room no ".$room." and Teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." and from ".$st2." to ".$et2." on day ".$day." batch ".strtoupper($batch)."</br>";
			updatePR($con,$id1,$id2,$st1,$et1,$st2,$et2,$day,$room);
		}
		else
		{
			$new_room++;
			$execution=false;
			echo "<br>PR no space available for batch $batch</br>";
		}
	}
//--------------------------------------------------------------
function updatePR($con,$id1,$id2,$st1,$et1,$st2,$et2,$day,$room)
{
	echo "...id1=$id1 id2=$id2 st1=$st1 st2=$st2 day=$day...";
	mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$id1") or die (mysqli_error());
	mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day',room_id=$room where sr_no=$id2") or die (mysqli_error());
}
//-------------------------------------------------------------------------------------------------------------------------------
function check_back_pr_teacher($con,$temp_st,$tday,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2,$sem)
{
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='pr' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++; 
		$sr_no1=$row['sr_no'];
		$b=$row['batch'];
		$teacher_id=$row['teacher_id'];
		$room_id=$row['room_id'];
		$shift=$row['shift'];
		$year=$row['year'];
		$q2=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and batch='$b' and teacher_id=$teacher_id and type='pr' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$sr_no2=$row['sr_no'];
		}
	}
	if($cntr>0)
	{
		check_swap($con,$sr_no1,$sr_no2,$temp_st,$tday,$teacher_id,$room_id,$st1,$et1,$st2,$et2,$day,$shift,$year,$b,$subject_dept,$subject_dept2,$sem);
	}
}
//-----------------------------------------------------------------------------------------------------------------------------------------------
function check_swap($con,$tid1,$tid2,$temp_st,$temp_day,$teacher_id,$room_id,$tst1,$tet1,$tst2,$tet2,$tday,$shift,$subject_year,$batch,$subject_dept,$subject_dept2,$sem)
{
	$teacher_code4='no';
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,10,12,14);
	$ss_time=array(14,16,12,10);
	$day_cntr=0;
	$time_cntr=0;
	global $temp_st;
	global $temp_day;
	$dt='no';
	$dept2='sc';
	$st1;$st2;$et1;$et2;$fill;
	while($teacher_code4!='')
	{
		//--------------------------
		$teacher_code3='no';
		while($teacher_code3!='')
		{
			//------------------------
			$teacher_code2='no';
			while($teacher_code2!='')
			{
				//----------------------
				$teacher_code1='no';
				while($teacher_code1!='')
				{
					//---------------------
					$time='no';
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
							$dt='yes';
						}
						$temp_st2=even_odd($con,$temp_st);
						if(($st1==$temp_st and $day==$temp_day ) or (($temp_st==$st1 or $temp_st2==$st1) and $temp_day==$day))
						{
							$time='no';
						}
						else
						{
							$count=0;
							$type='null';
							$st2=$st1+1;
							$et2=$et1+1;
							$type1='no';
							$type2='no';
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))
							{
								$type1=$row['type'];
							}
							$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))
							{
								$type2=$row['type'];
							}
							if($type1=='pr' and $type2=='pr')
							{	//echo "-----$st1 $et1 $day $shift $subject_year $batch $subject_dept-----";
								$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept'") or die (mysqli_error());
								while($row=mysqli_fetch_array($q))
								{   
									//echo "-----------8888------------------";
									$id1=$row['sr_no'];
									$teacher=$row['teacher_id'];
									$subject=$row['subject_id'];
									$room_id=$row['room_id'];
									$dept2=$row['dept2'];
									$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept'") or die (mysqli_error());
									while($row=mysqli_fetch_array($q))
									{   
										$id2=$row['sr_no'];
										$count++;
									}
								}
							}
							if($count>0 and $type1=='pr' and $type2=='pr' and $dept2==$subject_dept)
							{
								$time='';
								$fill='avail';
								echo "--sss---$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
							}
							else if($count==0 and $type1=='no' and $type2=='no' and $dept2==$subject_dept)
							{
								$room = empty_room($con,$st1,$et1,$day,'pr',$teacher_id,$shift,$subject_dept,$dept2,$sem);
								if($room!=0)
								{
									$room_id=$room;
									$fill='blank';
									$time='';
									echo "---sss--$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
								}
							}
							else
							{
								$time='no';
							}
						}	
						if($dt=='yes')
						{
							$time='';
						}
					}
					//-------------------------------END for check Time 1 available or not-----------------------------
					//echo " $st1 $et1 $day $teacher_id $subject_dept $subject_dept2";
					if($dt=='yes')
					{
						$teacher_code1='';
					}
		 			else
					{
						$count=0;
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
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
					$count=0;
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code2=$row['teacher_id'];
				}
			}
			//-------------------------------END for check TEACHER 2 available or not-----------------------------
			if($dt=='yes' or $fill=='blank')
			{
				$teacher_code3='';
			}
			else if($fill=='avail')
			{
				$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst1 and end_time=$tet1 and day='$tday' and teacher_id=$teacher and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$teacher_code3=$row['teacher_id'];
			}
		}
		//-------------------------------END for check TEACHER 3 available or not-----------------------------
		if($dt=='yes' or $fill=='blank')
		{
			$teacher_code4='';
		}
		else if($fill=='avail')
		{
			$count=0;
			$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst2 and end_time=$tet2 and day='$tday' and teacher_id=$teacher and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
			$row=mysqli_fetch_array($q);
			$teacher_code4=$row['teacher_id'];
		}
	}
	//-------------------------------END for check TEACHER 4 available or not-----------------------------
	if($dt!='yes')
	{
		$q=mysqli_query($con,"select * from main_table where sr_no=$tid1") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ts=$row['subject_id'];
			$tt=$row['teacher_id'];
		}
		if($fill=='avail')
		{
			mysqli_query($con,"update main_table set teacher_id=$teacher,subject_id=$subject where sr_no=$tid1") or die (mysqli_error());
			mysqli_query($con,"update main_table set teacher_id=$teacher,subject_id=$subject where sr_no=$tid2") or die (mysqli_error());
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts where sr_no=$id1") or die (mysqli_error());
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts where sr_no=$id2") or die (mysqli_error());	
		}
		elseif($fill=='blank')
		{
			mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room_id where sr_no=$tid1") or die (mysqli_error());
			mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day',room_id=$room_id where sr_no=$tid2") or die (mysqli_error());
		}		

		//echo "PR ".strtoupper($subject_year)."".strtoupper($shift)." st=$st1 day=$day $batch";
	}
}
//--------------------------------------------------------------------------------------------------------
function practical_status($con,$day,$days,$day_cntr,$subject_id,$shift,$subject_year,$batch,$subject_dept,$sem)
{	
	$yesterday=0;
	$tomorrow=0;
	$today=0;
	if($day_cntr>0)   //--------------practical status--------------
	{
		$prev_day=$days[$day_cntr-1];
		$q=mysqli_query($con,"select * from main_table where day='$prev_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$yesterday++;
		}
	}
	if($day_cntr<5)
	{
		$next_day=$days[$day_cntr+1];
		$q=mysqli_query($con,"select * from main_table where day='$next_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$tomorrow++;
		}
	}
	$no_of_pr=0;
	$current_day=$days[$day_cntr];
	$q=mysqli_query($con,"select * from main_table where subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$no_of_pr++;
	}
	$current=$days[$day_cntr];
	$q=mysqli_query($con,"select * from main_table where day='$current' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	if($today==0)
	{
		return 'yes';
	}
	else
	{
		return 'no';	 
	}
}
//------------------------------------------------------------------------------------------
function empty_room($con,$st,$et,$day,$type,$teacher_id,$shift,$subject_dept,$subject_dept2,$sem)
{
	$room=0;
	if($subject_dept2=='sc' and $type=='pr')
	{
		$tmp=$subject_dept;
		$subject_dept=$subject_dept2;
		$subject_dept2=$tmp;
	}
	else{
		$subject_dept2=$subject_dept;
	}
//	echo "-----$subject_dept $subject_dept2-----";
	$q1=mysqli_query($con,"select room_id from room where type='$type' and dept='$subject_dept'");
	while($row=mysqli_fetch_array($q1))
	{ 
		$count=0;
		$temp_room=$row['room_id'];
		//echo $temp_room;
		if($subject_dept2!='sc')
			$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$subject_dept2' and semester='$sem'") or die (mysqli_error());
		else
			$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$count++;
		}
		if($count==0)
		{
			if($type=='th' and ($st==12 or $st==13))
			{
				$t12=time12($con,$st,$day,$teacher_id,$temp_room,$shift,$subject_dept,$subject_dept2,$sem);
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
//------------------------------------------------------------------------------------------------
function empty_room2($con,$st,$et,$day,$type,$teacher_id,$shift,$subject_dept,$subject_dept2,$sem)
{
	$room=0;
	$cntr=0;
	$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	if($cntr==0)
	{
		mysqli_query($con,"insert into room (room_no,dept,type) values ('new','new','new')") or die (mysqli_error());
	}
	$q1=mysqli_query($con,"select * from room where (type='th' or type='new') and (dept='$subject_dept' or dept='new')");
	while($row=mysqli_fetch_array($q1))
	{ 
		$count=0;
		$temp_room=$row['room_id'];
		$r=$row['room_no'];
		//echo $temp_room;
		if($r!='new')
		{
			$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				$count++;
			}
			if($count==0)
			{
				if($type=='th' and ($st==12 or $st==13))
				{
					$t12=time12($con,$st,$day,$teacher_id,$temp_room,$shift,$subject_dept,$subject_dept2,$sem);
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
		else if($room=='new')
		{
			return $temp_room;
		}
	}
	return $room;
}
//----------------------------------------------------------------------------
function no_of_practical($con,$st,$et,$day,$shift,$subject_year,$subject_dept,$sem)
{
	$pr_cntr=0;
	if($st>=8 and $st<12 and $shift=='fs')
	{
		$q= mysqli_query($con,"select distinct year,shift from main_table where start_time=$st and end_time=$et and day='$day' and type='pr' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			/*if(($row['year']!=$subject_year and $row['shift']!=$shift) or ($row['year']==$subject_year and $row['shift']!=$shift) or ($row['year']!=$subject_year and $row['shift']==$shift))
			{
				$pr_cntr++;
			}*/
			if($row['year']!=$subject_year and $row['shift']==$shift)
			{
				$pr_cntr++;
			}
		}
		return $pr_cntr;
	}
	else if($st>=12 and $st<18 and $shift=='ss')
	{
		$q= mysqli_query($con,"select distinct year,shift from main_table where start_time=$st and end_time=$et and day='$day' and type='pr' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			if($row['year']!=$subject_year and $row['shift']==$shift)
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
function time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept,$sem)
{
	$count=0;
	$type='null';
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	if($type=='pr')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
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
//-----------------------------------------------------
function hours8($con,$st,$day,$teacher_id,$dept,$dept2,$sem)
{
	$count=0;
	$time[0]=0;
	$q=mysqli_query($con,"select * from main_table where day='$day' and teacher_id='$teacher_id' and (dept='$dept' or dept2='$dept2') and semester='$sem' ORDER BY start_time ASC;") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{   
		$time[$count++]=$row['start_time'];
	}
	if($count>0)
	{
		$total=$time[0]+8;
		if($st>=$total)
		{
			return false;         
		}
	}
	return true;
}
//---------------------------------------------------------------------------------------------------
function move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem)
{
	global $new_room;
	$new_room=1;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no']);
			//if($new_room>0)
				//th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no']);
			//echo "---move th---st=$st1 et=$et1 day=$day shift=$shift----";	
		}
	}		
}
//--------------------------------------------------------------------------------------------------------------------
function move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$sem)
{
	global $new_room;
	$new_room=1;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept' and dept2='$subject_dept2' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			/*if(($st1>=8 and $st1<12 and $row['shift']=='fs') or ($st1>=14 and $st1<18 and $row['shift']=='ss'))
			{*/
				th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no']);
				//if($new_room>0)
				//	th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no']);
				//echo "-back--move th back---st=$st1 et=$et1 day=$day shift=$shift----";
		}
	}		
}
//------------------------------------------------------- end pr function ------------------------------------------------------
function th($con,$tst,$tet,$tday,$subject_id,$teacher_id,$room_id,$subject_year,$shift,$subject_dept,$subject_dept2,$method,$id)
{
	$teacher_code='y';
	$time='y';
	$room_no='y';
	$time12='y';;
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15);
	$ss_time=array(17,16,15,14,13,12,11,10);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status=0;
	$subject_type='th';
	$batch='null';
	$room=0;
	$temp_room='n';
	global $new_room;
	global $execution;
	global $sem;
	global $temp_st;
	global $temp_day;
	$dt='no';
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
						$dt='yes';
						$execution=false;
					}
					$temp_st2=even_odd($con,$temp_st);
					if(($st1==$tst and $tday==$day) or (($temp_st==$st1 or $temp_st2==$st1) and $temp_day==$day))
					{
						$time='no';
					}
					else
					{
						//echo " st1=$st1 et1=$et1 day=$day tst=$tst tday=$tday";
						if($room_id==0)
						{
							$room=empty_room2($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2,$sem);
							$q1=mysqli_query($con,"select * from room where room_id=$room");
							while($row=mysqli_fetch_array($q1))
							{ 
								$temp_room=$row['room_no'];
							}
						}
						else if($room_id!=0)
						{
							$room=$room_id;
						}
					
						if(($room!=0 or $room_id!=0) and $dt!='yes')
						{
						//	echo "--2--";
							//$h8=hours8($con,$st1,$day,$teacher_id,$subject_dept,$subject_dept2);
							//$side=side($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
							$th=theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2,$sem);
								
							if($th=='yes')
							{
								//echo "--3--";
								$cntr=0;
								$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
								while($row=mysqli_fetch_array($q))
								{
									$cntr++;
								}
								if($cntr==0)
								{
									$time='';
									//echo "---4--- state TH ".strtoupper($subject_year)."".strtoupper($shift)."st1=$st1 et1=$et1 day=$day cntr=$cntr------";
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
					}
					if($dt=='yes')	
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
					//check_back_theory($con,$teacher_id,$st1,$et1,0,0,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code=$row['teacher_id'];
				}
			}
			//-------------------------END for check TEACHER available or not-------------------------	
			if($dt=='yes' or $temp_room=='new') 
			{
				$room_no='';
			}
			else
			{	
				//echo " line====974 st1=$st1 et1=$et1 day=$day room=$room_id new=$new_room method=$method";
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$sem'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no=$row['room_id'];
			//	echo "<br>st=$st1 day=$day room=$room th=$room_no";
			}
		}
		//-----------------------END for check ROOM available or not-------------------------
		if($dt!='yes')
		{	
			update_back($con,$id,$st1,$et1,$day,$room);
			//echo " >>>>>..TH ".strtoupper($subject_year)."".strtoupper($shift)."st1=$st1 et1=$et1 day=$day";			
		}
		else if($dt=='yes') 
		{
			$new_room++;
			echo "<br>TH no space available ".strtoupper($subject_year)."".strtoupper($shift)."st1=$tst et1=$tet day=$tday";	
		}
}
//-----------------------------------------------
function update_back($con,$id,$st,$et,$day,$room) 
{
	echo "<br>..............TH .... ";	
	mysqli_query($con,"update main_table set start_time=$st,end_time=$et,day='$day',room_id=$room where sr_no=$id") or die (mysqli_error());
}
//--------------------------------------------------------------------------------------
function side($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem)
{
	$prev=0;
	$next=0;
	$prevTime=0;
	$nextTime=0;
	$between=0;
	if($st1>=8 and $st1<17)
	{
		$st=$st1+1;
		$et=$et1+1;
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$subject_year' and (dept='$subject_dept' or dept2='$subject_dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$next++;
		}
		if($next!=0)
		{
			$nextTime=1;
		}
		else
		{
			$next=0;
			$next=check_next($con,$st,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
			if($next==0)
			{
				$nextTime=1;
			}
		}
	}
	else
	{
		$nextTime=1;
	}
	if($st1>8 and $st1<18)
	{
		$st=$st1-1;
		$et=$et1-1;
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$subject_year' and (dept='$subject_dept' or dept2='$subject_dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$prev++;
		}
		if($prev!=0)
		{
			$prevTime=1;
		}
		else
		{
			$prev=0;
			$prev=check_prev($con,$st,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
			if($prev==0)
			{
				$prevTime=1;
			}
		}
	}
	else
	{
		$prevTime=1;
	}
	if($st>8 and $st<17)
	{
		$next=0;
		$prev=0;
		$next=check_next($con,$st,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
		$prev=check_prev($con,$st,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
		if($next>0 and $prev>0)
		{
			$between=1; 
		}
		//echo "next=$next prev=$prev";
	}
	//echo "<br>st=$st day=$day next=$nextTime prev=$prevTime bet=$between";
	if(($nextTime==1 and $prevTime==1) or $between==1)
	{
		return true;
	}
}
//-------------------------------------------------------------------------
function check_prev($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2,$sem)
{
	$prev=0;
	for($i=$st;$i>=8;$i--)
	{
		$et=$i+1;
		//echo "prev=$st st=$i et=$et ";
		$q=mysqli_query($con,"select * from main_table where start_time=$i and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$subject_dept' or dept2='$subject_dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$prev++;
		}
	}
	return $prev;
}
//--------------------------------------------------------------------------
function check_next($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2,$sem)
{
	$next=0;
	for($i=$st;$i<18;$i++)
	{
		$et=$i+1;
		$q=mysqli_query($con,"select * from main_table where start_time=$i and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$subject_dept' or dept2='$subject_dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$next++;
		}
	}
	return $next;
}

//---------------------------------------------------------------------------------------------------------------------
function check_back_theory($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem)
{
	$cntr=0;
	//echo "----------11111<br>";
	$q=mysqli_query($con,"select distinct year,shift from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='th' and dept='$subject_dept' and semester='$sem' ") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		//echo "----------3333<br>";
		if(($row['year']!=$subject_year and $row['shift']!=$shift) or ($row['year']==$subject_year and $row['shift']!=$shift) or ($row['year']!=$subject_year and $row['shift']==$shift))
		{
			$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				//echo "----------2222<br>";
				swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2,$sem);
			}
		}
	}
}
//-----------------------------------------------------------------------------------------------------------------------
function check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$sem)
{
	//echo "------------";
	$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		//echo "------------";
		swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2,$sem);
	}
}
//---------------------------------------------------------------------------------------------------------------------
function swap_theory($con,$sr_no,$teacher_id,$tst,$tet,$tday,$shift,$subject_year,$t1,$t2,$subject_dept,$subject_dept2,$sem)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15);
	$ss_time=array(17,16,15,14,13,12,11,10);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	global $temp_st;
	global $temp_day;
	$dt='no';
	$dept2='sc';
	$teacher;
		$teacher_code2='y';
		//-------------------------------START for check TEACHER 2 available or not-----------------------------
		while($teacher_code2!='')
		{
			$teacher_code1='y';
			//-------------------------------START for check TEACHER 1 available or not-----------------------------
			while($teacher_code1!='')
			{
                $time='y';
				//-------------------------------START for start_time/SPACE 1 available or not-----------------------------
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
						$dt='yes';
					}
					$temp_st2=even_odd($con,$temp_st);
					if(($st1==$t1 and $day==$tday ) or (($temp_st==$st1 or $temp_st2==$st1) and $temp_day==$day))
					{
						$time='no';
					}
					else
					{
						$count=0;
						$type='no';
						$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))								
						{
							$type=$row['type'];
						}
					//	echo " >>>>>.....TH ".strtoupper($subject_year)."".strtoupper($shift)." st1=$st1 et1=$et1 day=$day";	
						if($type=='th')
						{
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and type='th' and  dept='$subject_dept' and semester='$sem'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))								
							{
								$count++;
								$teacher=$row['teacher_id'];
								$subject=$row['subject_id'];
								$id=$row['sr_no'];
								$dept2=$row['dept2'];
							}
						}
						if($count>0 and $dept2==$subject_dept and $type=='th')
						{
							$time='';
							$fill='avail';
						}
						else if($count==0 and $type="no")
						{
							$room=empty_room2($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2,$sem);
							if($room!=0)
							{
								$time='';
								$fill='blank';
							}
						}	
					}
				}
                //---------------------------END for check TIME available or not-----------------------
				if($dt=='yes')
				{
					$teacher_code1='';
				}
				else
				{
					$val=time12($con,$st1,$day,$teacher_id,0,$shift,$subject_dept,$subject_dept2,$sem);
					if($val=='')
					{
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and semester='$sem'") or die (mysqli_error());
						$row=mysqli_fetch_array($q);
						$teacher_code1=$row['teacher_id'];
					}
				}
			}
			//-------------------------END for check TEACHER1 available or not-------------------------	
			if($dt=='yes' or $fill=='blank')
			{
				$teacher_code2='';
			}
			else
			{
				$val=time12($con,$tst,$day,$teacher,0,$shift,$subject_dept,$subject_dept2,$sem);
				if($val=='')
				{
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst and end_time=$tet and day='$tday' and teacher_id=$teacher and semester='$sem'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code2=$row['teacher_id'];
				}
			}
		}
		//-------------------------END for check TEACHER 2 available or not-------------------------		
		if($dt!='yes')
		{
			$q=mysqli_query($con,"select * from main_table where sr_no=$sr_no") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$ts=$row['subject_id'];
				$tt=$row['teacher_id'];
			}
			if($fill=='avail')
			{
				mysqli_query($con,"update main_table set teacher_id=$teacher,subject_id=$subject where sr_no=$sr_no") or die (mysqli_error());
				mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts where sr_no=$id") or die (mysqli_error());
			}
			else if($fill=='blank')
			{
				//echo "----------$st1 $et1 $day $room $sr_no =----------";
				mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$sr_no") or die (mysqli_error());
			}
			//echo "<br>----------TH-update-------</br>";
		}
}
//---------------------------------------------------------------------------------------------------------------------
function theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2,$sem)
{	
	$today=0;
	$teacher=0;
	$q=mysqli_query($con,"select * from main_table where day='$day' and subject_id=$subject_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	$q=mysqli_query($con,"select * from main_table where day='$day' and teacher_id=$teacher_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$teacher++;
	}
	if($today<=2 and $teacher<=2)
	{
		return 'yes';
	}
	else
	{
		return 'no';	 
	}
}

//----------------------------------------------------------------------------------
function time12($con,$st,$day,$teacher_id,$room,$shift,$subject_dept,$subject_dept2,$sem)
{
	if($shift=='fs')
	{
		$shift2='ss';
	}
	else
	{
		$shift2='fs';
	}
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
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift2' and (dept='$subject_dept' or dept2='$subject_dept2') and ( teacher_id=$teacher_id or room_id=$room) and semester='$sem'") or die (mysqli_error());
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
//---------------------------end Theory function ------------------------
function checkSubject($con,$subject_id,$shift,$batch,$time,$subject_dept)
{
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where shift='$shift' and subject_id=$subject_id and batch='$batch' and dept='$subject_dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
	}
	if($time==$cntr)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//----------------------------------------------------------------------
function sidePrTh($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$method)
{
	$cntr=0;
	$type='no';
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2')") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
		$cntr++;
	}
	if($method=='th')
	{
		if($type=='th')
		{
			return true;
		}
		else if($type=='pr' and $cntr==3)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	else if($method=='pr')
	{
		if($type=='th')
		{
			return true;
		}
		else if($type=='pr')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
//----------------------------------------------------------------------------end of common functions---------------------------------------------------------------------------
function check_type($con,$st,$et,$day,$year,$shift,$dept,$sem)
{
	$type='blank';
	$q= mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	return $type;
}
//-----------------------------------------------------------------------
function pr_id($con,$st,$et,$day,$teacher_id,$room_id,$shift,$year,$dept,$dept2,$sem)
{
	$st2=even_odd($con,$st);
	$et2=$st2+1;
	echo ",,,,,,,,, $st2,,,,,";
	$q2=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and teacher_id=$teacher_id and room_id=$room_id and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		return $row['sr_no'];
	}
}
//----------------------------------------------
function th_id($con,$st,$day,$shift,$year,$dept,$dept2,$sem)
{
	$temp_st=even_odd($con,$st);
	$temp_et=$temp_st+1;
	$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift' and year='$year' and type='th' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		th($con,$temp_st,$temp_et,$day,$row['subject_id'],$row['teacher_id'],$row['room_id'],$row['year'],$row['shift'],$dept,$dept2,'update',$row['sr_no']);
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
//--------------------
function even($con,$st)
{
	if($st%2!=0)
	{
		$st=$st-1;
	}
	return $st;
}
//-----------------------------------------------------------------------------------
function block($con,$st1,$et1,$day1,$st2,$et2,$day2,$year,$shift,$dept,$dept2,$type1,$sem)
{
	$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		check_back($con,$st2,$et2,$day2,$shift,$year,$row['teacher_id'],$row['room_id'],$row['dept'],$row['dept2'],$type1,$sem);
	}
}
//------------------------------------------------------------------------------------------
function check_back($con,$st,$et,$day,$shift,$year,$teacher_id,$room_id,$dept,$dept2,$type1,$sem)
{
	if($type1=='pr' or $type1=='blank')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and (dept='$dept' or dept2='$dept2') and (teacher_id=$teacher_id or room_id=$room_id) and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			if($row['type']=='pr')
			{
				$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$row['dept'],$row['dept2'],$sem);
				echo "---> PR ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day ".$day." ".strtoupper($row['batch'])." id2=$id2";
				pr($con,$row['sr_no'],$id2,$st,$day,$row['teacher_id'],$row['subject_id'],0,$row['year'],$row['shift'],$row['batch'],$row['dept'],$row['dept2'],$sem);
			}
			else if($row['type']=='th')
			{
				echo "---> TH ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day".$day." ";
				$temp_st=even_odd($con,$st);
				$temp_et=$temp_st+1;
				th($con,$temp_st,$temp_et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
				$q=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and (dept='$dept' or dept2='$dept2') and (teacher_id=$teacher_id or room_id=$room_id) and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{	
					if($row['type']=='th')
					{
						//echo "---> TH ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day".$day." ";
						th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
					}
				}
			}
		}
	}
	else if($type1=='th')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and (dept='$dept' or dept2='$dept2') and (teacher_id=$teacher_id or room_id=$room_id) and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{	
			if($row['type']=='pr')
			{
				$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept,$dept2,$sem);
				echo "---> PR ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day ".$day." ".strtoupper($row['batch'])." id2=$id2";
				pr($con,$row['sr_no'],$id2,$st,$day,$row['teacher_id'],$row['subject_id'],0,$row['year'],$row['shift'],$row['batch'],$row['dept'],$row['dept2'],$sem);
			}
			else if($row['type']=='th')
			{ 
				echo "---> TH ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day".$day." ".strtoupper($row['batch'])." ";
				th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
			}
		}	
		if($st==12 or $st==13)
		{
			$t12=time12($con,$st,$day,$teacher_id,$room_id,$shift,$dept,$dept2,$sem);
			if($t12=='no')
			{
				$shift2=shift($con,$shift);
				$temp_st=even_odd($con,$st);
				$temp_et=$temp_st+1;
				$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$shift2' and (teacher_id=$teacher_id or room_id=$room_id) and (dept='$dept' or dept2='$dept2') and semester='$sem'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
				 	if($row['type']=='th')
					{
						th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
					}
				}
			}
		}	
	}
}
//--------------------------------------------------------------------------------------------
function replace($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept,$dept2,$sem)
{
	//echo "---> REPLACE  ".strtoupper($year)."".strtoupper($shift)." st=".$st1." et".$et1." day".$day1." ";
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and shift='$shift' and year='$year' and dept='$dept' and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		//echo "---------------------";
		replace_type($con,$st2,$et2,$day2,$row['teacher_id'],$row['room_id'],$year,$shift,$row['batch'],$type1,$type2,$row['dept'],$row['dept2'],$sem);
	}
}
//----------------------------------------------------------------------------------------------------------
function replace_type($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept,$dept2,$sem)
{
	if($type1=='pr' or $type1=='blank')
	{
		$type=check_type($con,$st,$et,$day,$year,$shift,$dept,$sem);
		if($type=='blank')
		{
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			$type=check_type($con,$temp_st,$temp_et,$day,$year,$shift,$dept,$sem);
		}
		if($type=='pr')
		{
			replace_pr($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept,$dept2,$sem);
		}
		else if($type=='th')
		{
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			replace_th($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem);
			replace_th($con,$temp_st,$temp_et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem);
		}
	}
	else if($type1=='th' or $type1=='blank')
	{
		$type=check_type($con,$st,$et,$day,$year,$shift,$dept,$sem);
	//	echo "  ------type===$type";
		if($type=='pr')
		{
			replace_pr2($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem);	
		}
		else if($type=='th')
		{
			replace_th($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem);
		}
	}
}
//-------------------------------------------------------------------------------------------------------------
function replace_pr($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$batch,$type1,$type2,$dept,$dept2,$sem)
{
	//echo "---> REPLACE  ".strtoupper($year)."".strtoupper($shift)." st=".$st." et".$et." day ".$day." batch=$batch dept=$dept ";
	$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and type='pr' and batch='$batch' and (dept='$dept' or dept2='$dept2') and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept,$dept2,$sem);
		//echo "---> REPLACE PR ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day ".$day." ".strtoupper($row['batch'])." id2=$id2";
		pr($con,$row['sr_no'],$id2,$st,$day,$row['teacher_id'],$row['subject_id'],0,$row['year'],$row['shift'],$row['batch'],$row['dept'],$row['dept2']);
	}
}
//--------------------------------------------------------------------------------------------------------
function replace_pr2($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem)
{
	//echo "---> REPLACE  ".strtoupper($year)."".strtoupper($shift)." st=".$st." et".$et." day ".$day." batch=$batch dept=$dept ";
	$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and type='pr' and (dept='$dept' or dept2='$dept2') and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$id2=pr_id($con,$st,$et,$day,$row['teacher_id'],$row['room_id'],$row['shift'],$row['year'],$dept,$dept2,$sem);
		//echo "---> REPLACE PR ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day ".$day." ".strtoupper($row['batch'])." id2=$id2";
		pr($con,$row['sr_no'],$id2,$st,$day,$row['teacher_id'],$row['subject_id'],0,$row['year'],$row['shift'],$row['batch'],$row['dept'],$row['dept2']);
	}
}

//--------------------------------------------------------------------------------------------------------
function replace_th($con,$st,$et,$day,$teacher_id,$room_id,$year,$shift,$type1,$type2,$dept,$dept2,$sem)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$dept' or dept2='$dept2') and semester='$sem'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		//echo "--->REPLACE TH ".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day".$day;
		$temp_st=even_odd($con,$st);
		$temp_et=$temp_st+1;
		th($con,$temp_st,$temp_et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
	}
	if($st==12 or $st==13)
	{
		//echo " executed";
		$t12=time12($con,$st,$day,$teacher_id,$room_id,$shift,$dept,$dept2,$sem);
		if($t12=='no')
		{
			$s=shift($con,$shift);
			$temp_st=even_odd($con,$st);
			$temp_et=$temp_st+1;
			$q2=mysqli_query($con,"select * from main_table where start_time=$temp_st and end_time=$temp_et and day='$day' and shift='$s' and (teacher_id='$teacher_id' or room_id='$room_id') and (dept='$dept' or dept2='$dept2') and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				if($row['type']=='th')
				{
					//echo "--->REPLACE TH time12".strtoupper($row['year'])."".strtoupper($row['shift'])." st=".$st." et".$et." day".$day;
					th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
				}
			}
		}
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
//------------------------------------------------------------------------------------
function update($con,$st1,$et1,$day1,$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept,$sem)
{
	$cntr1=0;
	$cntr2=0;
	echo " UPDATE $st1 $et1 $day1 $year  $shift $dept";
	if($type1!='blank')
	{
		$ids=array();
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$ids1[$cntr1++]=$row['sr_no'];
		}
		if($type1=='pr')
		{
			$temp_st1=even_odd($con,$st1);
			$temp_et1=$temp_st1+1;
			$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
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
}
//---------------------------------------------------
function updateLecture($con,$st,$et,$day,$ids,$cntr)
{
	for($i=0;$i<$cntr;$i++)
	{	
		$id=$ids[$i];
		mysqli_query($con,"update main_table set start_time=$st,end_time=$et,day='$day' where sr_no=$id")or die (mysqli_error());
	}
}
//--------------------------------------------------
function roomTh($con,$year,$shift,$dept,$dept2,$sem)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15,16,17);
	$ss_time=array(17,16,15,14,13,12,11,10,9,8);
	$day_cntr=0;
	$time_cntr=0;
	$b=array('a','b','c');
	$dt='no';
	while($dt!='yes')
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
			$dt='yes';
		}
		$cntr=0;
		$q=mysqli_query($con,"select m.*,r.* from main_table m,room r where m.start_time=$st1 and m.end_time=$et1 and m.day='$day' and m.year='$year' and m.shift='$shift' and (m.dept='$dept' or m.dept2='$dept2') and m.room_id=r.room_id and r.room_no='new' and m.semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
			$id=$row['sr_no'];
			$teacher=$row['teacher_id'];
		}
		//echo " ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day room=$cntr";
		if($cntr!=0)
		{
			//echo "<br>$year $shift $st1 $day</br>";
			changeRoom($con,$id,$st1,$et1,$day,$shift,$year,$teacher,$dept,$dept2);
		}
	}
}
//--------------------------------------------------------------------------------
function changeRoom($con,$id,$st1,$et1,$day,$shift,$year,$teacher_id,$dept,$dept2)
{
	$room=empty_room($con,$st1,$et1,$day,'th',$teacher_id,$shift,$dept,$dept2);
	if($room!=0)
	{
		mysqli_query($con,"update main_table set room_id=$room where sr_no=$id")or die (mysqli_error());
	}
}
//-------------------------
function databaseOG()
{
	global $databaseOG;
	global $con;
	$i=0;
	$q=mysqli_query($con,"select * from main_table") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		for($j=0;$j<7;$j++)
		{
			if($j==0)
		 		$databaseOG[$i][$j]=$row['sr_no'];
			else if($j==1)
				$databaseOG[$i][$j]=$row['start_time'];
			else if($j==2)
				$databaseOG[$i][$j]=$row['end_time'];
			else if($j==3)
				$databaseOG[$i][$j]=$row['day'];
			else if($j==4)
				$databaseOG[$i][$j]=$row['room_id'];
			else if($j==5)
				$databaseOG[$i][$j]=$row['teacher_id'];
			else if($j==6)
				$databaseOG[$i][$j]=$row['subject_id'];
		}
		$i++;
	}
} 
//-------------------------
function databaseBackUpOG()
{
	global $databaseOG;
	global $con;
	for($i=0;$i<count($databaseOG);$i++)
	{
		for($j=0;$j<7;$j++)
		{
			if($j==0)
		 		$sr_no=$databaseOG[$i][$j];
			else if($j==1)
				$st=$databaseOG[$i][$j];
			else if($j==2)
				$et=$databaseOG[$i][$j];
			else if($j==3)
				$day=$databaseOG[$i][$j];
			else if($j==4)
				$rid=$databaseOG[$i][$j];
			else if($j==5)
				$tid=$databaseOG[$i][$j];
			else if($j==6)
				$sid=$databaseOG[$i][$j];
		}
	//	echo "id=$sr_no, st=$st, et=$et,day=$day, room=$rid";
		mysqli_query($con,"update main_table set start_time=$st,end_time=$et,day='$day',room_id=$rid,teacher_id=$tid,subject_id=$sid where sr_no=$sr_no")or die (mysqli_error());
	}
}
//------------------------------------------------------------
function emptyRoom($con,$st,$et,$day,$shift,$dept,$sem)
{
	global $dbRoom;
	global $dbRoomCntr;
	 
	$room=0;
	$c=0;
	if($dbRoomCntr==0)
	{
		$q1=mysqli_query($con,"select room_id from room where type='pr' and dept='$dept'");
		while($row=mysqli_fetch_array($q1))
		{ 
			$dbRoom[$c++]=$row['room_id'];
		}
	}
	//echo ">>>>-$dbRoomCntr =".$dbRoom[$dbRoomCntr];
	$start=$dbRoomCntr;
	for($i=$start;$i<count($dbRoom);$i++)
	{
		$temp_room=$dbRoom[$i];
		$dbRoomCntr++;
		$count=0;
		$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$count++;
		}
		if($count==0)
		{
			return $temp_room;
		}		
	}
	return $room;
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
	$dept2=$dept;
	$sem=$_REQUEST["sem"];
	$temp_st=$st2;
	$temp_day=$day2;
	$execution=true;
	$databaseOG=array(array());
	$dbRoom=array();
	$dbRow=0;
	$dbRoomCntr=0;
	$new_room=0;
	$et1=$st1+1;
	$et2=$st2+1;
	$swap=true;
	//echo " st1".$st1." et1".$et1." st2".$st2." et2".$et2." shift".$shift." y=$year d=$day1 sem=$sem dept=$dept";
	$type1=check_type($con,$st1,$et1,$day1,$year,$shift,$dept,$sem);
	$type2=check_type($con,$st2,$et2,$day2,$year,$shift,$dept,$sem);
	if($type1=='pr' and $type2=='pr')
	{
		$temp_st=even_odd($con,$st1);
		//$temp_et=$temp_st2+1;
		if($temp_st==$st2 and $day1==$day2)
		{
			$swap=false;
		}
	}
	if($swap)
	{
		databaseOG();
		$q= mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$id=$row['sr_no'];
			$rooms=0;
			if($row['type']=='pr' and $row['dept2']!='sc')
			{
				$rooms=emptyRoom($con,$st2,$et2,$day2,$shift,$dept,$sem);
			}
			else if($row['type']=='th')
			{
				$rooms=empty_room($con,$st2,$et2,$day2,'th',$row['teacher_id'],$shift,$dept,$dept2,$sem);
			}
			if($rooms!=0)
			{
				mysqli_query($con,"update main_table set day='sat',room_id=$rooms where sr_no=$id")or die (mysqli_error());
			}
			else
			{
				mysqli_query($con,"update main_table set day='sat' where sr_no=$id")or die (mysqli_error());
			}
		}
		if($type1=='pr')
		{
			$temp_st1=even_odd($con,$st1);
			$temp_et1=$temp_st1+1;
			$temp_st2=even_odd($con,$st2);
			$temp_et2=$temp_st2+1;
			$dbRoomCntr=0;
			$q= mysqli_query($con,"select * from main_table where start_time=$temp_st1 and end_time=$temp_et1 and day='$day1' and year='$year' and shift='$shift' and dept='$dept' and semester='$sem'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$id=$row['sr_no'];
				$rooms=0;
				if($row['type']=='pr' and $row['dept2']!='sc')
				{
					$rooms=emptyRoom($con,$temp_st2,$temp_et2,$day2,$shift,$dept,$sem);
				}
				else if($row['type']=='th')
				{
					$rooms=empty_room($con,$temp_st2,$temp_et2,$day2,'th',$row['teacher_id'],$shift,$dept,$dept2,$sem);
				}
				if($rooms!=0)
				{
					mysqli_query($con,"update main_table set day='sat',room_id=$rooms where sr_no=$id")or die (mysqli_error());
				}
				else
				{
					mysqli_query($con,"update main_table set day='sat' where sr_no=$id")or die (mysqli_error());
				}
			}
		}
		if($shift!='default' and $year!='default' and $teacher=='default' and $room=='default')
		{
			replace($con,$st1,$et1,'sat',$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept,$dept2,$sem);
			if($execution==true)
			{
				//echo " BACK execution=$execution";
				block($con,$st1,$et1,'sat',$st2,$et2,$day2,$year,$shift,$dept,$dept2,$type1,$sem);
					//databaseBackUp();
			}
			if($execution==false)
			{
				echo " DATABASE BACKUP";
				databaseBackUpOG();
			}
			if($execution==true)
			{
				///echo " UPDATE execution=$execution";
				update($con,$st1,$et1,'sat',$type1,$st2,$et2,$day2,$type2,$year,$shift,$dept,$sem);
			}
		}
		/*$y=array("fy","sy","ty");
		$s=array("fs","ss");

		for($i=0;$i<3;$i++)
		{
			$year=$y[$i];
			for($j=0;$j<2;$j++)
			{
				$shift=$s[$j];
				roomTh($con,$year,$shift,$dept,'if',$sem);
			}
		}*/
	}
	else
	{
		echo "Select appropriate place";
	}
}
?>  