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
				$user = User::create([
					'username' => $username,
					'password' => bcrypt($password)
				]);
				Auth::login($user, true);
				echo "Ded login successed.";
			}
			else
			{
				echo "Login faild.";
				return redirect('user/login');
			}
		}

		return redirect('/');
	}

	public function getLogout()
	{
		Auth::logout();

		return redirect()->back();
	}

	public function getUpdate()
	{
		return view('user.update');
	}
}
