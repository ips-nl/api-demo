<?php

require_once "includes/config.php";

class IPS_Api {

  var $token = null;

  public function __construct() {

    $connect = $this->connect();
    if ($connect !== true)
      die ("Login failed");

  }


  private function connect() {
    $login = $this->_call("GET", "/authenticate");

    if (isset($login['data']['token'])) {
      $this->token = $login['data']['token'];
      return true;
    }
    else
      return false;
  }


  public function Clients_GetAll() {

    $clients = $this->_call("GET", "/clients");
    return $clients;

  }


  public function Domains_GetAll() {

    $domains = $this->_call("GET", "/domains");
    return $domains;

  }


  public function Domains_Autoresponders_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $autoresponders = $this->_call("GET", "/domains/".$domainname."/mail_autoresponders/");
      return $autoresponders;
    }

  }


  private function _call($method, $url, $data = false) {

    if ($this->token === null) {
      $login = "authorization: Basic ".base64_encode(API_USER.":".API_PASS)."\n";
    }
    else {
      $login = "authorization: ".$this->token."\n";
    }

    echo $login;

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
          $login
        ),
      ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return false;
    } else {
      return json_decode($response, true);
    }

  }


}
