@extends('bookings/bookingnav')
@extends('app')

@section('content')
@section('bookingcontent')
		
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Confirmed Booking</div>
				<div class="panel-body">
					Your kit has been booked! The booking ID number is: {{ $booking_id }}
				</div>	
			</div>
		</div>
	</div>
</div>
@stop

