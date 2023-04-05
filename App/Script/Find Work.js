//toggling the apply job page
function openApplyJob() {
  document.getElementById("apply-job").style.width = "67%";
  document.getElementById("apply-job").style.left = "unset";
}

function closeApplyJob() {
  document.getElementById("apply-job").style.width = "0%";
  document.getElementById("apply-job").style.left = "100%";
}

//saving a job
function saveJob(iconID) {
  if (document.getElementById(iconID).className == "fa-regular fa-bookmark") {
    document.getElementById(iconID).className = "fa-solid fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-color)";
  } else {
    document.getElementById(iconID).className = "fa-regular fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-text-color)";
  }
}
