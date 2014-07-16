<?php
Namespace Electrical\Engineering\Whois;
require_once('su-whois.php');




if( isset($_GET['host']) ):
  if( strpos($_GET['host'], '.') > 0):
    $str_arr = explode('.', $_GET['host']);
    $host = $str_arr[0];
  else:
    $host = $_GET['host'];
  endif;
else:
  $host = 'eecore';
endif;

$rec = suWhois::whois($host.__DOMAIN__);

if(!$rec):
  print 'Host Ok';
else:
  print '<div><p>Host not ok</p><p>Results Below';
  print '<pre>';
  print_r($rec);
  print '</pre></p></div>';
  for($i=0; $i<count($rec->hosts); $i++):
    if($i == 0):
      print 'Hostname : ' . $rec->hosts[$i] . '<br />';
    elseif($rec->hosts[$i] == ''):
      continue;
    else:
      print 'Alias : ' . $rec->hosts[$i] . '<br />';
    endif;
  endfor;
  print $rec->admin->name. ' [ <a href="'.__SEARCH_URL__.$rec->admin->who.'" title="Go to stanfordwho page">Contact Info<a> ]';
endif;

?>
