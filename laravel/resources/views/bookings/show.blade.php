@extends('app')

@section('content')

<table style="width:30%">
<th>Username</th>
<th>Email</th>
<th>Branch</th>
@foreach ($users as $user)
    <tr>
        <td>{!! $user->name !!} </td>
        <td>{!! $user->email !!} </td>
        <td>{!! $user->branch !!} </td>
        <td>Remove </td>
    </tr>
@endforeach
</table>

@end
