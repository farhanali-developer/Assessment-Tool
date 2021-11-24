<?php

// global $wpdb;
// $wpdb->hide_errors();
// $tabs_table = 'assessment_tool_tabs';
// $questions_table = 'assessment_tool_questions';
// $charset_collate = $wpdb->get_charset_collate();

// require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


// $questions_query = "CREATE TABLE IF NOT EXISTS $questions_table (
//     `question_id` INT NOT NULL AUTO_INCREMENT,
//     `question` LONGTEXT NOT NULL,
//     `marks` INT NOT NULL,
//     `tab_id` INT NOT NULL,
//     CONSTRAINT FOREIGN KEY (tab_id) REFERENCES $tabs_table(tab_id),
//     PRIMARY KEY  (`question_id`)
// ) $charset_collate;";




































$ajax_data = $_POST;
//getting array from jquery
$array_data = $ajax_data['data'];

//converting array to object
// header('Content-type: Application/json');
$object_data = json_decode($array_data, true);


foreach($object_data as $outer_list_key => $outer_list_data){
    
    $outer_list_text = $outer_list_data;

    foreach($outer_list_data as $inner_data_key => $inner_list_data){
        $inner_list_text = $inner_list_data;

        $tab = $inner_list_data["text-input"]; //GETTING ONLY TABS
        $description = $inner_list_data["text-input-description"]; //GETTING ONLY DESCRIPTIONS
        echo "Tab: " . $tab . "\n"; 
        echo "Description: " . $description . "\n"; 

        foreach($inner_list_data["inner-list"] as $inner_list_key => $inner_list_obj){

            $question = $inner_list_obj["inner-text-input"]; //GETTING QUESTION
            $marks = $inner_list_obj["inner-text-marks"]; //GETTING MARKS
            echo "Question: " . $question . "\n";
            echo "Marks: " . $marks . "\n";
            
        }
    }
    
}


// dbDelta( $tabs_query );
// dbDelta( $questions_query );
?>