<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://farhanali.me
 * @since      1.0.0
 *
 * @package    Assessment_tool
 * @subpackage Assessment_tool/public/partials
 */

function assessment_tool_function(){
require_once dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) )) ) ) ) . '/wp-config.php';
// require_once( ABSPATH . '/wp-config.php' );

global $wpdb;
$wpdb->hide_errors();
$tabs_table = 'assessment_tool_tabs';
$questions_table = 'assessment_tool_questions';
$settings_table = 'assessment_tool_settings';
$charset_collate = $wpdb->get_charset_collate();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$tabs = $wpdb->get_results("SELECT * FROM assessment_tool_tabs ORDER BY id");

if($tabs){
$formUrl = plugin_dir_url( __FILE__ ) . "submit_user_data.php";
?>

<form id="my-form" action="<?php echo $formUrl; ?>">

<?php
$welcome_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 9");
$end_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 10");
$welcome_text = $welcome_value->setting_value;
$end_text = $end_value->setting_value;
?>
    <!-- Welcome Page -->
    <div class="welcome_final welcome d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center py-5 slide-in-right">
                <div class="col-8">
                    <p>
                    <?php echo html_entity_decode($welcome_text); ?>
                    </p>
                </div>
                <div class="col-8">
                    <button class="my-button" type="button">START SURVEY</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Smart Wizard -->
    <div id="smartwizard" class="container">
        <ul class="nav mx-0">
        <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $description = $tabs_data->tab_description;
        
        ?>
            <li>
            <a class="nav-link" href="#step-<?php echo $tab_id; ?>" data-id="<?php echo $tab_id; ?>"> <?php echo $tab; ?> </a>
            </li>
            <?php
        }
            ?>
        </ul>

        <div class="tab-content">
        <?php
        foreach($tabs as $tabs_name => $tabs_data){
            $tab_id = $tabs_data->id;
            $tab = $tabs_data->tab_name;
            $chapter_title = $tabs_data->chapter_title;
            $description = $tabs_data->tab_description;
        
        ?>
            <!-- Step 1 -->
            <div id="step-<?php echo $tab_id; ?>" tab-id="<?php echo $tab_id; ?>" chapter-title="<?php echo $chapter_title; ?>" class="tab-pane" role="tabpanel" data-name="<?php echo $tab; ?>" data-marks="" data-priority="">
                <div class="step-info">
                    <div class="container">
                    <p class="lead my-0"><?php echo htmlspecialchars_decode($description); ?></p>
                    </div>
                </div>

                <div class="form-area col-12 col-md-10">

                <?php
                    $questions = $wpdb->get_results("SELECT * FROM assessment_tool_questions WHERE tab_id = $tab_id ORDER BY id");
                    foreach($questions as $questions_name => $questions_data){
                        $question_id = $questions_data->id;
                        $question = $questions_data->question;
                        $marks = $questions_data->marks;
                ?>
                    <!-- Q1 -->
                    <div id="q-area-<?php echo $question_id; ?>" class="row q-area">
                        <div class="col-12 d-flex justify-content-between question1 align-items-center flex-wrap mb-2">
                            <h5 class="question my-0" data-marks="<?php echo $marks; ?>" data-value="" question-id="<?php echo $question_id; ?>"><?php echo $question; ?></h5>
                            <h5 class="display-ans my-0"></h5>
                            <a href="#q-area-<?php echo $question_id; ?>" class="edit">Edit</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <input class="yes form-radio" type="radio" name="ans<?php echo $question_id; ?>" id="yes-<?php echo $question_id; ?>" value="Yes" />
                            <label class="for-yes" for="yes-<?php echo $question_id; ?>">
                            <i class="far fa-check-circle indication"></i>
                            <i class="far fa-thumbs-up thumb"></i>
                            Yes
                            </label>
                        </div>
                        <div class="col-6 d-flex justify-content-start">
                            <input class="no form-radio" type="radio" name="ans<?php echo $question_id; ?>" id="no-<?php echo $question_id; ?>" value="No" />
                            <label class="for-no" for="no-<?php echo $question_id; ?>">
                            <i class="far fa-times-circle indication"></i>
                            <i class="far fa-thumbs-down thumb"></i>
                            No
                            </label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


    <!-- User Data -->
    <div class="user-data d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row py-5 slide-in-right">
                <div class="col-10 col-md-6 col-lg-4 mx-auto info-section">
                    <div class="text-center pb-4">
                        <h1 class="display-6">Please Enter Contact Information</h1>
                    </div>
                    <div class="user-data-sec d-flex justify-content-center flex-wrap">
                        <input type="text" required name="name" class="user-info form-control" placeholder="Name *" id="" />
                        <input type="email" required name="email" class="user-info form-control" placeholder="Email *" id="" />
                        <input type="text" name="phone" class="user-info form-control" placeholder="Phone Number" id="" />
                        <input type="submit" class="btn mt-5" value="Submit" />
                    </div>
                </div>
                <div class="message">
                    <h5 class="message-text"></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Page -->
    <div class="welcome_final final d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center py-5 slide-in-right">
                <div class="col-8">
                    <p>
                    <?php echo html_entity_decode($end_text); ?>
                    </p>
                </div>
                <div class="col-8">
                    <a href="https://mandelberg.biz/" class="my-button">CLICK HERE TO GO TO THE WEBSITE</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    
    $theme_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 4");
    $animation_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 5");
    $animation_speed_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 6");
    $alignment_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 7");
    $mode_value = $wpdb->get_row("SELECT setting_value FROM $settings_table WHERE id = 8");
    

    $selectedTheme = $theme_value->setting_value;
    
    $animationType = $animation_value->setting_value;
    
    $animationSpeed = $animation_speed_value->setting_value;
    
    $alignmentType = $alignment_value->setting_value;
    $alignmentValue = ($alignmentType == 1) ? 'true' : 'false';
    
    $modeType = $mode_value->setting_value;
    $modeValue = ($modeType == 1) ? 'true' : 'false';

    
    
?>
<script>
/**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  jQuery(document).ready(function ($) {
    "use strict";
    var welcome_page = $(".welcome_final.welcome");
    var final_page = $(".welcome_final.final");

    // Welcome Page ; Transition from welcome page to form section
    $("#smartwizard").css("display", "none");
    $(".welcome_final.welcome button").click(function () {
      $(this).addClass("active");

      setTimeout(function () {
        $(".welcome_final.welcome .row").addClass("slide-out-left");
        setTimeout(function () {
          $(".welcome_final.welcome").addClass("close");
          $("#smartwizard").css("display", "block");

          // Smart Wizard Plugin
          $("#smartwizard").smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: "<?php echo $selectedTheme; ?>", // theme for the wizard, related css need to include for other than default theme
            justified: <?php echo $alignmentValue; ?>, // Nav menu justification. true/false
            darkMode: <?php echo $modeValue; ?>, // Enable/disable Dark Mode if the theme supports. true/false
            autoAdjustHeight: true, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            enableURLhash: false, // Enable selection of the step based on url hash
            transition: {
              animation: "<?php echo $animationType; ?>", // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
              speed: "<?php echo $animationSpeed; ?>", // Transion animation speed
              easing: "", // Transition animation easing. Not supported without a jQuery easing plugin
            },
            toolbarSettings: {
              toolbarPosition: "bottom", // none, top, bottom, both
              toolbarButtonPosition: "center", // left, right, center
              showNextButton: true, // show/hide a Next button
              showPreviousButton: false, // show/hide a Previous button
              toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            },
            anchorSettings: {
              anchorClickable: true, // Enable/Disable anchor navigation
              enableAllAnchors: false, // Activates all anchors clickable all times
              markDoneStep: true, // Add done state on navigation
              markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
              removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
              enableAnchorOnDoneStep: false, // Enable/Disable the done steps navigation
            },
            keyboardSettings: {
              keyNavigation: false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
              keyLeft: [37], // Left key code
              keyRight: [39], // Right key code
            },
            lang: {
              // Language variables for button
              next: "Next",
              previous: "Previous",
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Highlight step with errors
            hiddenSteps: [], // Hidden steps
          });

          setTimeout(function () {
            // refresh tab height
            $(".tab-content").css("height", "0%");
            $(".tab-content").css("height", "100%");

            // Next Button Arrow
            $(".sw .toolbar>.btn").append(
              '<i class="fas fa-long-arrow-alt-right"></i>'
            );
            $(".sw .toolbar>.btn").addClass("disabled");
          }, 500);
        }, 500);
      }, 500);
    });

    // Final Page

    $(".welcome_final.final button").click(function () {
      $(this).addClass("active");

      setTimeout(function () {
        $(".welcome_final.welcome .row").addClass("slide-out-left");
        setTimeout(function () {
          $(".welcome_final.welcome").addClass("close");
          $("#smartwizard").css("display", "block");
        }, 500);
      }, 500);
    });

    // All Global Variables
    let yes_color = "green";
    let no_color = "blue";
    var tabs = $("#smartwizard .nav-link");
    var all_data = [];
    var user_data = {
      name: "",
      email: "",
      phone: "",
      date: "",
      month: "",
      year: "",
      hour: "",
      minute: "",
      second: "",
      timezone: "",
    };
    var message = $(".message");

    // ----------------------------------
    // Fetching & Submiting Form Data
    // ----------------------------------

    var dataUrl = $("#my-form").attr("action");
    $("#my-form").submit(function (e) {
      e.preventDefault();

      var user = $(".user-data-sec").children();
      var date = new Date();

      for (var info of user) {
        if (info.value != "Submit") {
          if (info.getAttribute("name") == "name") {
            user_data.name = info.value;
          } else if (info.getAttribute("name") == "email") {
            user_data.email = info.value;
          } else if (info.getAttribute("name") == "phone") {
            user_data.phone = info.value;
          }
        }
      }

      var day = date.getDate();
      var year = date.getFullYear();
      var month = date.getMonth();
      var hour = date.getHours();
      var minutes = date.getMinutes();
      var seconds = date.getSeconds();
      var timezone = date.toString().match(/([A-Z]+[\+-][0-9]+.*)/)[1];

      user_data.date = day;
      user_data.month = month;
      user_data.year = year;
      user_data.hour = hour;
      user_data.minute = minutes;
      user_data.second = seconds;
      user_data.timezone = timezone;

      var formdata = new FormData();
      formdata.append("user_data", JSON.stringify(user_data));
      formdata.append("form_data", JSON.stringify(all_data));

      // AJAX
      jQuery.ajax({
        method: "POST",
        url: dataUrl,
        processData: false,
        async: true,
        crossDomain: true,
        data: formdata,
        contentType: false,
        success: function (data) {
          message.children().text(data);
          // responemessage = data;
          if (message.children().text() != "") {
            $(".user-data .info-section").css("display", "none");
          }
        },
        error: function (jqXHR, exception) {
          console.log(JSON.stringify(jqXHR));
        },
      });

      setTimeout(function () {
        $(".user-data").removeClass("slide-in-right");
        $(".user-data").addClass("slide-out-left");
        setTimeout(function () {
          $(".user-data").removeClass("show");
          $(".welcome_final.final").addClass("open");
          $(".welcome_final.final").addClass("slide-in-right");
        }, 0);
        $(".welcome_final.final button").click(function () {
          $(this).addClass("active");
        });
      }, 7000);
    });

    $("#smartwizard").on(
      "showStep",
      function (e, anchorObject, stepIndex, stepDirection) {
        var step = stepIndex + 1;
        $(".sw .toolbar>.btn").addClass("disabled");

        console.log("Step is: " + step)

        // Hide all question except first one when rendering each step
        $("#step-" + step + " .q-area").css("display", "none");
        $("#step-" + step + " .q-area")
          .first()
          .css("display", "flex");
        setTimeout(function () {
          // refresh tab height
          $(".tab-content").css("height", "0%");
          $(".tab-content").css("height", "100%");
        }, 500);

        if (step == tabs.length) {
          // $('.sw .toolbar>.btn').removeClass('disabled')
          $(".sw .toolbar>.btn").click(function () {
            // Calling custom function to get data, Find function at the end of file
            var data_id = $(".nav-link").last().attr("data-id");

            get_this_data(data_id);

            // Events for displaying / not displaying different sections
            $("#smartwizard").addClass("slide-out-left");
            setTimeout(function () {
              $("#smartwizard").css("display", "none");
              setTimeout(function () {
                $(".user-data").addClass("show , slide-in-right");
              }, 500);
            }, 500);
          });
        }
      }
    );

    // ------------------------------------------
    // Events on Click for Radio Buttons
    // ------------------------------------------

    // Get ID of div which contains 'Yes/No' button which has just been clicked
    var current_grandParent;

    $("input.form-radio").click(function () {

      console.log("Hello World")
      var current = $(this);
      var parent = current.parent();
      var grandParent = current.parent().parent().attr("id");
      current_grandParent = grandParent;
      var step = current.parent().parent().parent().parent().attr("id");
      var input = $("#" + grandParent + " input.form-radio");
      var label = $("#" + grandParent + " label");
      var edit = $("#" + grandParent + " a.edit");
      var inputAttr = $("#" + grandParent + " .form-radio").attr("name");
      var selected = $(
        "#" + grandParent + " input[name='" + inputAttr + "']:checked"
      ).val();
      var display_field = $("#" + grandParent + " h5.display-ans");
      var allNextQuestions = $("#" + grandParent + "").nextAll();

      $(display_field).text(selected);
      $("#" + grandParent + " h5.question").attr("data-value", selected);
      $(edit).css("display", "block");

      // If Yes is selected
      if (selected == "Yes") {
        $(display_field).css("color", yes_color);

        // Show next question
        $("#" + grandParent + "")
          .next()
          .css("display", "flex");

        // refresh tab height
        $(".tab-content").css("height", "0%");
        $(".tab-content").css("height", "100%");

        // Show radio buttons of all next questions only if they haven't been checked yet
        for (var each of $(
          $(allNextQuestions).children().children("h5.display-ans")
        )) {
          if (each.childNodes.length == 0) {
            $($(allNextQuestions).children().children("input.form-radio")).css(
              "display",
              "block"
            );
            $($(allNextQuestions).children().children("label")).css(
              "display",
              "block"
            );
          }
        }

        // Show / Hide Next Button
        if (
          $("#" + grandParent + "")
            .next()
            .children()
            .children("h5.question")
            .attr("data-value") == ""
        ) {
          $(".sw .toolbar>.btn").addClass("disabled");
        } else {
          $(".sw .toolbar>.btn").removeClass("disabled");
        }
      }

      // If No is selected
      else if (selected == "No") {
        $(display_field).css("color", no_color);

        // Hide All next questions
        $(allNextQuestions).css("display", "none");

        // clear radio button, data-value attribute & Display field values
        $($(allNextQuestions).children().children("input.form-radio")).prop(
          "checked",
          false
        );
        $($(allNextQuestions).children().children("h5.display-ans")).empty();
        $($(allNextQuestions).children().children("h5.question")).attr(
          "data-value",
          ""
        );
        $($(allNextQuestions).children().children("a.edit")).css(
          "display",
          "none"
        );

        // refresh tab height
        $(".tab-content").css("height", "0%");
        $(".tab-content").css("height", "100%");

        // Show Next Button
        $(".sw .toolbar>.btn").removeClass("disabled");
      }

      // Hide radio button after clicking
      $(input).css("display", "none");
      $(label).css("display", "none");
    });

    // To EDIT selected value
    $("a.edit").click(function () {
      // Get ID of div that contains the 'edit' button which has just been clicked
      var edit_grandParent = $(this).parent().parent().attr("id");

      // Check if ID of Parent Div which contains 'edit' button is equal to
      // the ID of Parent Div which contains the 'Yes/No' button => which was clicked just before 'edit' button
      if (current_grandParent == edit_grandParent) {
        // If is Equals then show input fields ('Yes/No') of the same Parent Div
        var input = $("#" + current_grandParent + " input.form-radio");
        var label = $("#" + current_grandParent + " label");
        $(input).css("display", "inline-block");
        $(label).css("display", "inline-block");
      } else {
        // If is not Equals then show input fields ('Yes/No') of the Parent Div of 'edit' button
        var input = $("#" + edit_grandParent + " input.form-radio");
        var label = $("#" + edit_grandParent + " label");
        $(input).css("display", "inline-block");
        $(label).css("display", "inline-block");
      }
    });

    // Get Data of each step just before leaving that step and push that data into "all_data[]"
    $("#smartwizard").on(
      "leaveStep",
      function (
        e,
        anchorObject,
        currentStepIndex,
        nextStepIndex,
        stepDirection
      ) {
        // var step = currentStepIndex + 1;
        var data_id = $(".nav-link.active").attr("data-id");

        // Calling custom function to get data
        // Find function at the end of file
        get_this_data(data_id);
      }
    );

    // Callback function for "Sort()"
    function compare(key) {
      return function (obj1, obj2) {
        if (parseInt(obj1[key]) > parseInt(obj2[key])) {
          // Place obj2 first, then obj1
          return -1;
        }
        if (parseInt(obj1[key]) < parseInt(obj2[key])) {
          // Place obj1 first, then obj2
          return 1;
        }
        return 0; //keep the same order
      };
    }

    // ----------------------------
    // To get data from every Tab
    // -----------------------------
    function get_this_data(tab) {
      // get all questions in this step
      var all_questions = $("#step-" + tab)
        .children(".form-area")
        .children()
        .children()
        .children(".question");

      var t_marks = 0;

      var each_data = {
        tab_id: $("#step-" + tab).attr("tab-id"),
        chapter_title: $("#step-" + tab).attr("chapter-title"),
        tab_name: $("#step-" + tab).attr("data-name"),
        tab_description: $("#step-" + tab + " p.lead").html(),
        tab_marks: "",
        questions: [],
      };
      var obj = {
        question_id: "",
        question: "",
        ans: "",
        marks: "",
      };

      // Populate questions array in "each_data" with all questions and their marks
      for (var element of all_questions) {
        var attr = element.getAttribute("data-value");
        var q_id = element.getAttribute("question-id");
        if (attr == "Yes") {
          obj = {
            question_id: q_id,
            question: element.innerHTML,
            ans: attr,
            marks: "0",
          };
          each_data.questions.push(obj);
        } else if (attr == "No") {
          obj = {
            question_id: q_id,
            question: element.innerHTML,
            ans: attr,
            marks: element.getAttribute("data-marks"),
          };
          each_data.questions.push(obj);
        } else {
          obj = {
            question_id: q_id,
            question: element.innerHTML,
            ans: "-",
            marks: "0",
          };
          each_data.questions.push(obj);
        }
      }

      // Sort questions based on marks
      each_data.questions.sort(compare("marks"));

      // Populate t_marks declared above with Sum of marks of all questions
      for (var key in each_data.questions) {
        t_marks = t_marks + parseInt(each_data.questions[key].marks);
      }

      // Push total marks from t_marks in tab_marks of "each_data"
      each_data.tab_marks = t_marks;

      // Now that we have tab name, tab marks, and all questions with their marks, of every step as an object
      // We Push that into Global array containing data of every step "all_data[]"
      all_data.push(each_data);

      // Sort all_data based on total marks
      all_data.sort(compare("tab_marks"));
    }
  });
</script>
<?php
}

}


add_shortcode('assessment_tool', 'assessment_tool_function'); 

?>