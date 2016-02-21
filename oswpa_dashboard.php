<?php
function oswpa_dashboard_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    ?>

  <div class="wrap">

                  <div style="float:right;margin-left:10px;text-align:right;">
              Plugins by <a href="http://appalliance.co.za/" target="_blank">AppAlliance</a><br>
              <span style="font-size:80%;">Applying the future today</span>
            </div>

    <h1>OneSignal Push Notifications for iOS and Android</h1>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'This plugin is currently under development. Although it works in its simplest form, there is a lot of things that still needs to be implemented and tested. Use at own risk', 'sample-text-domain' ); ?></p>
    </div>
    <h2 class="nav-tab-wrapper">
      <a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>admin.php?page=appalliance-wp-kit">Dashboard</a>
      <a class="nav-tab " href="<?php echo admin_url() ?>admin.php?page=appalliance-onetime-page">Send one time notification</a>
    </h2>


<h3 style="text-decoration: underline;">Requirements:</h3>
    <ol>
<li>A valid APP ID and API key from OneSignal.</li>
<li>An app in your OneSignal account that is configured to send push notifications.</li>
<li>Click <a href="https://documentation.onesignal.com/docs/getting-started" >here</a> if you need help with this.</li>

</ol>
<h3 style="text-decoration: underline;">Setup:</h3>

<ol>
<li>Visit the config page by clicking <a href="<?php echo admin_url() ?>admin.php?page=appalliance-config" >here</a>.</li>
<li>Insert your OneSignal App ID and API Key.</li>
<li>Click save and start sending messages!</li>

</ol>

<h3 style="text-decoration: underline;">How to use:</h3>
<ol>
    <li>Go to the "Send one time notification tab" or click <a href="<?php echo admin_url() ?>admin.php?page=appalliance-onetime-page">here</a></li>
<li>Compose your message.</li>
<li>Select platforms to deliver to.</li>
<li>Click send to start sending messages!</li>

</ol>


  </div>

    <?php } ?>
