@extends('app')

@section('content')

 <h1>Booking {!! $booking->booking_id !!} </h1>
   <h2>{!! $booking->booking_start !!} to {!! $booking->booking_end !!} at branch {!! $booking->branch !!}</h2> 
   
   Adding Associates:
   
   <table style="width:30%">
   <th>Name</th>
   <th>Email</th>
   <th>Branch</th>
   @foreach($users as $user)
    <tr>
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
        <td>{!! $user->branch !!}</td>
        <td>{!! Form::open(array('route'=>array('associations.store', $booking->booking_id, $user->user_id), 'method'=>'POST')) !!}
            {!! Form::submit('Associate with '.$booking->booking_id) !!}
        {!! Form::close() !!}</td>
    </tr>
   @endforeach
   </table>

@stop
