@extends('app')

@section('content')

<h1>User Management</h1>

   <table style="width:30%">
   <th>Name</th>
   <th>Email</th>
   <th>Admin</th>
   <th></th>
   @foreach($users as $user)
    <tr>
        <td>{!! $user->name !!}</td>
        <td>{!! $user->email !!}</td>
        <td>{!! $user->branch_code !!}</td>
        <td>{!! Form::open(array('route'=>array('usermgmt.update', $user->user_id), 'method'=>'PUT')) !!}
            @if(!$user->admin)
                {!! Form::submit('Grant Admin Status') !!}
            @else
                {!! Form::submit('Remove Admin Status') !!}
            @endif
        {!! Form::close() !!}</td>
    </tr>
   @endforeach
   </table>

@stop

