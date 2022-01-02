<?php

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$formdata_table = 'assessment_tool_formdata';
$users_table = 'assessment_tool_users';
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
        $user_data = $wpdb->get_results("SELECT * FROM $users_table WHERE id IN (SELECT DISTINCT(user_id) FROM $formdata_table)");
        foreach($user_data as $user_key => $user_data){
            $userName = $user_data->full_name;
            $userDb_id = $user_data->id;
        ?>
            <div class="accordion-item user" id="item<?php echo $userDb_id; ?>" user_id="<?php echo $userDb_id; ?>">
                <h2 class="accordion-header" id="User<?php echo $userDb_id; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo "user-$userDb_id"; ?>" aria-expanded="false" aria-controls="<?php echo "user-$userDb_id"; ?>">
                        <?php echo $userName; ?>
                    </button>
                </h2>
                <div id="<?php echo "user-$userDb_id"; ?>" class="accordion-collapse tab collapse" aria-labelledby="<?php echo $userDb_id; ?>" data-bs-parent="#usersaccordion">
                    <div class="accordion-body py-2 d-flex flex-column align-content-between">
                        <span class='btn btn-danger ms-auto mt-3 delete-entry' delete-user-id="<?php echo $userDb_id; ?>">Delete Entry</span>
                        <?php 
                        $all_tabs = $wpdb->get_results("SELECT DISTINCT tab_id, tab_name, tab_marks FROM $formdata_table WHERE user_id = $userDb_id order by tab_marks DESC");
                        foreach($all_tabs as $single_tab => $value){
                            $tab_id = $value->tab_id;
                            $tabname = $value->tab_name;
                        ?>
                        <div class="accordion mt-3" id="tabsaccordion" tab_id="<?php echo $tab_id; ?>">
                            <div class="accordion-item tab" id="btn-tab<?php echo $tab_id; ?>">
                                <h2 class="accordion-header" id="heading<?php echo $tab_id; ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tab<?php echo $tab_id; ?>" aria-expanded="false" aria-controls="tab<?php echo $tab_id; ?>">
                                        <?php echo $tabname; ?>
                                    </button>
                                </h2>
                                <div id="tab<?php echo $tab_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tab_id; ?>" data-bs-parent="#tabsaccordion">
                                    <div class="accordion-body">
                                    <?php 
                                    $form_data = $wpdb->get_results("SELECT * FROM $formdata_table where tab_id = $tab_id AND user_id = $userDb_id order by question_marks DESC");
                                    foreach($form_data as $form_key => $formData){
                                        $id = $formData->id;
                                        $tab_marks = $formData->tab_marks;
                                        $question_id = $formData->question_id;
                                        $question = $formData->question;
                                        $question_marks = $formData->question_marks;
                                        $answer = $formData->question_answer;
                                    ?>
                                        <div class="row mx-auto mt-2 question" question_id="<?php echo $question_id; ?>" entry_id="<?php echo $id; ?>">
                                            <div class="col-10">
                                                <h6><?php echo $question; ?></h6>
                                            </div>
                                            <div class="col-2">
                                                <select class="form-select">
                                                    <?php
                                                    if($answer == "No"){
                                                        ?>
                                                        <option question_marks="0">-</option>
                                                        <option question_marks="0">Yes</option>
                                                        <option question_marks="<?php echo $question_marks; ?>" selected>No</option>
                                                        <?php
                                                    }
                                                    elseif($answer == "Yes"){
                                                        ?>
                                                        <option question_marks="0">-</option>
                                                        <option question_marks="0" selected>Yes</option>
                                                        <option question_marks="<?php echo $question_marks; ?>">No</option>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <option question_marks="0" selected>-</option>
                                                        <option question_marks="<?php echo $question_marks; ?>">Yes</option>
                                                        <option question_marks="<?php echo $question_marks; ?>">No</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row mx-auto justify-content-center mt-5">
    <div class="col-12 col-md-3 text-center">
        <input class="btn btn-success" type="submit" value="Update Users"/>
    </div>
</div>