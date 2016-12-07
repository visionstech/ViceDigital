<?php namespace App\Http\Requests;

use App;
use Auth;
class AddConfigurationSetting extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{	
		if($this->request->get('method')=="Update"){
				$rules= array('email'  => trim('required|email|unique:publishers,'.Auth::user()->id));
		}else{
				$rules= array('email'  => trim('required|email|unique:publishers'));
		}
        $rules= array(
            	'website'=> trim('required|min:5|max:50'),
                'name'   => trim('required|regex:/^[\pL\s]+$/u|min:5|max:50')
            );
		return $rules;
	}
	
	public function messages()
	{	
        $messages=array(
            	'website.required'=>'The domain field is required.',
            	'name.required' =>'The contact name field is required.',
            	'email.required' =>'The contact email field is required.'
            );
      	return $messages;
	}
	
}
