<?php namespace App\Services;

class GsmVerify {
	public function verify($gsmid, $password) {
		$prepare_curl = curl_init();
		curl_setopt_array($prepare_curl, [
			CURLOPT_URL => "http://gsmis.nuaa.edu.cn/pyxx/login.aspx",
			CURLOPT_RETURNTRANSFER => 1,
		]);
		preg_match('/name="__VIEWSTATE" value=".+?"/', curl_exec($prepare_curl), $viewstate);
		$viewstate = substr($viewstate[0], 26);
		$viewstate = preg_replace('/"/', '', $viewstate);
		$viewstate = urlencode($viewstate);
		curl_close($prepare_curl);
		$x = intval(rand(0, 60));
		$y = intval(rand(0, 60));
		$post = "__VIEWSTATE={$viewstate}&_ctl0%3Atxtusername={$gsmid}&_ctl0%3AImageButton1.x={$x}&_ctl0%3AImageButton1.y={$y}&_ctl0%3Atxtpassword={$password}";
		$url = "http://gsmis.nuaa.edu.cn/pyxx/login.aspx";
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_HTTPHEADER, array(
				"Content-type: application/x-www-form-urlencoded",
				"Origin: http://gsmis.nuaa.edu.cn"
			),
			CURLOPT_URL => $url,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $post,
			CURLOPT_RETURNTRANSFER => 1,
		]);
		$response = curl_exec($curl);
		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return $http_code == 302 || preg_match('/您已超过学习期限/', $response);
	}
}
