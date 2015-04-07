@extends('app')

@section('content')
        <h1> Incoming transfers:</h1>
        <table>
        <th>Kit Barcode</th>
        <th>Shipped On</th>
        <th>Shipped By</th>
        <th></th>
        @foreach($incoming as $transfer)
            <tr>
                <td>{!! $transfer->kit_id !!}</td>
                <td>{!! $transfer->shipped_on !!}</td>
                <td>{!! $transfer->name !!}</td>
                <td>{!! Form::open(array('route'=>array('transfers.destroy', $transfer->transfer_id), 'method'=>'DELETE')) !!}
            {!! Form::submit('Mark as Received') !!}
            {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </table>
        
        <h1>Outgoing transfers:</h1>
        <table>
        <th>Kit Barcode</th>
        <th>Destination Branch</th>
        <th></th>
        @foreach($outgoing as $transfer)
            <tr>
                <td>{!! $transfer->kit_id !!}</td>
                <td>{!! $transfer->branch_code !!} ({!! $transfer->branch_name !!})</td>
                <td>{!! Form::open(array('route'=>array('transfers.update', $transfer->transfer_id), 'method'=>'PUT')) !!}
            {!! Form::submit('Mark as Shipped') !!}
            {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </table>
        
@stop

