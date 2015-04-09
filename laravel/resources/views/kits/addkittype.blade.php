@extends('kits/kitnav')

@extends('app')

@section('content')
@section('kitcontent')
  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add Kit Type</div>
				<div class="panel-body">
	
				 {!! Form::open(array('route' => array('kits.addkittype','class' => 'form' ),'method' => 'POST')) !!}

				 <div class="form-group">
                        {!! Form::label('add', 'Add Kit Type:') !!}
                        {!! Form::text('text', null, 
                         array('required', 
                        'class'=>'form-control')) !!}
                     </div>
				
	                <div class="form-group">
                {!! Form::submit('Add Kit Type', 
                    array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
				
				</div>
			</div>
		</div>
	</div>
   </div>

@stop
@stop
