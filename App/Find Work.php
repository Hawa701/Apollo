<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileID = $query['Profile_ID'];
}

include('Connect.php');
$conn = new Connect;
$input = null;
$sanitized_input = null;  //holds the sanitized input
$selectedJob;             //holds the selected job id
if (isset($_POST['headerClicked'])) {
  global $selectedJob;
  $selectedJob = $_POST['headerClicked'];
}

$experience = array();
$employment = array();
$minPay;
$maxPay;
$selected_proposals = array();
$selected_tokens = array();

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

// Check if the job is saved by the user and echo's the appropriate bookmark icon on load
function bookmark_Icon($userId, $jobId, $suffix)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT COUNT(*) FROM saved_jobs WHERE Profile_ID = $userId AND Job_ID = $jobId;";
  $result = mysqli_query($connect, $query);
  $count = $result->fetch_row()[0];

  if ($count > 0) {
    echo "<i style=\"color:#577cff\" class=\"fa-solid fa-bookmark\" id=\"bookmark-icon" . $suffix . "\" onclick=\"saveJobIcon('bookmark-icon" . $suffix . "')\"></i>";
  } else {
    echo "<i class=\"fa-regular fa-bookmark\" id=\"bookmark-icon" . $suffix . "\" onclick=\"saveJobIcon('bookmark-icon" . $suffix . "')\"></i>";
  }
}

//load jobs function
function loadJobs($profileID, $row, $suffix)
{
  $jobId = $row['Job_ID'];
  $jobTitle = $row['Job_Title'];
  $jobDescription = $row['Description'];
  $payment = $row['Payment'];
  $experience = $row['Experience'];
  $estTime = $row['Estimated_Time'];
  $date = $row['Date'];
  $proposals = $row['Proposals'];
  $token = $row['Token'];

  echo "<div class=\"jobs\">
  <form class=\"title-block\" method=\"post\">
    <button class=\"headerBtn\" name=\"headerClicked\" value=\"$jobId\">
      <h3>
        " . $jobTitle . "
      </h3>
    </button>
    <button class=\"bookmarkBtn\" name=\"bookmark\" value=\"$jobId\">";

  bookmark_Icon($profileID, $jobId, $suffix);

  echo "</button>
  </form>

    <div class=\"job-info\">
      <span>
        Payment:
        <span>" . $payment . "ETB</span>
        - <span>" . $experience . "</span>
        - Est. Time:
        <span>" . $estTime . "</span>
        - Posted -
        <span>" . $date . "</span>
      </span>
    </div>

    <div class=\"description\">
      <p>
        " . $jobDescription . "
      </p>
    </div>";

  getTags($jobId);

  echo "<div class=\"apply-info\">
      <div class=\"text\">Proposals: <span>" . $proposals . "</span></div>
      <div class=\"text\">Number of tokens: <span>" . $token . "</span></div>
    </div>

    <hr />
  </div>";
}

// Check if the job is saved by the user and echo's the appropriate save button on load
function saveJob_Button($userId, $jobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT COUNT(*) FROM saved_jobs WHERE Profile_ID = $userId AND Job_ID = $jobId;";
  $result = mysqli_query($connect, $query);
  $count = $result->fetch_row()[0];

  if ($count > 0) {
    echo "<button id=\"sv-btn\" class=\"btn save\" onclick=\"saveJobBtn('sv-btn')\" name=\"saveBtn\" value=\"$jobId\">Saved</button>";
  } else {
    echo "<button id=\"sv-btn\" class=\"btn save\" onclick=\"saveJobBtn('sv-btn')\" name=\"saveBtn\" value=\"$jobId\">Save Job</button>";
  }
}

//check if job is applied by the user and echo's the appropriate apply button on load
function applyJob_Button($userId, $jobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "SELECT COUNT(*) FROM applied_jobs WHERE Profile_ID = $userId AND Job_ID = $jobId;";
  $result = mysqli_query($connect, $query);
  $count = $result->fetch_row()[0];

  if ($count > 0) {
    echo "<button id=\"ap-btn\" class=\"btn apply\" name=\"applyBtn\" value=\"$jobId\">Applied</button>";
  } else {
    echo "<button id=\"ap-btn\" class=\"btn apply\" name=\"applyBtn\" value=\"$jobId\">Apply Now</button>";
  }
}

