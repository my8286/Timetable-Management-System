<?php
	session_start();
	include('connection.php'); 
	$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db'));

	function pr($con,$teacher_id,$subject_id,$room_id,$subject_year,$shift,$batch,$subject_dept,$subject_dept2,$semester)
    {
		$st1=0;
		$et1=0;
		$st2=0;
		$et2=0;
		$days=array("mon","tue","wed","thu","fri","sat");
		$fs_time=array(8,10,12,14,16);
		$ss_time=array(16,14,12,10,8);
		$day_cntr=0;
		$time_cntr=0;
		$time_cntr2=0;
		global $new_room;
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
								}
								$pr_status=practical_status($con,$day,$days,$dc,$subject_id,$shift,$subject_year,$batch,$subject_dept);
								if($pr_status=='yes' and $dt!='yes')
								{
									if($room_id==0)
									{
										$room=empty_room($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2);
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
											move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$semester);
											move_theory($con,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$semester);
											check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
											check_back_theoryPR($con,$teacher_id,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
											$h8=hours8($con,$st1,$day,$teacher_id,$subject_dept,$subject_dept2);
											if($h8==true)
											{
												$time=time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept);
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
							check_back_pr_teacher($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2);
							move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$semester);
							move_theory_back($con,$st2,$et2,$st1,$et1,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$semester);
							$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
					$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no2=$row['room_id'];	
			}	
		}
		//----------------------------END for check ROOM 2 available or not------------------------------
		if($dt!='yes')
		{
			echo "<br>".strtoupper($subject_year)."".strtoupper($shift)." PR Room no ".$room." and Teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." and from ".$st2." to ".$et2." on day ".$day." batch ".strtoupper($batch)."</br>";
			insert($con,$st1,$day,$shift,$room,$subject_type,$batch,$semester);
		}
		else
		{
			$new_room++;
			echo "<br>PR no space available for batch $batch</br>";
		}
	} 
