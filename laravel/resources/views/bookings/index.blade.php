@extends('app')

@section('content')
        {!! Form::open() !!}
            <div>
            {!! Form::label('booking', 'Select kit:') !!}
            {!! Form::email('booking') !!}
            </div>
            
            <div>
            {!! Form::label('location', 'Select location:') !!}
            {!! Form::password('location') !!}
            </div>
            
            <div>
            {!! Form::label('date', 'Booking date start:') !!}
            {!! Form::password('date') !!}
            </div>
            
            <div>
            {!! Form::label('length', 'Booking length:') !!}
            {!! Form::password('length') !!}
            </div>
            
            <div>
            {!! Form::label('user', 'Kit user:') !!}
            {!! Form::password('user') !!}
            </div>
            
            <div>{!! Form::submit('Book kit') !!} </div>
        {!! Form::close() !!}
@stop
