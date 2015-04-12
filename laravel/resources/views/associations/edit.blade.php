@extends('app')

@section('content')

 
   <h1>{!! $booking->event_name !!}'s Associated Users </h1>
   <h3>{!! $booking->booking_start !!} to {!! $booking->booking_end !!} at branch {!! $booking->branch_code !!}({!! $booking->branch_name !!})</h3> 
   
   <table style="width:30%">
   <th>Name</th>
   <th>Email</th>
   <th>Branch</th>
   <th></th>
   @foreach($users as $user)
    <tr>
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
        <td>{!! $user-> branch_code !!}</td>
        <td>{!! Form::open(array('route'=>array('associations.store', $booking->booking_id, $user->user_id), 'method'=>'POST')) !!}
            {!! Form::submit('Associate') !!}
        {!! Form::close() !!}</td>
    </tr>
   @endforeach
   </table>

@stop
