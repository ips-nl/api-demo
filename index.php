<?php
require_once "classes/class.ipsapi.php";

echo "<pre>";
$ips = new IPS_Api();

// GET ALL CLIENTS EXAMPLE
$clients = $ips->Clients_GetALL();
var_dump($clients);

// GET ALL DOMAINS EXAMPLE
$domains = $ips->Domains_GetAll();
var_dump($domains);

// GET ALL AUTORESPONDERS FOR DOMAIN EXAMPLE
$autoresponders = $ips->Domains_Autoresponders_GetAll("demodomeinnaam.nl");
var_dump($autoresponders);

// GET DETAILS OF AUTORESPONDER EXAMPLE
$autoresponder = $ips->Domains_Autoresponders_GetOne("demodomeinnaam.nl", "ips");
var_dump($autoresponder);

// GET ALL DNS RECORDS FOR DOMAINNAME EXAMPLE
$dnsrecords = $ips->Domains_DNS_GetAll("demodomeinnaam.nl");
var_dump($dnsrecords);

// GET DETAILS OF DNS RECORD EXAMPLE
$dnsrecord = $ips->Domains_DNS_GetOne("demodomeinnaam.nl", 1344921);
var_dump($dnsrecord);

// ADD A DNS RECORD EXAMPLE
$dnsrecordadd = $ips->Domains_DNS_AddRecord("demodomeinnaam.nl", "apitest.demodomeinnaam.nl", "A", "127.0.0.10", 300, null);
var_dump($dnsrecordadd);
// SAVE THE ID TO DELETE LATER ON
$record_added = $dnsrecordadd['data']['id'];

// UPDATE A DNS RECORD EXAMPLE
$dnsrecordupdate = $ips->Domains_DNS_UpdateRecord("demodomeinnaam.nl",1344931,"demodomeinnaam.nl","sf02.ips.nl",300,20);
var_dump($dnsrecordupdate);

// DELETE A DNS RECORD EXAMPLE
$dnsrecorddelete = $ips->Domains_DNS_DeleteRecord("demodomeinnaam.nl",$record_added);
var_dump($dnsrecorddelete);

// GET ALL DATABASES FOR DOMAIN EXAMPLE
$databases = $ips->Domains_Databases_GetAll("demodomeinnaam.nl");
var_dump($databases);

// GET DETAILS OF DATABASE EXAMPLE
$database = $ips->Domains_Databases_GetOne("demodomeinnaam.nl", "demodomenl_test");
var_dump($database);

// GET ALL FTP USERS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_FTPUsers_GetAll("demodomeinnaam.nl");
var_dump($ftpusers);

// GET DETAILS OF FTP USERS EXAMPLE
$ftpuser = $ips->Domains_FTPUsers_GetOne("demodomeinnaam.nl", "demodomenl");
var_dump($ftpuser);

$ftpuseradd = $ips->Domains_FTPUsers_AddUser("demodomeinnaam.nl", "apitest", "yfi6gAH(q9kw9xns", "domain");
var_dump($ftpuseradd);

$ftpuserupdate = $ips->Domains_FTPUsers_UpdateUser("demodomeinnaam.nl","apitest","test123");
var_dump($ftpuserupdate);

$ftpuserdelete = $ips->Domains_FTPUsers_DeleteUser("demodomeinnaam.nl","apitest");
var_dump($ftpuserdelete);

// GET ALL MAIL FORWARDS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_MailForwards_GetAll("demodomeinnaam.nl");
var_dump($ftpusers);

// GET DETAILS OF MAIL FORWARD EXAMPLE
$ftpuser = $ips->Domains_MailForwards_GetOne("demodomeinnaam.nl", "test");
var_dump($ftpuser);

// GET ALL MAILBOXES FOR DOMAIN EXAMPLE
$mailboxes = $ips->Domains_Mailboxes_GetAll("demodomeinnaam.nl");
var_dump($mailboxes);

// GET DETAILS OF MAILBOXES EXAMPLE
$mailbox = $ips->Domains_Mailboxes_GetOne("demodomeinnaam.nl", "nagios");
var_dump($mailbox);

// GET ALL SHAREDHOSTING PRODUCTS EXAMPLE
$hostingproducts = $ips->Products_SharedHosting_GetAll();
var_dump($hostingproducts);

// GET ALL SSL CERTIFICATE PRODUCTS EXAMPLE
$sslproducts = $ips->Products_SSLCertificates_GetAll();
var_dump($sslproducts);

// CHECK IF TOP5 DOMAINS ARE AVAILABLE EXAMPLE
$checkdomain = $ips->Domains_Check_Top5("ips.pro");
var_dump($checkdomain);

// CHECK IF TOP5 DOMAINS ARE AVAILABLE EXAMPLE
$checkdomain15 = $ips->Domains_Check_Top15("ips.pro");
var_dump($checkdomain15);

// GET ALL SSLCERTIFICATES YOU OWN EXAMPLE
$sslcertificates = $ips->SSLCertificates_GetAll();
var_dump($sslcertificates);

// GET DETAILS OF SSL CERTIFICATE YOU OWN EXAMPLE
$sslcertificate = $ips->SSLCertificates_GetOne(1);
var_dump($sslcertificate);

echo "</pre>";
