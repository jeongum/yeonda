@if(Route::current()->getName() == 'doorlocks.index')
<div id="createDoorlockModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded py-5" role="document">
        <div class="modal-content ">
            <form action = "{{route('doorlocks.store')}}" method = "POST">
            @csrf
                <header class="modal-header flex-column  border-bottom mb-1 mb-xl-3">
					<h4 id="exampleModalLabel" class="modal-title mx-auto">도어락 추가</h4>
                </header>
                <div class="modal-body pt-3 mb-5 mb-md-7 text-left">
					<div class = "form-group">
    					<label >도어락 이름</label>
          				<input type="text" class="form-control" name = "info_des" required>
      				</div>
      				<div class = "form-group">
          				<label >시리얼넘버</label>
          				<input type="text" class="form-control" name = "serial_num">
      				</div>
      				<div class = "form-group">
          				<label >생산날짜</label>
          				<input type="date" class="form-control" name = "manufacturing_date">
      				</div>
      				<div class = "form-group">
          				<label >위치</label>
          				<select class="form-control" name="space">
                            @foreach($spaces as $space)
                            	@if($space!= null && $space['host'] == $uid)
                            		<option value = "{{$space['space_id']}}">{{$space['basic_info']['title']}}</option>
                            	@endif
                            @endforeach
    					</select>
					</div>
                </div>
                <footer class="modal-footer justify-content-between border-top">
					<button type="button" class="btn btn-info" data-dismiss="modal">닫기</button>
					<button type="submit" class="btn btn-primary">추가</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<div id="openLockerModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded py-5 justify-content-center" role="document">
        <div class="modal-content ">
            <form action = "" method = "POST" id="openLockerForm">
            @csrf @method("PUT")
            	<input type="hidden" name = "opening" id ="opening" value = "1">
                <div class="modal-body pt-3 mb-1 mb-md-3 text-center">
					해당 도어락의 상태를  <span class="badge badge-success">열림</span> 으로 변경하시겠습니까?
                </div>
                <footer class="modal-footer justify-content-center">
					<button type="button" class="btn btn-info" data-dismiss="modal">취소</button>
					<button type="submit" class="btn btn-primary">확인</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<div id="closeLockerModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded py-5 justify-content-center" role="document">
        <div class="modal-content ">
            <form action = "" method = "POST" id = "closeLockerForm">
            @csrf @method("PUT")
            	<input type="hidden" name = "opening" id ="opening" value = "0">
                <div class="modal-body pt-3 mb-1 mb-md-3 text-center">
					해당 도어락의 상태를  <span class="badge badge-danger">닫힘</span> 으로 변경하시겠습니까?
                </div>
                <footer class="modal-footer justify-content-center">
					<button type="button" class="btn btn-info" data-dismiss="modal">취소</button>
					<button type="submit" class="btn btn-primary">확인</button>
                </footer>
            </form>
        </div>
    </div>
