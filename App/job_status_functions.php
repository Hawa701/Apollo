<?php

function getJobTitle($connect, $jobID)
{
  $query = "SELECT job.Job_Title FROM job WHERE Job_ID =  $jobID";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo " <textarea name='job-title' class='job-title-input input' readonly>{$row['Job_Title']}</textarea>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getJobTitleOnly($connect, $jobID)
{
  $query = "SELECT job.Job_Title FROM job WHERE Job_ID =  $jobID";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Job_Title']}";
  } else {
    echo "<h3> No Job Title</h3>";
  }
}

function getJobPosition($connect, $jobID)
{
  $query = "SELECT job.Job_Position FROM job WHERE Job_ID =  $jobID";

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Job_Position']}";
  } else {
    echo "<h3> No Job Position</h3>";
  }
}


function getJobInfo($connect, $jobID)
{
  $query = "SELECT job.Payment, job.Experience, job.Date, job.Token, job.Estimated_Time FROM job 
            WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "
    <span>Payment: <span class='content'> <input type='text' name='payment' class='payment input' value='{$row['Payment']}' readonly> </span></span> <br>
    <span>Skill: <span class='content'> <input type='text' name='skill' class='skill input' value='{$row['Experience']}' readonly> </span></span> <br>
    <span>Est. Time: <span class='content'> <input type='text' name='time' class='time input' value='{$row['Estimated_Time']}' readonly> </span></span> <br>
    <span>Posted: <span class='content'> <input type='text' name='posted' class='posted input' value='{$row['Date']}' readonly></span></span> <br>
    <span>Tokens To Apply: <span class='content'> <input type='text' name='tokens' class='tokens input' value='{$row['Token']}' readonly></span></span> <br>
      ";
  } else {
    echo "<h3> No Job Information</h3>";
  }
}


function getJobDescription($connect, $jobID)
{
  $query = "SELECT job.Description FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<textarea name='job-description' class='job-description input' readonly>{$row['Description']}</textarea>";
  } else {
    echo "<h3> No Job Description</h3>";
  }
}

function getJobDescriptionOnly($connect, $jobID)
{
  $query = "SELECT job.Description FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Description']}";
  } else {
    echo "<h3> No Job Description</h3>";
  }
}


// gets proposals and tokens
function getJobTime($connect, $jobID)
{
  $query = "SELECT job.Proposals, job.Token FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<div class='proposal'>Proposal: <span>Less than <span>{$row['Proposals']}</span></span></div>
                        <div class='tokens'>Tokens To Apply: <span>{$row['Token']}</span></div>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}


function postedOn($connect, $jobID)
{
  $query = "SELECT job.Date FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p>Posted On - <span>{$row['Date']}</span></p>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getPrice($connect, $jobID)
{
  $query = "SELECT job.Payment  FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<h4>\${$row['Payment']}</h4>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getPriceOnly($connect, $jobID)
{
  $query = "SELECT job.Payment  FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Payment']}";
  } else {
    echo "<h3> No Job Price</h3>";
  }
}

function getEstimatedtime($connect, $jobID)
{
  $query = "SELECT job.Estimated_Time  FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Estimated_Time']}";
  } else {
    echo "<h3> No Est</h3>";
  }
}

function getExperience($connect, $jobID)
{
  $query = "SELECT job.Experience FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<h4>{$row['Experience']}</h4>";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}

function getToken($connect, $jobID)
{
  $query = "SELECT job.Token FROM job WHERE Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Token']}";
  } else {
    echo "<h3> No Job Saved</h3>";
  }
}


function noOfProfiles($connect, $jobID)
{
  $query = "SELECT COUNT(DISTINCT applied_jobs.Profile_ID) AS Profiles FROM applied_jobs WHERE applied_jobs.Job_ID = $jobID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "{$row['Profiles']}";
  } else {
    echo "<h3>0</h3>";
  }
}


function profileInfo($connect, $profile_ID)
{
  $query = "SELECT  profile.Firstname, profile.Lastname, profile.Profession, profile.Country  FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo " 
         <div class='profile-info'>
         <div class='name'>{$row['Firstname']} {$row['Lastname']}</div>
         <div class='profession'>{$row['Profession']}</div>
         <div class='country'>{$row['Country']}</div>
         </div>
         ";
  } else {
    echo "<h3> No Profile Found!</h3>";
  }
}


