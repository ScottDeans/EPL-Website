@extends('app')

@section ('content')

<div class="container-fluid">
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Booking {!! $bookings->booking_id !!} </div>
			    <div class="panel-body">
			        
			        <div>
			        {!! Form::label('name', 'Event Name:') !!}
                    {!! Form::text('name', $bookings->event_name, array('class'=>'form-control')) !!}
			        </div>
			        
			        <div>
			        {!! Form::label ('kit', 'Kit Used: ') !!}
			        {!! Form::text('kit', $bookings->kit_id, array('class'=>'form-control')) !!}
			        </div>
			        
			        <div>
			        {!! Form::label ('branch', 'Location/Branch: ') !!}
			        {!! Form::text('branch', $bookings->branch, array('class'=>'form-control')) !!}
			        </div>
			        
			        <div>
			        {!! Form::label ('start', 'Start Date: ') !!}
			        {!! Form::text('start', $bookings->booking_start, array('class'=>'form-control')) !!}
			        </div>
			        
			        <div>
			        {!! Form::label ('end', 'End Date: ') !!}
			        {!! Form::text('end', $bookings->booking_end, array('class'=>'form-control')) !!}
			        </div>
			        
			        <div>
			        {!! Form::open(array('route'=>array('associations.show', $bookings->booking_id), 'method'=>'GET')) !!}
			        {!! Form::submit('Edit Associations') !!}
			        {!! Form::close() !!}
			        </div>
			        
			        <br><div>
			        {!! Form::open() !!}
			        {!! Form::submit ('Submit Changes') !!}
			        {!! Form::close() !!}
			        </div>
			    </div>
			</div>
	    </div>
	</div>
</div>
</div>

@stop
