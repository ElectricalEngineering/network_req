<?php
Namespace Electrical\Engineering\Whois;

define('__DOMAIN__', '.stanford.edu');
define('__SEARCH_URL__', 'https://stanfordwho.stanford.edu/SWApp/authSearch.do?search=');

class suWhois {

  public $domain;
  public $search;

  public function __construct(
    $domain = __DOMAIN__,
    $search = __SEARCH_URL__
  ) {
      $this->domain = $domain;
      $this->search = $search;
  }

  /**
   * Parses and returns a mac address.
   *
   * This function matches mac addresses from the stanford whois server
   *
   * @param $record
   *   a mac record
   *
   * @return
   *   Numeric array of matched mac addresses or NULL
   */
  private function getMac($record) {

    preg_match_all('/hw-addr: (.*)/', $record, $hwadd);
    array_shift($hwadd);

    $hwadd = $hwadd[0];

    for($i = 0; $i<count($hwadd); $i++):
      $hwadd[$i] = explode(' ', $hwadd[$i]);
      $hwadd[$i] = $hwadd[$i][0];
    endfor;

    if(is_array($hwadd)):
      return $hwadd;
    else:
      return NULL;
    endif;

  }

  /**
   * Parses and returns a host name and aliases if any exist.
   *
   * This function matches a host name and any aliases if they
   * exist in the stanford whois server
   *
   * @param $record
   *   A host record
   * @param $merged
   *   Whether or not to merge the default host and aliases together
   *   defaults to TRUE
   *
   * @return
   *   Array of hostname and any aliases if they exist
   */
  private function getHosts($record, $merged = TRUE) {

    preg_match('/name:(.*)/', $record, $names);

    if( is_array($names) ):
      array_shift($names);
      for($i=0;$i<count($names); $i++):
        $names[$i] = trim($names[$i]);
      endfor;
      $hostnames['default'] = array_shift($names);
    else:
      $hostnames['default'] = NULL;
    endif;

    preg_match('/alias:(.*)/s', $record, $aliases);

    if( is_array($aliases) && !empty($aliases) ):
      array_shift($aliases);
      $aliases = explode(',', explode('type:', $aliases[0])[0]);

      for($i=0;$i<count($aliases); $i++):
        $aliases[$i] = trim($aliases[$i]);
      endfor;
      $hostnames['aliases'] = $aliases;
    endif;

    if($merged):
      if(isset($hostnames['aliases'])):
        return array_merge( array($hostnames['default']), $hostnames['aliases']);
      else:
        return array($hostnames['default']);
      endif;
    else:
      return $hostnames;
    endif;
  }

  private function getGroups($record) {

    preg_match('/group:(.*)/s', $record, $groups);
    array_shift($groups);
    $groups = explode(',', explode('updated-by', $groups[0])[0]);

    foreach($groups as $key => $group):
      $groups[$key] = trim($groups[$key]);
    endforeach;
    return $groups;

  }

  private function getAdmin($record) {

    preg_match_all('/administrator:(.*)/s', $record, $administrator);

    if( is_array($administrator) ):

      // Faster than array_shift;
      $administrator = array_reverse($administrator);
      array_pop($administrator);

      // Strip the info we want
      preg_match('/\(([\d\w]+)\)/s', $administrator[0][0], $search);
      preg_match('/(.*)\(/', $administrator[0][0], $admin);
      $info['name'] = trim(array_pop($admin));
      $info['who'] = trim(array_pop($search));
    else:
      $info['name'] = NULL;
      $info['who'] = NULL;
    endif;

    return $info;

  }

  private function getDept($record) {

    preg_match('/department:(.*)/', $record, $dept);
    return trim($dept[1]);

  }

  private function getState($record) {

    preg_match('/state:(.*)/', $record, $state);
    return trim($state[1]);

  }

  private function getOS($record) {
    preg_match('/op-sys:(.*)/', $record, $os);
    if(is_array($os) && !empty($os)):
      return trim($os[1]);
    else:
      return false;
    endif;
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
   // print "\n\n$out\n\n";
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
      $record->hostnames = (object) suWhois::getHosts($result);
      $record->macs = suWhois::getMac($result);
      $record->os = suWhois::getOS($result);
      $record->groups = suWhois::getGroups($result);
      $record->dept = suWhois::getDept($result);
      $record->state = suWhois::getState($result);
      $record->admin = (object) suWhois::getAdmin($result);
      return $record;
    endif;
  }

} // End Class


?>
