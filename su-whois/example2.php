<?php
Namespace Electrical\Engineering\Whois;
require_once('su-whois.php');

$who = new suWhois();

//$who2 = $who->whois('00:21:9b:80:ab:bd');
$who2 = $who->whois('4439.c419.f1d8');
//$who2 = $who->whois('reric.stanford.edu');


print_r($who2);


?>
