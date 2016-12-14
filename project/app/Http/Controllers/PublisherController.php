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
use App\AdspositionTargetings;
use App\Ads;
use App\Positioning;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Auth;
use DB;


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
    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['except' => 'getRegister, postRegister']);
        $this->auth = $auth;
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
      * Updated on: 07/12/2016
    **/
    public function getPublishers()
    {
      try { 
          if((Auth::user()->role == 1) || (Auth::user()->role == 3)){
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
      * @param  Publisher Id      
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
      * Updated on: 09/12/2016
    **/
    public function postAddConfiguration(Requests\AddConfigurationSetting $request)
    {

        try {
          $user = User::find(Auth::user()->id);
          $data = $request->all();
          $publisherData=array(
                  'user_id'=>Auth::user()->id,
                  'status'=>$data['status'],
                  'overlays'=>((isset($data['products']))?((in_array(1,$data['products'])) ? 1 : 0):0),
                  'infusion'=>((isset($data['products']))?((in_array(2,$data['products'])) ? 1 : 0):0),
                  'dynamic_ads'=>((isset($data['products']))?((in_array(3,$data['products'])) ? 1 : 0):0),
                  'programmatic'=>((isset($data['products']))?((in_array(4,$data['products'])) ? 1 : 0):0),
                  'name'=>$data['name'],
                  'website'=>$data['website'],
                  'email'=>$data['email']
              );
          if(Auth::user()->role !=2 ){
            $publisherData['adunit_id']=$data['adunit_id'];
            $publisherData['krux_id']=$data['krux_id'];
            $publisherData['comscore_id']=$data['comscore_id'];
          }
          if($data['publisherId'] != '' ){

            //Update Publisher Data
            $publisherData['updated_by'] = Auth::user()->id;
            $publisherData['updated_ip'] = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
            $Publisher_Id=Publisher::where('id',decrypt($data['publisherId']))->update($publisherData);
          if(Auth::user()->role !=2 ){
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
                      PublisherPagetypes::where('id',$Value['id'])->delete();
                      $deletekeys++;
                    }
                    
                  }
              }
          }
            $Publisher_Id=encrypt($Publisher_Id);
            return redirect('publisher/add-configuration/'.$data['publisherId'])->with('success','Configuration Updated Successfully.');
          }else{
            //Insert Publisher Data
              $Publisher_Id=Publisher::insertGetId($publisherData);
              //This not for normal users as per client update
              if(Auth::user()->role !=2 ){
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
              }
              $Publisher_Id=encrypt($Publisher_Id);
              return redirect('publisher/add-configuration/'.$Publisher_Id)->with('success','Configuration Added Successfully.');
          }
			 
  		}catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
  }
    
    /**
      * List all the publishers.
      * @param  Publisher id      
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 07/12/2016
    **/
    public function getPositions($publisherId=null)
    {
        try {
            if($publisherId == ''){
              return redirect('/publisher/publishers');
            }
            if((Auth::user()->role == 1) || (Auth::user()->role == 3)){
              //For Admin And Partnership Manager Roles
              $positions = Ads::where('publisher_id',decrypt($publisherId))->get();
            }else{
              $positions = Ads::where('publisher_id',decrypt($publisherId))->where('status','!=','Deleted')->get();
            }
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
      * @param  Publisher id and Ad position id         
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 07/12/2016
    **/
    public function getAddPositions($publisherId=null,$adId=null)
    {
      try {
        if(Auth::user()->role == 2){
            return redirect('publisher/publishers')->with('error','You are not authorize to this location.');
        }
        $products = Product::get()->toArray();
        $positions = Positioning::get()->toArray();
        $publisherId=$publisherId;
        $Pagetypes=PublisherPagetypes::where('publisher_id',decrypt($publisherId))->get();
        $adId=$adId;
        $AdsData=array(); $TargetingData=array();
        if($adId!=''){
          $AdsData=Ads::where('id',decrypt($adId))->get()->toArray();
          $TargetingData=AdspositionTargetings::where('ads_id',decrypt($adId))->get()->toArray();
        }
        return view('publisher/add_positions', compact('products','positions','publisherId','adId','AdsData','TargetingData','Pagetypes'));
      }catch (\Exception $e) 
      { 	
        $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
      }
    }

    /**
      * Return Delete Ad Positions settings.
      * @param  Publisher id, Ad position id and Delete Status(Suspended or Deleted)         
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 07/12/2016
    **/
    public function getDeletePositions($publisherId=null,$adId=null,$status=null)
    {
      try {
        if(Auth::user()->role == 2){
            return redirect('publisher/publishers')->with('error','You are not authorize to this location.');
        }
        if(($status=='') || (($status !='Deleted') && ($status != 'Suspended'))){
            return redirect('publisher/positions/'.$publisherId)->with('error', 'You are not autorize to delete Ad Positions.');
        }
        //Soft Delete Ads Positions
        if((Auth::user()->role==1) || (Auth::user()->role==3)){
          //Admin and Patnership Manager
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
      * @param  Request $request      
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 07/12/2016
    **/
    public function postAddPositions(Requests\AddPositionSetting $request)
    {
      try {
        if(Auth::user()->role == 2){
            return redirect('publisher/publishers')->with('error','You are not authorize to this location.');
        }
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
                      'page_type'=>((isset($data['page_type']))?(serialize($data['page_type'])):''),
                  );
        if($data['adId']){
          //Update Ads Data
          $Adsdata['updated_by'] = Auth::user()->id;
          $Adsdata['updated_ip'] = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
          $updateAds=Ads::where('id',decrypt($data['adId']))->update($Adsdata);
            
            //Update Targeting Data
              $TargetingData=AdspositionTargetings::where('ads_id',decrypt($data['adId']))->get()->toArray();

              $targeting=array('publisher_id'=>decrypt($data['publisherId']),'updated_by'=>$Adsdata['updated_by'],'updated_ip'=>$Adsdata['updated_ip'],'ads_id'=>decrypt($data['adId']));
              $val=0;
              foreach($data['targeting_key'] as $key=>$Value){
                  if($val < sizeof($TargetingData)) {
                   //Update
                    $targeting['updated_at']=date('Y-m-d H:i:s');
                    $targeting['key']=$Value;
                    $targeting['value']=$data['targeting_value'][$val];
                    $targetInsert=AdspositionTargetings::where('id',$TargetingData[$val]['id'])->update($targeting);
                  }else{
                    //Insert
                    $targeting['key']=$Value;
                    $targeting['value']=$data['targeting_value'][$val];
                    $targetInsert=AdspositionTargetings::insert($targeting);
                  }
                 $val++;
              }
              if(sizeof($data['targeting_key']) < (sizeof($TargetingData))){
                  $deletekeys=sizeof($data['targeting_key']);
                  foreach($TargetingData as $key=>$Value){
                    if($key==$deletekeys){
                      $TargetingData=AdspositionTargetings::where('id',$Value['id'])->delete();
                      $deletekeys++;
                    }
                    
                  }
              }
            //End Update targeting Data
        }else{
          //Insert Ads Data
          $insertAds=Ads::insertGetId($Adsdata);
          $targeting=array('publisher_id'=>$publisherId,'ads_id'=>$insertAds);
          $val=0;
          foreach($data['targeting_key'] as $key=>$Value){
              $targeting['key']=$Value;
              $targeting['value']=$data['targeting_value'][$val];
              $targetInsert=AdspositionTargetings::insert($targeting);
              $val++;
          }
        }
        return redirect('/publisher/positions/'.$data['publisherId']);
      }catch (\Exception $e) 
      {   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Return get Custom settings.
      * @param  Publisher id         
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function getAddCustom($publisherId=null)
    {
      try {
          if(Auth::user()->role == 2){
              return redirect('publisher/publishers')->with('error','You are not authorize to this location.');
          }
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
      * @param  Request $request           
      * @return Response
      * Created on: 30/11/2016
      * Updated on: 02/12/2016
    **/
    public function postAddCustom(Requests\AddCustom $request)
    {
        try {
            if(Auth::user()->role == 2){
              return redirect('publisher/publishers')->with('error','You are not authorize to this location.');
            }
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