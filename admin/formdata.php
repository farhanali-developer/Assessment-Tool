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
// echo json_encode($object_data);
// echo gettype($b);
// $c = array_keys((array)$b);
// echo gettype($c);
// var_dump($b);

// foreach($b as $outerkey => $outerval)
// {
//     foreach($outerval as $innerkey){
//         echo $innerkey;
//     }
// }


// foreach($b as $var => $value) {
//     print_r("$var is $value\n");
// }
// echo $b.'outer-list';
// foreach (get_object_vars($b) as $key => $val){
//     echo $key;
//     echo gettype($key);
//     // foreach($key as $innerkey => $innerval)
//     // {
//     // echo $innerkey." has the value". $innerval;
//     // }
// }

// $outer_list;
// $text_input;
// $text_input_description;
// $inner_list;
$inner_text_input_val = "inner-text-input";
$inner_text_marks_val = "inner-text-marks";


foreach($object_data as $outer_list_key => $outer_list_data){
    
    $outer_list_text = $outer_list_data;

    foreach($outer_list_data as $inner_data_key => $inner_list_data){
        $inner_list_text = $inner_list_data;

        $tab = $inner_list_text["text-input"]; //GETTING ONLY TABS
        $description = $inner_list_text["text-input-description"]; //GETTING ONLY DESCRIPTIONS
        echo $tab . "\n"; 
        echo $description . "\n";
        
        

        foreach($inner_list_data as $inner_list_key => $inner_list_obj){

            $inner_text_input = $inner_list_obj;

            $m = "inner-text-input";
        $n = "inner-text-marks";
        echo $inner_text_input[0]->$m . "\n";
        echo $inner_text_input[0]->$n . "\n";
            // echo $inner_text_input; //Tab Name and description
            // $ar = unserialize($inner_text_input[0]);
            // echo $inner_text_input['text-input'];
            // $tabs_query = "INSERT INTO $tabs_table(tab_name, tab_description) VALUES()";
            
            // echo $inner_text_input;
            

            foreach($inner_text_input[0] as $inner_text_input_key => $inner_text_input_val){
                // echo $inner_text_input_key;
                // echo $inner_text_input_key["inner-text-input"] . "\n";
                // echo $inner_text_input_key["inner-text-marks"] . "\n";

                
                
                // echo $inner_text_input_val; //Question and Marks

            }

        }
    }
    
}





$outer_list = array(
    "text_input" => "sdf",
    "text_input_description" => "sdf",
    "inner_list" => array(
        "inner_text_input" => "sdf",
        "inner_text_marks" => "sdf"
    )
);
// $exampleData = [
//     "outer-list" => [
//         [
//             "text-input" => "Tab 1",
//             "text-input-description" => "Description 1",
//             "inner-list" => [
//                 [
//                     "inner-text-input" => "Question 1",
//                     "inner-text-marks" => "1"
//                 ]
//             ]
//         ]
//     ]
// ];




// {
//     "outer-list": [
//         {
//             "text-input": "Tab 1",
//             "text-input-description": "Description 1",
//             "inner-list": [
//                 {
//                     "inner-text-input": "Question 1",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 2",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 3",
//                     "inner-text-marks": "0"
//                 }
//             ]
//         },
//         {
//             "text-input": "Tab 2",
//             "text-input-description": "Description 2",
//             "inner-list": [
//                 {
//                     "inner-text-input": "Question 1",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 2",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 3",
//                     "inner-text-marks": "0"
//                 }
//             ]
//         },
//         {
//             "text-input": "Tab 3",
//             "text-input-description": "Description 3",
//             "inner-list": [
//                 {
//                     "inner-text-input": "Quesiton 1",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 2",
//                     "inner-text-marks": "0"
//                 },
//                 {
//                     "inner-text-input": "Question 3",
//                     "inner-text-marks": "0"
//                 }
//             ]
//         }
//     ]
// }






// dbDelta( $tabs_query );
// dbDelta( $questions_query );
?>