@extends('bookings/bookingnav')

@section('content')
		
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
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
					<div class="panel-body">
					<?php
					    $eventName = preg_replace("/[-]/", " ", $event_name);
					?>
					Kit Name:             {{ $kit_name }}
					<br></br>
					Kit ID:               {{ $kit_id }}
					<br></br>
					Kit Type:             {{ $kitType }}
					<br></br>
					Event Name:           {{ $eventName }}
					<br></br>
					Start Date:           {{ $Start_Date }}
					<br></br>
					End Date:             {{ $End_Date }}
					<br></br>
					Location:             {{ $branch_code }}
					<br></br>
					Associated Employees: {{ $associated_names }}
					</div>
					<form class="form-horizontal" role="form" method="POST" action="store">
					
						<input type="hidden" class="form-control" name="kit_id" value={{ $kit_id }}>

						<input type="hidden" class="form-control" name="kitType" value={{ $kitType }}>
					    
						<input type="hidden" class="form-control" name="event_name" value={{ $event_name }}>
					    
						<input type="hidden" class="form-control" name="Start_Date" value={{ $Start_Date }}>

						<input type="hidden" class="form-control" name="End_Date" value={{ $End_Date }}>
						
						<input type="hidden" class="form-control" name="branch_code" value={{ $branch_code }}>
					    
						<input type="hidden" class="form-control" name="associated_users" value={{ $associated_users }}>
					    
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
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

