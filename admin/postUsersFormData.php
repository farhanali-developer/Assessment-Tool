<?php
$formdata = $_POST["data"];
$object_data = json_decode($_POST["data"], true);

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';
global $wpdb;
$wpdb->show_errors();
$formdata_table = "assessment_tool_formdata";
$charset_collate = $wpdb->get_charset_collate();

foreach($object_data as $data_key){

    $user_id = $data_key["userid"];
    $tab = $data_key["tabs"];
    foreach($tab as $tabs){
        
        $tab_id = $tabs["tabid"];
        $questions = $tabs["questions"];
       
        foreach($questions as $questions_data){

            $entry_id = $questions_data["entry_id"];
            $questionid = $questions_data["questionid"];
            $question_answer = $questions_data["answer"];
            $question_marks = $questions_data["question_marks"];

            if($question_answer == "No"){
                $question_marks = 15;
            }
            else if($question_answer == "Yes" || $question_answer == "-"){
                $question_marks = 0;
            }
            else{
                $question_marks = 0;
            }

            if($wpdb->update( $formdata_table, array( 'question_marks' => "$question_marks", 'question_answer' => "$question_answer"), array( 'question_id' => $questionid, 'tab_id' => $tab_id, 'user_id' => $user_id ) ) == FALSE){
                echo "Data Failed. \n";
            }
            else{
                echo "Data updated successfully. \n";
            }
        }
    }
}