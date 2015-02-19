@extends('app')

@section('content')
        {!! Form::open() !!}
        
            <div>
            {!! Form::button('Select Kit') !!}
            </div>
            
            <div>
            {!! Form::button('Kit Overview') !!}
            </div>
@stop
