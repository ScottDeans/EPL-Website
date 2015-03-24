@extends('kits/kitnav')

@extends('app')

@section('content')
@section('kitcontent')

   

  {!! Form::open(array('route' => array('kits.add','class' => 'form' ))) !!}
 <div class="form-group">
            {!! Form::label('id', 'Name:') !!}
       {!! Form::text('id', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'ID')) !!}
            </div>
            <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
       {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'Input damedge')) !!}
            </div>

            <div class="form-group">
            {!! Form::label('type', 'Type:') !!}
 {!! Form::text('type', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'Kt_type')) !!}
            </div>
            
            <div class="form-group">
            {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'Location')) !!}
            </div>
            
             <div class="form-group">
            {!! Form::label('barcode', 'Barcode Number:') !!}
         {!! Form::text('barcode', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'barcode')) !!}
         
            </div>
            
             <div class="form-group">
            {!! Form::label('tags', 'Tags:') !!}
     {!! Form::text('tags', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'tags')) !!}
            </div>
            
            <div class="form-group">
            {!! Form::label('content', 'Contents:') !!}
        {!! Form::text('content', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'content')) !!}
            </div>
            
            <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
   {!! Form::textarea('description', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'description')) !!}
            </div>

<div class="form-group">
    {!! Form::submit('Add Kit!', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
    
@stop
