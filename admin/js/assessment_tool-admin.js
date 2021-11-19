$(document).ready(function () {
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
