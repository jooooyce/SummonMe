@extends('layouts.app')
@section('title')
 Register
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        
                        @if (session('send') == 'You Have Been Successfully Registered!')
								<div style="margin-top: 0px; margin-bottom: 6px;  padding: 5px;" class="alert alert-success">
									{{ session('send') }}
								</div>
						@elseif (session('send'))
						 		<div style="margin-top: 6px; margin-bottom: 6px;  padding: 5px;" class="alert alert-danger">
									{{ session('send') }}
								</div>
						@endif
                        
                        <div class="form-group">
                            
                            <label for="username" class="col-md-4 control-label">Username</label>
                            
                            <div class="col-md-6">                            
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif	
                            </div>                       
                        </div>
                        
                        <div class="form-group">
                            
                            <label for="email" class="col-md-4 control-label">Email</label>
                            
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif	
                            </div>                            
                        </div>
                        
                        <div class="form-group row">
                            
                            <label for="first_name" class="col-md-4 control-label">First Name</label>
                            
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @if ($errors->has('first_name'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif
                            </div>                            
                        </div>
                        
                        <div class="form-group row">
                            
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>
                            
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <label for="password" class="col-md-4 control-label">Password</label>
                            
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                                @if ($errors->has('password'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <label for="confirm_password" class="col-md-4 control-label">Confirm Password</label>
                            
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}" required>
                                @if ($errors->has('confirm_password'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('confirm_password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
                            
                            <div class="col-md-6">
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                @if ($errors->has('phone_number'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('phone_number') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <a for="user_policy_accepted" class="btn btn-link" href="/user">
                                I Agree to the Terms of Service</a>                           
                            
                                <input type="checkbox" id="user_policy_accepted" name="user_policy_accepted" value="yes" {{ old('user_policy_accepted') ? 'checked' : '' }}>
                                @if ($errors->has('user_policy_accepted'))
                                    <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                                        {{ $errors->first('user_policy_accepted') }}
                                    </div>
                                @endif
                            </div>
                        </div>       
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Already a Member? Log In!
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
