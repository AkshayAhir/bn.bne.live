<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator,Redirect,Session,Mail;
use App\Mail\ForgetEmail;
use App\Mail\RegisterEmail;
class LoginController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->route('eventList');
        }
        return view('front.pages.login');
    }
    public function register(){
        return view('front.pages.register');
    }
    public function RegisterUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_first_name' => 'required',
            'user_last_name' => 'required',
            'user_email' => 'required|email',
            'password' => 'required',
            'user_number' => 'required',
        ]);
        if ($validator->fails()) {
            $error_msg = $validator->errors()->first();
            return response()->json(['message' => $error_msg, 'status' => '0', 'data' => []]);
        }
        $image_name = NULL;
        if(User::where('user_email',$request->user_email)->where('is_guest_user',1)->exists()){
           if($request->user_profile_photo != ''){
                $file_name = $request->user_profile_photo->getClientOriginalName();
                $imageFileType = $request->user_profile_photo->getClientOriginalExtension();
                $file_path = $request->user_profile_photo->getPathName();
                $image_name = "user_profile" . time(). "." . $imageFileType;
                $request->user_profile_photo->move(public_path('front/assets/images/user-profile'),$image_name);
            }
            User::where('user_email',$request->user_email)->update(['user_first_name'=>$request->user_first_name ,'user_last_name'=>$request->user_last_name , 'user_number'=>$request->user_number,'password'=>bcrypt($request->password),'user_profile_photo'=>$image_name,'is_guest_user'=>0,'status'=>0]);
            $users = User::where('user_email',$request->user_email)->get();
            $user = User::find($users[0]->id);
        } else if(User::where('user_email',$request->user_email)->exists()){
            return response()->json(["message" => 'success', "status" => "exist"]);
        }
        else{
             if($request->user_profile_photo != ''){
                $file_name = $request->user_profile_photo->getClientOriginalName();
                $imageFileType = $request->user_profile_photo->getClientOriginalExtension();
                $file_path = $request->user_profile_photo->getPathName();
                $image_name = "user_profile" . time(). "." . $imageFileType;
                $request->user_profile_photo->move(public_path('front/assets/images/user-profile'),$image_name);
            }
            $user = new User;
            $user->user_first_name = $request->user_first_name;
            $user->user_last_name = $request->user_last_name;
            $user->user_email = $request->user_email;
            $user->user_number = $request->user_number;
            $user->password = bcrypt($request->password);
            $user->user_profile_photo = $image_name;
            $user->save();
            $data = array(
                    'user_name'=>$request->user_name
                );
            Mail::to($request->user_email)->send(new RegisterEmail($data));  
        }
        $token =  $user->createToken('token')->accessToken;
        User::where('id', $user->id)->update(["token" => $token]);
        $user = User::where('id', $user->id)->get();
        Session::put('register', $user);
        if(!$user){
            return response()->json(["message" => 'fail', "status" => "0", "data" => []]);
        }
        return response()->json(["message" => 'success', "status" => "1", "data" => $user]);
    }
    public function userLogin(Request $request){
        request()->validate([
            'user_email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('user_email',$request->user_email)->get();
        $credentials = $request->only('user_email', 'password');
        if(count($user) > 0 && $user[0]->status == 1){
            return Redirect::to("login")->with('message', 'Your account deactivate');
        }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token =  $user->createToken('token')->accessToken;
            User::where('id', $user->id)->update(["token" => $token]);
            return redirect()->intended('/');
        }
        return Redirect::to("login")->with('message', 'Login credentials are incorrect');
    }
    public function checkOutLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            $error_msg = $validator->errors()->first();
            return response()->json(['message' => $error_msg, 'status' => '0', 'data' => []]);
        }
        $credentials = $request->only('user_email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token =  $user->createToken('token')->accessToken;
            User::where('id', $user->id)->update(["token" => $token]);
            $user = User::where('id', $user->id)->get();
            return response()->json(["message" => 'success', "status" => "1", "data" => $user]);
        }
        return response()->json(["message" => 'error', "status" => "0"]);
    }
    public function guestUserLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'guest_user_first_name' => 'required',
            'guest_user_last_name' => 'required',
            'guest_user_email' => 'required',
            'guest_user_number' => 'required',
        ]);
        if($validator->fails()){
            $error_msg = $validator->errors()->first();
            return response()->json(['message' => $error_msg, 'status' => '0', 'data' => []]);
        }
        if(User::where('user_email',$request->guest_user_email)->where('is_guest_user',1)->exists()){
            $user = User::where('user_email',$request->guest_user_email)->get();
            Session::put('user', $user);
            User::where('user_email', $request->guest_user_email)->where('is_guest_user',1)->update(['user_first_name'=>$request->guest_user_first_name,'user_last_name'=>$request->guest_user_last_name,'user_number'=>$request->guest_user_number]);
            return response()->json(["message" => 'success', "status" => "1"]);
        }elseif(User::where('user_email',$request->guest_user_email)->where('is_guest_user',0)->exists()){
            $user = User::where('user_email',$request->guest_user_email)->get();
            Session::put('user', $user);
            return response()->json(["message" => 'success', "status" => "1"]);
        }
        else{
            $data = array(
                'user_first_name'=>$request->guest_user_first_name,
                'user_last_name'=>$request->guest_user_last_name,
                'user_email'=>$request->guest_user_email,
                'user_number'=>$request->guest_user_number,
                'is_guest_user'=>1,
                'status'=>2
            );
            User::insert($data);
            $user = User::where('user_email',$request->guest_user_email)->get();
            Session::put('user', $user);
            return response()->json(["message" => 'success', "status" => "1"]);
        }
    }
    public function LogoutUser(){
       Session::flush();
        Auth::logout();
        return redirect('/');
    }
    public function forgot(){
        return view('front.pages.forgot.forgot');
    }
    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $error_msg = $validator->errors()->first();
            return response()->json(['message' => $error_msg, 'status' => '0', 'data' => []]);
        }
        if (User::where('user_email', $request->user_email)->exists()) {
            $forgot_token =  Str::random(8);
            $url = 'https://bn.bne.live/change-password/' . $forgot_token;
            $data = array(
                    'url'=>$url
                );
            Mail::to($request->user_email)->send(new ForgetEmail($data));
            $updatetoken = User::where('user_email',$request->user_email)->update(["forgot_token" => $forgot_token]);
            return response()->json(["message" => 'Mail has been Sent', "status" => "1", "data" => [$url]]);
        }
        return response()->json(["message" => 'E-mail id is not exist', "status" => "0"]);
    }
    public function changepassword(){
        return view('front.pages.forgot.change-password');
    }
    public function ResetPass(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ]);
        if($validator->fails()){
            $error_msg = $validator->errors()->first();
            return response()->json(['message' => $error_msg, 'status' => '0', 'data' => []]);
        }
        $chnagepass = User::where('forgot_token', $request->forgot_token)->update(['password' => bcrypt($request->confirm_pass)]);
        if($chnagepass != 1){
            return response()->json(["message" => 'fail', "status" => "0", "data" => []]);
        }
        return response()->json(["message" => 'Password reset successfully', "status" => "1", "data" => $chnagepass]);
    }
    public function Profile(){
        if(Auth::check()){
            if(Auth::check()){
                $login_user = Auth::user()->id;
            }else{
                $user = Session::get('user');
                $login_user = $user[0]['id'];
            }
            $user = User::where('id', $login_user)->get();
            return view('front.pages.edit-profile',compact('user','login_user'));
        }else{
            return redirect()->route('user.login');
        }
    }

    public function editUser(Request $request){
        if(Auth::check()){
            $login_user = Auth::user()->id;
        }else{
            $user = Session::get('user');
            $login_user = $user[0]['id'];
        }
        $image_name = '';
        if($request->edit_user_profile_photo){
            $file_name = $request->edit_user_profile_photo->getClientOriginalName();
            $imageFileType = $request->edit_user_profile_photo->getClientOriginalExtension();
            $file_path = $request->edit_user_profile_photo->getPathName();
            $image_name = "user_profile" . time(). "." . $imageFileType;
            $request->edit_user_profile_photo->move(public_path('front/assets/images/user-profile'),$image_name);
        }
        $edit_profile = User::where('id', $login_user)->update(array_filter(['user_first_name'=>$request->user_first_name ,'user_last_name'=>$request->user_last_name , 'user_number' => $request->edit_user_number, 'user_profile_photo' => $image_name,'set_host_name'=>$request->edit_set_host_name]));
        if (!$edit_profile) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'Update Successfully.', 'status'=>'1']);
        }
    }
}