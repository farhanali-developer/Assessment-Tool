<?php 
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\POP3;


include('./phpmailer/src/Exception.php');
include('./phpmailer/src/PHPMailer.php');
include('./phpmailer/src/SMTP.php');
// include('./phpmailer/src/POP3.php');
// include('./phpmailer/autoload.php');


//Create a new PHPMailer instance
$mail = new PHPMailer(true);

// $pop = new POP3(); /*Create a new object for pop3*/
// $pop->Authorise('logikware.tech', 993, 30, 'farhan@logikware.tech', 'Icsm1458319', 1); /*login in to pop3 */

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;





// header("Access-Control-Allow-Origin: *");
// ini_set('display_errors', 1); 
// error_reporting(E_ALL);


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
$user_email = $user_data["email"];
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




$final_message;
$wpdb->get_results("SELECT user_email FROM $users_table WHERE user_email = '$user_email'");
if($wpdb->num_rows > 0){

    $allow = $wpdb->get_results("SELECT allow_retake FROM $users_table WHERE user_email = '$user_email';");

    $check_user = $allow[0]->allow_retake;

    if($check_user == 0){
        $final_message = "You already submitted form.";
    }
    else{
        
        $wpdb->insert($users_table, array(
            'full_name' => $name,
            'phone_number' => $phone,
            'user_email' => $user_email,
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


        $email = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 1");
        $password_gmail = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 2");
        $emailsubject = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 3");
        $subject = $emailsubject->setting_value;
        // $admin_email = get_option('admin_email');
        $admin_email = $email->setting_value;
        $password = $password_gmail->setting_value;


        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $admin_email;

        //Password to use for SMTP authentication
        // $mail->Password = 'yoffeaqmopkdfcup';
        $mail->Password = "$password";

        $from = $admin_email; // this is the sender's Email address

        //Set who the message is to be sent from
        //Note that with gmail you can only use your account address (same as `Username`)
        //or predefined aliases that you have configured within your account.
        //Do not use user-submitted addresses in here
        $mail->setFrom($admin_email, "Larry");

        //Set an alternative reply-to address
        //This is a good place to put user-submitted addresses
        $mail->addReplyTo($admin_email, "Lary");

        //Set who the message is to be sent to
        $mail->addAddress($admin_email, $name);
        $mail->addAddress($user_email, $name);

        //Set the subject line
        $mail->Subject = $subject;


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

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML(true);
        $mail->Body = $message;


        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $final_message = "Thank you $name, for taking time to take Assessment Survey. You should receive the confirmation email. Please check your inbox.";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            // if (save_mail($mail)) {
            //     echo "Message saved!";
            // }
        }


        //Section 2: IMAP
        //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
        //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
        //You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
        //be useful if you are trying to get this working on a non-Gmail IMAP server.
        function save_mail($mail)
        {
            //You can change 'Sent Mail' to any other folder or tag
            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Inbox';
        
            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
        
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
        
            return $result;
        }

    }
    
    
}
else{
   
        $wpdb->insert($users_table, array(
            'full_name' => $name,
            'phone_number' => $phone,
            'user_email' => $user_email,
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


        $email = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 1");
        $emailsubject = $wpdb->get_row("SELECT setting_value FROM assessment_tool_settings WHERE id = 3");
        $subject = $emailsubject->setting_value;
        // $admin_email = get_option('admin_email');
        $admin_email = $email->setting_value;


        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $admin_email;

        //Password to use for SMTP authentication
        $mail->Password = 'yoffeaqmopkdfcup';

        $from = $admin_email; // this is the sender's Email address

        //Set who the message is to be sent from
        //Note that with gmail you can only use your account address (same as `Username`)
        //or predefined aliases that you have configured within your account.
        //Do not use user-submitted addresses in here
        $mail->setFrom($admin_email, "Larry");

        //Set an alternative reply-to address
        //This is a good place to put user-submitted addresses
        $mail->addReplyTo($admin_email, "Lary");

        //Set who the message is to be sent to
        $mail->addAddress($admin_email, $name);
        $mail->addAddress($user_email, $name);

        //Set the subject line
        $mail->Subject = $subject;


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

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML(true);
        $mail->Body = $message;


        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $final_message = "Thank you $name, for taking time to take Assessment Survey. You should receive the confirmation email. Please check your inbox.";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            // if (save_mail($mail)) {
            //     echo "Message saved!";
            // }
        }


        //Section 2: IMAP
        //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
        //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
        //You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
        //be useful if you are trying to get this working on a non-Gmail IMAP server.
        function save_mail($mail)
        {
            //You can change 'Sent Mail' to any other folder or tag
            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Inbox';
        
            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
        
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
        
            return $result;
        }
}
exit($final_message);
?>