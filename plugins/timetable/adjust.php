<?php
include('connection.php'); 
$con= mysqli_connect(constant('host'),constant('user'),constant('password'),constant('db'));

if(isset($_REQUEST['adjust']))
{
	function pr($con,$temp_st,$temp_day,$id1,$id2,$teacher_id,$subject_id,$room_id,$subject_year,$shift,$batch,$subject_dept,$subject_dept2)
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
		global $execution;
		global $update;
		global $semester;
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
								$temp_st2=even_odd($con,$temp_st);
								if(($st1==$temp_st or $st1==$temp_st2) and $day==$temp_day)
								{
									$time='no';
								}
								else
								{
									if($st1!=17)
										$next=sidePrTh($con,$st1+2,$et1+2,$day,$shift,$subject_year,$subject_dept,$subject_dept2,'pr');
									else
										$next=true;
									if($st1!=8)
										$prev=sidePrTh($con,$st1-1,$et1-1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,'pr');
									else
										$prev=true;
									
									if($next==true or $prev==true)
									{
										$pr_status='yes';//practical_status($con,$day,$days,$dc,$subject_id,$shift,$subject_year,$batch,$subject_dept);
										if($dt!='yes')
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
											//echo "  r=$room_status ";
											if($room_status=='yes')
											{
												$pr_cntr=1;//no_of_practical($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept);
												//echo "<br>st=$st1 day=$day  pr_cntr=$pr_cntr ";
												if($pr_cntr<2)
												{
													move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
													move_theory($con,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
													check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
													check_back_theoryPR($con,$teacher_id,$st2,$et2,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
													$h8=true;//hours8($con,$st1,$day,$teacher_id,$subject_dept,$subject_dept2);
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
									}
									else
									{
										$time='no';
									}
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
							//echo " $st1 $et1 $day $teacher_id $subject_dept $subject_dept2";
							if($subject_dept2=='sc')
							{
								//echo "---pr--$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
							}
							else
							{
								check_back_pr_teacher($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2);
							}
							move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2);
							move_theory_back($con,$st2,$et2,$st1,$et1,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2);
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
					$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and semester='$semester' and semester='$semester'") or die (mysqli_error());
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
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st2 and end_time=$et2 and day='$day' and room_id=$room and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no2=$row['room_id'];	
			}	
		}
		//----------------------------END for check ROOM 2 available or not------------------------------
		if($dt!='yes')
		{
			//echo "<br> OGPR----".strtoupper($subject_year)."".strtoupper($shift)." PR Room no ".$room." and Teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." and from ".$st2." to ".$et2." on day ".$day." batch ".strtoupper($batch)."</br>";
			updatePR($con,$id1,$id2,$st1,$et1,$st2,$et2,$day,$room);
			$update++;
		}
		else
		{
			$new_room++;
			echo "<br>PR no space available for batch $batch</br>";
		}
	}
//--------------------------------------------------------------
function updatePR($con,$id1,$id2,$st1,$et1,$st2,$et2,$day,$room)
{
	
	mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$id1") or die (mysqli_error());
	mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day',room_id=$room where sr_no=$id2") or die (mysqli_error());
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
//----------------------------------------------------------------------------------------------------------
function check_back_pr_teacher($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$batch,$subject_dept,$subject_dept2)
{
	$cntr=0;
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='pr' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++; 
		$sr_no1=$row['sr_no'];
		$b=$row['batch'];
		$teacher_id=$row['teacher_id'];
		$room_id=$row['room_id'];
		$shift=$row['shift'];
		$year=$row['year'];
		$dept=$row['dept'];
		$dept2=$row['dept2'];
		$q2=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and batch='$b' and teacher_id=$teacher_id and type='pr' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q2))
		{
			$sr_no2=$row['sr_no'];
		}
	}
	if($cntr>0)
	{
		check_swap($con,$sr_no1,$sr_no2,$teacher_id,$room_id,$st1,$et1,$st2,$et2,$day,$shift,$year,$b,$dept,$dept2);
	}
}
//-----------------------------------------------------------------------------------------------------------------------------------------------
function check_swap($con,$tid1,$tid2,$teacher_id,$room_id,$tst1,$tet1,$tst2,$tet2,$tday,$shift,$subject_year,$batch,$subject_dept,$subject_dept2)
{
	$teacher_code4='no';
	global $semester;
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,10,12,14);
	$ss_time=array(16,14,12,10);
	$day_cntr=0;
	$time_cntr=0;
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
						{	//echo "-----$st1 $et1 $day $shift $subject_year $batch $subject_dept-----";
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))
							{   
								//echo "-----------8888------------------";
								$id1=$row['sr_no'];
								$teacher=$row['teacher_id'];
								$subject=$row['subject_id'];
								$room_id=$row['room_id'];
								$dept2=$row['dept2'];
								$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
							//echo "--sss---$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
						}
						else if($count==0 and $type1=='no' and $type2=='no')
						{
							$room = empty_room($con,$st1,$et1,$day,'pr',$teacher_id,$shift,$subject_dept,$subject_dept2);
							if($room!=0)
							{
								$room_id=$room;
								$fill='blank';
								$time='';
								//echo "---sss--$st1 $et1 $day $shift $subject_year $batch $subject_dept $subject_dept2-----";
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
					//echo " $st1 $et1 $day $teacher_id $subject_dept $subject_dept2";
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
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts where sr_no=$id1") or die (mysqli_error());
			mysqli_query($con,"update main_table set teacher_id=$tt,subject_id=$ts where sr_no=$id2") or die (mysqli_error());	
		}
		elseif($fill=='blank')
		{
			mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day' where sr_no=$tid1") or die (mysqli_error());
			mysqli_query($con,"update main_table set start_time=$st2,end_time=$et2,day='$day' where sr_no=$tid2") or die (mysqli_error());
		}		

		//echo "PRswap ".strtoupper($subject_year)."".strtoupper($shift)." st=$st1 day=$day $batch";
	}
}
//-----------------------------------------------------------------------------------------------------------------------------------
function insert($con,$st1,$day,$shift,$subject_year,$teacher_id,$subject_id,$room,$subject_type,$batch,$subject_dept,$subject_dept2)
{
	$et1=$st1+1;      //--------------insert-----------------
	$st2=$et1;
	$et2=$st2+1;
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
	mysqli_query($con,"insert into main_table (start_time,end_time,day,shift,room_id,subject_id,teacher_id,type,year,dept,dept2,batch) values ($st1,$et1,'$day','$shift',$room,$subject_id,$teacher_id,'$subject_type','$subject_year','$subject_dept','$subject_dept2','$batch')") or die (mysqli_error());
	if($subject_type=='pr')
	{	
		mysqli_query($con,"insert into main_table (start_time,end_time,day,shift,room_id,subject_id,teacher_id,type,year,dept,dept2,batch) values ($st2,$et2,'$day','$shift',$room,$subject_id,$teacher_id,'$subject_type','$subject_year','$subject_dept','$subject_dept2','$batch')") or die (mysqli_error());
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
	$q=mysqli_query($con,"select * from main_table where subject_id=$subject_id and type='pr' and batch='$batch' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and semester='$semester' and semester='$semester'") or die (mysqli_error());
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
//	echo "-----$subject_dept $subject_dept2-----";
	$q1=mysqli_query($con,"select room_id from room where type='$type' and dept='$subject_dept'");
	while($row=mysqli_fetch_array($q1))
	{ 
		$count=0;
		$temp_room=$row['room_id'];
		//echo $temp_room;
		$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and semester='$semester'") or die (mysqli_error());
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
//	echo "-----$subject_dept $subject_dept2-----";
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
				//echo $temp_room;
				$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and semester='$semester'") or die (mysqli_error());
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
function move_theory($con,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	global $new_room;
	global $semester;
	$new_room=0;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
			if($new_room>0)
				th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
			//echo "------st=$st1 et=$et1 day=$day shift=$shift----";
		}
	}		
}
//--------------------------------------------------------------------------------------------------------------------
function move_theory_back($con,$st1,$et1,$st2,$et2,$day,$teacher_id,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	global $new_room;
	global $semester;
	$new_room=0;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and dept='$subject_dept' and dept2='$subject_dept2' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))	
	{
		if($row['type']=='th')
		{
			/*if(($st1>=8 and $st1<12 and $row['shift']=='fs') or ($st1>=14 and $st1<18 and $row['shift']=='ss'))
			{*/
				th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
				if($new_room>0)
					th($con,$st2,$et2,$day,$row['subject_id'],$row['teacher_id'],0,$subject_year,$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
				//echo "------st=$st1 et=$et1 day=$day shift=$shift----";
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
	$room_status='no';
	$subject_type='th';
	$batch='null';
	$room;
	global $new_room;
	global $semester;
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
						$pr=0; //no_of_practical($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept);
						//echo "======$pr";
						if(($pr>=2 or $pr==0) and $dt!='yes')
						{
						//	echo "====new=$new_room room=$room_id";
							if($room_id==0 and $new_room==0)
							{
								if($method=='update')
								{
									$room=empty_room2($con,$st1,$et1,$day,$subject_type,$teacher_id,$shift,$subject_dept,$subject_dept2);
									//echo "=========update room=$room";
								}
							}
							else if($new_room>=1)
							{
								$room='new';
								//echo " 11111 st1=$st1 et1=$et1 day=$day room=$room_id new=$new_room method=$method";
								$room_status=0;
							}
							else
							{
								$room=$room_id;
								$room_status=0;
							}
							//echo "<br>st=$st1 day=$day room=$room";
							if(($room!=0 or $room_status==0) and $dt!='yes')
							{
								//$h8=hours8($con,$st1,$day,$teacher_id,$subject_dept,$subject_dept2);
								//$side=side($con,$st1,$et1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
								if($st1!=17)
									$next=sidePrTh($con,$st1+1,$et1+1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,'th');
								else
									$next=true;
								if($st1!=8)
									$prev=sidePrTh($con,$st1-1,$et1-1,$day,$shift,$subject_year,$subject_dept,$subject_dept2,'th');
								else
									$prev=true;
								//echo "<br>st=$st1 day=$day side=$side";
								$th=theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2);
								//echo "<br>st=$st1 day=$day th=$th";
								if(($next==true or $prev==true) and $th=='yes')
								{
									$cntr=0;
									$q= mysqli_query($con,"select start_time from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
									while($row=mysqli_fetch_array($q))
									{
										$cntr++;
									}
									if($cntr==0)
									{
										$time='';
										
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
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and semester='$semester'") or die (mysqli_error());
					$row=mysqli_fetch_array($q);
					$teacher_code=$row['teacher_id'];
				}
			}
			//-------------------------END for check TEACHER available or not-------------------------	
			if($dt=='yes' or $room=='new') 
			{
				$room_no='';
			}
			else
			{	
				//echo " line====974 st1=$st1 et1=$et1 day=$day room=$room_id new=$new_room method=$method";
				$q=mysqli_query($con,"select room_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and room_id=$room and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no=$row['room_id'];
			}
		}
		//-----------------------END for check ROOM available or not-------------------------
		if($dt!='yes')
		{	
			//echo "<br>".strtoupper($subject_year)."".strtoupper($shift)." TH Room no ".$room." and Teacher ".$teacher_id."  free on time from ".$st1." to ".$et1." on day ".$day."</br>";
			if($method=='insert')
			{
				//echo "<br>$method-----insert";
				insert($con,$st1,$day,$shift,$subject_year,$teacher_id,$subject_id,$room,$subject_type,$batch,$subject_dept,$subject_dept2);
			}
			else if($method=='update')
			{
				//echo "-----TH ".strtoupper($subject_year)."".strtoupper($shift)." st=$st1 day=$day ";
				update_back($con,$id,$st1,$et1,$day,$room); 
			}
		}
		else if($dt=='yes') 
		{
			$new_room++;
			//echo "<br>TH no space available</br>";
		}
}
//-------------------------------------------------------------------------
function check_prev($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2)
{
	$prev=0;
	global $semester;
	for($i=$st;$i>=8;$i--)
	{
		$et=$i+1;
		//echo "prev=$st st=$i et=$et ";
		$q=mysqli_query($con,"select distinct start_time from main_table where start_time=$i and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$prev++;
		}
	}
	return $prev;
}
//--------------------------------------------------------------------------
function check_next($con,$st,$day,$shift,$year,$subject_dept,$subject_dept2)
{
	$next=0;
	global $semester;
	for($i=$st;$i<18;$i++)
	{
		$et=$i+1;
		$q=mysqli_query($con,"select distinct start_time from main_table where start_time=$i and end_time=$et and day='$day' and shift='$shift' and year='$year' and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
	global $semester;
	$q=mysqli_query($con,"select distinct year,shift from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and type='th' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		if(($row['year']!=$subject_year and $row['shift']!=$shift) or ($row['year']==$subject_year and $row['shift']!=$shift) or ($row['year']!=$subject_year and $row['shift']==$shift))
		{
			$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
			while($row=mysqli_fetch_array($q2))
			{
				swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2);
			}
		}
	}
}
//-----------------------------------------------------------------------------------------------------------------------
function check_back_theoryPR($con,$teacher_id,$st1,$et1,$st2,$et2,$day,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	global $semester;
	$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and  type='th' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q2))
	{
		swap_theory($con,$row['sr_no'],$row['teacher_id'],$row['start_time'],$row['end_time'],$row['day'],$row['shift'],$row['year'],$st2,$et2,$subject_dept,$subject_dept2);
	}
}
//--------------------------------------------------------------------------------------------------------
function swap_theory($con,$sr_no,$teacher_id,$tst,$tet,$tday,$shift,$subject_year,$t1,$t2,$subject_dept,$subject_dept2)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,9,10,11,12,13,14,15);
	$ss_time=array(17,16,15,14,13,12,11,10);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	global $semester;
	$dt='no';
	$dept2='sc';
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
						$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))								
						{
							$type=$row['type'];
						}
						if($type=='th')
						{
							$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$subject_year' and type='th' and  dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
							while($row=mysqli_fetch_array($q))								
							{
								$count++;
								$teacher=$row['teacher_id'];
								$subject=$row['subject_id'];
								$id=$row['sr_no'];
								$dept2=$row['dept2'];
							}
						}
						if($count>0 and $dept2==$subject_dept and $type=='th' )
						{
							$time='';
							$fill='avail';
						}
						else if($count==0 and $type=='no')
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
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$st1 and end_time=$et1 and day='$day' and teacher_id=$teacher_id and semester='$semester'") or die (mysqli_error());
						$row=mysqli_fetch_array($q);
						$teacher_code1=$row['teacher_id'];
					}
				}
			}
			//-------------------------END for check TEACHER1 available or not-------------------------	
			if($dt=='yes')
			{
				$teacher_code2='';
			}
			else
			{
				$val=time12($con,$tst,$day,$teacher,0,$shift,$subject_dept,$subject_dept2);
				if($val=='')
				{
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst and end_time=$tet and day='$tday' and teacher_id=$teacher and semester='$semester'") or die (mysqli_error());
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
			else
			{
				mysqli_query($con,"update main_table set start_time=$st1,end_time=$et1,day='$day',room_id=$room where sr_no=$sr_no") or die (mysqli_error());
			}
			//echo "<br>----------TH-update-------</br>";
		}
}
//----------------------------------------------------------------------------------------------------
function theory_status($con,$day,$subject_id,$teacher_id,$shift,$subject_year,$batch,$subject_dept,$subject_dept2)
{	
	$today=0;
	$teacher=0;
	global $semester;
	$q=mysqli_query($con,"select * from main_table where day='$day' and subject_id=$subject_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$today++;
	}
	$q=mysqli_query($con,"select * from main_table where day='$day' and teacher_id=$teacher_id and type='th' and shift='$shift' and  year='$subject_year' and dept='$subject_dept' and dept2='$subject_dept2' and semester='$semester'") or die (mysqli_error());
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
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift2' and ( teacher_id=$teacher_id or room_id=$room) and semester='$semester'") or die (mysqli_error());
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
	global $semester;
	$q=mysqli_query($con,"select * from main_table where shift='$shift' and subject_id=$subject_id and batch='$batch' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
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
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
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
//---------------------------------------------------------------------- adjust------------------------------------------------------------------------------
function adjust_th($con,$year,$shift,$dept,$dept2,$semester)
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
			$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2')") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				$cntr++;
			}
			if($cntr==0)
			{
				//echo "<br>$year $shift $st1 $day</br>";
				checkSide($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$semester);
			}
		}
	}
