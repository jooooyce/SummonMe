<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Summon\Http\Requests;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminController extends Controller
{
    

    public function viewAddAdmin()
    {
        return view('page.addAdmin');
    }
    public function addAdmin(Request $request)
    {
    	$message = "";
    	echo $request->input("userName");
    	$username = $request->input("userName");
    	$this->validate($request, ['userName' => 'required|alpha_num|max:50']);

    	if (DB::table('users')->where('username', $username)->exists()) 
    	{
   			DB::table('users')->where('username', $username)->update(['admin' => true]);
   			$message = $username . " is now an admin";
		}
		else
		{
			$message = "that user does not exist";
		}

    	return redirect('addAdmin')->with("send",$message);
    }
     public function viewDisableAdmin()
    {
        return view('page.disableAdmin');
    }
    public function disableAdmin(Request $request)
    {
    	$message = "";
    	echo $request->input("userName");
    	$username = $request->input("userName");
    	$this->validate($request, ['userName' => 'required|alpha_num|max:50']);

    	if (DB::table('users')->where('username', $username)->exists()) 
    	{
   			DB::table('users')->where('username', $username)->update(['admin' => false]);
   			$message = $username . " is no longer an admin";
		}
		else
		{
			$message = "that user does not exist";
		}

    	return redirect('disableAdmin')->with("send",$message);
    }
 
    public function allAdmins()
    {
		
    	return view('page.allAdmins');
    }

    public function __construct()
    {
        
        $this->middleware('AdminOnly');
        // $this->middleware(function ($request, $next) {
        //     $user = Auth::user();
        //     //echo ($user);
        //     if (isset($user))
        //     {
        //         if($user->admin) 
        //         {
        //             return $next($request); // allow admin to continue to desination
        //         }
        //         else
        //         {

        //             return redirect()->intended('/'); // send user back to home page
        //         }
        //     }
        //     else
        //     {
        //         return redirect()->intended('/');
        //     }
            
        // });
    }
}
