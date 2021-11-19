$(document).ready(function () {
  $('#smartwizard').css('display', 'none')
  $('.welcome_final button').click(function () {
    $('.welcome_final .row').addClass('active');
    $(this).addClass('active');

    setTimeout(function () {
      $('.welcome_final .row').addClass('slide-out-left');
      setTimeout(function () {
        $('.welcome_final').addClass('close')
        $('#smartwizard').css('display', 'block')
        // $('#smartwizard .tab-content').css('display', 'none')
        // $('#smartwizard .tab-content').css('display', 'block')
        $('#smartwizard').smartWizard("next")
        // $('#smartwizard').smartWizard("prev")
      }, 500)
    }, 500)
  })


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
      toolbarButtonPosition: 'right', // left, right, center
      showNextButton: true, // show/hide a Next button
      showPreviousButton: true, // show/hide a Previous button
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


  // ------------------------------------------
  // Events on Click for Radio Buttons 
  // ------------------------------------------

  let yes_color = 'green'
  let no_color = 'blue'
  var tabs = $("#smartwizard .nav-link");
  var all_fields = {};
  var all_data = [{
    tab_name: "",
    tab_marks: "",
    questions: [{
      question: "",
      marks: ""
    }]
  }];

  $("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection) {
    for (var i = 1; i <= tabs.length; i++) {
      if (i == stepIndex + 1) {
        $("#step-" + i + " .q-area").css('display', 'none');
        $("#step-" + i + " .q-area").first().css('display', 'flex');
        $('.tab-content').css('height', '0%')
        $('.tab-content').css('height', '100%')
      }
    }
  });

  $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
    // console.log()
    var all_questions = $('#step-' + (currentStepIndex+1)).children('.form-area').children().children().children('.question')
    var tab_name;
    var tab_marks;
    var obj = {
      question: "",
      marks: "",
    };
    var questions = [];

    tab_name = $('#step-' + (currentStepIndex+1)).attr('data-name');
    for(var element of all_questions){
      console.log(element.getAttribute('data-marks'))
      obj.question = element.innerHTML;
      obj.marks = element.getAttribute('data-marks');
      questions.push(obj)
    }
    // console.log(element + " " + each_attr)
    // questions = [{
    //   question: 
    // }]
    // console.log($('#step-' + (currentStepIndex+1)).children('.form-area').children().children().children('.question'))
  });


  $('input.form-radio').click(function () {
    var current = $(this)
    var parent = current.parent();
    var grandParent = current.parent().parent().attr('id')
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


    $(display_field).html(selected)
    $(question_field).val(question)
    // console.log(question_field.val())

    if (selected == 'Yes') {
      $(display_field).css('color', yes_color)

      // Show next question
      $('#' + grandParent + '').next().css('display', 'flex')

      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')

    }
    else if (selected == 'No') {
      $(display_field).css('color', no_color)

      // Hide All next questions
      $(allNextQuestions).css('display', 'none')

      // clear radio btn & Display field values
      $($(allNextQuestions).children().children('input.form-radio')).prop('checked', false)
      $($(allNextQuestions).children().children('h5.display-ans')).empty();


      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')
    }
    $(input).css('display', 'none')
    $(label).css('display', 'none')

    Edit(input, label, edit)

  })

  // To EDIT Answers

  function Edit(input, label, edit) {
    $(edit).click(function () {
      $(input).css('display', 'inline-block')
      $(label).css('display', 'inline-block')
    })
  }


  // Fetching Form Data

  $("#my-form").submit(function (e) {
    e.preventDefault();
    console.log("working")
    // var tabs = [];
    // var i = 1;
    // var all_tabs = [];
    // var single_tab_ques;

    // console.log(tab_pane.children('.form-area').children());
    // for(var j=0; j <= tab_pane.length; j++){
    //   var single_tab = tab_pane[j];
    //   console.log(single_tab);

    // }
    // all_tabs.push($('.tab-pane'))
    // for (var j=1; j <= $('.tab-pane').length; j++) {
    // }
    // console.log(all_tabs);

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

    function set_marks(ans) {
      if (ans == 'Yes') {

        return;
      }
      else if (ans == 'No') {

        return;
      }
    }
    // for (var table in questions_values) {
    //   tabs.push([questions_values[table]])
    // }
    // console.table(questions_values)
    // console.log(tabs)
    console.log(all_fields)
  })

})