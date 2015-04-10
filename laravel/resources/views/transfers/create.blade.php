@extends('transfers/transfernav')

@section('content')
        {!! Form::open() !!}
        
            <div>
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name') !!}
            </div>
            
            <div>
            {!! Form::label('type', 'Type:') !!}
            {!! Form::text('type') !!}
            </div>
            
            <div>
            {!! Form::label('id', 'ID:') !!}
            {!! Form::text('id') !!}
            </div>
            
            <div>
            {!! Form::label('barcode', 'Barcode Number:') !!}
            {!! Form::text('barcode') !!}
            </div>
            
            <div>
            {!! Form::label('tags', 'Tags:') !!}
            {!! Form::text('tags') !!}
            </div>
            
            <div>
            {!! Form::label('content', 'Contents:') !!}
            {!! Form::text('content') !!}
            </div>
            
            <div>
            {!! Form::label('description', 'Description:') !!}
            {!! Form::text('description') !!}
            </div>
            
            <div>
            {!! Form::label('notes', 'Notes:') !!}
            {!! Form::text('notes') !!}
            </div>
            
            <div>
            {!! Form::submit('Create Kit') !!}
            </div>
@stop

