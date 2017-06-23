@extends('layouts.app')
@section('title')
 Welcome
@endsection

@section('content')     

<div class="container-fluid" style="text-align: center; display: none;" id="homeContent"> 
	<img src="/images/logo.png" alt="Image of Robot Delivering Page" class="homeImage">
	<!--  image retrieved from http://publicdomainvectors.org/id/bebas-vektor/Robot-pengiriman-kotak-dengan-barang-barang-rapuh-vektor-ilustrasi/20886.html  -->
 	  <h1>Welcome to Summon Me!</h1>
	  <h2 style="font-style: italic;">Community Built on Delivery</h2>
</div>
<script>
$(document).ready(function() {
    $('#homeContent').fadeIn(3000);
});
</script>
@endsection