<!-- Sidebar Nav -->
<aside id="sidebar" class="js-custom-scroll side-nav">
	<ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
		<!-- Title -->
		<li class="sidebar-heading h6">전체 현황</li>
		<!-- End Title -->

		<!-- Dashboard -->
		<li class="side-nav-menu-item">
			<a class="side-nav-menu-link media align-items-center" href="{{ route('dashboard') }}">
				<span class="side-nav-menu-icon d-flex mr-3"> <i class="gd-dashboard"></i></span> 
				<span class="side-nav-fadeout-on-closed media-body">전체 현황</span>
			</a>
		</li>
		<!-- End Dashboard -->

		<!-- Title -->
		<li class="sidebar-heading h6">나의 공간</li>
		<!-- End Title -->

		<li class="side-nav-menu-item side-nav-has-menu">
			<a class="side-nav-menu-link media align-items-center" href="#" data-target="#manSpace">
				<span class="side-nav-menu-icon d-flex mr-3">
					<i class="gd-home"></i>
				</span>
				<span class="side-nav-fadeout-on-closed media-body">공간 관리</span>
				<span class="side-nav-control-icon d-flex">
					<i class="gd-angle-right side-nav-fadeout-on-closed"></i>
				</span>
				<span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
			</a>
			<ul id="manSpace" class="side-nav-menu side-nav-menu-second-level mb-0">
				<li class="side-nav-menu-item ">
					<a class="side-nav-menu-link" href="{{route('spaces.index')}}">모든 공간</a>
				</li>
				<li class="side-nav-menu-item ">
					<a class="side-nav-menu-link" href="{{route('spaces.create')}}">공간 추가</a>
				</li>
			</ul>
		</li>

		<li class="side-nav-menu-item side-nav-has-menu">
			<a class="side-nav-menu-link media align-items-center" href="{{route('reservations.index')}}">
    			<span class="side-nav-menu-icon d-flex mr-3">
    				<i class="gd-layout-list-thumb"></i>
    			</span>
    			<span class="side-nav-fadeout-on-closed media-body">예약 관리</span>
    			<span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
			</a>
		</li>

		<!-- Title -->
		<li class="sidebar-heading h6">도어락 관리</li>
		<!-- End Title -->

		<!-- Users -->
		<li class="side-nav-menu-item side-nav-has-menu">
			<a class="side-nav-menu-link media align-items-center" href="{{route('doorlocks.index')}}">
				<span class="side-nav-menu-icon d-flex mr-3">
					<i class="gd-lock"></i>
				</span>
				<span class="side-nav-fadeout-on-closed media-body">전체 도어락</span>
				<span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
			</a>
		</li>
	</ul>
</aside>
<!-- End Sidebar Nav -->