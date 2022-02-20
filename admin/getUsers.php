<?php
require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';
global $wpdb;
$wpdb->show_errors();
$users_table = 'assessment_tool_users';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$users = $wpdb->get_results("SELECT * FROM $users_table");

foreach($users as $col => $val){
    $user_id = $val->id;
    $full_name = $val->full_name;
    $phone_number = $val->phone_number;
    $user_email = $val->user_email;
    $submission_date = $val->submission_date;
    $submission_time = $val->submission_time;
    $timezone = $val->timezone;
    $allow_retake = $val->allow_retake;
    $num_allow_retake = intval($allow_retake);

    $number = preg_replace('/\D+/', '', $phone_number);
?>
<tr>
    <td><?php echo $user_id; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><a class="text-dark alert-link" href="tel:<?php echo $number; ?>"><?php echo $phone_number; ?></a></td>
    <td><a class="text-dark alert-link" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></td>
    <td><?php echo $submission_date; ?> | <?php echo $submission_time; ?> <?php echo $timezone; ?></td>
    <td><input id="<?php echo $user_id; ?>" class="form-check-input allow-retake" type="checkbox" <?php echo ($num_allow_retake == 1) ? 'checked' : '' ?> ></td>
    <td><span class="text-decoration-none btn btn-danger text-white d-inline delete-user" user-id="<?php echo $user_id; ?>">Delete User</span></td>
</tr>
<?php

}
?>
