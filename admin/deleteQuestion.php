<?php
$question_id = $_POST["questionId"];
$id = intval($question_id);
require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';
global $wpdb;
$wpdb->hide_errors();
$questions_table = "assessment_tool_questions";
require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
$wpdb->delete( $questions_table, array( 'id' => $id ) );
?>