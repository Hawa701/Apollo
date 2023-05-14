const applyJob = document.getElementById("apply-job"); //for toggling apply job
const filterIcon = document.getElementById("filter"); //for filter button
const clearBtn = document.getElementById("clear"); //for clear button
const checkBoxes = document.querySelectorAll("[type=checkbox]"); //for targetting each checkbox
const valHolder = document.getElementById("valHolder"); //for clear button
const rangeInput = document.querySelectorAll(".range-input input"); //targets the range
const priceInput = document.querySelectorAll(".price-input .field .value"); //targets the price input fields
const progress = document.querySelector(".slider .progress"); //targets the pay progress bar (the blue part)
const headerBtn = document.querySelector(".headerBtn");

headerBtn.addEventListener("click", openApplyJob("68%"));
function openApplyJob(wid) {
  applyJob.style.display = "block";
  applyJob.style.width = wid;
  applyJob.style.left = "unset";
}

function closeApplyJob() {
  applyJob.style.display = "none";
  applyJob.style.left = "100%";
  applyJob.style.width = "0%";
}

//^ Changes bookmark icon when clicked
function saveJobIcon(iconID) {
  if (document.getElementById(iconID).className == "fa-regular fa-bookmark") {
    document.getElementById(iconID).className = "fa-solid fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-color)";
  } else {
    document.getElementById(iconID).className = "fa-regular fa-bookmark";
    document.getElementById(iconID).style.color = "var(--main-text-color)";
  }
}

//^ Changes save buttons text when clicked
function saveJobBtn(btnID) {
  if (document.getElementById(btnID).innerText == "Save Job") {
    document.getElementById(btnID).innerText = "Saved";
  } else {
    document.getElementById(btnID).innerText = "Save Job";
  }
}

//^ Changes filter buttons icon when clicked
function toggleFilters(iconID) {
  if (document.getElementById(iconID).className == "fa-solid fa-filter") {
    document.getElementById(iconID).className = "fa-solid fa-square-minus";
    filterIcon.style.display = "inline-block";
  } else {
    document.getElementById(iconID).className = "fa-solid fa-filter";
    filterIcon.style.display = "none";
  }
}

//^ Everything that happens to the double sided range
let priceGap = 4000;
rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    //getting 2 range values and parsing them to int
    let minVal = parseInt(rangeInput[0].value);
    let maxVal = parseInt(rangeInput[1].value);

    //calculating gap
    if (maxVal - minVal < priceGap) {
      //if active slider is range-min
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      }
      //if active slider is range-max
      else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      //color in between and input setting
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

//^ Clears the selected filters when clicked
clearBtn.addEventListener("click", clearFilters);
function clearFilters() {
  for (let i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].type == "checkbox") {
      checkBoxes[i].checked = false;
    }
  }
}
