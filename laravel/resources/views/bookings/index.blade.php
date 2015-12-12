@extends('bookings/bookingnav')

@section('content')

    <h1>Your Scheduled Bookings</h1>
    @if(sizeof($userbookings) == 0)
        <p>You have not scheduled any bookings.</p>
    @else
    <table>
        <th>Event Name</th>
        <th>Event Creator</th>
        <th>Kit Type</th>
        <th>Branch</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    
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
                
                <?php /*<div>
                {!! Form::open(array('route'=>array('bookings.edit', $userbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Edit Booking') !!}
		        {!! Form::close() !!}
                </div>*/
                ?>
                <div>
                {!! Form::open(array('route'=>array('bookings.destroy', $userbooking->booking_id), 'method'=>'DELETE')) !!}
		        {!! Form::submit('Delete Booking') !!}
		        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
 
</table>
   @endif
<br>
<h1>Associated Bookings</h1>
@if (sizeof($assocbookings) == 0)
        <p>You have not been associated with another user's booking.</p>
    @else
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
            <td>{!! $assocbooking->booking_end !!}</td>
            <td>
                <div>
                {!! Form::open(array('route'=>array('bookings.show', $assocbooking->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Detailed View') !!}
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
    
    </table>
    @endif
    <br>
<h1>Branch Bookings</h1>
@if (sizeof($bookings) == 0)
        <p>There are currently no bookings at your branch.</p>
    @else
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
                    {!! Form::open(array('route'=>array('bookings.destroy', $booking->booking_id), 'method'=>'DELETE')) !!}
			        {!! Form::submit('Delete Booking') !!}
			        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    
</table>
@endif
@stop
