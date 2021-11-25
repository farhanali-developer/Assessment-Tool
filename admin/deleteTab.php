<?php

$tab_id = $_POST["tabId"];
$questions_id = $_POST["questionsid"];
$tabid = intval($tab_id);

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$tabs_table = "assessment_tool_tabs";
$questions_table = "assessment_tool_questions";
$charset_collate = $wpdb->get_charset_collate();

foreach($questions_id as $qids => $qid){
    $qid_num = intval($qid);
    $wpdb->delete( $questions_table, array( 'id' => $qid_num ) );
}

$wpdb->delete( $tabs_table, array( 'id' => $tabid ) );

?>