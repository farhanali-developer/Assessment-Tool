jQuery(document).ready(function () {
  //Datatable JQUERY plugin for users data in admin panel
  jQuery("#dtBasicExample").DataTable();
  jQuery(".dataTables_length").addClass("bs-select");

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
});
