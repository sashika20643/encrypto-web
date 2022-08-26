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
           set_time_limit(0);
            $resp=Http::timeout(3000)->post('http://127.0.0.1:5000/encrypt', [
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
$file->password=\Hash::make($password);
$file->save();
$files=file::where('id',$user_id)->get();
return redirect(Route('files'))->with('success',"File uploaded...");

        }





        public function fileView($id){
            if(file::where('user_name',Auth::user()->id)->where('id',$id)->exists()){


            $data=file::where('id',$id)->get();
            $accesslist=file_access::where('file_id',$id)->get();


            return view('Admin.editfile')->with('file',$data[0])->with('users',$accesslist);}
            else{
                return back()-> with('alert', 'access denied.');
            }

        }


        public function AccessGivenFiles(){

            $data=Auth::user()->email;
            $accesslist= DB::table('files')->join('file_accesses', 'file_accesses.file_id', '=', 'files.id')->where('file_accesses.user_id', '=', $data)->select('files.*')->get();

             return view("Admin.recivedFiles")->with('files',$accesslist);




        }


        //file download function
        public function fileDownload(Request $request){
            // return($request->id);
            $data=file::where('id',$request->id)->get();
            if(\Hash::check($request->password, $data[0]->password)){





            $resp=Http::post('http://127.0.0.1:5000/download', [
                'last_name' => $data[0]->final_name,


                // 'file' => $request->file
            ]);
            set_time_limit(0);
            $response=Http::timeout(3000)->post('http://127.0.0.1:5000/decrypt', [
                'first_name' => $data[0]->first_name,
                'password' => $request->password,
                'last_name'=>$data[0]->final_name,



                // 'file' => $request->file
            ]);
            return view("Admin.downloadfile")->with("filename",$data[0]->first_name);
        }
        return back()-> with('alert', ' Access denied..');
        }


        public function deleteUser($id){
            $user=User::where('id',$id)->get();
            $file=file_access::where('user_id',$user[0]->email)->delete();
            $user=User::where('id',$id)->firstorfail()->delete();


            $data=User::where('role','!=','1')->get();
            return view('Admin.Users')->with('users',$data)->with('success',"Deleted succussfully");
        }
            public function fileDelete($id){
                $data=file::where('id',$id)->get();
                $resp=Http::post('http://127.0.0.1:5000/delete', [
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

}
