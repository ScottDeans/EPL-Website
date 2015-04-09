<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use DB;
use Auth;
class KitAddEditFormRequest extends Request {

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
			//
				'kitname' => 'required',
				'barcode'=> 'required|min:9|max:9',
				'branch' => 'required',
				'kittype'=> 'required',
		];
	}

}
