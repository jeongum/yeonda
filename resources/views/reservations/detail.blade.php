@extends('layouts._master')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.css">

<div class ="container">
    <div class="row">
    	<div class="card mb-3 mb-md-4 w-100" id="schedule-card">
    		<div class="card-header">
            	<div class = "col-sm-12 col-md-6 ">
                	<h4 class="font-weight-semi-bold mb-0">전체 예약 목록</h4>
                </div>
            </div>
    		<div class="card-body h-100">
    			<div class="bg-lighter p-2 text-center row">
    				<button class="btn btn-soft-light px-2 py-1 mx-2" id="go-lastmonth"><i class="gd-angle-left"></i></button>
    				<h5 class="font-weight-semi-bold m-auto" id="month"></h5>
    				<button class="btn btn-soft-light px-2 py-1 mx-2" id="go-nextmonth"><i class="gd-angle-right"></i></button>
    			</div>
    			<table class="table h-100" id="schedule">
    				<thead>
    					<th class="sun">일</th>
    					<th>월</th>
    					<th>화</th>
    					<th>수</th>
    					<th>목</th>
    					<th>금</th>
    					<th>토</th>
    				</thead>
    				<tbody id="calendarBody">
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</div>

<script>
var current_date= 0;

function getCalendar(data){
	var today = new Date();
	
	var y = data.getFullYear();
	var m = data.getMonth();
	var d = data.getDate();

	var t_y = today.getFullYear();
	var t_m = today.getMonth();
	var t_d = today.getDate();

	$('#month').text(y+"년 "+(m+1)+"월");

	var theDate = new Date(y,m,1);

	var theDay = theDate.getDay();

	var last = [31,28,31,30,31,30,31,31,30,31,30,31];

	if(y%4 && y%100!=0 || y%400 === 0){
		lastDate = last[1] = 29;
	}

	var lastDate = last[m];
	var row = Math.ceil((theDay+lastDate)/7);
	var calendar = "";
	var dNum = 1;
	for(var i =1 ; i<=row;i++){
		calendar +="<tr>";
		for(var k=1 ;k<=7;k++){
			if(i===1 && k<=theDay || dNum>lastDate){
				calendar+="<td> &nbsp; </td>";
			} else{
				var tdClass= "";
				if(y == t_y && m==t_m && dNum == t_d)
					tdClass = "today";
				else
					tdClass="";
				if(k==1)
					tdClass+=" sun";

				calendar += "<td class='"+tdClass+"'>"
							+"<strong class='date'>"+dNum+"</strong>"
							+"</td>"
				dNum++
			}
		}
		calendar += "</tr>";
	}
	$('#calendarBody').empty();
	$('#calendarBody').append(calendar);
}

$(document).ready(function(){
	var data = new Date();

	current_date = data;
	getCalendar(data);
	
});

$('#go-lastmonth').click(function(){
	var data = new Date(current_date.setMonth(current_date.getMonth() - 1, 1));
	current_date = data;
	getCalendar(data);
});

$('#go-nextmonth').click(function(){
	var data = new Date(current_date.setMonth(current_date.getMonth() + 1, 1));
	current_date = data;
	getCalendar(data);
});

</script>
@endsection