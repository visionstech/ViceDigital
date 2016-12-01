<?php namespace App\Http\Requests;

use App;

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
          $rules= array(
            	'website'=> trim('required'),
                'name'   => trim('required|alpha|min:3|max:32'),
                'email'  => trim('required|email|unique:publishers'),
                'products' => trim('required'),
                'adunit_id' =>trim('required|numeric'),
                'krux_id' =>trim('required|numeric'),
                'comscore_id' =>trim('required|numeric'),
            );
			foreach($this->request->get('targeting_key') as $key => $val)
			{
			    $rules['targeting_key.'.$key] = 'required';
			    $rules['targeting_value.'.$key] = 'required';
			}
			foreach($this->request->get('page_type_title') as $key => $val)
			{
			    $rules['page_type_title.'.$key] = 'required';
			    $rules['page_type_selector.'.$key] = 'required';
			}
			
			return $rules;
	}
	
	public function messages()
	{	
        $messages=array(
            	'website.required'=>'The domain field is required.',
            	'name.required' =>'The contact name field is required.',
            	'email.required' =>'The contact email field is required.',
            	'products.required'=>'The standard products field is required.',
            );
        foreach($this->request->get('targeting_key') as $key => $val){

        	$messages['targeting_key.'.$key.'.required'] = 'The targeting key '.$key.' is required.';
        	$messages['targeting_value.'.$key.'.required'] = 'The targeting value '.$key.' is required.';
		}
		foreach($this->request->get('page_type_title') as $key => $val){

			$messages['page_type_title.'.$key.'.required'] = 'The page title '.$key.' is required.';
        	$messages['page_type_selector.'.$key.'.required'] = 'The selector '.$key.' is required.';
		}
		return $messages;
	}
	
}
