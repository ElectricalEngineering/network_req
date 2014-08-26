<?php
drupal_add_css('https://maxcdn.bootstrapcdn.com/bootswatch/3.1.1/spacelab/bootstrap.min.css', array('type' => 'external'));
drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array('type' => 'external'));

?>
<div class="form-group">
  <div class="input-group col-xs-4 form-text">
    <div class="input-group-addon add-on-blue"><span id="count"><?php print $count ?></span> record<?php print ($count > 1 ? 's ' : ' '); ?>found.</div>
    <input class="form-control search" type="email" id="search" placeholder="Start typing to search">
    <div class="input-group-addon btn-primary"><a href="javascript:;;" id="xClear"><i class="fa fa-times"></i></a></div>
  </div>
</div>
<!--<span class="suggest"> </span>-->
</div>

<table class="table network-req">
  <thead>
    <tr>
      <th style="text-align:center; padding:20px;">#</th>
      <th>Wired <br /> Wireless</th>
      <th>Sunet ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Hostname</th>
      <th>Date / Time</th>
    </tr>
  </thead>
  <tbody>

<?php
foreach($data as $record):

?>
  <tr class="f">
    <td style="text-align: center; padding: 0px; vertical-align: middle;"><span class="descriptor" style="font-size:20px"><?php print $record->rid; ?></span></td>
    <td class="mac-addy">
      <?php print ( !empty($record->wired) ? t(strtolower($record->wired) . '<span style="color:#880000; font-weight:bold;">:Eth</span>') : ''); ?><br />
      <?php print ( !empty($record->wireless) ? t(strtolower($record->wireless) . '<span style="color:#880000; font-weight:bold;">:Wi</span>') : ''); ?>
    </td>
    <td><?php print l($record->sunetid, t('https://stanfordwho.stanford.edu/SWApp/authSearch.do?stanfordonly=checkbox&search=@sunetid', array('@sunetid' => $record->sunetid) ), array('attributes' => array('target' => '_blank'))); ?></td>
    <td><?php print $record->lname; ?></td>
    <td><?php print $record->fname; ?></td>
    <td><?php print $record->hostname; ?></td>

    <td>
      <?php print strftime("%b %e, %G (%I:%M%P)", strtotime($record->ts) ); ?><span class="label rid more-info-label">
        <a href="<?php print sprintf('%s/admin/config/content/network-req/submissions/%d/view', $base_url, $record->rid); ?>" class="delete-record" data-rid="<?php print $record->rid; ?>"><i class="fa fa-info-circle"></i></a></span>
      <div class="network-request-hidden hidden-fields-from-div">
        <?php print $record->manufacturer; ?> (<?php print $record->computer_type; ?>)<br />
        <?php print $record->model; ?> (<?php print $record->os; ?>)
        <?php if( !empty($record->tso) ): ?>
          <?php print $record->tso; ?>
        <?php endif; ?>
        <?php print $record->email; ?><br />
        <?php print $record->phone; ?><br />
        <?php print ucfirst( strtolower($record->building) ); ?> (<?php print $record->room; ?>)<br />
        <?php if( !empty($record->research_group) ): ?>
          <?php print $record->research_group; ?>
        <?php endif; ?>
        <?php print $record->sysadmin; ?> (<?php print $record->sysadmin_email; ?>)
        <?php if( !empty($record->comments) ): ?>
          <?php print $record->comments; ?>
        <?php else: ?>
          <span style="color:#990009;">No Comments Submitted.</span>
        <?php endif; ?>
      </div>
    </td>
  </tr>
  <tr class="network-request-more-info f">
    <td colspan="7" style="padding:0;">
      <div class="network-request-hidden hidden-fields-from-table">
        <?php print ( !empty($record->wired) ? t($record->wired) : ''); ?>:e<br />
        <?php print ( !empty($record->wireless) ? t($record->wireless) : ''); ?>:w<br />
        <?php print $record->sunetid; ?><br />
        <?php print $record->lname; ?><br />
        <?php print $record->fname; ?><br />
        <?php print $record->hostname; ?><br />
       <?php print strftime("%b %e, %G (%I:%M %P)", strtotime($record->ts) ); ?>
      </div>
      <div class="descriptor" style="padding: 10px;"><a href="javascript:;;" >More Info [+/-]</a></div>
      <div class="more-info" style="display:none; border-top:1px solid #d5d0c0;">
      <div class="postcard-left pull-left col-sm-12">
        <div class="postcard-col1 col-sm-3">
          Computer
        </div>
        <div class="postcard-col2 col-sm-9">
          <?php print $record->manufacturer; ?> (<?php print $record->computer_type; ?>)<br />
          <?php print $record->model; ?> (<?php print $record->os; ?>)
        </div>
      </div><!-- /.postcard-left -->
      <?php if( !empty($record->tso) ): ?>
      <div class="postcard-left pull-left col-sm-12">
        <div class="postcard-col1 col-sm-3">
          TSO
        </div>
        <div class="postcard-col2 col-sm-9">
          <?php print $record->tso; ?>
        </div>
      </div><!-- /.postcard-left -->
      <?php endif; ?>
      <div class="postcard-left pull-left col-sm-12">
        <div class="postcard-col1 col-sm-3">
          Contact
        </div>
        <div class="postcard-col2 col-sm-9">
          <?php print l($record->email, t('mailto:@email', array('@email' => $record->email)), array('absolute' => TRUE, 'attributes' => array('title' => 'Email ' . $record->fname))); ?><br />
          <?php print $record->phone; ?><br />
          <?php print ucfirst( strtolower($record->building) ); ?> (<?php print $record->room; ?>)<br />
          <?php if( !empty($record->research_group) ): ?>
          <?php print $record->research_group; ?>
          <?php endif; ?>
        </div>
      </div><!-- /.postcard-left -->
      <div class="postcard-left pull-left col-sm-12">
        <div class="postcard-col1 col-sm-3">
          System Administrator
        </div>
        <div class="postcard-col2 col-sm-9">
          <?php print $record->sysadmin; ?> (<?php print l($record->sysadmin_email, t('mailto:@email', array('@email' => $record->sysadmin_email)), array('absolute' => TRUE, 'attributes' => array('title' => 'Email ' . $record->sysadmin))); ?>)
        </div>
      </div><!-- /.postcard-left -->
      <div class="postcard-left pull-left col-sm-12">
        <div class="postcard-col1 col-sm-3">
          Comments
        </div>
        <div class="postcard-col2 col-sm-9">
          <?php if( !empty($record->comments) ): ?>
          <?php print $record->comments; ?>
          <?php else: ?>
          <span style="color:#990009;">No Comments Submitted.</span>
          <?php endif; ?>
        </div>
      </div>

      </div>
    </td>
  </tr>
<?php
endforeach;
?>
  <tr><td colspan="7"><a class="pull-right bold descriptor" href="javascript:;;" id="network-request-scroll-to-top">Top</a></td></tr>
  </tbody>
</table>
