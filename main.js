$(document).ready(function () {

  // Transition from welcome section to Wizard section
  $('#smartwizard').css('display', 'none')
  $('.welcome_final button').click(function () {
    $('.welcome_final .row').addClass('active');
    $(this).addClass('active');

    setTimeout(function () {
      $('.welcome_final .row').addClass('slide-out-left');
      setTimeout(function () {
        $('.welcome_final').addClass('close')
        $('#smartwizard').css('display', 'block')

        // Smart Wizard Plugin
        $('#smartwizard').smartWizard({
          selected: 0, // Initial selected step, 0 = first step
          theme: 'arrows', // theme for the wizard, related css need to include for other than default theme
          justified: true, // Nav menu justification. true/false
          darkMode: false, // Enable/disable Dark Mode if the theme supports. true/false
          autoAdjustHeight: true, // Automatically adjust content height
          cycleSteps: false, // Allows to cycle the navigation of steps
          backButtonSupport: true, // Enable the back button support
          enableURLhash: false, // Enable selection of the step based on url hash
          transition: {
            animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '400', // Transion animation speed
            easing: '', // Transition animation easing. Not supported without a jQuery easing plugin
          },
          toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'center', // left, right, center
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
            next: 'Next',
            previous: 'Previous',
          },
          disabledSteps: [], // Array Steps disabled
          errorSteps: [], // Highlight step with errors
          hiddenSteps: [], // Hidden steps
        })

        setTimeout(function () {
          // refresh tab height
          $('.tab-content').css('height', '0%')
          $('.tab-content').css('height', '100%')

          // Next Button Arrow
          $('.sw .toolbar>.btn').append('<i class="fas fa-long-arrow-alt-right"></i>');
        }, 800)
      }, 500)
    }, 500)
  })


  // All Global Variables
  let yes_color = 'green'
  let no_color = 'blue'
  var tabs = $("#smartwizard .nav-link");
  var all_fields = {};
  var all_data = [];


  // Fetching & Submiting Form Data
  $("#my-form").submit(function (e) {
    e.preventDefault();
    console.log("working")
    $.each($('#my-form').serializeArray(), function (i, field) {
      if (field.value != '') {
        all_fields[field.name] = field.value;
      }
    });

    for (var field in all_fields) {
      // if (field == 'question_field_' + i) {
      //   questions_values.push([field, all_fields[field], all_fields['ans' + i]])
      //   i++;
      // }


    }

    console.log(all_fields)
  })

  // Hide all question except first one when rendering each step
  $("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection) {
    for (var i = 1; i <= tabs.length; i++) {
      if (i == stepIndex + 1) {
        $("#step-" + i + " .q-area").css('display', 'none');
        $("#step-" + i + " .q-area").first().css('display', 'flex');
        setTimeout(function () {
          // refresh tab height
          $('.tab-content').css('height', '0%')
          $('.tab-content').css('height', '100%')
        }, 500)
      }
    }
  });


  // ------------------------------------------
  // Events on Click for Radio Buttons 
  // ------------------------------------------

  // var edit_grandParent;
  var current_grandParent;

  $('input.form-radio').click(function () {
    var current = $(this)
    var parent = current.parent();
    var grandParent = current.parent().parent().attr('id');
    current_grandParent = grandParent;
    var step = current.parent().parent().parent().parent().attr('id')
    var input = $('#' + grandParent + ' input.form-radio')
    var label = $('#' + grandParent + ' label')
    var edit = $('#' + grandParent + ' a.edit')
    var inputAttr = $('#' + grandParent + ' .form-radio').attr('name')
    var selected = $('#' + grandParent + " input[name='" + inputAttr + "']:checked").val()
    var display_field = $('#' + grandParent + ' h5.display-ans')
    var allNextQuestions = $('#' + grandParent + '').nextAll();
    var question = $('#' + grandParent + ' h5.question').text();
    var question_field = $('#' + grandParent + ' input.question_field');

    $(display_field).text(selected)
    $('#' + grandParent + ' h5.question').attr('data-value', selected)
    $(question_field).val(question)

    if (selected == 'Yes') {
      $(display_field).css('color', yes_color)

      // Show next question
      $('#' + grandParent + '').next().css('display', 'flex')


      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')

      // Show radio buttons only if they haven't been checked yet
      for (var each of $($(allNextQuestions).children().children('h5.display-ans'))) {
        if (each.childNodes.length == 0) {
          $($(allNextQuestions).children().children('input.form-radio')).css('display', 'block')
          $($(allNextQuestions).children().children('label')).css('display', 'block')
        }
      }
    }
    else if (selected == 'No') {
      $(display_field).css('color', no_color)

      // Hide All next questions
      $(allNextQuestions).css('display', 'none')

      // clear radio btn & Display field values
      $($(allNextQuestions).children().children('input.form-radio')).prop('checked', false)
      $($(allNextQuestions).children().children('h5.display-ans')).empty();
      $($(allNextQuestions).children().children('h5.question')).attr('data-value', '')

      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')
    }
    $(input).css('display', 'none')
    $(label).css('display', 'none')
  })


  // To EDIT Selection
  $('a.edit').click(function () {
    var edit_grandParent = $(this).parent().parent().attr('id');

    if (current_grandParent == edit_grandParent) {
      console.log("Same")
      var input = $('#' + current_grandParent + ' input.form-radio')
      var label = $('#' + current_grandParent + ' label')
      $(input).css('display', 'inline-block')
      $(label).css('display', 'inline-block')
    }
    else {
      console.log("Not Same")
      var input = $('#' + edit_grandParent + ' input.form-radio')
      var label = $('#' + edit_grandParent + ' label')
      $(input).css('display', 'inline-block')
      $(label).css('display', 'inline-block')
    }
  });


  // Get Data of each step just before leaving that step and push that data into "all_data[]"
  $("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
    var all_questions = $('#step-' + (currentStepIndex + 1)).children('.form-area').children().children().children('.question')
    var t_marks = 0;

    var each_data = {
      tab_name: $('#step-' + (currentStepIndex + 1)).attr('data-name'),
      tab_marks: "",
      questions: []
    }
    var obj = {
      question: "",
      marks: "",
    };

    for (var element of all_questions) {
      var attr = element.getAttribute('data-value');
      if (attr == "Yes") {
        obj = {
          question: element.innerHTML,
          marks: element.getAttribute('data-marks')
        }
        each_data.questions.push(obj)
      }
      else {
        obj = {
          question: element.innerHTML,
          marks: "0"
        }
        each_data.questions.push(obj)
      }
    }

    each_data.questions.sort(compare('marks'))
    for (var key in each_data.questions) {
      t_marks = t_marks + parseInt(each_data.questions[key].marks)
    }
    each_data.tab_marks = t_marks;
    all_data.push(each_data)
    all_data.sort(compare('tab_marks'));

    console.table(all_data)

  });

  // Callback function for "Sort()"
  function compare(key) {
    return function (obj1, obj2) {
      if (parseInt(obj1[key]) > parseInt(obj2[key])) { //obj1 first then obj2
        return -1;
      }
      if (parseInt(obj1[key]) < parseInt(obj2[key])) { //obj2 first then obj1
        return 1;
      }
      return 0; //keep the same order
    }
  }

})