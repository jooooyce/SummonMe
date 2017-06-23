@extends('layouts.app')
@section('title')
Report User
@endsection

@section('content') 

	<div>
		<div class="col-md-6 col-md-offset-3">
			<h1>Report User</h1>
			<hr/>

  <form method="POST" action="">

  	{{ csrf_field() }}
  
<!--   <div class="row">
      <div class="col-xs-3 col-sm-3">         
              <label for="pickupAddress">Report ID</label>    
              <input value="{{ old('reportId') }}" type="text" class="form-control" id="reportId" name="reportId" disabled/>   
      </div>
      <div class="col-xs-3 col-md-3">        
              <label for="userReported">Reported User</label>    
              <input value="{{ old('userReported') }}" type="text" class="form-control" id="userReported" name="userReported" disabled/>
     </div>       
     <div class="col-xs-3 col-sm-3">
              <label for="userReportedBy">Reported By</label>    
              <input value="{{ old('userReportedBy') }}" type="text" class="form-control" id="userReportedBy" name="userReportedBy" disabled/> 
      </div>
</div> 
</br> -->
 
  <div class="form-group"> 
        <label for="category">What is the issue?</label><br/>  
        <div class="row">
          <div class="col-xs-6 ">  
            <input checked="checked" type="radio" name="category" value="He/She cancelled a job 2 hours before delivery" />He/She cancelled a job 2 hours before delivery<br/>  
            <input checked="checked" type="radio" name="category" value="He/She is posting spam" />He/She is posting spam<br/>  
            <input checked="checked" type="radio" name="category" value="His/her account may be hacked" />His/her account may be hacked</br>
            <input checked="checked" type="radio" name="category" value="He/she is being abusive or harmful" />He/she is being abusive or harmful<br/>
          </div>       
        </div>
  </div>


  <div class="form-group">
    <label for="notes">Notes</label>
    <textarea value="{{ old('notes') }}" type="text" class="form-control" id="notes" name="notes"></textarea>
  </div>

  <div class="form-group">
  <button type="submit" id="submit" class="btn btn-primary">Submit</button>

 </div>
     
 </form>

<!-- <script type="text/javascript">
    
    $(document).ready(function(){


        $("#submit").click(function() {

          alert($('input[name=category]:checked').val());

        });

    });


</script> -->


		</div>
	</div>




@endsection
