<?php /**
 * Ajax validation for mac addresses
 * Checks if the mac address is already in netdb
 * Checks if is a residential computer and needs the
 * Stanford or Engineering group to be modified.
 */
function __check_mac($form, &$form_state) {
  $el = $form_state['triggering_element']['#name'];
  $val = $form['computer']['mac'][$el]['#value'];

  if( $val == '' ):
    return '<div id="uniq_mac_'.$el.'"" style="display:inline-block; color:#000000;">(eg. aa:bb:cc:dd:ee:ff)</div>';
  elseif( strlen($val) < 12  ):
    return '<div id="uniq_mac_'.$el.'" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;Mac address is to short, please enter in the form aa:bb:cc:dd:ee:ff.</small></em></div>';
  elseif( !(preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', check_plain($val)) == 1) ):
    return '<div id="uniq_mac_'.$el.'" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;Mac should contain no spaces or special characters [#$%^&*()!@_+=].</small></em></div>';
  else:
    switch($el):
      case 'wired':
       $record = Electrical\Engineering\Whois\suWhois::whois($form['computer']['mac']['wired']['#value']);
        if(!$record):
          return '<div id="uniq_mac_wired" style="display:inline-block; color:#029302; font-weight:bold;">&nbsp;&#10004;</div>';
        else:
          if( $record->state == 'Unknown' ):
<<<<<<< HEAD
            $_SESSION['unknown_state'] = TRUE;
            return '<div id="uniq_mac_wired" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;This MAC address is already registered and in an Unknown state.</em></small></div>';
=======
            return '<div id="uniq_mac_wired" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;This MAC address is already registered and in an Unknown state.  Please an email to ee-networking@ee.stanford.edu with your MAC address and this error. </em></small></div>';
>>>>>>> b035c0855cd454681f71f5219b0e4f0d16f51e9e
          elseif( in_array('Residential Computing', $record->groups) ):
            return '<div id="uniq_mac_wired" style="display:inline-block; color:#990009;">' . residential_modal('&#8629;&nbsp;This MAC address is already registered with Residential computing.  Please contact your Local Network Admin and ask them to add the group Stanford or Electrical Engineering to the record.') . '<em><small>&#8629;&nbsp;This MAC address is already registered with Residential computing.  Please contact your Local Network Admin. </em></small></div>';
          else:
            return '<div id="uniq_mac_wired" style="display:inline-block; color:#990009; font-weight:bold;"><em><small>&#8629;&nbsp;This MAC address is already registered.</em></small> </div>';
          endif;
        endif;

      break;
      case 'wireless':
          $record = Electrical\Engineering\Whois\suWhois::whois($form['computer']['mac']['wireless']['#value']);
        if(!$record):
          return '<div id="uniq_mac_wireless" style="display:inline-block; color:#029302; font-weight:bold;">&nbsp;&#10004;</div>';
        else:
          if( $record->state == 'Unknown' ):
<<<<<<< HEAD
            $_SESSION['unknown_state'] = TRUE;
            return '<div id="uniq_mac_wireless" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;This MAC address is already registered and in an Unknown state. </em></small></div>';
=======
            return '<div id="uniq_mac_wireless" style="display:inline-block; color:#990009;"><em><small>&#8629;&nbsp;This MAC address is already registered and in an Unknown state.  Please an email to ee-networking@ee.stanford.edu with your MAC address and this error. </em></small></div>';
>>>>>>> b035c0855cd454681f71f5219b0e4f0d16f51e9e
          elseif( in_array('Residential Computing', $record->groups) ):

            return '<div id="uniq_mac_wireless" style="display:inline-block; color:#990009;">' . residential_modal('&#8629;&nbsp;This MAC address is already registered with Residential computing.  Please contact your Local Network Admin and ask them to add the group Stanford or Electrical Engineering to the record.') . '<em><small>&#8629;&nbsp;This MAC address is already registered with Residential computing.  Please contact your Local Network Admin. </em></small></div>';
          else:
            return '<div id="uniq_mac_wireless" style="display:inline-block; color:#990009; font-weight:bold;"><em><small>&#8629;&nbsp;This MAC address is already registered.</em></small> </div>';
          endif;
        endif;
      break;
    endswitch;
  endif;
}
function residential_modal($msg) {
  return ('<script>jQuery(\'<div id="errorModal" class="modal hide fade"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>MAC Address is already registered</h3></div><div class="modal-body"><p>'.$msg.'</p></div><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div></div>\').modal()</script>');
}
/**
 * Ajax validation to check if a hostname is taken
 */
function __check_host($form, &$form_state) {
  if( $form['computer']['hostname']['#value'] == '' ):
    return '<div id="uniq_host" style="display:inline-block; color:#00000;"><em>(Must Be Unique!)</em></div>';
  else:
    if( preg_match('/[\.\s+\#\$\%\^\&\*\(\)\!\@\_\+\=]/', $form['computer']['hostname']['#value'] ) ):
      return '<div id="uniq_host" style="display:inline-block; color:#990009;"><em><small>Hostname must not have any spaces and can only contain \'-\'.&nbsp;&nbsp;(eg. myhostname, my-host-name).</small></em>  </div>';
    else:
      $record = Electrical\Engineering\Whois\suWhois::whois($form['computer']['hostname']['#value'].'.stanford.edu');
      if(!$record):
        setcookie('hostname', 'avail');
        return '<div class="success" id="uniq_host" style="display:inline-block; color:#029302;"> <b>&nbsp;&#10004;&nbsp;' . $form['computer']['hostname']['#value'].'.stanford.edu</b>. </div>';
      else:
        setcookie('hostname', 'notavail');
        return '<div id="uniq_host" style="display:inline-block; color:#990009; font-weight:bold;"> ' . $form['computer']['hostname']['#value'].'.stanford.edu is not available. </div>';
      endif;
    endif;
  endif;
}
/**
 * Validation to check if TSO is valid
 */
function __validate_number($element, &$form_state) {

  $num = preg_replace(array('/\./', '/X/i', '/B/i', '/\s+/'), '', $element['#value']);

  if( $element['#name'] == 'tso' ):
    if( !empty( $form_state['values']['wired'] ) && empty( $element['#value'] ) ):
      form_set_error(
        'tso',
        t('<b>TSO</b> cannot be empty.  Please enter in the form of 0.0 0000.')
      );
    elseif( empty( $form_state['values']['wired'] ) && empty( $element['#value'] ) ):
      $num = 0;
    endif;
  elseif( $element['#name'] == 'office' ):

  endif;


  if( !is_numeric($num) ):

    form_set_error(
      $element['#name'],
      t('<b>@name</b> must be a number not <b><em>@val</em></b>.',
        array(
          '@name' => $element['#title'],
          '@val' => $element['#value']
        )
      )
    );
    return false;
  endif;
}
/**
 * EMail validation
 */
function __validate_email($element, &$form_state) {
  if( !valid_email_address($element['#value']) ):
    form_set_error(
      $element['#name'],
      t('Invalid email address <em>@email</em>, for <em>@el</em> Please enter in the form name@stanford.edu.',
        array(
          '@email' => $element['#value'],
          '@el' => $element['#title']
        )
      )
    );
    drupal_set_message(valid_email_address($element['#value']));
    return false;

  endif;
}
/**
 * Hostname validation
 */
function __validate_host($element, &$form_state) {
if( $element['#value'] == '' ):
    form_set_error('hostname', t('Hostname is a required field.'));
  else:
    if( preg_match('/[\.\s+\#\$\%\^\&\*\(\)\!\@\_\+\=]/', $element['#value'] ) ):
      form_set_error('hostname', t('Hostname must not have any spaces and can only contain \'-\'.&nbsp;&nbsp;(eg. myhostname, my-host-name).') );
    else:
      $r = new Electrical\Engineering\Whois\suWhois;
      $record = $r->whois($element['#value'].'.stanford.edu');
      if(!$record):
        setcookie('hostname', 'avail');
        return;
      else:
        setcookie('hostname', 'notavail');
        form_set_error('hostname', t('@value.stanford.edu is not available.  Please choose a different name.', array('@value' => $element['#value']) ) );
      endif;
    endif;
  endif;
}
function __validate_phone($element, &$form_state) {
  $phone = $element['#value'];
  if (strlen($phone) > 0 && !preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone) ):
    form_set_error($element['#name'], t('Phone number must be in format xxx-nnn-nnnn.') );
    return false;
  endif;
}
/**
 * On submit validation of mac address
 */
function __validate_mac($element, &$form_state) {
  if( empty($element['#value']) ):
    return true;
  endif;
  $r = new Electrical\Engineering\Whois\suWhois;
  $record = $r->whois($element['#value']);
  switch($element['#name']):
    case 'wired':
      if( !$record || $record->state == 'Unknown' ):

      else:
        form_set_error('wired', t('You cannot use @mac for the wired mac address', array('@mac' => $element['#value']) ) );
      endif;
    break;
    case 'wireless':
      if( !$record || $record->state == 'Unknown' ):

      else:
        form_set_error('wired', t('You cannot use @mac for the wireless mac address', array('@mac' => $element['#value']) ) );
      endif;
    break;
  endswitch;
    $element['#value'] = preg_replace(array('/\:/', '/\-/', '/\_/', '/\./'), '', $element['#value']);
    if( strlen($element['#value']) < 12):
      form_set_error($element['#name'], t('@desc is too short.', array('@desc' => $element['#description'])));
      return false;
    elseif( !(preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $element['#value']) == 1) ):
      form_set_error($element['#name'], t('@desc is not a valid mac address.', array('@desc' => $element['#description'])));
      return false;
    endif;
    $arr = str_split($element['#value']);

    $l = $arr[0];

    for($i = 1; $i<12; $i++):
      if(($i % 4) == 0):
        $l .= '.';
      endif;
      $l .= $arr[$i];
    endfor;
    if( !preg_match('/[\d\w]{4}\.[\d\w]{4}\.[\d\w]{4}/', $l) ):
      form_set_error($element['#name'], t('@el is not a valid mac address. Should be in the form aa:bb:cc:dd:ee:ff.', array('@el' => $l) ) );
    endif;
    $element['#value'] = $l;
    form_set_value($element, $l, $form_state);
}
function __validate_sunetid($form, &$form_state) {

 /* if( (empty($_COOKIE['SNF']) || $_COOKIE['SNF'] == 'FALSE') && empty($form_state['values']['sunetid']) ):
    form_set_error('sunetid', 'SUNet ID is required.  If you are a member of SNF without a SUNet ID please check the "I am an SNF member" checkbox');
  endif;*/

}
/**
 * Custom ajax validation
 */
function __validate_other($form, &$form_state) {

  if( $form_state['values']['manufacturer'] == 'Other' ):
    if( $form_state['values']['manufacturer_other'] == '' ):
      form_set_error('manufacturer_other', t('Other Manufacturer is a required field') );
    endif;
  endif;

} /* network_req_validate_inc.php */
?>
