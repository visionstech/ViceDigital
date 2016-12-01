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


class DashboardController extends Controller {

/**
      * Shows the Dashboard dashboard.
      * @param         
      * @return Response
      * Created on: 01/12/2016
      * Updated on: 01/12/2016
    **/
    public function getIndex()
    {
        try {	
            $products = Product::all();
            return view('dashboard/dashboard', compact('products'));
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
      * Shows the configuration settings.
      * @param      
      * @return Response
      * Created on: 01/12/2016
      * Updated on: 01/12/2016
    **/
    public function getConfiguration()
    {
        try {
            return view('dashboard/configuration');
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