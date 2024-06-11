



//     $(".sidebar-dropdown > a").click(function() {

//   $(".sidebar-submenu").slideUp(200);

//   if (

//     $(this)

//       .parent()

//       .hasClass("active")

//   ) {

//     $(".sidebar-dropdown").removeClass("active");

//     $(this)

//       .parent()

//       .removeClass("active");

//   } else {

//     $(".sidebar-dropdown").removeClass("active");

//     $(this)

//       .next(".sidebar-submenu")

//       .slideDown(200);

//     $(this)

//       .parent()

//       .addClass("active");

//   }

// });



$("#close-sidebar").click(function() {

  $(".page-wrapper").removeClass("toggled");

});

// $("#show-sidebar").click(function() {

//   $(".page-wrapper").addClass("toggled");

// });

$('#show-sidebar').on('click', function () {
  $('.page-wrapper').toggleClass('toggled');
  // $('.page-content-area').toggleClass('active');
});

$(window).on("load resize", function(event){
  var width = $(this).width();
    if (width < 1100) {
      $(".page-wrapper").removeClass("toggled");
    } else {
      $(".page-wrapper").addClass("toggled");
    }
});