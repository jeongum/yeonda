<!DOCTYPE html>
<html lang="en">
    <head>
    	<!-- Title -->
        <title>Documentation | Graindashboard UI Kit</title>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <!-- Favicon -->
        <link rel="shortcut icon" href="graindashboard/img/favicon.ico">
    
        <!-- Template -->
        <link rel="stylesheet" href="graindashboard/css/graindashboard.css">
    	
    	@include('layouts._css')
	</head>

    <body class="has-sidebar has-fixed-sidebar-and-header">
    	
    	@include('layouts._header')
    	
    	<main class="main">
    		
    		@include('layouts._sidebar')
    		<div class="content">
        		<div class="py-4 px-3 px-md-4">
    				@yield('content')
				</div>
				@include('layouts._footer')
    		</div>
    	</main>
    	
    	@include('layouts._scripts')
    </body>
</html>