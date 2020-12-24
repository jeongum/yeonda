@extends('layouts._master')

@section('content')

<div class = "container">
	<div class="mb-3 mb-md-4 d-flex justify-content-between">
    	<div class="h3 mb-0">{{$space['basic_info']['title']}}
    	@if($space['basic_info']['type'] == 1)
        	<span class="badge badge-pill badge-secondary">스터디룸</span>
        @elseif($space['basic_info']['type'] == 2)
        	<span class="badge badge-pill badge-success">스튜디오</span>
        @elseif($space['basic_info']['type'] == 3)
        	<span class="badge badge-pill badge-info">연습실</span>
        @endif
        </div>
	</div>
	<div class = "row">
		<div class="col-md-12 col-xl-6 mb-3 mb-md-4">
            <!-- Card -->
            <div class="card h-100">
                <div class="card-header d-flex">
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">주소</h5>
                </div>
                <div class="card-body p-0">
                    <div class="media align-items-center px-3 px-md-4 mb-3 mb-md-4">
                        <div class="media-body">
                            <h4 class="h4 lh-1 mb-2">{{$space['basic_info']['address']['add1']}} @isset($space['basic_info']['address']['add2']) {{$space['basic_info']['address']['add2']}} @endisset</h4>
                            <p class="small text-muted mb-0">
                               <span class="text-success mx-1">{{$space['basic_info']['address']['zipcode']}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <div class="col-md-12 col-xl-6 mb-3 mb-md-4">
            <!-- Card -->
            <div class="card h-100">
                <div class="card-header d-flex">
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">소개글</h5>
                </div>
                <div class="card-body p-0">
                    <div class="media align-items-center px-3 px-md-4 mb-3 mb-md-4">
                        <div class="media-body">
                            <h4 class="h4 lh-1 mb-2">{{$space['intro']['description']}} </h4>
                            <p class="small text-muted mb-0">
                                &nbsp;</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
 	<div class="row">
 		<div class="col-6">
            <div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">가격 옵션</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0 text-center">
                            <thead>
                                <tr>
                                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">설명</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">가격</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php $i = 1 @endphp
                                @foreach($space['price'] as $price_option)
                                @isset($price_option)
                                <tr>
                                    <td class="py-3">{{$i++}}</td>
                                    <td class="py-3">{{$price_option['des']}}</td>
                                    <td class="py-3">
                                	{{$price_option['price']}} 원
                                	</td>
                                </tr>
                                @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @isset($space['doorlock'])
        <div class="col-6">
            <div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">도어락 목록</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0 text-center">
                            <thead>
                                <tr>
                                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">정보</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">상태</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php $i = 1 @endphp
                                @foreach($doorlocks as $doorlock)
                                <tr>
                                    <td class="py-3">{{$i++}}</td>
                                    <td class="py-3">{{$doorlock['info']['des']}}</td>
                                    <td class="py-3">
                                	@if($doorlock['opening']==false)
                                		<span class=" badge badge-danger">닫힘</span>
                                	@else
                                		<span class=" badge badge-success">열림</span>
                                	@endif
                                	</td>
                                    <td class="py-3">
                                    	<a type="button" class="btn btn-outline-primary ml-auto btn-sm" href = "{{route('doorlocks.show',$doorlock['doorlock_id'])}}">자세히보기</a>
                                	</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endisset
	</div>
	<div class="row">
		@isset($space['qna'])
 		<div class="col-6">
            <div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">QnA</h5>
                </div>
                <div class="card-body pt-0" id="accordion">
                	@php $i = 0 @endphp
                    @foreach($space['qna'] as $qna)
                    @isset($qna)
                	<div class="p-2 border-bottom border-top bg-body" id="heading{{$i}}">
                        <div class="mb-0 row">
                        	<div class="col-1">{{++$i}}</div>
                        	<div class="col-6">{{$qna['question']}}</div>
                        	<div class="col-4">{{$users[$qna['user_id']]['name']}}</div>
                        	<div class="col-1 pl-0">
                        		<button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                        			<i class="gd-angle-down icon-text d-inline-block text-dark"></i>
                    			</button>
                			</div>
                        </div>
                    </div>
                    <div id="collapse{{$i}}" class="collapse" aria-labelledby="heading{{$i}}" data-parent="#accordion">
                        <div class="p-2 row">
                        	<div class="col-1">&nbsp</div>
                        	<div class="col-11">@isset($qna['answer']) {{$qna['answer']}} @else 답변없음 @endisset</div>
                        </div>
                    </div>
					@endisset
                    @endforeach
                </div>
            </div>
        </div>
        @endisset
        @isset($space['review'])
        <div class="col-6">
            <div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">리뷰</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0 text-center">
                            <thead>
                                <tr>
                                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">내용</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">별점</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php $i = 1 @endphp
                                @foreach($space['review'] as $review)
                                @isset($review['score'])
                                <tr>
                                    <td class="py-3">{{$i++}}</td>
                                    <td class="py-3">{{$review['des']}}</td>
                                    <td class="py-3 px-0">
                                    	@for($j=1 ; $j< 6 ; $j++)
                                    		@if($j <= $review['score'])
                                   				<i class="gd-heart icon-text d-inline-block text-dark"></i>
                                			@else
                                				<i class="gd-heart-broken icon-text d-inline-block text-dark"></i>
                                			@endif
                                		@endfor
                                	</td>
                                </tr>
                                @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endisset
	</div>
</div>

@endsection