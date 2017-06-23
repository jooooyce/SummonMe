@extends('layouts.app')
@section('title')
Disabled Users
@endsection

@section('content')
<div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">All Disabled Users</div>
      <div class="panel-body"> 
			<table id="table"  class="display nowrap" cellspacing="0" width="100%" border="1px" cellpadding="20px">
				<thead>
					<tr>
						<th>User Name</th>
						<th>Profile</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->username }}</td>
						<td><a href="profile/{{ $user->id }}">View Profile</a></td>
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