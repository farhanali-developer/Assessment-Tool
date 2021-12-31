<?php

$emailsubject = $_POST['subject'];
$theme_data = $_POST['theme'];
$animation_data = $_POST['animation'];
$animation_speed_data = $_POST['animation_speed'];
$welcome_screen_text = $_POST["welcome_screen_text"];
$end_screen_text = $_POST["end_screen_text"];

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

if($theme_data == "Default"){
    $theme_data = "default";
}
else if($theme_data == "Arrows"){
    $theme_data = "arrows";
}
else if($theme_data == "Dots"){
    $theme_data = "dots";
}
else if($theme_data == "Progress"){
    $theme_data = "progress";
}

if($animation_data == "None"){
    $animation_data = "none";
}
if($animation_data == "Fade"){
    $animation_data = "fade";
}
if($animation_data == "Slide Horizantal"){
    $animation_data = "slide-horizontal";
}
if($animation_data == "Slide Vertical"){
    $animation_data = "slide-vertical";
}
if($animation_data == "Slide Swing"){
    $animation_data = "slide-swing";
}


require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$settings_table = 'assessment_tool_settings';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$subject = htmlspecialchars($emailsubject, ENT_QUOTES);

$wpdb->update( $settings_table, array( 'setting_value' => $subject), array( 'id' => 1 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $theme_data), array( 'id' => 2 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $animation_data), array( 'id' => 3 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $animation_speed_data), array( 'id' => 4 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $alignment_data), array( 'id' => 5 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $dark_mode_data), array( 'id' => 6 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $welcome_screen_text), array( 'id' => 7 ) );
$wpdb->update( $settings_table, array( 'setting_value' => $end_screen_text), array( 'id' => 8 ) );
 
?>