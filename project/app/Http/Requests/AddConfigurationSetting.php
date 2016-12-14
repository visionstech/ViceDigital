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
		$rules= array();
        $rules ['website'] = trim('required|min:5|max:50');
        $rules ['name']		=trim('required|regex:/^[\pL\s]+$/u|min:5|max:50');
        if($this->request->get('method')=="Update"){
				$rules['email'] = trim('required|email|unique:publishers,email,'.decrypt($this->request->get('publisherId')));
		}else{
				$rules ['email'] = trim('required|email|unique:publishers');
		}
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
