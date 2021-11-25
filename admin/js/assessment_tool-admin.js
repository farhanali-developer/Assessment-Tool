$(document).ready(function () {
  //Datatable JQUERY plugin for users data in admin panel
  $("#dtBasicExample").DataTable();
  $(".dataTables_length").addClass("bs-select");

  var $repeater = $(".repeater").repeater({
    hide: function (deleteElement) {
      if (confirm("Are you sure you want to delete this element?")) {
        $(this).slideUp(deleteElement);
      }
    },
    repeaters: [
      {
        selector: ".inner-repeater",
      },
    ],
  });
});
