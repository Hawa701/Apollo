<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileID = $query['Profile_ID'];
} else {
  $profileID = -1;
}

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

function loadSavedJobs($profileID)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $jobIds = "SELECT Job_ID FROM saved_jobs s
        WHERE s.Profile_ID = $profileID";
  $result = mysqli_query($connect, $jobIds);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    $suffix = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $jobId = $row['Job_ID'];
      loadJob($jobId, $suffix, $profileID);
      $suffix++;
    }
  } else {
    echo "<p> Sorry, you haven't saved any jobs yet.";
  }
}

function loadJob($jobId, $suffix, $profileID)
{
  $conn = new Connect;
  $connect = $conn->getConnection();

  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT * FROM job WHERE Job_ID = $jobId";
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  while ($row = mysqli_fetch_assoc($result)) {
    $jobTitle = $row['Job_Title'];
    $jobDescription = $row['Description'];
    $payment = $row['Payment'];
    $experience = $row['Experience'];
    $estTime = $row['Estimated_Time'];
    $date = $row['Date'];
    $proposals = $row['Proposals'];
    $token = $row['Token'];

    echo "<div class=\"job\">
    <a style='color:black' href='http://localhost/apollo/App/Apply%20Job.php?profileId=" . $profileID . "&jobId=" . $jobId . "'>
        <form class=\"title-block\" method=\"post\">
          <h3>$jobTitle</h3>
          <button class=\"unsaveBtn\" name=\"unsaveBtn\" value=\"$jobId\">
            <i class=\"fa-solid fa-bookmark\"></i>
          </button>
        </form>

        <div class=\"job-info\">
          <span>
            Payment:
            <span>$payment</span>
            - <span>$experience</span>
            - Est. Time:
            <span>$estTime</span>
            - Posted -
            <span>$date</span>
          </span>
        </div>

        <div class=\"description\">
          <p>
            $jobDescription
          </p>
        </div>";

    getTags($jobId);

    echo "<div class=\"apply-info\">
          <div class=\"text\">Proposals: <span>$proposals</span></div>
          <div class=\"text\">Number of tokens: <span>$token</span></div>
        </div>

        <hr />
        </a>
      </div>";
  }
}

function unsaveJob($pId, $jId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "CALL unsaveJob($pId, $jId)";
  mysqli_query($connect, $query);
  echo "<script>
          alert(\"Job is unsaved!\");
        </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS Link -->
  <link rel="stylesheet" href="./Style/SavedJobs.css?v=1.2" />

  <!-- Font Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Saved Jobs</title>
</head>

<body>

  <?php
  include('header.php');
  ?>

  <div class="wrapper">
    <!-- title -->
    <div class="title">
      <h1>Saved Jobs</h1>
    </div>

    <div class="container">

      <?php
      loadSavedJobs($profileID);

      if (isset($_POST['unsaveBtn'])) {
        $jobID = $_POST['unsaveBtn'];
        unsaveJob($profileID, $jobID);
      }
      ?>

    </div>
  </div>

</body>

</html>