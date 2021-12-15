// jQuery.noConflict();

jQuery(document).ready(function () {
  //$(".collapse").not(":first").collapse(); // Collapse all but the first row on the page.

  // This section makes the search work.
  (function () {
    var searchTerm, panelContainerId;
    $("#accordion_search_bar").on("change keyup", function () {
      searchTerm = $(this).val();
      $("#accordion > .accordion-item").each(function () {
        panelContainerId = "#" + $(this).attr("id");

        // Makes search to be case insesitive
        $.extend($.expr[":"], {
          contains: function (elem, i, match, array) {
            return (
              (elem.textContent || elem.innerText || "")
                .toLowerCase()
                .indexOf((match[3] || "").toLowerCase()) >= 0
            );
          },
        });

        // END Makes search to be case insesitive

        // Show and Hide Triggers
        $(panelContainerId + ":not(:contains(" + searchTerm + "))").hide(); //Hide the rows that done contain the search query.
        $(panelContainerId + ":contains(" + searchTerm + ")").show(); //Show the rows that do!
      });

      // $("#tabsaccordion > .accordion-item").each(function () {
      //   panelContainerId = "#" + $(this).attr("id");

      //   // Makes search to be case insesitive
      //   $.extend($.expr[":"], {
      //     contains: function (elem, i, match, array) {
      //       return (
      //         (elem.textContent || elem.innerText || "")
      //           .toLowerCase()
      //           .indexOf((match[3] || "").toLowerCase()) >= 0
      //       );
      //     },
      //   });

      //   // END Makes search to be case insesitive

      //   // Show and Hide Triggers
      //   $(panelContainerId + ":not(:contains(" + searchTerm + "))").hide(); //Hide the rows that done contain the search query.
      //   $(panelContainerId + ":contains(" + searchTerm + ")").show(); //Show the rows that do!
      // });
    });
  })();
  // End Show and Hide Triggers

  // END This section makes the search work.

  // jQuery(".all-retake").click(function () {
  //   jQuery("#dtBasicExample tbody input:checkbox")
  //     .not(this)
  //     .prop("checked", this.checked);
  // });

  //Datatable JQUERY plugin for users data in admin panel
  // jQuery("#dtBasicExample").DataTable();
  // jQuery(".dataTables_length").addClass("bs-select");

  var $repeater = jQuery(".repeater").repeater({
    hide: function (deleteElement) {
      if (confirm("Are you sure you want to delete this element?")) {
        jQuery(this).slideUp(deleteElement);
      }
    },
    repeaters: [
      {
        selector: ".inner-repeater",
      },
    ],
  });

  (function ($) {
    $.fn.inputFilter = function (inputFilter) {
      return this.on(
        "input keydown keyup mousedown mouseup select contextmenu drop",
        function () {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(
              this.oldSelectionStart,
              this.oldSelectionEnd
            );
          } else {
            this.value = "";
          }
        }
      );
    };
  })(jQuery);

  // Install input filters.
  jQuery(".marks").inputFilter(function (value) {
    return /^-?\d*$/.test(value);
  });
  // $("#uintTextBox").inputFilter(function (value) {
  //   return /^\d*$/.test(value);
  // });
  // $("#intLimitTextBox").inputFilter(function (value) {
  //   return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500);
  // });
  // $("#floatTextBox").inputFilter(function (value) {
  //   return /^-?\d*[.,]?\d*$/.test(value);
  // });
  // $("#currencyTextBox").inputFilter(function (value) {
  //   return /^-?\d*[.,]?\d{0,2}$/.test(value);
  // });
  // $("#latinTextBox").inputFilter(function (value) {
  //   return /^[a-z]*$/i.test(value);
  // });
  // $("#hexTextBox").inputFilter(function (value) {
  //   return /^[0-9a-f]*$/i.test(value);
  // });
});
