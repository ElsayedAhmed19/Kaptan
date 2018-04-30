<?php

namespace App\Http\Controllers;

use App\Helpers\FirebaseHelper;
use App\Repositories\UsersRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Kreait\Firebase\Exception\AuthException;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
//        $this->user='78987';
    }
    public function auth(Request $request)
    {
        $helper = new FirebaseHelper();
        try {
            $user = $helper->auth->getUserByEmailAndPassword($request->input("email"), $request->input("password"));
            $userData = UsersRepository::getUserByID($user->getUid());
//            Cookie::queue('user', $userData, '60');
//            Session::put('user', $userData);
            $this->user=$userData;
            $this->session2();
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
    public function session2(){
//        $user=Session::get('user');
        return $this->user;
    }
}
