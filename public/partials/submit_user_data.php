<?php 

$user_data = json_decode($_POST["user_data"], true);

require_once dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) )) ) ) ) . '\wp-config.php';

global $wpdb;
$wpdb->show_errors();
$users_table = 'assessment_tool_users';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$name = $user_data["name"];
$email = $user_data["email"];
$phone = $user_data["phone"];
$date = $user_data["date"];
$month = $user_data["month"];
$year = $user_data["year"];
$hour = $user_data["hour"];
$minute = $user_data["minute"];
$second = $user_data["second"];
$timezone = $user_data["timezone"];
$allow_retake = 0;

$submission_date = "$year-$month-$date";
$submission_time = "$hour:$minute:$second";

$wpdb->get_results("SELECT user_email FROM $users_table WHERE user_email = '$email'");
if($wpdb->num_rows > 0){

    $allow = $wpdb->get_results("SELECT allow_retake FROM $users_table WHERE user_email = '$email';");
    // print_r($allow);
    $check_user = $allow[0]->allow_retake;

    if($check_user == 1){
        echo "You already submitted form.";
    }
    else{
        //Perform Mailing functionality Here
        echo "Form Submitted from check user";
    }
    
    
}
else{
    //Perform Mailing functionality Here
    $wpdb->insert($users_table, array(
        'full_name' => $name,
        'phone_number' => $phone,
        'user_email' => $email,
        'submission_date' => $submission_date,
        'submission_time' => $submission_time,
        'timezone' => $timezone,
        'allow_retake' => $allow_retake,
    ));

    echo "Form Submitted";
    
}



?>