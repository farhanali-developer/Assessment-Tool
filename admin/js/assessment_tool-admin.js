jQuery(document).ready(function () {
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
});
