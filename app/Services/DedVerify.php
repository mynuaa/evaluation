<?php namespace App\Services;

/*
教务处登录返回码及其含义：（switch (num)）
num 	含义
0		学生登陆
1		教师登录
19		未知（同登录失败）
77		用户被禁用
88		用户名密码错误
99		用户名密码错误
100		家长用户
default 其他未知功能（包括教师登录在内）

# P.S. 这设计蠢爆了
*/

class DedVerify {
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

		return (strstr($response, 'switch (0){') != false);
	}
}
