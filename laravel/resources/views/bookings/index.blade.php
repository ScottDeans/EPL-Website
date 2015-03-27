@extends('bookings/bookingnav')

@extends('app')


@section('content') 
@section('bookingcontent')

<style>
    
    h4 {
        position: relative;
        left: 550px;
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
        @if(count($assocbookings) != 0)
            <tr>
                <td align="center" class="table_text">{!! $assocbookings->event_name !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->kit_user !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->kit_id !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->branch !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->booking_start !!}</td>
                <td align="center" class="table_text">{!! $assocbookings->booking_end !!}</td>
                <td align="center" class="table_text">
                    <button> {!! link_to ('bookings/'.$assocbookings->id, 'Detailed View') !!} </button>
                    <button> {!! link_to ('associations/'.$assocbookings->id, 'Edit Bookings') !!} </button>
                    <button> {!! link_to ('bookings/'.$assocbookings->id, 'Delete Bookings') !!} </button>
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

<table class="responstable">
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
            <td align="center" class="table_text">{!! $bookings->kit_user !!}</td>
            <td align="center" class="table_text">{!! $bookings->kit_id !!}</td>
            <td align="center" class="table_text">{!! $bookings->branch !!}</td>
            <td align="center" class="table_text">{!! $bookings->booking_start !!}</td>
            <td align="center" class="table_text">{!! $bookings->booking_end !!}</td>
            <td align="center" class="table_text">
                <button> {!! link_to ('bookings/'.$bookings->id, 'Detailed View') !!} </button>
                <button> {!! link_to ('associations/'.$bookings->id, 'Edit Bookings') !!} </button>
                <button> {!! link_to ('bookings/'.$bookings->id, 'Delete Bookings') !!} </button>
            </td>
        </tr>
        @endif
    @endforeach
</table>
@stop
