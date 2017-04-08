<?php namespace App\Services;

class HrVerify {
	public function verify($stuid, $password) {
		$url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
		$post = "user=".urlencode($stuid)."&pwd=".urlencode($password);
		$cookie = tempnam(storage_path().'/framework/cache', 'COOKIE_');

		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $post,
			CURLOPT_COOKIEJAR => $cookie,
			CURLOPT_RETURNTRANSFER => 1,
		]);

		curl_exec($curl);

		curl_setopt_array($curl, [
			CURLOPT_COOKIEFILE => $cookie,
			CURLOPT_REFERER => 'http://ded.nuaa.edu.cn'
		]);

		$response = curl_exec($curl);
		curl_close($curl);

		$status =  !((strstr($response, 'switch (0){') != false) ||//学生验证，避免与dedVerify重复
					(strstr($response, 'switch (77){') != false) ||// 错误码
					(strstr($response, 'switch (88){') != false) ||// 错误码
					(strstr($response, 'switch (99){') != false) ||// 错误码
					(strstr($response, 'switch (100){') != false)||// 家长账号
					(strstr($response, 'switch (19){') != false));// 错误码
		// return $response;
		return $status;
		// return (strstr($response, 'switch (1){') != false);
	}
}
