<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminLoginShow()
    {
        return view('auth.login');
    }


    public function adminLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]);

            if (auth()->guard('admin')->attempt($request->only(['email', 'password']))) {
                session()->put('partner_ref_id', auth('admin')->user()->id);
                session()->put('applied_by', auth('admin')->user()->role);
                session()->put('is_applied_partner', true);

                return redirect('/admin/dashboard');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // return back()->withInput($request->only('email'));
    }
}
