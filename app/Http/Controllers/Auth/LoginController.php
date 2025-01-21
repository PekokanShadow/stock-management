<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; // Corrected the trait name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers; // Uncommented and corrected the trait name

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile'; // Adjust the redirect path as necessary

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username'; // This should match the field in your login form
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Adjust the view path as necessary
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed
            return redirect()->intended($this->redirectTo); // Redirect to intended page
        }

        // Authentication failed
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
