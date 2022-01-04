


<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1); 
error_reporting(E_ALL);


$user_data = json_decode($_POST["user_data"], true);
$form_data = json_decode($_POST["form_data"], true);

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
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'logikware.tech';
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

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'farhan@logikware.tech';

//Password to use for SMTP authentication
$mail->Password = 'Icsm1458319';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('farhan@logikware.tech', 'Sender');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
// $mail->addReplyTo('replyto@example.com', 'Receiver');

//Set who the message is to be sent to
$mail->addAddress('farhan.gridshub@gmail.com', 'Receiver');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("Test Mail");

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    // $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    $path = "{logikware.tech:993/imap/novalidate-cert}INBOX";
    

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}