<?php
Namespace Electrical\Engineering\Whois;
require_once('su-whois.php');


$who = new suWhois();

$who2 = $who->whois('4439.c419.f1d8');


print_r($who2);

?>
