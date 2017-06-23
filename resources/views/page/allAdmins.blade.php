@extends('layouts.app')
@section('title')
Admins
@endsection

@section('content')
			<?php
				$admins = DB::table('users')->where('admin','true')->get();
			?>
<div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">Admins</div>
      <div class="panel-body">
        <table id="table"  class="display nowrap" cellspacing="0" width="100%" border="1px" cellpadding="20px">
        <thead>
            <tr>
            <th>Username</th>
            <th>Email</th>
			<th>Phone</th>
            <th>Name</th>  
			<th>Created</th>  	
            </tr>
        </thead>
        <tbody id="tbody">

					@foreach ($admins as $admin)
					<tr>
						<td style='white-space: pre-wrap;'><a href="profile/{{ $admin->id }}">{{$admin->username}}</a></td> 
						<td style='white-space: pre-wrap;'>{{$admin->email}}</td>
						<td style='white-space: pre-wrap;'>{{"(".substr($admin->phone_number,0,3).") ".substr($admin->phone_number,3,3)."-".substr($admin->phone_number,6,4)}} 
						</td>
						<td style='white-space: pre-wrap;'>{{ $admin->first_name}} {{ $admin->last_name}}</td>  
						<td style='white-space: pre-wrap;'>{{$admin->created_at}}</td>
					</tr>
			
					@endforeach

        </tbody>
        </table>
     </div>
    </div>
   </div>
  </div>
 </div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
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