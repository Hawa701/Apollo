<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileID = $query['Profile_ID'];
} else {
  $profileID = 11;
}


include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// $profileId = $query['Profile_ID'] ?? 1;  // Set default of 11 if missing

// pagination 
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; //get the current page number from the URL parameter, or default to 1
$totalRows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saved_jobs")); //Count the total number of rows in the saved_jobs table
$totalPages = ceil($totalRows / 3); //Calculate the total number of pages needed to display all rows
$offset = ($currentPage - 1) * 3; //the LIMIT offset needed for the MySQL query based on the current page number
$query = "SELECT * FROM saved_jobs LIMIT 3 OFFSET $offset"; //Construct the query with LIMIT and OFFSET



function getJobTitle($connect, $profile_ID)
{
  $query = "SELECT job.Job_Title
            FROM job
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<h3 onclick='openApplyJob()'>{$row['Job_Title']}</h3>";
  } else {
    // echo "<style> .first-job { display: none; } </style>";
    echo "<h3> No Job Saved</h3>";
  }
}


function getJobInfo($connect, $profile_ID)
{
  $query = "SELECT job.Payment, job.Experience, job.Date, job.Token, job.Estimated_Time FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<span> Payment: 
                       <span class='content'>{$row['Payment']}</span> - <span class='content'>{$row['Experience']}</span> - Est. Time: 
                       <span class='content'>{$row['Estimated_Time']}</span> - Posted On - 
                       <span class='content'>{$row['Date']}</span>
                       </span>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getJobDescription($connect, $profile_ID)
{
  $query = "SELECT job.Description FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p>{$row['Description']}</p>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

// gets proposals and tokens
function getJobTime($connect, $profile_ID)
{
  $query = "SELECT job.Proposals, job.Token FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<div class='proposal'>Proposal: <span>Less than <span>{$row['Proposals']}</span></span></div>
                        <div class='tokens'>Tokens To Apply: <span>{$row['Token']}</span></div>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}


function postedOn($connect, $profile_ID)
{
  $query = "SELECT job.Date FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p>Posted On - <span>{$row['Date']}</span></p>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getPrice($connect, $profile_ID)
{
  $query = "SELECT job.Payment  FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<h4>\${$row['Payment']}</h4>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getExperience($connect, $profile_ID)
{
  $query = "SELECT job.Experience FROM job 
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<h4>{$row['Experience']}</h4>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getTags($jobId) {
    $conn = new Connect;
    $connect = $conn->getConnection();
    $sql = "CALL `getTags`($jobId)";
    $result = $connect->query($sql);

  if ($result->num_rows > 0) {
    echo "<div id=\"tags\">";
    while ($row = $result->fetch_assoc()) {
      $tagName = $row['Tag_Name'];
      echo "<span class=\"tag\">" . $tagName . "</span>";
    }
    echo "</div>";
  }
}

function loadSavedJobs($profile_ID)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT job.*
            FROM job
            INNER JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID
            WHERE saved_jobs.Profile_ID = $profile_ID";

  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $jobId = $row['Job_ID'];
      $jobTitle = $row['Job_Title'];
      $jobDescription = $row['Description'];
      $payment = $row['Payment'];
      $experience = $row['Experience'];
      $estTime = $row['Estimated_Time'];
      $date = $row['Date'];
      $proposals = $row['Proposals'];
      $token = $row['Token'];

      echo "
      <div class='first-job'>

      <div class='job-title'>
        ".getJobTitle($connect, $profile_ID)."

      <form class=\"title-block\" method=\"post\">
        <button class=\"deleteBtn\" name=\"deleteBtn\" value=\"$jobId\">
        <img src='https://img.icons8.com/small/25/22C3E6/filled-trash.png'/> 
        </button>
      </form>
    
      <div class='job-info'>
        ".getJobInfo($connect, $profile_ID)."
      </div>
    
      <div class='job-description' onclick='openApplyJob()'>
        ".getJobDescription($connect, $profile_ID)."
      </div>
    
      
    
      <div class='time'>
        ".getJobTime($connect, $profile_ID)."
      </div>
    
      <hr />
    
    </div> <!-- first job end -->

           ";
    }
  } else {
    echo "<p> Sorry, There are no Saved Jobs!.";
  }
} // ".getTags($jobId)."


function deleteJob($profile_ID, $jobID) {
    $conn = new Connect;
    $connect = $conn->getConnection();
    
    $deleteQuery = "DELETE FROM saved_jobs
                    WHERE Job_ID = $jobID 
                    AND Profile_ID = $profile_ID";
    mysqli_query($connect, $deleteQuery);
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

  <!-- css link -->
  <link rel="stylesheet" href="./Style/saved_jobs.css" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Saved Jobes</title>
</head>

<body>
  <?php
  include('header.php');
  ?>
  <div class="wrapper">
    <!-- Section design -->
    <section class="section">

      <div class="job-container">

        <div class="job-header">
          <h1 onclick="">Saved Jobs</h1>
        </div>

        <div class="jobs">

          <?php
               loadSavedJobs($profile_ID);

               if (isset($_POST['deleteBtn'])) {
                $jobID = $_POST['deleteBtn'];
                deleteJob($profileID, $jobID);
              }
          ?>

        </div> <!-- jobs end -->


        <!-- Generate the page links by looping from 1 to $totalPages -->
        <div class="num-nav">
          <ol class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <li><a href="?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php } ?>
          </ol>
        </div>

      </div> <!-- job container end -->

      <!-- apply jobs design -->
      <div class="apply-job" id="apply-job">
        <div class="top">
          <i class="fa-solid fa-angle-right" onclick="closeApplyJob()"></i>
        </div>

        <div class="all-job-information">
          <div class="info one">
            <h3>Job 1</h3>
            <h4>
              <?php
              getJobTitle($connect, $profile_ID);
              ?>
            </h4>
            <?php
            postedOn($connect, $profile_ID);
            ?>
          </div>
          <div class="info two">
            <p>
              <?php
              getJobDescription($connect, $profile_ID);
              ?>
            </p>

          </div>
          <div class="info three">
            <button class="apply-btn">Apply Now</button>
            <button class="delete-btn">Delete Job</button>
          </div>
          <div class="info four">
            <div class="price">
              <?php
              getPrice($connect, $profile_ID);
              ?>
              <span>Fixed Price</span>
            </div> </br>
            <div class="ex-level">
              <?php
              getExperience($connect, $profile_ID);
              ?>
            </div>

    </section> <!-- section end-->

  </div> <!-- wrapper end-->


  <!-- js link -->
  <script src="./Script/saved_jobs.js"></script>
  <script src="./Script/Find Work.js"></script>
</body>

</html>