</div>
@elseif(Route::current()->getName() == 'reservations.index')
<div id="detailReservationModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded py-5" role="document">
        <div class="modal-content ">
            <header class="modal-header flex-column  border-bottom mb-1 mb-xl-3">
				<h4 class="modal-title mr-auto font-weight-semi-bold">예약 상세</h4>
            </header>
            <form action="" method="POST" id="detailReservationForm">
			@csrf @method("PUT")
                <div class="modal-body pt-3 mb-3 mb-md-5 text-left">
    				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약자 성명</label>
          				<span class="col-8 bg-lighter mb-0 py-1" id="reservation_user"></span>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 공간</label>
      					<span class="col-8 bg-lighter mb-0 py-1" id="reservation_space"></span>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 날짜 및 시간</label>
      					<span class="col-8 bg-lighter mb-0 py-1" id="reservation_date"></span>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">인원</label>
      					<span class="col-8 bg-lighter mb-0 py-1" id="reservation_capacity"></span>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">선택가격</label>
      					<span class="col-8 bg-lighter mb-0 py-1" id="reservation_price"></span>
      				</div>
      				<div class="row mb-3">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">추가 사항</label>
      					<span class="col-8 bg-lighter mb-0 py-1" id="reservation_add"></span>
      				</div>
                    <div class="row mb-1">
                        <label class="col-4 font-weight-semi-bold mb-0 py-1">요청사항 <span style="color:red">*</span></label>
                        <span class="col-8 mb-0 py-1 bg-lighter w-100" id="request"></span>
                    </div>
                    <div class="row mb-3">
                    	<div class="col-4">
                    		<input type="hidden" name="request_des" id="request_des">
                    	</div>
                        <div class="col-4 position-relative pl-0 mb-2 ">
                            <input type="radio" name="request_status" class="form-check-input invisible" id="check5" value="2">
                            <label class="checkbox-text position-relative btn btn-outline-primary form-check-label" for="check5">요청사항 수락</label>
                        </div>
                        <div class="col-4 position-relative pl-0 mb-2 ">
                            <input type="radio" name="request_status" class="form-check-input invisible" id="check6" value="3">
                            <label class="checkbox-text position-relative btn btn-outline-primary form-check-label" for="check6">요청사항 거절</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4 font-weight-semi-bold mb-0 py-1">도어락 할당 <span style="color:red">*</span></label>
                        <select class="col-8" id="select-doorlocks" name="select_doorlock">
                    	</select>
                    </div>
                </div>
                <p class="small"><span style="color:red">*</span>는 수정가능합니다</p>
                <footer class="modal-footer justify-content-between border-top">
    				<button type="button" class="btn btn-info" data-dismiss="modal">닫기</button>
    				<button type="submit" class="btn btn-info">변경사항 저장</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<div id="createReservationModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded py-5" role="document">
        <div class="modal-content ">
            <header class="modal-header flex-column  border-bottom mb-1 mb-xl-3">
				<h4 class="modal-title mr-auto font-weight-semi-bold">예약 추가하기</h4>
            </header>
            <form action="{{route('reservations.store')}}" method="POST" id="createReservationForm">
			@csrf
                <div class="modal-body pt-3 mb-3 mb-md-5 text-left">
    				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약자</label>
          				<select class="col-8" id="create-reservation-user" name="create_reservation_user">
                    	</select>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 공간</label>
        				<select class="col-8" id="create-reservation-space" name="create_reservation_space">
                    	</select>
      				</div>
      				<div class="row mb-2">
                        <label class="col-4 font-weight-semi-bold mb-0 py-1">도어락 할당</label>
                        <select class="col-8" id="create-reservation-doorlock" name="create_reservation_doorlock" disabled="disabled">
                    	</select>
                    </div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 날짜<span style="font-size: 0.5rem">(하루단위)</span></label>
        				<input class="col-8" type="date" id="create-reservation-date" name="create_reservation_date">
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 시작 시간</label>
        				<input class="col-8" type="time" id="create-reservation-start-time" name="create_reservation_start_time">
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">예약 종료 시간</label>
        				<input class="col-8" type="time" id="create-reservation-end-time" name="create_reservation_end_time">
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">인원</label>
      					<input class="col-8" type="number" id="create-reservation-capacity" name="create_reservation_capacity" min=1>
      				</div>
      				<div class="row mb-2">
        				<label class="col-4 font-weight-semi-bold mb-0 py-1">선택가격</label>
      					<select class="col-8" id="create-reservation-price" name="create_reservation_price" disabled="disabled">
                    	</select>
      				</div>
                </div>
                <footer class="modal-footer justify-content-between border-top">
    				<button type="button" class="btn btn-info" data-dismiss="modal">닫기</button>
    				<button type="submit" class="btn btn-info">예약추가</button>
                </footer>
            </form>
        </div>
    </div>
</div>
@endif