<?php
require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$tabs_table = 'assessment_tool_tabs';
$questions_table = 'assessment_tool_questions';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs");

if($tabs){
?>

    <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $chapter_title = $tabs_data->chapter_title;
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
                        <input type="text" class="form-control mt-3" name="text-input-chapter" placeholder="Add Chapter Title *" value="<?php echo $chapter_title; ?>" required />
                        <!-- <input class="form-control mt-3 mb-3" type="text" name="text-input-description" placeholder="Tab Description" value="<?php //echo $description; ?>" /> -->
                        <textarea class="form-control mt-3 mb-3" name="text-input-description" placeholder="Tab Description"><?php echo $description; ?></textarea>
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
                                <input type="text" name="inner-text-marks" class="form-control marks" min="0" placeholder="Marks" value="<?php echo $marks; ?>" />
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
    </div>
<?php
}
?>	