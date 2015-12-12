@extends('bookings/bookingnav')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Create Booking</div>
				<div class="panel-body">
                    @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="confirm">
					
					    
					    <div class="form-group">
						    <label class="col-md-1 control-label">Event Name:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="event_name">
					        </div>
					    </div>
					    
					    <div class="form-group">
						    <label class="col-md-1 control-label">Associated Employees:<br>(Hold Ctrl to select multiple)</label>
						    <div class="col-md-4">
						        <select name="associated_users[]" multiple size=10>
						            @foreach($branch_uid as $index => $id )
                                        <option value={{ $id }}>{{ $branch_uname[$index] }}
                                    @endforeach
                                </select>
					        </div>
					    </div>
					    
					    <input type="hidden" name="kitType" class="form-control" value={{ $kitType }}>
					    
						<input type="hidden" class="form-control" name="Start_Date" value={{ $Start_Date }}>

						<input type="hidden" class="form-control" name="End_Date" value={{ $End_Date }}>
						
						<input type="hidden" name="branch_code" class="form-control" value={{ $branch_code }}>
						
						<input type="hidden" class="form-control" name="kit_id" value={{ $kit_id }}>
					    
					    <div class="form-group">
						    <div class="col-md-6 col-md-offset-4">
							    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
						            Submit
							    </button>
							</div>
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
</div>
@stop
