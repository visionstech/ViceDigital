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
use App\Repositories\CommonRepositoryInterface;
use App\Repositories\CommonRepository;


class PublisherController extends Controller {
	
    /*
    |--------------------------------------------------------------------------
    | Publisher Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */

    /**
     * Create a new publisher controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, CommonRepositoryInterface $common)
    //public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => 'getRegister, postRegister']);
        $this->auth = $auth;
        $this->common = $common;
    }

    public function getIndex()
    {
      return redirect('/publisher/publishers');
    }
	
    
    
    /**
      * Save the configuration settings.
      * @param Request $request           
      * @return Response
      * Created on: 27/11/2016
      * Updated on: 27/11/2016
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
            Session::put('message', 'Configuration updated Successfully!'); 
            return redirect('publisher/configuration');
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
      * List all the publishers.
      * @param           
      * @return Response
      * Created on: 28/11/2016
      * Updated on: 28/11/2016
    **/
    public function getPublishers()
    {
        try { 
            $publishers = Publisher::where('user_id', Auth::user()->id)->get();
            return view('publisher/publishers', compact('publishers'));
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
      * Return form for new publisher.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 30/11/2016
    **/
    public function getAddConfiguration()
    {
      try {
			$products = Product::get()->toArray();
			$publisher = new Publisher;
			$table_columns = $publisher->getTableColumns();
			return view('publisher/add_publisher', compact('products', 'table_columns'));
			
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
      * Save the Add configuration settings.
      * @param Request $request           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 30/11/2016
    **/
    public function postAddConfiguration(Requests\AddConfigurationSetting $request)
    {
        try {
        $user = User::find(Auth::user()->id);
        $data = $request->all();
       
				//Insert
				$publisherData=array(
            'user_id'=>Auth::user()->id,
            'status'=>1,
            'overlays'=>(in_array(1,$data['products'])) ? 1 : 0,
            'infusion'=>(in_array(2,$data['products'])) ? 1 : 0,
            'dynamic_ads'=>(in_array(3,$data['products'])) ? 1 : 0,
            'programmatic'=>(in_array(4,$data['products'])) ? 1 : 0,
            'name'=>$data['name'],
            'website'=>$data['website'],
            'email'=>$data['email'],
            'adunit_id'=>$data['adunit_id'],
            'krux_id'=>$data['krux_id'],
            'comscore_id'=>$data['comscore_id'],
				);
				$Publisher_Id=Publisher::insertGetId($publisherData);
				Session::put('publisher_id', $Publisher_Id); 

				$targeting=array('publisher_id'=>$Publisher_Id);
				$pageType=array('publisher_id'=>$Publisher_Id);
				$val=0;	
        foreach($data['targeting_key'] as $key=>$Value){
					$targeting['key']=$Value;
					$targeting['value']=$data['targeting_value'][$val];
					$targetInsert=PublisherTargetings::insert($targeting);
					$val++;
				}
        $val=0; 
        foreach($data['page_type_title'] as $key=>$Value){
          $pageType['title']=$data['page_type_title'][$val];
          $pageType['selector']=$data['page_type_selector'][$val];
          $pageTypeInsert=PublisherPagetypes::insert($pageType);
          $val++;
        }
      $Publisher_Id=encrypt($Publisher_Id);
			return redirect('publisher/add-positions/'.$Publisher_Id);
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
      * List all the publishers.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 30/11/2016
    **/
    public function getPositions($publisherId=null)
    {
        if($publisherId == '') {
          return redirect('/publisher/publishers');
        }
        try {
            $positions = Ads::where('publisher_id',decrypt($publisherId))->get();
            $publisherId=$publisherId;
            return view('publisher/positions', compact('positions','publisherId'));
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
      * Return get Ad Positions settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 01/12/2016
    **/
    public function getAddPositions($publisherId=null)
    {
      try {

        $products = Product::get()->toArray();
        $positions = Positioning::get()->toArray();
          $publisherId=$publisherId;
          return view('publisher/add_positions', compact('products','positions','publisherId'));
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
      * Return Post Ad Positions settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 01/12/2016
    **/
    public function postAddPositions(Requests\AddPositionSetting $request)
    {
      try {
        $data = $request->all();
        if($data['publisherId']){
        //Insert Add Data
          $publisherId=decrypt($data['publisherId']);
          $Adsdata=array('status'=>(isset($data['status'])) ? $data['status'] : 'Inactive',
                         'publisher_id'=>$publisherId,
                         'slotname'=>$data['slotname'],
                         'container'=>$data['container'],
                         'positioning'=>$data['positioning'],
                         'mobile_sizes'=>($data['mobile'] =='default' ? $data['mobile'] : $data['mobile_sizes']),
                         'tablet_sizes'=>($data['tablet'] =='default' ? $data['tablet'] : $data['mobile_sizes']),
                         'desktop_sizes'=>($data['desktop'] =='default' ? $data['desktop'] : $data['mobile_sizes']),
                         'lazyload'=>(isset($data['lazyload'])) ? $data['lazyload'] : 0,
                         'page_type'=>serialize($data['page_type']),
                        );
          $insertAds=Ads::insert($Adsdata);
        }
        return redirect('/publisher/add-custom/'.$data['publisherId']);
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
      * Return get Custom settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 01/12/2016
    **/
    public function getAddCustom($publisherId=null)
    {
      try {
          $publisherId=$publisherId;
          return view('publisher/add_custom', compact('publisherId'));
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
      * Save the Add Custom Scripting.
      * @param Request $request           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 30/11/2016
    **/
    public function postAddCustom(Requests\AddCustom $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $data = $request->all();
            if($data['publisherId']){
              $publisher_id=decrypt($data['publisherId']);
              $publisherData=array('custom_scripting'=>$data['custom_scripting']);
              $Publisher_Id=Publisher::where('id',$publisher_id)->update($publisherData);
            }
            return redirect('publisher/publishers');
        }
        catch (\Exception $e) 
        {   
            $result = [
                    'exception_message' => $e->getMessage()
            ];
            return view('errors.error', $result);
        }
    }
}