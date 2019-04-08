/**
 * Jquery function
 * 
 * TODO: rewrite to vuejs
 */
$(function() {
// Navigation
$(document).on('click', '.js--navigation-logout', function(e) {
    e.preventDefault();
    $('#js--logout-form').submit();
})

// Navigation submenu
$(document).on('click', '#js--navigation-user', function(e) {
    $('#js--navigation-submenu').toggleClass('is-opened');
    e.stopPropagation()
})
$(document).on("click", function(e) {
    if ($(e.target).is("#js--navigation-submenu") === false) {
      $("#js--navigation-submenu").removeClass("is-opened");
    }
});

// Burger submenu
$(document).on('click', '#js--navigation-burger', function(e) {
    $('#js--navigation-burger-submenu').toggleClass('is-opened');
    e.stopPropagation()
})
$(document).on("click", function(e) {
    if ($(e.target).is("#js--navigation-burger-submenu") === false) {
      $("#js--navigation-burger-submenu").removeClass("is-opened");
    }
});




/**
 * TODO: Delete
 */
// window.addEventListener('load', function() {
//     // Fetch all the forms we want to apply custom Bootstrap validation styles to
//     var forms = document.getElementsByClassName('js--form');
//     // Loop over them and prevent submission
//     var validation = Array.prototype.filter.call(forms, function(form) {
//       form.addEventListener('submit', function(event) {

//         if (form.checkValidity() === false) {
//           event.preventDefault();
//           event.stopPropagation();

//           var errorElements = document.querySelectorAll(
//             "input.form-control:invalid");
//           errorElements.forEach(function(element) {
//             element.parentNode.childNodes.forEach(function(node) {
//               if (node.className == 'valid-feedback') {
//                 node.className = 'invalid-feedback';
//                 node.innerText =
//                   'Please choose a Gender';
//               }
//             });
//           });
//           $('html, body').animate({
//             scrollTop: $(errorElements[0]).offset().top
//           }, 2000);
//         }
//         form.classList.add('was-validated');
//       }, false);
//     });
//   }, false);

//   // location
//   $(document).on('click', '.js--location-add', function(e) {    
//     $row = $('.js--location-row');
//     $wrap = $('.js--location-wrap');
//     if($row.length < 3) {
//       $row.eq(0).clone(true).appendTo($wrap).find("input[type='text']").val("");;
//     } else {

//     }
//   })

})