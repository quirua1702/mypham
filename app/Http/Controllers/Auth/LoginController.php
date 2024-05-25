<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username() 
    { 
        $identity  = request()->get('email'); 
        if(is_numeric($identity)) 
            $fieldName = 'phone'; 
        elseif(filter_var($identity, FILTER_VALIDATE_EMAIL)) 
            $fieldName = 'email'; 
        else 
            $fieldName = 'username'; 
        request()->merge([$fieldName => $identity]); 
        return $fieldName; 
    } 
    // Phương thức xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return redirect()->route('admin.home');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.home');
            } else {
                Auth::logout();
                return redirect('/dang-xuat')->withErrors(['role' => 'Invalid role']);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
