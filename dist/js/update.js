var id,col,val;
$(document).on('keydown', '.subject',function(e){
   id=$(this).data("id");
   col=$(this).data("id2");
   val=$(this).text();
   if(e.which == 13)
   {
		document.getElementById("myPass").style.display = "block";
	}
});	
//--------------------------------------------------------
$(document).on('keydown', '.room',function(e){
   id=$(this).data("id");
   col=$(this).data("id2");
   val=$(this).text();
   if(e.which == 13)
   {
		document.getElementById("myPass").style.display = "block";
   }
});	
//---------------------------------------------------------
$(document).on('keydown', '.teacher',function(e){
   id=$(this).data("id");
   col=$(this).data("id2");
   val=$(this).text();
   if(e.which == 13)
   {
		document.getElementById("myPass").style.display = "block";
   }
});
//---------------------------------------------------------
$(document).on('keydown', '#incharge',function(e){
   val=$(this).text();
   if(e.which == 13)
   {
	    //alert(val);
		updateContent(val,'incharge');
	}
});
//---------------------------------------------------------
$(document).on('keydown', '#hod',function(e){
   val=$(this).text();
   if(e.which == 13)
   {
	    //alert(val);
		updateContent(val,'hod');
	}
});
//---------------------------------------------------------
$(document).on('keydown', '#principal',function(e){
   val=$(this).text();
   if(e.which == 13)
   {
	    //alert(val);
		updateContent(val,'principal');
	}
});
//---------------------------------------------------------
function update(table_name)
{
	var pass=document.getElementById("password").value;
	//up=userPass();
	//alert("pass="+pass+"user pass="+up);
	if(pass == userPass())
	{
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				//alert(this.responseText);
				document.getElementById("password").innerHTML = "";
				document.getElementById("myPass").style.display = "none";
				location.reload();
			}
		};
		xhttp.open("GET",  "../../plugins/timetable/updateform.php?all=1&&id="+id+"&&val="+val+"&&col="+col+"&&table_name="+table_name, true);
		xhttp.send();
	}
	else if(pass !==userPass())
	{
		//alert("Please enter correct password !");
	}
	return false;
}
//---------------------------------------------------------
function updateContent(val,field)
{
	var dept=deptVal();
	//alert(val+"  "+field);
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				alert(this.responseText);
				document.getElementById("myPass").style.display = "none";
				location.reload();
			}
		};
		xhttp.open("GET",  "../../plugins/timetable/updateform.php?content=1&&val="+val+"&&dept="+dept+"&&field="+field, true);
		xhttp.send(); 
	return false;
}

//-------------------------
function passCancel(id) 
{
	document.getElementById(id).style.display = "none";
}