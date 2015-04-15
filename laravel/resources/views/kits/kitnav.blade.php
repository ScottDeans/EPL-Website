@extends('app')	

@section('subbar')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
    	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    	    		<span class="icon-bar"></span>
    	    		<span class="icon-bar"></span>
    	    		<span class="icon-bar"></span>
    	    	</button>
    	    </div>
    	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	    	<ul class="nav navbar-nav">
                    <li><a href="/kits">View Kits</a></li>
                    @if(Auth::User()->manager || Auth::User()->admin)
                    <li><a href="{!!route('kits.showadd')!!}">Add Kits</a></li>
					<li><a href="{!!route('kits.showaddtype')!!}">Add Kit Type</a></li>
					<li><a href="{!!route('assets.index')!!}">Asset Management</a></li>
					@endif
    	        </ul>
    		</div>
        </div>
    </nav>
@stop


