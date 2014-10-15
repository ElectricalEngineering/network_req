<?php

/*
 * @file single.tpl.php
 *
 * Template file for single view at /network-req/submissions/%/delete
 *
 * @variables
 * $data = database fields for record %
 *
 */

//drupal_add_css('https://maxcdn.bootstrapcdn.com/bootswatch/3.1.1/spacelab/bootstrap.min.css', array('type' => 'external'));
//drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array('type' => 'external'));
?>
<div class="bg-primary" style="min-height:60px; padding:10px;">
  <span style="font-weight:bold;" class="descriptor pull-right"><?php print strftime("%b %e, %G (%I:%M %P)", strtotime($data->ts) ); ?></span>
  <h2 class="pull-left" style="color:#fff;">Record Information</h2>
</div>
<div id="record-info"  style="border: 1px solid #E9E3CE; margin-bottom:15px;">
  <?php if( !empty($data->wired) ): ?>
  <div class="postcard-left">
    <div class="postcard-col1  span4">
      Ethernet :
    </div>
    <div class="postcard-col2">
      <?php print t($data->wired); ?>
    </div>
  </div>
  <?php endif; ?>
   <?php if( !empty($data->wireless) ): ?>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
      Wired :
    </div>
    <div class="postcard-col2">
      <?php print t($data->wireless); ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
      SuNet ID :
    </div>
    <div class="postcard-col2">
      <?php print l($data->sunetid, t('https://stanfordwho.stanford.edu/SWApp/authSearch.do?stanfordonly=checkbox&search=@sunetid', array('@sunetid' => $data->sunetid) ), array('attributes' => array('target' => '_blank'))); ?>
    </div>
  </div>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     Name :
    </div>
    <div class="postcard-col2">
      <?php print t('@fname @lname', array('@fname' => $data->fname, '@lname' => $data->lname) ); ?>
    </div>
  </div>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     Email :
    </div>
    <div class="postcard-col2">
      <?php print l($data->email, t('mailto:@email', array('@email' => $data->email)), array('absolute' => TRUE, 'attributes' => array('title' => 'Email ' . $data->fname))); ?>
    </div>
  </div>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     Phone :
    </div>
    <div class="postcard-col2">
      <?php print $data->phone; ?>
    </div>
  </div>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     Building :
    </div>
    <div class="postcard-col2">
      <?php print ucfirst( strtolower($data->building) ); ?> (<?php print $data->room; ?>)
    </div>
  </div>
   <?php if( !empty($data->research_group) ): ?>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     Group :
    </div>
    <div class="postcard-col2">
      <?php print $data->research_group; ?>
    </div>
  </div>
   <?php endif; ?>
   <div class="postcard-left">
    <div class="postcard-col1 span4">
     Computer :
    </div>
    <div class="postcard-col2">
     <?php print $data->manufacturer; ?> (<?php print $data->computer_type; ?>)<br />
     <?php print $data->model; ?> (<?php print $data->os; ?>)
    </div>
  </div>
  <?php if( !empty($data->tso) ): ?>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     TSO :
    </div>
    <div class="postcard-col2">
     <?php print $data->tso; ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="postcard-left">
    <div class="postcard-col1 span4">
     System Administrator :
    </div>
    <div class="postcard-col2">
     <?php print $data->sysadmin; ?> (<?php print l($data->sysadmin_email, t('mailto:@email', array('@email' => $data->sysadmin_email)), array('absolute' => TRUE, 'attributes' => array('title' => 'Email ' . $data->sysadmin))) ?>)
    </div>
  </div>
  <div class="postcard-left clearfix" style="border-bottom:0;">
    <div class="postcard-col1 span4">
     <h3 class="text-info">Comments</h3>
    </div>
    <div class="postcard-col2">
     <?php if( !empty($data->comments) ): ?>
          <?php print $data->comments; ?>
        <?php else: ?>
          <span style="color:#990009;">No Comments Submitted.</span>
        <?php endif; ?>
    </div>
  </div>
</div>
