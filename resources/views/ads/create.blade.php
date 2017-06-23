<!-- @extends('layouts.app') -->
@section('title')
 Create an Add
@endsection
@section('content')


@if (Auth::guest())

@else
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create An Ad</div>
                <div class="panel-body">

          <form method="POST" action="/ads">

            	{{ csrf_field() }}

             <div class="form-group @if ($errors->has('datetimeDelivery')) has-error @endif">
                 <label for="datetimeDelivery">Delivery Date</label>

                  <input type="text" id="datetimepicker" value="{{ old('datetimeDelivery') }}" class="form-control" id="datetimeDelivery" name="datetimeDelivery" title="When do you want to get your item?" />
                   @if ($errors->has('datetimeDelivery')) <p class="help-block">{{ $errors->first('datetimeDelivery') }}</p> @endif
            </div>

            <div class="form-group">
              <label for="category">Category</label>
              <select  id="category" name="category" class="form-control" title="What kind of item do you want delivery?">
              <option value="food">Food</option>
              <option value="groceries">Groceries</option>
              <option value="furniture">Furniture</option>
              <option value="electronics">Electronics</option>
              </select>
            </div>
            <div class="form-group">

                 <div class="form-group @if ($errors->has('price')) has-error @endif">
                    <label for="price">Job Rate</label>
                    <input value="{{ old('price') }}" class="form-control" id="price" type="number" min="0.01" step="0.01" title="Example: 12.00" name="price">
                    @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
                 </div>

           </div>

            <div class="form-group">
               <strong>Pick up:</strong>
            </div>

            <div class="row">
                <div class="col-xs-8 col-sm-5">
                    <div class="form-group @if ($errors->has('pickupAddress')) has-error @endif">
                        <label for="pickupAddress">Address</label>
                        <input value="{{ old('pickupAddress') }}" type="text"  class="form-control" id="pickupAddress"  name="pickupAddress" title="Where the driver pick up the item?">
                        @if ($errors->has('pickupAddress')) <p class="help-block">{{ $errors->first('pickupAddress') }}</p> @endif
                   </div>
                </div>
                <div class="col-xs-8 col-sm-3">
                    <div class="form-group @if ($errors->has('pickupCity')) has-error @endif">
                        <label for="pickupCity">City</label>
                        <input value="{{ old('pickupCity') }}" type="text"  class="form-control" id="pickupCity"  name="pickupCity" title="City where the driver pick up the item?" readonly>
                        @if ($errors->has('pickupCity')) <p class="help-block">{{ $errors->first('pickupCity') }}</p> @endif
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-md-3">
                     <div class="form-group @if ($errors->has('pickupPostalCode')) has-error @endif">
                        <label for="pickupPostalCode">Postal Code</label>
                        <input value="{{ old('pickupPostalCode') }}" type="text" class="form-control" id="pickupPostalCode" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" title="Example: A1A 1A1" name="pickupPostalCode">
                        @if ($errors->has('pickupPostalCode')) <p class="help-block">{{ $errors->first('pickupPostalCode') }}</p> @endif
                     </div>
               </div>
               <div class="col-xs-2 col-md-2">
              </div>
               <div class="col-xs-3 col-sm-2">
                    <div class="form-group">
                    <label for="pickupProvince">Province</label>
                    <input value="{{ old('pickupPostalCode') }}" id="pickupProvince"  name="pickupProvince" class="form-control" readonly>

        </div>
                </div>
          </div>
          <br/>

            <div class="form-group">
              <strong>Drop off:</strong>
            </div>

            <div class="row">
                <div class="col-xs-8 col-sm-5">
                    <div class="form-group @if ($errors->has('dropoffAddress')) has-error @endif">
                        <label for="dropoffAddress">Address</label>
                        <input value="{{ old('dropoffAddress') }}" type="text"  class="form-control" id="dropoffAddress"  name="dropoffAddress" title="Where the driver dropoff the item?">
                        @if ($errors->has('dropoffAddress')) <p class="help-block">{{ $errors->first('dropoffAddress') }}</p> @endif
                   </div>
                </div>
                <div class="col-xs-8 col-sm-3">
                    <div class="form-group @if ($errors->has('dropoffCity')) has-error @endif">
                        <label for="dropoffCity">City</label>
                        <input value="{{ old('dropoffCity') }}" type="text"  class="form-control" id="dropoffCity"  name="dropoffCity" title="City where the driver dropoff the item?" readonly>
                        @if ($errors->has('dropoffCity')) <p class="help-block">{{ $errors->first('dropoffCity') }}</p> @endif
                   </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-8 col-md-3">
                     <div class="form-group @if ($errors->has('dropoffPostalCode')) has-error @endif">
                        <label for="dropoffPostalCode">Postal Code</label>
                        <input value="{{ old('dropoffPostalCode') }}" type="text" class="form-control" id="dropoffPostalCode" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" title="Example: A1A 1A1" name="dropoffPostalCode">
                        @if ($errors->has('dropoffPostalCode')) <p class="help-block">{{ $errors->first('dropoffPostalCode') }}</p> @endif
                     </div>
               </div>
               <div class="col-xs-2 col-md-2">
              </div>
               <div class="col-xs-3 col-sm-2">
                    <div class="form-group @if ($errors->has('dropoffProvince')) has-error @endif">
                         <div class="form-group @if ($errors->has('dropoffProvince')) has-error @endif">
                          <label for="dropoffProvince">Province</label>
                          <input value="{{ old('dropoffProvince') }}" id="dropoffProvince" name="dropoffProvince" class="form-control" readonly>

                        </div>
                    </div>
                </div>
          </div>

            <div class="form-group">
                  <label for="shopper">Shopping involved?</label></br>
                  <div class="row">
                    <div class="col-xs-6 col-sm-4">
                      <input type="radio" name="shopper" value="true" title="Do you need the driver shop the item for you?(Yes)">Yes</br>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <input type="radio" checked="checked" name="shopper" value="false" title="Do you need the driver shop the item for you?(No)">No
                    </div>
                  </div>
            </div>


            <div class="form-group @if ($errors->has('description')) has-error @endif">
              <label for="description">Description</label>
              <textarea value="{{ old('description') }}" type="text" class="form-control" id="description"  name="description" title="Any other input?"></textarea>
                @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
            </div>

            <div class="form-group">
            <button type="submit" rel="tooltip" class="btn btn-primary" title="Ready? Post your ad!">Submit</button>
           </div>

           </form>
       </div>
            </div>
        </div>
    </div>
</div>
<script>
          $("#datetimepicker").datetimepicker();
    </script>

 @endif

@endsection
