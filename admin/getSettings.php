<?php

require_once dirname( dirname( dirname( dirname( dirname( __FILE__ )) ) ) ) . '/wp-config.php';

global $wpdb;
$wpdb->show_errors();
$settings_table = 'assessment_tool_settings';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$email = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 1" );
$theme = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 2" );
$animation = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 3" );
$animation_speed = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 4" );
$alignment = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 5" );
$mode = $wpdb->get_results( "SELECT setting_value FROM $settings_table WHERE id = 6" );

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

    if( theme == "Default"){
        jQuery("option[value='default']").attr("selected", true);
    }
    if( theme == "Arrows"){
        jQuery("option[value='arrows']").attr("selected", true);
    }
    if( theme == "Dots"){
        jQuery("option[value='dots']s").attr("selected", true);
    }
    if( theme == "Progress"){
        jQuery("option[value='progress']").attr("selected", true);
    }
    
    var animation = "<?php echo $animation_value; ?>";
    if(animation == "None"){
        jQuery("option[value='none']").attr("selected", true);
    }
    if(animation == "Fade"){
        jQuery("option[value='fade']").attr("selected", true);
    }
    if(animation == "Slide Horizantal"){
        jQuery("option[value='slide-horizantal']").attr("selected", true);
    }
    if(animation == "Slide Vertical"){
        jQuery("option[value='slide-vertical']").attr("selected", true);
    }
    if(animation == "Slide Swing"){
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
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <?php
    foreach($email as $email_key => $email_val){
        $email_value = $email_val->setting_value;
        ?>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email_value; ?>">
    <?php
    }
    ?>
    
    <div id="emailHelp" class="form-text">This email address will be used to send assessment tool results.</div>
    <div id="emailHelp" class="form-text">If left blank, the default admin email will be used.</div>
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
    
    <span>Please provide animated speed in seconds i.e 1 = 1seconds or 5 = 5seconds</span>
    
    <div class="custom-control custom-checkbox mt-3">
        <input type="checkbox" class="custom-control-input" id="is_justified" value="1" data-np-checked="1" />
        <label class="custom-control-label" for="is_justified">Justified</label>
    </div>

    <div class="custom-control custom-checkbox mt-3 mb-3">
        <input type="checkbox" class="custom-control-input" id="dark_mode" value="1" data-np-checked="1" />
        <label class="custom-control-label" for="dark_mode">Dark Mode</label>
    </div>
    
    <span>An example of these stylings can be found out at: </span><a target="_blank" href="http://techlaboratory.net/jquery-smartwizard">Click Here</a>
</div>
<button type="submit" class="btn btn-primary">Update</button>