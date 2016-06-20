<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $confirmPassword = isset($data['unconfirmed']) && $data['unconfirmed'] ? '' : '|confirmed';
        
        return Validator::make($data, [
            'name' => "required|max:255",
            'email' => 'required|email|max:255|unique:users',
            'password' => "required|min:6{$confirmPassword}",
            'phone' => 'numeric'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => isset($data['phone']) ? $data['phone'] : null,
            'role_id' => 1
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $password = null;
        
        if (! $request->has('password')) {
            $data['password'] = $password = str_random(10);
            $data['unconfirmed'] = true;
        }
        
        $validator = $this->validator($data);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($data);
        Auth::guard($this->getGuard())->login($user);
        
        //event(new UserRegistered($user, $password));

        if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'listing.getApply') {
            return redirect()->back();
        }

        return redirect($this->redirectPath());
    }
    
    /**
     * @return mixed
     */
    public function getSocialAuth()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Authenticates/Registers a user with the social callback.
     *
     * @return mixed
     */
    public function getSocialAuthCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        // if account already exists, log them in.
        if($authenticatedUser = User::where('fb_id', $facebookUser->id)->first()) {
            auth()->login($authenticatedUser);

            return redirect($this->redirectPath());
        }

        // else create a new user and apply the retrieved data.\
        $password = str_random(10);
        
        $user = $this->create([
            'name' => $facebookUser->name,
            'password' => $password,
            'email' => $facebookUser->email,
        ]);
        
        $user->fb_token = $facebookUser->token;
        $user->fb_id = $facebookUser->id;
        $user->save();

        event(new UserRegistered($user, false));
        auth()->login($user);

        if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'listing.getApply') {
            return redirect()->back();
        }

        return redirect($this->redirectPath());
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        if($user->suspended) {
            auth()->logout();
            return redirect()->action('Auth\AuthController@login')->withErrors([
                'suspended' => trans('main.account_suspended')
            ]);
        }
        
        if($user->is('admin')) {
            return redirect()->route('backend.admin.index');
        }
        
        if($user->corporate_id) {
            return redirect()->route('backend.corporate.index');
        }

        if($user->is('user')) {
            return redirect()->back();
        }
        
        return redirect()->route('home');
    }
}
