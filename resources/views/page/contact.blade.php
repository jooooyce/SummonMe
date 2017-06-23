@extends('layouts.app') 

@section('title') Contact Us @endsection 

@section('content')
	 <div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Contact Us</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="">
							{{ csrf_field() }}
							@if (session('send') == 'Your Message Has Been Successfully Submitted') 	           
								<div class="alert alert-success">
									{{ session('send') }}
								</div> 
							@elseif (session('send'))
								<div class="alert alert-danger">
									{{ session('send') }}
								</div> 
							@endif	
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
								 <label id="nameUser" class="col-md-4 control-label" for="name">Name</label>

									<div class="col-md-6">
									<input type="text" required name="name" id="name" class="form-control" aria-describedby="nameUser" autofocus value="{{ old('name') }}" >

									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
								 <label id="emailUser" required class="col-md-4 control-label" for="email">Email</label>

									<div class="col-md-6">
									<input type="email" required name="email" id="email" class="form-control" aria-describedby="emailUser" value="{{ old('email') }}" >

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}"> 
								 <label id="userMessage" class="col-md-4 control-label" for="Message">How Can I Help You Today?</label>

									<div class="col-md-6">
									<textarea style="resize: none;" rows="7" name="message" class="form-control" id="message" required aria-describedby="userMessage" >{{ old('message') }}</textarea>

									@if ($errors->has('message'))
										<span class="help-block">
											<strong>{{ $errors->first('message') }}</strong>
										</span>
									@endif
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