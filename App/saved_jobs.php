<?php
include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }

$profileId = null;
$jobId = null;
$jobTitle = null;
$jobDescription = null;
$jobPayment = null;
$jobExperience = null;
$jobDate = null;
$jobProposal = null;
$jobToken = null;

// pagination 
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; //get the current page number from the URL parameter, or default to 1
$totalRows = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM saved_jobs"));//Count the total number of rows in the saved_jobs table
$totalPages = ceil($totalRows / 3); //Calculate the total number of pages needed to display all rows
$offset = ($currentPage - 1) * 3; //the LIMIT offset needed for the MySQL query based on the current page number
$query = "SELECT * FROM saved_jobs LIMIT 3 OFFSET $offset"; //Construct the query with LIMIT and OFFSET


function getJobTitle($connect, $jobId) {
    $query = "SELECT job.Job_Title FROM job 
                              JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                              WHERE saved_jobs.Job_ID = $jobId";
                    $result = mysqli_query($connect, $query);
         
                     if($result && mysqli_num_rows($result) > 0) {
                           $row = mysqli_fetch_assoc($result);
                           echo "<h3 onclick='openApplyJob()'>{$row['Job_Title']}</h3>";
                       }
                       else {
                           // echo "<style> .first-job { display: none; } </style>";
                           echo "<h3> No Job Saved</h3>";
                       }
}


function getJobInfo($connect, $jobId) {
    $query = "SELECT job.Payment, job.Experience, job.Date, job.Token, job.Estimated_Time FROM job 
                  JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                  WHERE saved_jobs.Job_ID = $jobId";
                       $result = mysqli_query($connect, $query);

                       if($result && mysqli_num_rows($result) > 0) {
                       $row = mysqli_fetch_assoc($result);
                       echo "<span> Payment: 
                       <span class='content'>{$row['Payment']}</span> - <span class='content'>{$row['Experience']}</span> - Est. Time: 
                       <span class='content'>{$row['Estimated_Time']}</span> - Posted On - 
                       <span class='content'>{$row['Date']}</span>
                       </span>";               
                       }
                       else {
                           echo "<h3> No Job Saved</h3>";
                       }
}

function getJobDescription($connect, $jobId) {
	$query = "SELECT job.Description FROM job 
                           JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                           WHERE saved_jobs.Job_ID = $jobId";
                 $result = mysqli_query($connect, $query);
      
                  if($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<p>{$row['Description']}</p>";
                    }
                    else {
                        echo "<h3> No Job Saved</h3>";
                    }
}

// gets proposals and tokens
function getJobTime($connect, $jobId) {
	$query = "SELECT job.Proposals, job.Token FROM job 
                           JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                           WHERE saved_jobs.Job_ID = $jobId";
                 $result = mysqli_query($connect, $query);
      
                  if($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='proposal'>Proposal: <span>Less than <span>{$row['Proposals']}</span></span></div>
                        <div class='tokens'>Tokens To Apply: <span>{$row['Token']}</span></div>";
                    }
                    else {
                        echo "<h3> No Job Saved</h3>";
                    }
}


function postedOn($connect, $jobId) {
            	  $query = "SELECT job.Date FROM job 
                            JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                            WHERE saved_jobs.Job_ID = $jobId";
                            $result = mysqli_query($connect, $query);

                            if($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo "<p>Posted On - <span>{$row['Date']}</span></p>";
                            }
                            else {
                                echo "<h3> No Job Saved</h3>";
                            }
}

function getPrice($connect, $jobId) {
    $query = "SELECT job.Payment  FROM job 
                  JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
                  WHERE saved_jobs.Job_ID = $jobId";
                       $result = mysqli_query($connect, $query);

                       if($result && mysqli_num_rows($result) > 0) {
                       $row = mysqli_fetch_assoc($result);
                       echo "<h4>\${$row['Payment']}</h4>";                
                       }
                       else {
                           echo "<h3> No Job Saved</h3>";
                       }
}

