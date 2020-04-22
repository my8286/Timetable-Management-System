currentDate();
semester();
var mon;
function currentDate()
{
	var today = new Date();    
	var month = new Array(12);
    month[0] = "Jan";
    month[1] = "Feb";
    month[2] = "Mar";
    month[3] = "Apr";
    month[4] = "May";
    month[5] = "Jun";
    month[6] = "Jul";
	month[7] = "Aug";
	month[8] = "Sep";
	month[9] = "Oct";
	month[10] = "Nov";
	month[11] = "Dec";
	var m = month[today.getMonth()];
	var mon=today.getMonth();
  // document.getElementById("totalTH").innerHTML = mon;
    //dd = today.getDate();
	//dd = dd<10? "0"+dd:dd;
	 var weekday = new Array(7);            // for check weekday
	   weekday[0] = "sun";
	   weekday[1] = "mon";
	   weekday[2] = "tue";
	   weekday[3] = "wed";
	   weekday[4] = "thu";
	   weekday[5] = "fri";
	   weekday[6] = "sat";
     var day = weekday[today.getDay()];

	var hour = today.getHours(); 
}
function semester()
{
	if((mon>=0 && mon<5) || mon>9)
	{
		document.getElementById("sem").selectedIndex = 1;
	}
	else
	{
		document.getElementById("sem").selectedIndex = 2;
	}
}