function getPricePerHour($connect, $profile_ID)
{
  $query = "SELECT profile.PricePerHour FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "
         <div class='price'>Price/hr - <span class='bir'>
         {$row['PricePerHour']}
                  </span>bir</div> 
         ";
  } else {
    echo "<h3> No Profile Found!</h3>";
  }
}


function getProfileExperience($connect, $profile_ID)
{
  $query = "SELECT profile.Experience_Level FROM profile 
    JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
    WHERE applied_jobs.Profile_ID = $profile_ID";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
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
  } else {
    echo "<h3> No Profile Found!</h3>";
  }
}

function addPerson($connect, $jobID, $profile_ID)
{

  $query = "SELECT profile.Profile_ID, profile.Firstname, profile.Lastname, profile.Profession, profile.Country, profile.PricePerHour, profile.Experience_Level  FROM profile 
  JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
  WHERE applied_jobs.Job_ID = $jobID";
  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
      echo " 
      <div class='profiles'>
          <div class='photo'>
           
            <div class='online-indicatr'></div>
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
        <form method='get'>
            <input type='hidden' name='Reciver_ID' value='{$row['Profile_ID']}'/>
            <input type='hidden' name='Profile_ID' value='{$profile_ID}'/>
            <input type='hidden' name='Job_ID' value='{$jobID}'/>
            <button class='message btn' name='message'>Message</button>
        </form>       

        <form method='post'>
             <input type='hidden' name='Reciver_ID' value='{$row['Profile_ID']}'/>
            <input type='hidden' name='Profile_ID' value='{$profile_ID}'/>
            <input type='hidden' name='Job_ID' value='{$jobID}'/>
            <button class='hire btn' name='hire'>Hire</button>  
        </form>       
    </div>
 </div>  <!-- profiles end -->   
               ";
      }
   
}

function addProfile($connect, $jobID, $profile_ID)
{

  $query = "SELECT  profile.Profile_ID, profile.Firstname, profile.Lastname, profile.Profession, profile.Country, profile.PricePerHour, profile.Experience_Level  FROM profile 
            JOIN applied_jobs ON profile.Profile_ID = applied_jobs.Profile_ID 
            WHERE applied_jobs.Profile_ID = $profile_ID";

  $result = mysqli_query($connect, $query);
  $queryResult = mysqli_num_rows($result);

    if($queryResult > 0) {
      $row = mysqli_fetch_assoc($result);
      echo " 
      <div class='profiles'>
          <div class='photo'>
           
            <div class='online-indicatr'></div>
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
            <form method='get'>
                <input type='hidden' name='Reciver_ID' value='{$row['Profile_ID']}'/>
                <input type='hidden' name='Profile_ID' value='{$profile_ID}'/>
                <input type='hidden' name='Job_ID' value='{$jobID}'/>
                <button class='message btn' name='message'>Message</button>
            </form>       

            <form method='post'>
                <input type='hidden' name='Reciver_ID' value='{$row['Profile_ID']}'/>
                <input type='hidden' name='Profile_ID' value='{$profile_ID}'/>
                <input type='hidden' name='Job_ID' value='{$jobID}'/>
                <button class='hire btn' name='hire'>Hire</button>  
            </form>   
        </div>
    </div>  <!-- profiles end -->   
               ";
    }
   
}
// search
function search($connect, $jobID)
{
  if (isset($_POST['submit'])) {
    $searchTerm = mysqli_real_escape_string($connect, $_POST['search']); // Escape the POST data before using it in SQL queries.

    $query = "SELECT DISTINCT p.Profile_ID
          FROM Profile p 
          JOIN Applied_Jobs aj ON p.Profile_ID = aj.Profile_ID 
          WHERE (p.Firstname LIKE '%$searchTerm%' 
          OR p.Profession LIKE '%$searchTerm%') 
          AND aj.Job_ID = $jobID";

    $results = mysqli_query($connect, $query);
    
    if (mysqli_num_rows($results) > 0) {
      while ($row = mysqli_fetch_assoc($results)) {
        addProfile($connect, $jobID, $row['Profile_ID']);
      }
    } else {
      echo "<h3>No Results Found!</h3>";
    }
  }
}

