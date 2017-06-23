<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', 'AnyUserController@index');
Route::get('tip', 'AnyUserController@donate');
Route::get('about', 'AnyUserController@about');

Route::get('success', 'AnyUserController@success');
Route::get('cancel', 'AnyUserController@cancel');

Route::get('privacy', 'AnyUserController@privacy');

Route::get('user', 'AnyUserController@user');

Route::get('login', function () {
    return view('auth.login');
});

Route::post('login', 'LoginController@authenticated', function () {
		return view('page.home');
});

Route::get('register', 'RegisterController@create', function () {
    return view('auth.register');
});

Route::post('register', 'RegisterController@validator', function () {
    return view('page.home');
});

Route::get('contact', function () {
    return View::make('page.contact');
});

Route::post('contact', 'AnyUserController@contactPost');

Route::get('home', function () {
		return view('page.home');
});

Route::get('job/{jobID}/user/driver/cancel', function ($jobID) {
				DB::table('tblJobDriverAccept')
                    ->where('tblJobDriverAccept.adID', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
					->update(['cancelled' => true ]);
				return Redirect::back()->with("messageJob","Delivery has been cancelled");
});

Route::get('job/{jobID}/user/{driverID}/client/reject', function ($jobID, $driverID ) {
				DB::table('tblJobDriverAccept')
					->where('tblJobDriverAccept.adID', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $driverID)
					->update(['accepted' => false ]);
				return Redirect::back()->with("messageJob","You rejected the driver");
});

Route::post('job/{jobID}/user/{userID}', function ($jobID, $userID) {
	if(Auth::user() == false) {
		return redirect('/login');
	}
	$jobClient = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', Auth::user()->id )
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $userID)
                    ->count();


	$jobDriver = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', $userID)
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
                    ->count();

	if ($jobClient > 0 ) {
				$noteClient = filter_var(request('driverNotes'), FILTER_SANITIZE_STRING);

				DB::table('tblJobDriverAccept')
                    ->where('tblJobDriverAccept.adID', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $userID)
					->update(['noteClient' => $noteClient ]);


		$jobClient = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', Auth::user()->id )
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $userID)
                    ->get();
		return view('page.userOrder')->with(array('job'=>$jobClient));
	}
	else if ($jobDriver > 0 ) {
				$noteDriver = filter_var(request('clientNotes'), FILTER_SANITIZE_STRING);

				DB::table('tblJobDriverAccept')
                    ->where('tblJobDriverAccept.adID', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
					->update(['noteDriver' => $noteDriver ]);

	$jobDriver = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', $userID)
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
                    ->get();
		session()->flash("messageJob","Your note has been updated");
		return view('page.driverOrder')->with(array('job'=>$jobDriver));
	}
	 else {
		 return redirect('/allads');
	 }
});

Route::get('job/{jobID}/user/{userID}', function ($jobID, $userID) {
	if(Auth::user() == false) {
		return redirect('/login');
	}
	$jobClient = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', Auth::user()->id )
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $userID)
                    ->count();


	$jobDriver = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', $userID)
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
                    ->count();

	if ($jobClient > 0 ) {

		$jobClient = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', Auth::user()->id )
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', $userID)
                    ->get();
		return view('page.userOrder')->with(array('job'=>$jobClient));
	}
	else if ($jobDriver > 0 ) {


	$jobDriver = DB::table('ads')
					->join('tblJobDriverAccept', 'ads.id', '=', 'tblJobDriverAccept.adID')
					->select('ads.*', 'tblJobDriverAccept.*')
                    ->where('ads.user_id', $userID)
                    ->where('ads.id', $jobID)
					->where('tblJobDriverAccept.userWantsJob', Auth::user()->id)
                    ->get();
		return view('page.driverOrder')->with(array('job'=>$jobDriver));
	}
	 else {
		 return redirect('/allads');
	 }
});

Route::get('reported', function () {
		return view('page.userReported');

});

Route::get('profile/{id}',  function ($id) {
	 $ratingUsers = User::find($id);
	 return view('page.viewprofile',array('user'=>$ratingUsers));

});

Route::get('takejob/{id}','AdsController@takejob');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');
Route::get(' profile/{userid}/edit','UserController@editProfile');
Route::patch('profile/{userid}','UserController@updateProfile');

Route::get('orders', 'OrderController@allOrder');
Route::get('orders/driver', 'OrderController@allOrderDriver');

Route::get('/ads/create', 'AdsController@create');
Route::post('ads','AdsController@store');
Route::get('ads','AdsController@userIndex');
Route::get('allads', 'AdsController@allAds');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('addAdmin', 'AdminController@viewAddAdmin');
Route::post('addAdmin', 'AdminController@addAdmin');
Route::get('disableAdmin',"AdminController@viewDisableAdmin");
Route::post('disableAdmin',"AdminController@disableAdmin"); 
Route::get('alladmins', 'AdminController@allAdmins');

Route::get('viewDisabledUser','DisabledUserController@index');
Route::get('report/reportUser/{id}','DisabledUserController@report');
Route::post('report/reportUser/{id}','DisabledUserController@store');
Route::get('report/reportResolution/{id}','DisabledUserController@reportResolution');
Route::post('report/reportResolution/{id}','DisabledUserController@reportResolution');
Route::get('viewReport','DisabledUserController@viewReport');
Route::get('report/allReportResolution','DisabledUserController@allReportResolution');

Route::get('ads/editad','AdsController@viewEditAd');
Route::post('ads/editad/{adId}','AdsController@editAd');
Route::get('ads/editad/{adId}','AdsController@editAd');
Route::post('ads/update/{adId}',"AdsController@update");


Route::post('/completed/driver/{adId}',"OrderController@orderComplete");
Route::post('/completed/client/{adId}',"OrderController@userOrderComplete");

Route::post('report/reportResolution/disableUser/{id}','DisabledUserController@disableUser');
Route::post('report/reportResolution/enableUser/{id}','DisabledUserController@enableUser');
