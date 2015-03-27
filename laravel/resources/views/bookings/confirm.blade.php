@extends('bookings/bookingnav')
@extends('app')

@section('content')
@section('bookingcontent')
		
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Confirm Booking</div>
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
					<form class="form-horizontal" role="form" method="POST" action="store">
					
					    <div class="form-group">
						    <label class="col-md-1 control-label">Kit ID:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="kit_id" value={{ $kit_id }} readonly>
					        </div>
					    </div>

						<div class="form-group">
						    <label class="col-md-1 control-label">Kit Type:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="kitType" value={{ $kitType }} readonly>
					        </div>
					    </div>
					    
					    <div class="form-group">
						    <label class="col-md-1 control-label">Event Name:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="event_name" value={{ $event_name }} readonly>
					        </div>
					    </div>
					    
					    <div class="form-group">
						    <label class="col-md-1 control-label">Start Date:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="Start_Date" value={{ $Start_Date }} readonly>
					        </div>
					    </div>

						<div class="form-group">
							<label class="col-md-1 control-label">End Date:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="End_Date" value={{ $End_Date }} readonly>
					        </div>
						</div>
						
						<div class="form-group">
						    <label class="col-md-1 control-label">Branch Code:</label>
						    <div class="col-md-3">
						        <input type="text" class="form-control" name="branch_code" value={{ $branch_code }} readonly>
					        </div>
					    </div>
					    
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Confirm
								</button>
							</div>
						</div>
					</form>
					If you wish to cancel, navigate to another page.
				</div>	
			</div>
		</div>
	</div>
</div>
@stop

