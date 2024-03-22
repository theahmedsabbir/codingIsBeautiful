<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'email' => ['required', 'unique:users,email'],
            'avatar' => ['mimes:jpg,jpeg,png,bmp,tiff,gif|max:1024'],
            // 'phone' => ['required', 'unique:users,phone'],
        ]);

        // dd($validator);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $request)
    {
        $request = (object) $request;

        // upload file
        $slug = Str::slug($request->name);
        $avatarName = '';
        if ($request->avatar) {
            $avatar = $request->avatar;
            $avatarName = $slug . time() . uniqid() . '.' . $avatar->extension();
            $avatar->move('avatars', $avatarName);
        }

        // save user
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = $avatarName;
        if (isset($request->status)) {
            $user->status = $request->status;
        }

        $user->save();

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        Session()->flash('Success', "You are successfully registered. Please login");

        return $request->wantsJson()
        ? new JsonResponse([], 201)
        : redirect($this->redirectPath());
    }
}
