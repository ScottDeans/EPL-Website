@extends('app')

@section('content')

<h1><b></b>{!! $bookings->event_name !!}</h1>
			    
			    <b>Location: </b>
			    {!!Form::label('location', $bookings->branch_code. ' ('.$bookings->branch_name).')' !!}
			    <br>
			    
			    <b>Kit Used:</b>
			    {!!Form::label('kit', $bookings->barcode.' (Kit Type:'.$bookings->kit_type.')') !!}
			    <br>
			    {!! Form::open(array('route'=>array('kits.show',$bookings->kit_id),'method'=>'GET')) !!}
                {!! Form::submit('View Kit') !!}
                {!! Form::close() !!}
			    <br>
			    
			    <b>Start Date:</b>
			    {!!Form::label('start', $bookings->booking_start) !!}
			    <br>
			    
			    <b>End Date</b>
			    {!!Form::label('end', $bookings->booking_end) !!}
			    <br>
			  
			    <b>Booked By:</b>
			    {!!Form::label('booker', $bookings->name) !!}
			    <br>
			    @if(sizeof($users) == 0)
                    <p>There are no users associated with this booking.</p>
                @else
		            <b>Users Associated With the Booking<b>
		            <table>
		            <th>User Name</th>
		            <th>Email</th>
		            <th>Home Branch</th>
		            @foreach ($users as $user)
		                <tr>
		                    <td>{!! $user->name !!}</td>
		                    <td>{!! $user->email !!}</td>
		                    <td>{!! $user->branch_code !!}</td>
		                </tr>
		            @endforeach
		            </table>
                @endif
                
			    {!! Form::open(array('route'=>array('associations.show',$bookings->booking_id),'method'=>'GET')) !!}
                {!! Form::submit('Edit Associations') !!}
                {!! Form::close() !!}

@stop
