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


  public function Domains_Autoresponders_GetOne($domainname, $autoresponder) {

    if (!isset($domainname) or empty($domainname) or !isset($autoresponder) or empty($autoresponder)) {
      return false;
    }
    else {
      $autoresponders = $this->_call("GET", "/domains/".$domainname."/mail_autoresponders/".$autoresponder."/");
      return $autoresponders;
    }

  }


  public function Domains_DNS_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $dnsrecords = $this->_call("GET", "/domains/".$domainname."/dns_records/");
      return $dnsrecords;
    }

  }


  public function Domains_DNS_GetOne($domainname, $record_id) {

    if (!isset($domainname) or empty($domainname) or !isset($record_id) or empty($record_id) or !is_numeric($record_id)) {
      return false;
    }
    else {
      $dnsrecords = $this->_call("GET", "/domains/".$domainname."/dns_records/".$record_id."/");
      return $dnsrecords;
    }

  }


  public function Domains_Databases_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $databases = $this->_call("GET", "/domains/".$domainname."/databases/");
      return $databases;
    }

  }


  public function Domains_Databases_GetOne($domainname, $database) {

    if (!isset($domainname) or empty($domainname) or !isset($database) or empty($database)) {
      return false;
    }
    else {
      $databases = $this->_call("GET", "/domains/".$domainname."/databases/".$database."/");
      return $databases;
    }

  }


  public function Domains_FTPUsers_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $ftpusers = $this->_call("GET", "/domains/".$domainname."/ftp_users/");
      return $ftpusers;
    }

  }


  public function Domains_FTPUsers_GetOne($domainname, $ftpuser) {

    if (!isset($domainname) or empty($domainname) or !isset($ftpuser) or empty($ftpuser)) {
      return false;
    }
    else {
      $ftpusers = $this->_call("GET", "/domains/".$domainname."/ftp_users/".$ftpuser."/");
      return $ftpusers;
    }

  }


  public function Domains_MailForwards_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $mailforwards = $this->_call("GET", "/domains/".$domainname."/mail_forwards/");
      return $mailforwards;
    }

  }


  public function Domains_MailForwards_GetOne($domainname, $mailforward) {

    if (!isset($domainname) or empty($domainname) or !isset($mailforward) or empty($mailforward)) {
      return false;
    }
    else {
      $mailforwards = $this->_call("GET", "/domains/".$domainname."/mail_forwards/".$mailforward."/");
      return $mailforwards;
    }

  }


  public function Domains_Mailboxes_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $mailboxes = $this->_call("GET", "/domains/".$domainname."/mailboxes/");
      return $mailboxes;
    }

  }


  public function Domains_Mailboxes_GetOne($domainname, $mailbox) {

    if (!isset($domainname) or empty($domainname) or !isset($mailbox) or empty($mailbox)) {
      return false;
    }
    else {
      $mailboxes = $this->_call("GET", "/domains/".$domainname."/mailboxes/".$mailbox."/");
      return $mailboxes;
    }

  }


  private function _call($method, $url, $data = false) {

    if ($this->token === null) {
      $login = "authorization: Basic ".base64_encode(API_USER.":".API_PASS)."\n";
    }
    else {
      $login = "authorization: ".$this->token."\n";
    }

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
