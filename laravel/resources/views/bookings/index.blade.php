@extends('bookings/bookingnav')

@extends('app')

@section('content') 
@section('bookingcontent')

<p> 
<br></br>Your Bookings 
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
<td align="center">Event Name</td>
<td align="center">{!! $assocbookings->kit_id !!}</td>
<td align="center">{!! $assocbookings->booking_start !!}</td>
<td align="center">{!! $assocbookings->booking_end !!}</td>
<td align="center">
    <button> Detailed View </button>
    <button> Edit Booking</button>
    <button> Delete Booking </button>
</td>
</tr>
@endforeach
</table>

<p>
Branch Bookings
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
<td align="center"> Event Name</td>
<td align="center">{!! $bookings->kit_id !!}</td>
<td align="center">{!! $bookings->booking_start !!}</td>
<td align="center">{!! $bookings->booking_end !!}</td>
<td align="center">
    {!! Form::open() !!}
    {!! Form::button('Detailed View') !!}
    {!! link_to ('associations/'.$bookings->id, $bookings->id) !!}
    {!! Form::close() !!}
    <button> Edit Booking {!! 'associations/'.$bookings->id, $bookings->id !!}</button>
    <button> Delete Booking </button>
</td>
</tr>
@endif
@endforeach
</table>

@stop
