<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);
        $nik=$request->get('nik');
        $password=$request->get('password');
        $length=strlen($nik);

        $auth = Auth::guard('admin');

        if($length > 7) {
            // login guard user
            $auth = Auth::guard('users');

        }

        // sukses login
        if($auth->attempt(['nik' => $nik, 'password' => $password])) {
            //dd($auth);
            return redirect()->intended('/home');
        }else{
             $this->incrementLoginAttempts($request);
            //return $this->sendFailedLoginResponse($request);
            return redirect()->back()->withInput($request->only('nik','password','remember'));
        
        }

                
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required|string',
        ]);

        
    }
    
    public function username()
    {
        return 'nik';
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
       
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
       
}
