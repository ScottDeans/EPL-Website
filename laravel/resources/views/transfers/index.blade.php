@extends('app')

@section('content')
        {!! Form::open() !!}
        
            <div>
            {!! Form::button('Add Kit') !!}
            </div>
            
            <div>
            {!! Form::button('Update Kit') !!}
            </div>
            
            <div>
            {!! Form::button('Remove Kit') !!}
            </div>
@stop

