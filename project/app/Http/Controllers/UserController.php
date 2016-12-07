<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use App\User;
use App\Role;
use App\Product;
use App\Publisher;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use DB;

class UserController extends Controller {
	
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller manages user's profile.
    |
    */


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {

        $this->middleware(['auth','admin'] );
        
        $this->auth = $auth;
    }

    /**
      * List all the users          
      * @return Response
      * Created on: 06/12/2016
      * Updated on: 06/12/2016
    **/

    public function getIndex()
    {
        try {
            $users=User::where('role','!=',1)->get();
            return view('user.users', compact('users'));
        }catch (\Exception $e){   
          $result = ['exception_message' => $e->getMessage()];
          return view('errors.error', $result);
        }
    }


    /**
      * Return get Add User Form.
      * @param   
      * @return Response
      * Created on: 06/12/2016
      * Updated on: 06/12/2016
    **/
    public function getAddUser($userId=null)
    {
      try {
        $userDetail=array();
        $publisherDetail=array();
        if($userId !=''){
            $userDetail=User::where('id',decrypt($userId))->get()->toArray(); 
            $publisherDetail=Publisher::where('email',$userDetail[0]['email'])->get()->toArray(); 
        }
        $roles=Role::all();
        $products=Product::all();
        return view('user/add_user',compact('roles','products','userDetail','publisherDetail','userId'));
      }catch (\Exception $e) 
      {
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }


    /**
      * Add user of any type of role.
      * @param Request $request            
      * @return Response
      * Created on: 06/12/2016
      * Updated on: 06/12/2016
    **/
    public function postAddUser(Requests\ManageUser $request)
    {
        try {
            $data = $request->all();
            if($data['userId']==''){
                $randomPassword=$this->getRandomString(10);

                $user_products = implode(',',$data['products']);
                // Create new user
                $create_user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($randomPassword),
                    'role' => $data['role']
                ]);

                // Save the domain for publisher

                $create_publisher = Publisher::create([
                    'user_id' => Auth::user()->id,
                    'website' => $data['website'],
                    'email' => $create_user->email,
                    'name' => $data['name'],
                    'overlays' => (in_array(1,$data['products'])) ? 1 : 0,
                    'infusion' => (in_array(2,$data['products'])) ? 1 : 0,
                    'dynamic_ads' => (in_array(3,$data['products'])) ? 1 : 0,
                    'programmatic' => (in_array(4,$data['products'])) ? 1 : 0,
                ]);
                $action='Added';
            }else{
                $GetData = User::where('id',decrypt($data['userId']))->get();
                $user_products = implode(',',$data['products']);
                $user = User::find(decrypt($data['userId']));
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->role = $data['role'];
                $user->status = $data['status'];                
                $user->updated_by = Auth::user()->id;
                $user->updated_ip = (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
                $user->role = $data['role'];
                $user->save();

                //Update publisher by unique user email instead of user id because one user belongs
                $updatePublisherData=Publisher::where('email',$GetData[0]->email)->update([
                    'user_id' => Auth::user()->id,
                    'website' => $data['website'],
                    'status' => $data['status'],
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'overlays' => (in_array(1,$data['products'])) ? 1 : 0,
                    'infusion' => (in_array(2,$data['products'])) ? 1 : 0,
                    'dynamic_ads' => (in_array(3,$data['products'])) ? 1 : 0,
                    'programmatic' => (in_array(4,$data['products'])) ? 1 : 0,
                    'updated_by'=>Auth::user()->id,
                    'updated_ip'=>(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']
                ]);
                $action='Updated';
                //Update Status of associated publishers to that user.
                if(isset($data['status']) && !empty($data['status'])){
                  $updatePublisherStatus=Publisher::where('user_id',decrypt($data['userId']))->update(array('status'=>$data['status']));
                }               
            }
            return redirect()->back()->with('success', 'User '.$action.' Successfully.');
        }
        catch (\Exception $e) 
        {   
            $result = ['exception_message' => $e->getMessage()];
            return view('errors.error', $result);
        }
    }

    /**
      * Return Delete User.
      * @param  User id and Delete Status(Suspended or Deleted)         
      * @return Response
      * Created on: 06/12/2016
      * Updated on: 06/12/2016
    **/
    public function getDeleteUser($userId=null,$status=null)
    {
      try {
        if(($status=='') || (($status !='Deleted') && ($status !='Live'))){
            return redirect('user')->with('error', 'You are not autorize to delete this user.');
        }
        //Soft Delete Users
        $updateUser=User::where('id',decrypt($userId))->update(array('status'=>$status));
        $updatePublisher=Publisher::where('user_id',decrypt($userId))->update(array('status'=>$status));
        return redirect('user')->with('success', 'User '.$status.' Successfully.');
      }catch (\Exception $e){   
        $result = ['exception_message' => $e->getMessage()];
        return view('errors.error', $result);
      }
    }

    /**
      * Generates Random String Will be used as Strong Password Generator.
      * @param Length $length of Password            
      * @return Response
      * Created on: 06/12/2016
      * Updated on: 06/12/2016
    **/

    public function getRandomString($length=null){
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ)(!@_-+=$%$^&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



}