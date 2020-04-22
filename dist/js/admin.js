
//==========js for admin.php============
$(document).on('change', '#yearSubject',function(){
  var dept = deptVal();
  var year = $("#yearSubject").val();
  subject(dept,year);
  });
//---------------------------------------------
$(document).on('change', '#teacherDesignation',function(){
  var dept = deptVal2();
  var tea = $("#teacherDesignation").val();
  teacher(dept,tea);
  });	

 //--------------------------------------------
 $(document).on('change', '#shift',function(){
  var dept = deptVal();
  var sub = $("#subject").val();
  var shift= $("#shift").val();
  //alert(sub);
  subType(dept,sub,shift);
  });
 //-------------------------------------------
  $(document).on('change', '#subject',function(){ 
  var str=$("#label").text();
  var sub = $("#subject").val();
  action(str,sub);
  });
 //--------------------------------------------
  function index(id)
  {
	  document.getElementById(id).selectedIndex = 0;
  }
//---------------------------------------------
 function load_data(dept)
 {

	var tea=document.getElementById('teacher');
	var sub=document.getElementById('subject');
	var shift=document.getElementById('shift');
	var typeform=document.getElementById('type');

	//alert();
	tea.selectedIndex = 0;
	sub.selectedIndex = 0;
	shift.selectedIndex = 0;
	typeform.selectedIndex = 0;
	
	subject(dept,'default');
	teacher(dept,'default');
	room(dept,'pr');
	room(dept,'th');
 }
 //------------------------------------------------
 function subject(dept,year)
 {
	 //alert("7777777777777777777");
	var sem=document.getElementById('sem').value;
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("subject").innerHTML = this.responseText;
		//alert(this.responseText);
		}
	};
	xhttp.open("GET", "plugins/timetable/form.php?fetch_subject=1&&dept="+dept+"&&year="+year+"&&sem="+sem, true);
	xhttp.send();
 }
 //------------------------------------------------
 function subjectSC(dept,dept2)
 {
	var sem=document.getElementById('sem').value;
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("subject").innerHTML = this.responseText;
		//alert(this.responseText);
		}
	};
	xhttp.open("GET", "plugins/timetable/form.php?fetch_subjectSC=1&&dept="+dept+"&&dept2="+dept2+"&&sem="+sem, true);
	xhttp.send();
 }
 //-----------------------------------------------
 function teacher(dept,t)
 {
	 var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("teacher").innerHTML = this.responseText;
		//alert(this.responseText);
		}
	};
	xhttp.open("GET", "plugins/timetable/form.php?fetch_teacher=1&&dept="+dept+"&&teacher="+t, true);
	xhttp.send();
 }
 //-----------------------------------------------
 function room(dept,type)
 {
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
		document.getElementById(type+"room").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "plugins/timetable/form.php?insertRoom="+type+"&&dept="+dept, true);
	xhttp.send();
	 
 }
//-----------------------------------------------
function subTypeRoom()
{
	var id = document.getElementById("type"); 
	var th = document.getElementById("throom");
	var pr = document.getElementById("prroom"); 
	//var hide = document.getElementById("hideDiv"); 
	if(id.value == "default" )  
	{  
		pr.disabled = true;
		th.disabled = true;
		//hide.style.display ="none";
	}
	else if(id.value == "th" ) 
	{	
		th.disabled = false;
		pr.disabled = true;
		//hide.style.display ="none";
	}
	else if(id.value == "pr" ) 
	{	
		pr.disabled = false;
		th.disabled = true;
		//hide.style.display ="block";
	}
	else if(id.value == "both" ) 
	{	
		pr.disabled = false;
		th.disabled = false;
		//hide.style.display ="block";
	}
}
//------------------------------------------------------
 function action(str,subject)
 {
	if(deptVal()=='sc')
	{
		dept=document.getElementById("dept").value;
	}
	else
	{
		dept=deptVal();
	}
	//alert(dept);
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
		document.getElementById("shift").innerHTML = this.responseText;
				dept = deptVal();
				var sub = $("#subject").val();
				var shift= $("#shift").val();
				//alert(sub);
				subType(dept,sub,shift);
		}
	};
	xhttp.open("GET", "plugins/timetable/timetable.php?emptyShift=1&&dept="+dept+"&&sub="+subject, true);
	xhttp.send();
 }
 //------------------------------------------------------------------ 
