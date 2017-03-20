<?php namespace App\Services;

class HrVerify {
	public function verify($tid, $password) {
		$url = "http://net.nuaa.edu.cn/api/verifyUser.do?token=dd64533c961eb9d527a608f9cd13fb06&username="
			.urlencode($tid)
			."&password="
			.urlencode($password);

		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1,
		]);

		$response = curl_exec($curl);
		curl_close($curl);

		$response = json_decode($response, true);
		return $response['status'] == 0;
	}
}