<?php namespace App\Http\Requests;

use App;

class ConfigurationSetting extends Request {

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
            return [
                'name'      => trim('required|regex:/^[\pL\s]+$/u|min:3|max:32'),
                'password'  => 'sometimes|confirmed|min:5|max:50',
                'products'  => 'sometimes',
            ];
	}
	
	public function messages()
	{	
            return [];
		
	}
	
}
