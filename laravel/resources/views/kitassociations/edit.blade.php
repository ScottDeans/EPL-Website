@extends('app')

@section('content')

  <div class="container-fluid">
   	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{!! Form::label('tags','Adding assets to '.$kit->kit_name) !!}</div>
				    <div class="panel-body">
                        <table style="width:90%">
                            <th>asset tag</th>
                            <th>description</th>
                            <th>Condition</th>
                            @foreach($users as $asset)
                                <tr>
                                <td>{!! $asset->asset_tag !!}</td>
                                <td>{!! $asset->description !!}</td>
                                @if($asset->broken==0)
                                    <td>{!! "Good" !!} </td>
                                @else
                                    <td>{!! "Broken" !!} </td>
                                @endif
                                <td>{!! Form::open(array('route'=>array('kitassociations.store',$asset->asset_id,$kit->kit_id), 'method'=>'POST')) !!}
                                {!! Form::submit('Add asset') !!}
                                {!! Form::close() !!}</td>
                                </tr>
                                @endforeach
                                </table>
                                <div class="form-group">
                                <td align="center">{!! Form::open(array('route'=>array('kits.show',$kit->kit_id),'method'=>'GET')) !!}
                                {!! Form::submit('Return to Kit details', 
                                    array('class'=>'btn btn-primary')) !!}
                                {!! Form::close() !!}	</div>
                                @stop

             </div>
           </div>
          </div>
       </div>
    </div>
  </div>
</div>
