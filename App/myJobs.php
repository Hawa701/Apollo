<?php
//to be changed
$job_id = 2;
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);

// Parse the query string
parse_str($url_parts['query'], $query);

// Get the job ID and profile ID
// $job_id = $query['Job_ID'];
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

$sql = "SELECT * FROM applied_jobs WHERE Profile_ID = $profile_id;";
$result = mysqli_query($connect, $sql);
// $row = mysqli_fetch_assoc($result);
// echo $row['Job_Title'];

function lookUpJob($id){
    $conn = new Connect;
$connect = $conn->getConnection();
$sql2 = "SELECT * FROM job WHERE Job_ID = $id;";
$result2 = mysqli_query($connect, $sql2);
$row2 = mysqli_fetch_assoc($result2);
// echo $row['Job_Title'];
return $row2;
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
    <script src="./Server/Header.js"></script>
    <!-- css link -->
    <link rel="stylesheet" href="./Style/myJob.css" />
    <!-- icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <title>My Job</title>
</head>

<body>
    <div class="wrapper">

        <!-- header design -->
        <?php 
        // include('header.php'); 
        ?>
        <!-- header end -->




        <div class="job-header">
            <h1 onclick="">Active Jobs</h1>
        </div>
        <div class="main-section" id="main-section">

            <div class="job-container">



                <div class="jobsList">

                    <?php
                    while($row = mysqli_fetch_assoc($result)) {
                        $job_id = $row['Job_ID'];
                        $job = lookUpJob($job_id);
                        if($job['Status'] == "Interviewing") {
                            // echo $job['Status'];
                            ?>
                            <div class="job" id="activeJob">
                                <div class="job-title">
                                    <h3><?php echo $job['Job_Title']; ?></h3>
                                </div>
                                <div class="job-description">
                                    <p><?php echo $job['Description']; ?></p>
                                </div>
                                <div class="applicants">
                                    <div class="numberOf-applicants">Number of Applicants: <span><?php echo $job['Proposals']; ?></span></div>
                                </div>
                                <hr />
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!-- first job end -->


                   

                </div>
                <!-- jobs end -->

                

                <div class="num-nav">
                    <ol class="pagination">
                        <li class="left-arrow"><img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/12/null/external-left-arrows-dreamstale-lineal-dreamstale-2.png" /></li>

                        <li class="right-arrow"><img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/12/null/external-right-arrows-dreamstale-lineal-dreamstale-3.png" /></li>
                    </ol>
                </div>

            </div>
            <!-- job container end -->


        </div>
        <!-- main container end -->

        <!-- Previous Jobs -->
        <div class="job-header">
            <h1 onclick="">Previous Jobs</h1>
        </div>
        <div class="main-section" id="main-section">

            <div class="job-container">



                <div class="jobsList">

                    <?php
                    $sql = "SELECT * FROM applied_jobs WHERE Profile_ID = $profile_id;";
$result = mysqli_query($connect, $sql);
                    $row = mysqli_fetch_assoc($result);
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        $job_id = $row['Job_ID'];
                        $job = lookUpJob($job_id);
                        if($job['Status'] == "Hired") {
                            // echo $job['Status'];
                            ?>
                            <div class="job" id="activeJob">
                                <div class="job-title">
                                    <h3><?php echo $job['Job_Title']; ?></h3>
                                </div>
                                <div class="job-description">
                                    <p><?php echo $job['Description']; ?></p>
                                </div>
                                <div class="applicants">
                                    <div class="numberOf-applicants">Number of Applicants: <span><?php echo $job['Proposals']; ?></span></div>
                                </div>
                                <hr />
                            </div>
                            <?php
                        }
                    }
                
                    ?>
                    <!-- first job end -->



                    

                </div>
                <!-- jobs end -->

                <div class="num-nav">
                    <ol class="pagination">
                        <li class="left-arrow"><img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/12/null/external-left-arrows-dreamstale-lineal-dreamstale-2.png" /></li>

                        <li class="right-arrow"><img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/12/null/external-right-arrows-dreamstale-lineal-dreamstale-3.png" /></li>
                    </ol>
                </div>

            </div>
            <!-- job container end -->


        </div>
        <!-- main container end -->
    </div>
    <!-- wrapper end -->

    <script src='./Script/job_status.js'></script>
</body>

</html>