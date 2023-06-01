<?php

include('Connect.php');
 
$conn = new Connect;
$connect = $conn->getConnection();

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }


  
function getJobTitle($connect, $jobId) {
    $query = "SELECT job.Job_Title FROM job 
                              JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
                              WHERE applied_jobs.Job_ID = $jobId";
                    $result = mysqli_query($connect, $query);
         
                     if($result && mysqli_num_rows($result) > 0) {
                           $row = mysqli_fetch_assoc($result);
                           echo "{$row['Job_Title']}";
                       }
                       else {
                           // echo "<style> .first-job { display: none; } </style>";
                           echo "<h3> No Job Saved</h3>";
                       }
}

function getJobInfo($connect, $jobId) {
    $query = "SELECT job.Payment, job.Experience, job.Date, job.Token, job.Estimated_Time FROM job 
                  JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
                  WHERE applied_jobs.Job_ID = $jobId";
                       $result = mysqli_query($connect, $query);

                       if($result && mysqli_num_rows($result) > 0) {
                       $row = mysqli_fetch_assoc($result);
                       echo "<span> Payment: <span class='content payment'>{$row['Payment']}</span></span> <br> 
                             <span>Skill: <span class='content skill'>{$row['Experience']}</span></span> <br>
                             <span>Est. Time: <span class='content time'>{$row['Estimated_Time']}</span></span> <br>
                             <span>Posted On: <span class='content posted'>{$row['Date']}</span></span> <br>
                             <span>Tokens To Apply: <span class='content tokens'>{$row['Token']}</span></span> <br>  
                             ";               
                       }
                       else {
                           echo "<h3> No Job Saved</h3>";
                       }
}

function getJobDescription($connect, $jobId) {
	$query = "SELECT job.Description FROM job 
                           JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
                           WHERE applied_jobs.Job_ID = $jobId";
                 $result = mysqli_query($connect, $query);
      
                  if($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "{$row['Description']}";
                    }
                    else {
                        echo "<h3> No Job Saved</h3>";
                    }
}

// gets proposals and tokens
function getJobTime($connect, $jobId) {
	$query = "SELECT job.Proposals, job.Token FROM job 
                           JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID  
                           WHERE applied_jobs.Job_ID = $jobId";
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
                            JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID  
                            WHERE applied_jobs.Job_ID = $jobId";
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
                  JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
                  WHERE applied_jobs.Job_ID = $jobId";
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
    JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
    WHERE applied_jobs.Job_ID = $jobId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "<h4>{$row['Experience']}</h4>";                
         }
         else {
             echo "<h3> No Job Saved</h3>";
         }
}

function getToken($connect,$jobId) {
    $query = "SELECT job.Token FROM job 
    JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
    WHERE applied_jobs.Job_ID = $jobId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "{$row['Token']}";                
         }
         else {
             echo "<h3> No Job Saved</h3>";
         }
}


function noOfProposals($connect, $jobId) {
$query = "SELECT job.Proposals FROM job 
    JOIN applied_jobs ON job.Job_ID = applied_jobs.Job_ID 
    WHERE applied_jobs.Job_ID = $jobId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "{$row['Proposals']}";                
         }
         else {
             echo "<h3> No Job Saved</h3>";
         }
}


function profileInfo($connect, $profileId) {
  $query = "SELECT  profile.Firstname, profile.Lastname, profile.Profession, profile.Country  FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profileId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo " 
         <div class='profile-info'>
         <div class='name'>{$row['Firstname']} {$row['Lastname']}</div>
         <div class='profession'>{$row['Profession']}</div>
         <div class='country'>{$row['Country']}</div>
         </div>
         ";                
         }
         else {
             echo "<h3> No Profile Found!</h3>";
         }
}


function getPricePerHour($connect, $profileId) {
  $query = "SELECT profile.PricePerHour FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profileId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "
         <div class='price'>Price/hr - <span class='bir'>
         {$row['PricePerHour']}
                  </span>bir</div> 
         ";                
         }
         else {
             echo "<h3> No Profile Found!</h3>";
         }
}


function getProfileExperience($connect, $profileId) {
  $query = "SELECT profile.Experience_Level FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profileId";
         $result = mysqli_query($connect, $query);

         if($result && mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result);
         echo "
         <div class='rating'>
       <span>
         Experience - <span class='rate'>
         {$row['Experience_Level']}
         </span> 
       </span>
       </div>
         ";                
         }
         else {
             echo "<h3> No Profile Found!</h3>";
         }
}