function getProfileData($id)
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

      echo "
        <p>Name: $firstname $lastname</p>
        <p>Email: $email</p>";
    }
  }
}
//load job info function
function loadJobInfo($profileID, $JobId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $query = "CALL `getJobInfo`($JobId);";
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $jobId = $row['Job_ID'];
      $jobTitle = $row['Job_Title'];
      $jobDescription = $row['Description'];
      $payment = $row['Payment'];
      $experience = $row['Experience'];
      $date = $row['Date'];
      $proposals = $row['Proposals'];
      $token = $row['Token'];
      $employment = $row['Employment'];
      $pId = $row['Profile_ID'];

      echo "
          <div class=\"top\">
            <i class=\"fa-solid fa-angle-right\" onclick=\"closeApplyJob()\"></i>
            <a href=\"./Apply Job.php?profileId=$profileID&jobId=$jobId\" target=\"_blank\">
              <i class=\"fa-solid fa-arrow-up-right-from-square\"></i> Open job in
              a new window
            </a>
          </div>

          <div class=\"all-job-information\" id=\"all-job-information\">
            
            <div class=\"info one\">
                  <h3>" . $jobTitle . "</h3>
                  <h4>Front-End Development</h4>
                  <p>" . $date . "</p>
                </div>
                <div class=\"info two\">
                  <p> " . $jobDescription . " </p>
                </div>
                <div class=\"info three\">
                  <form method=\"post\">";

      applyJob_Button($profileID, $jobId);

      saveJob_Button($profileID, $jobId);

      echo "      </form>
                </div>
                <div class=\"info four\">
                  <div class=\"box price\">
                    <h4>" . $payment . "ETB</h4>
                    <span>" . $employment . "</span>
                  </div>
                  <div class=\"box ex-level\">
                    <h4>" . $experience . "</h4>
                    <span
                      >Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                      Fuga, maxime.</span
                    >
                  </div>
                </div>
                <div class=\"info five\">
                  <h4>Employment</h4>
                  <span>" . $employment . "</span>
                </div>
                <div class=\"info six\">
                  <h4>About the client</h4>";

      getProfileData($pId);

      echo "</div>
                <div class=\"info seven\">
                  <h4>Skills and Expertise</h4>";

      getTags($JobId);

      echo "
                </div>
                <div class=\"info eight\">
                  <h4>Job link</h4>
                  <p>http://localhost/apollo/app/Apply%20Job.php?profileId=-1&jobId=$jobId</p>
                </div>
                <div class=\"info nine\">
                  <h4>Activity on this job</h4>
                  <p>Proposals: <span>" . $proposals . "</span></p>
                  <p>Tokens needed: <span>" . $token . "</span></p>
                </div>
              </div>";
    }
  }
}

//display search result function
function displaySearchResult($profileID, $input)
{
  $conn = new Connect;
  $connect = $conn->getConnection();

  $resultsFound = 0;

  global $experience;
  global $employment;
  global $minPay;
  global $maxPay;
  global $selected_proposals;
  global $selected_tokens;

  //set variables
  isset($_GET['Experience']) ? $experience = $_GET['Experience'] : '';
  isset($_GET['Employment']) ? $employment = $_GET['Employment'] : '';
  isset($_GET['Min-Pay']) ? $minPay = $_GET['Min-Pay'] : '';
  isset($_GET['Max-Pay']) ? $maxPay = $_GET['Max-Pay'] : '';
  isset($_GET['Proposals']) ?  $selected_proposals = $_GET['Proposals'] : '';
  isset($_GET['Token']) ?  $selected_tokens = $_GET['Token'] : '';

  //build query
  $query = "SELECT * FROM job WHERE 1=1";
  if (!empty($input)) {
    $query .= " AND Job_Title LIKE '%$input%'";
  }
  if (!empty($experience)) {
    $query .= " AND Experience IN ('" . implode("', '", $experience) . "')";
  }
  if (!empty($employment)) {
    $query .= " AND Employment IN ('" . implode("', '", $employment) . "')";
  }
  if (!empty($minPay) && !empty($maxPay)) {
    $query .= " AND Payment BETWEEN $minPay AND $maxPay";
  }
  if (!empty($selected_proposals)) {
    $query .= " AND";
    $proposal_length = count($selected_proposals);
    $i = 1;
    foreach ($selected_proposals as $proposal) {
      $range = explode(",", $proposal);
      $pro_1 = intval($range[0]);
      $pro_2 = intval($range[1]);
      $query .= " Proposals BETWEEN $pro_1 AND $pro_2";
      if ($i < $proposal_length) {
        $query .= " OR";
      }
      $i++;
    }
  }
  if (!empty($selected_tokens)) {
    $query .= " AND";
    $token_length = count($selected_tokens);
    $i = 1;
    foreach ($selected_tokens as $token) {
      $range = explode(",", $token);
      $tok_1 = intval($range[0]);
      $tok_2 = intval($range[1]);
      $query .= " Token BETWEEN $tok_1 AND $tok_2";
      if ($i < $token_length) {
        $query .= " OR";
      }
      $i++;
    }
  }

  //echo $query;
  //run query
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
    $resultsFound++;
    $suffix = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      loadJobs($profileID, $row, $suffix);
      $suffix++;
    }
  }

  //If no results are found
  if ($resultsFound == 0) {
    echo "<p align=\"center\" > No results were found.";
  }
}

