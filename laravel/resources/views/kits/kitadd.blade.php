@extends('kits/kitnav')

@section('content')

   

  {!! Form::open(array('route' => array('kits.add','class' => 'form' ),'method' => 'POST')) !!}
  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">AddKit</div>
				<div class="panel-body">

                <div class="form-group">
                {!! Form::label('name', 'Kit Name:') !!}
                {!! Form::text('kitname', null, 
                array('required', 
                    'class'=>'form-control',
                    'placeholder'=>'Input damedge')) !!}
                 </div>

                <div class="form-group">
                {!! Form::label('type', 'Type:') !!}
                {!!Form::select('kittype', $kittypes,
                array('required', 'id' => 'kittypes',
                    'class'=>'form-control',
                    'placeholder'=>'Kt_type')) !!}
                 </div>
            
                <div class="form-group">
                {!! Form::label('location', 'Branch:') !!}
                {!!Form::select('branch', $branches, 
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
                {!! Form::submit('Add Kit!', 
                    array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
                     </div>
              </div>
            </div>
         </div>
     </div>
</div>
@stop
