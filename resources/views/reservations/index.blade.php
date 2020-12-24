@extends('layouts._master')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.css">

<div class ="container">
    <div class="row">
    	<div class="card mb-3 mb-md-4 w-100" id="schedule-card">
    		<div class="card-header row">
            	<div class = "col-sm-6 col-md-6 ">
                	<h4 class="font-weight-semi-bold mb-0">전체 예약 목록</h4>
                </div>
                <div class = "col-sm-6 col-md-6 text-right">
                	<button class="btn btn-sm btn-soft-secondary font-weight-semi-bold mb-0" id="createReservation" data-toggle="modal" data-target ="#createReservationModal">예약 추가</button>
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
var reservations = 0;
var users = 0;
var spaces = 0;
var doorlocks = 0;
var uid=0;

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
				
				calendar += "<td class='"+tdClass+"' id='"+y+"-"+(m+1)+"-"+dNum+"'>"
							+"<strong class='date' >"+dNum+"</strong>"
							+"</td>";
				dNum++;
			}
		}
		calendar += "</tr>";
	}
	$('#calendarBody').empty();
	$('#calendarBody').append(calendar);

	is_reservation()
}
function is_reservation(){
	var current_user;
	var schedule='';
	for(var i =0 ; i < Object.keys(reservations).length ; i++){
		$.each(users,function(index, item){
			if(item['user_id'] == reservations[i]['user']){
				schedule = "<a class='reservation-info' data-toggle='modal'  href ='#detailReservationModal' data-id="+reservations[i]['reservation_id']+"><p class='reservation-info mb-1'><strong class='reservation-info'>"+item['name']+ "</strong>님의<strong  class='reservation-info'> "+spaces[reservations[i]['space_id']]['basic_info']['title'] +"</strong>예약</p></a>";
			}
		});
		$('td#'+reservations[i]['date']).append(schedule);
	}
}
$(document).ready(function(){

	reservations = {!! json_encode($reservations) !!};
	users = {!! json_encode($users) !!};
	spaces = {!! json_encode($spaces) !!};
	doorlocks = {!! json_encode($doorlocks) !!};
	uid = '{!! $uid !!}';
	$('input.datepicker').datepicker({});

	var data = new Date();

	current_date = data;
	getCalendar(data);
		
$('a.reservation-info').click(function(){
	
	var reservation_id = $(this).data().id;
	console.log(reservation_id);
	var current_user = '';
	var current_reservation ='';
	$.each(reservations,function(index, item){
		if(reservation_id == item['reservation_id']){
			$.each(users,function(index, user){
				console.log(reservations);
				if(user['user_id'] == item['user']){
					current_user = user;
				}
			});
			current_reservation = item;
		}
	});
	$('#detailReservationModal span#reservation_user').html(current_user['name']);
	$('#detailReservationModal span#reservation_space').html(spaces[current_reservation['space_id']]['basic_info']['title']);
	$('#detailReservationModal span#reservation_date').html(current_reservation['date']+" "+current_reservation['start_time']+"~"+current_reservation['end_time']);
	$('#detailReservationModal span#reservation_capacity').html(current_reservation['capacity']+"명");
	$('#detailReservationModal span#reservation_price').html(spaces[current_reservation['space_id']]['price'][current_reservation['price_option_id']]['des']+" - "+spaces[current_reservation['space_id']]['price'][current_reservation['price_option_id']]['price']);
	$('#detailReservationModal span#reservation_add').html(current_reservation['additional_comment']);
	if(current_reservation['request_change']!=null){
    	$('#detailReservationModal span#request').html(current_reservation['request_change']['content']);
    	$('#detailReservationModal input#request_des').val(current_reservation['request_change']['content']);
	}
	
	var options = '';
	var doorlocks_in_space = spaces[current_reservation['space_id']]['doorlock'];
	for(var i =0; i< Object.keys(doorlocks_in_space).length ; i++){
		if(doorlocks_in_space[i] != null){
			if(current_reservation['doorlock_id'] == doorlocks_in_space[i]['doorlock_id'])
				options += '<option value ='+doorlocks_in_space[i]['doorlock_id']+" selected>"+doorlocks[doorlocks_in_space[i]['doorlock_id']]['info']['des']+"</option>";
			else
				options += '<option value ='+doorlocks_in_space[i]['doorlock_id']+">"+doorlocks[doorlocks_in_space[i]['doorlock_id']]['info']['des']+"</option>";

		}
	}
	
	$('#select-doorlocks').empty();
	$('#select-doorlocks').append(options);

	if(current_reservation['request_change'] == null){
		$('#check5').removeAttr("checked");
		$('#check6').removeAttr("checked");
	}
	else if(current_reservation['request_change']['status'] == 2){
		$('#check5').attr("checked","checked");
		$('#check6').removeAttr("checked");
	}
	else if(current_reservation['request_change']['status'] == 3){
		$('#check6').attr("checked","checked");
		$('#check5').removeAttr("checked");
	}
	
	var url = '/reservations/'+reservation_id;
	$('#detailReservationForm').attr("action",url);
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



$('button#createReservation').click(function(){
	var create_reserve_user_option ='';
	$.each(users,function(index, item){
		if(item['host'] == false){
			create_reserve_user_option += '<option value="'+item['user_id']+'">'+item['name']+'</option>';
		}
	});
	$('#create-reservation-user').empty();
	$('#create-reservation-user').append(create_reserve_user_option);

	var create_reserve_space_option ='<option selected style="display:none">공간을 선택해주세요</option>';
	$.each(spaces,function(index, item){
		if(item!= null && item['host'] == uid){
			create_reserve_space_option += '<option value="'+item['space_id']+'">'+item['basic_info']['title']+'</option>';
		}
	});
	$('#create-reservation-space').empty();
	$('#create-reservation-space').append(create_reserve_space_option);

});

$( 'select#create-reservation-space' ).change( function(){
    var space_id = $(this).val();

    var create_reserve_doorlock_option ='';
	$.each(doorlocks,function(index, item){
		if(item!= null && item['space_id'] == space_id){
			create_reserve_doorlock_option += '<option value="'+item['doorlock_id']+'">'+item['info']['des']+'</option>';
		}
	});
	$('#create-reservation-doorlock').removeAttr("disabled");
	$('#create-reservation-doorlock').empty();
	$('#create-reservation-doorlock').append(create_reserve_doorlock_option);

	var create_reserve_price_option ='';
	$.each(spaces[space_id]['price'],function(index, item){
		if(item!= null){
			create_reserve_price_option += '<option value="'+item['price_id']+'">'+item['des']+' - '+item['price']+'</option>';
		}
	});
	$('#create-reservation-price').removeAttr("disabled");
	$('#create-reservation-price').empty();
	$('#create-reservation-price').append(create_reserve_price_option);
});


});

</script>


@endsection