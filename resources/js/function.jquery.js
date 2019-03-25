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


})
