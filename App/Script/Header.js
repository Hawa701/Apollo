const menuIcon = document.getElementById("menu-icon");
const icon = menuIcon.firstElementChild;
const menu = document.getElementById("menu");
const myjob = document.getElementById("my-job");
const myjob2 = document.getElementById("my-job2");
const drop = document.getElementById("drop-down");
const sub = document.getElementById("sub-menu");

const login = document.getElementById("login");
const signUp = document.getElementById("signup");

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

signUp.addEventListener("click", openSignUpPage);
function openSignUpPage() {
  window.location = "./sign_up.php";
}

login.addEventListener("click", openLoginPage);
function openLoginPage() {
  window.location = "./Login.php";
}

// function hideButtons() {
//   const signInnUp = document.getElementById("signInnUp");
//   signInnUp.style.display = "none";
// }

myjob.addEventListener("click", showDropdown);
function showDropdown() {
  if (drop.classList.contains("visible")) {
    drop.classList.remove("visible");
  } else {
    drop.classList.add("visible");
  }
}

myjob2.addEventListener("click", showSubMenu);
function showSubMenu() {
  if (sub.classList.contains("visible")) {
    sub.classList.remove("visible");
  } else {
    sub.classList.add("visible");
  }
}
