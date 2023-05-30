<?php
//to be changed
// $job_id = 2;
date_default_timezone_set('Africa/Addis_Ababa');
$current_time = date("h:i A");
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);

// Parse the query string
parse_str($url_parts['query'], $query);

// Get the job ID and profile ID
$job_id = $query['Job_ID'];
$profile_id = $query['Profile_ID'];
// Get the current date and time as a DateTime object
// $current_date = new DateTime();

// // Get another date as a DateTime object
// $another_date = new DateTime('2022-01-01 12:00:00');

// // Calculate the difference between the two dates
// $diff = $current_date->diff($another_date);

include('Connect.php');

$conn = new Connect;
$connect = $conn->getConnection();

$sql = "SELECT * FROM job WHERE Job_ID = $job_id;";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
// echo $row['Job_Title'];

function fetchPerson(){
    $conn = new Connect;
$connect = $conn->getConnection();

$job_id = 2;

$sql = "SELECT * FROM job WHERE Job_ID = $job_id;";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$person = $row['Profile_ID'];
$sql = "SELECT * FROM profile WHERE Profile_ID = $person;";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
return $row;
}


function fetchTags(){
    $conn = new Connect;
$connect = $conn->getConnection();
$job_id = 2;

    $sql = "SELECT Tag_Name FROM table_name WHERE Job_Id = '" . $job_id . "'";
    $result = mysqli_query($connect, $sql);
      if (!$result) {
        // If the query failed, log the error message and return an empty array
        error_log("SQL query failed: " . mysqli_error($connect));
        return [];
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/JobDetail.css">
    <link rel="stylesheet" href="Style/Header.css">

    <title>Job Detail</title>
</head>

<body>
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
    </header>
    <main class="container">
        <h1>Job Detail</h1>
        <section class="mainContainer">
            <section class="jobDetails">
                <div class="jobTitle">
                <?php echo "<h2>" . $row['Job_Title'] . "</h2>";?>                    
                <p>Posted <?php echo $row['Date'] ?></p>
                </div>
                <div class="jobDescription">
                    <?php echo "<p>" . $row['Description'] . "</p>";?>                    
                </div>
                <div class="jobPriceExpertise">
                    <div>
                      <h4>Birr <?php echo "<span>" . $row['Payment'] . "</span>";?></h4>   
                        <h5>Fixed Price</h5>
                    </div>
                    <div>
                     <?php echo "<h4>" . $row['Experience'] . "</h4>";?>                    
                        <h5>I am looking for a mix of experience and value</h5>
                    </div>
                    <div>
                        <?php echo "<h4>" . $row['Employment'] . "</h4>";?>   
                        <?php echo ($row['Employment'] == "Contract") ? "<h5>This job has the potential to turn into a full time role</h5>" : "<h5>This job is a full time role</h5>";?>                    
                        <h5></h5>
                    </div>
                </div>
                <div class="projectType">
                    <p><span>Project Type: </span>Ongoing</p>
                </div>
                <div class="skillsNeeded">
                    <h4>Skills and Experties</h4>
                    <div class="skillList">
                        <?php 
                        $rows=fetchTags();
                        // $rows = fetchTags();

// Loop through the rows using a foreach loop
foreach ($rows as $row) {
    $tag_name = $row['Tag_Name'];
    echo"<h5 class='skill'>$tag_name</h5>";
}
                        ?>
                        <!-- <h5 class="skill">Web Application</h5>
                        <h5 class="skill">Database Managment</h5>
                        <h5 class="skill">Css</h5>
                        <h5 class="skill">HTML</h5>
                        <h5 class="skill">Web Development</h5>
                        <h5 class="skill">JavaScript</h5>
                        <h5 class="skill">Bootstrap</h5>
                        <h5 class="skill">Wordpress</h5> -->
                    </div>
                </div>
                <div class="jobActivity">
                    <h4>Activity on this Job</h4>
                    <p>Proposals: <span class="numProposal"><?php echo ($row['Proposals'] <= 50) ? "50+" :
     ($row['Proposals'] < 50 && $row['Proposals'] > 20 ) ? "20-50" :
     ($row['Proposals'] <= 20 && $row['Proposals'] > 10 ) ? "10-15" :
     ($row['Proposals'] <= 10 && $row['Proposals'] > 5 ) ? "5-10" :
     "Less than 5";?></span></p>
                    <!-- <p>Proposals: <span class="numInterviewing">6</span></p> -->
                    <p>Interviewing: <span class="numInterviewing">0</span></p>
                    <p>Invites Sent: <span class="numInvites">0</span></p>
                    <p>Unansnwered Invites: <span class="numUnansweredInvites">0</span></p>
                </div>
            </section>
            <?php
                        $person = fetchPerson();
                        ?>
            <section class="jobActions">
                <div class="actions">
                    <button class="applyBtn">Apply Now</button>
                    <button class="saveBtn">Save Job</button>
                    <p>Send a proposal for: <?php echo $row['Token'];?> Token</p>
                    <p>Available Token: <?php echo $person['token'];?></p>
                </div>
                <div class="aboutClient">
                    <h4>About the Client</h4>
                    <h5><i class="fa-solid fa-star" style="color: #577cff;"></i>
                        <i class="fa-solid fa-star" style="color: #577cff;"></i>
                        <i class="fa-solid fa-star" style="color: #577cff;"></i>
                        <i class="fa-solid fa-star" style="color: #577cff;"></i>
                        <i class="fa-solid fa-star" style="color: #577cff;"></i> 5 of 4 reviews</h5>
                    <div>
                        <?php
                        $person = fetchPerson();

                       echo '<h4>'.$person['Country'].'</h4>'
                        ?>
                        
                        <h5><?php echo $current_time?></h5>
                    </div>
                    <div>
                        <h4>5 jobs posted</h4>
                        <h5>40% hire rate, 1 open job</h5>
                    </div>
                    <div>
                        <h4>Birr 13k total spent</h4>
                        <h5>4 hires, 0 active</h5>
                    </div>
                    
                    <h4 style="margin-top: 10px;">Member since <?php
                       echo '<h5>'.$person['member_since'].'</h5>'
                        ?></h4>
                </div>
                <div class="jobLink">
                    <h4>JOB LINK</h4>
                    <input id="URL" readonly type="text" value=<?php echo $current_url ?> name="job link">
                    <p onclick="copyToClipboard()">Copy Link</p>
                </div>
            </section>
        </section>
    </main>
    <script>
		function copyToClipboard() {
			var copyText = document.getElementById("URL");
			copyText.select();
			document.execCommand("copy");
		}
	</script>
</body>

</html>