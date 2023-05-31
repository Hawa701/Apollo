<?php
session_start();
if (isset($_SESSION['Profile_ID'])) {
  $profile_ID = $_SESSION['Profile_ID'];
}
if (isset($_SESSION['logged-in'])) {
  echo "<script>
          hideButtons();
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS link -->
  <link rel="stylesheet" href="./Style/Header.css?v=1.2" />

  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Document</title>
</head>

<body>
  <header class="header" id="header">
    <div class="logo">
      <a href="./index.php">Apollo</a>
    </div>

    <div class="nav">
      <ul class="links">
        <li><a href="./Find Work.php?Profile_ID=<?php echo $profile_ID ?>">Find Work</a></li>
        <li><a id="my-job">My Job</a></li>
        <li><a href="#">Post a Job</a></li>
        <li><a href="./How it works.php">How it Works</a></li>
      </ul>
    </div>

    <!-- drop down -->
    <div class="drop-down" id="drop-down">
      <ul>
        <li><a href="./myJobs.php?Profile_ID=<?php echo $profile_ID ?>">Applied Jobs</a></li>
        <li><a href="./saved_jobs.php">Saved Jobs</a></li>
      </ul>
    </div>

    <div class=" signInnUp" id="signInnUp">
      <button class=" login" id="login">Log In</button>
      <button class="signup" id="signup">Sign Up</button>
    </div>

    <div class="notifProf" id="notifProf">
      <div class="notification">
        <a href="#"><i class="fa-regular fa-message"></i></i></a>
      </div>
      <div class="profile">
        <a href="#">H</a>
      </div>
    </div>

    <!-- menu -->
    <div class="menu-icon" id="menu-icon">
      <i class="fa-solid fa-bars"></i>
    </div>

    <div class="menu" id="menu">
      <ul class="menu-links">
        <span class="user-option">User</span>
        <hr />
        <li>
          <a href="#">Profile</a>
        </li>
        <li><a href="#">Messages</a></li>

        <span class="page-option">Pages</span>
        <hr />
        <li><a href="./Find Work.php?Profile_ID=<?php echo $profile_ID ?>">Find Work</a></li>
        <li><a id="my-job2">My Job</a></li>
        <li><a href="#">Post a Job</a></li>
        <li><a href="./How it works.php">How it Works</a></li>
        <span class="page-option">Log Out</span>
        <hr />
        <li><a href="./Logout.php">Log Out</a></li>
      </ul>
    </div>

    <!-- sub-menu -->
    <div class="sub-menu" id="sub-menu">
      <ul>
        <li><a href="./myJobs.php?Profile_ID=<?php echo $profile_ID ?>">Applied Jobs</a></li>
        <li><a href="./saved_jobs.php">Saved Jobs</a></li>
      </ul>
    </div>
  </header>
</body>

<!-- JS link -->
<script src="./Script/Header.js?v=1.1"></script>

</html>