function subType(dept,sub,shift)
{
	//alert(" dept="+dept+" sub="+sub+" shift="+shift);
	document.getElementById("type").selectedIndex = 0;
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//alert(this.responseText);
		document.getElementById("type").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "plugins/timetable/timetable.php?type=1&&dept="+dept+"&&sub="+sub+"&&s="+shift, true);
	xhttp.send();	  
}
//------------------------
function adminLoaderForm()  
{  
	var dept = document.getElementById("dept");  
	var subject = document.getElementById("subject");  
	var teacher = document.getElementById("teacher");  
	var shift = document.getElementById("shift");  
	var type = document.getElementById("type"); 
	if(select(dept,"Department"))  
	{  
		if(select(subject,"Subject"))  
		{  
			if(select(teacher,"Teacher"))  
			{ 
				if(select(shift,"Shift"))  
				{
					if(select(type,"Type"))  
					{ 
						return true;
					}
				} 
			}  
		}   
	}  				
	return false;    
}
//--------------------------------------
function hodLoaderForm()
{
	var subject = document.getElementById("subject");  
	var teacher = document.getElementById("teacher");  
	var shift = document.getElementById("shift");  
	var type = document.getElementById("type");  
	if(select(subject,"Subject"))  
	{  
		if(select(teacher,"Teacher"))  
		{ 
			if(select(shift,"Shift"))  
			{
				if(select(type,"Type"))  
				{ 
					
					if(type.value == "pr" || type.value == "both")
					{
						//alert(type.value);
						if(checkbox())
						{
							return true;
						}
					}
					else
					{
						//alert(type.value);
						return true;
					}
				}
			} 
		}  
	}   				
	return false;    
}
//--------------------------------------
function checkbox()
{
	var chks = document.getElementsByClass("batch");
		var checkCount = 0;
		for (var i = 0; i < chks.length; i++) {
			if (chks[i].checked) {
				checkCount++;
				//alert();
			}
		}
		if (checkCount < 1) {
			alert("Please select batch !")
			return false;
		}
		return false;
}
function insertLoader(subject,teacher,shift,type,all,a,b,c,dept,dept2)
{
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		alert(this.responseText);
		}
	};
	xhttp.open("POST", "plugins/timetable/maker.php?add_sub_teacher=1&&dept="+dept+"&&dept2="+dept2+"&&teacher_id="+teacher_id+"&&subject_id="+subject_id+"&&year="+year+"&&shift="+shift+"&&all="+all+"&&a="+a+"&&b="+b+"&&c="+c, true);
	xhttp.send();
}
//=====================javascript simple.html===============================
var id1,id2,time1,time2,day1,day2;
function allowDrop(ev) {
    ev.preventDefault();
	ev.target.style.backgroundColor = "black";//"rgba(255,51,0,0.5)";
}
function dragLeave(ev)
{
   ev.target.style.backgroundColor = "black";//"rgba(255,255,255,0.7)";
}
//------------------
function drag(ev) {
	id1=ev.target.id;
	day1= id1.substring(0,3);
	time1= id1.substring(3,6);
    document.getElementById(id1).style.backgroundColor = "red";
	document.getElementById(id1).style.color = "white";
	ev.dataTransfer.setData("text", ev.target.id);
}
//--------------------------
function drop(ev,time,day) {
	time2=time;
	day2=day;
	id2=day2+""+time2;
	document.getElementById(id1).style.backgroundColor = "black";
	document.getElementById(id1).style.color = "white";
	document.getElementById(id2).style.backgroundColor = "black";
	document.getElementById(id2).style.color = "white";
	year = document.getElementById("year").value; 
	shift = document.getElementById("shift").value;
	//alert(shift+"   " +year);
	swap(shift,year);
}
//----------------------------
function swap(shift,year)
{
	if(day1!=day2 || time1!=time2)
	{
		//var type=checkType();
		var con = confirm("Do you want remove lecture? "+type);
		if (con == true)
		{
			dept = deptVal();
			teacher = document.getElementById("teacher").value;
			room = document.getElementById("room").value;
			//alert(" dept"+dept+" room="+room+" teacher"+teacher);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					alert(this.responseText);
					timeTable('hod');
				}
			};
			xhttp.open("GET", "../../plugins/timetable/swap.php?swap_button=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&time1="+time1+"&&time2="+time2+"&&day1="+day1+"&&day2="+day2+"&&teacher="+teacher+"&&room="+room, true);
			xhttp.send(); 
		}
	}
}
//--------------------------------------------
function checkType()
{
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
			return this.responseText;
		}
	};
	xhttp.open("GET", "../../plugins/timetable/timetable.php?swapTYpe=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&time="+time1+"&&day="+day1, true);
	xhttp.send();
}
// ---------------------for master table--------------------
var myear,mshift;
function drag2(ev,y,s,day) {
	id1=ev.target.id;
	day1= day;
	myear=y;
	mshift=s;
	time1= id1.substring(7,9);
	//alert("day="+day1+" time="+time1+" my="+myear+" ms="+mshift+" id1="+id1)
    document.getElementById(id1).style.backgroundColor = "red";
	document.getElementById(id1).style.color = "white";
	ev.dataTransfer.setData("text", ev.target.id);
}
//-------------------------------
function drop2(ev,y,s,day,time) {
	
	time2=time;
	day2=day;
	id2=y+""+s+""+day+""+time;
	//alert("my="+myear+" ms="+mshift+" y="+y+" s="+s);
	document.getElementById(id1).style.color = "black";
	document.getElementById(id1).style.backgroundColor = "white";
	document.getElementById(id2).style.color = "black";
	document.getElementById(id2).style.backgroundColor = "white";
	if(myear == y && mshift == s)
	{
		swap2(s,y,'master');
	}
}
//----------------------------
function swap2(shift,year,type)
{
	if(day1!=day2 || time1!=time2)
	{
		var con = confirm("Do you want remove lecture? ");
		if (con == true)
		{
			dept = deptVal();
			teacher = document.getElementById("teacher").value;
			room = document.getElementById("room").value;
			//alert(" dept"+dept+" room="+room+" teacher"+teacher);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					alert(this.responseText);
					if(type=='simple')
						timeTable('hod');
					else
						master('hod');
				}
			};
			xhttp.open("GET", "../../plugins/timetable/swap.php?swap_button=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&time1="+time1+"&&time2="+time2+"&&day1="+day1+"&&day2="+day2+"&&teacher="+teacher+"&&room="+room, true);
			xhttp.send(); 
		}
	}
}
				
