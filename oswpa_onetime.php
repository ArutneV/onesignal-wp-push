<?php
function oswpa_onetime_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

  function sendMessage() {

      if (isset($_POST['submit']))  {

          if (!empty($_POST['isAndroid'])) {
              $isAndroid = 'true';
          } else {
              $isAndroid = 'false';
        }
      if (!empty($_POST['isIos'])) {
              $isIos = 'true';
          } else {
              $isIos = 'false';
      }
        $maincontent = $_POST['push-msg'];

     if ( ($isIos === 'false') && ($isAndroid === 'false') ) { ?>

     <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Please select at least one platform to send to!', 'sample-text-domain' ); ?></p>
    </div>

    <?php } else {

settings_fields( 'oswpa-config-fields' );
$appId = esc_attr( get_option('oswpa_onesignal_id') );
$apiKey = esc_attr( get_option('oswpa_onesignal_api') );



    $fields = array(


    //Check REST API Docs for other params
      'app_id' => $appId,
      'included_segments' => array("All"),
      'contents' => $maincontent,
      'isIos' => $isIos,
      'isAndroid' => $isAndroid,
      'ios_badgeType' => 'Increase',
      'ios_badgeCount' => '1'
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                           'Authorization: Basic ' .$apiKey. ''));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;

     }
};


}




  $response = sendMessage();
  $return["allresponses"] = $response;
  $return = json_encode( $return);

    // Build in error reporting from returned JSON data
       if (preg_match('/You must configure Android notifications in your OneSignal settings if you wish to send messages to Android players./',$return)) { ?>
         <div class="notice notice-error is-dismissible">
        <p><?php _e( 'You must configure Android notifications in your OneSignal settings if you wish to send messages to Android devices.', 'sample-text-domain' ); ?></p>
    </div>

<?php } else if ($response != null) { ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Notification Sent!', 'sample-text-domain' ); ?></p>
    </div>
   <?php //add iOS checking
        }

   //print("\n\nJSON received:\n");
   //print($return);
   //print("\n");
   //print("\n");
   //print("\n");

?>

<div class="wrap">

                  <div style="float:right;margin-left:10px;text-align:right;">
              Plugins by <a href="http://appalliance.co.za/" target="_blank">AppAlliance</a><br>
              <span style="font-size:80%;">Applying the future today</span>
            </div>

    <h1>OneSignal Push Notifications for iOS and Android</h1>

    <h2 class="nav-tab-wrapper">
      <a class="nav-tab " href="<?php echo admin_url() ?>admin.php?page=appalliance-wp-kit">Dashboard</a>
      <a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>admin.php?page=appalliance-onetime-page">Send one time notification</a>
    </h2>

        <div id="push-notifications">
                <h2>Compose your push notification</h2>
                <p>Create a unique message that you would like to have sent to your app's users. A push notification can be a good way to remind your users about your app, or let them know about a new feature or update you just made.</p>
                <form action="http://wesupply.co.za/dev/clfapp/wp-admin/admin.php?page=appalliance-onetime-page" id="scripter" method="post">
                    <table class="form-table">



<tr valign="top">
<td>

<textarea class="msg-area" type="text" id="push-msg" name="push-msg[en]" rows="6" cols="20" placeholder="Push message" required></textarea>
</td>
</tr>

<tr valign="top">
    <td>Send to Android&nbsp;&nbsp;
        <input type="checkbox" name="isAndroid"/>
    </td>


</tr>
<tr valign="top">

    <td>Send to iOS&nbsp;&nbsp;
        <input type="checkbox" name="isIos"/>
    </td>


</tr>
                        <tr valign="top">
<td>
 <br/><button type="submit" class="button button-primary" name="submit">Send Now</button>
</td>
</tr>










</table>
</form>
</div>




  </div>

  <?php
}
?>
