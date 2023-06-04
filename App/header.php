<?php
session_start();
if (isset($_SESSION['Profile_ID'])) {
  $profile_ID = $_SESSION['Profile_ID'];
} else {
  $profile_ID = -1;
}

function getFirstLetter()
{
  if (isset($_SESSION['Username'])) {
    echo strtoupper(substr($_SESSION['Username'], 0, 1));
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS link -->
  <link rel="stylesheet" href="./Style/Header.css?v=1.9" />

  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Document</title>
</head>

<body>
  <header class="header" id="header">
    <div class="logo">
      <a href="./index.php">Apollo</a>
    </div>

    <!-- drop down -->
    <div class="drop-down" id="drop-down">
      <ul>
        <li><a href="./myJobs.php?Profile_ID=<?php echo $profile_ID ?>">Applied Jobs</a></li>
        <li><a href="./SavedJobs.php?Profile_ID=<?php echo $profile_ID ?>">Saved Jobs</a></li>
        <li><a href="./Proposal.php?Profile_ID=<?php echo $profile_ID ?>">My Proposals</a></li>
      </ul>
    </div>

    <?php
    if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
      // Links
      echo "<div class=\"nav\">
      <ul class=\"links\">
        <li><a href=\"./Find Work.php?Profile_ID=$profile_ID\">Find Work</a></li>
        <li><a id=\"my-job\">My Job</a></li>
        <li><a href=\"./Postajob.php?Profile_ID=$profile_ID\">Post a Job</a>
</li>
        <li><a href=\"./How it works.php\">How it Works</a></li>
      </ul>
    </div>";

      // Profile
      echo "<div class=\"notifProf\" id=\"notifProf\">
        <div class=\"notification\" id=\"notification\">
          <a href=\"#\"><i class=\"fa-regular fa-bell\"></i></i></a>
        </div>
        <div class=\"profile\" id=\"profile\">
          <a href=\"#\">";
      getFirstLetter();
      echo "</a>
        </div>
      </div>";

      // drop down menu (for mobile)
      echo "<div class=\"menu\" id=\"menu\">
      <ul class=\"menu-links\">
        <span class=\"user-option\">User</span>
        <hr />
        <li>
          <a href=\"#\">Profile</a>
        </li>
        <li><a href=\"#\">Messages</a></li>

        <span class=\"page-option\">Pages</span>
        <hr />
        <li><a href=\"./Find Work.php?Profile_ID=$profile_ID\">Find Work</a></li>
        <li><a id=\"my-job2\">My Job</a></li>
        <li><a href=\"\">Post a Job</a></li>
        <li><a href=\"./How it works.php\">How it Works</a></li>
        <span class=\"page-option\">Log Out</span>
        <hr />
        <li><a href=\"./Logout.php\">Log Out</a></li>
      </ul>
    </div>";
    } else {
      // Links
      echo "<div class=\"nav\">
      <ul class=\"links\">
        <li><a href=\"./Login.php\">Find Work</a></li>
        <li><a id=\"my-job\" href=\"./Login.php\">My Job</a></li>
        <li><a href=\"./Login.php\">Post a Job</a></li>
        <li><a href=\"./Login.php\">How it Works</a></li>
      </ul>
    </div>";
      // buttons
      echo "<div class=\"signInnUp\" id=\"signInnUp\">
      <button class=\"login\" id=\"login\">Log In</button>
      <button class=\"signup\" id=\"signup\">Sign Up</button>
    </div>";
      //drop down (mobile)
      echo "<div class=\"menu\" id=\"menu\" style=\"height:3rem\">
      <ul class=\"menu-links\">
        <li>
          <a href=\"./Login.php\">Login</a>
        </li>
        <li><a href=\"./sign_up.php\">Sign Up</a></li>
      </ul>
    </div>";
    }
    ?>

    <!-- drop down 2 -->
    <div class="drop-down2" id="drop-down2">
      <ul>
        <li><a href="./view_profile.php?Profile_ID=<?php echo $profile_ID ?>">Profile</a></li>
        <li><a href="./Logout.php">Log Out</a></li>
      </ul>
    </div>

    <!-- menu -->
    <div class="menu-icon" id="menu-icon">
      <i class="fa-solid fa-bars"></i>
    </div>




    <!-- sub-menu -->
    <div class="sub-menu" id="sub-menu">
      <ul>
        <li><a href="./myJobs.php?Profile_ID=<?php echo $profile_ID ?>">Applied Jobs</a></li>
        <li><a href="./saved_jobs.php">Saved Jobs</a></li>
        <li><a href="./Proposal.php?Profile_ID=<?php echo $profile_ID ?>">Proposals</a></li>
      </ul>
    </div>
  </header>
</body>

<!-- JS link -->
<script src="./Script/Header.js?v=1.5"></script>

</html>