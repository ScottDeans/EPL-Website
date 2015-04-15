@extends('kits/kitnav')

@section('content')

@if(sizeof($errors) > 0)
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
   <ul>
   @foreach($errors->all() as $error)
        <li>{!! $error !!}</li>
   @endforeach
   </ul>
@endif
<h1>New Asset</h1>
{!! Form::open(['route'=>['assets.store']]); !!}
{!! Form::label("Asset Tag (must be 6 digits!): "); !!}
{!! Form::text('asset_tag', '000000'); !!}
<br>
{!! Form::label("Description: "); !!}
{!! Form::text('description'); !!}
</br>
{!! Form::submit('Create Asset'); !!}
@stop
