@extends('layouts._master')

@section('content')

<div class = "container">
	<div class="mb-3 mb-md-4 d-flex justify-content-between">
    	<div class="h3 mb-0">{{$doorlock['info']['des']}} 도어락</div>
	</div>
	<div class = "row">
		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <!-- Widget -->
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-primary rounded-circle mr-3">
                    <i class="gd-panel icon-text d-inline-block text-primary"></i>
                </div>
                <div>
                	@if($doorlock['opening'])
                    <div class="h4 mb-1"><span class=" badge badge-success">열림</span></div>
                    @else
                    <div class="h4 mb-1"><span class=" badge badge-danger">닫힘</span></div>
                    @endif
                    <h6 class="mb-0">현재상태</h6>
                </div>
            </div>
            <!-- End Widget -->
        </div>
    	<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <!-- Widget -->
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-primary rounded-circle mr-3">
                    <i class="gd-panel icon-text d-inline-block text-primary"></i>
                </div>
                <div>
                    <h5 class="lh-1 mb-1">{{$spaces['basic_info']['title']}}</h5>
                    <h6 class="mb-0">위치</h6>
                </div>
            </div>
            <!-- End Widget -->
        </div>
        <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
            <!-- Widget -->
            <div class="card flex-row align-items-center p-3 p-md-4">
                <div class="icon icon-lg bg-soft-primary rounded-circle mr-3">
                    <i class="gd-calendar icon-text d-inline-block text-primary"></i>
                </div>
                <div>
                    <h5 class="lh-1 mb-1">{{ isset($doorlock['info']['manufacturing_date']) ? $doorlock['info']['manufacturing_date'] : '0000.00.00' }}</h5>
                    <h6 class="mb-0">제조일자</h6>
                </div>
            </div>
            <!-- End Widget -->
        </div>
	</div>
	<div class = "row">
		<div class = "col-6">
    		<div class="card h-100">
                <div class="card-header">
                    <h5 class="h6 text-uppercase font-weight-semi-bold mb-0">현재 키 홀더 목록</h5>
                </div>
                <div class="card-body p-0">
                @isset($doorlock['current_key_holder'])
                	@foreach($doorlock['current_key_holder'] as $ckh)
                    	@if($ckh['type']==1)
                    		@isset($ckh['user_id'])
                            <div class="border-top p-3 px-md-4 mx-0">
                                <div class="row justify-content-between small mb-2">
                                    <div class="col">
                                        <span class="text-primary mr-3">
                  						@foreach($users as $user)
                  						@if($user['user_id'] == $ckh['user_id'])
                  							이름: {{ $user['name'] }}
                  						                      
                  						@endif
                  						@endforeach
                                        </span>
                                        <span class="mr-1 badge badge-pill badge-info">호스트</span>
                                    </div>
            
                                    <div class="col-auto text-muted">
                                         {{$ckh['start_date']}} - {{$ckh['end_date']}}
                                    </div>
                                </div>
                            </div>
                            @endisset
                        @else
                        <div class="border-top border-bottom p-3 px-md-4 mx-0">
                            <div class="row justify-content-between small mb-2">
                                <div class="col">
                                    <span class="text-primary mr-3">
									@foreach($users as $user)
                  						@if($user['user_id'] == $ckh['user_id'])
                  							이름: {{ $user['name'] }}
                  						                      
                  						@endif
                  						@endforeach
									</span>
                                    <span class="mr-1 badge badge-pill badge-success">사용자</span>
                                </div>
        
                                <div class="col-auto text-muted">
                                    {{$ckh['start_date']}} - {{$ckh['end_date']}}
                                </div>
                            </div>
                       		<span class="small">예약번호 : {{ $ckh['reservation_id'] }}</span>
                        </div>
                        @endif
                    @endforeach
                @endisset
                </div>
            </div>
		</div>
		<div class = "col-6">
			<div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="h6 text-uppercase font-weight-semi-bold mb-0">도어락 출입 기록</h5>
                </div>
                <div class="card-body pt-0 border-top">
                    <div class="table-responsive-xl ">
                        <table class="table text-nowrap mb-0 small text-center">
                            <thead>
                                <tr>
                                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">사용자</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">타입</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">툴</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">예약번호</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">날짜</th>
                                </tr>
                            </thead>
                            <tbody>
                            @isset($doorlock['records'])
                                @php $i = 0 @endphp
                                @foreach($doorlock['records'] as $record)
                                	@isset($record)
                                    <tr>
                                        <td class="py-3">{{ $i ++ }}</td>
                                        <td class="py-3">
                                        @foreach($users as $user)
                  						@if($user['user_id'] == $record['user'])
                  							{{ $user['name'] }}
                  						                    
                  						@endif
                  						@endforeach
                  						</td>
                                        <td class="py-3">
                                        @if( $record['type'] == 1)
                                        	<span class="mr-1 badge badge-pill badge-info">호스트</span>
                                        @else
                                        	<span class="mr-1 badge badge-pill badge-success">사용자</span>
                                        @endif
                                        </td>
                                        <td class="py-3">
                                        @if($record['tool'] == 1 )
                                        	호스트 NFC
                                        @elseif ($record['tool'] == 2)
                                        	호스트 원격
                                        @elseif ($record['tool'] == 3)
                                        	게스트 NFC
                                        @elseif ($record['tool'] == 4)
                                        	게스트 원격
                                        @endif
                                        </td>
                                        <td class="py-3">
                                            @if( $record['type'] == 1)
                                        		&nbsp;
                                            @else
                                            	{{ $record['reservation_id'] }}
                                            @endif
                                        </td>
                                        <td class="py-3">{{$record['date']}}</td>
                                    </tr>
                                    @endisset
                               	@endforeach
                           	@endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="mb-3 mb-md-4 d-flex justify-content-end">
    	<div class="h3 mb-0"><a href = "{{route('doorlocks.index')}}"><button type = "button" class = "btn btn-sm btn-primary text-right mt-3 mt-md-4">목록</button></a></div>
	</div>
</div>
@endsection