//-----------------------------------------------------------------------------------------------------------
function check_back_pr_teacher($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2)
{
	$cntr=0;
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='pr' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++; 
		$sr_no1=$row['sr_no'];
		$b=$row['batch'];
		$teacher_id=$row['teacher_id'];
		$room_id=$row['room_id'];
		$shift=$row['shift'];
		$year=$row['year'];
		$q2=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and batch='$b' and teacher_id=$teacher_id and type='pr' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$sr_no2=$row['sr_no'];
		}
	}
	if($cntr>0)
	{
		check_swap($con,$sr_no1,$sr_no2,$teacher_id,$room_id,$st1,$et1,$st2,$et2,$day,$shift,$year,$b,$subject_dept,$subject_dept2);
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------------------
function check_swap($con,$tid1,$tid2,$teacher_id,$room_id,$tst1,$tet1,$tst2,$tet2,$tday,$shift,$subject_year,$batch,$subject_dept,$subject_dept2)
{
	$teacher_code4='no';
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,10,12,14,16);
	$ss_time=array(16,14,12,10,8);
	$day_cntr=0;
	$time_cntr=0;
	$dt='no';
	global $semester;
	$st1;$st2;$et1;$et2;$fill;
	while($teacher_code4!='')
	{
		$teacher_code3='no';
		while($teacher_code3!='')
		{
			$teacher_code2='no';
			while($teacher_code2!='')
			{
				$teacher_code1='no';
				while($teacher_code1!='')
				{
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
						if($st1==$tst1 and $tday==$day)
						{  
							$dt='yes';
						}
						$count=0;
						$st2=$st1+1;
						$et2=$et1+1;
						$type1='no';
						$type2='no';
						$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))
						{
							$type1=$row['type'];
						}
						$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))
						{
							$type2=$row['type'];
						}
						if($type1=='pr' and $type2=='pr')
						{	
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))
							{   
								$id1=$row['sr_no'];
								$teacher=$row['teacher_id'];
								$subject=$row['subject_id'];
								$room_id=$row['room_id'];
								$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
								while($row=mysqli_fetch_array($q))
								{   
									$id2=$row['sr_no'];
									$count++;
								}
							}
						}
						if($count>0 and $type1=='pr' and $type2=='pr')
						{
							$time='';
							$fill='avail';
						}
						else if($count==0 and $type1=='no' and $type2=='no')
						{
							$room = empty_room($con,$st1,$et1,$day,'pr',$teacher_id,$shift,$subject_dept,$subject_dept2);
							if($room!=0)
							{
								$room_id=$room;
								$fill='blank';
								$time='';
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
					//-------------------------------END for check Time 1 available or not-----------------------------
					if($dt=='yes')
					{
						$teacher_code1='';
					}
		 			else
					{
						$count=0;
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
				$count=0;
				$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst1 and end_time=$tet1 and day='$tday' and teacher_id=$teacher and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
			$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst2 and end_time=$tet2 and day='$tday' and teacher_id=$teacher and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts,room_id=$room_id where sr_no=$id1") or die (mysqli_error());
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts,room_id=$room_id where sr_no=$id2") or die (mysqli_error());	
		}
		elseif($fill=='blank')
		{
			mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room_id where sr_no=$tid1") or die (mysqli_error());
			mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day',room_id=$room_id where sr_no=$tid2") or die (mysqli_error());
		}			
		echo "<br>---update PR---</br>";
	}
}
//-------------------------------------------------------------------------
function insert($con,$st1,$day,$shift,$room,$subject_type,$batch,$semester) 
{
	$et1=$st1+1;      //--------------insert-----------------
	$st2=$et1;
	$et2=$st2+1;
	$as=0;
	$ts=0;
	$cntr=0;
	global $teacher_id;
	global $subject_id;
	global $subject_year;
	global $subject_dept;
	global $subject_dept2;
	global $fill_id1;
	global $fill_id2;
	global $batchA;
	global $batchB;
	global $batchC;
	global $batchTH;
	if($room=='new')
	{
		$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		if($cntr==0)
		{
			mysqli_query($con,"insert into room (room_no,dept,type) values ('new','new','new')") or die (mysqli_error());
		}
		$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$room=$row['room_id'];
		}
	}
	mysqli_query($con,"insert into main_table (start_time,end_time,day,shift,room_id,subject_id,teacher_id,type,year,dept,dept2,batch,semester) values ($st1,$et1,'$day','$shift',$room,$subject_id,$teacher_id,'$subject_type','$subject_year','$subject_dept','$subject_dept2','$batch','$semester')") or die (mysqli_error());
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and room_id=$room and subject_id=$subject_id and shift='$shift' and type='$subject_type' and batch='$batch'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		if($batch=='a')
		{
			$fill_id1[0][$batchA++]=$row['sr_no'];
		}
		elseif($batch=='b')
		{
			$fill_id1[1][$batchB++]=$row['sr_no'];
		}
		elseif($batch=='c')
		{
			$fill_id1[2][$batchC++]=$row['sr_no'];
		}
		elseif($batch=='null')
		{
			$fill_id1[0][$batchTH++]=$row['sr_no'];
		}
	}
	if($subject_type=='pr')
	{	
		$b=0;
		mysqli_query($con,"insert into main_table (start_time,end_time,day,shift,room_id,subject_id,teacher_id,type,year,dept,dept2,batch,semester) values ($st2,$et2,'$day','$shift',$room,$subject_id,$teacher_id,'$subject_type','$subject_year','$subject_dept','$subject_dept2','$batch','$semester')") or die (mysqli_error());
		$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and teacher_id=$teacher_id and room_id=$room and subject_id=$subject_id and shift='$shift' and type='$subject_type' and batch='$batch'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			if($batch=='a')
			{
				$fill_id2[0][$b]=$row['sr_no'];
			}
			elseif ($batch=='b')
			{
				$fill_id2[1][$b]=$row['sr_no'];
			}
			elseif ($batch=='c')
			{
				$fill_id2[2][$b]=$row['sr_no'];
			}
			$b++;
		}
	}
}
//--------------------------------------------------------------------------------------------------------
function practical_status($con,$day,$days,$day_cntr,$subject_id,$shift,$subject_year,$batch,$subject_dept)
{	
	$yesterday=0;
	$tomorrow=0;
	$today=0;
	global $semester;
	if($day_cntr>0)   //--------------practical status--------------
	{
		$prev_day=$days[$day_cntr-1];
		$q=mysqli_query($con,"select * from main_table where day='$prev_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$yesterday++;
		}
	}
	if($day_cntr<5)
	{
		$next_day=$days[$day_cntr+1];
		$q=mysqli_query($con,"select * from main_table where day='$next_day' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
	$q=mysqli_query($con,"select * from main_table where day='$current' and subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	$cntr=0;
	$q=mysqli_query($con,"select * from main_table where dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
function empty_room($con,$st,$et,$day,$type,$teacher_id,$shift,$subject_dept,$subject_dept2)
{
	$room=0;
	global $semester;
	if($subject_dept2=='sc' and $type=='pr')
	{
		$tmp=$subject_dept;
		$subject_dept=$subject_dept2;
		$subject_dept2=$tmp;
	}
	else{
		$subject_dept2=$subject_dept;
	}
	$q1=mysqli_query($con,"select room_id from room where type='$type' and dept='$subject_dept'");
	while($row=mysqli_fetch_array($q1))
	{ 
		$count=0;
		$temp_room=$row['room_id'];
		$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$subject_dept2' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$count++;
		}
		if($count==0)
		{
			if($type=='th' and ($st==12 or $st==13))
			{
				$t12=time12($con,$st,$day,$teacher_id,$temp_room,$shift,$subject_dept,$subject_dept2);
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
//------------------------------------------------------------------------------------------
function empty_room2($con,$st,$et,$day,$type,$teacher_id,$shift,$subject_dept,$subject_dept2)
{
	$room=0;
	global $semester;
	if($subject_dept2=='sc' and $type=='pr')
	{
		$tmp=$subject_dept;
		$subject_dept=$subject_dept2;
		$subject_dept2=$tmp;
	}
	else{
		$subject_dept2=$subject_dept;
	}
	for($i=0;$i<2;$i++)
	{
		if($i==1)
		{
			$q1=mysqli_query($con,"select room_id from room where type='new' and dept='new'");
			while($row=mysqli_fetch_array($q1))
			{
				return $row['room_id'];
			}
		}
		else
		{
			$q1=mysqli_query($con,"select room_id from room where type='$type' and dept='$subject_dept'");
			while($row=mysqli_fetch_array($q1))
			{ 
				$count=0;
				$temp_room=$row['room_id'];
				$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$subject_dept2' and semester='$semester'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q2))
				{
					$count++;
				}
				if($count==0)
				{
					if($type=='th' and ($st==12 or $st==13))
					{
						$t12=time12($con,$st,$day,$teacher_id,$temp_room,$shift,$subject_dept,$subject_dept2);
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
		}
	}
	return $room;
}
//----------------------------------------------------------------------------
function no_of_practical($con,$st,$et,$day,$shift,$subject_year,$subject_dept)
{
	$pr_cntr=0;
	global $semester;
	if($st>=8 and $st<12 and $shift=='fs')
	{
		$q= mysqli_query($con,"select distinct year,shift from main_table where start_time=$st and end_time=$et and day='$day' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			if($row['year']!=$subject_year and $row['shift']==$shift)
			{
				$pr_cntr++;
			}
		}
		return $pr_cntr;
	}
	else if($st>=12 and $st<18 and $shift=='ss')
	{
		$q= mysqli_query($con,"select distinct year,shift from main_table where start_time=$st and end_time=$et and day='$day' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
function time_status($con,$st1,$et1,$day,$shift,$subject_year,$batch,$subject_dept)
{
	$count=0;
	$type='null';
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$type=$row['type'];
	}
	if($type=='pr')
	{
		$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
function hours8($con,$st,$day,$teacher_id,$dept,$dept2)
{
	$count=0;
	$time[0]=0;
	global $semester;
	$q=mysqli_query($con,"select * from main_table where day='$day' and teacher_id='$teacher_id' and (dept='$dept' or dept2='$dept2') and semester='$semester' ORDER BY start_time ASC;") or die (mysqli_error());
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
function move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,$semester)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			if(($st1>=8 and $st1<=14 and $row['shift']=='fs') or ($st1>=12 and $st1<18 and $row['shift']=='ss'))
			{
				th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no'],$semester);
			}
		}
	}		
}
//--------------------------------------------------------------------------------------------------------------------
function move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2,$semester)
{
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept' and dept2='$subject_dept2'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$subject_dept,$subject_dept2,'update',$row['sr_no'],$semester);
		}
	}		
}
//------------------------------------------------------- end pr function ----------------------------------------------------------------
function th($con,$tst,$tet,$tday,$subject_id,$teacher_id,$room_id,$subject_year,$shift,$subject_dept,$subject_dept2,$method,$id,$semester)
{
	$teacher_code='y';
	$time='y';
	$room_no='y';
	$time12='y';;
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15,16,17);
	$ss_time=array(17,16,15,14,13,12,11,10,9,8);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	$batch='null';
	global $new_room;
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
					}
					if($st1==$tst and $tday==$day)
					{
						$time='no';
					}
					else
					{
						$pr=0;
						if(($pr>=2 or $pr==0) and $dt!='yes')
						{
							if($room_id==0 or $new_room==0)
							{
								if($method=='insert')
								{
									$room=empty_room($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2);
									//echo "inser   ";
								}
								else if($method=='update')
								{
									$room=empty_room2($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2);
									//echo "updated   ";
								}
							}
							else if($new_room>=1)
							{
								
								$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
								while($row=mysqli_fetch_array($q))
								{
									$room=$row['room_id'];
								}
	
								$room_status=0;
								//echo "inser  ------------- ";
							}
							else
							{
								$room=$room_id;
							}
							if(($room!=0 or $room_status==0) and $dt!='yes')
							{
								$side=side($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
								$th=theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2);
								if($side==true and $th=='yes')
								{
									$q= mysqli_query($con,"select start_time from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
									$row=mysqli_fetch_array($q);								
									if($row['start_time']=='')
									{
										$time='';
									}
								} 
							}
							else if($dt=='yes')	
							{
								$time='';
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
					check_back_theory($con,$teacher_id,$st1,$et1,0,0,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
				//echo "$st1 $et1 $day $room $subject_dept $subject_dept2 $semester  ";
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no=$row['room_id'];
			}
		}
		//-----------------------END for check ROOM available or not-------------------------
		if($dt!='yes')
		{	
			if($method=='insert')
			{
				insert($con,$st1,$day,$shift,$room,$subject_type,$batch,$semester);
			}
			else if($method=='update')
			{
				update_back($con,$id,$st1,$et1,$day,$room); 
			}
		}
		else if($dt=='yes') 
		{
			$new_room++;
			echo "<br>TH no space available</br>";
		}
}
//----------------------------------------------------------------------------------
function side($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2)
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
	}
	if(($nextTime==1 and $prevTime==1) or $between==1)
	{
		return true;
	}
}
//-------------------------------------------------------------------------
function check_prev($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2)
{
	$prev=0;
	for($i=$st;$i>=8;$i--)
	{
		$et=$i+1;
		$q=mysqli_query($con,"select * from main_table where start_time=$i and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$subject_dept' or dept2='$subject_dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$prev++;
		}
	}
	return $prev;
}
//-------------------------------------------------------------------------
function check_next($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2)
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
//-----------------------------------------------
function update_back($con,$id,$st,$et,$day,$room) 
{
	$cntr=0;
	if($room=='new')
	{
		$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		if($cntr==0)
		{
			mysqli_query($con,"insert into room (room_no,dept,type) values ('new','new','new')") or die (mysqli_error());
		}
		$q=mysqli_query($con,"select * from room where dept='new'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$room=$row['room_id'];
		}
	}
	mysqli_query($con,"update main_table set start_time=$st,end_time=$et,day='$day',room_id=$room where sr_no=$id") or die (mysqli_error());
}
//---------------------------------------------------------------------------------------------------------------------
function check_back_theory($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	$cntr=0;
	$q=mysqli_query($con,"select distinct year,shift from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='th' and dept='$subject_dept' ") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		if(($row['year']!=$subject_year and $row['shift']!=$shift) or ($row['year']==$subject_year and $row['shift']!=$shift) or ($row['year']!=$subject_year and $row['shift']==$shift))
		{
			$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['subject_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2);
			}
		}
	}
}
//-----------------------------------------------------------------------------------------------------------------------
function check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['subject_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2);
	}
}
//--------------------------------------------------------------------------------------------------------
function swap_theory($con,$sr_no,$teacher_id,$subject_id,$tst,$tet,$tday,$shift,$subject_year,$t1,$t2,$subject_dept,$subject_dept2)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15,16,17);
	$ss_time=array(17,16,15,14,13,12,11,10,9,8);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	$dt='no';
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
					if($st1==$t1 and $day==$tday)
					{
						$time='no';
					}
					else
					{
						$count=0;
						$type='no';
						$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))								
						{
							$type=$row['type'];
						}
						if($type=='th')
						{
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and type='th' and  dept='$subject_dept'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))								
							{
								$count++;
								$teacher=$row['teacher_id'];
								$subject=$row['subject_id'];
								$id=$row['sr_no'];
							}
						}
						if($count>0)
						{
							$time='';
							$fill='avail';
						}
						else if($count==0 and $type=='no')
						if($dt=='yes')
						{
							$time='';
							$fill='blank';
							$room=empty_room2($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2);
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
					$val=time12($con,$st1,$day,$teacher_id,0,$shift,$subject_dept,$subject_dept2);
					if($val=='')
					{
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id") or die (mysqli_error());
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
				$val=time12($con,$st1,$day,$teacher,0,$shift,$subject_dept,$subject_dept2);
				if($val=='')
				{
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst and end_time=$tet and day='$tday' and teacher_id=$teacher") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code2=$row['teacher_id'];
				}
			}
		}
		//-------------------------END for check TEACHER 2 available or not-------------------------		
		if($dt!='yes')
		{
			$q=mysqli_query($con,"select * from main_table where sr_no=$teacher_id") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$ts=$row['subject_id'];
				$tt=$row['teacher_id'];
			}
			if($fill=='avail')
			{
				mysqli_query($con,"update main_table set teacher_id=$teacher,subject_id=$subject where sr_no=$sr_no") or die (mysqli_error());
				mysqli_query($con,"update main_table set teacher_id=$teacher_id,subject_id=$subject_id where sr_no=$id") or die (mysqli_error());
			}
			else
			{
				mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$sr_no") or die (mysqli_error());
			}
			echo "<br>----------TH-update-------</br>";
		}
}
//----------------------------------------------------------------------------------------------------------------
function theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2)
{	
	$today=0;
	$teacher=0;
	$q=mysqli_query($con,"select * from main_table where day='$day' and subject_id=$subject_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' ") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	$q=mysqli_query($con,"select * from main_table where day='$day' and teacher_id=$teacher_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' ") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$teacher++;
	}
	if($today<=1 and $teacher<=1)
	{
		return 'yes';
	}
	else
	{
		return 'no';	 
	}
}

