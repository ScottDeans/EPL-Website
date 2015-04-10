@extends('app')

@section('content')

<style>
    .editbutton {
        position: relative;
        left: 25px;
    }
</style>

<div class="container-fluid">
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Booking {!! $bookings->booking_id !!} info</div>
			    <div class="panel-body">
			    <div>
			    {!! Form::label('name', 'Event Name: ') !!}
			    {!! Form::label('name', $bookings->event_name) !!}
			    </div>
			    
			    <div>
			    {!!Form::label('location', 'Location: ') !!}
			    {!!Form::label('location', $bookings->branch) !!}
			    </div>
			    
			    <div>
			    {!!Form::label('kit', 'Kit Used: ') !!}
			    {!!Form::label('kit', $bookings->kit_id) !!}
			    {!! Form::open(array('route'=>array('kits.show',$bookings->kit_id),'method'=>'GET')) !!}
                {!! Form::submit('View Kit') !!}
                {!! Form::close() !!}
			    </div>
			    
			    <div>
			    {!!Form::label('start', 'Start Date: ') !!}
			    {!!Form::label('start', $bookings->booking_start) !!}
			    </div>
			    
			    <div>
			    {!!Form::label('end', 'End Date: ') !!}
			    {!!Form::label('end', $bookings->booking_end) !!}
			    </div>
			    
			    <div>
			    {!!Form::label('booker', 'Booked By: ') !!}
			    {!!Form::label('booker', $bookings->kit_user) !!}
			    </div>
			    
			    <div>
			    {!!Form::label('users', 'Users Associated With the Booking: ') !!}
			    @foreach ($users as $user)
			        <br>{!! Form::label('user', $user->name) !!}
			    @endforeach
			    </div>
			    
			    <div>
			    {!! Form::open(array('route'=>array('associations.show',$bookings->booking_id),'method'=>'GET')) !!}
                {!! Form::submit('Edit Associations') !!}
                {!! Form::close() !!}
			    </div>
			</div>
	    </div>
	</div>
</div>
</div>

@stop
