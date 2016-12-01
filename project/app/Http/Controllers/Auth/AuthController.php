<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Session;
use View;
use Auth;
use Hash;
use App\User;
use App\Product;
use App\Publisher;

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
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->auth = $auth;
        $products = Product::all();
        View::share('products', $products);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        ]);
    }
    
    /**
      * Return registration form.
      * @param Request $request         
      * @return Response
      * Created on: 27/11/2016
      * Updated on: 27/11/2016
    **/
    public function getRegister()
    {
        try {	
            $products = Product::all();
            return view('auth.register', compact('products'));
        }
        catch (\Exception $e) 
        { 	
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }
	
    /**
      * Register user and save details.
      * @param Request $request            
      * @return Response
      * Created on: 27/11/2016
      * Updated on: 27/11/2016
    **/
    public function postRegister(Requests\NewUser $request)
    {
        try {
            $user_products = implode(',',$request->products);
            // Create new user
            $create_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 2
            ]);

            // Save the domain for publisher
            $create_publisher = Publisher::create([
                'user_id' => $create_user->id,
                'website' => $request->website,
                'status' => 1,
                'email' => $create_user->email,
                'name' => $request->name,
                'overlays' => (in_array(1,$request->products)) ? 1 : 0,
                'infusion' => (in_array(2,$request->products)) ? 1 : 0,
                'dynamic_ads' => (in_array(3,$request->products)) ? 1 : 0,
                'programmatic' => (in_array(4,$request->products)) ? 1 : 0,
            ]);

            Session::put('message', 'User Registered Successfully!');
            return redirect()->back();
        }
        catch (\Exception $e) 
        { 	
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }

    /**
        * Verify that user is authenticated or not.
        * @param Request $request            
        * @return Response
        * Created on: 21/8/2015
        * Updated on: 21/8/2015
    **/
    public function postLogin(Requests\AuthenticateUser $request)
    {
        try {
            $credentials = array(
            'email' => $request->email,
            'password' => $request->password
            );

            if($this->auth->attempt($credentials))
            {
                if(Auth::user()->role == 2)
                {
                    return redirect('/publisher/dashboard');
                }
                else 
                {
                    return redirect('/');
                }
            }
            else
            {
                return redirect()->back()->withErrors('These credentials do not match our records.');
            }
        }
        catch (\Exception $e) 
        { 	
            $result = [
                    'exception_message' => $e->getMessage()
             ];
            return view('errors.error', $result);
        }
    }
	
    /**
      * Log out the user from dashboard.
      * @param int $id            
      * @return Response
      * Created on: 21/8/2015
      * Updated on: 21/8/2015
    **/

    public function getLogout()
    {	
        try {
                $this->auth->logout();
                Session::flush();
                return redirect('/auth/login');
        }
        catch (\Exception $e) 
        { 
            $result = [
                'exception_message' => $e->getMessage()
            ];
            print_r($e->getMessage());
            return view('errors.error', $result);
        }

    }
    
}
