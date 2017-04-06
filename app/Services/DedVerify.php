<?php namespace App\Services;

class DedVerify {
	public function verify($stuid, $password) {
		$url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
		$post = "user=".$stuid."&pwd=".urlencode($password);
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

		// fclose($cookie);
		// return $response;
		return (strstr($response, 'switch (0){') != false);
	}
}
