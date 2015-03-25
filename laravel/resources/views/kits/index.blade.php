
@extends('kits/kitnav')

@extends('app')

@section('content')
@section('kitcontent')


        
      <table class="responstable"> 
   
<tr>
<th>id</th>
<th>kit_description</th>
<th>kit_type</th>
<th>kit_name</th>
<th>current_location</th>
<th>barcode</th>
<th>More Details</th>
</tr>

  <tr>
@foreach ($kits as $value) 
<tr>

  <td align="center">  {!! $value->id  !!} </td>
  <td align="center">   {!! $value->kit_description!!} </td>
  <td align="center">   {!! $value->kit_type  !!} </td>
  <td align="center">  {!! $value->kit_name!!} </td>
  <td align="center">  {!! $value->current_location  !!} </td>
   <td align="center">  {!! $value->barcode!!} </td>
  
          <td align="center">{!! Form::open(array('route'=>array('kits.show',$value->id),'method'=>'GET')) !!}
         {!! Form::submit('View Kit') !!}
           {!! Form::close() !!}	
   </tr>
@endforeach
 </tr>

</table>
           
         
          @stop
@stop



