<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Services\DedVerify;
use App\Http\Requests\LoginPostRequest;

use Validator, Auth, App\User, Input;

use App\Http\Requests\UpdatePostRequest;

class UserController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['getUpdate', 'postUpdate', 'getLogout', 'getRecommendations']]);
	}

	public function getLogin()
	{
		return view('user.login');
	}

	public function postLogin(DedVerify $ded, LoginPostRequest $request)
	{
		$username = $request->username;
		$password = $request->password;

		if (Auth::attempt(['username' => $username, 'password' => $password], true))
		{
			return redirect('/')->withMessage(['type' => 'success', 'content' => trans('message.login_successed')]);
		}
		else
		{
			if ($ded->verify($username, $password))
			{
				$user = User::firstOrNew(['username' => $username]);
				$user->password = bcrypt($password);
				$user->avatar = intval($username) % config('business.avatar.max');
				$user->save();

				Auth::login($user, true);
			}
			else
			{
				return redirect('user/update')->withMessage(['type' => 'info', 'content' => trans('message.user_info_needed')]);
			}
		}

		return redirect('/')->withMessage(['type' => 'success', 'content' => trans('message.login_successed')]);
	}

	public function getLogout()
	{
		Auth::logout();

		return redirect('/')->withMessage(['type' => 'success', 'content' => trans('message.logout_successed')]);
	}

	public function getUpdate()
	{
		return view('user.update')->withUser(Auth::user());
	}

	public function postUpdate(UpdatePostRequest $request)
	{
		$user = Auth::user();

		$user->name = $request->name;
		$user->college = $request->college;
		$user->avatar = $request->avatar;

		$user->save();

		return redirect('/')->withMessage(['type' => 'success', 'content' => trans('message.update_successed')]);
	}

	public function getRecommendations()
	{
		return view('user/recommendations')->withRecommendations(Auth::user()->myRecommendations);
	}
}
