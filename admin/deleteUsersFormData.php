<?php
$formdata = $_POST["data"];
$delete_id = json_decode($_POST["data"], true);

// print_r($object_data);
require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';
global $wpdb;
$wpdb->show_errors();
$formdata_table = "assessment_tool_formdata";
$charset_collate = $wpdb->get_charset_collate();

$wpdb->delete( $formdata_table, array( 'user_id' => $delete_id ) );