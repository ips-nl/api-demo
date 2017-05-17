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
  
  
  public function Clients_GetOne($client_id) {

    if (!isset($client_id) or empty($client_id)) {
      return false;
    }
    else {
      $clients = $this->_call("GET", "/clients/".$client_id);
      return $clients;
    }

  }
  
  public function Clients_GetSSHKeys($client_id = null) {

    if (!isset($client_id) or empty($client_id) OR $client_id == null) {
      $sshkeys = $this->_call("GET", "/clients/self/ssh_keys");
      return $sshkeys;
    }
    else {
      $sshkeys = $this->_call("GET", "/clients/".$client_id."/ssh_keys");
      return $sshkeys;
    }
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


  public function Domains_Autoresponders_AddResponder($domainname, $autoresponder, $cc = null, $message) {

    if (!isset($domainname, $autoresponder, $message) or empty($domainname) or empty($autoresponder) or empty($message)) {
      return false;
    }
    else {
      $postdata = array("account" => $autoresponder, "cc" => $cc, "message" => $message);

      $autoresponders = $this->_call("POST", "/domains/".$domainname."/mail_autoresponders", json_encode($postdata));
      return $autoresponders;
    }

  }


  public function Domains_Autoresponders_UpdateResponder($domainname, $autoresponder, $cc = null, $message) {

    if (!isset($domainname, $autoresponder, $message) or empty($domainname) or empty($autoresponder) or empty($message)) {
      return false;
    }
    else {
      $postdata = array("cc" => $cc, "message" => $message);

      $autoresponders = $this->_call("PUT", "/domains/".$domainname."/mail_autoresponders/".urlencode($autoresponder), json_encode($postdata));
      return $autoresponders;
    }

  }


  public function Domains_Autoresponders_DeleteResponder($domainname, $autoresponder) {

    if (!isset($domainname, $autoresponder) or empty($domainname) or empty($autoresponder)) {
      return false;
    }
    else {
      $autoresponders = $this->_call("DELETE", "/domains/".$domainname."/mail_autoresponders/".$autoresponder);
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


  public function Domains_Databases_AddDatabase($domainname, $database, $password) {

    if (!isset($domainname, $database, $password) or empty($domainname) or empty($database) or empty($password)) {
      return false;
    }
    else {
      $postdata = array("database_name" => $database, "password" => $password);

      $databases = $this->_call("POST", "/domains/".$domainname."/databases/", json_encode($postdata));
      return $databases;
    }

  }


  public function Domains_Databases_UpdateDatabase($domainname, $database, $password) {

    if (!isset($domainname, $database, $password) or empty($domainname) or empty($database) or empty($password)) {
      return false;
    }
    else {
      $postdata = array("password" => $password);

      $databases = $this->_call("PUT", "/domains/".$domainname."/databases/".$database, json_encode($postdata));
      return $databases;
    }

  }


  public function Domains_Databases_DeleteDatabase($domainname, $database) {

    if (!isset($domainname, $database) or empty($domainname) or empty($database)) {
      return false;
    }
    else {
      $databases = $this->_call("DELETE", "/domains/".$domainname."/databases/".$database);
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


  public function Domains_MailForwards_AddForwarder($domainname, $mailforward, $forwardto) {

    if (!isset($domainname, $mailforward, $forwardto) or empty($domainname) or empty($mailforward) or empty($forwardto)) {
      return false;
    }
    else {
      $postdata = array("account" => $mailforward, "forward" => $forwardto);

      $mailforwards = $this->_call("POST", "/domains/".$domainname."/mail_forwards", json_encode($postdata));
      return $mailforwards;
    }

  }


  public function Domains_MailForwards_UpdateForwarder($domainname, $mailforward, $forwardto) {

    if (!isset($domainname, $mailforward, $forwardto) or empty($domainname) or empty($mailforward) or empty($forwardto)) {
      return false;
    }
    else {
      $postdata = array("forward" => $forwardto);

      $mailforwards = $this->_call("PUT", "/domains/".$domainname."/mail_forwards/".$mailforward, json_encode($postdata));
      return $mailforwards;
    }

  }


  public function Domains_MailForwards_DeleteForwarder($domainname, $mailforward) {

    if (!isset($domainname, $mailforward) or empty($domainname) or empty($mailforward)) {
      return false;
    }
    else {
      $mailforwards = $this->_call("DELETE", "/domains/".$domainname."/mail_forwards/".$mailforward);
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


  public function Domains_Mailboxes_AddMailbox($domainname, $mailbox, $password) {

    if (!isset($domainname, $mailbox, $password) or empty($domainname) or empty($mailbox) or empty($password)) {
      return false;
    }
    else {
      $postdata = array("account" => $mailbox, "password" => $password);

      $mailboxes = $this->_call("POST", "/domains/".$domainname."/mailboxes", json_encode($postdata));
      return $mailboxes;
    }

  }


  public function Domains_Mailboxes_UpdateMailbox($domainname, $mailbox_oldname, $mailbox_newname, $password) {

    if (!isset($domainname, $mailbox_oldname, $mailbox_newname, $password) or empty($domainname) or empty($mailbox_oldname) or empty($mailbox_newname) or empty($password)) {
      return false;
    }
    else {
      $postdata = array("account" => $mailbox_newname, "password" => $password);

      $mailboxes = $this->_call("PUT", "/domains/".$domainname."/mailboxes/".$mailbox_oldname, json_encode($postdata));
      return $mailboxes;
    }

  }


  public function Domains_Mailboxes_DeleteMailbox($domainname, $mailbox) {

    if (!isset($domainname, $mailbox) or empty($domainname) or empty($mailbox)) {
      return false;
    }
    else {
      $mailboxes = $this->_call("DELETE", "/domains/".$domainname."/mailboxes/".$mailbox);
      return $mailboxes;
    }

  }


  public function Products_SharedHosting_GetAll() {

    $sharedhostingproducts = $this->_call("GET", "/products/sharedhosting");
    return $sharedhostingproducts;

  }
  
  public function Products_Servers_GetAll() {

    $serverproducts = $this->_call("GET", "/products/servers");
    return $serverproducts;

  }


public function Products_Servers_GetOperatingSystems() {

    $serveros = $this->_call("GET", "/products/servers/operating_systems");
    return $serveros;

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


  public function SSLCertificates_AddOrder($code, $domainname, $contact_info) {

    if (!isset($code, $domainname, $contact_info) or !is_array($contact_info)) {
      return false;
    }
    else {
      $postdata = array("code" => $code, "domain" => $domainname, "contact_info" => $contact_info);

      $sslcertificateorder = $this->_call("POST", "/ssl_certificates", json_encode($postdata));
      return $sslcertificateorder;
    }

  }


  public function SSLCertificates_CancelCertificate($certificateId) {

    if (!isset($certificateId) or !is_numeric($certificateId)) {
      return false;
    }
    else {
      $sslcertificatecancallation = $this->_call("DELETE", "/ssl_certificates/".$certificateId);
      return $sslcertificatecancallation;
    }

  }


  public function SSLCertificates_DownloadCertificate($certificateId, $type) {

    $types = array("csr", "private_key", "crt", "ca_root");
    if (!isset($certificateId, $type) or !is_numeric($certificateId) or !in_array($type, $types)) {
      return false;
    }
    else {
      $sslcertificatedownload = $this->_call("GET", "/ssl_certificates/".$certificateId."/download/".$type);
      return $sslcertificatedownload;
    }

  }
  
  public function Servers_GetAll() {

    $servers = $this->_call("GET", "/servers");
    return $servers;

  }
  
  public function Servers_GetOne($server_id) {

    if (!isset($server_id) or !is_numeric($server_id)) {
      return false;
    }
    else {
      $servers = $this->_call("GET", "/servers/".$server_id);
      return $servers;
    }

  }


  public function AddOrder($clientID = null, $products) {

    if (!isset($products) or !is_array($products)) {
      return false;
    }
    else {

      if ($clientID !== null && is_numeric($clientID)) {
        $postdata = array("clientId" => $clientID, "products" => $products);
      }
      else {
        $postdata = array("products" => $products);
      }

      $order = $this->_call("POST", "/order", json_encode($postdata));
      return $order;
    }

  }
  
  
  public function AddServerOrder($hostname, $code, $username, $sshkeys, $os) {

    if (!isset($hostname,$code,$username,$sshkeys,$os) OR !is_array($sshkeys) OR !is_numeric($os) OR empty($hostname) OR empty($code) OR empty($username) OR empty($sshkeys) OR empty($os)) {
      return false;
    }
    else {
      $postdata = array("hostname" => $hostname, "code" => $code, "username" => $username, "sshKeyIds" => $sshkeys, "configuration" => array("os" => $os));
      
      $order = $this->_call("POST", "/servers", json_encode($postdata));
      return $order;
    }

  }


  private function _call($method, $url, $data = false) {

    if ($this->token === null) {
      $login = "authorization: Basic ".base64_encode(API_USER.":".API_PASS);
    }
    else {
      $login = "authorization: ".$this->token;
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
      $return = json_decode($response, true);
      if (json_last_error() == JSON_ERROR_NONE) {
        return $return;
      }
      else {
        return $response;
      }
    }

  }


}
