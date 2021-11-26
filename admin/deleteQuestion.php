<?php

$question_id = $_POST["questionId"];
$id = intval($question_id);
echo gettype($id);

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$questions_table = "assessment_tool_questions";
// $charset_collate = $wpdb->get_charset_collate();
require_once( ABSPATH . "wp-admin/includes/upgrade.php" );

$wpdb->delete( $questions_table, array( 'id' => $id ) );

?>