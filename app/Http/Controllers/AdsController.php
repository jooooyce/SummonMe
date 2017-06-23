<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ad;

use DB;

use Auth;

use App\User;

use Carbon\Carbon;

class AdsController extends Controller
{

	 Public function userIndex()
	{

    	 if (Auth::guest())
         {
					    session()->flash('message','Sorry! You need login!');
              return redirect('/login');
         }

        else
        {

              $user = User::find(Auth::user()->id);
              $ads = Ad::where("user_id", "=", $user->id)->latest()->Paginate(5);
              return view('ads.index',compact('ads'));
        }
    }

     Public function show()
    {
		 if (Auth::guest())
         {
              return redirect('/login');
         }
    	 return view('ads.show');
    }


    Public function create(){
		if (Auth::guest())
         {
					    session()->flash('message','You need login to post an ad, please log in!');
              return redirect('/login');
         }
    	 return view('ads.create');
    }


     Public function store(){

			 $current = Carbon::now();
      $current = new Carbon();

			$current = $current->subHours(2);

		 if (Auth::guest())
         {
					 session()->flash('message','You need login to post an ad, please log in!');
              return redirect('/login');
         }

        $this->validate(request(),[

            'description'=>'required|max:225',
            'category'=>'required',
            'pickupAddress'=>'required|max:100',
            'pickupCity'=>'required|max:100',
            'pickupPostalCode'=>'required|max:7',
            'pickupProvince'=>'required|max:100',
            'dropoffAddress'=>'required|max:100',
            'dropoffCity'=>'required|max:100',
            'dropoffPostalCode'=>'required|max:7',
            'dropoffProvince'=>'required|max:100',
            'datetimeDelivery'=>'required|date|after:tomorrow',
            'price'=>'required|numeric',
        ] );

        $user = Auth::user();

        $value_to_insert = request('shopper') == 'true' ? 1 : 0;

        $user->ads()->create([
                'user_id' => $user->id,
                'description'=> request('description'),
                'shopper'=> $value_to_insert,
                'category'=> request('category'),
                'pickupAddress'=> request('pickupAddress'),
                'pickupCity'=> request('pickupCity'),
                'pickupPostalCode'=> request('pickupPostalCode'),
                'pickupProvince'=> request('pickupProvince'),
                'dropoffAddress'=> request('dropoffAddress'),
                'dropoffCity'=> request('dropoffCity'),
                'dropoffPostalCode'=> request('dropoffPostalCode'),
                'dropoffProvince'=> request('dropoffProvince'),
                'datetimeDelivery'=> request('datetimeDelivery'),
                'price'=> request('price'),
        ]);

				session()->flash('message','Congratulations! You created an ad successfully');

        return redirect()->intended('/home');

    }
    public function allAds()
    {
 		if (Auth::guest())
         {
              return redirect('/login');
         }
    	return view('page.allAds',array('user'=>Auth::user()));
    }
    public function viewEditAd()
    {
        if (Auth::guest())
         {
              return redirect('/login');
         }
        return view('ads.edit');
    }
    public function editAd($adId)
    {
		if (Auth::guest())
         {
              return redirect('/login');
         }
        $user = Auth::user();

        $job = DB::table('ads')->select('id','description', 'category',"pickupAddress", "pickupCity", "pickupPostalCode", "pickupProvince", "dropoffAddress", "dropoffCity", "dropoffPostalCode", "dropoffProvince", 'shopper', "datetimeDelivery", 'price')->where([['user_id',$user->id],['id',$adId]])->get();
        //echo $job;
        //validate data that was entered
        $description = $job[0]->description;
        // sets current user to $user
        //echo $description . "<----post";

        return view('ads.edit')->with('data',$job[0]);
    }

