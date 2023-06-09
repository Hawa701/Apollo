<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileId = $query['Profile_ID'];
}

include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// <span class="token" id="current-tokens">10</span>
function getToken($connect, $profileId)
{
  $query = "SELECT profile.token FROM profile 
                WHERE profile.Profile_ID = $profileId";

  $result = mysqli_query($connect, $query);
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<span class='token' id='current-tokens'>{$row['token']}</span>";
  } else {
    echo "<span class='token' id='current-tokens'>Error!</span>";
  }
}

function viewProfile($connect, $profileId)
{
  $query = "SELECT  profile.Firstname, profile.Lastname, profile.Username, profile.Email, profile.token, profile.Experience_Level, profile.PricePerHour, profile.Profession, profile.Country  FROM profile
              WHERE profile.Profile_ID = $profileId";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "
    <div class='view'>
          
    <div class='all-header'>

    </div>

    <div class='view_middle'>
       <div class='profile-view'>
        <div class='flex'>
          <label for='firstname'>First Name:</label>
          <div class='firstname readOnly' id='firstname'> {$row['Firstname']} </div>
        </div>

        <div class='flex'>
          <label for='lastname'>Last Name:</label>
          <div class='lastname readOnly' id='lastname'> {$row['Lastname']} </div>
        </div>

        <div class='flex'>
          <label for='username'>User Name:</label>
          <div class='username readOnly' id='username'> {$row['Username']} </div>
        </div>

        <div class='flex'>
          <label for='email'>Email:</label>
          <div class='email readOnly' id='email'> {$row['Email']} </div>
        </div>

        <div class='flex'>
          <label for='profession'>Profession:</label>
         <div class='profession readOnly' id='profession'> {$row['Profession']} </div>
        </div>

        <div class='flex'>
          <label for='experience'>Experience:</label>
          <div class='experience readOnly' id='experience'> {$row['Experience_Level']} </div>
        </div>

        <div class='flex'>
          <label for='priceperhour'>Priceperhour:</label>
          <div class='priceperhour readOnly' id='priceperhour'> {$row['PricePerHour']} </div>
        </div>

        <div class='flex'>
          <label for='country'>Country:</label>
          <div class='country readOnly' id='country'> {$row['Country']} </div>
        </div>
       </div>

      <div class='payment'>
        <form class='edit-form' method='post'>
          <label for='current-tokens' class='current-tokens'>Current Token: <span>{$row['token']}</span> </label>

          <button class='buy-btn' name='buy-btn'>Buy Token</button>

          <label for='posted-jobs'>View Your Posted Jobs</label>
          <button class='posted-jobs' name='posted-jobs'>Posted Jobs</button>
        </form>

      </div> <!-- payment end -->

    </div>  <!-- view middle end -->

     
</div> <!-- view end -->               
            ";
  } else {
    echo "Error!";
  }
}

