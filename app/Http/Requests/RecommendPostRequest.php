<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Recommendation, Auth, Session;

class RecommendPostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return ! Recommendation::user(Auth::user()->id)->apply($this->route('one'))->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'content' => 'required'
		];
	}

}
