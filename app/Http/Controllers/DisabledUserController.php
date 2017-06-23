<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use App\User;

class DisabledUserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('disabled', 'True')->get();

        return view('page.viewDisabledUser', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('report.reportResolution');
    }

    public function report($id)
    {
        $user = User::find($id);
        return view('report.reportUser');
    }

    public function viewReport()
    { 
        return view('page.viewReport');
    }
    
    public function allReportResolution()
    {
        return view('report.allReportResolution');
    }

    public function reportResolution($id)
    {
        $user = Auth::user();

        $report = DB::table('tblReportFiled')->select('id','userReported', 'userReportedBy',"category", "notes", "dateCreated")->where('id',$id)->get();
//
//        $userReported = $report[0]->userReported;
//        echo ($report);
        return view('report.reportResolution')->with('data',$report[0]);
    }
    
    public function disableUser($id)
    {
        DB::enableQueryLog();
//        echo ("HIIII");
        $user_id = DB::table('tblReportFiled')->select('userReported')->where('id',$id)->get();
//        echo ($user_id[0]->userReported );
        
        DB::table('tblReportResolution')->insert(
                [
                    'reportID' => $id,
                    'admin_username' => Auth::user()->id,
                    'dateDecisionMade'=> date('Y-m-d H:i:s'),
                    'decision'=> 'disable',
                    'notes' => ''

                ]
            );
        DB::table('users')->where('id',$user_id[0]->userReported)->update(['disabled'=>'true']);
//        dd(DB::getQueryLog());
        $message = "User has been disabled";
        return redirect('viewReport')->with("send",$message);
    }
    
    public function enableUser($id)
    {
//        DB::enableQueryLog();
//        echo ("HIIII");
        $user_id = DB::table('tblReportFiled')->select('userReported')->where('id',$id)->get();
//        echo ($user_id[0]->userReported );
        
        DB::table('tblReportResolution')->insert(
                [
                    'reportID' => $id,
                    'admin_username' => Auth::user()->id,
                    'dateDecisionMade'=> date('Y-m-d H:i:s'),
                    'decision'=> 'enable',
                    'notes' => ''

                ]
            );
        DB::table('users')->where('id',$user_id[0]->userReported)->update(['disabled'=>'false']);
//        dd(DB::getQueryLog());
        $message = "User has been enabled";
        return redirect('viewReport')->with("send",$message);
    }
    

     Public function store($id){

        $user = User::find($id);

        // $user->tblReportFiled()->create([
        //         'userReported' => $user->id,
        //         'userReportedBy' => Auth::user()->id,
        //         'category'=> request('category'),
        //         'notes'=> request('notes'),


        // ]);

        DB::table('tblReportFiled')->insert(
                [
                    'userReported' => $user->id,
                    'userReportedBy' => Auth::user()->id,
                    'category'=> request('category'),
                    'notes'=> request('notes'),
                    'dateCreated' => date('Y-m-d H:i:s')

                ]
            );

        return redirect()->intended('/home');

    }
    public function __construct()
    {
        
        $this->middleware('AdminOnly')->except('report');
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
