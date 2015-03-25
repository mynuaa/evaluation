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
		$recommendations = Auth::user()->recommendations();

		if ($recommendations->count() >= config('business.recommend.max'))
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend_too_much')]);
		}
		else
		{
			return true;
		}
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
