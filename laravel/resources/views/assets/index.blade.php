@extends('kits/kitnav')

@section('content')
{!! Form::open(array('route'=>array('assets.create'), 'method'=>'GET')) !!}                                      
                     {!! Form::submit("+ Add New Asset") !!}
                     {!! Form::close() !!}
    <h1>All assets:</h1>
    
    <table>
    <th>Asset Tag</th>
    <th>Description</th>
    <th>Status</th>
    <th>Action Required</th>
    <th></th>
    @foreach($assets as $asset)
        <tr>
            <td>{!! $asset->asset_tag !!}</td>
            <td>{!! $asset->description !!}</td>
            <td>{!! $asset->broken ? 'Broken' : 'Good' !!}</td>
            <td>@if($asset->broken)
                    {!! Form::open(array('route'=>array('assets.update',$asset->asset_id),'method'=>'PUT')) !!}                                      
                     {!! Form::submit("Report Fixed") !!}
                     {!! Form::close() !!}
                @else
                    --
                @endif</td>
            <td>{!! Form::open(array('route'=>array('assets.show',$asset->asset_id),'method'=>'GET')) !!}                                      
                     {!! Form::submit("Decommision Asset") !!}
                     {!! Form::close() !!}</td>
        </tr>
    @endforeach
    </table>



@stop
