@extends('kits/kitnav')

@extends('app')

@section('content')
@section('kitcontent')

   

  
  {!! Form::open(array('action' => 'KitController@report', 'class' => 'form','method' => 'POST', 'route' => array('kits.report', $kitinfo->kit_name),'method'=>'GET')) !!}
  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">KitInfo</div>
				<div class="panel-body">
				  <div>
            {!! Form::label('id', 'ID:') !!}
            {!! Form::label('ID', $kitinfo->id ) !!}
            {!! Form::hidden('id', $kitinfo->id) !!}
            </div>
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
            {!! Form::label('note', $kitnotes->kit_note ) !!}
               
            </div>

            

         <div class="form-group">
    {!! Form::textarea('text', null, 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'Insert Note Here.')) !!}
   
</div>

<div class="form-group">
    {!! Form::submit('Submit Note', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}
<div class="form-group">
    {!! Form::button('Edit Kit', 
      array('class'=>'btn btn-primary')) !!}
</div>
</div>
           </div>
              </div>
            </div>
         </div>
     </div>
</div>
@stop
