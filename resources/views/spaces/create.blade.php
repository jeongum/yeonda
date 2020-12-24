@extends('layouts._master')

@section('content')
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<div class = "container">
	<div class="mb-3 mb-md-4 d-flex justify-content-between">
    	<div class="h3 mb-0">공간 추가하기</div>
	</div>
	<div class = "row">
		<div class="col-12">
            <div class="card mb-3 mb-md-4">
				<div class="card-body ">
    				<form class="bg-lighter p-5" action="{{route('spaces.store')}}" method="POST">
    					@csrf 
                        <div class="form-group">
                            <label >공간의 이름은 무엇인가요?</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>공간의 유형은 무엇인가요?</label>
                            <select class="form-control" name="type">
                                <option value = "1">스터디룸</option>
                                <option value = "2">스튜디오</option>
                                <option value = "3">연습실</option>
                                <option value = "4">기타</option>
                            </select>
                        </div>
                        <div class="form-group">
                          	<label for="exampleFormControlTextarea1">주소를 입력해주세요</label>
                          	<div class="row mb-2">
                          		<div class="col-3">
                              		<input type="text" class="form-control" id="postcode" name="postcode" placeholder="우편번호" required>
                              	</div>
                              	<div class="col-3">
                                	<input type="button" class="form-control btn btn-soft-secondary btn-sm" onclick="DaumPostcode()" value="우편번호 찾기" style="width:50%">
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-4">
                                	<input type="text" class="form-control " id="address" name="address" placeholder="주소" required>
                                </div>
                                <div class="col-4">
                                	<input type="text" class=" form-control" id="detailAddress" name="detailAddress" placeholder="상세주소">
                                </div>
                                <div class="col-4">
                                	<input type="text" class=" form-control" id="extraAddress" name="extraAddress" placeholder="참고항목">
                                </div>
                            </div>
						</div>
						<div class="form-group">
                            <label >기본가격은 얼마인가요? (시간당)</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label >공간 소개글을 써주세요!</label>
                            <textarea class="form-control" name="des"></textarea>
                        </div>
                        <div class="form-group text-right mt-5">
                            <button class=" btn btn-soft-primary btn-sm" type="submit">추가하기</button>
                        </div>
    				</form>
				</div>
            </div>
        </div>
	</div>
</div>


<script>
function DaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
        	var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("extraAddress").value = extraAddr;
            
            } else {
                document.getElementById("extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('postcode').value = data.zonecode;
            document.getElementById("address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("detailAddress").focus();
        }
    }).open();
}
</script>
@endsection