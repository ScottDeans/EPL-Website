@extends('transfers/transfernav')

@section('content')
        <h1> Incoming transfers:</h1>
        @if(sizeof($incoming) == 0)
            No incoming transfers at this time.
        @else
            <table>
            <th>Kit Barcode</th>
            <th>Kit Type</th>
            <th></th>
            @foreach($incoming as $transfer)
                <tr>
                    <td>{!! $transfer->barcode !!}</td>
                    <td>{!! $transfer->kit_type !!}</td>
                    <td>{!! Form::open(array('route'=>array('transfers.destroy', $transfer->transfer_id), 'method'=>'DELETE')) !!}
                {!! Form::submit('Mark as Received') !!}
                {!! Form::close() !!}</td>
                </tr>
            @endforeach
            </table>
        @endif
       
        <h1>Outgoing transfers:</h1>
        @if((sizeof($outgoing) == 0))
            No outgoing transfers at this time.
        @else
            <table>
            <th>Kit Barcode</th>
            <th>Destination Branch</th>
            <th></th>
            @foreach($outgoing as $transfer)
                <tr>
                    <td>{!! $transfer->barcode !!}</td>
                    <td>{!! $transfer->branch_code !!} ({!! $transfer->branch_name !!})</td>
                    <td>{!! Form::open(array('route'=>array('transfers.update', $transfer->transfer_id), 'method'=>'PUT')) !!}
                {!! Form::submit('Mark as Shipped') !!}
                {!! Form::close() !!}</td>
                </tr>
            @endforeach
            </table>
        @endif
@stop

