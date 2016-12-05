<?php namespace App\Http\Requests;

use App;

class AddPositionSetting extends Request {

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
                'slotname'      => trim('required|alpha|min:5|max:50'),
                'container'     => trim('required|min:5|max:50'),
                'positioning'   => trim('required'),
                'mobile'        => trim('required'),
                'tablet'        => trim('required'),
                'desktop'       => trim('required'),
                //'page_type'     => trim('required')
            ];
	}
	
	public function messages()
	{	
            return [
            	'slotname.required'	=>'The slot name field is required.',
            	'mobile.required'	=>'The mobile sizes field is required.',
            	'tablet.required'	=>'The tablet sizes field is required.',
            	'desktop.required'	=>'The desktop sizes field is required.'
            ];
		
	}
	
}
