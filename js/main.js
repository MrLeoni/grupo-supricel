$(document).ready(function() {
  
  /*--------------------------------
  // Mobile navigation engine
  --------------------------------*/
  
  $("#js-mobile-btn").click(function() {
    
    // Toggle class in #js-mobile-btn
    // When "active" is placed, the icon changes to a times icon and the navigation apears
    $(this).toggleClass("active");
    
    // Creating a boolean variable to check if #js-mobile-btn has or not the "active" class
    var btnHasClass = $(this).hasClass("active");
    // Store "menu-navigation-box" in a variable
    var nav = $(".menu-navigation-box");
    
    if (btnHasClass) {
      // If #js-mobile-nav is active, change css in menu-navigation-box
      nav.css("height", "auto");
    } else {
      // If it's not active, set "height" to "0"
      nav.css("height", "0");
    }
    
  });
  
});