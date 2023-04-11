//toggling the apply job page
function openApplyJob(x) {
  document.getElementById("apply-job").style.width = x;
  document.getElementById("apply-job").style.left = "unset";
}

function closeApplyJob() {
  document.getElementById("apply-job").style.width = "0%";
  document.getElementById("apply-job").style.left = "100%";
}

//toggling the filter btn
function toggleFilter(iconID) {
  if (document.getElementById(iconID).className == "fa-solid fa-filter") {
    document.getElementById(iconID).className = "fa-solid fa-square-minus";
    document.getElementById("filter").style.display = "inline-block";
  } else {
    document.getElementById(iconID).className = "fa-solid fa-filter";
    document.getElementById("filter").style.display = "none";
  }
}

//saving a job (icon)
function saveJobIcon(iconID) {
  if (document.getElementById(iconID).className == "fa-regular fa-bookmark") {
    document.getElementById(iconID).className = "fa-solid fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-color)";
  } else {
    document.getElementById(iconID).className = "fa-regular fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-text-color)";
  }
}

//saving a job (in apply page)
function saveJobBtn(btnID) {
  if (document.getElementById(btnID).innerText == "Save Job") {
    document.getElementById(btnID).innerText = "Job Saved";
  } else {
    document.getElementById(btnID).innerText = "Save Job";
  }
}

//Clearing the filter section
function clear() {
  //document.getElementsById("level") ... = "checked";
}