//----------------------------------------------------------------------------------
function time12($con,$st,$day,$teacher_id,$room,$shift,$subject_dept,$subject_dept2)
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
	$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift2' and (dept='$subject_dept' or dept2='$subject_dept2') and ( teacher_id=$teacher_id or room_id=$room)") or die (mysqli_error());
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
//---------------------------------------------------------------------------------------------
function fill($con,$time,$fill_id1,$fill_id2,$teacher_id,$subject_id,$subject_type,$shift)
{
	if($subject_type=='pr')
	{	
		global $batchA;
		global $batchB;
		global $batchC;
		if($batchA>0 and $batchA<$time)
		{
			fill_delete($con,0,$batchA,$subject_type);
			$batchA=0;
		}
		elseif($batchA==$time)
		{
			fill_insert($con,$shift,$teacher_id,$subject_id,$subject_type,'a');
			$batchA=0;
		}
		if($batchB>0 and $batchB<$time)
		{
			fill_delete($con,1,$batchB,$subject_type);
			$batchB=0;
		}
		elseif($batchB==$time)
		{
			fill_insert($con,$shift,$teacher_id,$subject_id,$subject_type,'b');
			$batchB=0;
		}
		if($batchC>0 and $batchC<$time)
		{
			fill_delete($con,2,$batchC,$subject_type);
			$batchC=0;
		}
		elseif($batchC==$time)
		{
			fill_insert($con,$shift,$teacher_id,$subject_id,$subject_type,'c');
			$batchC=0;
		}
	}
	else if($subject_type=='th')
	{
		global $batchTH;
		if($batchTH>0 and $batchTH<$time)
		{
			fill_delete($con,0,$batchTH,$subject_type);
			$batchTH=0;
		}
		elseif($batchTH==$time) 
		{
			fill_insert($con,$shift,$teacher_id,$subject_id,$subject_type,'null');
			$batchTH=0;
		}
		
	}
}
function fill_delete($con,$val,$cntr,$type)
{
	global $fill_id1;
	global $fill_id2;
	for($i=0;$i<$cntr;$i++)
	{
		$id1=$fill_id1[$val][$i];
		mysqli_query($con,"delete from main_table where sr_no=$id1") or die (mysqli_error());
		if($type=='pr')
		{
			$id2=$fill_id2[$val][$i];
			mysqli_query($con,"delete from main_table where sr_no=$id2") or die (mysqli_error());
		}
	}
}
function fill_insert($con,$shift,$teacher_id,$subject_id,$subject_type,$batch)
{
	global $subject_dept;
	mysqli_query($con,"insert into assign_subject (subject_id,shift,type,batch,dept) values ($subject_id,'$shift','$subject_type','$batch','$subject_dept')") or die (mysqli_error());
	mysqli_query($con,"insert into teacher_subject (teacher_id,subject_id,shift,type,batch,dept) values ($teacher_id,$subject_id,'$shift','$subject_type','$batch','$subject_dept')") or die (mysqli_error());
}	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	
function start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester)
{
	if($subject_type=='both' or $subject_type=='pr')
	{						
		for($j=0;$j<$shift_cntr;$j++)
		{
			$shift=$s[$j]; 
			$pt=$practical_time/2;
			for($i=0;$i<$pt;$i++)
			{
				for($k=0;$k<$batch_cntr;$k++)
				{
					$batch =$batches[$k];
					$val=checkSubject($con,$subject_id,$shift,$batch,$practical_time,$subject_dept,$subject_dept2);
					if($val==true)
					{
						pr($con,$teacher_id,$subject_id,$prRoom_id,$subject_year,$shift,$batch,$subject_dept,$subject_dept2,$semester);
					}
				}
			}
			fill($con,$pt,$fill_id1,$fill_id2,$teacher_id,$subject_id,'pr',$shift);
			updateSubjectStatus($con,$subject_id);
		}
	}
	if($subject_type=='both' or $subject_type=='th')
	{			
		for($j=0;$j<$shift_cntr;$j++)
		{
			$shift=$s[$j];
			for($i=0;$i<$theory_time;$i++)
			{  
				$val=checkSubject($con,$subject_id,$shift,'null',$theory_time,$subject_dept,$subject_dept2);
				if ($val==true)
				{
					th($con,0,0,0,$subject_id,$teacher_id,$thRoom_id,$subject_year,$shift,$subject_dept,$subject_dept2,'insert',0,$semester);
				}
			}
			fill($con,$theory_time,$fill_id1,$fill_id2,$teacher_id,$subject_id,'th',$shift);
			updateSubjectStatus($con,$subject_id);
		}
	}	
}	
function updateSubjectStatus($con,$subject_id)
{
	$th=subjectStatus($con,$subject_id,'th');
	$pr=subjectStatus($con,$subject_id,'pr');
	if($th==true and $pr==true)
	{
		mysqli_query($con,"update subject set status=1 where subject_id=$subject_id") or die (mysqli_error());
	}
}
function subjectStatus($con,$subject_id,$type)
{
	$cntr=0;
	$b=array("a","b","c","a","b","c");
	$s=array("fs","ss");
	if($type=='th')
	{
		$batch_cntr=1;
	}
	elseif($type=='pr')
	{
		$batch_cntr=3;
	}
	for($i=0;$i<2;$i++)
	{
		$shift=$s[$i];
		for($j=0;$j<$batch_cntr;$j++)
		{
			if($type=='th')
				$batch="null";
			else
				$batch=$b[$j];
			$q=mysqli_query($con,"select * from assign_subject where subject_id=$subject_id and batch='$batch' and shift='$shift'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
		}
	}	
	if(($batch_cntr*2)==$cntr)
	{
		return true;
	}
	else
	{
		return false;
	}
}
//------------------------------------------------------------------------------------------------
if(isset($_POST['adminAll']) or isset($_POST['adminSC'])) // By admin for Science & All department
{					 
				$subject_id=$_POST['subject'];
				$subject_dept=$_POST['dept'];
		        $subject_type=$_POST['type'];
			    $teacher_id=$_POST['teacher'];
				$subject_shift=$_POST['shift'];
				$subject_dept2; 
				$fill_id1[][]=0;
				$fill_id2[][]=0;
				$batchA=0;
				$batchB=0;
				$batchC=0; 
				$batch_cntr=0;
				$shift_cntr=0;
				$new_room=0;
				$cntr=0;
				$subject_code;
				$teacher_code;
				$subject_name;
				$subject_year;
				$semester;
				$practical_time;
				$theory_time;
				$room_id; 
				$pr_room='';
				$th_room='';
				if($subject_type=='both')
				{
					$pr_room=$_POST["prroom"];
					$th_room=$_POST["throom"];
				}
				elseif($subject_type=='th')
				{
					$th_room=$_POST["throom"];
				}
				elseif($subject_type=='pr')
				{
					$pr_room=$_POST["prroom"];
				}
				if($pr_room=='')
				{
					$prRoom_id=0;
				}
				else
				{
					$prRoom_id=$pr_room;
				}
				if($th_room=='')
				{
					$thRoom_id=0;
				}
				else
				{
					$thRoom_id=$th_room;
				}
				// --------------for select batch--------------
				if($subject_type=='both' or $subject_type=='pr')
				{
					
						if(isset($_POST['batch1']))
						{
							$batches[$batch_cntr++]='a';
						}
						if(isset($_POST['batch2']))
						{
							$batches[$batch_cntr++]='b';
						}
						if(isset($_POST['batch3']))
						{
							$batches[$batch_cntr++]='c';
						}	
						
				}				
				//----------------------------------- check subject deatail ---------------------------------------
				$q=mysqli_query($con,"select * from subject where subject_id=$subject_id") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))
				{
				    $subject_name=$row['subject_name'];
					$subject_dept2=$row['dept'];
					$subject_code=$row['subject_code'];
					$subject_year=$row['year'];
					$semester=$row['semester'];
					$practical_time=$row['practical_time'];
					$theory_time=$row['theory_time']; 
				}
				//-------------time table maker----------------
				if($subject_shift=='fs' or $subject_shift=='ss')
				{
					$s[$shift_cntr++]=$subject_shift;
				}
				else if($subject_shift=='both')
				{
					$s[0]='fs';
					$s[1]='ss';
					$shift_cntr=2;	
				}
				//----------------------------------
				if($new_room==0 and $cntr==0)
				{
					$cntr++;
					start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
				}
				if($new_room>=1 and $cntr==1)
				{
					$cntr++;
					start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
				}
				if(isset($_POST['adminAll']))
					header('Location:..\..\admin.php');
				else if(isset($_POST['adminSC']))
					header('Location:..\..\adminsc.php');
					
    } // isset
