<?php
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profile_ID = $query['Profile_ID'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="Style/Header.css" />
  <link rel="stylesheet" href="Style/Postajob.css?v=1.2" />

</head>

<body>

  <div class="wrapper"> <?php include('header.php');
                        // $pid = intval($profile_ID);
                        ?>
    <!-- Section design -->
    <section class="section">
      <div class="Postajob-wrap">
        <h1>Post a Job</h1>
        <?php if (isset($_GET['error'])) { ?>
          <p class="errors"> <?php echo  $_GET['error'];  ?> </p>
        <?php }  ?>
        <form action="PostajobFormValidate.php?Profile_ID=<?php echo $profile_ID ?>" class="Postajob-form" method="POST">
          <!-- title -->
          <label for="job-title">Job Title </label>
          <div class="display">
            <input type="text" id="job-title" name='title' value="<?php if (!empty($_GET['Title'])) {
                                                                    echo  $_GET['Title'];
                                                                  }  ?>" />
            <label class='alert'> <?php $TitleErr ?><!-- *Enter atmost 50 an alphanumeric letter only [a-z] or [0-9] or [A-Z] --> </label>
          </div>
          <!-- title  -->

          <!-- position -->
          <label for="job-postion">Job Position </label>
          <div class="display">
            <input type="text" id="job-position" name="position" value="<?php if (!empty($_GET['pos'])) {
                                                                          echo  $_GET['pos'];
                                                                        }  ?>" />
            <label class='alert'> <?php $PositionErr ?><!-- *Enter atmost 50 an alphanumeric letter only [a-z] or [0-9] or [A-Z] --> </label>
          </div>
          <!-- position -->

          <!-- Desc -->
          <label for="job-desc">Job Decscription </label>
          <div class="display">
            <textarea id="job-desc" name='decscription'><?php if (!empty($_GET['Des'])) {
                                                          echo  $_GET['Des'];
                                                        }  ?> </textarea>
            <label class='alert'><?php $DescriptionErr ?> <!-- Enter atleast 50 alphanumeric letter only --> </label>
          </div>
          <!-- Desc -->

          <!-- Payment -->
          <label for="job-payment">Payment </label>
          <div class="display">
            <input type="number" min='0' id="job-payment" name='payment' value="<?php if (!empty($_GET['Pay'])) {
                                                                                  echo  $_GET['Pay'];
                                                                                }  ?>" />
            <label class='alert'><?php $PaymentErr ?> <!-- *Enter a Numeric value only --> </label>
          </div>
          <!-- Payment -->

          <!-- Experiance -->
          <label for="job-exp">Experience level</label>
          <div class="display">
            <select id="job-exp" name='job-experience'>
              <option value="Entry Level" selected>Entry Level</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Expert">Expert</option>
            </select>
          </div>
          <!-- Experiance -->

          <!-- Tokens -->
          <label for="job-token">Tokens Required to apply this job</label>
          <div class="display">
            <input type="number" min="0" id="job-tokens" name='tokens' value="<?php if (!empty($_GET['tokens'])) {
                                                                                echo  $_GET['tokens'];
                                                                              }  ?>" />
            <label class='alert'> <?php $TokensErr ?> <!-- *Enter a Numeric value only --> </label>
          </div>
          <!-- Tokens -->

          <!-- Employment -->
          <label for="job-employment">Employment</label>
          <div class="display">
            <select name="job-Employment" id="job-employment">
              <option value="Contract" selected>Contract</option>
              <option value="Full-Time">Full-Time</option>
            </select>
          </div>
          <!-- Employment -->

          <!-- Estimated date -->
          <label for="deadline">Estimated-date</label>
          <div class="display">
            <input type="date" id="deadline" name='estimateddate' />
            <!-- <label class='alert' id="deadline-alert">* The Date you entered can not be the deadline </label> -->
          </div>
          <!-- Estimated date -->

          <!-- Buttons -->
          <div class="buttons">
            <button type="button" name="clear" class="clear btn">Clear</button>
            <button type='submit' name='Submit' class="go btn">Submit</button>
          </div>
          <!-- Buttons -->
        </form>
        <!-- form end -->
      </div>
      <!-- token wrap end -->
    </section>
    <!-- section end -->
  </div>
  <!-- wrapper ends -->
</body>

</html>
<script src="Script/Postajob.js"></script>