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

    foreach($outer_list_data as $inner_data_key => $inner_list_data){
        $inner_list_text = $inner_list_data;

        $tab_name = htmlspecialchars($inner_list_data["text-input"], ENT_QUOTES); //GETTING ONLY TABS Accepts double quotes as well
        $description = htmlspecialchars($inner_list_data["text-input-description"], ENT_QUOTES); //GETTING ONLY DESCRIPTIONS Accepts double quotes as well

        $wpdb->insert($tabs_table, array(
            'tab_name' => $tab_name,
            'tab_description' => $description
        ));

        $tab_id = $wpdb->insert_id;

        foreach($inner_list_data["inner-list"] as $inner_list_key => $inner_list_obj){

            $question = htmlspecialchars($inner_list_obj["inner-text-input"], ENT_QUOTES); //GETTING QUESTION
            $marks = htmlspecialchars($inner_list_obj["inner-text-marks"], ENT_QUOTES); //GETTING MARKS

            $wpdb->insert($questions_table, array(
                'question' => $question,
                'marks' => $marks,
                'tab_id' => $tab_id
            ));
            
        }
    }
    
}


?>