@extends('layouts.app')
@section('title')
View Order Driver
@endsection
@section('content')
	<div class="container">
	 <div class="row">
		 @if (session('send'))
 <div class="alert alert-success">
	 {{ session('send') }}
 </div>
	@endif
		 <div class="col-md-8 col-md-offset-2">
			 <div class="panel panel-default">
				 <div class="panel-heading">View Driver Order Form</div>
				 <div class="panel-body">
							<ul class="nav nav-tabs">
							 <li name="1"><a href="/orders">Client</a></li>
							 <li class="active" name="1"><a href="/orders/driver">Driver</a></li>
						 </ul>
					 	<br /> 
						 <table id="table" class="display nowrap" cellspacing="0" width="100%">
							 <thead>
								 <tr>
									 <th>Job ID</th>
									 <th>Date Delivery</th>
									 <th>Description</th>
									 <th>Details</th>
								 </tr>
							 </thead>
						 <tbody id="tbody">
							 @foreach ($orders as $order)
						 <tr>
							 <td style='white-space: pre-wrap;'>{{ trim($order->adID) }}</td>
							 <td style='white-space: pre-wrap;'>{{ $order->datetimeDelivery }}</td>
							 <td style='white-space: pre-wrap;'>{{ $order->description }}</td>
						 <td style='white-space: pre-wrap;'><a href="/job/{{ $order->adID }}/user/{{ $order->user_id  }}">View</a></td>
						 </tr>
						 @endforeach

						 </tbody>
					 </table>
				 </div>
			 </div>
		 </div>
	 </div>
 </div>
 <script>


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
