@extends('layouts._master')

@section('content')

<div class ="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 mb-md-4">
                <div class="row card-header">
                	<div class = "col-sm-12 col-md-6 ">
                    	<h5 class="font-weight-semi-bold mb-0">전체 도어락 목록</h5>
                    </div>
                    <div class = "col-sm-12 col-md-6 text-right">
                    	<button type = "button" data-toggle="modal" data-target="#createDoorlockModal" class = "btn btn-sm btn-primary rounded-pill text-right">생성</button>
                	</div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0 text-center">
                            <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">이름</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">현재 키 홀더 수</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">위치</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">상태</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">&nbsp</th>
                            </tr>
                            </thead>
                            <tbody>
                            	@php $i = 0; @endphp
                        		@foreach($doorlocks as $doorlock)
                        		<tr>
                        			<td class="py-3">{{ ++$i }} </td>
                        			<td class="py-3">{{ $doorlock['info']['des'] }}</td>
                        			<td class="py-3">{{ isset($doorlock['current_key_holder']) ? count($doorlock['current_key_holder']) : 0 }} 명</td>
                        			<td class="py-3">{{ $spaces[$doorlock['space_id']]['basic_info']['title']}}</td>
                        			<td class="py-3">
                        				@if($doorlock['opening'])
    										<button data-toggle="modal" data-target="#openLockerModal" class="btn btn-sm btn-soft-light open-btn" data-id = "{{ $doorlock['doorlock_id'] }}">
    										열림         
    										</button>
                                        	<button data-toggle="modal" data-target="#closeLockerModal" class="btn btn-sm btn-danger close-btn" data-id = "{{ $doorlock['doorlock_id'] }}">
    										닫힘                                  	
                                        	</button>
                                    	@else
                                    		<button data-toggle="modal" data-target="#openLockerModal" class="btn btn-sm btn-success open-btn" data-id = "{{ $doorlock['doorlock_id'] }}">
    										열림                                  	
    										</button>
                                        	<button data-toggle="modal" data-target="#closeLockerModal" class="btn btn-sm btn-soft-light close-btn" data-id = "{{ $doorlock['doorlock_id'] }}">
    										닫힘
    										</button>
                                    	@endif
                                    </td>
                        			<td class="py-3">
                                        <div class="position-relative">
                                            <a id="dropDown14Invoker" class="link-dark d-flex" href="#" aria-controls="dropDown14" aria-haspopup="true" aria-expanded="false" data-unfold-target="{{'#dropDown_'.$i}}" data-unfold-event="click" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                                                <i class="gd-more-alt icon-text"></i>
                                            </a>
        
                                            <ul id="{{'dropDown_'.$i}}" class="unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="dropDown14Invoker" style="min-width: 150px; animation-duration: 300ms; right: 0px;">
                                                <li class="unfold-item">
                                                    <a class="unfold-link media align-items-center text-nowrap" href = "{{route('doorlocks.show',$doorlock['doorlock_id'])}}" >
                                                        <i class="gd-pencil unfold-item-icon mr-3"></i>
                                                        <span class="media-body">자세히보기</span>
                                                    </a>
                                                </li>
                                                <li class="unfold-item">
                                                    <a class="unfold-link media align-items-center text-nowrap" href="#">
                                                        <i class="gd-close unfold-item-icon mr-3"></i>
                                                        <span class="media-body">삭제</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                        		</tr>
                        		@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>

$('button.open-btn').click(function(){
	var doorlock_id = $(this).data().id;

	var url = "doorlocks/"+doorlock_id;

	$('#openLockerForm').attr('action',url);
});

$('button.close-btn').click(function(){
	var doorlock_id = $(this).data().id;

	var url = "doorlocks/"+doorlock_id;

	$('#closeLockerForm').attr('action',url);
});
</script>

@endsection