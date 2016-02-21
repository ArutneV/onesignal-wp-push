<?php
function oswpa_onetime_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

  function sendMessage() {

      if (isset($_POST['submit']))  {

        $maincontent = $_POST['push-msg'];

settings_fields( 'oswpa-config-fields' );
$appId = esc_attr( get_option('oswpa_onesignal_id') );
$apiKey = esc_attr( get_option('oswpa_onesignal_api') );

    $fields = array(


    //Check REST API Docs for other params
      'app_id' => $appId,
      'included_segments' => array("All"),
      'contents' => $maincontent,
      'isIos' => true,
      'isAndroid' => false,
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

     };


}




  $response = sendMessage();
  $return["allresponses"] = $response;
  $return = json_encode( $return);

    // Build in error reporting from returned JSON data

    if ($response != null) { ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Notification Sent!', 'sample-text-domain' ); ?></p>
    </div>


   <?php  }

   //print("\n\nJSON received:\n");
   //print($return);
   //print("\n")

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

                    <div>

                        <textarea class="msg-area" type="text" id="push-msg" name="push-msg[en]" rows="6" cols="20" placeholder="Push message" required></textarea><br/>


                        <button type="submit" class="btn btn-primary" name="submit">Send Now</button>



                    </div>

                    </form>
                </div>





  </div>

  <?php
}
?>
