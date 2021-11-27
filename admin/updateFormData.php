<?php

$ajax_data = $_POST;
//getting array from jquery
$array_data = $ajax_data["data"];

//converting array to object
$object_data = json_decode($array_data, true);

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$tabs_table = "assessment_tool_tabs";
$questions_table = "assessment_tool_questions";
$charset_collate = $wpdb->get_charset_collate();


require_once( ABSPATH . "wp-admin/includes/upgrade.php" );

foreach($object_data as $outer_list_key => $outer_list_data){
    
    $outer_list_text = $outer_list_data;

    print_r($outer_list_data);

    foreach($outer_list_data as $inner_data_key => $inner_list_data){
        $inner_list_text = $inner_list_data;

        // $tab_id = $inner_list_data['text-input-id'];
       // $tab_name = $inner_list_data["text-input"]; //GETTING ONLY TABS
        //$description = $inner_list_data["text-input-description"]; //GETTING ONLY DESCRIPTIONS

        //echo $inner_data_key . " : " . $inner_list_data . "\n" . "\n";
        


       // foreach($inner_list_data["inner-list"] as $inner_list_key => $inner_list_obj){

            // $question_id = $inner_list_obj["inner-text-id"];
            //$question = $inner_list_obj["inner-text-input"]; //GETTING QUESTION
            //$marks = $inner_list_obj["inner-text-marks"]; //GETTING MARKS

            // $questions_query = "INSERT INTO $questions_table (question, marks, tab_id) VALUES('$question', '$marks', '$tab_id' )";
            // dbDelta( $questions_query );

            // $wpdb->update( $questions_table, array( 'question' => $question, 'marks' => $marks), array( 'id' => $question_id ) );
            
       // }

        // $tabs_query = "INSERT INTO $tabs_table (tab_name, tab_description) VALUES('$tab_name', '$description');";
        // dbDelta( $tabs_query );



        // $wpdb->update( $tabs_table, array( 'tab_name' => $tab_name, 'tab_description' => $description), array( 'id' => $tab_id ) );
    }
    
}


?>