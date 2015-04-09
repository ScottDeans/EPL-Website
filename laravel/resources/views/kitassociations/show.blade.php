@extends('app')

@section('content')
<div>
 

  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{!! Form::label('tags','Remove assets from '.$kitID->kit_name) !!}</div>
				<div class="panel-body">
                    <table style="width:90%">
                     <th>Asset</th>
                    <th>Description</th>
                    <th>Remove kit</th>
                    @foreach ($assets as $asset)
                        <tr>
                        <td>{!! $asset->asset_tag !!} </td>
                        <td>{!! $asset->description !!} </td>
                        <td>{!! Form::open(array('route'=>array('kitassociations.destroy', $asset->asset_id, $kitID->kit_id), 'method'=>'DELETE')) !!}
                        {!! Form::submit('Remove') !!}
                        {!! Form::close() !!}</td>
                        </tr>
                    @endforeach
                    </table>
                    <div class="form-group">
                    {!! Form::open(array('route'=>array('kitassociations.edit', $kitID->kit_id), 'method'=>'GET')) !!}
                    {!! Form::submit('+ Add Asset', 
                        array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                    </div>
                    <div class="form-group">
                    {!! Form::open(array('route'=>array('kits.show',$kitID->kit_id),'method'=>'GET')) !!}
                    {!! Form::submit('Return to Kit details', 
                            array('class'=>'btn btn-primary')) !!}
                    {!! Form::close() !!}
                    </div>	
                    @stop
          </div>
           </div>
          </div>
       </div>
    </div>
  </div>
</div>
