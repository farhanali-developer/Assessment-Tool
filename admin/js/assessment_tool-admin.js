$(document).ready(function () {
  // $(".repeater").submit(function (e) {
  //   e.preventDefault();

  //   console.log($('input[name="outer-list[0][text-input]"').val());

  //   const Toast = Swal.mixin({
  //     toast: true,
  //     position: "top-end",
  //     showConfirmButton: false,
  //     timer: 2000,
  //     timerProgressBar: true,
  //     // didOpen: (toast) => {
  //     //   toast.addEventListener("mouseenter", Swal.stopTimer);
  //     //   toast.addEventListener("mouseleave", Swal.resumeTimer);
  //     // },
  //     customClass: {
  //       container: "mt-4",
  //     },
  //   });

  //   Toast.fire({
  //     icon: "success",
  //     title: "Form Submitted Successfully",
  //   });
  // });

  var $repeater = $(".repeater").repeater({
    hide: function (deleteElement) {
      if (confirm("Are you sure you want to delete this element?")) {
        $(this).slideUp(deleteElement);
      }
    },
    repeaters: [
      {
        selector: ".inner-repeater",
        // repeaters: [
        //   {
        //     selector: ".deep-inner-repeater",
        //   },
        // ],
      },
    ],
  });

  // $repeater.setList([
  //   {
  //     "text-input": "Clothing",
  //     "inner-list": [
  //       {
  //         "inner-text-input": "Shirts",
  //         "deep-inner-list": [
  //           {
  //             "inner-text-input": "Red Shirts",
  //           },
  //           {
  //             "inner-text-input": "Green Shirts",
  //           },
  //         ],
  //       },
  //       {
  //         "inner-text-input": "Trousers",
  //         "deep-inner-list": [
  //           {
  //             "inner-text-input": "Long Trousers",
  //           },
  //           {
  //             "inner-text-input": "Short Trousers",
  //           },
  //         ],
  //       },
  //     ],
  //   },
  //   {
  //     "text-input": "Accessories",
  //     "inner-list": [
  //       {
  //         "inner-text-input": "Hats",
  //         "deep-inner-list": [
  //           {
  //             "inner-text-input": "Cowboy Hats",
  //           },
  //           {
  //             "inner-text-input": "Animal Fur Hats",
  //           },
  //         ],
  //       },
  //     ],
  //   },
  // ]);
});
