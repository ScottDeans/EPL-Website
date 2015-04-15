@extends('kits/kitnav')

@section('content')
<h1>Are you sure?</h1>

This will delete the asset permanently and remove it from the kit it is associated with.

{!! Form::open(array('route'=>array('assets.destroy', $id), 'method'=>'DELETE')) !!}                                      
                     {!! Form::submit("Yes, delete it.") !!}
                     {!! Form::close() !!}
                  
{!! Form::open(array('route'=>array('assets.index'), 'method'=>'GET')) !!}                                      
                     {!! Form::submit("No, keep it.") !!}
                     {!! Form::close() !!}                     
    
@stop
