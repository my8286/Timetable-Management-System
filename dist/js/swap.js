var id1,id2,time1,time2,day1,day2;
function allowDrop(ev) {
    ev.preventDefault();
	ev.target.style.backgroundColor = "black";//"rgba(255,51,0,0.5)";
}
function dragLeave(ev)
{
   ev.target.style.backgroundColor = "black";// "rgba(255,255,255,0.7)";
  // alert();
}

function drag(ev) {
	id1=ev.target.id;
	day1= id1.substring(0,3);
	time1= id1.substring(3,6);
    document.getElementById(id1).style.backgroundColor = "red";
	document.getElementById(id1).style.color = "white";
	ev.dataTransfer.setData("text", ev.target.id);
}

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
	swap(shift,year,'simple');
}
function swap(shift,year,type)
{
	if(day1!=day2 || time1!=time2)
	{
		var con = confirm("Do you want remove lecture? ");
		if (con == true)
		{
			dept = deptVal();
			teacher = document.getElementById("teacher").value;
			room = document.getElementById("room").value;
			sem = document.getElementById("sem").value;
			//alert(" dept"+dept+" room="+room+" teacher"+teacher);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					//alert(this.responseText);
					if(type=='simple')
						timeTable();
					else
						master();
				}
			};
			xhttp.open("GET", "../../plugins/timetable/swap.php?swap_button=1&&dept="+dept+"&&year="+year+"&&shift="+shift+"&&time1="+time1+"&&time2="+time2+"&&day1="+day1+"&&day2="+day2+"&&teacher="+teacher+"&&room="+room+"&&sem="+sem, true);
			xhttp.send(); 
		}
	}
}