@extends('layouts.app')
@section('title')
 Your Ad
@endsection

@section('content')     
<div>
@if (session('send'))
	<div class="alert alert-success">
		{{ session('send') }}
	</div> 
@endif
	<div class="col-md-6 col-md-offset-3">
    	<h1> All Your Ads</h1>
	    <ul class="list-group">
		    @foreach ($ads as $ad)	       
			        <li class="list-group-item">
			        	<div class="table-responsive">
						<table id="adCreateTable" tyle="border-top: none;">						 
							 <th  id="adCreate1" style="border-top: none;">
							 	Description: {{ $ad->description }} 
							 
							 </th>							
					        <tr id="adCreate2">
					        	<td style="border-top: none;">{{ $ad->created_at->diffForHumans() }} </td>
					        </tr>
					        <tr id="adCreate3">
					        	<td style="border-top: none;">Category: {{ $ad->category }} </td>
					        	<td style="border-top: none;"></td>
					        		<!-- <a style="float:right" href="/ads/{{ $ad->id }}">Edit</a> -->	
					        					        	
					        </tr>
					        	<form method="POST" action="ads/editad/{{$ad->id}}">
					        		<button id="editButton" name="editButton" style="float:right" type="submit" class="btn btn-primary">Edit</button>
					        	</form> 
					               			        	 
						 </table>
						</div>	        	
			        </li>		         
		       
		    @endforeach 
	   	</ul>
	  <?php echo $ads->links(); ?>
	</div>
</div>

<script type="text/javascript">
	/*$( document ).ready(function()
	{
		$('#editButton').on("click",function (e) {
			console.log(this.getAttribute("value"));
			//$.post('ads/edit',this.getAttribute("value"));

		})
	});*/
</script>
@endsection 