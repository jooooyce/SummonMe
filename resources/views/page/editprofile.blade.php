@extends('layouts.app')
@section('title')
Edit Your Profile
@endsection

@section('content')

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Your Profile</div>
                <div class="panel-body">

              <form method="POST" action="/profile/{{ $user->id }}">

                {{ method_field('PATCH') }}

              <div class="form-group">

                  <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                  <div class="col-md-6">
                      <input type="tel" class="form-control" id="phone_number" name="phone_number" value="@php echo($user->phone_number) @endphp" required>
                      @if ($errors->has('phone_number'))
                          <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                              {{ $errors->first('phone_number') }}
                          </div>
                      @endif
                  </div>
              </div>

              <div class="form-group">

                  <label for="first_name" class="col-md-4 control-label">First Name</label>

                  <div class="col-md-6">
                      <input type="text" class="form-control" id="first_name" name="first_name" value="@php echo($user->first_name) @endphp" required>
                      @if ($errors->has('first_name'))
                          <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                              {{ $errors->first('first_name') }}
                          </div>
                      @endif
                  </div>
              </div>

              <div class="form-group">

                  <label for="last_name" class="col-md-4 control-label">Last Name</label>

                  <div class="col-md-6">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="@php echo($user->last_name) @endphp" required>
                      @if ($errors->has('last_name'))
                          <div style="margin-top: 6px; margin-bottom: 0px;  padding: 5px;" class="alert alert-danger">
                              {{ $errors->first('last_name') }}
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-8 col-md-offset-5">
                      <button type="submit" class="btn btn-primary">
                          Update
                      </button>
           </form>
       </div>
            </div>
        </div>
    </div>
</div>



@endsection
