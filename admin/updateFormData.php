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

        $tab_id = $inner_list_data['text-input-id'];
        $tab_name = $inner_list_data["text-input"]; //GETTING ONLY TABS
        $description = $inner_list_data["text-input-description"]; //GETTING ONLY DESCRIPTIONS

       foreach($inner_list_data["inner-list"] as $inner_list_key => $inner_list_obj){

            $question_id = $inner_list_obj["inner-text-id"];
            $question = $inner_list_obj["inner-text-input"]; //GETTING QUESTION
            $marks = $inner_list_obj["inner-text-marks"]; //GETTING MARKS

            $wpdb->update( $questions_table, array( 'question' => $question, 'marks' => $marks), array( 'id' => $question_id ) );
            
       }

        $wpdb->update( $tabs_table, array( 'tab_name' => $tab_name, 'tab_description' => $description), array( 'id' => $tab_id ) );
    }
    
}
?>

























<?php
    $tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs");
?>

    <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $description = $tabs_data->tab_description;
        
    ?>
        <div data-repeater-item class="card mw-100 p-0 mt-0 mb-5">  
            <div class="row mx-auto w-100 justify-content-center align-items-center card-header">
                <div class="col-12 col-md-10">
                    <input type="hidden" name="text-input-id" value="<?php echo $tab_id; ?>"/>
                    <h5><?php echo $tab; ?></h5>
                </div>
                <div class="col-12 col-md-2">
                    <input data-repeater-delete type="button" class="btn btn-outline-danger w-100 delete-tab" tab-id="<?php echo $tab_id; ?>" value="Delete Tab"/>
                </div>
            </div>

            <div class="card-body p-3">
                <div class="row mx-auto justify-content-start w-100 mt-2">
                    <div class="col-12 col-md-10">
                        <input type="text" class="form-control" name="text-input" placeholder="Add Tab Name *" value="<?php echo $tab; ?>" required />
                        <input class="form-control mt-3 mb-3" type="text" name="text-input-description" placeholder="Tab Description" value="<?php echo $description; ?>" />
                    </div>
                </div>
                <!-- innner repeater -->
                <div class="inner-repeater">
                    <div data-repeater-list="inner-list">
                    <?php
                        $questions = $wpdb->get_results("SELECT * FROM assessment_tool_questions WHERE tab_id = $tab_id");
                        foreach($questions as $questions_name => $questions_data){
                            $question_id = $questions_data->id;
                            $question = $questions_data->question;
                            $marks = $questions_data->marks;
                    ?>
                        <div data-repeater-item class="row mx-auto justify-content-center w-100 mt-2 questions" question-id="<?php echo $question_id; ?>">
                            <div class="col-12 col-md-8">
                                <input type="hidden" name="inner-text-id" value="<?php echo $question_id; ?>"/>
                                <input type="text" name="inner-text-input" class="form-control" placeholder="Question *" value="<?php echo $question; ?>" required />
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="text" name="inner-text-marks" class="form-control" min="0" placeholder="Marks" value="<?php echo $marks; ?>" />
                                <p class="font-weight-normal mt-1 mb-0">Default marks are 0.</p>
                            </div>
                            <div class="col-12 col-md-2">
                                <input data-repeater-delete type="button" class="btn btn-danger w-100 delete-question" question-id="<?php echo $question_id; ?>" value="Delete Question"/>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <div class="row mx-auto justify-content-start">
                        <div class="col-12 col-md-2">
                            <input data-repeater-create type="button" class="btn btn-primary mt-2" value="Add New Question"/>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>
        <?php
        } 
        ?>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-success mb-3" value="Update Form"/>
        <!-- <input data-repeater-create type="button" class="btn btn-dark text-white mb-3" value="Add New Tab"/> -->
    </div>	