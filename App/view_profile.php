<?php

session_start();

// Check if the user is logged in
if (isset($_SESSION['Profile_ID']) && $_SESSION['Profile_ID']) {
  $profileId = $_SESSION['Profile_ID'];
} else {
  // User is not logged in, redirect to login page
  header('Location: Login.php');
// Exit the script to prevent further execution
  exit();
}

include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// <span class="token" id="current-tokens">10</span>
function getToken($connect, $profileId) {
      $query = "SELECT profile.token FROM profile 
                WHERE profile.Profile_ID = $profileId";

      $result = mysqli_query($connect, $query);
      if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<span class='token' id='current-tokens'>{$row['token']}</span>"; 
      } else{
        echo "<span class='token' id='current-tokens'>Error!</span>"; 
      }

}



 function viewProfile($connect, $profileId) {
    $query = "SELECT  profile.Firstname, profile.Lastname, profile.Username, profile.Email, profile.Experience_Level, profile.PricePerHour, profile.Profession, profile.Country  FROM profile
              WHERE profile.Profile_ID = $profileId";

         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "
                <h3>View Profile</h3>

                <label for='firstname'>First Name</label>
                <div class='firstname readOnly' id='firstname'> {$row['Firstname']} </div>

                <label for='lastname'>Last Name</label>
                <div class='lastname readOnly' id='lastname'> {$row['Lastname']} </div>

                <label for='username'>User Name</label>
                <div class='username readOnly' id='username'> {$row['Username']} </div>

                <label for='email'>Email</label>
                <div class='email readOnly' id='email'> {$row['Email']} </div>

                <label for='profession'>Profession</label>
                <div class='profession readOnly' id='profession'> {$row['Profession']} </div>

                <label for='experience'>Experience</label>
                <div class='experience readOnly' id='experience'> {$row['Experience_Level']} </div>

                <label for='priceperhour'>Priceperhour</label>
                <div class='priceperhour readOnly' id='priceperhour'> {$row['PricePerHour']} </div>

                <label for='country'>Country</label>
                <div class='country readOnly' id='country'> {$row['Country']} </div>               
            ";
         } else {
            echo "Error!";
         }          
 }

 function updateProfile($connect, $profileId) {
    // Get input values
    $firstname = $_POST['firstname'] ?? null; 
    $lastname = $_POST['lastname'] ?? null; 
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $experience = $_POST['experience'] ?? null;
    $priceperhour = $_POST['priceperhour'] ?? null;
    $profession = $_POST['profession'] ?? null;
    $country = $_POST['country'] ?? null;

    // Build query string
    $query = "UPDATE profile SET ";
    $updates = [];

    if (isset($firstname) && !empty($firstname)) {
        $updates[] = "Firstname='$firstname'";
    }
    if (isset($lastname) && !empty($lastname)) {
        $updates[] = "Lastname='$lastname'"; 
    }
    if (isset($username) && !empty($username)) {
        $updates[] = "Username='$username'"; 
    }
    if (isset($email) && !empty($email)) {
        $updates[] = "Email='$email'"; 
    }
    if (isset($experience) && !empty($experience)) {
        $updates[] = "Experience_Level='$experience'"; 
    }
    if (isset($priceperhour) && !empty($priceperhour)) {
        $updates[] = "PricePerHour='$priceperhour'"; 
    }
    if (isset($profession) &&!empty($profession)) {
        $updates[] = "Profession='$profession'"; 
    }
    if (isset($country) && !empty($country)) {
        $updates[] = "Country='$country'"; 
    }

    $query .= implode(', ', $updates);
    $query .= " WHERE profile.Profile_ID = $profileId";

    if (mysqli_query($connect, $query)) {
        echo "Profile updated successfully";
   } else {
        echo "Error updating profile: " . mysqli_error($connect);
    } 
}

 // calling the updateProfile when a user cliks save 
 if (isset($_POST['save-btn'])) {
    updateProfile($connect, $profileId);
  }


//   when the user cliks buy tokn it will go to the add token page

if (isset($_POST['buy-btn'])) {
    header('Location: Add-tokens.php');
}

// when the user clicks view posted jobs it will go to posted job page

if (isset($_POST['posted-jobs'])) {
    header('Location: PostedJobs.php');
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
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />


    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Header css link -->
    <link rel="stylesheet" href="./Style/Header.css" /> 

    <!-- css link -->
    <link rel="stylesheet" href="./Style/view_profile.css?v=1.0" />
    <!-- icon link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>View Profile</title>
  </head>
  <body>

    <div class="wrapper">

       <!-- header design -->
       <header class="header" id="header">
        <div class="logo">
            <a href="#">Apollo</a>
        </div>

        <div class="nav">
            <ul class="links">
                <li><a href="#">Find Work</a></li>
                <li><a href="#">My Job</a></li>
                <li><a href="#">Post a Job</a></li>
                <li><a href="#">How it Works</a></li>
                <!-- <li><a href="#">Message</a></li> -->
            </ul>
            <!-- <div class="notification">
                <a href="#"><i class="fa-regular fa-bell"></i></a>
            </div> -->
        </div>

        <div class="signInnUp">
            <button class="login">Log In</button>
            <button class="signup">Sign Up</button>
        </div>
        <!-- 
        <div class="profile">
            <a href="#"> H </a>
        </div> -->
    </header> <!-- header end -->


    <!-- Section design -->
    <section class="section">

      <div class="profile-wrap">
        <h1>Edit Profile</h1>

        <form class="edit-form" method="post">

        <div class='left-side'>

                <?php
                viewProfile($connect, $profileId);
                ?>

        </div> <!-- left side end -->

          <div class="middle-side">

                <h3>Update Profile</h3>
                <div class="fullname">
                    <div class="fname">
                        <label for="update-firstname">Update First Name</label>
                        <input type="text" name="firstname" id="update-firstname">
                    </div>

                    <div class="lname">
                        <label for="update-lastname">Update Last Name</label>
                        <input type="text" name="lastname" id="update-lastname">
                    </div>
                </div>

                <label for="update-username">Update User Name</label>
                <input type="text" name="username" id="update-username">

                <label for="update-email">Update Email</label>
                <input type="text" name="email" id="update-email">

                <label for="update-profession">Update Profession</label>
                <input type="text" name="profession" id="update-profession"> 

                <label for="update-experience">Update Experience Level</label>
                <select name="experience" id="update-experience">
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="expert">Expert</option>
                </select>

                <label for="update-priceperhour">Update Price Per Hour</label>
                <input type="text" name="priceperhour" id="update-priceperhour">

                <label for="update-country">Update Your Country</label>
                <select name="country" id="update-country" class="update-country">
                    <option value="Ethiopia" selected>Ethiopia</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Somalia">Somalia</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Sudan">Sudan</option>
                <option value="South Sudan">South Sudan</option>
                </select>

                <div class="save">
                    <button class="save-btn" name="save-btn">Save</button>
                </div>
          </div> <!-- middle side end -->

          <div class="right-side">
                <label for="current-tokens" class="current-tokens">Current Token: 
                    <?php
                    getToken($connect, $profileId);
                    ?>
                </label>
            
                <button class="buy-btn" name="buy-btn">Buy Token</button>
    
                <label for="posted-jobs">View Your Posted Jobs</label>
                <button class="posted-jobs" name="posted-jobs">Posted Jobs</button>
    
          </div> <!-- right side end -->

        </form> <!-- form end -->

      </div> <!-- profile wrap end -->

    </section> <!-- section end -->

    </div> <!-- wrapper end -->
  
     <!-- js link -->
     <script src="./Script/view_profile.js"></script>
</body>
</html>