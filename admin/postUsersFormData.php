<?php

$formdata = $_POST["data"];
require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$formdata_table = "assessment_tool_formdata";
$charset_collate = $wpdb->get_charset_collate();

foreach($formdata as $data_key){

    $user_id = $data_key["userid"];

    foreach($data_key as $tabs){

        foreach($tabs as $tabs_key => $tabs_data){
            
            $tab_id = $tabs_data["tabid"];
            $questions = $tabs_data["questions"];

            foreach($questions as $questions_key => $question_data){
                $questiond_id = $question_data["questionid"];
                $question_ans = $question_data["answer"];
                $question_marks = $question_data["question_marks"];

                $wpdb->update( $formdata_table, array( 'question_answer' => $question_ans, 'question_marks' => $question_marks), array( 'tab_id' => $tab_id, 'question_id' =>  $questiond_id, "user_id" => $user_id) );
                echo "User data updated with tabid: $tab_id , questionid: $questiond_id , and userid: $user_id \n";
            }
        }
    }
}