/*$( "td" ).hover(
  function() {
    $( this ).css("background-color", "yellow");
  }, function() {
    $( this ).css("background-color", "white");
  }
);*/
function takePrint() 
{
	document.getElementById("hide").style.display ="none";
	// document.getElementById("head").style.visibility = "visible";
	window.print();
	document.getElementById("hide").style.display ="block";
	//document.getElementById("head").style.visibility = "hidden";
	
	
	//var divToPrint=document.getElementById("example1");
   //newWin= window.open();
  // newWin.document.write(divToPrint.outerHTML);
  // newWin.print();
   //newWin.close();
}
$(document).on('keydown', '#editRoom',function(e){
       var old_room=$(this).data("id_room");
	   var id=$(this).data("id_room2");
	    ry=$(this).data("id_room3");
	   rs=$(this).data("id_room4");
	   var new_room=$(this).text();
	   if(e.which == 13)
	   {
			var con = confirm("Do you want change room num? ");
			if (con == true)
			{ 
				roomId(id,new_room,old_room,ry,rs);
				//timeTable();
			}
			else
			{
				//timeTable();
			}
       }
    });	
/*$(document).on('onclick', '#editRoom',function(e){
       var old_room=$(this).data("id_room");
	   var id=$(this).data("id_room2");
	   var new_room=$(this).text();
	   if(new_room=="NEW")
	   {
			newRoomId(id,old_room);
       } 
    });	*/

