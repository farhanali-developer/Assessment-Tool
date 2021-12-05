<?php

$email_data = $_POST['email'];
$theme_data = $_POST['theme'];
$animation_data = $_POST['animation'];
$animation_speed_data = $_POST['animation_speed'];
if($_POST['alignment'] == "true"){
    $alignment_data = 1;
}
else{
    $alignment_data = 0;
}
if($_POST['dark_mode'] == "true"){
    $dark_mode_data = 1;
}
else{
    $dark_mode_data = 0;
}

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$settings_table = 'assessment_tool_settings';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$email = htmlspecialchars($email_data, ENT_QUOTES);

$wpdb->update( $settings_table, array( 'setting_value' => $email), array( 'id' => 1 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $theme_data), array( 'id' => 2 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $animation_data), array( 'id' => 3 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $animation_speed_data), array( 'id' => 4 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $alignment_data), array( 'id' => 5 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $dark_mode_data), array( 'id' => 6 ) );
 
?>