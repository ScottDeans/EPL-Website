@extends('app')

@section('content')
        {!! Form::open() !!}
        
            <div>
            {!! Form::button('Select Kit') !!}
            </div>
            
            <div>
            {!! Form::button('Kit Overview') !!}
            </div>
            
            <div>
            {!! Form::label('name', 'Name:') !!}
            </div>
            
            <div>
            {!! Form::label('type', 'Type:') !!}
            </div>
            
            <div>
            {!! Form::label('location', 'Location:') !!}
            </div>
            
            <div>
            {!! Form::label('barcode', 'Barcode Number:') !!}
            </div>
            
            <div>
            {!! Form::label('tags', 'Tags:') !!}
            </div>
            
            <div>
            {!! Form::label('content', 'Contents:') !!}
            </div>
            
            <div>
            {!! Form::label('description', 'Description:') !!}
            </div>
            
            <div>
            {!! Form::button('Current Bookings') !!}
            </div>
            
            <div>
            {!! Form::button('Future Bookings') !!}
            </div>
            
            <div>
            {!! Form::label('notes', 'Notes:') !!}
            </div>
            
        {!! Form::close() !!}
@stop
