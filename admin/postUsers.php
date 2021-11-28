<?php 

$all_chkboxes = $_POST["data"];

$object_data = json_decode($all_chkboxes, true);


require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$users_table = "assessment_tool_users";
$charset_collate = $wpdb->get_charset_collate();


foreach($object_data as $chkbox){
    
    $num_id = intval($chkbox["id"]);
    $num_val = intval($chkbox["value"]);

    // echo gettype($chkbox["id"]);

    $wpdb->update( $users_table, array( 'allow_retake' => $num_val), array( 'id' => $num_id ) );
}

// print_r($_POST["data"]);


$users = $wpdb->get_results("SELECT * FROM $users_table");

foreach($users as $col => $val){
    $user_id = $val->id;
    $full_name = $val->full_name;
    $phone_number = $val->phone_number;
    $user_email = $val->user_email;
    $allow_retake = $val->allow_retake;
    $num_allow_retake = intval($allow_retake);
?>
<tr>
    <td><?php echo $user_id; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><a class="text-dark alert-link" href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a></td>
    <td><a class="text-dark alert-link" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></td>
    <td><input id="<?php echo $user_id; ?>" class="form-check-input allow-retake" type="checkbox" <?php echo ($num_allow_retake == 1) ? 'checked' : '' ?> ></td>
</tr>

<?php

}

?>