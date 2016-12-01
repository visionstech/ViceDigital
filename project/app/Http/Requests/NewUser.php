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
                'website'    => trim('required|min:3|max:32|unique:publishers'),
                'name'      => trim('required|alpha|min:3|max:32'),
                'email'     => trim('required|email|max:100|unique:users'),
                'password'  => 'required|confirmed|min:6|max:30',
                'products'  => 'required',
            ];
	}
	
	public function messages()
	{	
            return [
                'email.email'   => 'The must be a valid email address.',
                'website.required' => 'The domain is required.',
                'website.min' => 'The domain must be at least 3 characters.',
                'website.max' => 'The domain may not be greater than 32 characters.',
                'website.unique' => 'The domain is already taken.',
            ];
		
	}
	
}
