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
            Session::put('message', 'Configuration updated Successfully!'); 
            return redirect('publisher/configuration');
      }catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * List all the publishers.
      * @param           
      * @return Response
      * Created on: 28/11/2016
      * Updated on: 02/12/2016
    **/
    public function getPublishers()
    {
      try { 
          if(Auth::user()->role == 1){
            $publishers = Publisher::join('users', 'users.id', '=', 'publishers.user_id')->select('users.role','publishers.*')->get();
            return view('publisher/admin/publishers', compact('publishers'));
          }else{
            $publishers = Publisher::join('users', 'users.id', '=', 'publishers.user_id')->select('users.role','publishers.*')->where('publishers.user_id', Auth::user()->id)->get();
            return view('publisher/publishers', compact('publishers'));
          }          
      }
      catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }
    
    /**
      * Return form for new publisher.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getAddConfiguration($publisherId=null)
    {
      try {
  			$products = Product::get()->toArray();
        $publisher=new Publisher;
  			$table_columns = $publisher->getTableColumns();
        $publisherId=$publisherId;
        $PublisherData=array(); $TargetingData=array(); $PageTypeData=array();
        if($publisherId != ''){
          $PublisherData=Publisher::where('id',decrypt($publisherId))->get()->toArray();
          $TargetingData=PublisherTargetings::where('publisher_id',decrypt($publisherId))->get()->toArray();
          $PageTypeData=PublisherPagetypes::where('publisher_id',decrypt($publisherId))->get()->toArray();
        }
  			return view('publisher/add_publisher', compact('products', 'table_columns','publisherId','PublisherData','TargetingData','PageTypeData'));
			}catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
      }
    }
	
	/**
      * Save the Add configuration settings.
      * @param Request $request           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function postAddConfiguration(Requests\AddConfigurationSetting $request)
    {

        try {
          $user = User::find(Auth::user()->id);
          $data = $request->all();
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
          if($data['publisherId'] != '' ){

            //Update Publisher Data
            $publisherData['updated_by'] = Auth::user()->id;
            $publisherData['updated_ip'] = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
            $Publisher_Id=Publisher::where('id',decrypt($data['publisherId']))->update($publisherData);
            //Update Targeting Data
            $TargetingData=PublisherTargetings::where('publisher_id',decrypt($data['publisherId']))->get()->toArray();
            $targeting=array('publisher_id'=>decrypt($data['publisherId']),'updated_by'=>$publisherData['updated_by'],'updated_ip'=>$publisherData['updated_ip']);
            $val=0;
            foreach($data['targeting_key'] as $key=>$Value){
                if($val < sizeof($TargetingData)) {
                 //Update
                  $targeting['updated_at']=date('Y-m-d H:i:s');
                  $targeting['key']=$Value;
                  $targeting['value']=$data['targeting_value'][$val];
                  $targetInsert=PublisherTargetings::where('id',$TargetingData[$val]['id'])->update($targeting);
                }else{
                  //Insert
                  $targeting['key']=$Value;
                  $targeting['value']=$data['targeting_value'][$val];
                  $targetInsert=PublisherTargetings::insert($targeting);
                }
               $val++;
            }
            if(sizeof($data['targeting_key']) < (sizeof($TargetingData))){
                $deletekeys=sizeof($data['targeting_key']);
                foreach($TargetingData as $key=>$Value){
                  if($key==$deletekeys){
                    $TargetingData=PublisherTargetings::where('id',$Value['id'])->delete();
                    $deletekeys++;
                  }
                  
                }
            }
            //Update Page Type Data
            $PageTypeData=PublisherPagetypes::where('publisher_id',decrypt($data['publisherId']))->get()->toArray();
            
            $val=0;
            $pageType=array('publisher_id'=>decrypt($data['publisherId']),'updated_by'=>$publisherData['updated_by'],'updated_ip'=>$publisherData['updated_ip']);
            foreach($data['page_type_title'] as $key=>$Value){
              if($val < sizeof($PageTypeData)){
                  //Update
                  $pageType['updated_at']=date('Y-m-d H:i:s');
                  $pageType['title']=$data['page_type_title'][$val];
                  $pageType['selector']=$data['page_type_selector'][$val];
                  $pageTypeInsert=PublisherPagetypes::where('id',$PageTypeData[$val]['id'])->update($pageType);
                }else{
                  //Insert
                  $pageType['title']=$data['page_type_title'][$val];
                  $pageType['selector']=$data['page_type_selector'][$val];
                  $pageTypeInsert=PublisherPagetypes::insert($pageType);
                }
              $val++;
            }
            if(sizeof($data['page_type_title']) < (sizeof($PageTypeData))){
                $deletekeys=sizeof($data['page_type_title']);
                foreach($PageTypeData as $key=>$Value){
                  if($key==$deletekeys){
                    $TargetingData=PublisherPagetypes::where('id',$Value['id'])->delete();
                    $deletekeys++;
                  }
                  
                }
            }
            $Publisher_Id=encrypt($Publisher_Id);
            return redirect('publisher/positions/'.$data['publisherId']);
          }else{
            //Insert Publisher Data
              $Publisher_Id=Publisher::insertGetId($publisherData);
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
			 
  		}catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
  }
    
    /**
      * List all the publishers.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getPositions($publisherId=null)
    {
        try {
            if($publisherId == ''){
              return redirect('/publisher/publishers');
            }
            $positions = Ads::where('publisher_id',decrypt($publisherId))->where('status','!=','Deleted')->get();
            $publisherId=$publisherId;
            return view('publisher/positions', compact('positions','publisherId'));
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }
	
	  /**
      * Return get Ad Positions settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getAddPositions($publisherId=null,$adId=null)
    {
      try {
        $products = Product::get()->toArray();
        $positions = Positioning::get()->toArray();
        $publisherId=$publisherId;
        $adId=$adId;
        $AdsData=array();
        if($adId!=''){
          $AdsData=Ads::where('id',decrypt($adId))->where('status','!=','Deleted')->get()->toArray();
        }
        return view('publisher/add_positions', compact('products','positions','publisherId','adId','AdsData'));
      }catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
      }
    }

    /**
      * Return Delete Ad Positions settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getDeletePositions($publisherId=null,$adId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status != 'Suspended'))){
            return redirect('publisher/positions/'.$publisherId)->with('error', 'You are not autorize to delete Ad Positions.');
        }
        //Soft Delete Ads Positions
        if(Auth::user()->role==1){
          //Admin
          $UpdateStatus=Ads::where('id',decrypt($adId))->update(array('status'=>$status));
            return redirect('publisher/positions/'.$publisherId)->with('success', 'Ad Positions '.$status.' Successfully.');
        }else{
          $getUserId=Ads::join('publishers', 'publishers.id', '=', 'ads.publisher_id')->select('publishers.user_id')->where('ads.id',decrypt($adId))->get();
          if(($getUserId[0]->user_id) == (Auth::user()->id)){
            $UpdateStatus=Ads::where('id',decrypt($adId))->update(array('status'=>$status));
            return redirect('publisher/positions/'.$publisherId)->with('success', 'Ad Positions '.$status.' Successfully.');
          }else{
            return redirect('publisher/positions/'.$publisherId)->with('error', 'You are not autorize to delete Ad Positions.');
          }
        }        
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return Post Ad Positions settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function postAddPositions(Requests\AddPositionSetting $request)
    {
      try {
        $data = $request->all();
        $publisherId=decrypt($data['publisherId']);
        $Adsdata=array('status'=>(isset($data['status'])) ? $data['status'] : 'Inactive',
                        'publisher_id'=>$publisherId,
                        'slotname'=>$data['slotname'],
                        'container'=>$data['container'],
                        'positioning'=>$data['positioning'],
                        'mobile_sizes'=>($data['mobile'] =='default' ? $data['mobile'] : $data['mobile_sizes']),
                        'tablet_sizes'=>($data['tablet'] =='default' ? $data['tablet'] : $data['tablet_sizes']),
                        'desktop_sizes'=>($data['desktop'] =='default' ? $data['desktop'] : $data['desktop_sizes']),
                        'lazyload'=>(isset($data['lazyload'])) ? $data['lazyload'] : 0,
                        'page_type'=>serialize($data['page_type']),
                  );
        if($data['adId']){
          //Update Ads Data
          $Adsdata['updated_by'] = Auth::user()->id;
          $Adsdata['updated_ip'] = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
          $updateAds=Ads::where('id',decrypt($data['adId']))->update($Adsdata);
        }else{
          //Insert Ads Data
          $insertAds=Ads::insert($Adsdata);
        }
        return redirect('/publisher/add-custom/'.$data['publisherId']);
      }catch (\Exception $e) 
      {   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Custom settings.
      * @param           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getAddCustom($publisherId=null)
    {
      try {
          $publisherId=$publisherId;
          $customScripting=Publisher::select('custom_scripting')->where('id',decrypt($publisherId))->get()->toArray();
          return view('publisher/add_custom', compact('publisherId','customScripting'));
      }catch (\Exception $e) 
      {   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Save the Add Custom Scripting.
      * @param Request $request           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function postAddCustom(Requests\AddCustom $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $data = $request->all();
            if($data['publisherId']){
              $publisher_id=decrypt($data['publisherId']);
              $publisherData=array('custom_scripting'=>$data['custom_scripting'],'updated_by'=>Auth::user()->id,'updated_ip'=>(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']);
              $Publisher_Id=Publisher::where('id',$publisher_id)->update($publisherData);
            }
            return redirect('publisher/publishers');
        }catch (\Exception $e){   
          $result = ['exception_message' => $e->getMessage()];
          return view('errors.error', $result);
        }
    }
}