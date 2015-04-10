@extends('kits/kitnav')


@section('content')


        
      <table class="responstable"> 
   
<tr>
<th>kit_name</th>
<th>kit_type</th>
<th>barcode</th>
<th>branch</th>
<th>More Details</th>
</tr>

  <tr>
  
@foreach ($kits as $value) 
<tr>
  <td align="center">  {!! $value->kit_name!!} </td>
  <td align="center">   {!! $value->kit_type  !!} </td>
  <td align="center">  {!! $value->barcode!!} </td>
  <td align="center">  {!! $value->branch  !!} </td>
          <td align="center">{!! Form::open(array('route'=>array('kits.show',$value->kit_id),'method'=>'GET')) !!}
         {!! Form::submit('View Kit') !!}
           {!! Form::close() !!}	
   </tr>
@endforeach
 </tr>

</table>
           
         
          @stop
@stop



