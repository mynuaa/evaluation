<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Services\DedVerify;
use App\Http\Requests\LoginPostRequest;

use Validator, Auth, App\User;

class UserController extends Controller {

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
			echo "Login successed!";
		}
		else
		{
			if ($ded->verify($username, $password))
			{
				$user = User::firstOrNew(['username'] => $username);
				$user->password = bcrypt($password);
				$user->save();
				
				Auth::login($user, true);
			}
			else
			{
				return redirect('user/login')->withMessage(['type' => 'error', 'content' => trans('message.login_failed')]);
			}
		}

		return redirect('/')->withMessage(['type' => 'error', 'content' => trans('message.login_successed')]);
	}

	public function getLogout()
	{
		Auth::logout();

		return redirect('/');
	}
}
