<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS link -->
  <link rel="stylesheet" href="./Style/Header.css" />

  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Document</title>
</head>

<body>
  <header class="header" id="header">
    <div class="logo">
      <a href="#">Apollo</a>
    </div>

    <div class="nav">
      <ul class="links">
        <li><a href="./Find Work.php">Find Work</a></li>
        <li><a href="#">My Job</a></li>
        <li><a href="#">Post a Job</a></li>
        <li><a href="./How it works.php">How it Works</a></li>
      </ul>
    </div>

    <div class="signInnUp">
      <button class="login">Log In</button>
      <button class="signup">Sign Up</button>
    </div>

    <div class="notifProf">
      <div class="notification">
        <a href="#"><i class="fa-regular fa-bell"></i></a>
      </div>
      <div class="profile">
        <a href="#">H</a>
      </div>
    </div>

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
        <li><a href="#">Notification</a></li>

        <span class="page-option">Pages</span>
        <hr />
        <li><a href="./Find Work.php">Find Work</a></li>
        <li><a href="#">My Job</a></li>
        <li><a href="#">Post a Job</a></li>
        <li><a href="./How it works.php">How it Works</a></li>
      </ul>
    </div>
  </header>
</body>

<!-- JS link -->
<script src="./Script/Header.js"></script>

</html>