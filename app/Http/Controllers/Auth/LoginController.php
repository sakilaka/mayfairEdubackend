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
            // Validate the input fields
            $this->validate($request, [
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]);

            // Attempt login
            if (auth('admin')->attempt($request->only(['email', 'password']))) {
                // Save necessary session data
                session()->put('partner_ref_id', auth('admin')->user()->id);
                session()->put('applied_by', auth('admin')->user()->role);
                session()->put('is_applied_partner', true);

                // Redirect to the dashboard upon successful login
                return redirect('/admin/dashboard');
            } else {
                // Authentication failed, send error message
                return back()->with('error', 'Invalid email or password.');
            }
        } catch (\Exception $e) {
            // Use dd() to inspect the error before redirecting back
            dd($e->getMessage()); // This will dump the error message and stop execution

            // Redirect back with error (this won't be executed due to dd())
            return back()->with('error', $e->getMessage());
        }
    }
}
