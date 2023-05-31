<?php
include('Connect.php');
$conn = new Connect;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Validate form data
  if (isset($_POST['fname'])) {
    $first_name = htmlspecialchars($_POST['fname']);
  } else {
    echo "First name is required.";
    exit();
  }

  if (isset($_POST['lname'])) {
    $last_name = htmlspecialchars($_POST['lname']);
  } else {
    echo "Last name is required.";
    exit();
  }

  if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
  } else {
    echo "Username is required.";
    exit();
  }

  if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
      exit();
    }
  } else {
    echo "Email is required.";
    exit();
  }

  if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
  } else {
    echo "Password is required.";
    exit();
  }

  if (isset($_POST['country'])) {
    $country = htmlspecialchars($_POST['country']);
  }

  // Hash the password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $conn = new Connect;
  $connect = $conn->getConnection();

  // Check for duplicate entries
  $query = $connect->prepare("SELECT * FROM profile WHERE Email = ? OR Username = ?");
  $query->bind_param("ss", $email, $username);
  $query->execute();
  $result = $query->get_result();


  if ($result->num_rows == 0) {
    // Insert data into database
    $query = $connect->prepare("INSERT INTO profile(Firstname, Lastname, Username, Email, Password, Country) VALUES(?,?,?,?,?,?)");
    $query->bind_param("ssssss", $first_name, $last_name, $username, $email, $hashed_password, $country);
    $query->execute();
    $query->close();
    $connect->close();
    header('Location:./Login.php');
  } else {
    $error = "Email or username already exists.";
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />


  <!-- box icons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- css link -->
  <link rel="stylesheet" href="./Style/Sign_Up.css?v=1.0" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Sign Up</title>
</head>

<body>

  <div class="container" id="container">

    <div class="left">

      <div class="content">

        <button class="back-btn" id="back-btn"><img src="https://img.icons8.com/ios-filled/25/FFFFFF/back.png" /> </button>

        <div class="logo-image">
          <img src="image/signin-image.png" alt="" class="logo">
          <div class="shadow"></div>
        </div> <!-- logo image end -->

        <div class="text-content">

          <h2>One Small step for your Career,</h2>
          <h2>one giant leap for your Life</h2>
          <h4>Create the balance that you've always Wanted</h4>

        </div> <!-- text content end -->

      </div> <!-- content end -->
      `
    </div> <!-- left end-->


    <div class="right">

      <div class="sign-up">

        <h1>Sign Up</h1>
        <h2>Sign up to find work you love</h2>

        <form class="sign-up-form" onsubmit="return validateForm()" method="post">

          <div class="name">

            <input type="text" id="fname" name="fname" placeholder="First Name">

            <input type="text" id="lname" name="lname" placeholder="Last Name">
          </div> <!-- name end-->

          <div class="nameAlert">
            <div id="fnameAlert" class="alert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> First name required</div>
            <div class="alert" id="lnameAlert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> Last name required</div>
          </div>

          <input type="username" id="username" name="username" placeholder="User-Name">
          <div id="usernameAlert" class="alert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> User name required</div>

          <input type="email" id="email" name="email" placeholder="Email">
          <div class="alert" id="emailAlert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> email required</div>

          <div id="pswd" class="passwords">
            <input type="password" id="password" class="visibility" name="password" placeholder="Password">
            <i class="far fa-eye" id="togglePassword1"></i>
          </div>
          <div class="alert" id="passwordAlert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> Password required</div>

          <div id="confirm-pswd" class="passwords">
            <input type="password" id="confirm-password" class="visibility" name="confirm-password" placeholder="Confirm Password">
            <i class="far fa-eye" id="togglePassword2"></i>
          </div>
          <div class="alert" id="confirm-passwordAlert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> Confirm Password required</div>

          <select name="country" id="country" class="country">
            <option value="Ethiopia" selected>Ethiopia</option>
            <option value="Kenya">Kenya</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Somalia">Somalia</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Sudan">Sudan</option>
            <option value="South Sudan">South Sudan</option>
          </select>

          <div class="privacy-policy">
            <input type="checkbox" name="privacy-policy" id="privacy-policy">
            <p>Yes, i understand and agree to the <em>Appollo Terms or Service</em>, including the <em>user Agreement<br> and Privacy Policy</em></p>
          </div>
          <div class="alert" id="privacy-policyAlert"><img src="https://img.icons8.com/material-sharp/15/FA5252/box-important--v1.png" /> Please accept the Apollo Terms of Service before continuing</div>

          <?php
          if ($error != null) {
            echo "<div>{$error}</div>";
          }
          ?>

          <button type="submit">Sign Up</button>

        </form> <!-- sign up form end-->

        <h3 id="login">Already have an account? <a href="./Login.php">Log In</a></h3>

      </div> <!-- sign up end -->

    </div> <!-- right end-->

  </div> <!-- container end-->

  <script src="./Script/sign_up.js?v=1.1"></script>
</body>

</html>