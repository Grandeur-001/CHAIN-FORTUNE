var toggleButton = $("#toggle-btn");
var sidebar = $("#sidebar");
var main = $("#main");
var footer = $("#footer");
var currentMarginLeft = main.css("marginLeft");

function toggleSidebar() {
  sidebar.toggleClass("close");
  toggleButton.toggleClass("rotate");


  if (sidebar.hasClass("close") && currentMarginLeft === "272px") {
    main.css("marginLeft", "4rem");
    footer.css("marginLeft", "4rem");
  } else {
    main.css("marginLeft", "17rem");
    footer.css("marginLeft", "17rem");
  }

  closeAllSubMenus();
}

function toggleSubMenu(button) {
  const $button = $(button);

  if (!$button.next().hasClass('show')) {
    if (window.matchMedia("(min-width: 800px)").matches) {
        if (currentMarginLeft !== "272px") {
          main.css("marginLeft", "4rem");
          footer.css("marginLeft", "4rem");
        } else {
          main.css("marginLeft", "17rem");
          footer.css("marginLeft", "17rem");
        }
      }
  
    closeAllSubMenus();
  }





  $button.next().toggleClass('show');
  $button.toggleClass('rotate');


  if (sidebar.hasClass("close")) {
    sidebar.toggleClass("close");
    toggleButton.toggleClass("rotate");
  }
}

function closeAllSubMenus() {
  sidebar.find(".show").each(function() {
    $(this).removeClass("show");
    $(this).prev().removeClass("rotate");
  });
}

window.addEventListener('beforeunload', function (event) {
  event.returnValue = '';  
});
