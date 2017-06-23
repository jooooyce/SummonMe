@extends('layouts.app')
@section('title')
Report Resolution
@endsection

@section('content') 

<div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="panel panel-default">
     <div class="panel-heading">Report Resolution</div>
      <div class="panel-body">

<form>
  	{{ csrf_field() }}
  
  <div class="row">
      <div class="col-xs-3 col-sm-3">         
            <label>Report ID</label>    
            <p>@php echo($data->id) @endphp</p> 
      </div>
      <div class="col-xs-3 col-md-3">        
          <label>User Reported ID</label>    
          <p><a href='/profile/@php echo($data->userReported) @endphp'>@php echo($data->userReported) @endphp</a></p>
     </div>
      <div class="col-xs-3 col-md-3">        
          <label>User Reported By ID</label>    
          <p><a href='/profile/@php echo($data->userReportedBy) @endphp'>@php echo($data->userReportedBy) @endphp</a></p>
     </div>   
     <div class="col-xs-6 col-sm-6">
              <label>Date Created</label>  
              <p>@php echo($data->dateCreated) @endphp</p>
    </div>
 </div>
<br/>
 
  <div class="form-group"> 
        <label>Reported for</label><br/>  
        <div class="row">
          <div class="col-xs-6 ">
              @php echo($data->category) @endphp
          </div>       
        </div>
  </div>


  <div class="form-group">
    <label>Note</label>
    <textarea class="form-control" id="notes" style="resize: none;" name="notes" disabled>@php echo($data->notes) @endphp</textarea>
  </div>
</form>

<div class="form-group">
    <label>Decision Making</label><br/><br/>
    <form method="POST" action="enableUser/@php echo ($data->id) @endphp">
        <div class="col-xs-3 col-md-6">           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="enable" class="btn btn-primary">Enable User</button>
        </div>
    </form> 

    <form method="POST" action="disableUser/@php echo ($data->id) @endphp">
        <div class="col-xs-3 col-md-6">  
            <button type="submit" id="disable" class="btn btn-primary">Disable User</button>
        </div>
    </form>
</div>
		</div>
		</div>
		</div>
		</div>
	</div>

<script>$("#datetimepicker").datetimepicker();</script>



@endsection