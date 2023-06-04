<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Style/Login.css?v=1.0" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Login</title>
</head>

<body>
  <div class="container" id="container">
    <div class="left">

      <div class="content">

        <button class="back-btn" id="back-btn"></button>

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

      <div class="log-in">

        <h1>Hello Again!</h1>
        <h2>Log in and Stay Connected</h2>

        <?php if (isset($_GET['error'])) { ?>
          <p class="error"> <?php echo  $_GET['error'];  ?> </p>
        <?php }  ?>
        <form class="log-in-form" action="LoginFormValidate.php" method="Post">


          <input type="text" id="texts" name="emailusername" placeholder="Email or Username  ">

          <div id="pswd" class="passwords">
            <input type="password" id="password" class="visibility" name="passwords" placeholder="Enter your Password">
            <i class="far fa-eye" id="togglePassword"></i>
          </div>

          <div class="remember-forgot" id="remfor">

            <label><input type="checkbox" name="Remember" id="Remember" />
              Remember Me</label>
            <a href="#">Forgot Password?</a>
          </div><!-- remember-forgot end -->
          <button id="loginbtn" name='loginbtn' type='submit'>Log in</button>


        </form> <!-- log-in form end-->

        <h3 id="signup">New to Apollo? <a href="./sign_up.php">Sign Up</a></h3>

      </div> <!-- log-in end -->

    </div> <!-- right end-->
  </div><!-- Container ends -->


  </div>
</body>

</html>
<script src="Script/login.js?v=1.3"></script>