    public function update($adId)
    {
        DB::enableQueryLog();
		if (Auth::guest())
         {
              return redirect('/login');
         }

            $this->validate(request(),[

            'description'=>'required|max:225',
            'category'=>'required',
            'pickupAddress'=>'required|max:100',
            'pickupCity'=>'required|max:100',
            'pickupPostalCode'=>'required|max:7',
            'pickupProvince'=>'required|max:100',
            'dropoffAddress'=>'required|max:100',
            'dropoffCity'=>'required|max:100',
            'dropoffPostalCode'=>'required|max:7',
            'dropoffProvince'=>'required|max:100',
            'datetimeDelivery'=>'required|date|after:today',
            'price'=>'required|numeric',
            ] );


        // validate data

        //authenticate current user
        $user = Auth::user();

        $value_to_insert = request('shopper') == 'true' ? 1 : 0;
        //echo (request('datetimeDelivery'));

        // DB::table('ads')->where([['user_id',$user->id],['id',$adId]])->update(
        //     ['description' => request('description')],
        //     ['shopper'=> $value_to_insert,],
        //     ['category'=> request('category'),],
        //     ['pickupAddress'=> request('pickupAddress'),],
        //     ['pickupCity'=> request('pickupCity'),],
        //     ['pickupPostalCode'=> request('pickupPostalCode'),],
        //     ['pickupProvince'=> request('pickupProvince'),],
        //     ['dropoffAddress'=> request('dropoffAddress'),],
        //     ['dropoffCity'=> request('dropoffCity'),],
        //     ['dropoffPostalCode'=> request('dropoffPostalCode'),],
        //     ['dropoffProvince'=> request('dropoffProvince'),],
        //     ['datetimeDelivery'=> request('datetimeDelivery'),],
        //     ['price'=> request('price'),]
        //     );
            DB::table('ads')->where([['user_id',$user->id],['id',$adId]])->update(
                array
                    (
                        'description' => request('description'),
                        'shopper'=> $value_to_insert,
                        'category'=> request('category'),
                        'pickupAddress'=> request('pickupAddress'),
                        'pickupCity'=> request('pickupCity'),
                        'pickupPostalCode'=> request('pickupPostalCode'),
                        'pickupProvince'=> request('pickupProvince'),
                        'dropoffAddress'=> request('dropoffAddress'),
                        'dropoffCity'=> request('dropoffCity'),
                        'dropoffPostalCode'=> request('dropoffPostalCode'),
                        'dropoffProvince'=> request('dropoffProvince'),
                        'datetimeDelivery'=> request('datetimeDelivery'),
                        'price'=> request('price')
                    )
                );
        echo (request('description'));
        echo (request('price'));
        //dd(DB::getQueryLog());
        $message = "Your Job Has Been Updated";
        return redirect('ads')->with("send",$message);
    }
    public function takeJob($adId)
    {
		if (Auth::guest())
         {
              return redirect('/login');
         }
        $user = Auth::user();
        $userid = $user->id;

        $message = "You have successfully taken the job";

        $date = date('Y-m-d H:i:s');

        if (count(DB::table('ads')->select('id')->where('id', $adId)->get()) == 0)
        {
            $message = "That job does not exist";
        }
		else if (count(DB::table('ads')->select('id')->where('user_id','=',$userid)->where('id', $adId)->get()) != 0) {
			$message = "You cannot accept your own ad";
		}
		else if (count(DB::table('tblJobDriverAccept') ->select('tblJobDriverAccept.*')->where('adID', $adId)->where('cancelled', false)->where('accepted', true)->get()) != 0) {
			$message = "The job has already been taken";
		}
        else if (count(DB::table('ads')->select('id')->where('id', $adId)->where('cancelled', true)->get()) != 0)
        {
            $message = "That job has been cancelled";
        }

        else if (count(DB::table('ads')->select('id')->where('datetimeDelivery','>',$date)->where('id', $adId)->get()) != 1)
        {
            $message = "That job has expired";
        }
        else
        {
            DB::table('tblJobDriverAccept')->insert(
    			[
					'adID' => $adId,
					'userWantsJob' => $userid,
					'offeredDateTime' => date('Y-m-d H:i:s')

				]
			);

        }

        return redirect('allads')->with("send",$message);
    }
}
