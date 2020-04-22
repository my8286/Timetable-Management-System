 function search() {
		//alert();
		var dept=deptVal();
	    xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
		    {
                document.getElementById("teacher").innerHTML= this.responseText;
            }
        };
        xhttp.open("GET", "../../plugins/timetable/timetable.php?deptTeacher=1&&dept="+dept, true);
        xhttp.send(); 
		xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
		    {
                document.getElementById("room").innerHTML= this.responseText;
            }
        };
        xhttp.open("GET", "../../plugins/timetable/timetable.php?deptRoom=1&&dept="+dept, true);
        xhttp.send(); 
        timeTable();
}
function timeTable()
{   	
       var  xhttp;
       var yearId = document.getElementById("year"); 
	   var labelYearId = document.getElementById("labelYear");
       var shift = document.getElementById("shift").value;
	   var year = yearId.value;
       var teacher = document.getElementById("teacher").value;
	   var room = document.getElementById("room").value;
			var dept=deptVal();
		//alert(val,dept);
	 if(year == "fy")
	  { 
         labelYearId.innerHTML= 'FIRST YEAR';
	  }
	  else if(year == "sy")
	  {
		  labelYearId.innerHTML= 'SECOND YEAR';
	  }
	  else if(year == "ty")
	  {
		 labelYearId.innerHTML= 'THIRD YEAR';
	  } 
	  else
	  {
		 labelYearId.innerHTML= '';
	  } 
		if(shift == "fs") 
		{   
			document.getElementById("labelShift").innerHTML= 'FIRST SHIFT';
		}
		else if(shift == "ss")
		{   
			document.getElementById("labelShift").innerHTML= 'SECOND SHIFT';
		}	
		else
		{	
			document.getElementById("labelShift").innerHTML= '';  
		}
		 if(teacher!="default")
		 {
			xhttp = new XMLHttpRequest();                             // search teacher name
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("labelTeacher").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "../../plugins/timetable/timetable.php?deptTeacherName=1&&teacher="+teacher, true);
			xhttp.send(); 
		 }
		 else
		 {
			 document.getElementById("labelTeacher").innerHTML = "";
		 }
		 if(room!="default")
		 {
			xhttp = new XMLHttpRequest();                             // search Room number
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("labelRoom").innerHTML = "ROOM "+this.responseText;
				}
			};
			xhttp.open("GET", "../../plugins/timetable/timetable.php?deptRoomNumber=1&&room_id="+room, true);
			xhttp.send(); 
		 }
		 else
		 {
			 document.getElementById("labelRoom").innerHTML = "";
		 }
		 //alert(dept);
		 if(dept!="default" && (shift !='default' || year!='default' || teacher!='default' || room!='default'))
		 {
			 //alert();
			loadCounterThPr(year,shift,dept,teacher,room);
			tableLoop(year,shift,dept,teacher,room);
		 }
		 
}
//-------------------------
function deptLabel(dept,id)
{
	//alert(dept+""+id);
	if(dept == "if")
	  { 
        document.getElementById(id).innerHTML= 'Information Technology Department';
	  }
	  else if(dept == "co")
	  {
		 document.getElementById(id).innerHTML= 'Computer Department';
	  }
	   else if(dept == "me")
	  {
		 document.getElementById(id).innerHTML= 'Mechnical Department';
	  }
	  else
	  { 
		 document.getElementById(id).innerHTML= '';
	  }
}
//----------------------------------------------
function tableLoop(year,shift,dept,teacher,room)
{

	var days = ["mon", "tue", "wed" ,"thu", "fri", "sat"];
	var day;
	for(i=0;i<6;i++)
	{
		day=days[i];
		for(j=8;j<18;j++)
		{         
			var id= day+""+j;
			var st=j;
			var et=j+1;
			if(dept !='default')
			show(id,st,et,day,year,shift,dept,teacher,room);	
		}	
		
		if(i==5)
		{	//alert(i);
			document.getElementById("myLoader").style.display = "none";
		}
	} 
	
}
//------------------------------------------------------
function show(id,st,et,day,year,shift,dept,teacher,room)
{		
	var sem=document.getElementById("sem").value;
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(id);
		document.getElementById(id).innerHTML = this.responseText;
		//alert(this.responseText);
		
		}
	};
	xhttp.open("GET", "../../plugins/timetable/timetable.php?timeTable=1&&year="+year+"&&shift="+shift+"&&st="+st+"&&et="+et+"&&day="+day+"&&dept="+dept+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem, true);
	xhttp.send();
}	
//----------------------------------------------------------
function loadCounterThPr(year,shift,dept,teacher,room)
{		
	var sem=document.getElementById("sem").value;
	var xhttp = new XMLHttpRequest(); 
	var type="th";
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("totalTH").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounter=1&&year="+year+"&&shift="+shift+"&&dept="+dept+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem+"&&types="+type, true);
	xhttp.send();
	
	var xhttp = new XMLHttpRequest(); 
	type="pr";
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("totalPR").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounter=1&&year="+year+"&&shift="+shift+"&&dept="+dept+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem+"&&types="+type, true);
	xhttp.send();
	
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("total").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounterAll=1&&year="+year+"&&shift="+shift+"&&dept="+dept+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem, true);
	xhttp.send();
	
}	
//---------------------------------------------------------------------------
function search2() {
	  //alert();
       	var dept=deptVal();
	    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
		    {
                document.getElementById("teacher").innerHTML= this.responseText;
            }
        };
        xhttp.open("GET", "../../plugins/timetable/timetable.php?deptTeacher=1&&dept="+dept, true);
        xhttp.send(); 
		xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
		    {
                document.getElementById("room").innerHTML= this.responseText;
            }
        };
        xhttp.open("GET", "../../plugins/timetable/timetable.php?deptRoom=1&&dept="+dept, true);
        xhttp.send(); 
		master();
}
//---------------------
function master()
{
	var y = ["fy", "sy", "ty"];
	var s = ["fs", "ss"];
	var d = ["mon","tue","wed","thu","fri","sat"];
	var teacher=document.getElementById('teacher').value;
	var room=document.getElementById('room').value;
	var dept=deptVal();
	loadMaster(dept);
	if(dept !=='default')
	for(i=0;i<3;i++)
	{
		year=y[i];
		for(j=0;j<2;j++)
		{
			shift=s[j];
			for(k=0;k<6;k++)
			{
				day=d[k];
				for(l=8;l<18;l++)
				{         
					var id= year+""+shift+""+day+""+l;
					var st=l;
					var et=l+1;
					//alert(id);
					show(id,st,et,day,year,shift,dept,teacher,room);	
				}
			}			
		}
	} 	
}
//--------------------------
function loadMaster(dept)
{
	sem=document.getElementById("sem").value;
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("total").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounterMasterAll=1&&dept="+dept+"&&sem="+sem, true);
	xhttp.send();
	
	type='th';
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("totalTH").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounterMasterThPr=1&&dept="+dept+"&&sem="+sem+"&&type="+type, true);
	xhttp.send();
	
	type='pr';
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("totalPR").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?loadCounterMasterThPr=1&&dept="+dept+"&&sem="+sem+"&&type="+type, true);
	xhttp.send();
}
//-------------------------
function passCancel(id) 
{
	document.getElementById(id).style.display = "none";
}
//-------------------------
function passModal()
{
	var year = document.getElementById("year").value; 
	var shift = document.getElementById("shift").value;
	var teacher = document.getElementById("teacher").value;
	var room = document.getElementById("room").value;
	var sem = document.getElementById("sem").value;
	var dept=deptVal();
	
	if(year!="default" || shift!="default" || teacher!="default" || room!="default" )
	{
		if(dept!="default")
		{
			document.getElementById("myPass").style.display = "block";
		}
	}
}
//--------------------------
function deleteConfirm()
{
	var pass=document.getElementById("password");
	if(inputBoth(pass," password "))  
	{
		if(pass.value == userPass())
		{
			document.getElementById("myPass").style.display = "none";
			//pass.reset();
			deleteTable();
		}
	}	
	return false;
}
//-------------------------
function deleteTable()
{
	var year = document.getElementById("year").value; 
	var shift = document.getElementById("shift").value;
	var teacher = document.getElementById("teacher").value;
	var room = document.getElementById("room").value;
	var sem = document.getElementById("sem").value;
	var dept=deptVal();
   if(room == 'default' && dept!=="default" )
   {
		var xhttp = new XMLHttpRequest(); 
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			alert(this.responseText);
			timeTable();
			}
		};
		xhttp.open("POST", "../../plugins/timetable/timetable.php?deleteTable=1&&year="+year+"&&shift="+shift+"&&dept="+dept+"&&teacher="+teacher+"&&sem="+sem, true);
		xhttp.send();			
   }
}
//-------------------------------
function adjust()
{
	dept = deptVal();
	//alert();
	document.getElementById("myLoader").style.display = "block";
	var shift=document.getElementById("shift").value;
	var year=document.getElementById("year").value;
	var sem=document.getElementById("sem").value;
	if(year !="default" && shift !="default")
	{
		var xhttp = new XMLHttpRequest(); 
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
			timeTable();
			document.getElementById("myLoader").style.display = "none";
			}
		};
		xhttp.open("POST", "../../plugins/timetable/adjust.php?adjust=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&sem="+sem, true);
		xhttp.send();
	}
	else
	{
		timeTable();
		document.getElementById("myLoader").style.display = "none";
	}
}