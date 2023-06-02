<?php

$profileID = $_REQUEST['profileId'];
$jobID = $_REQUEST['jobId'];

include('Connect.php');
$conn = new Connect;

function getTags($id)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $sql = "CALL `getTags`($id)";
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

function getClientInfo($id)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT * FROM `profile` WHERE Profile_ID = $id";
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $firstname = $row['Firstname'];
      $lastname = $row['Lastname'];
      $email = $row['Email'];

      echo "<div class=\"clientInfo\">
      <h3>About Client</h3>";
      echo "
        <p>Name: $firstname $lastname</p>
        <p>Email: $email</p>
        <p>Portfolio: link</p>";
      echo "</div>";
    }
  }
}

// Checks if the job is applied for by the user and displays button accordingly
function applyBtn_onLoad($userId, $jobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT COUNT(*) FROM applied_jobs WHERE Profile_ID = $userId AND Job_ID = $jobId;";
  $result = mysqli_query($connect, $query);
  $count = $result->fetch_row()[0];

  if ($count > 0) {
    echo "<button id=\"apply-button\" name=\"apply\">Applied</button>";
  } else {
    echo "<button id=\"apply-button\" name=\"apply\">Apply Job</button>";
  }
}

// Check if the job is saved by the user and displays button accordingly
function saveBtn_onLoad($userId, $jobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT COUNT(*) FROM saved_jobs WHERE Profile_ID = $userId AND Job_ID = $jobId;";
  $result = mysqli_query($connect, $query);
  $count = $result->fetch_row()[0];

  if ($count > 0) {
    echo "<button id=\"save-button\" name=\"save\">Saved</button>";
  } else {
    echo "<button id=\"save-button\" name=\"save\">Save Job</button>";
  }
}
function loadJob($profileId, $jobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "CALL `getJobInfo`($jobId);";
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $jobId = $row['Job_ID'];
      $jobTitle = $row['Job_Title'];
      $jobPosition = $row['Job_Position'];
      $date = $row['Date'];
      $jobDescription = $row['Description'];
      $payment = $row['Payment'];
      $experience = $row['Experience'];
      $employment = $row['Employment'];
      $proposals = $row['Proposals'];
      $token = $row['Token'];
      $clientId = $row['Profile_ID'];
      // global $status;
      // $status = $row['Status'];
    }
  }

  echo "<script>
      const t = document.head.lastElementChild;
      t.textContent = \"$jobTitle\"
    </script>";
  echo "<!-- //! Top -->
    <div class=\"top\">
      <!-- title -->
      <h1>$jobTitle</h1>
      <h2>$jobPosition</h2>
      <p>$date</p>
    </div>

    <hr />

    <!-- ! Middle -->
    <div class=\"middle\">
      <!-- job description -->
      <div class=\"description\">
        <p>$jobDescription</p>

        <!-- skills and expertise -->
        <div class=\"skills\">
          <h3>Skills and Expertise</h3>";

  getTags($jobId);

  echo "
        </div>
      </div>

      <!-- button -->
      <form class=\"btn_form\" method=\"post\">
      ";

  applyBtn_onLoad($profileId, $jobId);
  saveBtn_onLoad($profileId, $jobId);

  echo "<button id=\"copy-button\">Copy Link</button>

      </form>
    </div>

    <hr />

    <!-- ! Middle 2 -->
    <div class=\"middle2\">
      <!-- employment -->
      <div class=\"employment\">
        <h3>Employment</h3>
        <p>$employment</p>
      </div>

      <!-- payment -->
      <div class=\"payment\">
        <h3>Payment</h3>
        <p>$payment ETB</p>
      </div>

      <!-- ex level -->
      <div class=\"experience-level\">
        <h3>Experience Level</h3>
        <p>$experience</p>
      </div>
    </div>

    <hr />

    <!-- ! Bottom -->
    <div class=\"bottom\">
      <!-- activity -->
      <div class=\"activity\">
        <!-- proposal -->
        <div class=\"proposal\">
          <h3>Proposals</h3>
          <p>$proposals proposals needed.</p>
        </div>

        <!-- token -->
        <div class=\"token\">
          <h3>Token</h3>
          <p>$token tokens are need to apply for this job.</p>
        </div>
      </div>
      <!-- Client -->";
  getClientInfo($clientId);
  echo "</div>";
}

function applyJob($pId, $jId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();

  $updateQuery = "UPDATE `profile` p
    JOIN job j ON p.Profile_ID = $pId
    SET p.token = p.token - j.Token
    WHERE j.Job_ID = $jId";

  //checks if job already exists in table or not
  $checkQuery = "SELECT * FROM applied_jobs WHERE Profile_ID = $pId AND Job_ID = $jId";
  $result = mysqli_query($connect, $checkQuery);
  $count = $result->num_rows;

  if ($count > 0) {
    $query = "CALL withdrawJob($pId, $jId)";
    mysqli_query($connect, $query);
  } else {
    $query1 = "SELECT token FROM `profile` WHERE Profile_ID = $pId";
    $result = $connect->query($query1);
    $row = $result->fetch_assoc();
    $profileToken = $row['token'];

    $query2 = "SELECT Token FROM job WHERE Job_ID = $jId";
    $result = $connect->query($query2);
    $row = $result->fetch_assoc();
    $jobToken = $row['Token'];

    if ($profileToken - $jobToken < 0) {
      echo "<script>
          alert(\"Sorry, you don't have enough tokens!\");
        </script>";
    } else {
      $query = "CALL applyJob($pId, $jId)";
      mysqli_query($connect, $query);
      mysqli_query($connect, $updateQuery);
    }
  }



  $currentPage = $_SERVER['PHP_SELF'];
  $profileId = "profileId=$pId";
  $jobId = "jobId=$jId";
  header("Location: $currentPage?$profileId&$jobId");
  exit();
}

function saveJob($pId, $jId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $checkQuery = "SELECT * FROM saved_jobs WHERE Profile_ID = $pId AND Job_ID = $jId";
  $result = mysqli_query($connect, $checkQuery);
  $count = $result->num_rows;

  if ($count > 0) {
    $query = "CALL unsaveJob($pId, $jId)";
    mysqli_query($connect, $query);
  } else {
    $query = "CALL saveJob($pId, $jId)";
    mysqli_query($connect, $query);
  }
  $currentPage = $_SERVER['PHP_SELF'];
  $profileId = "profileId=$pId";
  $jobId = "jobId=$jId";
  header("Location: $currentPage?$profileId&$jobId");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS link -->
  <link rel="stylesheet" href="./Style/Apply_Job.css?v=0.13" />

  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Apply Job Page</title>
</head>

<body>
  <?php
  // include('header.php');
  ?>
  <div class="wrapper">

    <!-- call php function -->
    <?php

    loadJob($profileID, $jobID);

    if (isset($_POST['apply'])) {
      if ($profileID == -1) {
        echo "<script>
          alert(\"To apply for a job, you must log in first!\")
        </script>";
      } else {
        applyJob($profileID, $jobID);
      }
    }
    if (isset($_POST['save'])) {
      if ($profileID == -1) {
        echo "<script>
          alert(\"To save a job, you must log in first!\")
        </script>";
      } else {
        saveJob($profileID, $jobID);
      }
    }
    ?>
  </div>

  <!-- notification -->
  <div class="message">
    <p>Added to Saved Jobs!</p>
    <i class="fa-solid fa-circle-check"></i>
  </div>

  <!-- JS link -->
  <script src="./Script/Apply_Job.js?v=0.15"></script>
</body>

</html>