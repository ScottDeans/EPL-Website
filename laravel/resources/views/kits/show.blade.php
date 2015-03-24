@extends('kits/kitnav')

@extends('app')

@section('content')
@section('kitcontent')

   

  {!! Form::open(array('route' => array('kits.report','class' => 'form',$kitinfo->barcode ))) !!}
 
            <div>
            {!! Form::label('name', 'Name:') !!}
            {!! Form::label('name', $kitinfo->kit_name ) !!}
            </div>

            <div>
            {!! Form::label('type', 'Type:') !!}
            {!! Form::label('name', $kitinfo->kit_type) !!}
            </div>
            
            <div>
            {!! Form::label('location', 'Location:') !!}
            {!! Form::label('name', $kitinfo->current_location ) !!}
            </div>
            
            <div>
            {!! Form::label('barcode', 'Barcode Number:') !!}
            {!! Form::label('name', $kitinfo->barcode ) !!}
         
            </div>
            
            <div>
            {!! Form::label('tags', 'Tags:') !!}
            {!! Form::label('name1', $kitinfo->id ) !!}
            </div>
            
            <div>
            {!! Form::label('content', 'Contents:') !!}
            {!! Form::label('name', $kitinfo->id ) !!}
            </div>
            
            <div>
            {!! Form::label('description', 'Description:') !!}
            {!! Form::label('name', $kitinfo->kit_description ) !!}
            </div>

            
            <div>
            {!! Form::label('notes', 'Notes:') !!}
            {!! Form::label('note', $kitinfo->kit_description ) !!}
            </div>
            

         <div class="form-group">
    {!! Form::label('Damedge report') !!}
    {!! Form::textarea('text', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'Input damedge')) !!}
   
</div>

<div class="form-group">
    {!! Form::submit('Report Error!', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
    
@stop
