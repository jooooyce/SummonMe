@extends('layouts.app')
@section('title')
 Dashboard
@endsection

@section('content')

<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Welcome Back {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}.</h3></div>

                <div class="panel-body">
			   <div class="about-details text-center">
					<h4><i class="fa fa-desktop fa-fw"></i><strong>&nbsp; What Do You Want To Do Today?</strong></h4>
				</div>
            <br/>

            <div id ="about" class="about-area page-scroll area-padding">
            <div class="container">

                <div class="row second-row">
                    <!-- Images from http://fontawesome.io/-->
                    <div class="col-md-3 hidden-sm">
                        <div class="about-details text-center">
                            <div class="single-about">
                                <a class="about-icon" href="/ads/create"><i class="fa fa-file-text-o fa-5x"></i></a>
                                <p>Post Your New Ads</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 hidden-sm">
                        <div class="about-details text-center">
                            <div class="single-about">
                                <a class="about-icon" href="/ads"><i class="fa fa-hand-o-up fa-5x"></i></a>
                                <p>View Your Ads</p>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 hidden-sm">
                        <div class="about-details text-center">
                            <div class="single-about">
                                <a class="about-icon" href="/allads"><i class="fa fa-send-o fa-5x"></i></a>
                                <p>Ad Page</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 hidden-sm">
                        <div class="about-details text-center">
                            <div class="single-about">
                                <a class="about-icon" href="/orders"><i class="fa fa-folder-open-o fa-5x"></i></a>
                                <p>View Your Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>



@endsection
