<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\FirebaseHelper;
use App\Repositories\ClientsRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $firebaseHelper = new FirebaseHelper;

        $createdUser = $firebaseHelper->auth->createUserWithEmailAndPassword(
            $data['email'],
            $data['password']
        );

        $id = $createdUser->getUid();
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $isInserted = ClientsRepository::insertClient([
            'id' => $id,
            'admin'=>false,
            'blocked'=>true,
            'admin'=>false,
            'attendance'=>0,
            'balance'=>0,
            'behavior'=>0,
            'behaviorCount'=>0,
            'blocked'=>true,
            'deleted'=>false,
            'email'=>$email,
            'fullname'=>$name,
            'imageURL'=>'',
            'isAdmin'=>false,
            'isOnline'=>false,
            'membersince'=>time(),
            'nationality'=>'',
            'online'=>false,
            'onTrip'=>false,
            'overallRatingCount'=>0,
            'phone'=>$phone,
            'token'=>'Token',
            'userID'=>'User id',
            'username'=>'user name'
        ]);

        $user = new User($request->get('name'), $request->get('email'), $request->get('phone'));
        return $user;
    }
}
