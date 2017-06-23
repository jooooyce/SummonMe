@extends('layouts.app')
@section('title')
 User Profile
@endsection

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
            <img src="/upload/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->username }}'s Profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile Image</label>
                <input type="file" required name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				        <div style="height: 5px"></div>
				        <button type="submit" class="btn btn-sm btn-primary">Update Image</button>
            </form>
    <br />
    <br />
          <form>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-8 col-sm-6">
                <label for="username">Username</label>
              </div>
              <div class="col-xs-8 col-sm-6">
                 <label for="username">{{ $user->username }}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-8 col-sm-6">
                <label for="email">Email</label>
              </div>
              <div class="col-xs-8 col-sm-6">
                 <label for="email">{{ $user->email }}</label>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="form-group">
              <div class="col-xs-8 col-sm-6">
                <label for="first_name">First Name</label>
              </div>
              <div class="col-xs-8 col-sm-6">
                 <label for="first_name">{{ $user->first_name }}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-8 col-sm-6">
                <label for="last_name">Last Name</label>
              </div>
              <div class="col-xs-8 col-sm-6">
                 <label for="last_name">{{ $user->last_name }}</label>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="form-group">
              <div class="col-xs-8 col-sm-6">
                <label for="phone_number">Phone Number</label>
              </div>
              <div class="col-xs-8 col-sm-6">
                 <label for="phone_number">{{ $user->phone_number }}</label>
              </div>
            </div>
          </div>
          <div class="form-group">
          <a class="btn pull-right btn-primary" href="/profile/{{$user->id}}/edit" role="button">Update</a>
         </div>
         </form>
        </div>
        </div>
     </div>
  </div>
</div>
@endsection
