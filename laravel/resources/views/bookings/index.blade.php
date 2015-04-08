@extends('bookings/bookingnav')

@extends('app')


@section('content') 
@section('bookingcontent')

<p> 
<br><h2>Your Bookings</h2></br>
</p>
<table class="responstable">
    <tr>
        <th>Event Name</th>
        <th>Kit Type</th>
        <th>Booking Start Date</th>
        <th>Booking End Date</th>
        <th> </th>
    </tr>

    @foreach ($assocbookings as $assocbookings)
    <tr>
        <td align="center">{!! $assocbookings->event_name !!}</td>
        <td align="center">{!! $assocbookings->kit_id !!}</td>
        <td align="center">{!! $assocbookings->booking_start !!}</td>
        <td align="center">{!! $assocbookings->booking_end !!}</td>
        <td align="center">
            <button> {!! link_to ('associations/'.$assocbookings->booking_id, 'Detailed View') !!} </button>
            <button> {!! link_to ('associations/'.$assocbookings->booking_id, 'Edit Bookings') !!} </button>
            <button> {!! link_to ('associations/'.$assocbookings->booking_id, 'Delete Bookings') !!} </button>
        </td>
    </tr>
    @endforeach
</table>

<p>
    <br><h2>Branch Bookings</h2></br>
</p>

<table class="responstable">
    <tr>
    <th>Event Name</th>
    <th>Kit Type</th>
    <th>Booking Start Date</th>
    <th>Booking End Date</th>
    <th> </th>
    </tr>

    @foreach ($bookings as $bookings)
        @if ($bookings->branch == $branch)
        <tr>
            <td align="center">{!! $bookings->event_name !!}</td>
            <td align="center">{!! $bookings->kit_id !!}</td>
            <td align="center">{!! $bookings->booking_start !!}</td>
            <td align="center">{!! $bookings->booking_end !!}</td>
            <td align="center">
                <button> {!! link_to ('associations/'.$bookings->booking_id, 'Detailed View') !!} </button>
                <button> {!! link_to ('associations/'.$bookings->booking_id, 'Edit Bookings') !!} </button>
                <button> {!! link_to ('associations/'.$bookings->booking_id, 'Delete Bookings') !!} </button>
            </td>
        </tr>
        @endif
    @endforeach
</table>
@stop