function roomId(id,new_room,room_id,ry,rs)
{
	dept = deptVal();
	var xhttp;
	xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
	{
        if (this.readyState == 4 && this.status == 200)
		{
            val=this.responseText;
			if(val!=0 && val!=room_id)
			{
				modifyRoom(id,val,room_id,ry,rs,dept)
			}
			else
			{
				alert("Please enter valid Room No.");
			}
        }
    };
    xhttp.open("GET",  "../../plugins/timetable/form.php?roomId=1&&dept="+dept+"&&new_room="+new_room, true);
    xhttp.send(); 
}

//-----------------------------------------------------
function modifyRoom(id,new_room,room_id,ry,rs,dept)
{
	//year = document.getElementById("year").value; 
	sem = document.getElementById("sem").value;
	day = id.substring(0,3);
	time = id.substring(3,6);
	var xhttp;
	xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
	{
        if (this.readyState == 4 && this.status == 200)
		{
             alert(this.responseText);
			 timeTable();
        }
    };
    xhttp.open("GET",  "../../plugins/timetable/form.php?modifyRoom=1&&day="+day+"&&time="+time+"&&year="+ry+"&&shift="+rs+"&&sem="+sem+"&&dept="+dept+"&&room_id="+room_id+"&&new_room="+new_room, true);
    xhttp.send();   
}	
//-------------------------------------------------------
function newRoomId(id,room_id,ry,rs)
{
	dept = document.getElementById("newDept").value;
	new_room = document.getElementById("roomNo").value;
	sem = document.getElementById("sem").value;
	day = id.substring(0,3);
	time = id.substring(3,6);
	//alert(dept+""+new_room+""+day+""+time);
	var xhttp;
	xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
	{
        if (this.readyState == 4 && this.status == 200)
		{
            val=this.responseText;
			alert(val);
			if(val!=0 && val!=room_id)
			{
				modifyNewRoom(day,time,val,room_id,ry,rs,sem);
			}
			else
			{
				alert("Please enter another Room No.");
			}
        }
    };
    xhttp.open("GET",  "../../plugins/timetable/form.php?roomNewId=1&&day="+day+"&&time="+time+"&&shift="+rs+"&&dept="+dept+"&&sem="+sem+"&&new_room="+new_room, true);
    xhttp.send(); 
}
//----------------------------------------------------------
function modifyNewRoom(day,time,new_room,room_id,ry,rs,sem)
{
	//year = document.getElementById("year").value; 
	dept=deptVal();
	//alert(sem+""+id);
	
	var modal = document.getElementById('myModal');
	var xhttp;
	xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
	{
        if (this.readyState == 4 && this.status == 200)
		{
             alert(this.responseText);
			 modal.style.display = "none";
			 timeTable();
        }
    };
    xhttp.open("GET",  "../../plugins/timetable/form.php?modifyNewRoom=1&&day="+day+"&&time="+time+"&&year="+ry+"&&shift="+rs+"&&sem="+sem+"&&dept="+dept+"&&room_id="+room_id+"&&new_room="+new_room, true);
    xhttp.send();   
}

 //============================java script of forms validation==================================
 
 function formValidation()  
{  
	var fn = document.getElementById("fn");  
	var mn = document.getElementById("mn");  
	var ln = document.getElementById("ln");  
	var tc = document.getElementById("tc");  
	var des = document.getElementById("des");  
	var dept = document.getElementById("tDept");  
	var num = document.getElementById("phone");  
	var email = document.getElementById("email");  
	var male = document.getElementById("male");  
	var female = document.getElementById("female"); 
	var g=document.teacher.gender;
	gen=g.value;
	alert(dept);
	if(input(fn," First name "))  
	{  
		if(input(mn," Middle name "))  
		{  
			if(input(ln," last name "))  
			{  
				if(gender(male,female))  
				{   
					if(inputBoth(tc,"teacher code"))  
					{  
						if(select(dept,"Department"))  
						{ 
							if(phone(num))  
							{  
								if(ValidateEmail(email))  
								{ 
									if(select(des,"Designation"))  
									{ 
										f=fn.value;m=mn.value;l=ln.value;t=tc.value;
										d=dept.value;e=email.value;p=num.value;de=des.value;
										insertTeacher(f,m,l,t,d,de,gen,e,p);
										
									} 
								}  
							}   
						}
					}   
				}  
			}  
		}  
	}  
	return false;    
}
//-----------------------------
function subjectValidation()
{
	var dept =document.getElementById("sDept"); 
	//alert(dept);
	var year = document.getElementById("year");
	var sem = document.getElementById("sem"); 
	var sn = document.getElementById("sn");
	var sc = document.getElementById("sc");
	var st = document.getElementById("st"); 
	var th = document.getElementById("th");
	var pr = document.getElementById("pr"); 
	if(input(sn," subject name "))  
	{
		if(inputBoth(sc," subject code "))  
		{
			if(select(st," subject type "))  
			{
				if(subTimeTh(th,st," theory time "))  
				{
					if(subTimePr(pr,st," practical time "))  
					{	
						if(select(year," subject yer "))  
						{
							if(select(sem," semester "))  
							{
								if(select(dept," subject dept "))  
								{
									insertSubject(sn.value,sc.value,st.value,th.value,pr.value,year.value,dept.value,sem.value);
								}
							}
						}
					}
				}
			}
		}
	}	
	return false;
}
//------------------------
function roomValidation()
{
	var dept = document.getElementById("rDept"); 
	var room = document.getElementById("room_no");
	var type = document.getElementById("rtype"); 
	if(inputBoth(room," room "))  
	{
		if(select(type," room type "))  
		{
			if(select(dept," room dept "))  
			{
				insertRoom(room.value,dept.value,type.value);
			}
		}
	}
	return false;
}
 //----------------------