//apply for a job
function applyJob($pId, $jId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();

  $updateQuery = "UPDATE `profile` p
    JOIN job j ON p.Profile_ID = $pId
    SET p.token = p.token - j.Token
    WHERE j.Job_ID = $jId";

  $checkQuery = "SELECT * FROM applied_jobs WHERE Profile_ID = $pId AND Job_ID = $jId";
  $result = mysqli_query($connect, $checkQuery);
  $count = $result->num_rows;

  if ($pId != -1) {
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
  } else {
    echo "<script>
          alert(\"To apply for a job, you must log in first!\")
        </script>";
  }
}
//save a job
function saveJob($pId, $jId)
{
  $conn = new Connect;
  $connect = $conn->getConnection();
  $checkQuery = "SELECT * FROM saved_jobs WHERE Profile_ID = $pId AND Job_ID = $jId";
  $result = mysqli_query($connect, $checkQuery);
  $count = $result->num_rows;
  if ($pId != -1) {
    if ($count > 0) {
      $query = "CALL unsaveJob($pId, $jId)";
      mysqli_query($connect, $query);
    } else {
      $query = "CALL saveJob($pId, $jId)";
      mysqli_query($connect, $query);
    }
  } else {
    echo "<script>
          alert(\"To save a job, you must log in first!\")
        </script>";
  }
}

function isChecked($value)
{
  $checkedList = array();
  isset($_GET['Experience']) ? $checkedList = array_merge($checkedList, $_GET['Experience']) : '';
  isset($_GET['Employment']) ? $checkedList = array_merge($checkedList, $_GET['Employment']) : '';
  isset($_GET['Proposals']) ?  $checkedList = array_merge($checkedList, $_GET['Proposals']) : '';
  isset($_GET['Token']) ?  $checkedList = array_merge($checkedList, $_GET['Token']) : '';

  $result = in_array($value, $checkedList);
  // $checkedList = array();

  return $result;
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
  <!-- css link -->
  <link rel="stylesheet" href="./Style/Find_Work.css?v=1.32" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Find Work</title>
</head>

<body>

  <!-- <a href=\"./JobDetail.php?Job_ID=$jobId&Profile_ID=$profileID\" target=\"_blank\"> -->

  <div class="wrapper">

    <?php
    include('header.php');
    ?>


    <!-- section design -->
    <section class="section">
      <!-- form -->
      <form action="" method="get">
        <!-- filter -->
        <div class="filter" id="filter">
          <div class="title">
            <h2>Filter</h2>
            <input style="display:none" id="profile-id" type="checkbox" name="Profile_ID" value="<?php echo $profileID ?>" checked>
            <span class="clear" id="clear">
              Clear all
              <i class="fa-regular fa-circle-xmark"></i>
            </span>
          </div>

          <div class="filter-container">
            <div class="filter-box one">
              <h3>Experience Level</h3>
              <input type="checkbox" name="Experience[]" value="Entry Level" id="level" <?php if (isChecked("Entry Level")) {
                                                                                          echo "checked";
                                                                                        } ?> />
              <span class="text">Entry Level</span>
              <br />
              <input type="checkbox" name="Experience[]" value="Intermediate" id="level" <?php if (isChecked("Intermediate")) {
                                                                                            echo "checked";
                                                                                          } ?> />
              <span class="text">Intermediate</span>
              <br />
              <input type="checkbox" name="Experience[]" value="Expert" id="level" <?php if (isChecked("Expert")) {
                                                                                      echo "checked";
                                                                                    } ?> />
              <span class="text">Expert</span>
              <br />
            </div>
            <hr />

            <div class="filter-box two">
              <h3>Employment</h3>
              <input type="checkbox" name="Employment[]" value="Contract" id="Employment" <?php if (isChecked("Contract")) {
                                                                                            echo "checked";
                                                                                          } ?> />
              <span class="text">Contract</span> <br />
              <input type="checkbox" name="Employment[]" value="Full-Time" id="Employment" <?php if (isChecked("Full-Time")) {
                                                                                              echo "checked";
                                                                                            } ?> />
              <span class="text">Full-Time</span> <br />
            </div>
            <hr />

            <div class="filter-box three">
              <h3>Pay (In Birr)</h3>
              <!-- input fields -->
              <div class="price-input">
                <div class="field min">
                  <input type="text" name="Min-Pay" class="value min" value="12500" readonly />
                  <span>ETB</span>
                </div>
                <div class="separator">-</div>
                <div class="field">
                  <input type="number" name="Max-Pay" class="value max" value="37500" readonly />
                  <span>ETB</span>
                </div>
              </div>

              <!-- slider -->
              <div class="slider">
                <div class="progress"></div>
              </div>

              <!-- range -->
              <div class="range-input">
                <input type="range" class="range-min" min="1000" max="50000" value="12500" step="1000" />
                <input type="range" class="range-max" min="1000" max="50000" value="37500" step="1000" />
              </div>
            </div>
            <hr />

            <div class="filter-box four">
              <h3>Number of proposals</h3>
              <input type="checkbox" name="Proposals[]" value="0,5" id="proposals" <?php if (isChecked("0,5")) {
                                                                                      echo "checked";
                                                                                    } ?> />
              <span class="text">Less than 5</span> <br />
              <input type="checkbox" name="Proposals[]" value="6,10" id="proposals" <?php if (isChecked("6,10")) {
                                                                                      echo "checked";
                                                                                    } ?> />
              <span class="text">6 to 10</span> <br />
              <input type="checkbox" name="Proposals[]" value="11,15" id="proposals" <?php if (isChecked("11,15")) {
                                                                                        echo "checked";
                                                                                      } ?> />
              <span class="text">11 to 15</span> <br />
              <input type="checkbox" name="Proposals[]" value="16,20" id="proposals" <?php if (isChecked("16,20")) {
                                                                                        echo "checked";
                                                                                      } ?> />
              <span class="text">16+</span> <br />
            </div>
            <hr />

            <div class="filter-box five">
              <h3>Token needed</h3>
              <input type="checkbox" name="Token[]" value="0,2" id="token" <?php if (isChecked("0,2")) {
                                                                              echo "checked";
                                                                            } ?> />
              <span class="text">Less than 2</span> <br />
              <input type="checkbox" name="Token[]" value="3,6" id="token" <?php if (isChecked("3,6")) {
                                                                              echo "checked";
                                                                            } ?> />
              <span class="text">3 to 6</span> <br />
              <input type="checkbox" name="Token[]" value="7,10" id="token" <?php if (isChecked("7,10")) {
                                                                              echo "checked";
                                                                            } ?> />
              <span class="text">7 to 10</span> <br />
              <input type="checkbox" name="Token[]" value="11,15" id="token" <?php if (isChecked("11,15")) {
                                                                                echo "checked";
                                                                              } ?> />
              <span class="text">11+</span> <br />
            </div>
          </div>
        </div>

        <!-- work -->
        <div class="work">
          <div class="search">
            <div class="search-title">
              <h2>Search</h2>
              <span class="filter-btn" onclick="toggleFilters('filter-icon')">
                Filter
                <i class="fa-solid fa-filter" id="filter-icon"></i>
              </span>
            </div>
            <div class="search-bar">

              <input type="text" name="input" placeholder="Search here" class="search-input" />
              <button type="submit" name="search" id="search-btn" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>

              <?php
              if (isset($_GET['search'])) {
                $input = $_GET['input'];
                $sanitized_input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
              }
              ?>

            </div>
          </div>
      </form>

      <!-- // * job container -->
      <div class="job-container" id="job-container">

        <?php
        //^ Saving job when bookmark icon is clicked
        if (isset($_POST['bookmark'])) {
          $jobID = $_POST['bookmark'];
          saveJob($profileID, $jobID);
        }
        ?>

        <?php
        //^ Saving job when save button in "apply job page" is clicked
        if (isset($_POST['saveBtn'])) {
          $jobID = $_POST['saveBtn'];
          saveJob($profileID, $jobID);
        }
        ?>

        <?php
        //^ Applying for a job when appy button in "apply job page" is clicked
        if (isset($_POST['applyBtn'])) {
          $jobID = $_POST['applyBtn'];
          applyJob($profileID, $jobID);
        }
        ?>

        <?php
        //^ Loading all jobs

        $conn = new Connect;
        $connect = $conn->getConnection();
        $query = "CALL `getJobs`()";
        $result = mysqli_query($connect, $query);
        $queryResult = mysqli_num_rows($result);

        if (!isset($input)) {
          if ($queryResult > 0) {
            $suffix = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              loadJobs($profileID, $row, $suffix);
              $suffix++;
            }
          } else {
            echo "<p align=\"center\" > There are no jobs to display because job database is empty.";
          }
        }

        //^ Displaying search results if any input is given
        elseif (isset($input)) {
          displaySearchResult($profileID, $sanitized_input);
        }

        ?>


      </div>
  </div>

  <!-- apply jobs design -->
  <div class="apply-job" id="apply-job">

    <?php
    //^ Loads the selected job info inside the "apply-job" container
    loadJobInfo($profileID, $selectedJob);
    ?>

  </div>

  </section>

  </div>

  <!-- js link -->
  <script src="./Script/Find_Work.js?v=9.6"></script>

</body>

</html>