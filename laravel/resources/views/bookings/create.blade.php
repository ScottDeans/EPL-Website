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
					<form class="form-horizontal" role="form" method="POST" action="create_b">

						<div class="form-group">
							<label class="col-md-1 control-label">Kit Type:</label>
							<div id="kit-type" class="col-md-3">
								<select name="kitType" class="form-control">
								    @foreach($kit_types as $type)
								        <option value={{ $type }}>{{ $type }}</option>
								    @endforeach
								</select>
							</div>
					    </div>
					    
						<div class="form-group">
						    <label class="col-md-1 control-label">Start Date:</label>
						    <div class="col-md-3">
						        <input type="date" class="form-control" name="Start_Date">
					        </div>
					    </div>

						<div class="form-group">
							<label class="col-md-1 control-label">End Date:</label>
						    <div class="col-md-3">
						        <input type="date" class="form-control" name="End_Date">
					        </div>
						</div>
						
						<div class="form-group">
							<label class="col-md-1 control-label">Event Location:</label>
						    <div class="col-md-3">
						        <select name="branch_code" class="form-control">
								    @foreach($branch_codes as $i=>$code)
								        <option value={{ $code }}>{{ $code }} - {{ $branch_names[$i] }}</option>
								    @endforeach
								</select>
					        </div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Find Kit
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
