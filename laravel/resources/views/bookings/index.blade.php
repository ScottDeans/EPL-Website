@extends('bookings/bookingnav')

@extends('app')


@section('content') 
@section('bookingcontent')

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
        <th class="table_text">Event Name</th>
        <th class="table_text">Booking User</th>
        <th class="table_text">Kit Type</th>
        <th class="table_text">Branch</th>
        <th class="table_text">Booking Start Date</th>
        <th class="table_text">Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($assocbookings as $assocbookings)
        @if(count($assocbookings) > 0)
            <tr>
                <td align="center" class="table_text">{!! $assocbookings->event_name !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->name !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->kit_type !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->branch_name !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->booking_start !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->booking_end !!}</td>
                <td align="center" class="table_text">
                    <div>
                    {!! Form::open(array('route'=>array('bookings.show', $assocbookings->id), 'method'=>'GET')) !!}
			        {!! Form::submit('Detailed View') !!}
			        {!! Form::close() !!}
			        </div>
                    
                    <div>
                    {!! Form::open(array('route'=>array('bookings.edit', $assocbookings->id), 'method'=>'GET')) !!}
			        {!! Form::submit('Edit Booking') !!}
			        {!! Form::close() !!}
                    </div>
                    
                    <div>
                    {!! Form::open(array('route'=>array('bookings.destroy', $assocbookings->id), 'method'=>'DELETE')) !!}
			        {!! Form::submit('Delete Booking') !!}
			        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @else
            <tr>
                <td>You have no bookings</td>
            </tr>
        @endif
    @endforeach
</table>

<br></br>

<h4><br>Branch Bookings</h4>

<table class="branch_table">
    <tr>
        <th class="table_text">Event Name</th>
        <th class="table_text">Booking User</th>
        <th class="table_text">Kit Type</th>
        <th class="table_text">Branch</th>
        <th class="table_text">Booking Start Date</th>
        <th class="table_text">Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($bookings as $bookings)
        @if ($bookings->branch == $branch)
        <tr>
            <td align="center" class="table_text">{!! $bookings->event_name !!}</td>
            <td align="center" class="table_text">{!! $bookings->name !!}</td>
            <td align="center" class="table_text">{!! $bookings->kit_type !!}</td>
            <td align="center" class="table_text">{!! $bookings->branch_name !!}</td>
            <td align="center" class="table_text">{!! $bookings->booking_start !!}</td>
            <td align="center" class="table_text">{!! $bookings->booking_end !!}</td>
            <td align="center" class="table_text">
                <div>
                    {!! Form::open(array('route'=>array('bookings.show', $bookings->id), 'method'=>'GET')) !!}
			        {!! Form::submit('Detailed View') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.edit', $bookings->id), 'method'=>'GET')) !!}
			        {!! Form::submit('Edit Booking') !!}
			        {!! Form::close() !!}
                </div>
                <div>
                    {!! Form::open(array('route'=>array('bookings.destroy', $bookings->id), 'method'=>'DELETE')) !!}
			        {!! Form::submit('Delete Booking') !!}
			        {!! Form::close() !!}
                </div>
            </td>
        </tr>
        @endif
    @endforeach
</table>
@stop
