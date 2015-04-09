@extends('kits/kitnav')

@section('content')

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif   

  {!! Form::open(array('route' => array('kits.create','class' => 'form' ),'method' => 'GET')) !!}
  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Kit</div>
				<div class="panel-body">
                {!! Form::hidden('id', $kitID->kit_id) !!}
                     <div class="form-group">
                        {!! Form::label('name', 'Kit Name:') !!}
                        {!! Form::text('kitname', $kitID->kit_name, 
                         array('required', 
                        'class'=>'form-control')) !!}
             
                     </div>
                     <div class="form-group">
                        {!! Form::label('type', 'Type:') !!}
                        {!!Form::select('kittype', $kittypes,
                        array('required', 'id' => 'kittypes',
                            'class'=>'form-control')) !!}
                      </div>
                      <div class="form-group">
                         {!! Form::label('location', 'Branch:') !!}
                         {!!Form::select('branch', $branches, 
                         array('required', 
                            'class'=>'form-control')) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('barcode', 'Barcode Number:') !!}
                        {!! Form::text('barcode', $kitID->barcode, 
                            array('required', 
                            'class'=>'form-control')) !!}
                       </div>
                       <div class="form-group">
                        {!! Form::submit('Confirm', 
                        array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
           
                        <div class="form-group">
                        {!! Form::open(array('route'=>array('kitassociations.show',$kitID->kit_id),'method'=>'GET')) !!}
                            {!! Form::submit('Add/Remove Assets', 
                        array('class'=>'btn btn-primary')) !!}
                        {!! Form::close() !!} 
                        </div>
                        <div class="form-group">
                         {!! Form::open(array('route'=>array('kits.show',$kitID->kit_id),'method'=>'GET')) !!}
                        {!! Form::submit('Return to Kit details', 
                        array('class'=>'btn btn-primary')) !!}
                        {!! Form::close() !!}	
                        </div>
                     </div>
                     
              </div>
            </div>
         </div>
         
     </div>
     
</div>
@stop
