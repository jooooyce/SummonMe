<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use Summon\Http\Requests;

use Mail;

use Summon\Mail\MyTestMail;

class AnyUserController extends Controller
{ 

     public function success()
    {
        return redirect('tip')->with('message', 'Your Donate Has Successfully Been Processed');
    }    

     public function cancel()
    {
        return redirect('tip')->with('message', 'Your Donate Was Cancelled');
    }
	
    public function index()
    {
        return view('page.welcome');
    }

    public function about()
    {
        return view('page.about');
    }

    public function privacy()
    {
        return view('page.privacy');
    }

    public function donate()
    {
        return view('page.tip');
    }

    public function dashboard()
    {
        return view('page.home');
    }

    public function user()
    {
        return view('page.userpolicy');
    }
    public function contactPost(Request $request)
    {
			$this->validate($request, [
			'name' => 'required|alpha|max:50',
			'email' => 'required|email',
			'message' => 'required|max:10000|alpha_dash'
		]);

		$message = 'Email: '.$request['email']."\r\n";
		$message .= 'Name: '.$request['name']."\r\n==================================================\r\n";
		$message .= wordwrap($request['message'], 70, "\r\n");

		$checkMailed =  Mail::raw($message, function ($messages) {
				$messages->to('summonapplication@gmail.com', 'Contact')->subject('Contact Us');
			});

		if(Mail::failures()) {
			return redirect('contact')->with('send', 'An Error Occurred. Please Try Again Later');
		} 
		else {
			return redirect('contact')->with('send', 'Your Message Has Been Successfully Submitted');
		} 
    }
}
 

