<!doctype html>
<html>
    <head>
        <title>@yield('title') - EPL Kit Tracking System</title>
    	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/css/app.css" type="text/css"/>
        <div class="quote">Edmonton Public Library</div>
    </head>
    <body>
	    <nav class="navbar navbar-default">
	    	<div class="container-fluid">
	    		<div class="navbar-header">
	    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	    				<span class="sr-only">Toggle Navigation</span>
	    				<span class="icon-bar"></span>
	    				<span class="icon-bar"></span>
	    				<span class="icon-bar"></span>
	    			</button>
	    			<a class="navbar-brand" href="/welcome">Home</a>
	    		</div>
	    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    			<ul class="nav navbar-nav">
	    				<li><a href="/bookings">Bookings</a></li>
	    				<li><a href="/kits">Kits</a></li>
	    				<li><a href="/transfers">Transfers</a></li>
	    			</ul>
	    			<ul class="nav navbar-nav navbar-right">
	    				@if (Auth::guest())
	    					<li><a href="/auth/login">Login</a></li>
	    					<li><a href="/auth/register">Register</a></li>
	    				@else
	    					<li class="dropdown">
	    						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
	    						<ul class="dropdown-menu" role="menu">
	   							<li><a href="/auth/logout">Logout</a></li>
		    					</ul>
		    				</li>
		    			@endif
		    		</ul>
		    	</div>
		    </div>
    	</nav>
    	@yield('content')

    </body>
