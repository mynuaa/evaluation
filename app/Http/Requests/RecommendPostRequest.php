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
		$recommendations = Auth::user()->recommendations();

		if ($recommendations->where('apply_id', Input::get('applyid'))->exists())
		{
			abort(500, trans('message.recommend_before'));
		}

		if ($recommendations->count() >= config('business.recommend.max'))
		{
			abort(500, trans('message.recommend_too_much'));
		}

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
			'content' => 'required'
		];
	}

}
