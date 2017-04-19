<?php

require_once("includes/config.php");

class IPS_Api {

	public function __construct() {

		$this->connect();

	}

	private function connect() {
		$login = $this->_call("GET","/authenticate");
		return $login;
	}
	
	public function Clients_GetAll() {
		
		$clients = $this->_call("GET","/clients");
		return $clients;

	}

	public function Domains_GetAll() {

		$domains = $this->_call("GET","/domains");
		return $domains;
	
	}

	public function Domains_Autoresponders_GetAll($domainname) {

		if (!isset($domainname) OR empty($domainname)) {
			return false;
		}
		else {
			$autoresponders = $this->_call("GET","/domains/".$domainname."/mail_autoresponders/");
			return $autoresponders;
		}

	}

	private function _call($method, $url, $data = false) {
	
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => API_URL.API_VERSION.$url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_HTTPHEADER => array(
				"authorization: Basic ".base64_encode(API_USER.":".API_PASS).""
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		if ($err) {
			return false;
		} else {
			return json_decode($response,true);
		}

	}

}
