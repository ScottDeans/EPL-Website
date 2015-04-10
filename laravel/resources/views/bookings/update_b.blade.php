@extends('bookings/bookingnav')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Booking</div>
				<div class="panel-body">
				    <ul>
				    <?php
                     if (isset($_POST['associated_users'])) {
                      foreach ($_POST['associated_users'] as $names) {
                       print "<li>You selected $names</li>";
                      } 
                     } 
                    ?>
                    </ul>
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
							<div id="kit-type" class="col-md-3">
								<input type="hidden" name="kitType" class="form-control" value={{ $data['kitType']}}>
							</div>
					    </div>
					    
						<div class="form-group">
						    <div class="col-md-3">
						        <input type="hidden" class="form-control" name="Start_Date" value={{ $data['Start_Date'] }}>
					        </div>
					    </div>

						<div class="form-group">
						    <div class="col-md-3">
						        <input type="hidden" class="form-control" name="End_Date" value={{ $data['End_Date'] }}>
					        </div>
						</div>
						
						<div class="form-group">
						    <div class="col-md-3">
						        <input type="hidden" name="branch_code" class="form-control" value={{ $data['branch_code'] }}>
					        </div>
						</div>
						
						<div class="form-group">
						    <div class="col-md-3">
						        <input type="hidden" class="form-control" name="kit_id" value={{ $data['kit_id'] }}>
					        </div>
					    </div>
					    
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Submit') !!}
							</div>
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
</div>
@stop
