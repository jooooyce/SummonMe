<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Summon\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;


class OrderController extends Controller
{
     Public function orderComplete($adID){
		  
		 $this->validate(request(),[
            'star'=>'required',
            'review'=>'required',
        ] );
		 
		DB::table('tblJobDriverAccept')  
          	->where('adID', $adID)
		  	->where('userWantsJob', Auth::user()->id)
			->where('cancelled', false)
			->where('accepted', true)
			->where('completed', false)
		 	->update(['completed' => true ]);
		
		 if(DB::table('tblJobDriverAccept')->where('adID', $adID)->where('userWantsJob',  Auth::user()->id)->where('completed', true)->exists()) {
			 
			DB::table('tblRating')->insert(
                [
                    'userRating' => Auth::user()->id,
                    'adID' => $adID,
					'category'=> 'Driver',
					'notes'=> request('review'),
                    'rating'=> request('star'), 
                    'ratingDateTime' => date('Y-m-d H:i:s')
                ]
            );
		} 
		 
         return Redirect::back()->with("messageJob","Job is Now Complete");
     }

     Public function userOrderComplete($adID){
      
     $this->validate(request(),[
            'star'=>'required',
            'review'=>'required',
        ] );
     
      DB::table('ads')  
            ->where('id', $adID)
            ->where('user_id', Auth::user()->id)
            ->where('cancelled', false)
            ->where('complete', false)
            ->update(['complete' => true ]);
    
      if(DB::table('ads')->where('id', $adID)->where('user_id',  Auth::user()->id)->where('complete', true)->exists()) {
       
      DB::table('tblRating')->insert(
                [
                    'userRating' => Auth::user()->id,
                    'adID' => $adID,
                    'category'=> 'Client',
                    'notes'=> request('review'),
                    'rating'=> request('star'), 
                    'ratingDateTime' => date('Y-m-d H:i:s')
                ]
            );
    } 
    	
     

         return Redirect::back()->with("messageJob","Job is Now Complete");
     }


     Public function driverOrder(){
         return view('page.driverOrder');
     }

     Public function allOrder(){

       if (Auth::guest())
         {
              return redirect('/login');
         }
        else
        {
          $json = "";
            $user = User::find(Auth::user()->id);
          $orders = DB::table('tblJobDriverAccept')
                    ->join('ads', 'tblJobDriverAccept.adID', '=', 'ads.id')
                    ->join('users','ads.user_id','=','users.id')
                    ->where('users.id',$user->id)
                    ->where('tblJobDriverAccept.accepted','true')
                    ->where('tblJobDriverAccept.cancelled','false')
                    ->select('users.*','ads.*','tblJobDriverAccept.*')
                    ->get();

          $json = $orders->toJson();
          session()->put("json",$json);

          return view('page.viewOrder', ['orders' => $orders]);
        }

     }

      public function allOrderDriver()
      {
        if (Auth::guest())
          {
               return redirect('/login');
          }
         else
         {
           $json = "";
           $user = User::find(Auth::user()->id);
           $orders = DB::table('tblJobDriverAccept')
                     ->join('ads', 'tblJobDriverAccept.adID', '=', 'ads.id')
                     ->join('users','ads.user_id','=','users.id')
                     ->where('tblJobDriverAccept.userWantsJob',$user->id)
                     ->where('tblJobDriverAccept.accepted','true')
                     ->where('tblJobDriverAccept.cancelled','false')
                     ->select('users.*','ads.*','tblJobDriverAccept.*')
                     ->get();

           $json = $orders->toJson();
           session()->put("json",$json);

           return view('page.viewOrderDriver', ['orders' => $orders]);

      }
    }

}
