document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.getElementById("menu-icon");
  const menu = document.getElementById("menu");
  const icon = menuIcon.firstElementChild;
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
});

// var links = document.querySelectorAll("header .nav ul li a");
// for (var i = 0; i < links.length; i++) {
//   links[i].addEventListener("click", function (event) {
//     var selectedLink = document.querySelector(".active");
//     if (selectedLink) {
//       selectedLink.classList.remove("active");
//     }
//     this.classList.add("active");
//   });
// }

//opening signup page
document.addEventListener("DOMContentLoaded", function () {
  const signUp = document.getElementById("signup");
  if (signUp) {
    signUp.addEventListener("click", openSignUpPage);
  }
});
function openSignUpPage() {
  window.location = "./sign_up.php";
}

//opening login page
document.addEventListener("DOMContentLoaded", function () {
  const login = document.getElementById("login");
  if (login) {
    login.addEventListener("click", openLoginPage);
  }
});
function openLoginPage() {
  window.location = "./Login.php";
}

//first drop down
const myjob = document.getElementById("my-job");
const drop = document.getElementById("drop-down");
myjob.addEventListener("click", showDropdown);
function showDropdown() {
  if (drop.classList.contains("visible")) {
    drop.classList.remove("visible");
  } else {
    drop.classList.add("visible");
  }
}

//drop down in mobile view
const myjob2 = document.getElementById("my-job2");
const sub = document.getElementById("sub-menu");
myjob2.addEventListener("click", showSubMenu);
function showSubMenu() {
  if (sub.classList.contains("visible")) {
    sub.classList.remove("visible");
  } else {
    sub.classList.add("visible");
  }
}

//drop down when profile is clicked
document.addEventListener("DOMContentLoaded", function () {
  const profile = document.getElementById("profile");
  if (profile) {
    profile.addEventListener("click", showDropdown2);
  }
});
const drop2 = document.getElementById("drop-down2");
function showDropdown2() {
  if (drop2.classList.contains("show")) {
    drop2.classList.remove("show");
  } else {
    drop2.classList.add("show");
  }
}

//opening the message page
const notification = document.getElementById("notification");
// });
