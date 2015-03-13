<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Filesystem;
use Illuminate\Http\Request;
use Storage;
use App\Ded;

class TestController extends Controller {

	public function getIndex()
	{
		var_dump(\DB::connection()->enableQueryLog());
	}

	public function getConfirm($stuid = "sx1416078", $password = "luan030104")
	{
		$url = "http://gsmis.nuaa.edu.cn:81/nuaapyxx/login.aspx";
		$postdata = "__VIEWSTATE=dDwyMTQxMjc4NDIxOztsPF9jdGwwOkltYWdlQnV0dG9uMTtfY3RsMDpJbWFnZUJ1dHRvbjI7Pj4a4X2ljr3fw2%2B5%2F%2BJjanCAT7WEVQ%3D%3D";//"__VIEWSTATE=dDwyMTQxMjc4NDIxOztsPF9jdGwwOkltYWdlQnV0dG9uMTtfY3RsMDpJbWFnZUJ1dHRvbjI7Pj5y2sfs6%2FBl5gJyKBqKCf8abwyKCw%3D%3D&_ctl0%3Atxtusername=".urlencode($stuid)."&_ctl0%3AImageButton1.x=41&_ctl0%3AImageButton1.y=23&_ctl0%3Atxtpassword=".urlencode($password);
		$postdata .= "&_ctl0%3Atxtusername=".urlencode($stuid);
		$postdata .= "&_ctl0%3AImageButton1.x=48";
		$postdata .= "&_ctl0%3AImageButton1.y=10";
		$postdata .= "&_ctl0%3Atxtpassword=".urldecode($password);
		$cookie = "ASP.NET_SessionId=j5kcus3tqqqharrmkzrlyr45";
		$cookie_file = tempnam(storage_path()."\\framework\\cache\\", 'cookie');

		$curl = curl_init();

		// curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Accept-Encoding: gzip, deflate',
			'Connection: Keep-Alive',
			'Keep-Alive: 60',
			'Content-Type: application/x-www-form-urlencoded',
			'Cookie: ASP.NET_SessionId=j5kcus3tqqqharrmkzrlyr45'
		));
		curl_setopt($curl, CURLOPT_COOKIE, $cookie);


		$response = curl_exec($curl);
		$info = curl_getinfo($curl);

		// echo $response;
		var_dump($info);

		echo curl_error($curl);

		curl_close($curl);
	}

	public function getDed($stuid = "161220227", $password = "St022515")
	{
        $ded = new Ded($stuid, $password);

        var_dump($ded->isValid());
	}
}
	