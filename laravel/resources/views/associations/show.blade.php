@extends('app')

@section('content')
   <h1>Booking {!! $booking->id !!} </h1>
   <h2>{!! $booking->booking_start !!} to {!! $booking->booking_end !!} at branch {!! $booking->branch !!}</h2> 
   
   Associated Users:
   
   <table style="width:30%">
   <th>Name</th>
   <th>Email</th>
   <th>Branch</th>
   @foreach($users as $user)
    <tr>
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
        <td>{!! $user->branch !!}</td>
        <td>{!! Form::open(array('route'=>array('associations.destroy', $booking->id, $user->id), 'method'=>'DELETE')) !!}
            {!! Form::submit('Remove') !!}
        {!! Form::close() !!}</td>
    </tr>
   @endforeach
   </table>
   {!! Form::open(array('route'=>array('associations.edit', $booking->id), 'method'=>'GET')) !!}
      {!! Form::submit('+ Add User') !!}
   {!! Form::close() !!}
    
    
@stop
