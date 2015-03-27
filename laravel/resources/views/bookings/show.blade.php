@extends('app')

@section('content')

<style>
    .editbutton {
        position: relative;
        left: 25px;
    }
</style>

<h1>Users for Booking {!! $bookings->id !!} </h1>

<table class="responstable">
<th align="center">Username</th>
<th align="center">Email</th>
<th align="center">Branch</th>
<th align="center">Kit User?</th>
@foreach ($users as $user)
    <tr>
        <td>{!! $user->name !!} </td>
        <td>{!! $user->email !!} </td>
        <td>{!! $user->branch !!} </td>
        <td>
            @if ($user->id == $bookings->kit_user)
                Yes
            @else 
                No
            @endif
        </td>
    </tr>
@endforeach
</table>

<button class="editbutton">{!! link_to ('associations/'.$bookings->id, 'Edit Associations') !!}</button>

@stop
