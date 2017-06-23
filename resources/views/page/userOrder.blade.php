@extends('layouts.app')
@section('title')
Client Order Form
@endsection

@section('content')

<?php 
    $userCancelled = "No";
    $driverCancelled = "No";
    $completed = "No"; 
    if(DB::table('ads')->where('id', $job[0]-> id)->where('cancelled', true)->exists()) {
        $userCancelled = "Yes";   
    } else if($job[0]-> accepted == false) {
        $userCancelled = "Yes";   
    }
    
    if(DB::table('tblJobDriverAccept')->where('adID', $job[0]-> id)->where('userWantsJob', $job[0]-> userWantsJob)->where('cancelled', true)->exists()) {
        $driverCancelled = "Yes";
    }
    
    if($job[0]-> complete == true) {
        $completed = "Yes";
    }
 

?> 

     <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Client Order Form</div>
                    <div class="panel-body">

                        @if ($errors->has('star'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('star') }}</strong>
                                        </div>
                                    @endif
                        
                        @if ($errors->has('review'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('review') }}</strong>
                                        </div>
                                    @endif
                        
                        @if (session('messageJob'))                
                                <div class="alert alert-success">
                                    {{ session('messageJob') }}
                                </div> 
                        @endif

                        <?php
                            $driver = DB::table('users')  
                                    ->where('id', $job[0]->userWantsJob)
                                    ->get(); 

                        ?>
                        
                        <form class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            
                            <div class="form-group"> 
                                <label id="jobDescription" class="col-md-4 control-label" for="stillOn">Job Description</label>
                                <div class="col-md-6">
                                    <div class="input-group"> 
                                        <textarea style="resize: none;" readonly rows="1" 
                                                  aria-describedby="jobDescription" id="jobDescription" class="form-control">{{$job[0]-> description}}</textarea> 
                                        <span class="input-group-addon"><button title="Click Here To View Job Information" type="button" data-toggle="collapse" data-target="#hideJob" class="btn" id="job_info"><span id="jobSpanEye" class="glyphicon glyphicon-eye-open"></span></button></span>
                                     </div>
                                </div>
                            </div>
                             
                            <div id="hideJob" class="collapse"> 
                                
                                <div class="form-group"> 
                                    <label id="category" class="col-md-4 control-label" for="jobCat">Job Category</label>
                                    <div class="col-md-6">
                                         <p id="jobCat" readonly class="form-control">{{$job[0]-> category}}</p> 
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label id="client" class="col-md-4 control-label" for="stillOn">Shopper?</label> 
                                    <div class="col-md-6">                                  
                                        <p id="stillOn" class="form-control">{{$job[0]-> shopper }}</p> 
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label id="pick" class="col-md-4 control-label" for="pickUp">Pickup Location</label>
                                    <div class="col-md-6">
                                         <textarea style="resize: none;" readonly rows="4" 
                                                  aria-describedby="pick" id="pickUp" class="form-control">{{$job[0]-> pickupAddress}},&#13;&#10;{{$job[0]-> pickupCity}},&#13;&#10;{{$job[0]-> pickupProvince }}&#13;&#10;{{$job[0]-> pickupPostalCode}}</textarea>  
                                    </div>
                                </div>      
                                
                                <div class="form-group"> 
                                    <label id="drop" class="col-md-4 control-label" for="dropOff">Dropoff Location</label>
                                    <div class="col-md-6">
                                         <textarea style="resize: none;" readonly rows="4" 
                                                  aria-describedby="drop" id="dropOff" class="form-control">{{$job[0]-> dropoffAddress}},&#13;&#10;{{$job[0]-> dropoffCity}},&#13;&#10;{{$job[0]-> dropoffProvince }}&#13;&#10;{{$job[0]-> dropoffPostalCode}}</textarea>  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="stillOn">Payment Due</label> 
                                    <div class="col-md-6">                                  
                                        <p id="stillOn" class="form-control">${{$job[0]->price}}</p> 
                                </div>
                            </div>

                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="stillOn">Completed?</label> 
                                    <div class="col-md-6">                                  
                                        <p id="stillOn" class="form-control">{{ $completed }}</p> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="stillOn">Job Cancelled By Driver?</label> 
                                    <div class="col-md-6">                                  
                                        <p id="stillOn" class="form-control">{{ $driverCancelled }}</p> 
                                </div>
                            </div>
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="stillOn">Job Cancelled By You?</label> 
                                    <div class="col-md-6">                                  
                                        <p id="stillOn" class="form-control">{{ $userCancelled }}</p> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="name">Driver Profile</label>

                                    <div class="col-md-6">                                  
                                        <a href="/profile/{{$job[0]->userWantsJob}}" class="form-control">{{$driver[0]->username}}</a> 
                                </div>
                                <button type="button" onclick="window.location.href='{{$driver[0]->id}}/client/reject'" class="btn btn-primary" id="reject" name="reject" title="Click here to reject driver">Reject</button>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="name">Driver Email</label>

                                    <div class="col-md-6">                                  
                                        <a href="mailto:{{$driver[0]->email}}" class="form-control">{{$driver[0]->email}}</a> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="name">Driver Phone Number</label>

                                    <div class="col-md-6">                                  
                                        <p class="form-control">{{$driver[0]->phone_number}}</p> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="client" class="col-md-4 control-label" for="name">Driver Notes</label>

                                    <div class="col-md-6">                                  
                                        <textarea readonly style="resize: none;" rows="3"  class="form-control">{{$job[0]->noteDriver}}</textarea> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                 <label id="notesToDriver" class="col-md-4 control-label" for="driverNotes">Notes For Driver</label>

                                    <div class="col-md-6">
                                    <textarea pattern="![^a-zA-Z0-9]" style="resize: none;" rows="7" name="driverNotes" class="form-control" id="driverNotes" required aria-describedby="notesToDriver" >{{$job[0]->noteClient}}</textarea>
                                     
                                </div>
                            </div>
                            
                            
                            <div class="form-group" id='buttonRemove'>
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" id="submit_note" class="btn btn-primary">
                                        Submit Note
                                    </button>
                             
                                    <button type="button" id="job_complete" data-toggle="modal" data-target="#jobCompleted" class="btn btn-success">Job Completed</button> 

                                    <button type="button" id="cancel_job" data-toggle="modal" data-target="#cancelled" class="btn btn-danger">
                                        Cancel Job
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jobCompleted" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Job Completed</h4>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="/completed/client/{{$job[0]-> adID}}">
                    <div class="modal-body" style="text-align: center;">
                        
                        <div class="form-group"> 
                              <label class="col-sm-2 control-label">Rating</label>
                                <div class="col-sm-10" style="width: 50.3%;"> 
                                <input value="5" class="star star-5" id="star-5" type="radio" name="star"/>
                                <label class="star star-5" for="star-5"></label>
                                <input value="4" class="star star-4" id="star-4" type="radio" name="star"/>
                                <label class="star star-4" for="star-4"></label>
                                <input value="3" class="star star-3" id="star-3" type="radio" name="star"/>
                                <label class="star star-3" for="star-3"></label>
                                <input value="2" class="star star-2" id="star-2" type="radio" name="star"/>
                                <label class="star star-2" for="star-2"></label>
                                <input value="1" class="star star-1" id="star-1" type="radio" name="star" />
                                <label class="star star-1" for="star-1"></label> 
                                </div> 
                            </div> 
                            
                        <div class="form-group"> 
                              <label class="col-sm-2 control-label">Review</label>
                                <div class="col-sm-10" > 
                                  <textarea style="resize: none;" rows="3" name="review" class="form-control" id="review" required aria-describedby="userMessage" >{{ old('review') }}</textarea>

                                </div> 
                            </div>                  
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
              </div>
          </div>
    </div>

    <div class="modal fade" id="cancelled" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cancel Job</h4>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <p>Please note that cancelling a job 2 hours before delivery is a reportable offense.<br/> Please discuss all cancellations with client.</p>
                    </div>
                    <div class="modal-footer">
                        <form enctype="multipart/form-data" action="/cancel" method="POST">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </div>
          </div>
    </div>

<script> 
     $( "#job_info" ).on( "click", function() {
        if($( "#jobSpanEye" ).hasClass("glyphicon glyphicon-eye-open")) {
            $( "#jobSpanEye" ).removeClass("glyphicon glyphicon-eye-open");
            $( "#jobSpanEye" ).addClass('glyphicon glyphicon-eye-close'); 
            $( "#job_info" ).attr( "title", "Click Here To Hide Job Information" ); 
        }
        else {
            $( "#jobSpanEye" ).removeClass("glyphicon glyphicon-eye-close");
            $( "#jobSpanEye" ).addClass('glyphicon glyphicon-eye-open');
            $( "#job_info" ).attr( "title", "Click Here To View Job Information" ); 
        }
    });

    <?php
    if($userCancelled == "Yes" or $driverCancelled == "Yes" or $completed == "Yes") {
        
    ?>
        $( "#submit_note" ).remove();
        $( "#job_complete" ).remove();
        $( "#cancel_job" ).remove();
        $( "#reject" ).remove();
    <?php
    }
    ?> 
         
</script>




@endsection