function viewUpdatingSection($connect, $profileId) {
  $query = "SELECT  profile.Firstname, profile.Lastname, profile.Username, profile.Email, profile.token, profile.Experience_Level, profile.PricePerHour, profile.Profession, profile.Country  FROM profile
              WHERE profile.Profile_ID = $profileId";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    echo "
        <form class='edit-form' method='post'>
        <div class='update'>
          <div class='all-header'></div>
          <div class='update-middle'>
            <div class='fullname'>
              <div class='fname'>
                <label for='update-firstname'>Update First Name</label>
                <input type='text' name='firstname' id='update-firstname' value='{$row["Firstname"]}'>
              </div>
              <div class='lname'>
                <label for='update-lastname'>Update Last Name</label>
                <input type='text' name='lastname' id='update-lastname' value='{$row["Lastname"]}'>
              </div>
            </div>
            <div class='username'>
              <label for='update-username'>Update User Name</label>
              <input type='text' name='username' id='update-username' value='{$row["Username"]}'>
            </div>
            <div class='email'>
              <label for='update-email'>Update Email</label>
              <input type='text' name='email' id='update-email' value='{$row["Email"]}'>
            </div>
            <div class='more-info'>
              <div class='profession'>
                <label for='update-profession'>Update Profession</label>
                <input type='text' name='profession' id='update-profession' value='{$row["Profession"]}'>
              </div>

              <div class='exp'>
              <label for='update-experience'>Update Experience Level</label>
              <select name='experience' id='update-experience'>
                <option value='beginner'" . ($row['Experience_Level'] == 'beginner' ? ' selected' : '') . ">Beginner</option>
                <option value='intermediate'" . ($row['Experience_Level'] == 'intermediate' ? ' selected' : '') . ">Intermediate</option>
                <option value='expert'" . ($row['Experience_Level'] == 'expert' ? ' selected' : '') . ">Expert</option>
              </select>
             </div>

              <div class='pr_hr'>
                <label for='update-priceperhour'>Update Price Per Hour</label>
                <input type='text' name='priceperhour' id='update-priceperhour' value='{$row["PricePerHour"]}'>
              </div>
            </div>
            <label for='update-country'>Update Your Country</label>
            <select name='country' id='update-country' class='update-country'>
              <option value='Ethiopia' " . ($row['Country'] == 'Ethiopia' ? 'selected' : '') . ">Ethiopia</option>
              <option value='Kenya'" . ($row['Country'] == 'Kenya' ? ' selected' : '') . ">Kenya</option>
              <option value='Eritrea'" . ($row['Country'] == 'Eritrea' ? ' selected' : '') . ">Eritrea</option>
              <option value='Somalia'" . ($row['Country'] == 'Somalia' ? ' selected' : '') . ">Somalia</option>
              <option value='Djibouti'" . ($row['Country'] == 'Djibouti' ? ' selected' : '') . ">Djibouti</option>
              <option value='Sudan'" . ($row['Country'] == 'Sudan' ? ' selected' : '') . ">Sudan</option>
              <option value='South Sudan'" . ($row['Country'] == 'South Sudan' ? ' selected' : '') . ">South Sudan</option>
            </select>
            <div class='save'>
              <button class='save-btn' name='save-btn'>Save</button>
            </div>
          </div>
        </div>
      </form>
    ";
  } else {
    echo "Error!";
  }
}
function updateProfile($connect, $profileId)
{
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
  if (isset($profession) && !empty($profession)) {
    $updates[] = "Profession='$profession'";
  }
  if (isset($country) && !empty($country)) {
    $updates[] = "Country='$country'";
  }

  $query .= implode(', ', $updates);
  $query .= " WHERE profile.Profile_ID = $profileId";

  if (mysqli_query($connect, $query)) {
    echo "<script>
          alert(\"Profile Updated successfully!\");
        </script>";
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
  $url = "Add-tokens.php?Profile_ID=" . urlencode($profileId);
  header('Location:' . $url);
}

// when the user clicks view posted jobs it will go to posted job page

if (isset($_POST['posted-jobs'])) {
  $url = "PostedJobs.php?Profile_ID=" . urlencode($profileId);
  header('Location:' . $url);
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

  <!-- Header css link -->
  <link rel="stylesheet" href="./Style/Header.css" />

  <!-- css link -->
  <link rel="stylesheet" href="./Style/view_profile.css?v=1.7" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>View Profile</title>
</head>

<body>

<div class="wrapper">

    <?php
    include('header.php');
    ?>

<div class="main-container">

<h1>Profile View</h1>

<div class="main-content">

  <div class="sidenav">
    <a href="#">View Profile</a>
    <a href="#">Edit Profile</a>
  </div> 

  <div class="sections">
    <section class="view-section">

      <?php
        viewProfile($connect, $profileId);
      ?>

    </section> <!-- view section end -->

    <section class="update-section">

      <?php
        viewUpdatingSection($connect, $profileId);
      ?>

    </section> <!-- update section end -->

  </div> <!-- sections send -->
  
</div>

</div>

</div> <!-- wrapper end-->

  <!-- js link -->
  <script src="./Script/view_profile.js?v=1.2"></script>
</body>

</html>