<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            // إذا كان المستخدم Admin، دعهم يدخلون لوحة التحكم
            return redirect()->route('admin.dashboard');  // يمكنك تعديل الرابط إلى صفحة الـ Admin
        }
    
        // في حالة المستخدم العادي، اعاده توجيه للوحة التحكم الخاصة بالطلاب
        return redirect()->route('student.dashboard');
    }
    



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
