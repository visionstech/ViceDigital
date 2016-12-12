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
      * Updated on: 08/12/2016
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
                'email' => $create_user->email,
                'name' => $request->name,
                'overlays' => ((isset($data['products']))?((in_array(1,$data['products'])) ? 1 : 0):0),
                'infusion' => ((isset($data['products']))?((in_array(2,$data['products'])) ? 1 : 0):0),
                'dynamic_ads' => ((isset($data['products']))?((in_array(3,$data['products'])) ? 1 : 0):0),
                'programmatic' => ((isset($data['products']))?((in_array(4,$data['products'])) ? 1 : 0):0)
            ]);
            //Login Automatically User Functionality
            $credentials = array(
                'email' => $request->email,
                'password' => $request->password
            );

            if($this->auth->attempt($credentials))
            {
                if((Auth::user()->role == 2) || (Auth::user()->role == 1))
                {
                    return redirect('/dashboard');
                }
                else 
                {
                    return redirect('/');
                }
            }
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
            $checkStatus=User::where('email',$request->email)->get();
            if($checkStatus[0]->status=='Live'){
                if($this->auth->attempt($credentials))
                {
                    if((Auth::user()->role == 2) || (Auth::user()->role == 1))
                    {
                        return redirect('/dashboard');
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
            
            }else{

                return redirect()->back()->withErrors('Sorry Your status is not Live or Active.');
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