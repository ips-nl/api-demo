<?php
require_once "classes/class.ipsapi.php";

echo "<pre>";
$ips = new IPS_Api();

// GET ALL CLIENTS EXAMPLE
$clients = $ips->Clients_GetALL();
print_r($clients);

// GET ALL DOMAINS EXAMPLE
$domains = $ips->Domains_GetAll();
print_r($domains);

// GET ALL AUTORESPONDERS FOR DOMAIN EXAMPLE
$autoresponders = $ips->Domains_Autoresponders_GetAll("demodomeinnaam.nl");
print_r($autoresponders);

// GET DETAILS OF AUTORESPONDER EXAMPLE
$autoresponder = $ips->Domains_Autoresponders_GetOne("demodomeinnaam.nl", "ips");
print_r($autoresponder);

// GET ALL DNS RECORDS FOR DOMAINNAME EXAMPLE
$dnsrecords = $ips->Domains_DNS_GetAll("demodomeinnaam.nl");
print_r($dnsrecords);

// GET DETAILS OF DNS RECORD EXAMPLE
$dnsrecord = $ips->Domains_DNS_GetOne("demodomeinnaam.nl", 1344921);
print_r($dnsrecord);

// GET ALL DATABASES FOR DOMAIN EXAMPLE
$databases = $ips->Domains_Databases_GetAll("demodomeinnaam.nl");
print_r($databases);

// GET DETAILS OF DATABASE EXAMPLE
$database = $ips->Domains_Databases_GetOne("demodomeinnaam.nl", "demodomenl_test");
print_r($database);

// GET ALL FTP USERS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_FTPUsers_GetAll("demodomeinnaam.nl");
print_r($ftpusers);

// GET DETAILS OF FTP USERS EXAMPLE
$ftpuser = $ips->Domains_FTPUsers_GetOne("demodomeinnaam.nl", "demodomenl");
print_r($ftpuser);

// GET ALL MAIL FORWARDS FOR DOMAIN EXAMPLE
$ftpusers = $ips->Domains_MailForwards_GetAll("demodomeinnaam.nl");
print_r($ftpusers);

// GET DETAILS OF MAIL FORWARD EXAMPLE
$ftpuser = $ips->Domains_MailForwards_GetOne("demodomeinnaam.nl", "test");
print_r($ftpuser);

// GET ALL MAILBOXES FOR DOMAIN EXAMPLE
$mailboxes = $ips->Domains_Mailboxes_GetAll("demodomeinnaam.nl");
print_r($mailboxes);

// GET DETAILS OF MAILBOXES EXAMPLE
$mailbox = $ips->Domains_Mailboxes_GetOne("demodomeinnaam.nl", "nagios");
print_r($mailbox);

echo "</pre>";
