<?php namespace App\Http\Requests;

use App;


class NewUser extends Request {

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
                'website'    => trim('required|min:5|max:50|unique:publishers'),
                'name'      => trim('required|regex:/^[\pL\s]+$/u|min:5|max:50'),
                'email'     => trim('required|email|max:100|unique:users'),
                'password'  => 'required|confirmed|min:5|max:50',
            ];
	}
	
	public function messages()
	{	
            return [
                'email.email'   => 'The must be a valid email address.',
                'website.required' => 'The domain is required.',
                'website.min' => 'The domain must be at least 5 characters.',
                'website.max' => 'The domain may not be greater than 50 characters.',
                'website.unique' => 'The domain is already taken.',
            ];
		
	}
	
}
