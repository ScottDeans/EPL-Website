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
            {!! Form::label('branch', $kitinfo->branch ) !!}
            </div>
            
            <div>
            {!! Form::label('barcode', 'Barcode Number:') !!}
            {!! Form::label('barcode', $kitinfo->barcode ) !!}
            </div>
           
            <div>
            {!! Form::label('tags', 'Tags:') !!}
            <table style="width:30%">
             <th>Asset</th>
             <th>Description</th>
             <th>Condition</th>
             <th>Change Condition</th>
            @foreach ($assets as $asset)
             <tr>
            <td>{!! $asset->asset_tag !!} </td>
            <td>{!! $asset->description !!} </td>
             @if($asset->broken==0)
                  <td>{!! "Good" !!} </td>
            @else
                  <td>{!! "Broken" !!} </td>
            @endif
            <td align="center">{!! Form::open(array('route'=>array('kits.update',$asset->asset_tag),'method'=>'PUT')) !!}
                {!! Form::submit('Kit Status') !!}
                {!! Form::close() !!}</td>	
            </tr>
            @endforeach
             </table>
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

            <div>
            <td align="center">{!! Form::open(array('route'=>array('kits.edit',$kitinfo->kit_id),'method'=>'GET')) !!}
                {!! Form::submit('Edit Kit') !!}
            {!! Form::close() !!}</td>	
            </div>
            <div>
            <td align="center">{!! Form::open(array('route'=>array('kits.destroy',$kitinfo->kit_id),'method'=>'DELETE')) !!}
                {!! Form::submit('Delete Kit') !!}
           {!! Form::close() !!}</td>	
            </div>
           </div>
          </div>
       </div>
    </div>
  </div>
</div>
@stop