//-----------------------------------------------
if(isset($_POST['hod'])) // by head of department
{					 
		$subject_id=$_POST['subject'];
		$subject_dept=$_SESSION['deptHOD'];
		$subject_type=$_POST['type'];
		$teacher_id=$_POST['teacher'];
		$subject_shift=$_POST['shift'];
		$subject_dept2; 
		$fill_id1[][]=0;
		$fill_id2[][]=0;
		$batchA=0;
		$batchB=0;
		$batchC=0; 
		$batch_cntr=0;
		$shift_cntr=0;
		$new_room=0;
		$cntr=0;
		$subject_code;
		$teacher_code;
		$subject_name;
		$subject_year;
		$semester;
		$practical_time;
		$theory_time;
		$room_id; 
		$pr_room='';
		$th_room='';
		if($pr_room=='')
		{
			$prRoom_id=0;
		}
		else
		{
			$prRoom_id=$pr_room;
		}
		if($th_room=='')
		{
			$thRoom_id=0;
		}
		else
		{
			$thRoom_id=$th_room;
		}
		// --------------for select batch--------------
		$batches=array();
		if($subject_type=='both' or $subject_type=='pr')
		{
			if(isset($_POST['batch1']))
			{
				$batches[$batch_cntr++]='a';
			}
			if(isset($_POST['batch2']))
			{
				$batches[$batch_cntr++]='b';
			}
			if(isset($_POST['batch3']))
			{
				$batches[$batch_cntr++]='c';
			}	
		}				
		//----------------------------------- check subject deatail ---------------------------------------
		$q=mysqli_query($con,"select * from subject where subject_id=$subject_id") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$subject_name=$row['subject_name'];
			$subject_dept2=$row['dept'];
			$subject_code=$row['subject_code'];
			$subject_year=$row['year'];
			$semester=$row['semester'];
			$practical_time=$row['practical_time'];
			$theory_time=$row['theory_time']; 
		}
		//-------------time table maker----------------
		if($subject_shift=='fs' or $subject_shift=='ss')
		{
			$s[$shift_cntr++]=$subject_shift;
		}
		else if($subject_shift=='both')
		{
			$s[0]='fs';
			$s[1]='ss';
			$shift_cntr=2;	
		}
		//----------------------------------
		if($new_room==0 and $cntr==0)
		{
			$cntr++;
			start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
		}
		if($new_room>=1 and $cntr==1)
		{
			$cntr++;
			start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
		}
		header('Location:..\..\hod.php');
} // isset
//--------------------------------------------------------
if(isset($_POST['hodsc'])) // by head of Science department
{					 
		$subject_id=$_POST['subject'];
		$subject_dept=$_POST['dept'];
		$subject_type=$_POST['type'];
		$teacher_id=$_POST['teacher'];
		$subject_shift=$_POST['shift'];
		$subject_dept2; 
		$fill_id1[][]=0;
		$fill_id2[][]=0;
		$batchA=0;
		$batchB=0;
		$batchC=0; 
		$batch_cntr=0;
		$shift_cntr=0;
		$new_room=0;
		$cntr=0;
		$subject_code;
		$teacher_code;
		$subject_name;
		$subject_year;
		$semester;
		$practical_time;
		$theory_time;
		$room_id; 
		$pr_room='';
		$th_room='';
		$batches=array();
		if($pr_room=='')
		{
			$prRoom_id=0;
		}
		else
		{
			$prRoom_id=$pr_room;
		}
		if($th_room=='')
		{
			$thRoom_id=0;
		}
		else
		{
			$thRoom_id=$th_room;
		}
		// --------------for select batch--------------
		if($subject_type=='both' or $subject_type=='pr')
		{
		
			if(isset($_POST['batch1']))
			{
				$batches[$batch_cntr++]='a';
			}
			if(isset($_POST['batch2']))
			{
				$batches[$batch_cntr++]='b';
			}
			if(isset($_POST['batch3']))
			{
				$batches[$batch_cntr++]='c';
			}	
			
		}				
		//----------------------------------- check subject deatail ---------------------------------------
		$q=mysqli_query($con,"select * from subject where subject_id=$subject_id") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$subject_name=$row['subject_name'];
			$subject_dept2=$row['dept'];
			$subject_code=$row['subject_code'];
			$subject_year=$row['year'];
			$semester=$row['semester'];
			$practical_time=$row['practical_time'];
			$theory_time=$row['theory_time']; 
		}
		//-------------time table maker----------------
		if($subject_shift=='fs' or $subject_shift=='ss')
		{
			$s[$shift_cntr++]=$subject_shift;
		}
		else if($subject_shift=='both')
		{
			$s[0]='fs';
			$s[1]='ss';
			$shift_cntr=2;	
		}
		//----------------------------------
		if($new_room==0 and $cntr==0)
		{
			$cntr++;
			start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
		}
		if($new_room>=1 and $cntr==1)
		{
			$cntr++;
			start($con,$subject_year,$subject_type,$shift_cntr,$practical_time,$theory_time,$batch_cntr,$s,$batches,$subject_id,$teacher_id,$prRoom_id,$thRoom_id,$fill_id1,$fill_id2,$subject_dept,$subject_dept2,$semester);
		}
		//header('Location:..\..\hodsc.php');
	} // isset
?>