function addPerson($connect, $profileID) {

  $query = "SELECT  profile.Firstname, profile.Lastname, profile.Profession, profile.Country, profile.PricePerHour, profile.Experience_Level  FROM profile 
  JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
  WHERE applied_jobs.Profile_ID = $profileID";
       $result = mysqli_query($connect, $query);

       if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo " 
    <div class='profiles'>
        <div class='photo'>
          <img src='./image/headShot/john.jpg' alt='profile picture' height='60px' width='60px'>
          <div class='online-indicator'></div>
        </div>


      <div class='body'>

            <div class='profile-info'>
              <div class='name'>{$row['Firstname']} {$row['Lastname']}</div>
              <div class='profession'>{$row['Profession']}</div>
              <div class='country'>{$row['Country']}</div>
            </div>

            <div class='price'>Price/hr - <span class='bir'>
                 {$row['PricePerHour']}
                                          </span>bir</div> 

            <div class='rating'>
                <span>
                    Experience - <span class='rate'>
                       {$row['Experience_Level']}
                                  </span> 
                 </span>
            </div>

      </div> <!-- body end -->

      <div class='actions'>
        <button class='message btn'>Message</button>
        <button class='hire btn'>Hire</button>        
      </div>
  </div>  <!-- profiles end -->   
             ";
       }else {
              echo "<h3> No Profile Found!</h3>";
       }
} 


// search
function search($connect) {
  if(isset($_POST['submit'])) {
    $searchTerm = mysqli_real_escape_string($connect, $_POST['search']); // Escape the POST data before using it in SQL queries.
  
    $query = "SELECT profile.Profile_ID FROM profile JOIN applied_jobs 
              ON applied_jobs.Profile_ID = profile.Profile_ID
              WHERE profile.Firstname LIKE '%$searchTerm%' OR profile.Profession LIKE '%$searchTerm%'";
    
    $results = mysqli_query($connect, $query);  
    if(mysqli_num_rows($results) > 0) {
      while ($row = mysqli_fetch_assoc($results)) {
        addPerson($connect, $row['Profile_ID']);
      }
    } else {
      echo "<h3>No Results Found!</h3>";
    }
  }
}

// sort
/* function sort($connect) {
  if(isset($_POST['submit'])) {
    $sort = $_POST['sort'];  // Get sort option from URL

    if ($sort == 'recent') {
      $query = "SELECT profile.Profile_ID FROM profile JOIN applied_jobs 
      ON applied_jobs.Profile_ID = profile.Profile_ID
      WHERE profile.Firstname LIKE '%$searchTerm%' OR profile.Profession LIKE '%$searchTerm%'";

       $query = "SELECT profile.Profile_ID FROM profile JOIN applied_jobs 
      ON applied_jobs.Profile_ID = profile.Profile_ID ORDER BY applied_date DESC"; 
    }
    
    $results = mysqli_query($connect, $query);  
    
    while ($row = mysqli_fetch_assoc($results)) {
       // Display profile to page 
    }
  }
}
 */

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
    <link rel="stylesheet" href="./Style/job_status.css?v=1.3" />
    <!-- icon link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Job Status</title>
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
              </ul>
          </div>
  
          <div class="signInnUp">
              <button class="login">Log In</button>
              <button class="signup">Sign Up</button>
          </div>
      </header> <!-- header end -->


       <!-- job status design  -->

       <div class="job-status" id="job-status">
         <div class="title">
           <h1>Job Status</h1>
         </div>

         <div class="main-content">

          <!-- left side design -->
          <div class="left-container" id="left-container">

            <div class="job-description">
              <div class="job-title">
               <h3>
                <?php
                getJobTitle($connect, 2);
                ?>
               </h3>
             </div>
               <p>
                <?php
                    getJobDescription($connect, 2);
                ?>
               </p>   
             </div> <!-- job description end -->

             <div class="job-info">
               <h3>Additional Information</h3>

               <span>
                 <?php
                    getJobInfo($connect, 2); 
                 ?>
               </span>
             </div>  <!-- job info end -->

             <div class="edit-delete">
                <div class="edit">
                  <button>Edit Job </button>      
                </div>
       
                <div class="delete">
                  <button>Delete Job</button>
                </div>  
            </div> <!-- edit delete end -->

         </div> <!-- left container end -->


            <div class="applicants">
               <div class="applicants-header">
                  <div class="navigation">
                    <ul class="links">
                       <li><a href="#">All Proposals (<span class="noOf-proposals">
                        <?php
                            noOfProposals($connect, 2);
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
                <div class="search-img"><button type="submit" name="submit" class="submit-btn"><img width="30" height="32" src="https://img.icons8.com/ios-filled/25/22C3E6/google-web-search.png" alt="google-web-search"/></button></div>
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
                        
                        if(!isset($_POST['submit'])) { 
                          for($i=0;$i<10;$i++) {
                            addPerson($connect, 10);     
                          }   
                        } else if(isset($_POST['submit'])) {
                          search($connect);
                        } else {
                          echo "Erorr!";
                        }
                        

                      ?>

             </div> <!-- Profile wrapper end -->

            </div> <!-- applicants end -->
         </div> <!-- main content end --> 
       </div> <!-- job status end -->
    </div> <!-- wrapper end -->
    
    <script src='./Script/job_status.js'></script>
</body>
</html>