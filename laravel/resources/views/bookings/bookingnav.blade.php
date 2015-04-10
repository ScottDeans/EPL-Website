@extends('app')	

@section('subbar')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
    	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    	    		<span class="icon-bar"></span>
    	    		<span class="icon-bar"></span>
    	    	</button>
    	    </div>
    	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	    	<ul class="nav navbar-nav">
                    <li><a href="/bookings">View Bookings</a></li>
    	            <li><a href="/bookings/create">New Booking</a></li>
    	        </ul>
    		</div>
        </div>
    </nav>
@stop