//-----------------------------------------------------------------
function checkSide($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$semester)
{
	$next=check_next($con,$st1+1,$day,$shift,$year,$dept,$dept2);
	$prev=check_prev($con,$st1-1,$day,$shift,$year,$dept,$dept2);
	//echo "<br>TH----$next $prev $st1 $day ---</br>";
	if($next!=0 and $prev!=0)
	{
		//echo "<br>2222$year $shift $st1 $day</br>";
		//echo "<br>TH----$year $shift $st1 $day ---</br>";
		adjust_theory($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$semester);
	}
	else if(($shift=='fs' and $next>0 and $prev==0) or ($shift=='ss' and $next==0 and $prev>0))	
	{
		adjust_theory($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$semester);
	}
	else 	
	{
		adjust_theory($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$semester);
	}
}
//-----------------------------------------------------------------------------------------
function adjust_theory($con,$tst,$tet,$tday,$shift,$year,$dept,$dept2,$semester)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$ss_time=array(8,9,10,11,12,13,14,15,16,17);
	$fs_time=array(17,16,15,14,13,12,11,10,9,8);
	$day_cntr=0;
	$time_cntr=0;
	$time_cntr2=0;
	$room_status='no';
	$subject_type='th';
	$dt='no';
	$teacher_code1='y';
	//echo " ,,,,,,$tst $tday ,,,,,";
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
			if(($shift=='fs' and $st1<=$tst) or ($shift=='ss' and $st1>=$tst))
			{
				$dt='yes';
			}
			else
			{	
				$count=0;
				$type='no';
				//echo "<br>$year $shift $st1 $day</br>";
				$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$year' and dept='$dept' and semester='$semester'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))								
				{
					$type=$row['type'];
				}
				if($type=='th')
				{
					/*if($st1!=17)
						$next=sidePrTh($con,$st1+1,$et1+1,$day,$shift,$year,$dept,$dept2,'th');
					else
						$next=true;
					if($st1!=8)
						$prev=sidePrTh($con,$st1-1,$et1-1,$day,$shift,$year,$dept,$dept2,'th');
					else*/
						$prev=true;
					//echo "<br>$year $shift $st1 $day next=$next prev=$prev</br>";
					
					if($prev==true)
					{
						//echo "<br>---------$year $shift $st1 $day</br>";
						$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$year' and type='th' and  dept='$dept' and semester='$semester'") or die (mysqli_error());
						while($row=mysqli_fetch_array($q))								
						{
							$count++;
							$teacher_id=$row['teacher_id'];
							$subject=$row['subject_id'];
							$id=$row['sr_no'];
							//echo "ids=".$id;
						}
						if($count>0)
						{
							$time='';
						}
					}
					else
					{
						$time="no";
					}
				}
				else
				{
					$time="no";
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
			$teacher_code1='';
		}
		else
		{
			$val=time12($con,$tst,$tday,$teacher_id,0,$shift,$dept,$dept2);
			$room=empty_room2($con,$tst,$tet,$tday,'th',$teacher_id,$shift,$dept,$dept2);
			//echo "<br>$year $shift $st1 $day  val=$val room=$room</br>";
			if($val=='' and $room!=0)
			{
				//echo "<br> teacher $year $shift $st1 $day</br>";
				$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst and end_time=$tet and day='$tday' and teacher_id=$teacher_id and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$teacher_code1=$row['teacher_id'];
			}
		}
	}
