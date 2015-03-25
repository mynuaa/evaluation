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
		$this->middleware('auth', ['only' => ['getUpdate', 'postUpdate', 'logout']]);
	}

	public function getLogin()
	{
		return view('user.login');
	}

	public function postLogin(DedVerify $ded, LoginPostRequest $request)
	{
		$username = $request['username'];
		$password = $request['password'];

		if (Auth::attempt(['username' => $username, 'password' => $password], true))
		{
			return redirect('user/update')->withMessage('type' => 'info', 'content' => trans('message.update_info'));
		}
		else
		{
			if ($ded->verify($username, $password))
			{
				$user = User::firstOrNew(['username' => $username]);
				$user->password = bcrypt($password);
				$user->save();
				
				Auth::login($user, true);
			}
			else
			{
				return redirect('user/login')->withMessage(['type' => 'error', 'content' => trans('message.login_failed')]);
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
		return view('user.update');
	}

	public function postUpdate(UpdatePostRequest $request)z
	{
		$user = Auth::user();

		$user->name = $request['name'];
		$user->college = $request['college'];

		$user->save();

		return redirect('/')->withMessage(['type' => 'success', 'content' => trans('message.update_successed')]);
	}
}
