@extends('kits/kitnav')

@section('content')

   

  
  {!! Form::open(array('action' => 'KitController@report', 'class' => 'form','method' => 'POST', 'route' => array('kits.report', $kitinfo->kit_name),'method'=>'GET')) !!}
  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">KitInfo</div>
				<div class="panel-body">
				  <div>

            {!! Form::hidden('id', $kitinfo->kit_id) !!}
            </div>
            <div>
            {!! Form::label('name', 'Kit Name:') !!}
            {!! Form::label('name', $kitinfo->kit_name ) !!}
            </div>

            <div>
            {!! Form::label('type', 'Kit Type:') !!}
            {!! Form::label('name', $kitinfo->kit_type) !!}
            </div>
            
            <div>
            {!! Form::label('location', 'Branch:') !!}
            {!! Form::label('branch', $kitinfo->branch_code.' ('.$kitinfo->branch_name.')' ) !!}
            </div>
            
            <div>
            {!! Form::label('barcode', 'Barcode Number:') !!}
            {!! Form::label('barcode', $kitinfo->barcode ) !!}
            </div>
           
            <div>
            <table style="width:70%">
             <th>Asset</th>
             <th>Description</th>
             <th>Condition</th>
             <th></th>
            
            @foreach ($assets as $asset)
             <tr>
            <td>{!! $asset->asset_tag !!} </td>
            <td>{!! $asset->description !!} </td>
            
            
            <td>  @if($asset->broken==0)
            Good
            @else
            Broken
            @endif
            </td>
            <td>
            {!! Form::open(array('route'=>array('kits.update',$asset->asset_tag),'method'=>'PUT')) !!}
                    <?php $buttonMessage = $asset->broken == 0 ? "Report Broken" : "Report Fixed" ?>
                    
                     {!! Form::submit($buttonMessage) !!}
                     {!! Form::close() !!}
            </td>
            </tr>
            
           
            @endforeach
             </table>
            </div>  


             <div class="form-group">

            {!! Form::textarea('text',$kitnotes->kit_note, 
                array('required', 
                    'class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                 {!! Form::submit('Confirm', 
                array('class'=>'btn btn-primary')) !!}
           
            {!! Form::close() !!}
            </div>	
            @if(Auth::User()->manager)
          <div class="form-group">
            {!! Form::open(array('route'=>array('kits.edit',$kitinfo->kit_id),'method'=>'GET')) !!}
                {!! Form::submit('Edit Kit',array('class'=>'btn btn-primary')) !!}
            {!! Form::close() !!}</div>	
            
             <div class="form-group">       
           {!! Form::open(array('route'=>array('kits.destroy',$kitinfo->kit_id),'method'=>'DELETE')) !!}
                {!! Form::submit('Delete Kit',array('class'=>'btn btn-delete')) !!}
           {!! Form::close() !!}</div>	
           @endif
      	
            </div>
           </div>
          </div>
       </div>
    </div>
  </div>
</div>
@stop
