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
        <th>Booking User</th>
        <th>Kit Type</th>
        <th>Branch</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($assocbookings as $assocbookings)
        <tr>
            <td>{!! $assocbookings->event_name !!}</td>
            <td>{!! $assocbookings->name !!}</td>
            <td>{!! $assocbookings->kit_type !!}</td>
            <td>{!! $assocbookings->branch_code !!}</td>
            <td>{!! $assocbookings->booking_start !!}</td>
            <td>{!! $assocbookings->booking_end !!}</td>
            <td>
                <div>
                {!! Form::open(array('route'=>array('bookings.show', $assocbookings->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Detailed View') !!}
		        {!! Form::close() !!}
		        </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.edit', $assocbookings->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Edit Booking') !!}
		        {!! Form::close() !!}
                </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.destroy', $assocbookings->booking_id), 'method'=>'DELETE')) !!}
		        {!! Form::submit('Delete Booking') !!}
		        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    @foreach ($userbookings as $userbookings)
        <tr>
            <td>{!! $userbookings->event_name !!}</td>
            <td>{!! $userbookings->name !!}</td>
            <td>{!! $userbookings->kit_type !!}</td>
            <td>{!! $userbookings->branch_code !!}</td>
            <td>{!! $userbookings->booking_start !!}</td>
            <td>{!! $userbookings->booking_end !!}</td>
            <td>
                <div>
                {!! Form::open(array('route'=>array('bookings.show', $assocbookings->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Detailed View') !!}
		        {!! Form::close() !!}
		        </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.edit', $assocbookings->booking_id), 'method'=>'GET')) !!}
		        {!! Form::submit('Edit Booking') !!}
		        {!! Form::close() !!}
                </div>
                
                <div>
                {!! Form::open(array('route'=>array('bookings.destroy', $assocbookings->booking_id), 'method'=>'DELETE')) !!}
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
        <th>Booking User</th>
        <th>Kit Type</th>
        <th>Branch</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($bookings as $bookings)
        <tr>
            <td>{!! $bookings->event_name !!}</td>
            <td>{!! $bookings->name !!}</td>
            <td>{!! $bookings->kit_type !!}</td>
            <td>{!! $bookings->branch_code !!}</td>
            <td>{!! $bookings->booking_start !!}</td>
            <td>{!! $bookings->booking_end !!}</td>
            <td>
                <div>
                    {!! Form::open(array('route'=>array('bookings.show', $bookings->booking_id), 'method'=>'GET')) !!}
			        {!! Form::submit('Detailed View') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.edit', $bookings->booking_id), 'method'=>'GET')) !!}
			        {!! Form::submit('Edit Booking') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.destroy', $bookings->booking_id), 'method'=>'DELETE')) !!}
			        {!! Form::submit('Delete Booking') !!}
			        {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
</table>
@stop
