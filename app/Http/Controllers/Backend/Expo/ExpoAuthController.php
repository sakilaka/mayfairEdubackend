<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpoAuthController extends Controller
{
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

    public function login_page($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'additional_contents', 'place', 'datetime')->first();
        if (!$data['expo']) {
            return back()->with('error', 'Expo Not Found!');
        }

        if (auth()->check()) {
            return redirect()->route('expo.user.dashboard')->with('success', 'You are already logged in!');
        }

        return view('Expo.pages.expo_login', $data);
    }


    public function attempt_login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'login_method' => 'required',
        ]);

        if ($request->login_method == 'id') {
            $this->validate($request, [
                'id_no' => 'required',
            ]);

            $credentials = ['id_no' => $request->id_no, 'password' => $request->password];
        } else {
            $this->validate($request, [
                'email' => 'required|email',
            ]);

            $credentials = ['email' => $request->email, 'password' => $request->password];
        }

        if (auth()->guard('expo')->attempt($credentials)) {
            return redirect(route('expo.user.dashboard'))->with('success', 'Logged in successfully!');
        } else {
            return back()->with('error', 'Your ID/Email or password is incorrect.');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('expo')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
