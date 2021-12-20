<?php

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$formdata_table = 'assessment_tool_formdata';
$users_table = 'assessment_tool_users';
$tabs_table = 'assessment_tool_tabs';
$questions_table = 'assessment_tool_questions';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
?>
<div class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text" id="accordion_search_bar" class="form-control" placeholder="Search a user">
</div>

<div class="row mt-5">
    <div class="col-lg-12 col-xs-12" id="user-data">
        <div class="accordion" id="usersaccordion">
<?php

$user_data = $wpdb->get_results("SELECT * FROM $users_table");

foreach($user_data as $user_key => $userData){
    $userDb_id = $userData->id;
    $userName = $userData->full_name; //User's name fetched.
?>
<div class="accordion-item user mt-3" id="item<?php echo $userDb_id; ?>" user_id="<?php echo $userDb_id; ?>">
    <h2 class="accordion-header" id="User<?php echo $userDb_id; ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo "user-$userDb_id"; ?>" aria-expanded="false" aria-controls="<?php echo "user-$userDb_id"; ?>">
            <?php echo $userName; ?>
        </button>
    </h2>
    <?php

        // $user_data = $wpdb->get_row("SELECT full_name FROM $users_table WHERE id = $user_id");
        $tab_data = $wpdb->get_results("SELECT * FROM $tabs_table");
        foreach($tab_data as $tab_key => $tab_val){
            $tabName = $tab_val->tab_name; //Tab name fetched.
            $tab_id = $tab_val->id;


    ?>
    <div id="<?php echo "user-$userDb_id"; ?>" class="accordion-collapse tab collapse" aria-labelledby="<?php echo $userDb_id; ?>" data-bs-parent="#usersaccordion" tab_id = "<?php echo $tab_id; ?>">
        <div class="accordion-body py-2">
            <div class="accordion" id="tabsaccordion">
                <div class="accordion-item tab" id="btn-tab<?php echo $tab_id; ?>">
                    <h2 class="accordion-header" id="heading<?php echo $tab_id; ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tab<?php echo $tab_id; ?>" aria-expanded="false" aria-controls="tab<?php echo $tab_id; ?>">
                            <?php echo $tabName; ?>
                        </button>
                    </h2>
                    <div id="tab<?php echo $tab_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tab_id; ?>" data-bs-parent="#tabsaccordion">
                        <div class="accordion-body">
                            <?php
                                $formdata = $wpdb->get_results("SELECT * FROM $formdata_table WHERE tab_id = $tab_id");
                                // foreach($formdata as $formkeys => $formvals){
                                //     $id = $formvals->id;
                                //     $tabid = $formvals->tab_id;
                                //     $tab_marks = $formvals->tab_marks;
                                //     $question_id = $formvals->question_id;
                                //     $question_marks = $formvals->question_marks;
                                //     $user_id = $formvals->user_id;
                    
                                    $questions_data = $wpdb->get_results("SELECT id, question FROM $questions_table WHERE tab_id IN (SELECT fd.tab_id from $formdata_table as fd where fd.tab_id = $tab_id AND fd.user_id = $userDb_id)");
                                    $questions_marks = $wpdb->get_results("SELECT formdata.question_marks, formdata.question_id, formdata.question_answer FROM $formdata_table as formdata WHERE formdata.tab_id = $tab_id AND user_id = $userDb_id");
                                    
                                foreach($questions_data as $qkey => $qVal){
                                    $question = $qVal->question;
                                    $qd_question_id = $qVal->id;
                                        foreach($questions_marks as $qmarks => $qm){ 
                                            $marks = $qm->question_marks;
                                            $fd_question_id = $qm->question_id;
                                            $answer = $qm->question_answer;

                                                if($qd_question_id == $fd_question_id){
                                                    ?>
                                                    <div class="row mx-auto mt-2 question" question_id = "<?php echo $qd_question_id; ?>">
                                                        <div class="col-10">
                                                            <h6><?php echo $question; ?></h6>
                                                        </div>
                                                        <div class="col-2">
                                                            <select class="form-select">
                                                                <?php
                                                                if($answer == "No"){
                                                                    ?>
                                                                    <option>-</option>
                                                                <option>Yes</option>
                                                                <option selected>No</option>
                                                                    <?php
                                                                }
                                                                elseif($answer == "Yes"){
                                                                    ?>
                                                                    <option>-</option>
                                                                    <option selected>Yes</option>
                                                                    <option>No</option>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                <option selected>-</option>
                                                                <option>Yes</option>
                                                                <option>No</option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                        }

                                    }
                                // }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        
    }
    ?>
</div>
<?php
}
?>
</div>
				</div>
			</div>
            <div class="row mx-auto justify-content-center mt-5">
                <div class="col-12 col-md-3 text-center">
                    <input class="btn btn-success" type="submit" value="Update Users"/>
                </div>
            </div>
