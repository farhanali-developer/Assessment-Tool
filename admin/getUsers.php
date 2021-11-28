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
    $num_allow_retake = intval($allow_retake);

    $number = preg_replace('/\D+/', '', $phone_number);
    // echo gettype($num_allow_retake);
    echo ($num_allow_retake == 1) ? 'checked' : 'Not Checked';
?>
<tr>
    <td><?php echo $user_id; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><a class="text-dark alert-link" href="tel:<?php echo $number; ?>"><?php echo $phone_number; ?></a></td>
    <td><a class="text-dark alert-link" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></td>
    <td><input id="<?php echo $user_id; ?>" class="form-check-input allow-retake" type="checkbox" <?php echo ($num_allow_retake == 1) ? 'checked' : '' ?> ></td>
</tr>

<?php

}
?>
