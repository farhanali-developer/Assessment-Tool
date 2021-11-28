jQuery.noConflict();

jQuery(document).ready(function () {
  jQuery(".all-retake").click(function () {
    jQuery("input:checkbox").not(this).prop("checked", this.checked);
  });

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
