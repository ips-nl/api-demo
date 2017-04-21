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

// ADD AN AUTORESPONDER EXAMPLE
$autoresponderadd = $ips->Domains_Autoresponders_AddResponder("demodomeinnaam.nl", "apitest", "cc@ips.nl", "Dit is een autoresponder test voor de API");
var_dump($autoresponderadd);

// UPDATE AN AUTORESPONDER EXAMPLE
$autoresponderupdate = $ips->Domains_Autoresponders_UpdateResponder("demodomeinnaam.nl", "apitest", "cc2@ips.nl", "Dit is een update autoresponder test voor de API");
var_dump($autoresponderupdate);

// DELETE AN AUTORESPONDER EXAMPLE
$autoresponderdelete = $ips->Domains_Autoresponders_DeleteResponder("demodomeinnaam.nl", "apitest");
var_dump($autoresponderdelete);

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
$dnsrecordupdate = $ips->Domains_DNS_UpdateRecord("demodomeinnaam.nl", 1344931, "demodomeinnaam.nl", "sf02.ips.nl", 300, 20);
var_dump($dnsrecordupdate);

// DELETE A DNS RECORD EXAMPLE
$dnsrecorddelete = $ips->Domains_DNS_DeleteRecord("demodomeinnaam.nl", $record_added);
var_dump($dnsrecorddelete);

// GET ALL DATABASES FOR DOMAIN EXAMPLE
$databases = $ips->Domains_Databases_GetAll("demodomeinnaam.nl");
var_dump($databases);

// GET DETAILS OF DATABASE EXAMPLE
$database = $ips->Domains_Databases_GetOne("demodomeinnaam.nl", "demodomenl_test");
var_dump($database);

// ADD A DATABASE EXAMPLE
$databaseadd = $ips->Domains_Databases_AddDatabase("demodomeinnaam.nl", "apide", "demopass");
var_dump($databaseadd);

// UPDATE A DATABASE EXAMPLE
$databaseupdate = $ips->Domains_databases_UpdateDatabase("demodomeinnaam.nl", "demodomenl_apide", "otherpass");
var_dump($databaseupdate);

// DELETE A DATABASE EXAMPLE
$databasedelete = $ips->Domains_databases_DeleteDatabase("demodomeinnaam.nl", "demodomenl_apide");
var_dump($databasedelete);

// GET ALL FTP USERS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_FTPUsers_GetAll("demodomeinnaam.nl");
var_dump($ftpusers);

// GET DETAILS OF FTP USERS EXAMPLE
$ftpuser = $ips->Domains_FTPUsers_GetOne("demodomeinnaam.nl", "demodomenl");
var_dump($ftpuser);

// ADD A FTP USER EXAMPLE
$ftpuseradd = $ips->Domains_FTPUsers_AddUser("demodomeinnaam.nl", "apitest", "yfi6gAH(q9kw9xns", "domain");
var_dump($ftpuseradd);

// UPDATE A FTP USER EXAMPLE
$ftpuserupdate = $ips->Domains_FTPUsers_UpdateUser("demodomeinnaam.nl", "apitest", "test123");
var_dump($ftpuserupdate);

// DELETE A FTP USER EXAMPLE
$ftpuserdelete = $ips->Domains_FTPUsers_DeleteUser("demodomeinnaam.nl", "apitest");
var_dump($ftpuserdelete);

// GET ALL MAIL FORWARDS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_MailForwards_GetAll("demodomeinnaam.nl");
var_dump($ftpusers);

// GET DETAILS OF MAIL FORWARD EXAMPLE
$ftpuser = $ips->Domains_MailForwards_GetOne("demodomeinnaam.nl", "test");
var_dump($ftpuser);

// ADD A MAILFORWARDER EXAMPLE
$ftpuseradd = $ips->Domains_MailForwards_AddForwarder("demodomeinnaam.nl", "apitest", "email1@ips.nl,email2@ips.nl");
var_dump($ftpuseradd);

// UPDATE A MAILFORWARDER EXAMPLE
$ftpuseradd = $ips->Domains_MailForwards_UpdateForwarder("demodomeinnaam.nl", "apitest", "email3@ips.nl,email4@ips.nl");
var_dump($ftpuseradd);

// DELETE A MAILFORWARDER EXAMPLE
$ftpuseradd = $ips->Domains_MailForwards_DeleteForwarder("demodomeinnaam.nl", "apitest");
var_dump($ftpuseradd);

// GET ALL MAILBOXES FOR DOMAIN EXAMPLE
$mailboxes = $ips->Domains_Mailboxes_GetAll("demodomeinnaam.nl");
var_dump($mailboxes);

// GET DETAILS OF MAILBOXES EXAMPLE
$mailbox = $ips->Domains_Mailboxes_GetOne("demodomeinnaam.nl", "nagios");
var_dump($mailbox);

// ADD A MAILBOX EXAMPLE
$mailboxadd = $ips->Domains_Mailboxes_AddMailbox("demodomeinnaam.nl", "apitest", "pass123");
var_dump($mailboxadd);

// UPDATE A MAILBOX EXAMPLE
$mailboxupdate = $ips->Domains_Mailboxes_UpdateMailbox("demodomeinnaam.nl", "apitest", "apitest2", "pass456");
var_dump($mailboxupdate);

// DELETE A MAILBOX EXAMPLE
$mailboxdelete = $ips->Domains_Mailboxes_DeleteMailbox("demodomeinnaam.nl", "apitest2");
var_dump($mailboxdelete);

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

// ORDER EXAMPLE
$order_products = array();
$order_products[] = array("domain" => "apitestorder7.nl");
$order_products[] = array("domain" => "apitestorder8.nl", "code" => "linux-pro-5000");
$order_products[] = array("domain" => "apitestorder9.nl", "code" => "forward-domain-email", "value" => "www.ips.nl");

$order = $ips->AddOrder(178120, $order_products);
var_dump($order);

// SSL CERTIFICATE ORDER EXAMPLE
$contactinfo = array(
  "company" => "Demo Domeinnaam B.V.",
  "first_name" => "Demo",
  "last_name" => "Domeinnaam",
  "address" => "Stationsplein 45",
  "postal_code" => "3013AK",
  "city" => "Rotterdam",
  "province" => "Zuid-Holland",
  "country_code" => "NL",
  "email" => "demodomeinnaam@ips.nl",
  "phone_number" => "+31.881600600"
);
$sslorder = $ips->SSLCertificates_AddOrder("ssl-domain", "demodomeinnaam.nl", $contactinfo);
var_dump($sslorder);

// SSL CERTIFICATE CANCEL EXAMPLE
$sslcancel = $ips->SSLCertificates_CancelCertificate(1589);
var_dump($sslcancel);

// SSL CERTIFICATE DOWNLOAD CSR EXAMPLE
$ssldownloadcsr = $ips->SSLCertificates_DownloadCertificate(1589, "csr");
var_dump($ssldownloadcsr);

// SSL CERTIFICATE DOWNLOAD KEY EXAMPLE
$ssldownloadprivatekey = $ips->SSLCertificates_DownloadCertificate(1589, "private_key");
var_dump($ssldownloadprivatekey);

// SSL CERTIFICATE DOWNLOAD CRT EXAMPLE
$ssldownloadcrt = $ips->SSLCertificates_DownloadCertificate(1589, "crt");
var_dump($ssldownloadcrt);

// SSL CERTIFICATE DOWNLOAD CA_ROOT EXAMPLE
$ssldownloadcaroot = $ips->SSLCertificates_DownloadCertificate(1589, "ca_root");
var_dump($ssldownloadcaroot);

echo "</pre>";
