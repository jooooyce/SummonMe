@extends('layouts.app')
@section('title')
Job Postings
@endsection

@section('content')

<?php
$ads = DB::table('ads') 
		->join('users', 'ads.user_id', '=','users.id')
		->where('datetimeDelivery', '>=', date("Y-m-d H:i:s"))
		->where('disabled', '=', false)
 		->select('ads.*', 'users.username')
		->get();
?>
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">Available Job Postings</div>
      <div class="panel-body">
      @if (session('send') == "You have successfully taken the job")              
                <div class="alert alert-success">
                  {{ session('send') }}
                </div> 
              @elseif (session('send'))

                <div  class="alert alert-danger">
                  {{ session('send') }}
                </div> 
              @endif
        <table id="table" class="display nowrap" cellspacing="0" width="100%" border="1px" method="POST" action="">
        <thead>
            <tr>
            <td>Description</td>
            <td>Price</td>
            <td>Category</td>
            <td>Pickup Address</td>
            <td>Dropoff Address</td>
            <td>Shopper</td>
            <td>Delivery</td>
            <td>Username</td>
            <td></td>
            </tr>
        </thead>
        <tbody id="tbody">
         @foreach ($ads as $ad)
			<?php
				if (count(DB::table('tblJobDriverAccept')->select('adID')->where('adID', $ad->id)-> where('accepted', true)-> where('cancelled', false)-> get()) == 0 and count(DB::table('tblJobDriverAccept')->select('adID')->where('adID', $ad->id) ->where('userWantsJob', $user->id) -> get()) == 0 )  {
			?> 
			 <tr>
			 	<td style='white-space: pre-wrap;'>{{ $ad->description}}</td> 
				<td style='white-space: pre-wrap;'>${{ number_format($ad->price, 2) }}</td>  
				<td style='white-space: pre-wrap;'>{{ $ad->category}}</td>
				<td style='white-space: pre-wrap;'>{{ $ad->pickupAddress}},<br/>{{ $ad->pickupCity}}, {{ $ad->pickupProvince}}<br/>{{ $ad->pickupPostalCode}}</td>
				<td style='white-space: pre-wrap;'>{{ $ad->dropoffAddress}},<br/>{{ $ad->dropoffCity}}, {{ $ad->dropoffProvince}}<br/>{{ $ad->dropoffPostalCode}}</td>
				<td style='white-space: pre-wrap;'>{{$ad->shopper? 'Yes' : 'No'}}</td>
				<td style='white-space: pre-wrap;'>{{$ad->datetimeDelivery}}</td>
				<td style='white-space: pre-wrap;'><a href="/profile/{{ $ad->user_id }}">{{ $ad->username}}</a></td>
				 <td>
				 <?php
					if ($ad->user_id != $user->id) {
				?>
				<button type="button" onClick="location.href='/takejob/{{ $ad->id }}'"  class="btn btn-sm btn-primary">Take Job</button>
				 <?php
 					} else {
					?>
				 		<button type="button" onClick="location.href='/takejob/{{ $ad->id }}'" class="btn btn-sm btn-primary disabled">Take Job</button>
					 <?php
					}
				?>
				 </td>
			 </tr>
			<?php
				}
			?>
	 		@endforeach
         
       </tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
 </div> 
 
<script type="text/javascript"> 
$(document).ready(function(){
    $('#table').DataTable(
	{
		responsive: true
	}
	);
});
</script>


<script src="http://code.jquery.com/jquery-1.12.4.js" ></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js" ></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
@endsection