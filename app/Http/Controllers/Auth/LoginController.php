<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\FirebaseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\AuthException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function auth(Request $request)
    {
        $helper = new FirebaseHelper();
        try {
            $user = $helper->auth->getUserByEmailAndPassword($request->input("email"), $request->input("password"));
            $userData = UsersRepository::getUserByID($user->getUid());
            Session::put('user', $userData);
            $request->attributes->add(['user' => $userData]);
//            dump($request->get('user'));die();
            //  dump(Session::get('user'));die();
            if (isset($userData['isAdmin'])&&$userData['isAdmin'] == true) {
                return redirect('drivers/');
            } elseif (isset($userData['isHotel'])&&$userData['isHotel']== true) {
                return redirect('clients/');
            }else{
                return redirect('/');
            }
        } catch (AuthException $e) {
            $message = $e->getMessage();
            return view('auth.login', compact('message'));
        }
    }

    public function logout()
    {
//        dump('gg');die();
        $helper = new FirebaseHelper();
//        $helper->auth->getInstance().signOut();
//        dump($helper->auth);die();
        return redirect('/login');
    }
}
