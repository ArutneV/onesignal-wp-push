<?php function oswpa_config_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    ?>


        <div class="wrap">
            <div style="float:right;margin-left:10px;text-align:right;">
              Plugins by <a href="http://appalliance.co.za/" target="_blank">AppAlliance</a><br>
              <span style="font-size:80%;">Applying the future today</span>
            </div>



        <h1>Plugin Configuration</h1>

                    <form method="post" action="options.php">
            <?php settings_fields( 'oswpa-config-fields' ); ?>
            <?php //do_settings_sections( 'rwp-custom-howdy-group' ); ?>
            <table class="form-table">
                <tr><th style="padding: 0px 10px 0px 0;" colspan="2"><h3 style="text-decoration: underline;">Onesignal push notifcations:</h3></th></tr>
                <tr valign="top">
                <th scope="row">Onesignal App ID:</th>
                <td><input type="text" name="oswpa_onesignal_id" value="<?php echo esc_attr( get_option('oswpa_onesignal_id') ); ?>" maxlength="100" size="60" /></td>
                </tr>

                <tr valign="top">
                <th scope="row">Onesignal API Key:</th>
                <td><input type="text" name="oswpa_onesignal_api" value="<?php echo esc_attr( get_option('oswpa_onesignal_api') ); ?>" maxlength="100" size="60" /></td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>


  </div>

    <?php
}

?>