//----------------------END for check TEACHER1 available or not-------------------------		
	if($dt!='yes')
	{
		mysqli_query($con,"update main_table set start_time=$tst,end_time=$tet,day='$tday',room_id=$room where sr_no=$id") or die (mysqli_error());
		//mysqli_query($con,"update main_table set start_time=$tst,end_time=$tet,day='$tday',room_id=$room where sr_no=$id") or die (mysqli_error());
		//echo "<br>Update on $year $shift $tst $tday $room $id</br>";	
		//echo "<br>update TH----$year $shift $st1 $day val=$val room=$room---</br>";
	}
}
//-----------------------------------------------------------
function adjust_pr($con,$year,$shift,$dept,$dept2,$semester)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(10,12,14,8);
	$ss_time=array(14,12,10,16);
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
		$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and type='pr' and dept='$dept' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
		}
		if($cntr==2 or $cntr==1)
		{
			//echo strtoupper($year)."".strtoupper($shift)." $st1 $day </br>";
			checkSidePR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$cntr,$semester);
		}
	}
}
//----------------------------------------------------------------------
function checkSidePR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2,$cntr,$semester)
{
	$next=check_next($con,$st1+2,$day,$shift,$year,$dept,$dept2);
	$prev=check_prev($con,$st1-1,$day,$shift,$year,$dept,$dept2);
	if($shift=='fs')
	{
		$prev=1;
	}
	else if($shift=='ss')
	{
		$next=1;
	}
	$batch=array("a","b","c");
	if($next>0 and $prev>0)
	{
		//echo "<br>----PR $year $shift $st1 $day----</br>";
		if($cntr==2)
		{
			for($i=0;$i<3;$i++)
			{
				$b=$batch[$i];
				$cntr=0;
				$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$year' and batch='$b' and type='pr' and  dept='$dept' and semester='$semester'") or die (mysqli_error());
				while($row=mysqli_fetch_array($q))								
				{
					$cntr++;
				}
				if($cntr==0)
				{
					//echo "<br>-PR ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day ".strtoupper($b)."----</br>";
					fetch_one($con,$st1,$et1,$day,$b,$shift,$year,$dept,$dept2);
				}
			}
		}
		else if($cntr==1)
		{	
			$room1=emptyRoom($con,$st1,$et1,$day,$shift,$dept,$semester);
			$room2=emptyRoom($con,$st1,$et1,$day,$shift,$dept,$semester);
			if($room1!=0 and $room2!=0)
			{
				for($i=0;$i<3;$i++)
				{
					$b=$batch[$i];
					$cntr=0;
					$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$year' and batch='$b' and type='pr' and dept='$dept' and semester='$semester'") or die (mysqli_error());
					while($row=mysqli_fetch_array($q))								
					{
						$cntr++;
					}
					if($cntr==0)
					{
						//echo "<br>-PR ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day ".strtoupper($b)."----</br>";
						fetch_one($con,$st1,$et1,$day,$b,$shift,$year,$dept,$dept2);
					}
				}
			}
			else
				callUpdatePR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2);
			//echo "<br>-11111PR ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day ----</br>";
		}
	}	
}
//-------------------------------------------------------------------------------------------------
function fetch_one($con,$tst1,$tet1,$tday,$batch,$shift,$subject_year,$subject_dept,$subject_dept2)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$ss_time=array(8,10,12,14,16);
	$fs_time=array(16,14,12,10,8);
	$day_cntr=0;
	$time_cntr=0;
	$dt='no';
	$st1;$st2;$et1;$et2;$tst2;$tet2;
	$teacher_id;
	$room;
	$id1;$id2;
	$dept2='no';
	global $dbCntr;
	global $database;
	global $semester;
	//----------------------
	$room_no2='no';
	while($room_no2!='')
	{
		//-----------------------
		$room_no1='no';
		while($room_no1!='')
		{
			//-------------------------
			$teacher_code2='no';
			while($teacher_code2!='')
			{
				//-------------------------
				$teacher_code1='no';
				while($teacher_code1!='')
				{
					//------------------------
					$time='no';
					while($time!='')
					{
						//------------------------------------------------------------------------------------------
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
						$count=0;
						$type='null';
						$st2=$st1+1;
						$et2=$et1+1;
						$tst2=$tst1+1;
						$tet2=$tet1+1;
						$type='no';
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
								$id1=$row['sr_no'];
								$teacher_id=$row['teacher_id'];
								$subject=$row['subject_id'];
								$room_id=$row['room_id'];
								$dept2=$row['dept2'];
								$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$subject_year' and batch='$batch' and type='pr' and dept='$subject_dept' and semester='$semester'") or die (mysqli_error());
								while($row=mysqli_fetch_array($q))
								{   
									$id2=$row['sr_no'];
									$count++;
								}
							}
							if($count>0)
							{
								$room=empty_room($con,$tst1,$tet1,$tday,'pr',$teacher_id,$shift,$subject_dept,$dept2);
								if($room==0)
								{
									removeRoom($con,$tst1,$tet1,$tday,$teacher_id,$subject_year,$shift,$subject_dept,$dept2);
								}
								$room=empty_room($con,$tst1,$tet1,$tday,'pr',$teacher_id,$shift,$subject_dept,$dept2);
								if($room!=0)
								{
									//$next=check_next($con,$st1+2,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
									//$prev=check_prev($con,$st1-1,$day,$shift,$subject_year,$subject_dept,$subject_dept2);
									
									$time=''; 
								}
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
						check_back_pr_teacher($con,$tst1,$tet1,$tst2,$tet2,$tday,$teacher_id,$batch,$subject_dept,$subject_dept2);
						$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst1 and end_time=$tet1 and day='$tday' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
						$row=mysqli_fetch_array($q);
						$teacher_code1=$row['teacher_id'];
						//echo strtoupper($subject_year)."".strtoupper($shift)." st=$st1 day=$day teacher_id=$teacher_code1";
					}
				}
				//-------------------------------END for check TEACHER 1 available or not-----------------------------
				if($dt=='yes')
				{
					$teacher_code2='';
				}
				else
				{
					$q=mysqli_query($con,"select teacher_id from main_table where start_time=$tst2 and end_time=$tet2 and day='$tday' and teacher_id=$teacher_id and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
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
				$q=mysqli_query($con,"select room_id from main_table where start_time=$tst1 and end_time=$tet1 and day='$tday' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
				$row=mysqli_fetch_array($q);
				$room_no1=$row['room_id'];
			}
		}
		//-------------------------------END for check ROOM 1 available or not-----------------------------
		if($dt=='yes')
		{
			$room_no2='';
		}
		else
		{	
			$q=mysqli_query($con,"select room_id from main_table where start_time=$tst2 and end_time=$tet2 and day='$tday' and room_id=$room and (dept='$subject_dept' or dept2='$subject_dept2') and semester='$semester'") or die (mysqli_error());
			$row=mysqli_fetch_array($q);
			$room_no2=$row['room_id'];
		}
	}
//-------------------------------END for check ROOM 2 available or not-----------------------------
	if($dt!='yes')
	{
		//echo " UPDATE 2 ".strtoupper($subject_year)."".strtoupper($shift)." st=$st1 day=$day type=$type";
		mysqli_query($con,"update main_table set start_time=$tst1,end_time=$tet1,day='$tday',room_id=$room where sr_no=$id1") or die (mysqli_error());
		mysqli_query($con,"update main_table set start_time=$tst2,end_time=$tet2,day='$tday',room_id=$room where sr_no=$id2") or die (mysqli_error());
	}
}
//------------------------------------------------------------------------------------
function removeRoom($con,$st1,$et1,$day,$teacher_id,$subject_year,$shift,$dept,$dept2)
{
	$fyfs=0;
	$syfs=0;
	$tyfs=0;
	$fyss=0;
	$syss=0;
	$tyss=0;
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and type='pr' and dept='$dept' and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{   
		$year=$row['year']; 
		//echo "$year";
		if($year==$subject_year and $shift==$row['shift'])
		{
		}
		else
		{
			 //echo " year=$year  ".$row['shift'];
			if($row['shift']=='fs')
			{
				if($year=='fy')
					$fyfs++;
				elseif($year=='sy')
					$syfs++;
				elseif($year=='ty')
					$tyfs++;
			}
			else
			{
				if($year=='fy')
					$fyss++;
				elseif($year=='sy')
					$syss++;
				elseif($year=='ty')
					$tyss++;
			}
		}
	}	
	//echo ">>>>>>>>>>>fyfs=$fyfs";
	if($fyfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','fy',$dept,$dept2);
		//echo "------------------------";
	}
	elseif($syfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','sy',$dept,$dept2);
	}
	elseif($syfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','ty',$dept,$dept2);
	}
	elseif($fyfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','fy',$dept,$dept2);
	}
	elseif($syfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','sy',$dept,$dept2);
	}
	elseif($syfs==1)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','ty',$dept,$dept2);
	}
	$update=0;
	if($fyfs==2)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','fy',$dept,$dept2);
	}
	if($syfs==2 and $update==0)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','sy',$dept,$dept2);
	}
	if($syfs==2 and $update==0)
	{
		callUpdatePR($con,$st1,$et1,$day,'fs','ty',$dept,$dept2);
	}
	if($fyfs==2 and $update==0)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','fy',$dept,$dept2);
	}
	if($syfs==2 and $update==0)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','sy',$dept,$dept2);
	}
	if($syfs==2 and $update==0)
	{
		callUpdatePR($con,$st1,$et1,$day,'ss','ty',$dept,$dept2);
	}
}
//--------------------------------------------------
function sideLecture($con,$year,$shift,$dept,$dept2,$semester)
{
	$days=array("mon","tue","wed","thu","fri","sat");
	$fs_time=array(8,10,12,14,16);
	$ss_time=array(16,14,12,10,8);
	$day_cntr=0;
	$time_cntr=0;
	$b=array('a','b','c');
	$dt='no';
	global $step;
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
		$type='no';
		$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and dept='$dept' and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
			$type=$row['type'];
		}
		if(($cntr==2 or $cntr==1) and $type=='pr')
		{
			//echo "<br>$year $shift $st1 $day</br>";
			checkSideLR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2);
		}
	}
}
//-----------------------------------------------------------------
function checkSideLR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2)
{
	$next=check_next($con,$st1+2,$day,$shift,$year,$dept,$dept2);
	$prev=check_prev($con,$st1-1,$day,$shift,$year,$dept,$dept2);
	global $step;
	global $semester;
	if($next>0 and $prev>0)
	{
		//echo "<br>TH----$year $shift $st1 $day ---</br>";
		$prev_st=$st1-1;
		$prev_et=$st1;
		$next_st=$st1+2;
		$next_et=$et1+2;
		$type='no';
		$type2='no';
		$q=mysqli_query($con,"select * from main_table where start_time=$prev_st and end_time=$prev_et and day='$day' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type=$row['type'];
		}
		//echo "time=$prev_st prev=$type";
		$q=mysqli_query($con,"select * from main_table where start_time=$next_st and end_time=$next_et and day='$day' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$type2=$row['type'];
		}
		//echo "  time=$next_st $next_et next=$type2";
		
			$prev=check_prev($con,$st1-1,$day,$shift,$year,$dept,$dept2);
		//	echo " lect prev=$prev";
		
			$next=check_next($con,$st1+2,$day,$shift,$year,$dept,$dept2);
			//echo " lect next=$next";
		
		if($type=='th' and $type2=='th')
		{
			if($prev>$next)
			{
				if($next<3)
				{
					callNextUpdateTH($con,$next_st,$next_et,$next,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $next_st $day ---</br>";
				}
			}
			else if($next>$prev)
			{
				if($prev<3)
				{
					callPrevUpdateTH($con,$prev_st,$prev_et,$prev,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $prev_st $day ---</br>";
				}
			}
			else if($next==$prev)
			{
				if($prev<3)
				{
					callPrevUpdateTH($con,$prev_st,$prev_et,$prev,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $prev_st $day ---</br>";
					
				}
			}
		}
		else if($type=='th' and $type2=='pr')
		{
			if($prev>$next)
			{
				if($next<3)
				{
					selectPR($con,$next_st,$next_et,$day,$year,$shift,$st1,$et1,$dept,$dept2);
					//echo "<br>PR----$year $shift $next_st $day ---</br>";
				}
			}
			else if($next>$prev)
			{
				if($prev<3)
				{
					callPrevUpdateTH($con,$prev_st,$prev_et,$prev,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $prev_st $day ---</br>";
				}
			}
			else if($next==$prev)
			{
				if($prev<3)
				{
					callPrevUpdateTH($con,$prev_st,$prev_et,$prev,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $prev_st $day ---</br>";
				}
			}
		}
		else if($type=='pr' and $type2=='th')
		{
			
			if($prev>$next)
			{
				if($next<3)
				{
					callNextUpdateTH($con,$next_st,$next_et,$next,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $next_st $day ---</br>";
				}
			}
			else if($next>$prev)
			{
				if($prev<3)
				{
					selectPR($con,$prev_st,$prev_et,$day,$year,$shift,$st1,$et1,$dept,$dept2);
					//echo "<br>PR----$year $shift $prev_st $day ---</br>";
				}
			}
			else if($next==$prev)
			{
				if($prev<3)
				{
					callNextUpdateTH($con,$next_st,$next_et,$next,$day,$shift,$year,$dept,$dept2);
					//echo "<br>TH----$year $shift $next_st $day ---</br>";
				}
			}
		}
	}	
	$step++;
}
//------------------------------------------------------------------------
function selectPR($con,$st,$et,$day,$year,$shift,$st1,$et1,$dept,$dept2)
{
	global $semester;
	$q=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and year='$year' and shift='$shift' and type='pr' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$batch=$row['batch'];
		$cntr=0;
		$q2=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and year='$year' and shift='$shift' and batch='$batch' and type='pr' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
		while($row2=mysqli_fetch_array($q2))
		{
			$cntr++;
		}
		if($cntr==0)
		{
			callUpdatePR($con,$st,$et,$day,$shift,$year,$dept,$dept2);
			//echo "TH ".strtoupper($year)."".strtoupper($shift)."$st1 $day ".strtoupper($batch);
		}
	}	
}
//---------------------------------------------------------------------------
function callNextUpdateTH($con,$st,$et,$cntr,$day,$shift,$year,$dept,$dept2)
{
	global $semester;
	for($i=0;$i<$cntr;$i++)
	{
		$st2=$st+$i;
		$et2=$st2+1;
		
		$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and type='th' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2') and semester='$semester'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
		}
	}
	//echo "------33333---TH ".strtoupper($year)."".strtoupper($shift)."$st $day";
}
//----------------------------------------------------------------------
function callPrevUpdateTH($con,$st,$et,$cntr,$day,$shift,$year,$dept,$dept2)
{
	for($i=0;$i<$cntr;$i++)
	{
		$st2=$st-$i;
		$et2=$st2+1;
		
		$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and type='th' and year='$year' and shift='$shift' and (dept='$dept' or dept2='$dept2')") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			th($con,$st,$et,$day,$row['subject_id'],$row['teacher_id'],0,$row['year'],$row['shift'],$row['dept'],$row['dept2'],'update',$row['sr_no']);
		}
	}
	//echo "------33333---TH ".strtoupper($year)."".strtoupper($shift)."$st $day";
}

//-------------------------------------------------------------------
function callUpdatePR($con,$st1,$et1,$day,$shift,$year,$dept,$dept2)
{
	$st2=even_odd($con,$st1);
	$et2=$st2+1;
	$count1=0;
	$count2=0;
	$id1=array();
	$id2=array();
	$batch=array();
	$q=mysqli_query($con,"select * from main_table where start_time=$st1 and end_time=$et1 and day='$day' and shift='$shift' and year='$year' and type='pr' and  dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))								
	{
		$id1[$count1]=$row['sr_no'];
		$teacher_id=$row['teacher_id'];
		$subject_id=$row['subject_id'];
		$y=$row['year'];
		$s=$row['shift'];
		$dept=$row['dept'];
		$dept2=$row['dept2'];
		$batch[$count1++]=$row['batch'];
	}
	$q=mysqli_query($con,"select * from main_table where start_time=$st2 and end_time=$et2 and day='$day' and shift='$shift' and year='$year' and type='pr' and  dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))								
	{
		$id2[$count2++]=$row['sr_no'];
	}
	for($i=0;$i<$count1;$i++)
	{
		$sr1=$id1[$i];
		$sr2=$id2[$i];
		$b=$batch[$i];
		//echo "update one PR ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day ".strtoupper($b);
		//mysqli_query($con,"update main_table set day='temp' where sr_no=$sr1")or die (mysqli_error());
		//mysqli_query($con,"update main_table set day='temp' where sr_no=$sr2")or die (mysqli_error());
		pr($con,$st1,$day,$sr1,$sr2,$teacher_id,$subject_id,0,$y,$s,$b,$dept,$dept2);
	}
}
//--------------------------------------------------
function roomTh($con,$year,$shift,$dept,$dept2,$semester)
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
		$q=mysqli_query($con,"select m.*,r.* from main_table m,room r where m.start_time=$st1 and m.end_time=$et1 and m.day='$day' and m.year='$year' and m.shift='$shift' and m.dept='$dept' and m.semester='$semester' and m.room_id=r.room_id and r.room_no='new'") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cntr++;
			$id=$row['sr_no'];
			$teacher=$row['teacher_id'];
		}
	//	echo " ".strtoupper($year)."".strtoupper($shift)." st=$st1 day=$day room=$cntr";
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
function databaseOG($dept,$semester)
{
	global $databaseOG;
	global $con;
	$i=0;
	$q=mysqli_query($con,"select * from main_table where semester='$semester'") or die (mysqli_error());
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
//-----------------------------------------------------------
function emptyRoom($con,$st,$et,$day,$shift,$dept,$semester)
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
		$q2=mysqli_query($con,"select * from main_table where start_time=$st and end_time=$et and day='$day' and room_id=$temp_room and dept='$dept' and semester='$semester'") or die (mysqli_error());
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
//---------------------------------------------------------------------------------------------------------------
	$dept=$_REQUEST['dept'];
	$year=$_REQUEST['year'];
	$shift=$_REQUEST['shift'];
	$semester=$_REQUEST['sem'];
	$y=array("sy");
	$s=array("ss");
	$new_room=0;
	$step=0;
	$i=0;
	$dbCntr=0;
	$val=true;
	$database=array();
	$databaseOG=array(array());
	$execution=true;
	$update=0;
	$dbRoom=array();
	$dbRoomCntr=0;
	$deptCntr=0;
	$q1=mysqli_query($con,"select * from room where dept='$dept'");
	while($row=mysqli_fetch_array($q1))
	{ 
		$deptCntr++;
	}
	//databaseOG($dept,$semester);
	//echo "val=".count($database);
	//mysqli_query($con,"update main_table set semester='even'")or die (mysqli_error());
	/*for($i=0;$i<count($y);$i++)
	{
		$year=$y[$i];
		for($j=0;$j<count($s);$j++)
		{
			$shift=$s[$j];*/
			//echo "-----".strtoupper($year)."".strtoupper($shift);
			if($deptCntr!=0)
			{
				adjust_pr($con,$year,$shift,$dept,$dept,$semester);
				adjust_th($con,$year,$shift,$dept,$dept,$semester);
				sideLecture($con,$year,$shift,$dept,$dept,$semester);
				roomTh($con,$year,$shift,$dept,$dept,$semester);
			}
			//adjust_pr($con,$year,$shift,$dept,'if');
			//adjust_th($con,$year,$shift,$dept,'if');
			//fetch_th($con,$year,$shift,$dept,'if');
	/*	}
	}
	if($execution==false)
	{
		//databaseBackUpOG();
	}
	/*if(count($database)==0)
	{
		$val=false;
	}
	//echo "val===$val   ".count($database);
	while($val!=false)
	{
		if($i<count($database))
		{
			$id=$database[$i++];
			$q=mysqli_query($con,"select * from main_table where sr_no=$id") or die (mysqli_error());
			while($row=mysqli_fetch_array($q))
			{
				fetch_one($con,$row['start_time'],$row['end_time'],$row['day'],$row['batch'],$row['shift'],$row['year'],$row['dept'],$row['dept2']);
				echo ">>>>>>>>>>>>>>>>>>>>-till-".strtoupper($year)."".strtoupper($shift)." st=".$row['start_time']." day=".$row['day']."".strtoupper($row['batch'])." id=$id--";
			}
		}
		else
		{
			$val=false;
		}
	}*/
	/*for($i=0;$i<3;$i++)
	{
		$year=$y[$i];
		for($j=0;$j<2;$j++)
		{
			$shift=$s[$j];
			sideLecture($con,$year,$shift,$dept,'if');
		}
	}
	
	
	for($i=0;$i<3;$i++)
	{
		$year=$y[$i];
		for($j=0;$j<2;$j++)
		{
			$shift=$s[$j];
			adjust_th($con,$year,$shift,$dept,'if');
		}
	}
	for($i=0;$i<3;$i++)
	{
		$year=$y[$i];
		for($j=0;$j<2;$j++)
		{
			$shift=$s[$j];
			roomTh($con,$year,$shift,$dept,'if');
		}
	}*/
	
}
?>