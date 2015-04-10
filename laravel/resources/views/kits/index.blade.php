@extends('kits/kitnav')


@section('content')


@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
  
				<h1>All Kits</h1>
				           
                        <table class="responstable"> 
                        <table style="width:90%">
                            <tr>
                            <th>Kit Name</th>
                            <th>Kit Type</th>
                            <th>Barcode</th>
                            <th>Branch</th>
                            <th>More Details</th>
                            </tr>
                            <tr>
                            @foreach ($kits as $value) 
                                <tr>
                                <td>  {!! $value->kit_name!!} </td>
                                <td>   {!! $value->kit_type  !!} </td>
                                <td>  {!! $value->barcode!!} </td>
                                <td>  {!! $value->branch_code  !!} </td>
                                <td>{!! Form::open(array('route'=>array('kits.show',$value->kit_id),'method'=>'GET')) !!}
                                {!! Form::submit('View Kit') !!}
                                {!! Form::close() !!}	
                                 </tr>
                            @endforeach
                            </tr>
                            </table>
                             @stop
                            @stop
                

