<?php drupal_set_title(t('How do I find my MAC (media access control) address?')); ?>
<p class="lead">
  This page will show you how to find your mac address.  Click on your operating system below.
</p>
<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">

      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#windows-instruction">
        Windows
      </a>
    </div>
    <div id="windows-instruction" class="accordion-body collapse">
      <div class="accordion-inner">
        <p class="lead well">
          Navigate to your start menu and type <code>cmd</code> into the search bar.  <br />
          Click on the command 'cmd' or hit enter to load the command prompt.
        </p>
        <p>
          <img src="/<?php print $module_directory; ?>/images/win-1.png" alt="Windows Start Menu" />
        </p>

        <p class="lead well">
          Type <code>ipconfig /all</code> into the terminal and hit enter.<br />
          You should see a result like the one below.
        </p>
<pre id="win-help">
Microsoft Windows [Version 6.1.7601]
Copyright (c) 2009 Microsoft Corporation.  All rights reserved.

C:\Users\EE-IT\ipconfig /all

Windows IP Configuration

   Host Name . . . . . . . . . . . . : your-hostname-win-7
   Primary Dns Suffix  . . . . . . . :
   Node Type . . . . . . . . . . . . : Hybrid
   IP Routing Enabled. . . . . . . . : No
   WINS Proxy Enabled. . . . . . . . : No
   DNS Suffix Search List. . . . . . : Stanford.EDU

Ethernet adapter Local Area Connection: <span class="hl">This is your wired connection</span>

   Connection-specific DNS Suffix  . :
   Description . . . . . . . . . . . : Intel(R) PRO/1000 MT Desktop Adapter
   <span class="hl">Physical Address</span>. . . . . . . . . : <span class="hl">0A-1B-2C-3D-4E-5F</span> <span class="d"><- We need this number</span>
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes
   Link-local IPv6 Address . . . . . : eec5::1234::5678::aabb:ccdd%11(Preferred)
   Autoconfiguration IPv4 Address. . : 169.254.135.172(Preferred)
   Subnet Mask . . . . . . . . . . . : 255.255.0.0
   Default Gateway . . . . . . . . . :
   DHCPv6 IAID . . . . . . . . . . . : 235405351
   DHCPv6 Client DUID. . . . . . . . : 0A-1B-2C-3D-4E-CF-5A-6B-7C-8D-9E-0B-1C-2D

Wireless LAN adapter Wireless Network Connection:

   Connection-specific DNS Suffix  . : Stanford.EDU
   Description . . . . . . . . . . . : Broadcom 802.11g Network Adapter
   <span class="hl">Physical Address</span>. . . . . . . . . : <span class="hl">0A-1B-2C-3D-4E-5F</span> <span class="d"><- We need this number</span>
   DHCP Enabled. . . . . . . . . . . : Yes
   Autoconfiguration Enabled . . . . : Yes
   Link-local IPv6 Address . . . . . : eec5::1234::5678::aabb:ccdd%11(Preferred)
   IPv4 Address. . . . . . . . . . . : 10.32.10.103(Preferred)
   Subnet Mask . . . . . . . . . . . : 255.255.255.0
   Lease Obtained. . . . . . . . . . : <?php print date('l, F j, Y g:i:s A ', time()) . "\n"; ?>
   Lease Expires . . . . . . . . . . : <?php print  date('l, F j, Y g:i:s A ', strtotime('+ 7 days')) . "\n"; ?>
   Default Gateway . . . . . . . . . : 10.32.0.1
   DHCP Server . . . . . . . . . . . : 10.32.1.1
   DHCPv6 IAID . . . . . . . . . . . : 235405351
   DHCPv6 Client DUID. . . . . . . . : 0A-1B-2C-3D-4E-CF-5A-6B-7C-8D-9E-0B-1C-2D

   DNS Servers . . . . . . . . . . . : 171.64.1.234
                                       171.67.1.234
   NetBIOS over Tcpip. . . . . . . . : Enabled

C:\Users\EE-IT\_
</pre>
<p><a href="javascript:;;" class="top">Top</a></p>
      </div>

    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#mac-instruction">
        OS/X
      </a>
    </div>
    <div id="mac-instruction" class="accordion-body collapse">
      <div class="accordion-inner">
        <div>
          <p class="lead well">Click the apple icon in the top left corner of your computer.<br />Then click on <code>System Preferences</code>.</p>
          <p><img src="/<?php print $module_directory; ?>/images/osx-1.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">Click on the <code>Network</code> icon.</p>
          <p><img src="/<?php print $module_directory; ?>/images/osx-2.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">Click on your network connection (Ethernet/Wi-Fi) on the left, then click the <code>Advanced</code> button.</p>
          <p><img src="/<?php print $module_directory; ?>/images/osx-3.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">For Ethernet connections, click the <code>Hardware</code> tab. <br />
          We need the set of characters at the top of the settings.<br />
          It will be in the format <code>a1:b2:c3:d4:e5:f6</code></p>
          <p><img src="/<?php print $module_directory; ?>/images/osx-4.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">For wireless connections you will find the characters at the bottom of the Advanced Wi-Fi settings page under the <code>Wi-Fi</code> tab.</p>
          <p><img src="/<?php print $module_directory; ?>/images/osx-5.png" alt="OSX-1"/></p>
        </div>
        <p><a href="javascript:;;" class="top">Top</a></p>
      </div>
    </div>
  </div>
   <div class="accordion-group">
    <div class="accordion-heading" id="linux">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#linux-instruction">
        Linux
      </a>
    </div>
    <div id="linux-instruction" class="accordion-body collapse">
      <div class="accordion-inner">
        <div>
          <p class="lead well">Hit the keys <code>Alt+F2</code> together.  You should see a dialog box like the one below.  Type terminal into the search bar.</p>
          <p><img src="/<?php print $module_directory; ?>/images/linux-1.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">The first result should be your terminal program.  This should be something like (Terminal, gnome-terminal, xterm, etc.).  Click on the first result in the lower box and click the <code>Run</code> button.</p>
          <p><img src="/<?php print $module_directory; ?>/images/linux-2.png" alt="OSX-1"/></p>
        </div>
        <div>
          <p class="lead well">Type <code>ifconfig | grep -i hwaddr</code> into the terminal.  You should see a result similar to the image below.  Your ethernet connection is usally labeled as <code>ethx</code> where <code>x</code> is a number.  Your wireless connection will usually be <code>wlanx</code> where <code>x</code> is a number.
            We need the characters after <code>HWaddr</code>, they will be in the form of <code>a1:b2:c3:d4:e5:f6</code>.</p>
          <p><img src="/<?php print $module_directory; ?>/images/linux-3.png" alt="OSX-1"/></p>
        </div>
        <p><a href="javascript:;;" class="top">Top</a></p>
      </div>
    </div>
  </div>
</div>

<script>
(function($) {
  $('.accordion-toggle').on('click', function() {
    jQuery('body').animate({scrollTop:'292px'});
  });
  $('.top').on('click', function() {
    jQuery('body').animate({scrollTop:0});
  });
})(jQuery)
</script>
