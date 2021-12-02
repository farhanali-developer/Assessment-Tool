<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/public/partials
 */

function assessment_tool_function(){
require_once dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) )) ) ) ) . '\wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$tabs_table = 'assessment_tool_tabs';
$questions_table = 'assessment_tool_questions';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs");

if($tabs){
$formUrl = plugin_dir_url( __FILE__ ) . "submit_user_data.php";
?>

<form id="my-form" action="<?php echo $formUrl; ?>">

    <!-- Welcome Page -->
    <div class="welcome_final welcome d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center py-5 slide-in-right">
                <div class="col-8">
                    <p>
                    <span>Since you've found this page, I'll assume you've read the book, or at least skimmed it. And that you
                        understand the concepts of organizational maturity, the arc of success, and the 3P's.</span>
                    <span>As you now know, businesses don’t fail. Failure of a well-conceived business is always due to a
                        failure of leadership.</span>
                    <span>The significance of the Index Scorecard survey is its ability to measure the clarity of purpose,
                        consistency of performance, and engagement of people within your organization with keen accuracy and
                        minimal investments of time. Most people complete the survey in 5-10 minutes.</span>
                    <span>After completing this survey, you’ll have a list of your firms Index indicators ranked by relative
                        strength from weakest to strongest. Efforts to strengthen your business and develop profitable
                        sustainability should always begin with one of your three weakest indicators.</span>
                    </p>
                </div>
                <div class="col-8">
                    <button class="my-button" type="button">START SURVEY</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Smart Wizard -->
    <div id="smartwizard" class="container">
        <ul class="nav">
        <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $description = $tabs_data->tab_description;
        
        ?>
            <li>
            <a class="nav-link" href="#step-<?php echo $tab_id; ?>"> <?php echo $tab; ?> </a>
            </li>
            <?php
        }
            ?>
        </ul>

        <div class="tab-content">
        <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $description = $tabs_data->tab_description;
        
        ?>
            <!-- Step 1 -->
            <div id="step-<?php echo $tab_id; ?>" class="tab-pane" role="tabpanel" data-name="<?php echo $tab; ?>" data-marks="" data-priority="">
                <div class="step-info">
                    <div class="container py-5">
                    <p class="lead"><?php echo $description; ?></p>
                    </div>
                </div>

                <div class="form-area col-12 col-md-6">

                <?php
                    $questions = $wpdb->get_results("SELECT * FROM assessment_tool_questions WHERE tab_id = $tab_id");
                    foreach($questions as $questions_name => $questions_data){
                        $question_id = $questions_data->id;
                        $question = $questions_data->question;
                        $marks = $questions_data->marks;
                ?>
                    <!-- Q1 -->
                    <div id="q-area-<?php echo $question_id; ?>" class="row q-area">
                        <div class="col-12 d-flex justify-content-between question1 align-items-center flex-wrap my-4">
                            <h5 class="question" data-marks="<?php echo $marks; ?>" data-value=""><?php echo $question; ?></h5>
                            <h5 class="display-ans"></h5>
                            <a href="#q-area-<?php echo $question_id; ?>" class="edit">Edit</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <input class="yes form-radio" type="radio" name="ans<?php echo $question_id; ?>" id="yes-<?php echo $question_id; ?>" value="Yes" />
                            <label class="for-yes" for="yes-<?php echo $question_id; ?>">
                            <i class="far fa-check-circle indication"></i>
                            <i class="far fa-thumbs-up thumb"></i>
                            Yes
                            </label>
                        </div>
                        <div class="col-6 d-flex justify-content-start">
                            <input class="no form-radio" type="radio" name="ans<?php echo $question_id; ?>" id="no-<?php echo $question_id; ?>" value="No" />
                            <label class="for-no" for="no-<?php echo $question_id; ?>">
                            <i class="far fa-times-circle indication"></i>
                            <i class="far fa-thumbs-down thumb"></i>
                            No
                            </label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


    <!-- User Data -->
    <div class="user-data d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row py-5 slide-in-right">
                <div class="col-10 col-md-6 col-lg-4 mx-auto info-section">
                    <div class="text-center pb-4">
                        <h1 class="display-6">Please Enter Contact Information</h1>
                    </div>
                    <div class="user-data-sec d-flex justify-content-center flex-wrap">
                        <input type="text" required name="name" class="user-info form-control" placeholder="Name" id="" />
                        <input type="email" required name="email" class="user-info form-control" placeholder="Email" id="" />
                        <input type="text" required name="phone" class="user-info form-control" placeholder="Phone Number" id="" />
                        <input type="submit" class="btn mt-5" value="Submit" />
                    </div>
                </div>
                <div class="message">
                    <h5 class="message-text"></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Page -->
    <div class="welcome_final final d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center py-5 slide-in-right">
                <div class="col-8">
                    <p>
                    <span>The unique circumstances of each business must be considered when determining which indicator to
                        begin with. Investing in immediate needs versus long-term goals is always a balancing act.</span>
                    <span>Focusing on one of the three weakest indicators will have the most immediate value by reducing
                        distractions and relieving time pressures.</span>
                    <span>An email with your results has been processed and you should receive it by email shortly.</span>
                    </p>
                </div>
                <div class="col-8">
                    <a href="https://businessesdontfail.com/fsc800723/" class="my-button">CLICK HERE TO GO TO THE WEBSITE</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
}

}

add_shortcode('assessment_tool', 'assessment_tool_function'); 

?>