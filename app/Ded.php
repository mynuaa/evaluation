<?php namespace App;

class Ded {

	public $stuid = "";
	public $password = "";
	private $flag = false;

	public function __construct($stuid, $password)
	{
		$this->stuid = $stuid;
		$this->password = $password;

		$this->verify();
	}

	private function verify()
	{
		$url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
		$post = "user=".$this->stuid."&pwd=".$this->password;
		$cookie = tmpfile();

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

		$this->flag = (strstr($response, 'switch (0){') != false);
	}

	public function isValid()
	{
		return $this->flag;
	}

}
