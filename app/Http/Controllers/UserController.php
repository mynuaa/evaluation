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

		if (Auth::attempt(['username' => $username, 'password' => $password]))
		{
			echo "Login successed!";
		}
		else
		{
			if ($ded->verify($username, $password))
			{
				echo "Ded login successed.";
				User::create([
					'username' => $username,
					'password' => bcrypt($password)
				]);
			}
			else
			{
				echo "Login faild.";
			}
		}
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