function input(id,val)  
{  
	var id_len = id.value.length;
	//alert(fn_len);
	var letters = /^[A-Za-z]+$/; 	
	if(id.value.match(letters))
	{
		id.style.backgroundColor = "white";
		return true;
	}
	else if(id_len == 0)
	{
		//alert("Plese enter "+val);
		id.style.backgroundColor = "  #ffffcc";
		id.focus();
		return false;
	}
	else if(id_len != 0)
	{	
		id.style.backgroundColor = "  #ffffcc";
		id.focus();
		//alert("Enter only alphabets in "+val);
		return false;
	}
} 
//--------------------------
function inputBoth(id,val)  
{  
	var id_len = id.value.length; 	
	if (id_len == 0 )  
	{  
		//alert(val+" should not be empty");
		id.style.backgroundColor = "  #ffffcc";
		id.focus();  
		return false;  
	}  
	id.style.backgroundColor = "white";
	return true;  
}
//----------------------   
function select(id,val)  
{  
	if (id.value == "default" )  
	{  
		alert("Select "+val+" from the list"); 
		id.style.backgroundColor = "#ffffcc";
		id.focus();  
		return false;  
	}
	id.style.backgroundColor = "white";
	return true;  
} 
//----------------------    
function phone(num)  
{ 
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
  var phone_len = num.value.length;
  if(num.value.match(phoneno) && phone_len==10)  
  {  
	 num.style.backgroundColor = "white";
     return true;  
  }
  else if(phone_len == 0)
  {
	//alert("Please phone no");
	num.style.backgroundColor = "#ffffcc";
	num.focus();
    return false;
  }
  else if(phone_len != 0)  
  {  
    //alert("Please enter correct phone no"); 
    num.style.backgroundColor = "  #ffffcc";	
	num.focus();
    return false;  
  }  
}
//-----------------------------      
function ValidateEmail(email)  
{  
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	var email_len = email.value.length;
	if(email.value.match(mailformat))  
	{ 
		email.style.backgroundColor = "white"; 
		return true;  
	}
	else  
	{  
		//alert("You have entered an invalid email address!"); 
		email.style.backgroundColor = "#ffffcc";
		email.focus();  
		return false;  
	}  
}
//-------------------------------- 
function gender(male,female)  
{  
	var x=0;    
	if(male.checked)   
	{  
		x++;  
	}
	if(female.checked)  
	{  
		x++;   
	}  
	if(x==0)  
	{  
		//alert('Select gender Male/Female');  
		male.focus();  
		return false;  
	}  
	else  
	{  
		//alert('Form Succesfully Submitted');  
		//window.location.reload()  
		return true;  
	}  
} 
//document.getElementById("des1").style.display = "none";
//-----------------------------------------
function subTime()
{
	var id = document.getElementById("st"); 
	var th = document.getElementById("th");
	var pr = document.getElementById("pr"); 
	if (id.value == "default" )  
	{  
		pr.selectedIndex = 0;
		th.selectedIndex = 0;
		pr.disabled = true;
		th.disabled = true;
	}
	else if (id.value == "th" ) 
	{	
		th.disabled = false;
		pr.selectedIndex = 0;
		pr.disabled = true;
	}
	else if (id.value == "pr" ) 
	{	
		pr.disabled = false;
		th.selectedIndex = 0;
		th.disabled = true;
	}
	else if (id.value == "both" ) 
	{	
		pr.disabled = false;
		th.disabled = false;
	}
}
//---------------------------
function subTimeTh(id,st,val)
{
	if (id.value == 0 && (st.value == "th" || st.value == "both"))  
	{  
		//alert("Select "+val+" from the list"); 
		id.style.backgroundColor = "#ffffcc";
		id.focus();  
		return false;  
	}
	id.style.backgroundColor = "white";
	return true;  
}
//---------------------------
function subTimePr(id,st,val)
{
	if (id.value == 0 && (st.value == "pr" || st.value == "both"))  
	{  
		//alert("Select "+val+" from the list"); 
		id.style.backgroundColor = "#ffffcc";
		id.focus();  
		return false;  
	}
	id.style.backgroundColor = "white";
	return true;  
}
//---------------------------------------------------------
function insertTeacher(fn,mn,ln,tc,dept,des,gen,email,phone)
{
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		alert("New Teacher insertion completed !");
		window.location.reload()  
		//showModal("Teacher",dept);
	}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?add_teacher=1&&fn="+fn+"&&mn="+mn+"&&ln="+ln+"&&tc="+tc+"&&gender="+gen+"&&des="+des+"&&phone="+phone+"&&email="+email+"&&dept="+dept, true);
	xhttp.send();

}
//-------------------------------------------------
function insertSubject(sn,sc,st,th,pr,year,dept,sem)
{
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		alert("New subject insertion completed !");
		//document.subject.reset();
		window.location.reload()  
		//showModal("Subject",dept);
		}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?add_subject=1&&sn="+sn+"&&sc="+sc+"&&st="+st+"&&sy="+year+"&&dept="+dept+"&&th="+th+"&&pr="+pr+"&&sem="+sem, true);
	xhttp.send();
}
//--------------------------------------------------------
function insertRoom(room,dept,type)
{
	var xhttp = new XMLHttpRequest(); 
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		alert("New Room insertion completed !");
		//document.room.reset();
		//showModal("Room",dept);
		window.location.reload()  
	}
	};
	xhttp.open("GET", "../../plugins/timetable/form.php?add_room=1&&room_no="+room+"&&dept="+dept+"&&type="+type, true);
	xhttp.send();
}
//------------------------------------------------------------

	