// Hired_Applicant
function hire($connect, $hired_profileID, $jobId)
{
  if (isset($_POST['hire'])) {  

    $query = "UPDATE job
              SET job.Status = 'Hired', job.Hired_Applicant = $hired_profileID
              WHERE job.Job_ID = $jobId";

    if (mysqli_query($connect, $query)) {
      echo "<script> alert('Hired Sucessfully')</script>";

    } else {
      echo "Error!" . mysqli_error($connect);
    }
  }
}

// delete job (because the jobId is associated with applied jobs we should delete it first)
function deleteJob($connect, $jobID) {
    if (isset($_POST['delete-btn'])) {

        // First, delete the records from the applied_jobs table
        $appliedQuery = "DELETE FROM applied_jobs
                         WHERE Job_ID = $jobID";
                
        if (mysqli_query($connect, $appliedQuery)) {
            // If the applied_jobs deletion succeeds, delete the job from the job table
            $jobQuery = "DELETE FROM job
                         WHERE Job_ID = $jobID";

            if (mysqli_query($connect, $jobQuery)) {
                echo "<script> alert('Deleted job successfully')</script>";
            } else {
                echo "Error deleting job: " . mysqli_error($connect);
            }
        } else {
            echo "Error deleting applied jobs: " . mysqli_error($connect);
        }
    }
}

function editJob($connect, $jobID) {
    if (
        isset($_POST['title']) && isset($_POST['position']) && isset($_POST['decscription'])  && isset($_POST['tokens'])
        && isset($_POST['job-experience']) && isset($_POST['job-Employment']) && isset($_POST['payment']) && isset($_POST['estimateddate']) && isset($_POST['status'])
      ) {
      
        function validate($data)
        {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        
        $Title = validate($_POST['title']);
        $Position = validate($_POST['position']);
        $Description = validate($_POST["decscription"]);
        $Payment = validate($_POST['payment']);
        $Tokens = validate($_POST['tokens']);
        $Experience = $_POST['job-experience'];
        $Employment = $_POST['job-Employment'];
        $Estimated_date = $_POST['estimateddate'];
        $status = $_POST['status'];
        $CurrDate = date('Y-m-d');
      
        if (empty($Title)) {
          echo "<script> alert('Title is Required'); </script>";
        } else {
          if (strlen($Title) > 50) {
            echo "<script> alert('Job title must not be morethan 50 letters'); </script>";
          }
        }
        if (empty($Position)) {
          echo "<script> alert('Job Position is Required'); </script>";
        } else {
          if (strlen($Position) > 50) {
            echo "<script> alert('Job Position must not be morethan 50 letters'); </script>";
          }
        }
        if (empty($Description)) {
          echo "<script> alert('Please Enter the Job Description'); </script>";
        }
        if (empty($Payment)) {
            echo "<script> alert('Please Enter Payment amount'); </script>";
        }
        if (empty($Tokens)) {
            echo "<script> alert('Please Enter Token amount'); </script>";          
        }
        if (
          !empty($Tokens) && !empty($Payment) && !empty($Description) && !empty($Position) && !empty($Title)
          && !empty($Estimated_date) && !empty($Employment) && !empty($Experience) && !empty($status)
        ) {
        
          $conn = new Connect;
          $connect = $conn->getConnection();
          $sql = "UPDATE job SET 
                  Job_Title = '$Title',
                  Job_Position = '$Position',
                  Description = '$Description',
                  Payment = '$Payment',
                  Experience = '$Experience',
                  Employment = '$Employment',
                  Estimated_Time = '$Estimated_date',
                  Status = '$status'
                  WHERE Job_ID = $jobID";
        
          $result = mysqli_query($connect, $sql);
        
          if ($result) {
            echo "<script>
                    alert(\"Job Updated succesfully!\")
                  </script>";
          } else {
            echo "<script>
                    alert(\"Failed to Update Job!\")
                  </script>";
          }
        } 
        
      } else {
        echo "<script>
                    alert(\"Incorrect Details!\")
                  </script>";
      }
}


?>