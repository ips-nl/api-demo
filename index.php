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

echo "</pre>";
