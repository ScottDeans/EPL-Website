@extends('app')

@section('content')
 
{!! Form::label('tags', 'Tags:') !!}
     <table style="width:30%">
         <th>Asset</th>
         <th>Description</th>
         <th>Change Condition</th>
            @foreach ($assets as $asset)
            <tr>
            <td>{!! $asset->asset_tag !!} </td>
            <td>{!! $asset->description !!} </td>
            <td>{!! Form::open(array('route'=>array('kitassociations.destroy', $asset->id, $kitID->id), 'method'=>'DELETE')) !!}
                    {!! Form::submit('Remove') !!}
                {!! Form::close() !!}</td>
     </tr>
@endforeach
   </table>
   {!! Form::open(array('route'=>array('kitassociations.edit', $kitID->id), 'method'=>'GET')) !!}
      {!! Form::submit('+ Add Asset') !!}
   {!! Form::close() !!}
   @stop
     
