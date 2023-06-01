<?php
// session_start();
// if(isset($_SESSION['Profile_ID'])){
//   echo $_SESSION['Profile_ID'];
// }else{
//   echo 'notset';
// }

include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

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

  <!-- css link -->
  <link rel="stylesheet" href="./Style/Proposal.css?v=1.0" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Job Status</title>
</head>

<body>
  <div class="wrapper">
    <?php
    include('header.php');
      
      $pid = intval($profile_ID);

    ?>
    
    <!-- job status design  -->

    <div class="job-status" id="job-status">
      <div class="title">
        <h1>My Proposals</h1>
      </div>

      <div class="main-content">

        <!-- left side design -->
        <div class="left-container" id="left-container">

          <div class="job-description">
            <div class="job-title">
              <h3>
                My profile



              </h3>
            </div>
            <img src="image/blob.png" width='100px' height="100px" alt="">
          </div> <!-- job description end -->

          <div class="job-info">
            <h3>Additional Information</h3>

            <span>
              <?php
              $query = "SELECT * FROM `profile` where Profile_ID = $pid";
              $result = mysqli_query($connect, $query);
              $row3 = mysqli_fetch_assoc($result);
              // print_r($row3);
              ?>
              First Name : <?php echo $row3['Firstname']; ?> <br>
              last Name : <?php echo $row3['Lastname']; ?> <br>
              Username : <?php echo $row3['Username']; ?><br>
              email : <?php echo $row3['Email']; ?><br>
              Country : <?php echo $row3['Country']; ?><br>
              Token left : <?php echo $row3['token']; ?><br>




            </span>
          </div> <!-- job info end -->

          <div class="edit-delete">
            <div class="edit">
              <button>Edit Profile </button>
            </div>

          </div> <!-- edit delete end -->

        </div> <!-- left container end -->


        <div class="applicants">
          <div class="applicants-header">
            <div class="navigation">
              <ul class="links">
                <li><a href="#">All Proposals (<span class="noOf-proposals">
                      <?php
                      $count = 0; 
                      $sql = "SELECT * FROM `applied_jobs` where Profile_ID = $pid ";

                      $result = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_assoc($result)) {
                         $count++;
                      }          
                      echo $count;
                      ?>
                    </span>)</a></li>
                <!-- <li><a href="#">Messaged (<span class="noOf-messages">

                       </span>)</a></li> -->
              </ul>
            </div>
          </div> <!-- applicants header end -->

          <div class="searchSort">
            <div class="search">
              <input id="job-sea" type="text" placeholder="seacrh for jobs">
              <div class="search-img"><a href="#"><img width="30" height="32" src="https://img.icons8.com/ios-filled/25/22C3E6/google-web-search.png" alt="google-web-search" /></a></div>
            </div> <!-- search end -->

            <div class="sort">
              <label for="sortBy">Sort: </label>
              <select name="" id="sortBy">
                <option value="best-match">Best match</option>
                <option value="recent">Recent</option>
              </select>
            </div> <!-- sort end -->
          </div> <!-- serach sort end -->


          <div class="profile-wrapper">
            <?php
            $sql = "SELECT * FROM `applied_jobs` where Profile_ID = $pid ";

            $result = mysqli_query($connect, $sql);
            // $row =mysqli_fetch_assoc($result);
            while ($row = mysqli_fetch_assoc($result)) {
              $Jid = $row['Job_ID'];
              $sql2 = "SELECT * FROM `job` where Job_ID = $Jid";

              $result2 = mysqli_query($connect, $sql2);

              $row2 = mysqli_fetch_assoc($result2);
            ?>

              <div class="job">
                <div class="job-profile">

                  <div class="job-profile-header ">

                    <div class="name">
                      <?php echo $row2['Job_Title']; ?>
                    </div><!-- name end -->

                  </div> <!-- job-profile-header header end -->

                  <div class="job-profile-body">
                    <div class="desc">
                      <?php echo $row2['Description']; ?>
                    </div> <!-- desc -->

                    <div class="Other">
                      <span><?php echo $row2['Job_Position']; ?></span>
                      <span><?php echo $row2['Payment']; ?></span>
                      <span><?php echo $row2['Experience']; ?></span>
                    </div>

                  </div> <!-- job end profile -->

                </div> <!-- job-profile end --><br>
                
              </div> <!-- job end -->
              <?php } ?>

              </div> <!-- profile wrapper end -->

          </div> <!-- applicants end -->
        </div> <!-- main content end -->
      </div> <!-- job status end -->
    </div> <!-- wrapper end -->


</body>

</html>
<script src='./Script/job_status.js'></script>