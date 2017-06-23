@extends('layouts.app')
@section('title')
Report Resolution
@endsection

@section('content') 

<div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">All Report Resolution</div>
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
			<td>Reported Username</td>	
            <td>Admin Username</td>
            <td>Date Decision</td>
            <td>Decision</td> 
            <td>Notes</td>
            </tr>
        </thead>
        <tbody id="tbody">
			 
            <?php
            $resolutions = DB::table('tblReportResolution')
     			->select( 'tblReportResolution.*', 'users.username', 'tblReportFiled.userReported' )
				->join('users', 'users.id', '=', 'tblReportResolution.admin_username') 
				->join('tblReportFiled', 'tblReportFiled.id', '=', 'tblReportResolution.reportID') 
        	    ->get();
            ?>
            

         @foreach ($resolutions as $resolution)
			 <?php
				$reportID= DB::table('users')->select('username')->where('id',$resolution->userReported)->get();
			?>
			
			 <tr>  
				 <td style='white-space: pre-wrap;'><a href='/report/reportResolution/{{$resolution->reportID}}'>{{$resolution->reportID}}</a></td> 
				 <td style='white-space: pre-wrap;'><a href='/profile/{{$resolution->userReported}}'>{{$reportID[0]->username}}</a></td>
				 <td style='white-space: pre-wrap;'><a href='/profile/{{$resolution->admin_username}}'>{{$resolution->username}}</a></td>
                 <td style='white-space: pre-wrap;'>{{$resolution->dateDecisionMade}}</td>
                 <td style='white-space: pre-wrap;'>{{$resolution->decision}}</td> 
                 <td style='white-space: pre-wrap;'>{{$resolution->notes}}</td>  
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
		responsive: true,
		"order": [[ 3, "desc" ]]
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