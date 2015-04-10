@extends('bookings/bookingnav')

@section('content')

<style>
    
    h4 {
        position: relative;
        left: 350px;
    }
    
    h3 {
        position: absolute;
        left: 350px;
        top: 260px;
        font-size: 15px;
    }
    
</style>


<h4>Your Bookings</h4>

<table>
    <tr>
        <th>Event Name</th>
        <th>Event Creator</th>
        <th>Kit Type</th>
        <th>Branch</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($assocbookings as $assocbooking)
        <tr>
            <td>{!! $assocbooking->event_name !!}</td>
            <td>{!! $assocbooking->name !!}</td>
            <td>{!! $assocbooking->kit_type !!}</td>
            <td>{!! $assocbooking->branch_code !!}</td>
            <td>{!! $assocbooking->booking_start !!}</td>
            <td>{!! $assocbookings->booking_end !!}</td>
            <td>
                <div>
                {!! Form::open(array('route'=>array('bookings.show', $assocbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Detailed View') !!}
		        {!! Form::close() !!}
		        </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.edit', $assocbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Edit Booking') !!}
		        {!! Form::close() !!}
                </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.destroy', $assocbooking->booking_id), 'method'=>'DELETE')) !!}
		        {!! Form::submit('Delete Booking') !!}
		        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    @foreach ($userbookings as $userbooking)
        <tr>
            <td>{!! $userbooking->event_name !!}</td>
            <td>{!! $userbooking->name !!}</td>
            <td>{!! $userbooking->kit_type !!}</td>
            <td>{!! $userbooking->branch_code !!}</td>
            <td>{!! $userbooking->booking_start !!}</td>
            <td>{!! $userbooking->booking_end !!}</td>
            <td>
                <div>
                {!! Form::open(array('route'=>array('bookings.show', $userbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Detailed View') !!}
		        {!! Form::close() !!}
		        </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.edit', $userbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Edit Booking') !!}
		        {!! Form::close() !!}
                </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.destroy', $userbooking->booking_id), 'method'=>'DELETE')) !!}
		        {!! Form::submit('Delete Booking') !!}
		        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
</table>

<br></br>

<h4><br>Branch Bookings</h4>

<table>
    <tr>
        <th>Event Name</th>
        <th>Event Creator</th>
        <th>Kit Type</th>
        <th>Branch</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($bookings as $booking)
        <tr>
            <td>{!! $booking->event_name !!}</td>
            <td>{!! $booking->name !!}</td>
            <td>{!! $booking->kit_type !!}</td>
            <td>{!! $booking->branch_code !!}</td>
            <td>{!! $booking->booking_start !!}</td>
            <td>{!! $booking->booking_end !!}</td>
            <td>
                <div>
                    {!! Form::open(array('route'=>array('bookings.show', $booking->booking_id), 'method'=>'GET')) !!}
			        {!! Form::submit('Detailed View') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.edit', $booking->booking_id), 'method'=>'GET')) !!}
			        {!! Form::submit('Edit Booking') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.destroy', $booking->booking_id), 'method'=>'DELETE')) !!}
			        {!! Form::submit('Delete Booking') !!}
			        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
</table>
@stop
