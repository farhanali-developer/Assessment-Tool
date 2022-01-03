<?php 
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1); 
error_reporting(E_ALL);


$user_data = json_decode($_POST["user_data"], true);
$form_data = json_decode($_POST["form_data"], true);

// print_r($form_data);
require_once dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->hide_errors();
$users_table = 'assessment_tool_users';
$formdata_table = 'assessment_tool_formdata';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
htmlspecialchars($user_data["email"], ENT_QUOTES);

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

    $check_user = $allow[0]->allow_retake;

    if($check_user == 0){
        echo "You already submitted form.";
    }
    else{
        //Perform Mailing functionality Here
        // echo "Form Submitted from check user";

        // $wpdb->insert($users_table, array(
        //     'full_name' => $name,
        //     'phone_number' => $phone,
        //     'user_email' => $email,
        //     'submission_date' => $submission_date,
        //     'submission_time' => $submission_time,
        //     'timezone' => $timezone,
        //     'allow_retake' => $allow_retake,
        // ));
    
        // echo "Form Submitted";
    }
    
    
}
else{
   
        $wpdb->insert($users_table, array(
            'full_name' => $name,
            'phone_number' => $phone,
            'user_email' => $email,
            'submission_date' => $submission_date,
            'submission_time' => $submission_time,
            'timezone' => $timezone,
            'allow_retake' => $allow_retake
        ));

        $user_id = $wpdb->insert_id;

       

        foreach($form_data as $form_key => $form_values){
            
            $tab_id = $form_values["tab_id"];
            $tab_name = $form_values["tab_name"];
            $chapter_title = $form_values["chapter_title"];
            $tab_marks = $form_values["tab_marks"];
            $questions = $form_values["questions"];
            foreach($questions as $questions_keys => $questions_value){
                $question_id = $questions_value["question_id"];
                $question = $questions_value["question"];
                $question_marks = $questions_value["marks"];
                $question_ans = $questions_value["ans"];
                
                $wpdb->insert($formdata_table, array(
                    'tab_id' => $tab_id,
                    'tab_name' => $tab_name,
                    'tab_marks' => $tab_marks,
                    'chapter_title' => $chapter_title,
                    'question_id' => $question_id,
                    'question' => $question,
                    'question_marks' => $question_marks,
                    'question_answer' => $question_ans,
                    'user_id' => $user_id
                ));
            }

        }

        $emailsubject = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 1");
        $subject = $emailsubject->setting_value;
        $admin_email = get_option('admin_email');
        // $to = $admin_email; // this is your Email address
        $to = "farhan@logikware.tech";
        //Perform Mailing functionality Here

        $from = $email; // this is the sender's Email address

        
        $username = $name;
        // $subject = "Assessment Tool Survey";
        
        $message = '<html><body>';
        $message .= "<h1>Assessment Survey Form</h1>";
        $message .= "<table style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>";
        $message .= "<thead>";
        $message .= "<tr>";
        $message .= "<th style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>Rank</th>";
        $message .= "<th style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>Chapter Title</th>";
        $message .= "<th style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>Indicator</th>";
        $message .= "<th style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>Description</th>";
        $message .= "</tr>";
        $message .= "</thead>";
        $message .= "<tbody>";
        $i = 0;
        foreach($form_data as $tab => $tab_values){
            if($i == 3){
                break;
            }
            $i++;
            $tabname = $tab_values["tab_name"];
            $chapter_title = $tab_values["chapter_title"];
            $tabmarks = $tab_values["tab_marks"];
            $tabdescription = $tab_values["tab_description"];
            $description = htmlspecialchars($tabdescription, ENT_QUOTES);
            $message .= "<tr>";
            $message .= "<td style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>$i</td>";
            $message .= "<td style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>$chapter_title</td>";
            $message .= "<td style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>$tabname</td>";
            $message .= "<td style='border: 1px solid black; border-collapse: collapse; padding: 15px;'>$description</td>";
            $message .= "</tr>";
        }

        $message .= "</tbody>";
        $message .= "</table>";
        $message .= '</body></html>';
    
        $headers = "From:" . $from . "Reply-To: $to";
        $headers2 = "From:" . $to;
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers2 .= "MIME-Version: 1.0\r\n";
        $headers2 .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to,$subject,$message,$headers);
        mail($from,$subject,$message,$headers2); // sends a copy of the message to the sender
        echo "Mail Sent. Thank you " . $username . ", We will contact you shortly.";
        // You can also use header('Location: thank_you.php'); to redirect to another page.

    
}

exit;

?>


