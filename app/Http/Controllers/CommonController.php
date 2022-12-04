<?php

namespace App\Http\Controllers;
use App\Mail\AccessReport;
use App\Mail\Signup;
use App\Models\User;
use App\Models\file;
use App\Models\file_access;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;


use Illuminate\Http\Request;

class CommonController extends Controller
{
    
//--------------------files view-------------------------


    public function fileView($id){
        if(file::where('user_name',Auth::user()->id)->where('id',$id)->exists()){


        $data=file::where('id',$id)->get();
        $accesslist=file_access::where('file_id',$id)->get();


        return view('Admin.editfile')->with('file',$data[0])->with('users',$accesslist);}
        else{
            return back()-> with('alert', 'access denied.');
        }

    }


    //==========================access given files==========================


    public function AccessGivenFiles(){

        $data=Auth::user()->email;
        $accesslist= DB::table('files')->join('file_accesses', 'file_accesses.file_id', '=', 'files.id')->where('file_accesses.user_id', '=', $data)->select('files.*')->get();

         return view("Admin.recivedFiles")->with('files',$accesslist);




    }

    //--------------upload files -----------------

    public function Uploadfile(Request $request){

        $user_id=Auth::user()->id;
        // $user=User::where('id',$user_id)->get();
        // return $user;
        // $user_pw=$user->password;

           $first_name=$request->file->getClientOriginalName();
           $last_name=$request->last_name;
           $size=$request->file->getSize();

           $type=$request->file->getClientOriginalExtension();

           $password=$request->password;
        //    set_time_limit(0);
        //     $resp=Http::timeout(3000)->post('http://127.0.0.1:5000/encrypt', [
        //         'first_name' => $first_name,
        //         'password' => $password,
        //         'last_name'=>$last_name,

        //         // 'file' => $request->file
        //     ]);
$file=new file;
$file->user_name=$user_id;
$file->first_name=$first_name;
$file->final_name=$last_name;
$file->size=$size;
$file->type=$type;
$file->password=\Hash::make($password);
$file->save();
$files=file::where('id',$user_id)->get();
return redirect(Route('files'))->with('success',"File uploaded...");

        }



    //---------------------------file download function------------------------


    public function fileDownload(Request $request){
        // return($request->id);
        $data=file::where('id',$request->id)->get();
        if(\Hash::check($request->password, $data[0]->password)){




            set_time_limit(0);
        $resp=Http::timeout(30000)->post('http://sashika20643.pythonanywhere.com/download', [
            'last_name' => $data[0]->final_name,


            // 'file' => $request->file
        ]);
        set_time_limit(0);
        $response=Http::timeout(30000)->post('http://sashika20643.pythonanywhere.com/decrypt', [
            'first_name' => $data[0]->first_name,
            'password' => $request->password,
            'last_name'=>$data[0]->final_name,



            // 'file' => $request->file
        ]);
        $userid=file::where('id',$request->id)->get()[0]->user_name;
        $email=User::where('id',$userid)->get();
        $time=Carbon::now();
        $time=$time->toDateTimeString();
        $demail=Auth::user()->email;



        Mail::to($email[0])->send(new AccessReport($demail ,$time,$request->id));


        return view("Admin.downloadfile")->with("filename",$data[0]->first_name);
    }
    return back()-> with('alert', ' Access denied..');
    }


//------------------------delete a file----------------------

    public function fileDelete($id){
        // return $id;
        
            $data=file::where('id',$id)->get();
           
            $resp=Http::post('http://sashika20643.pythonanywhere.com/delete', [
                'last_name' => $data[0]->final_name,


                // 'file' => $request->file
            ]);

            if($resp->successful()){
                $file=file::where('id',$id)->firstorfail()->delete();
                $file=file_access::where('file_id',$id)->delete();

                return back()-> with('success', 'Deleted Successfully.');
            }
            return back()-> with('alert', 'something went wrong.');
        // return \Response::download($response,$data[0]->first_name, $headers);

        // $accesslist=file_access::where('file_id',$id)->get();


        // return view('Admin.editfile')->with('file',$data[0])->with('users',$accesslist);

    }

//---------------remove access from files------------------------

    public function removeAccess($id){
        $connection=file_access::where('id',$id)->firstorfail()->delete();


        return redirect()->back()->with('success','Successfully removed');

    }


    public function addAccess(Request $request){

if(Auth::user()->email==$request->email){
return redirect()->back()->with('alert','oops!its your email');
}
if(file_access::where('user_id',$request->email)->exists() && file_access::where('file_id',$request->file_id)->exists()){
return redirect()->back()->with('alert','already this user have acess');
}


        if(User::where('email',$request->email)->exists()){
            $accesslist=new file_access;
            $accesslist->user_id=$request->email;
            $accesslist->file_id=$request->file_id;
            $accesslist->save();
            return redirect()->back()->with('success','Successfully added');
        }
        else{
             return redirect()->back()->with('alert','No user found');
        }
    }




    //--------------change password--------------------
public function changePassword(Request $request){
$this->validate($request,[
    'password' =>'required',
    'new_password' => [
        'required',
        'string',
        'min:6',             // must be at least 10 characters in length
        'regex:/[a-z]/',      // must contain at least one lowercase letter
        'regex:/[A-Z]/',      // must contain at least one uppercase letter
        'regex:/[0-9]/',      // must contain at least one digit
        'regex:/[@$!%*#?&]/', // must contain a special character
    ],
    'password_confirmation' => 'required|same:new_password'








]);

    if(\Hash::check($request->password, Auth::user()->password)){

        $user=User::where('id',Auth::user()->id)->get();
        $user[0]->password= \Hash::make($request->new_password);
      

        return redirect()->back()->with('success','Successfully chnaged');

    }
    else{
        return redirect()->back()->with('alert','Wrong password');
    }


}

}
