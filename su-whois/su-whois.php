<?php
Namespace Electrical\Engineering\Whois;

define('__DOMAIN__', '.stanford.edu');
define('__SEARCH_URL__', 'https://stanfordwho.stanford.edu/SWApp/authSearch.do?search=');

class suWhois {

  function getMac($record) {

    preg_match_all('/hw-addr: (.*)/', $record, $hwadd);
    array_shift($hwadd);
    $hwadd = $hwadd[0];
    for($i = 0; $i<count($hwadd); $i++):
      $hwadd[$i] = explode(' ', $hwadd[$i]);
      $hwadd[$i] = $hwadd[$i][0];
    endfor;

    return $hwadd;

  }

  function getHosts($record) {

    preg_match('/name:(.*)/', $record, $name);
    array_shift($name);
    for($i=0;$i<count($name); $i++):
      $name[$i] = trim($name[$i]);
    endfor;
    preg_match('/alias:(.*)/', $record, $alias);
    if($alias):
      array_shift($alias);
      $alias = explode(',', $alias[0]);
      for($i=0;$i<count($alias); $i++):
        $alias[$i] = trim($alias[$i]);
      endfor;
    endif;
    return array_merge($name, $alias);

  }

  function getGroups($record) {

    preg_match('/group:(.*)/', $record, $groups);
    array_shift($groups);
    return explode(',', trim($groups[0]));

  }

  function getAdmin($record) {

    preg_match_all('/administrator:(.*)/', $record, $administrator);
    array_shift($administrator);
    $administrator = $administrator[0][0];

    preg_match('/\(([\d\w]+)\)/', $administrator, $search);
    preg_match('/(.*)\(/', $administrator, $admin);

    return array('name' => trim($admin[1]), 'who' => $search[1]);

  }

  function getDept($record) {

    preg_match('/department:(.*)/', $record, $dept);
    return trim($dept[1]);

  }

  function getState($record) {

    preg_match('/state:(.*)/', $record, $state);
    return trim($state[1]);

  }

  public function whois($host){

    $result = '';
    $out = '';

    $fp = @fsockopen('whois.stanford.edu', 43, $errno, $errstr, 10)
      or die("Socket Error " . $errno . " - " . $errstr);
    fputs($fp, $host . "\r\n");

    while( !feof($fp) ):
      $out .= fgets($fp);
    endwhile;
    fclose($fp);

    if( !strpos( strtolower( $out ), 'error' ) && !strpos( strtolower( $out ), 'not allocated' ) && !strpos( strtolower( $out ), 'no match' ) ):
      $rows = explode( "\n", $out );
      foreach( $rows as $row ):
        $row = trim($row);
        if( $row != '' && $row{0} != '#' && $row{0} != '%' ):
          $result .= $row."\n";
        endif;
      endforeach;
    else:
      $result = FALSE;
    endif;

    if(!$result):
      return FALSE;
    else:

      $record = new \stdClass();
      $record->hosts = suWhois::getHosts($result);
      if( suWhois::getMac($result) ):
        $record->macs = suWhois::getMac($result);
      else:
        $record->macs = NULL;
      endif;

      $record->groups = suWhois::getGroups($result);
      $record->dept = suWhois::getDept($result);
      $record->state = suWhois::getState($result);
      $record->admin = (object) suWhois::getAdmin($result);
      return $record;
    endif;
  }

} // End Class


?>
