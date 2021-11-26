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
    $allow_retake = $val->allow_retake;
?>
<tr>
    <td><?php echo $user_id; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><a class="text-dark" href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a></td>
    <td><a class="text-dark" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></td>
    <td><input class="form-check-input" type="checkbox" value="" <?php echo $allow_retake ? 'checked' : '' ?> ></td>
</tr>

<?php

}
