<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\file;
use App\Models\file_access;
use Illuminate\Support\Facades\DB;
use Auth;

use Illuminate\Support\Facades\Http;




class Admin extends Controller
{
    //

    public function addUser(Request $request){


        $this->validate($request,[
            'name' =>'required|min:3',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>'required',







        ]);

        if(\Hash::check($request->password, Auth::user()->password)){
            if(User::where('email',$request->email)->exists()){
                return back()-> with('alert', 'email exist');
            }



               $password=\Str::random(10); //turn the array into a string


            $user= new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=\Hash::make($password);
            $user->save();

            return view('Admin.generateduser')->with('password',$password)->with('name',$request->name)->with('email',$request->email);



        }
        else{
            return back()-> with('alert', 'access denied.Incorrect Password');
        }




    }




    public function Users(){
        $data=User::where('role','!=','1')->get();
            return view('Admin.Users')->with('users',$data);
        }


     public function Uploadfile(Request $request){
        $user_id=Auth::user()->id;
        // $user=User::where('id',$user_id)->get();
        // return $user;
        // $user_pw=$user->password;

           $first_name=$request->file->getClientOriginalName();
           $last_name=Auth::user()->id.time();
           $size=$request->file->getSize();

           $type=$request->file->getClientOriginalExtension();

           $password=$request->password;

            $resp=Http::post('http://127.0.0.1:5000/encrypt', [
                'first_name' => $first_name,
                'password' => $password,
                'last_name'=>$last_name,

                // 'file' => $request->file
            ]);
$file=new file;
$file->user_name=$user_id;
$file->first_name=$first_name;
$file->final_name=$last_name;
$file->size=$size;
$file->type=$type;
$file->password=$password;
$file->save();
$files=file::where('id',$user_id)->get();
return redirect(Route('files'))->with('success',"File uploaded...");

        }





        public function fileView($id){
            $data=file::where('id',$id)->get();
            $accesslist=file_access::where('file_id',$id)->get();


            return view('Admin.editfile')->with('file',$data[0])->with('users',$accesslist);

        }


        //file download function
        public function fileDownload($id){
            $data=file::where('id',$id)->get();
            $resp=Http::post('http://127.0.0.1:5000/download', [
                'last_name' => $data[0]->final_name,


                // 'file' => $request->file
            ]);
            $response=Http::post('http://127.0.0.1:5000/decrypt', [
                'first_name' => $data[0]->first_name,
                'password' => $data[0]->password,
                'last_name'=>$data[0]->final_name,



                // 'file' => $request->file
            ]);


      return view('Admin.downloadfile')->with('filename',$data[0]->first_name);
            // return \Response::download($response,$data[0]->first_name, $headers);

            // $accesslist=file_access::where('file_id',$id)->get();


            // return view('Admin.editfile')->with('file',$data[0])->with('users',$accesslist);

        }



        public function removeAccess($id){
            $connection=file_access::where('id',$id)->firstorfail()->delete();


            return redirect()->back()->with('success','Successfully removed');

        }


        public function addAccess(Request $request){




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

}
