<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ApplyPostRequest extends Request {

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
			'type' => 'required|numeric',
			'name' => 'required',
			'college' => 'required|numeric',
			'sex' => 'required|alpha',
			'native_place' => 'required',
			'political' => 'required',
			'major' => 'required',
			'title' => 'required',
			'whoami' => 'required',
			'story' => 'required',
			'insufficient' => 'required',
			'tags' => 'required|array'
		];
	}
}
