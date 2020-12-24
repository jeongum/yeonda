<!DOCTYPE html>
<html lang="en">
    <head>
    	<!-- Title -->
        <title>Documentation | Graindashboard UI Kit</title>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <link rel="icon" href="{{ asset('img/logo/L_TB_256.png')}}">
        <!-- Template -->
        <link rel="stylesheet" href="{{ asset('graindashboard/css/graindashboard.css')}}">
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    	
    	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    	
    	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    	
    	@include('layouts._css')
	</head>

    <body class="has-sidebar has-fixed-sidebar-and-header">
    	
    	@include('layouts._header')
    	
    	<main class="main">
    		
    		@include('layouts._sidebar')
    		<div class="content">
        		<div class="py-4 px-3 px-md-4 h-100">
    				@yield('content')
				</div>
				@include('layouts._footer')
    		</div>
    	</main>
    	
    	@include('layouts._scripts')
    </body>
    @if(Route::current()->getName() == 'doorlocks.index' || Route::current()->getName() == 'reservations.index')
    	@include('layouts._modals')
    @endif
</html>