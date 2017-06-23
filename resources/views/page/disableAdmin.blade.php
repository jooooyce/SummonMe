@extends('layouts.app') 

@section('title') Disable Admin @endsection 

@section('content')
	 <div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Make Admin a Regular User</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="">
							{{ csrf_field() }}
							@if (session('send') == "that user does not exist") 	           
							<div class="alert alert-danger">
								{{ session('send') }}
							</div> 
						@elseif (session('send'))
							
							<div class="alert alert-success">
								{{ session('send') }}
							</div> 
						@endif
							<div class="form-group"> 
								 <label id="nameUser" class="col-md-4 control-label" for="usernameAdmin">Username</label>

								<div class="col-md-6">
									<input type="input" required id="userName"  name="userName"> 
								</div>
							</div> 

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
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
    @endsection