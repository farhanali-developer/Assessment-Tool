<?php

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$settings_table = 'assessment_tool_settings';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
require_once( ABSPATH . 'wp-includes/class-wp-editor.php' );

$email_address = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 1" );
$password_gmail = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 2" );
$email_subject = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 3" );
$theme = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 4" );
$animation = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 5" );
$animation_speed = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 6" );
$alignment = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 7" );
$mode = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 8" );
$welcome_screen_text = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 9" );
$end_screen_text = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 10" );

foreach($theme as $theme_key => $theme_val){
    $theme_value = $theme_val->setting_value;
}

foreach($animation as $animation_key => $animation_val){
    $animation_value = $animation_val->setting_value;
}

foreach($alignment as $alignment_key => $alignment_val){
    $alignment_value = $alignment_val->setting_value;
    $alignment_value_type = intval($alignment_value);
}


foreach($mode as $mode_key => $mode_val){
    $mode_value = $mode_val->setting_value;
    $mode_data_type = intval($mode_value);
}

?>
<script>
    var theme = "<?php echo $theme_value; ?>";

    if( theme == "default"){
        jQuery("option[value='default']").attr("selected", true);
    }
    if( theme == "arrows"){
        jQuery("option[value='arrows']").attr("selected", true);
    }
    if( theme == "dots"){
        jQuery("option[value='dots']s").attr("selected", true);
    }
    if( theme == "progress"){
        jQuery("option[value='progress']").attr("selected", true);
    }
    
    var animation = "<?php echo $animation_value; ?>";
    if(animation == "none"){
        jQuery("option[value='none']").attr("selected", true);
    }
    if(animation == "fade"){
        jQuery("option[value='fade']").attr("selected", true);
    }
    if(animation == "slide-horizontal"){
        jQuery("option[value='slide-horizontal']").attr("selected", true);
    }
    if(animation == "slide-vertical"){
        jQuery("option[value='slide-vertical']").attr("selected", true);
    }
    if(animation == "slide-swing"){
        jQuery("option[value='slide-swing']").attr("selected", true);
    }



    if(<?php echo $alignment_value_type; ?> == 1){
        jQuery("#is_justified").attr("checked", true);
    }

    if(<?php echo $mode_data_type; ?> == 1){
        jQuery("#dark_mode").attr("checked", true);
    }
</script>

<div class="mb-3">
    <h3>Email Template</h3>
    <label>Email Address</label>
    <?php
    foreach($email_address as $email_add => $email_add_val){
        $email_address = $email_add_val->setting_value;
    ?>
    <input type="email" class="form-control email" placeholder="" value="<?php echo $email_address; ?>"/>
    <?php
    }
    ?>

    <label>Password</label>
    <?php
    foreach($password_gmail as $password_key => $password_val){
        $password = $password_val->setting_value;
    ?>
    <input type="text" class="form-control password" placeholder="" value="<?php echo $password; ?>"/>
    <div id="emailHelp" class="form-text">This password can be generated from your Gmail account's security settings. <br>Note:</b> This is not your Gmail account password.</div>
    <?php
    }
    ?>

    <label class="mt-2">Email Subject</label>
    <?php
    foreach($email_subject as $email_key => $email_val){
        $email_value = $email_val->setting_value;
    ?>
    <input type="text" class="form-control emailsubject" placeholder="" value="<?php echo $email_value; ?>"/>
    <?php
    }
    ?>
</div>
<div class="mb-3">
    <h2>Form Styles</h2>
    <label class="mt-3">Theme:</label>
    <select id="theme_selector" class="form-control mw-100">
        <option value="default" id="default">Default</option>
        <option value="arrows" id="arrows">Arrows</option>
        <option value="dots" id="dots">Dots</option>
        <option value="progress" id="progress">Progress</option>
    </select>
    
    <label class="mt-3">Animation:</label>
    <select id="animation" class="form-control mw-100">
        <option value="none">None</option>
        <option value="fade">Fade</option>
        <option value="slide-horizontal">Slide Horizontal</option>
        <option value="slide-vertical">Slide Vertical</option>
        <option value="slide-swing">Slide Swing</option>
    </select>

    <label class="mt-3">Animation Speed:</label>
    <?php
    foreach($animation_speed as $animation_speed_key => $animation_speed_val){
        $animation_speed_value = $animation_speed_val->setting_value;
    ?>
    <input type="number" id="animation_speed" class="form-control" placeholder="2" value="<?php echo $animation_speed_value; ?>" />
    <?php
    }
    ?>
    
    <span>100 = 1 seconds.</span>
    
    <div class="custom-control custom-checkbox mt-3">
        <input type="checkbox" class="custom-control-input" id="is_justified" value="1" data-np-checked="1" />
        <label class="custom-control-label" for="is_justified">Justified</label>
    </div>

    <div class="custom-control custom-checkbox mt-3 mb-3">
        <input type="checkbox" class="custom-control-input" id="dark_mode" value="1" data-np-checked="1" />
        <label class="custom-control-label" for="dark_mode">Dark Mode</label>
    </div>
    
    <span>An example of these stylings can be found out at: </span><a target="_blank" href="http://techlaboratory.net/jquery-smartwizard">Click Here</a>

    <div class="form-floating mt-3">
    <?php
    foreach($welcome_screen_text as $welcome_key => $welcome_val){
        $welcome_text = $welcome_val->setting_value;
    ?>

    <?php } ?>
        <textarea class="form-control" placeholder="Welcome Screen Text" id="welcome_screen_text" style="height: 200px">
        <?php echo $welcome_text; ?></textarea>
        <label for="welcome_screen_text">Welcome Screen Text</label>
    </div>

    <div class="form-floating mt-3">
    <?php
    foreach($end_screen_text as $end_key => $end_val){
        $end_text = $end_val->setting_value;
    ?>

    <?php } ?>
        <textarea class="form-control" placeholder="End Screen Text" id="end_screen_text" style="height: 200px"><?php echo $end_text; ?></textarea>
        <label for="end_screen_text">End Screen Text</label>
    </div>
</div>
<button type="submit" class="btn btn-success">Update Settings</button>
<?php
wp_editor(
    "",
    'distribution',
    array(
      'media_buttons' => true,
      'textarea_rows' => 8,
      'tabindex' => 4,
      'tinymce' => array(
        'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
        'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo',
        'toolbar2'      => '',
        'toolbar3'      => '',
      ),
    )
);
     ?>