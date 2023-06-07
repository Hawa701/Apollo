// const inputs = document.querySelectorAll("input, textarea");
// const edit = document.getElementById('edit-btn');

// // Add event listener to "edit" button
// // edit.addEventListener("click", function() {
// //   if (edit.textContent === "Edit Job") {
// //     // Enable editing
// //     inputs.forEach(input => {
// //       input.removeAttribute("readonly");
// //       input.style.border = "1px solid #577CFF";
// //     });
// //     edit.textContent = "Save";
// //   } else {
// //     edit.textContent = "Edit Job";
// //   }
// // });

// if (edit.textContent === 'Edit') {
//   alert("Edit");
//   inputs.forEach(input => {
//     input.removeAttribute("readonly");
//     input.style.border = "1px solid #577CFF";
//    });
//    edit.textContent = "Save";

// } else if(edit.textContent === 'Save') {
//   // inputs.forEach(input => {
//   //   input.setAttribute("readonly");
//   //   input.style.border = "none";
//   //  });
//   //  edit.textContent = "Edit";
//   alert("Save");
// } else {
//   alert("None");
// }

window.addEventListener('load', () => {
  document.querySelector('#edit-btn').addEventListener('click', openEditJob); 
});

const editJob = document.getElementById("edit");

function openEditJob(e) {
  console.log("Error");
  editJob.style.display = "block";
  e.preventDefault();
}


function exitEdit() {
  editJob.style.display = "none";
}

// function confirmDelete(e) {
//   e.preventDefault();
//   if (confirm("Are you sure you want to delete this job?")) {
//     document.querySelector('input[name="confirmed"]').value = 'true';
//     console.log(document.querySelector('input[name="confirmed"]').value);
//     e.target.form.submit(); // Submit the form if the user clicks "OK"
//   } else {
//     document.querySelector('input[name="confirmed"]').value = '';
//     console.log(document.querySelector('input[name="confirmed"]').value);
//   }
// }