@extends('bookings/bookingnav')


@section ('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Booking {!! $booking->booking_id !!}</div>
				<div class="body-panel">
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
					<form class="form-horizontal" role="form" method="POST" action="update_b">

						<div class="form-group">
							<label class="col-md-1 control-label">Kit Type:</label>
							<div id="kit-type" class="col-md-3">
								<select name="kitType" class="form-control">
								    @foreach ($types as $type)
						                @if ($type == $booking->kit_type)
								            <option value={{ $type }} selected>{{ $type }}</option>
								        @else
								            <option value={{ $type }}>{{ $type }}</option>
								        @endif
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
						            @foreach ($branch_codes as $i=>$code)
						                @if ($code == $booking->branch_code)
								            <option value={{ $code }} selected>{{ $code }} - {{ $branch_name[$i] }}</option>
								        @else
								            <option value={{ $code }}>{{ $code }} - {{ $branch_name[$i] }}</option>
								        @endif
								    @endforeach
								</select>
					        </div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
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
