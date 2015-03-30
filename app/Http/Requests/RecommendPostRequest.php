<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Recommendation, Auth, Session, Input;

class RecommendPostRequest extends Request {

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
			'applyid' => 'required|integer|exists:applies,id',
			'content' => 'required|min:50'
		];
	}

}
