<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use App\User;
use File;
use DB;





class UserController extends Controller
{

    Public function profile(){

      if (Auth::guest())
        {
             session()->flash('message','Sorry! You need login!');
             return redirect('/login');

        }
        else
        {

            return view('page.profile',array('user'=>Auth::user()));
        }


    }

    Public function editProfile(){

        $user = User::find(Auth::user()->id);
       
      if (Auth::guest())
        {
             session()->flash('message','Sorry! You need login!');
             return redirect('/login');
        }
       else
       {

          return view('page.editprofile',compact('user'));
       }

    }

    Public function updateProfile(Request $request, User $user){

        $this->validate(request(),[
         'first_name' => 'required|max:100|alpha_dash',
         'last_name' => 'required|max:100|alpha_dash',
         'phone_number' => 'required|digits:10|numeric',

          ]);

        $user = User::find(Auth::user()->id);
        $user->phone_number= request('phone_number');
        $user->first_name = request('first_name');
        $user->last_name= request('last_name');
        $user->save();

        session()->flash('message','Your information updated!');

        return view('page.profile',compact('user'));

    }

    Public function allOrder(){

    	 return view('page.viewOrder',array('user'=>Auth::user()));
    }

    Public function allOrderDriver(){

    	 return view('page.viewOrderDriver',array('user'=>Auth::user()));
    }



    public function update_avatar(Request $request){

        $user = User::find(Auth::user()->id);

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($user->avatar !== 'default.png') {
                // $file = public_path('uploads/avatars/' . $user->avatar);
                $file = 'upload/avatars/' . $user->avatar;
                //$destinationPath = 'uploads/' . $id . '/';

                // if (File::exists($file)) {
                //     unlink($file);
                // }

            }
            Image::make($avatar)->resize(300, 300)->save(public_path('upload/avatars/' . $filename));
            // Image::make($avatar)->resize(300, 300)->save('upload/avatars/' . $filename);
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            session()->flash('message','You just updated your avatar!');
            return view('page.profile',array('user'=>Auth::user()));

        }
    }

    Public function driverOrder(){
        return view('page.driverOrder');
    }

    Public function viewOrder(){

        return view('page.userOrder');

    }



}
