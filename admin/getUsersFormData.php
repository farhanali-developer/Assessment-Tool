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
<div class="accordion-item mt-3" id="item<?php echo $userDb_id; ?>">
    <h2 class="accordion-header" id="User<?php echo $userDb_id; ?>">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo "user-$userDb_id"; ?>" aria-expanded="false" aria-controls="<?php echo "user-$userDb_id"; ?>">
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
    <div id="<?php echo "user-$userDb_id"; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $userDb_id; ?>" data-bs-parent="#usersaccordion">
        <div class="accordion-body py-2">
            <div class="accordion" id="tabsaccordion">
                <div class="accordion-item" id="btn-tab<?php echo $tab_id; ?>">
                    <h2 class="accordion-header" id="heading<?php echo $tab_id; ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tab<?php echo $tab_id; ?>" aria-expanded="false" aria-controls="tab<?php echo $tab_id; ?>">
                            <?php echo $tabName; ?>
                        </button>
                    </h2>
                    <div id="tab<?php echo $tab_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tab_id; ?>" data-bs-parent="#tabsaccordion">
                        <div class="accordion-body">
                            <?php
                                $formdata = $wpdb->get_results("SELECT * FROM $formdata_table WHERE tab_id = $tab_id");
                                foreach($formdata as $formkeys => $formvals){
                                    $id = $formvals->id;
                                    $tabid = $formvals->tab_id;
                                    $tab_marks = $formvals->tab_marks;
                                    $question_id = $formvals->question_id;
                                    $question_marks = $formvals->question_marks;
                                    $user_id = $formvals->user_id;
                    
                                    $questions_data = $wpdb->get_results("SELECT question FROM $questions_table WHERE tab_id = $tabid");
                                    
                                    
                                foreach($questions_data as $qkey => $qVal){
                                    $question = $qVal->question;
                            ?>
                            <div class="row mx-auto mt-2">
                                <div class="col-10">
                                    <h6><?php echo $question; ?></h6>
                                </div>
                                <div class="col-2">
                                    <select class="form-select">
                                        <?php
                                        if($question_marks != 0){
                                            ?>
                                        <option>Yes</option>
                                        <option selected>No</option>
                                            <?php
                                        }
                                        else{
                                            ?>
                                        <option selected>Yes</option>
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
