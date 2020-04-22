<?php
$con= mysqli_connect("localhost","root","");
mysqli_select_db($con,"gpm");
//------------------------------
if(isset($_REQUEST['all']))
{
	$id=$_REQUEST['id'];
	$val=$_REQUEST['val'];
	$col=$_REQUEST['col'];
	$table_name=$_REQUEST['table_name'];
	if($col=="theory_time" or $col=="practical_time")
	{
		$q=mysqli_query($con,"update ".$table_name." set ".$col."=$val where ".$table_name."_id=$id") or die (mysqli_error());
	}
	else
	{
		$q=mysqli_query($con,"update ".$table_name." set ".$col."='$val' where ".$table_name."_id=$id") or die (mysqli_error());
	}
}
//------------------------------
if(isset($_REQUEST['content']))
{
	$val=$_REQUEST['val'];
	$dept=$_REQUEST['dept'];
	$f=$_REQUEST['field'];
	$cntr=0;
	//echo "-------$val $f $dept----------";
	$q=mysqli_query($con,"select * from content where field='$f' and dept='$dept'") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
		echo "-------$val $f $dept----------";
		$q=mysqli_query($con,"update content set value='$val' where dept='$dept' and field='$f'") or die (mysqli_error());
	}
	if($cntr==0)
	{
		//echo "-------$val $field $dept----------";
		$q=mysqli_query($con,"insert into content (field,value,dept) values('$f','$val','$dept')") or die (mysqli_error());
	}
}


?>