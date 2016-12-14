<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use App\Product;
use App\Publisher;
use App\PublisherTargetings;
use App\PublisherPagetypes;
use App\Ads;
use App\Positioning;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Auth;
use DB;


class DashboardController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Dashboard Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */
    /**
     * Create a new dashboard controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => 'getRegister, postRegister']);
        $this->auth = $auth;
    } 

    /**
      * Shows the User dashboard.
      * @param         
      * @return Response
      * Created on: 01/12/2016
      * Updated on: 05/12/2016
    **/
    public function getIndex()
    {
        try {	
            $products = Product::all();
            if(Auth::user()->role==1){
                $viewFolder='admin';
            }elseif(Auth::user()->role==2){
                $viewFolder='user';
            }else{
              $viewFolder='partnershipManager';
            }
            return view('dashboard/'.$viewFolder.'/dashboard', compact('products'));
        }
        catch (\Exception $e) 
        { 	
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }
	
    /**
      * Shows the configuration settings.
      * @param      
      * @return Response
      * Created on: 01/12/2016
      * Updated on: 05/12/2016
    **/
    public function getConfiguration()
    {
        try{
            if(Auth::user()->role==1){
                $viewFolder='admin';
            }elseif(Auth::user()->role==2){
                $viewFolder='user';
            }else{
              $viewFolder='partnershipManager';
            }
            return view('dashboard/'.$viewFolder.'/configuration');
        }
        catch (\Exception $e) 
        { 	
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Save the configuration settings.
      * @param Request $request           
      * @return Response
      * Created on: 27/11/2016
      * Updated on: 02/12/2016
    **/
    public function postConfiguration(Requests\ConfigurationSetting $request)
    {
      try {
            $user = User::find(Auth::user()->id);
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $data['updated_by'] = Auth::user()->id;
            $data['updated_ip'] = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
            $update_configuration = $user->update($data);
            return redirect('dashboard/configuration')->with('success','Configuration updated Successfully!');
      }catch (\Exception $e) 
      {   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
}