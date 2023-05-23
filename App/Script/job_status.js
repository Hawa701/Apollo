function openJobStatus() {
    document.getElementById("job-status").style.width = "65%";
    document.getElementById("job-status").style.left = "350px";
    document.getElementById("main-section").style.backgroundColor = "rgba(0, 0, 0, 0.5)";
  }
  
  function closeJobStatus() {
    document.getElementById("job-status").style.width = "0%";
    document.getElementById("job-status").style.left = "100%";
    document.getElementById("main-section").style.backgroundColor = "#fff";
  }