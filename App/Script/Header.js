const menuIcon = document.getElementById("menu-icon");
const icon = menuIcon.firstElementChild;
const menu = document.getElementById("menu");

menuIcon.addEventListener("click", toggleMenu);

function toggleMenu() {
  if (menu.classList.contains("visible")) {
    menu.classList.remove("visible");
    icon.classList.remove("fa-xmark");
    icon.classList.add("fa-bars");
  } else {
    menu.classList.add("visible");
    icon.classList.remove("fa-bars");
    icon.classList.add("fa-xmark");
  }
}

var links = document.querySelectorAll("header .nav ul li a");
for (var i = 0; i < links.length; i++) {
  links[i].addEventListener("click", function (event) {
    // event.preventDefault();
    var selectedLink = document.querySelector(".active");
    if (selectedLink) {
      selectedLink.classList.remove("active");
    }
    this.classList.add("active");
  });
}
