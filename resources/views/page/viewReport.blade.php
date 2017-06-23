@extends('layouts.app')
@section('title')
Report File
@endsection

@section('content') 

<div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">Report File</div>
      <div class="panel-body">
        @if (session('send'))

        <div class="alert alert-success">
         {{ session('send') }}
        </div> 
       @endif
        <table id="table"  class="display nowrap" cellspacing="0" width="100%" border="1px" cellpadding="20px">
        <thead>
            <tr>
            <td>Report ID</td>
            <td>User Reported</td>
            <td>User Reported By</td>
            <td>Category</td>
            <td>Notes</td>
            <td>Date</td>
			<td>Open/Closed</td>
            <td>Resolution</td>
            </tr>
        </thead>
        <tbody id="tbody">
			<?php
	$reported = DB::table('tblReportFiled')
        		->join('users as u1', 'u1.id', '=', 'tblReportFiled.userReported')
        	    ->join('users as u2', 'u2.id', '=', 'tblReportFiled.userReportedBy')
     			->select( 'u1.username as usersReported', 'u2.username as usersReportedBy',  'tblReportFiled.*' )
        	    ->get();
?>

         @foreach ($reported as $report)
			 
			 <tr>
			 	<td>{{ $report->id}}</td>  
				 <td style='white-space: pre-wrap;'><a href='\profile/{{$report->userReported}}'>{{$report->userReported}}</a></td>  
				 <td style='white-space: pre-wrap;'><a href='\profile/{{$report->userReportedBy}}'> {{$report->userReportedBy}}</a></td>
				 <td style='white-space: pre-wrap;'>{{$report->category}}</td>
				 <td style='white-space: pre-wrap;'>{{$report->notes}}</td>
				 <td style='white-space: pre-wrap;'>{{$report->dateCreated}}</td> 
				   <?php 
						if (count(DB::table('tblReportResolution')->select('reportID')->where('reportID', $report->id)->get()) == 0) {
							?>
							 <td>Open</td>
						<?php
						} 
						else {
						?>
				 			<td>Closed</td>
						<?php
						}

					 ?> 
			 	 <td style='white-space: pre-wrap;'><a href='/report/reportResolution/{{$report->id}}'>Make Decision</a></td>
			</tr>
			  
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