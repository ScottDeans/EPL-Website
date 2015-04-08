@extends('app')

@section('content')


   Adding Assets to Tags:
   <table style="width:30%">
   <th>asset_tag</th>
   <th>description</th>
   <th>Condition</th>
   @foreach($users as $asset)
    <tr>
        <td>{!! $asset->asset_tag !!}</td>
        <td>{!! $asset->description !!}</td>
        <td>{!! $asset->broken !!}</td>
        <td>{!! Form::open(array('route'=>array('kitassociations.store', $kit->kit_id, $asset->asset_id), 'method'=>'POST')) !!}
           {!! Form::submit('Add asset to: '.$kit->kit_name) !!}
        {!! Form::close() !!}</td>
    </tr>
   @endforeach
   </table>

@stop