function getExperience($connect,$jobId) {
    $query = "SELECT job.Experience FROM job 
    JOIN saved_jobs ON job.Job_ID = saved_jobs.Job_ID 
    WHERE saved_jobs.Job_ID = $jobId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "<h4>{$row['Experience']}</h4>";                
         }
         else {
             echo "<h3> No Job Saved</h3>";
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
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />


    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Header css link -->
    <link rel="stylesheet" href="./Style/Header.css" />

    <!-- css link -->
    <link rel="stylesheet" href="./Style/saved_jobs.css" />
    <!-- icon link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Saved Jobes</title>
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

      <div class="job-container"> 

        <div class="job-header">
          <h1 onclick="">Saved Jobs</h1>
        </div>

        <div class="jobs">

          <div class="first-job">
 
            <div class="job-title">
            <?php
                getJobTitle($connect, 2);
             ?>
              <div class="delete-job" onclick="">
                <img src="https://img.icons8.com/small/25/22C3E6/filled-trash.png"/>        
              </div>
            </div>

             <div class="job-info">
              <?php
                    getJobInfo($connect, 2);
              ?>
             </div>
  
            <div class="job-description" onclick="openApplyJob()"> 
              <?php
                 getJobDescription($connect, 2);
             ?>
            </div>
           
            <div class="tags">
              <span class="tag">PHP</span>
              <span class="tag">JS</span>
              <span class="tag">HTML</span>
              <span class="tag">CSS</span>
            </div>
  
            <div class="time">
              <?php
                 getJobTime($connect, 2);
             ?>
            </div>
  
            <hr />
  
         </div> <!-- first job end -->
  
   
          <div class="second-job">
  
          <div class="job-title">
            <?php
               getJobTitle($connect, 2);
             ?>
              <div class="delete-job" onclick="">
                <img src="https://img.icons8.com/small/25/22C3E6/filled-trash.png"/>        
              </div>
            </div>

             <div class="job-info">
              <?php
                    getJobInfo($connect, 2);
              ?>
             </div>
  
            <div class="job-description" onclick="openApplyJob()"> 
              <?php
                 getJobDescription($connect, 2);
             ?>
            </div>
           
            <div class="tags">
              <span class="tag">PHP</span>
              <span class="tag">JS</span>
              <span class="tag">HTML</span>
              <span class="tag">CSS</span>
            </div>
  
            <div class="time">
              <?php
                 getJobTime($connect, 2);
             ?>
            </div>
  
            <hr />
  
          </div> <!-- second job end -->
  
   
          <div class="third-job">
            
          <div class="job-title">
            <?php
                 getJobTitle($connect, 2);
             ?>
              <div class="delete-job" onclick="">
                <img src="https://img.icons8.com/small/25/22C3E6/filled-trash.png"/>        
              </div>
            </div>

             <div class="job-info">
              <?php
                    getJobInfo($connect, 2);
              ?>
             </div>
  
            <div class="job-description" onclick="openApplyJob()"> 
              <?php
                 getJobDescription($connect, 2);
             ?>
            </div>
           
            <div class="tags">
              <span class="tag">PHP</span>
              <span class="tag">JS</span>
              <span class="tag">HTML</span>
              <span class="tag">CSS</span>
            </div>
  
            <div class="time">
              <?php
                 getJobTime($connect, 2);
             ?>
            </div>
   
          </div> <!-- third job end -->
          

        </div> <!-- jobs end -->
 
        <div class="line"> <hr /> </div>


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
                    getJobTitle($connect, 2);
                    ?>
                </h4>
                    <?php
                    postedOn($connect,2);
                    ?>
            </div>
            <div class="info two">
                <p>
                    <?php
                        getJobDescription($connect, 2);
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
                        getPrice($connect, 2);
                    ?>
                    <span>Fixed Price</span>
                </div> </br>
                <div class="ex-level">
                     <?php
                        getExperience($connect,2);
                     ?>
      </div>
    
    </section> <!-- section end-->

    </div> <!-- wrapper end-->

    
    <!-- js link -->
    <script src="./Script/saved_jobs.js"></script>
    <script src="./Script/Find Work.js"></script>
</body>
</html>