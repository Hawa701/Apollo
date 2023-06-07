<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);

if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileID = $query['Profile_ID'];
  $jobID = $query['Job_ID']; 
} else {
  $profileID = -1;
  $jobID = -1;
}

// echo "profile $profileID";
// echo "job $jobID";

include('Connect.php');
include('job_status_functions.php');

$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['hire'])) {
  $profileID = $_POST['Reciver_ID'];
  hire($connect, $profileID, $jobID); 
}

// when the message buttons is cliked the send and the resiver id is sent
if(isset($_GET['message'])) {
  $receiverId = $query['Reciver_ID'];
  header("Location: http://localhost/App/message.php?Sender_ID=$profileID&Reciver_ID=$receiverId");
}

if(isset($_POST['delete-btn'])) {

  deleteJob($connect, $jobID);
  header('Location: index.php');
}

// updating and validations
if (isset($_POST['save'])) {
  editJob($connect, $jobID);
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
  <link rel="stylesheet" href="./Style/Header.css?v=1.0" />

  <!-- css link -->
  <link rel="stylesheet" href="./Style/job_status.css?v=1.15" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Job Status</title>
</head>

<body>

  <?php
  include('header.php');
  ?>

  <div class="wrapper">

    <!-- job status design  -->

    <div class="job-status" id="job-status">
      <div class="title">
        <h1>Job Status</h1>
      </div>

      <div class="main-content">

        <!-- left side design -->
        <div class="left-container" id="left-container">

    <form method="post" class="job-form">
          <div class="job-description">
            <div class="job-title">
                <?php
                getJobTitle($connect, $jobID);
                ?>
            </div>
            <p>
              <?php
              getJobDescription($connect, $jobID);
              ?>
            </p>
          </div> <!-- job description end -->

          <div class="job-info">
            <h3>Additional Information</h3>

            <span>
              <?php
              getJobInfo($connect, $jobID);
              ?>
            </span>
          </div> <!-- job info end -->

          <div class="edit-delete">
                <div class="edit">
                  <button name="edit-btn" class="edit-btn" id="edit-btn">Edit</button>      
                </div>
       
                <div class="delete">
                  <button name="delete-btn" class="delete-btn">Delete Job</button>
                </div>  
            </div> <!-- edit delete end -->
    </form> <!-- form end -->

        </div> <!-- left container end -->


        <div class="applicants">
          <div class="applicants-header">
            <div class="navigation">
              <ul class="links">
                <li><a href="#">All Proposals (<span class="noOf-proposals">
                      <?php
                      noOfProfiles($connect, $jobID);
                      ?>
                    </span>)</a></li>
              </ul>
            </div>
          </div> <!-- applicants header end -->

          <div class="searchSort">
            <!-- HTML code with search input and image -->
            <div class="search">
            <form method="POST" class="search">
                <input type="text" placeholder="search for freelancers" name="search">
                <div class="search-img"><button type="submit" name="submit" class="submit-btn"><img width="30" height="32" src="https://img.icons8.com/ios-filled/25/22C3E6/google-web-search.png" alt="google-web-search" /></button></div>
            </form>
            </div>

            <!-- <div class="sort">
                  <label for="sortBy">Sort: </label>
                    <select name="sort" id="sortBy">
                       <option value="best-match">Best match</option>
                       <option value="recent">Recent</option>
                    </select>
                  </div> --> <!-- sort end -->
          </div> <!-- serach sort end -->


          <div class="profile-wrapper">

            <?php

              if (isset($_POST['submit'])) {
                 search($connect, $jobID);
              } else {
                addPerson($connect, $jobID, $profileID);
              }

            ?>

          </div> <!-- Profile wrapper end -->

        </div> <!-- applicants end -->
      </div> <!-- main content end -->
    </div> <!-- job status end -->


 <!-- Edit form  -->
<div class="edit-form" id="edit">

          <div class="edit_header">
            <h1>Edit Job</h1>
            <a href="#" class="exit" id="exit" name="exit" onclick="exitEdit()"><img width="25" height="25" src="https://img.icons8.com/ios/25/22C3E6/close-window--v1.png" alt="close-window--v1"/></a>
          </div>

          <p class="errors">  </p>

    <form action="" method="post" class="edit-job">

      <div class="left">
        <label for="job-title">Job Title</label>
        <input type='text' name='title' class='job-title' id="job-title" value='<?php getJobTitleOnly($connect,$jobID) ?>'> 

        <label for="job-position">Job Position</label>
        <input type='text' name='position' class='job-position' id="job-position" value='<?php getJobPosition($connect,$jobID) ?>'> 

        <label for="job-description">Job Description</label>
        <textarea name='decscription' class='job-description' id="job-description"><?php getJobDescriptionOnly($connect,$jobID) ?> </textarea>

        <label for="payment">Pyament</label>
        <input type='text' name='payment' class='payment' id="payment" value='<?php getPriceOnly($connect,$jobID) ?>'> 

        <label for="experience">Experience</label>
        <select name="job-experience" id="experience">
          <option value="entry-Level">Entry Level</option>
          <option value="intermediate">Intermediate</option>
          <option value="expert">expert</option>
        </select>

        <label for="token">Token To Apply</label>
        <input type='text' name='tokens' class='tokens' value='<?php getToken($connect, $jobID) ?>'>

        <label for="employment">Employment</label>
        <select name="job-Employment" id="employment">
          <option value="contract">Contract</option>
          <option value="full-time">Full Time</option>
        </select>

        <label for="Est">Estimated Time</label>
        <input type='date' name='estimateddate' class='est' value='<?php getEstimatedtime($connect, $jobID) ?>'>
      </div>

      <div class="right">
          <div class="status">
            <label for="status">Job Status</label>
            <select name="status" id="status">
              <option value="interviewing">Interviewing</option>
              <option value="hired">Hired</option>
            </select>
          </div>

          <div class="btn">
            <button class='save' name='save'>Save</button> 
          </div> 
      </div>
  

</form> <!-- edit form end -->

  </div> <!-- wrapper end -->

  <script src='./Script/job_status.js?v1.3'></script>
</body>

</html>