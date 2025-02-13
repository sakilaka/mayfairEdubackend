<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ChangePassword;
use App\Mail\EmailVerificationCustom;
use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use App\Models\Useraccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserLoginController extends Controller
{

    public function userRegister(Request $request)
    {
        // dd($request->all());

        $verified_email = User::where('email', $request->email)->where('email_verified_at', null)->first();
        if ($verified_email) {
            return redirect('/sign-in')->with('error', 'This mail have already register, Please try another mail.');
        }

        $validator = Validator::make($request->all(), [

            // 'email' => 'email:rfc,dns',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            // dd($validator->errors());
        }
        // dd($request);

        // try{
        //     DB::beginTransaction();

        $user = new User();
        $user->name = $request->name ?? '';

        $countryCode = $request->country_code;
        $mobile = $request->mobile;
        $user->mobile = $countryCode . $mobile;

        $user->email = $request->email;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->qualification = $request->qualification;
        $user->experience = $request->experience;
        $user->language = $request->language;
        $user->country = $request->country;
        // $user->continent = $request->continent;
        $user->continent_id = $request->continent_id;
        if ($request->consultant_status == '0') {
            $user->status = $request->consultant_status;
        }

        $user->address = $request->address;
        $user->type = $request->type;
        $user->is_verified = '0';
        $user->role = 'student';

        $tempCode = rand(10000, 99999);
        $user->temp_mail_code = $tempCode;
        $user->save();

        $data = [
            'email' => $user->email,
            'verification_code' => $tempCode,
        ];

        try {
            Mail::to($user->email)->send(new EmailVerificationCustom($data));
            $email = $data['email'];
            return view('Frontend.auth.verification_check', compact('email'))->with('success', 'You are successfully Registered. Now You can Verify. Thank You.');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error', 'Registration successful. But failed to send verification code');
        }
    }

    public function sendVerificationEmail()
    {

        $user = auth()->user();
        // dd($user);
        $tempCode = rand(10000, 99999);
        $user->temp_mail_code = $tempCode;
        $user->save();

        $data = [
            'email' => $user->email,
            'verification_code' => $tempCode,
        ];

        try {
            Mail::to($user->email)->send(new EmailVerificationCustom($data));
            $email = $data['email'];
            return view('Frontend.auth.verification_check', compact('email'))->with('success', 'You are successfully Registered. Now You can Verify. Thank You.');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error', 'Registration successful. But failed to send verification code');
        }
    }


    public function userVerify(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $request->verification_code == $user->temp_mail_code) {
            // Update user verification status
            $user->temp_mail_code = '';
            $user->is_verified = '1';
            $user->save();

            // Conditional redirect based on login status and user role
            if (auth()->check()) {
                return redirect()->route('user.dashboard')->with('success', 'Your email has been successfully verified!');
            } else {
                // Redirect based on user role
                if ($user->role === 'partner') {
                    return redirect('/partner-sign-in')->with('success', 'You are successfully registered. Now you can log in as a partner. Thank you.');
                } else if ($user->role === 'student') {
                    return redirect('/sign-in')->with('success', 'You are successfully registered. Now you can log in as a student. Thank you.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Verification code does not match.');
        }
    }




    public function partnerRegister(Request $request)
    {
        // dd($request->all());

        $verified_email = User::where('email', $request->email)->where('email_verified_at', null)->first();
        if ($verified_email) {
            // $token= $this->generateRandomString(16);
            // $verified_email->email_verify_token = $token;
            // $verified_email->update();

            // $data['user'] = $verified_email;
            // $data['token'] = $token;

            // $details['email'] = $request->email;
            // $details['send_item'] = new EmailVerificationCustom($data);
            // dispatch(new \App\Jobs\SendEmailJob($details));

            // return redirect('/sign-in')->with('success', 'You are register successfully. Now you can login!');
            return redirect('/sign-in')->with('error', 'This mail have already register, Please try another mail.');
            // return redirect('/sign-in')->with('error', 'Email not verified. Please Verify your email!');
        }

        $validator = Validator::make($request->all(), [

            // 'email' => 'email:rfc,dns',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => 'required',
            'password' => [
                'required',
                'string',
                'min:8', // must be at least 10 characters in length
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            // dd($validator->errors());
        }
        // dd($request);

        // try{
        //     DB::beginTransaction();

        $user = new User();
        $user->name = $request->name ?? '';

        $countryCode = $request->country_code;
        $mobile = $request->mobile;
        $user->mobile = $countryCode . $mobile;

        // dd($user->mobile);

        $user->email = $request->email;
        $user->password = $request->password;

        if ($request->hasFile('passport')) {
            $fileName = rand() . time() . '_passport_file.' . request()->passport->getClientOriginalExtension();
            request()->passport->move(public_path('upload/users/passport/'), $fileName);
            $user->passport = $fileName;
        }

        $user->gender = $request->gender;
        $user->qualification = $request->qualification;
        $user->experience = $request->experience;
        $user->language = $request->language;
        $user->country = $request->country;
        // $user->continent = $request->continent;
        $user->continent_id = $request->continent_id;
        if ($request->consultant_status == '0') {
            $user->status = $request->consultant_status;
        }

        $user->address = $request->address;
        $user->type = $request->type;
        $user->role = 'partner';


        $tempCode = rand(10000, 99999);
        $user->temp_mail_code = $tempCode;
        $user->save();

        $data = [
            'email' => $user->email,
            'verification_code' => $tempCode,
        ];

        // $user->save();



        // return redirect('/partner-sign-in')->with('success', 'You are successfully Registered. Now You can login. Thank You.');
        try {
            Mail::to($user->email)->send(new EmailVerificationCustom($data));
            $email = $data['email'];
            return view('Frontend.auth.verification_check', compact('email'))->with('success', 'You are successfully Registered. Now You can Verify. Thank You.');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->with('error', 'Registration successful. But failed to send verification code');
        }

        // if($user->type == 1){
        //     $patient = New Patient;
        //     $patient->type = 1;
        //     $patient->name = ($request->fname ?? '') .' '.($request->lname ?? '');
        //     // $patient->dob = $request->p_dob;
        //     // $patient->gender = $request->p_gender;
        //     // $patient->age = $request->p_age;
        //     $patient->user_id =  $user->id;
        //     $patient->save();
        // }

        // $token= $this->generateRandomString(16);
        // // dd($token);
        // $user->email_verify_token = $token;
        // $user->update();

        // $data['user'] = $user;
        // $data['token'] = $token;

        // $details['email'] = $user->email;
        // $details['send_item']=new EmailVerificationCustom($data);

        // dispatch(new \App\Jobs\SendEmailJob($details));

        // DB::commit();

        // return redirect('/sign-in')->with('error', 'We have sent you email verification link! Please Verify.');
        // }catch(\Exception $e){
        //     DB::rollBack();
        //    // return back()->with ('error', $e->getMessage());
        //     return back()->with ('error_message', "Something Went Wrong!")->withInput();
        // }

    }

    public function userSignin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $remember_me = $request->has('remember_me') ? true : false;
            if ($user->type == 1) {
                if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
                    $UserIP = $_SERVER['REMOTE_ADDR'];
                    $browser_address = $_SERVER['HTTP_USER_AGENT'];
                    $timeDate = date("Y-m-d h:i:sa");
                    $user_access = Useraccess::where('user_id', auth()->user()->id)->where('ip_address', $UserIP)->where('browser_address', $browser_address)->first();

                    if ($user_access) {
                        $user_access->date = Carbon::now();
                        $user_access->save();

                        if (session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')) {
                            return redirect(session()->get('login_pre_url'));
                        } else {
                            return redirect('/user/profile');
                        }
                    } else {
                        $user_access_list = Useraccess::where('user_id', auth()->user()->id)->get();
                        if ($user_access_list->count() >= 3) {
                            $user_access_old = $user_access_list[0];
                            $user_access_old->delete();
                            Useraccess::insert(['user_id' => auth()->user()->id, 'ip_address' => $UserIP, 'browser_address' => $browser_address, 'date' => $timeDate]);
                        } else {
                            Useraccess::insert(['user_id' => auth()->user()->id, 'ip_address' => $UserIP, 'browser_address' => $browser_address, 'date' => $timeDate]);
                        }
                        if (session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')) {
                            return redirect(session()->get('login_pre_url'));
                        } else {
                            return redirect('/user/profile');
                        }
                    }
                }
            }
        }

        return back()->with('error', 'Your email or password is incorrect.');
    }




    // public function userSignin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if ($user) {
    //         $remember_me = $request->has('remember_me') ? true : false;

    //         if ($user->type == 1) {
    //             if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
    //                 $UserIP = $_SERVER['REMOTE_ADDR'];
    //                 $browser_address = $_SERVER['HTTP_USER_AGENT'];
    //                 $timeDate = date("Y-m-d h:i:sa");

    //                 $user_access = Useraccess::where('user_id', auth()->user()->id)
    //                     ->where('ip_address', $UserIP)
    //                     ->where('browser_address', $browser_address)
    //                     ->first();

    //                 if ($user_access) {
    //                     $user_access->date = Carbon::now();
    //                     $user_access->save();
    //                 } else {
    //                     $user_access_list = Useraccess::where('user_id', auth()->user()->id)->get();
    //                     if ($user_access_list->count() >= 3) {
    //                         $user_access_old = $user_access_list[0];
    //                         $user_access_old->delete();
    //                     }
    //                     Useraccess::insert([
    //                         'user_id' => auth()->user()->id,
    //                         'ip_address' => $UserIP,
    //                         'browser_address' => $browser_address,
    //                         'date' => $timeDate
    //                     ]);
    //                 }

    //                 // 🔥 Generate a Sanctum Token
    //                 $token = $user->createToken('auth_token')->plainTextToken;

    //                 // 🔥 Return the token if API request
    //                 if ($request->wantsJson()) {
    //                     return response()->json([
    //                         'user' => auth()->user(),
    //                         'token' => $token
    //                     ]);
    //                 }

    //                 // 🔥 Maintain redirection for session-based login
    //                 if (session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')) {
    //                     return redirect(session()->get('login_pre_url'));
    //                 } else {
    //                     return redirect('/user/profile');
    //                 }
    //             }
    //         }
    //     }

    //     if ($request->wantsJson()) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }

    //     return back()->with('error', 'Your email or password is incorrect.');
    // }








    public function consultentSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $remember_me = $request->has('remember_me') ? true : false;
            if ($user->type == 7) {
                if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
                    $UserIP = $_SERVER['REMOTE_ADDR'];
                    $browser_address = $_SERVER['HTTP_USER_AGENT'];
                    $timeDate = date("Y-m-d h:i:sa");
                    $user_access = Useraccess::where('user_id', auth()->user()->id)->where('ip_address', $UserIP)->where('browser_address', $browser_address)->first();

                    if ($user_access) {
                        $user_access->date = Carbon::now();
                        $user_access->save();

                        if (session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')) {
                            return redirect(session()->get('login_pre_url'));
                        } else {
                            session()->put('partner_ref_id', auth()->user()->id);
                            session()->put('applied_by', auth()->user()->role);
                            return redirect('/user/profile');
                        }
                    } else {
                        $user_access_list = Useraccess::where('user_id', auth()->user()->id)->get();
                        if ($user_access_list->count() >= 3) {
                            $user_access_old = $user_access_list[0];
                            $user_access_old->delete();
                            Useraccess::insert(['user_id' => auth()->user()->id, 'ip_address' => $UserIP, 'browser_address' => $browser_address, 'date' => $timeDate]);
                        } else {
                            Useraccess::insert(['user_id' => auth()->user()->id, 'ip_address' => $UserIP, 'browser_address' => $browser_address, 'date' => $timeDate]);
                        }
                        if (session()->has('login_pre_url') && session()->has('login_pre_url') != url('sign-in')) {
                            return redirect(session()->get('login_pre_url'));
                        } else {
                            session()->put('partner_ref_id', auth()->user()->id);
                            session()->put('applied_by', auth()->user()->role);

                            return redirect('/user/profile');
                        }
                    }
                }
            }
        }

        return back()->with('error', 'Your email or password is incorrect.');
    }

    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function getUserChangePassword()
    {
        $password = User::find(auth()->user()->id);
        // return view('user.change_password', compact('password'));
        return view('User-Backend.profile.profile_edit', compact('password'));
    }

    public function setChangePassword(Request $request, $id)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                // 'new_password' => 'required|min:8|confirmed',
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ]);

            // Check if current password is correct
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $user = User::find($id);

            $data = [];
            $token = $this->generateRandomString(6);

            $user->password = Hash::make($request['new_password']);
            $user->change_token = $token;
            $user->change_date = date("Y-m-d H:i:s");
            $user->update();

            $data['user'] = $user;
            $data['token'] = $token;
            $details['email'] = $user->email;
            $details['send_item'] = new ChangePassword($data);
            dispatch(new \App\Jobs\SendEmailJob($details));

            Session::put('new_password', $request->new_password);
            // return redirect()->route('user.password_confirm', $user->id);
            return back()->with('success', 'Password Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function getConfirmPassword($id)
    {
        $user = User::find($id);
        // if ($user->type == 5) {
        return view('user.change_password_code', compact('user'));
        // }
    }

    public function confirmChangePassword(Request $request, $id)
    {
        if (isset($request->token)) {
            $user = User::find($id);
            if ($request->token == $user->change_token) {
                $date1 = date("Y-m-d H:i:s");
                $t1 = strtotime($date1);
                $t2 = strtotime($user->change_date);
                $diff = $t1 - $t2;
                $hours = $diff / (60 * 60);

                // dd($hours);
                if ($hours <= 1) {
                    $user->password = Session::get('new_password');
                    $user->update();
                    Session::pull('new_password');
                    // if($user->type == 5){
                    return redirect()->route('user.password', $user->id)->with('message', 'Password change successfully!');
                    // }
                }
            } else {
                return redirect()->back()->with('error', 'Password confirmation code does not match, Try again!');
            }
        } else {
            return redirect()->back()->with('error', 'Try again. Thank You.');
        }
    }

    public function userLogout()
    {
        session()->forget('partner_ref_id');
        auth()->logout();
        return redirect(env('FRONTEND_URL'));
    }

    //Forget Password section start here

    public function forgotPassword()
    {
        return view('Frontend.forgot_password');
    }

    public function sentMailforgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = $this->generateRandomString();
            $user->forget_token = $token;
            $user->forget_date = date("Y-m-d H:i:s");
            $user->update();
            // $user = $request->email;
            $send_mail = $user->email;
            $data['id'] = $user->id;
            $data['token'] = $token;
            $details['email'] = $send_mail;
            //dd(new ForgotPasswordEmail($data));
            //    dd($send_mail);
            $details['send_item'] = new ForgotPasswordEmail($data);
            dispatch(new \App\Jobs\SendEmailJob($details));
            //Artisan::call('queue:listen');
            //Mail::to($send_mail)->send(new ForgotPasswordEmail($data));
            return redirect()->back()->with('message', 'Check your email and reset your Password, Thank You.');
        } else {
            return back();
        }
    }

    public function emailForgotPassword(Request $request, $id)
    {
        //dd('hi');
        if (isset($request->token)) {
            $data['user'] = $user = User::find($id);
            if ($request->token == $user->forget_token) {
                $date1 = date("Y-m-d H:i:s");
                $t1 = strtotime($date1);
                $t2 = strtotime($user->forget_date);
                $diff = $t1 - $t2;
                $hours = $diff / (60 * 60);
                if ($hours <= 1) {
                    return view('Frontend.reset_forgot_password', $data);
                } else {
                    return redirect('/forgot-password')->with('message', 'Your token time is over, please resubmit your requset, Thank you.'); //eamil send foget link
                }
                // dd($user);

            } else {
                return redirect('/forgot-password')->with('message', 'Your token is not match, please resubmit again, Thank You.'); //eamil send foget link
            }
            //dd($id);

        } else {
            return redirect('/forgot-password')->with('message', 'Please resubmit your email, and reset your password. Thank You.');
        }
    }

    public function resetForgotPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::find($id);
        $user->password = $request->password;
        $user->update();
        return redirect('/sign-in')->with('message', 'Your password is updated, Now you can login, Thank You.');
    }

    //Forget Password section end here

    //Forget Password section Start here Admin
    public function adminForgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function emailAdminForgotPassword(Request $request, $id)
    {
        //dd('hi');
        if (isset($request->token)) {
            $data['user'] = $user = User::find($id);
            if ($request->token == $user->forget_token) {
                $date1 = date("Y-m-d H:i:s");
                $t1 = strtotime($date1);
                $t2 = strtotime($user->forget_date);
                $diff = $t1 - $t2;
                $hours = $diff / (60 * 60);
                if ($hours <= 1) {
                    return view('auth.reset_forgot_password', $data);
                } else {
                    return redirect('/admin-forgot-password')->with('message', 'Your token time is over, please resubmit your requset, Thank you.'); //eamil send foget link
                }
                // dd($user);

            } else {
                return redirect('/admin-forgot-password')->with('message', 'Your token is not match, please resubmit again, Thank You.'); //eamil send foget link
            }
            //dd($id);

        } else {
            return redirect('/admin-forgot-password')->with('message', 'Please resubmit your email, and reset your password. Thank You.');
        }
    }

    public function resetAdminForgotPassword(Request $request, $id)
    {
        //dd('id');
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::find($id);
        $user->password = $request->password;
        $user->update();

        return redirect('/login')->with('message', 'Your password is updated, Now you can login, Thank You.');
    }

    //Forget Password section End here Admin

}
