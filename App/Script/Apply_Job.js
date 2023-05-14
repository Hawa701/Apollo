const applyBtn = document.getElementById("apply-button");
const saveBtn = document.getElementById("save-button");
const copyBtn = document.getElementById("copy-button");
const message = document.querySelector(".message");

applyBtn.addEventListener("click", applyJobBtn);
function applyJobBtn() {
  if (applyBtn.innerText == "Apply Job") {
    applyBtn.innerText = "Applied";
  } else {
    applyBtn.innerText = "Apply Job";
  }
}

saveBtn.addEventListener("click", saveJobBtn);
function saveJobBtn() {
  if (saveBtn.innerText == "Save Job") {
    saveBtn.innerText = "Saved";
  } else {
    saveBtn.innerText = "Save Job";
  }
}

copyBtn.addEventListener("click", copyLink);
function copyLink() {
  const url = window.location.href;
  const newUrl = url.replace(/profileId=\d+/, "profileId=-1");
  navigator.clipboard
    .writeText(newUrl)
    .then(() => {
      console.log(newUrl);
    })
    .catch((err) => {
      console.error("Failed to copy URL: ", err);
    });
}
