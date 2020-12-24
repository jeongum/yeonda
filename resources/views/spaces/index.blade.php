@extends('layouts._master')

@section('content')

<div class ="container">
    <div class="row">
    	@foreach($spaces as $space)
        <div class="col-md-6 col-xl-4 mb-3 mb-md-4">
        <!-- Card -->
            <div class="card h-100">
                <div class="card-header d-flex">
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">{{ $space['basic_info']['title'] }}&nbsp;</h5>
                    @if($space['basic_info']['type'] == 1)
                    	<span class="badge badge-pill badge-secondary">스터디룸</span>
                    @elseif($space['basic_info']['type'] == 2)
                    	<span class="badge badge-pill badge-success">스튜디오</span>
                    @elseif($space['basic_info']['type'] == 3)
                    	<span class="badge badge-pill badge-info">연습실</span>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class=" text-center p-3 p-md-4 pb-md-6">
                    	<img src ="https://cdn.crowdpic.net/list-thumb/thumb_l_689777FC171AF41EDFB03239C8D6661A.jpg" style = "width: 100%">
                    </div>
                    <div class="border-bottom media align-items-center p-3">
                        <div class="media-body d-flex align-items-center mr-2">
                            <span class="ml-auto">{{ $space['basic_info']['address']['add1'] }} &nbsp; @isset($space['basic_info']['address']['add2']) {{ $space['basic_info']['address']['add2'] }} @endisset</span>
                        </div>
                    </div>
                    <div class="media align-items-center p-3">
                        <div class="media-body d-flex align-items-center mr-2">
                            <a  type="button" class="btn btn-outline-primary ml-auto btn-sm" href = "{{route('spaces.show',$space['space_id'])}}">자세히보기</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        @endforeach
    </div>
</div>

@endsection