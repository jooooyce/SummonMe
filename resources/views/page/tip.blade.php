@extends('layouts.app')
@section('title')
Tip Jar
@endsection

@section('content')     

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Thanks For The Continued Support!</div>
                <div class="panel-body" >
					 
                    <form class="form-horizontal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        {{ csrf_field() }} 
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="E2H89BH4QJQZW"> 
						<div class="form-group"> 
							<input type="hidden" name="on0" value="Tip Amount">
                             <label class="col-md-4 control-label" for="tip">Tip Amount</label>
								
								<div class="col-md-6">
                                <select name="os0" class="form-control" >
									<option value="One Dollar:">$1.00 CAD</option>
									<option value="Two Dollars:">$2.00 CAD</option>
									<option value="Five Dollars:">$5.00 CAD</option>
									<option value="Ten Dollars:">$10.00 CAD</option>
									<option value="Twenty Dollars:">$20.00 CAD</option>
									<option value="Fifty Dollars:">$50.00 CAD</option>
									<option value="One Hundred Dollars:">$100.00 CAD</option>
								</select> 
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                	Submit
                                </button>
                            </div>
							</div> 
                    </form>
					</div>
                </div>
            </div>
        </div>
    </div> 
@endsection