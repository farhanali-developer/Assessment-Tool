$(document).ready(function () {

  var welcome_page = $('.welcome_final.welcome');
  var final_page = $('.welcome_final.final');

  // Welcome Page ; Transition from welcome page to form section
  $('#smartwizard').css('display', 'none')
  $('.welcome_final.welcome button').click(function () {
    $(this).addClass('active');

    setTimeout(function () {
      $('.welcome_final.welcome .row').addClass('slide-out-left');
      setTimeout(function () {
        $('.welcome_final.welcome').addClass('close')
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
          $('.sw .toolbar>.btn').addClass('disabled')
        }, 500)
      }, 500)
    }, 500)
  })

  // Final Page

  $('.welcome_final.final button').click(function () {
    $(this).addClass('active');

    setTimeout(function () {
      $('.welcome_final.welcome .row').addClass('slide-out-left');
      setTimeout(function () {
        $('.welcome_final.welcome').addClass('close')
        $('#smartwizard').css('display', 'block');

      }, 500)
    }, 500)
  })

  // All Global Variables
  let yes_color = 'green'
  let no_color = 'blue'
  var tabs = $("#smartwizard .nav-link");
  var all_data = [];
  var user_data = {
    name: "",
    email: "",
    phone: "",
    timestamp: "",
  }
  var message = $('.message');




  // ----------------------------------
  // Fetching & Submiting Form Data
  // ----------------------------------

  $("#my-form").submit(function (e) {
    e.preventDefault();
    console.log("working")

    var user = $('.user-data-sec').children()
    var date = new Date();

    for (var info of user) {
      if (info.value != 'Submit') {
        if (info.getAttribute('name') == 'name') {
          user_data.name = info.value
        }
        else if (info.getAttribute('name') == 'email') {
          user_data.email = info.value
        }
        else if (info.getAttribute('name') == 'phone') {
          user_data.phone = info.value
        }
      }
    }
    user_data.timestamp = date;

    var url = "";
    var formdata = new FormData();
    formdata.append('user_data', JSON.stringify(user_data))

    // AJAX
    // $.ajax({
    //   "method": "POST",
    //   "url": url,
    //   "data": formdata,
    //   "contentType": false,
    //   success: function (data) {
    //     console.log(data)
    //     message = data;
    //   },
    //   error: function (jqXHR, exception) {
    //     console.log(jqXHR)
    //     message = jqXHR;
    //   }
    // })


    // if (message.children().text() != '') {
    //   $('.user-data .info-section').css('display', 'none')
    // }


    console.log(user_data)
    console.table(all_data)

    setTimeout(function () {
      $('.user-data').removeClass('slide-in-right');
      $('.user-data').addClass('slide-out-left');
      setTimeout(function () {
        $('.user-data').removeClass('show');;
        $('.welcome_final.final').addClass('open');
        $('.welcome_final.final').addClass('slide-in-right');
      }, 300)
      $('.welcome_final.final button').click(function () {
        $(this).addClass('active');
      })
    }, 1000)

  })





  $("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection) {
    var step = stepIndex + 1;
    $('.sw .toolbar>.btn').addClass('disabled')

    // Hide all question except first one when rendering each step
    $("#step-" + step + " .q-area").css('display', 'none');
    $("#step-" + step + " .q-area").first().css('display', 'flex');
    setTimeout(function () {
      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')
    }, 500)

    if (step == tabs.length) {

      // $('.sw .toolbar>.btn').removeClass('disabled')
      $('.sw .toolbar>.btn').click(function () {

        // Calling custom function to get data, Find function at the end of file
        get_this_data(step);

        // Events for displaying / not displaying different sections
        $('#smartwizard').addClass('slide-out-left');
        setTimeout(function () {
          $('#smartwizard').css('display', 'none')
          setTimeout(function () {
            $('.user-data').addClass('show , slide-in-right')
          }, 500)
        }, 500)
      })
    }
  });





  // ------------------------------------------
  // Events on Click for Radio Buttons 
  // ------------------------------------------

  // Get ID of div which contains 'Yes/No' button which has just been clicked
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

    $(display_field).text(selected)
    $('#' + grandParent + ' h5.question').attr('data-value', selected)
    $(edit).css('display', 'block')


    // If Yes is selected
    if (selected == 'Yes') {

      $(display_field).css('color', yes_color)

      // Show next question
      $('#' + grandParent + '').next().css('display', 'flex')

      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')

      // Show radio buttons of all next questions only if they haven't been checked yet
      for (var each of $($(allNextQuestions).children().children('h5.display-ans'))) {
        if (each.childNodes.length == 0) {
          $($(allNextQuestions).children().children('input.form-radio')).css('display', 'block')
          $($(allNextQuestions).children().children('label')).css('display', 'block')
        }
      }

      // Show / Hide Next Button
      if ($('#' + grandParent + '').next().children().children('h5.question').attr('data-value') == '') {
        $('.sw .toolbar>.btn').addClass('disabled')
      }
      else {
        $('.sw .toolbar>.btn').removeClass('disabled')
      }
    }

    // If No is selected
    else if (selected == 'No') {

      $(display_field).css('color', no_color)

      // Hide All next questions
      $(allNextQuestions).css('display', 'none')

      // clear radio button, data-value attribute & Display field values
      $($(allNextQuestions).children().children('input.form-radio')).prop('checked', false)
      $($(allNextQuestions).children().children('h5.display-ans')).empty();
      $($(allNextQuestions).children().children('h5.question')).attr('data-value', '')
      $($(allNextQuestions).children().children('a.edit')).css('display', 'none')

      // refresh tab height
      $('.tab-content').css('height', '0%')
      $('.tab-content').css('height', '100%')

      // Show Next Button
      $('.sw .toolbar>.btn').removeClass('disabled')
    }

    // Hide radio button after clicking
    $(input).css('display', 'none')
    $(label).css('display', 'none')

  })







  // To EDIT selected value
  $('a.edit').click(function () {

    // Get ID of div that contains the 'edit' button which has just been clicked
    var edit_grandParent = $(this).parent().parent().attr('id');

    // Check if ID of Parent Div which contains 'edit' button is equal to 
    // the ID of Parent Div which contains the 'Yes/No' button => which was clicked just before 'edit' button
    if (current_grandParent == edit_grandParent) {
      // console.log("Same")
      // If is Equals then show input fields ('Yes/No') of the same Parent Div
      var input = $('#' + current_grandParent + ' input.form-radio')
      var label = $('#' + current_grandParent + ' label')
      $(input).css('display', 'inline-block')
      $(label).css('display', 'inline-block')
    }
    else {
      // console.log("Not Same")
      // If is not Equals then show input fields ('Yes/No') of the Parent Div of 'edit' button
      var input = $('#' + edit_grandParent + ' input.form-radio')
      var label = $('#' + edit_grandParent + ' label')
      $(input).css('display', 'inline-block')
      $(label).css('display', 'inline-block')
    }
  });





  // Get Data of each step just before leaving that step and push that data into "all_data[]"
  $("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
    var step = currentStepIndex + 1;

    // Calling custom function to get data
    // Find function at the end of file
    get_this_data(step);
  });



  // Callback function for "Sort()"
  function compare(key) {
    return function (obj1, obj2) {
      if (parseInt(obj1[key]) > parseInt(obj2[key])) { // Place obj2 first, then obj1
        return -1;
      }
      if (parseInt(obj1[key]) < parseInt(obj2[key])) { // Place obj1 first, then obj2 
        return 1;
      }
      return 0; //keep the same order
    }
  }




  // ---------------------------- 
  // To get data from every Tab
  // -----------------------------
  function get_this_data(tab) {
    // get all questions in this step
    var all_questions = $('#step-' + tab).children('.form-area').children().children().children('.question')
    var t_marks = 0;

    var each_data = {
      tab_name: $('#step-' + tab).attr('data-name'),
      tab_marks: "",
      questions: []
    }
    var obj = {
      question: "",
      ans: "",
      marks: "",
    };

    // Populate questions array in "each_data" with all questions and their marks
    for (var element of all_questions) {
      var attr = element.getAttribute('data-value');
      if (attr == "Yes") {
        obj = {
          question: element.innerHTML,
          ans: attr,
          marks: "0",
        }
        each_data.questions.push(obj)
      }
      else if (attr == "No") {
        obj = {
          question: element.innerHTML,
          ans: attr,
          marks: element.getAttribute('data-marks'),
        }
        each_data.questions.push(obj)
      }
      else {
        obj = {
          question: element.innerHTML,
          ans: 'Not Answered',
          marks: "0"
        }
        each_data.questions.push(obj)
      }
    }

    // Sort questions based on marks
    each_data.questions.sort(compare('marks'))

    // Populate t_marks declared above with Sum of marks of all questions
    for (var key in each_data.questions) {
      t_marks = t_marks + parseInt(each_data.questions[key].marks)
    }

    // Push total marks from t_marks in tab_marks of "each_data"
    each_data.tab_marks = t_marks;

    // Now that we have tab name, tab marks, and all questions with their marks, of every step as an object
    // We Push that into Global array containing data of every step "all_data[]"
    all_data.push(each_data)

    // Sort all_data based on total marks
    all_data.sort(compare('tab_marks'));
  }

})
