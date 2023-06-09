  // select the sidenav links
  const detailLink = document.querySelector(".sidenav a:nth-child(1)");
  const profileLink = document.querySelector(".sidenav a:nth-child(2)");
  const paymentLink = document.querySelector(".sidenav a:nth-child(3)");

  // select the view and update sections
  const viewSection = document.querySelector(".view-section");
  const updateSection = document.querySelector(".update-section");
  const paymentSection = document.querySelector(".payment-section");

  // add click event listeners to the sidenav links
  detailLink.addEventListener("click", () => {
    viewSection.style.display = "block";
    updateSection.style.display = "none";
    paymentSection.style.display = "none";
  });

  profileLink.addEventListener("click", () => {
    viewSection.style.display = "none";
    updateSection.style.display = "block";
    paymentSection.style.display = "none";
  });

  paymentLink.addEventListener("click", () => {
    viewSection.style.display = "none";
    updateSection.style.display = "none";
    paymentSection.style.display = "block";
  });


  window.onload = function() {
    document.querySelector('.view-section').style.display = 'block';
    document.querySelector('.update-section').style.display = 'none';
    document.querySelector('.payment-section').style.display = 'none';
  }



