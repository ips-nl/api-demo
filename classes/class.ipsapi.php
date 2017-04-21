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
      $autoresponders = $this->_call("GET", "/domains/".$domainname."/mail_autoresponders");
      return $autoresponders;
    }

  }


  public function Domains_Autoresponders_GetOne($domainname, $autoresponder) {

    if (!isset($domainname, $autoresponder) or empty($domainname) or empty($autoresponder)) {
      return false;
    }
    else {
      $autoresponders = $this->_call("GET", "/domains/".$domainname."/mail_autoresponders/".$autoresponder);
      return $autoresponders;
    }

  }


  public function Domains_DNS_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $dnsrecords = $this->_call("GET", "/domains/".$domainname."/dns_records");
      return $dnsrecords;
    }

  }


  public function Domains_DNS_GetOne($domainname, $record_id) {

    if (!isset($domainname, $record_id) or empty($domainname) or empty($record_id) or !is_numeric($record_id)) {
      return false;
    }
    else {
      $dnsrecords = $this->_call("GET", "/domains/".$domainname."/dns_records/".$record_id);
      return $dnsrecords;
    }

  }


  public function Domains_DNS_AddRecord($domainname, $name, $type, $content, $ttl, $prio = null) {

    if (!isset($domainname, $name, $type, $content, $ttl) or empty($domainname) or empty($name) or empty($type) or empty($content) or empty($ttl)) {
      return false;
    }
    else {
      $postdata = array("name" => $name, "type" => $type, "content" => $content, "ttl" => $ttl);

      $dnsrecord = $this->_call("POST", "/domains/".$domainname."/dns_records", json_encode($postdata));
      return $dnsrecord;
    }

  }


  public function Domains_DNS_UpdateRecord($domainname, $record_id, $name, $content, $ttl, $prio = null) {

    if (!isset($domainname, $record_id, $name, $content, $ttl) or empty($domainname) or empty($record_id) or empty($name) or empty($content) or empty($ttl) or !is_numeric($record_id)) {
      return false;
    }
    else {
      $postdata = array("name" => $name, "content" => $content, "ttl" => $ttl, "prio" => $prio);

      $dnsrecord = $this->_call("PUT", "/domains/".$domainname."/dns_records/".$record_id, json_encode($postdata));
      return $dnsrecord;
    }

  }


  public function Domains_DNS_DeleteRecord($domainname, $record_id) {

    if (!isset($domainname, $record_id) or empty($domainname) or empty($record_id)) {
      return false;
    }
    else {

      $dnsrecord = $this->_call("DELETE", "/domains/".$domainname."/dns_records/".$record_id, json_encode($postdata));
      return $dnsrecord;
    }

  }


  public function Domains_Databases_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $databases = $this->_call("GET", "/domains/".$domainname."/databases");
      return $databases;
    }

  }


  public function Domains_Databases_GetOne($domainname, $database) {

    if (!isset($domainname, $database) or empty($domainname) or empty($database)) {
      return false;
    }
    else {
      $databases = $this->_call("GET", "/domains/".$domainname."/databases/".$database);
      return $databases;
    }

  }


  public function Domains_FTPUsers_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $ftpusers = $this->_call("GET", "/domains/".$domainname."/ftp_users");
      return $ftpusers;
    }

  }


  public function Domains_FTPUsers_GetOne($domainname, $ftpuser) {

    if (!isset($domainname, $ftpuser) or empty($domainname) or empty($ftpuser)) {
      return false;
    }
    else {
      $ftpusers = $this->_call("GET", "/domains/".$domainname."/ftp_users/".$ftpuser);
      return $ftpusers;
    }

  }


  public function Domains_FTPUsers_AddUser($domainname, $ftpuser, $ftppass, $type = 'domain') {

    if (!isset($domainname, $ftpuser, $ftppass) or empty($domainname) or empty($ftpuser) or empty($ftppass)) {
      return false;
    }
    else {
      $postdata = array("account" => $ftpuser, "password" => $ftppass, "type" => $type);

      $ftpusers = $this->_call("POST", "/domains/".$domainname."/ftp_users", json_encode($postdata));
      return $ftpusers;
    }

  }


  public function Domains_FTPUsers_UpdateUser($domainname, $ftpuser, $ftppass) {

    if (!isset($domainname, $ftpuser, $ftppass) or empty($domainname) or empty($ftpuser) or empty($ftppass)) {
      return false;
    }
    else {
      $postdata = array("password" => $ftppass);

      $ftpusers = $this->_call("PUT", "/domains/".$domainname."/ftp_users/".$ftpuser, json_encode($postdata));
      return $ftpusers;
    }

  }


  public function Domains_FTPUsers_DeleteUser($domainname, $ftpuser) {

    if (!isset($domainname, $ftpuser) or empty($domainname) or empty($ftpuser)) {
      return false;
    }
    else {
      $ftpusers = $this->_call("DELETE", "/domains/".$domainname."/ftp_users/".$ftpuser);
      return $ftpusers;
    }

  }


  public function Domains_MailForwards_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $mailforwards = $this->_call("GET", "/domains/".$domainname."/mail_forwards");
      return $mailforwards;
    }

  }


  public function Domains_MailForwards_GetOne($domainname, $mailforward) {

    if (!isset($domainname, $mailforward) or empty($domainname) or empty($mailforward)) {
      return false;
    }
    else {
      $mailforwards = $this->_call("GET", "/domains/".$domainname."/mail_forwards/".$mailforward);
      return $mailforwards;
    }

  }


  public function Domains_Mailboxes_GetAll($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $mailboxes = $this->_call("GET", "/domains/".$domainname."/mailboxes");
      return $mailboxes;
    }

  }


  public function Domains_Mailboxes_GetOne($domainname, $mailbox) {

    if (!isset($domainname, $mailbox) or empty($domainname) or empty($mailbox)) {
      return false;
    }
    else {
      $mailboxes = $this->_call("GET", "/domains/".$domainname."/mailboxes/".$mailbox);
      return $mailboxes;
    }

  }


  public function Products_SharedHosting_GetAll() {

    $sharedhostingproducts = $this->_call("GET", "/products/sharedhosting");
    return $sharedhostingproducts;

  }


  public function Products_SSLCertificates_GetAll() {

    $sslcertificates = $this->_call("GET", "/ssl_certificates/types");
    return $sslcertificates;

  }


  public function Domains_Check_Top5($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $domainavailable = $this->_call("GET", "/domain_availability/".$domainname);
      return $domainavailable;
    }

  }


  public function Domains_Check_Top15($domainname) {

    if (!isset($domainname) or empty($domainname)) {
      return false;
    }
    else {
      $domainavailable = $this->_call("GET", "/domain_availability/".$domainname."/all");
      return $domainavailable;
    }

  }


  public function SSLCertificates_GetAll() {

    $sslcertificates = $this->_call("GET", "/ssl_certificates");
    return $sslcertificates;

  }


  public function SSLCertificates_GetOne($record_id) {

    if (!isset($record_id) or empty($record_id) or !is_numeric($record_id)) {
      return false;
    }
    else {
      $sslcertificates = $this->_call("GET", "/ssl_certificates/".$record_id);
      return $sslcertificates;
    }

  }


  private function _call($method, $url, $data = false) {

    if ($this->token === null) {
      $login = "authorization: Basic ".base64_encode(API_USER.":".API_PASS);
    }
    else {
      $login = "authorization: ".$this->token;
    }

    print_r($data);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => API_URL.API_VERSION.$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
          $login,
          "content-type: application/json"
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
