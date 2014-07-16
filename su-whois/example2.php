<?php
Namespace Electrical\Engineering\Whois;
require_once('su-whois.php');

$who = suWhois::whois('00:21:9b:80:ab:bd');

print('<pre>');
print_r($who);
print('</pre>');

?>
