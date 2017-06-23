
@extends('layouts.app')
@section('title')
 User Profile
@endsection

@section('content') 
<?php
 
    if (Auth::guest()) {
		?>
	<script>
			window.location.href = "/login";
</script>
	<?php
		 
	}
  ?>
<?php
	$ratingUsers = DB::table('tblRating')    
					->join('ads', 'tblRating.adID', '=', 'ads.id')
					->join('users', 'users.id', '=', 'tblRating.userRating') 
					->join('tblJobDriverAccept', 'tblJobDriverAccept.adID', '=', 'tblRating.adID') 

					->select('tblRating.*', 'users.username')
					->where('tblRating.userRating', '<>', $user->id )
					->where('tblJobDriverAccept.cancelled', '<>', true )
					->where('tblJobDriverAccept.accepted', '<>', false )
			 		->where('tblJobDriverAccept.userWantsJob', '=', $user->id  )
					->orWhere([
    					['ads.user_id', '=', $user->id ],
    					['tblRating.userRating', '<>', $user->id],
							])	
                	->get();
	?> 
 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> 
            <img src="/upload/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin:10px;">
            <h2>About {{ $user->username }}</h2>
            	<div class="col-sm-12" style="width: 49.9%;" > 
                	<label for="starAverage">Average Rating:</label>
					<p id="starAverage"> 
						@for ($i = 0; $i <  round($ratingUsers->avg('rating')) ; $i++)
							★
						@endfor 
						<?php
							if($i < 1) {
								echo 'N/A';
							} else {
								echo '/ ★ ★ ★ ★ ★';				
							}
						?>
						
						</p>
 
          <button type="button" onClick="location.href='/report/reportUser/{{ $user->id }}'" class="btn btn-primary" name="report" title="Click here to report user">Report</button>
						<br/> <br/> <br/>
			</div>    
            <div class="panel-body">
				
				<table id="table" class="display nowrap" cellspacing="0" width="100%">
							 <thead>
								 <tr>
									 <th>Username</th>
									 <th>Type</th>
									 <th>Notes</th>
									 <th>Rating</th>
									 <th>Date</th>
								 </tr>
							 </thead>
						 <tbody id="tbody">
							 
							 @foreach ($ratingUsers as $ratingUser)
							 <tr>
							 <td style='white-space: pre-wrap;'><a href="/profile/{{ $ratingUser->userRating }}">{{$ratingUser->username}}</a></td>
							 <td style='white-space: pre-wrap;'>{{ $ratingUser->category }}</td>
							 <td style='white-space: pre-wrap;'>{{ $ratingUser->notes }}</td>
							 <td>  
								 @for ($i = 0; $i < $ratingUser->rating ; $i++)
									★
								@endfor 
							 </td>
							 <td style='white-space: pre-wrap;'>{{ $ratingUser->ratingDateTime }}</td> 
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
		});
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