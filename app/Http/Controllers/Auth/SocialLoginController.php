<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\Useraccess;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SocialLoginController extends Controller
{
    protected function setGProvider(): bool
    {
        $social_login =  \App\Models\Tp_option::where('option_name', 'social_login')->first();
        if($social_login){
            $dataObj = json_decode($social_login->option_value);
            if(isset($dataObj->google_client_id) &&  isset($dataObj->google_secret_id)){
                config()->set([
                    'services.' . "google" => [
                        'client_id' => $dataObj->google_client_id,
                        'client_secret' => $dataObj->google_secret_id,
                        'redirect' =>    url('/google/callback'),
                    ],
                ]);

                return true;
            }

        }
        return false;
    }
    protected function setFProvider(): bool
    {
        $social_login =  \App\Models\Tp_option::where('option_name', 'social_login')->first();
        if($social_login){
            $dataObj = json_decode($social_login->option_value);
            if(isset($dataObj->fb_client_id) &&  isset($dataObj->fb_secret_id)){
                config()->set([
                    'services.' . "facebook" => [
                        'client_id' => $dataObj->fb_client_id,
                        'client_secret' => $dataObj->fb_secret_id,
                        'redirect' =>  url('/facebook/callback'),
                    ],
                ]);
                // dd(config());
                return true;
            }

        }
        return false;
    }

    public function redirectToGoogle(Request $request)
    {
        if($this->setGProvider()){

                if($request->login_type){
                    Session::put("login_type", $request->login_type);
                }else{
                    // dd("ss");
                    return back()->with("error","somthing went wrong!");
                }
                //dd(Socialite::driver('google')->redirect());
                return Socialite::driver('google')->redirect();

        }else{
            return "Please Set up Google Social Login";
        }


    }

    public function redirectToFacebook(Request $request)
    {

        if($this->setFProvider()){
            //    dd($this->setFProvider());
            if($request->login_type){
                Session::put("login_type", $request->login_type);
            }else{
                // dd("ss");
                return back()->with("error","somthing went wrong!");
            }
            return Socialite::driver('facebook')->redirect();

        }else{
            return "Please Set up Facebook Social Login";
        }

        // // dd($request->login_type);
        // if($request->login_type){
        //     Session::put("login_type", $request->login_type);
        // }else{
        //     // dd("ss");
        //     return back()->with("error","somthing went wrong!");
        // }

        // return Socialite::driver('facebook')->redirect();
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }
    public function handleFacebookCallback()
    {
        if($this->setGProvider()){
           
            $user = Socialite::driver('facebook')->user();
            $login_type = Session::get('login_type');
            // dd($login_type);
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                // dd($existingUser);
                Auth::login($existingUser);
                return redirect('/user/profile')->with('message', 'Welcome ' . auth()->user()->name);
            } else {
                {
                    // Register new user
                    $newUser = New User;
                    $newUser->name=$user->name;
                    $newUser->email=$user->email;
                    $newUser->email_verified_at=date('Y-m-d');
                    $newUser->mobile='';
                    $newUser->password=Hash::make('12345678');
                    $newUser->facebook_id=$user->id;
                    $newUser->type = $login_type;
                     $newUser->save();
                 
                    Auth::login($newUser,true);
                   
                    return redirect('/user/profile')->with('message', 'Welcome ' . auth()->user()->name);
                }
        
                return redirect('/sign-in')->with('message', 'Something Went Wrong! Please Try Again.');
            }

               
        }
    }
    public function handleGoogleCallback()
    {
        if($this->setGProvider()){
           
            $user = Socialite::driver('google')->user();
            $login_type = Session::get('login_type');
            // dd($login_type);
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                //dd($existingUser);
                auth()->login($existingUser);
                $UserIP=$_SERVER['REMOTE_ADDR'];
                $browser_address=$_SERVER['HTTP_USER_AGENT'];
                $timeDate= date("Y-m-d h:i:sa");
                $user_access = Useraccess::where('user_id',auth()->user()->id)->where('ip_address',$UserIP)->where('browser_address',$browser_address)->first();
                
                if($user_access){
                    $user_access->date = Carbon::now();
                    $user_access->save();
                    
                    if(session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')){
                        return redirect(session()->get('login_pre_url'));
                    }else{
                        return redirect('/user/profile');
                    }
                    
                }else{
                    $user_access_list = Useraccess::where('user_id',auth()->user()->id)->get();
                    if($user_access_list->count() >= 3){
                        $user_access_old = $user_access_list[0];
                        $user_access_old->delete();
                        Useraccess::insert(['user_id'=>auth()->user()->id,'ip_address'=>$UserIP,'browser_address'=>$browser_address,'date'=>$timeDate]);
                    }else{
                        Useraccess::insert(['user_id'=>auth()->user()->id,'ip_address'=>$UserIP,'browser_address'=>$browser_address,'date'=>$timeDate]);
                    }
                    if(session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')){
                        return redirect(session()->get('login_pre_url'));
                    }else{
                        return redirect('/user/profile');
                    }
                }
                // return redirect('/user/profile')->with('message', 'Welcome ' );
            } else {
                {
                    // Register new user
                    $newUser = New User;
                    $newUser->name=$user->name;
                    $newUser->email=$user->email;
                    $newUser->email_verified_at=date('Y-m-d');
                    $newUser->mobile='';
                    $newUser->password=Hash::make('12345678');
                    $newUser->google_id=$user->id;
                    $newUser->type = $login_type;
                     $newUser->save();
                 
                    Auth::login($newUser,true);
                    $UserIP=$_SERVER['REMOTE_ADDR'];
                    $browser_address=$_SERVER['HTTP_USER_AGENT'];
                    $timeDate= date("Y-m-d h:i:sa");
                    $user_access = Useraccess::where('user_id',auth()->user()->id)->where('ip_address',$UserIP)->where('browser_address',$browser_address)->first();
                    
                    if($user_access){
                        $user_access->date = Carbon::now();
                        $user_access->save();
                        
                        if(session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')){
                            return redirect(session()->get('login_pre_url'));
                        }else{
                            return redirect('/user/profile');
                        }
                        
                    }else{
                        $user_access_list = Useraccess::where('user_id',auth()->user()->id)->get();
                        if($user_access_list->count() >= 3){
                            $user_access_old = $user_access_list[0];
                            $user_access_old->delete();
                            Useraccess::insert(['user_id'=>auth()->user()->id,'ip_address'=>$UserIP,'browser_address'=>$browser_address,'date'=>$timeDate]);
                        }else{
                            Useraccess::insert(['user_id'=>auth()->user()->id,'ip_address'=>$UserIP,'browser_address'=>$browser_address,'date'=>$timeDate]);
                        }
                        if(session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')){
                            return redirect(session()->get('login_pre_url'));
                        }else{
                            return redirect('/user/profile');
                        }
                    }
                    // return redirect('/user/profile')->with('message', 'Welcome ' . auth()->user()->name);
                }
        
                return redirect('/sign-in')->with('message', 'Something Went Wrong! Please Try Again.');
            }

               
        }
    }
    protected function requestTokenGoogle(Request $request){
        //return "hi";
        // Getting the user from socialite using token from google
       // $user = Socialite::driver('google')->stateless()->userFromToken($request->token);

        try {
            $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'device_name' => ['required'],
            'type' => ['required'],
        ]);
        if($validator->fails()) {
             return response()->json([
                'status'=>'no',
                'message' => 'Login faild',
                'data'=>$validator->errors()
            ]);
            // return response()->json($validator->errors());
        }

            $user = Socialite::driver('google')->stateless()->userFromToken($request->token);

            $finduser = User::where('google_id', $user->id)->where('type',$request->type)->first();

            if($finduser){

                Auth::login($finduser);

               return response()->json($this->getUserAndToken($finduser, $request->device_name));

            }else{
                $newUser = New User;
                $newUser->name=$user->name;
                $newUser->email=$user->email;
                $newUser->type=$request->type;
                // $newUser->mobile=123456;
                $newUser->password=Hash::make('123456');
                $newUser->google_id=$user->id;
                 $user->type = 1;
                $newUser->save();

                Auth::login($newUser);

               return response()->json($this->getUserAndToken($newUser, $request->device_name));
            }

        } catch (Exception $e) {
            return response()->json([
                'status'=>'no',
                'des'=> $e->getMessage(),
                'message' => 'login faild',
            ]);
        }


    }
    private function getUserAndToken(User $user, $device_name){
        return
         [
            'message' => 'Login Successful',
            'user'  => new UserResource($user),
            'status'=>'ok',
            'authorization' => [
                'Access-Token' => $user->createToken($device_name)->plainTextToken,
                'type' => 'user',
            ]
        ];
    }

}
