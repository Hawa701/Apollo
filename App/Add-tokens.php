<?php

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);
if (isset($url_parts['query'])) {
  parse_str($url_parts['query'], $query);
  $profileId = $query['Profile_ID'];
}

include('Connect.php');
$conn = new Connect;
$connect = $conn->getConnection();

// Check connection
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

function getToken($connect, $profileId)
{
  // Check connection
  if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    $query = "SELECT token FROM profile WHERE Profile_ID = {$profileId}";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    echo "<span class='token-amout'>{$row['token']}</span>"; // Using string interpolation
  }
}


function buy($connect, $profileId)
{

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amountToBuy = $_POST['amount-to-buy'];
    $customAmount = isset($_POST['input-custom-amount']) ? $_POST['input-custom-amount'] : null; // Check if custom amount is set

    // Calculate the total amount to be charged
    if ($customAmount) {
      $totalCharge = $customAmount;
    } else {
      $totalCharge = $amountToBuy;
    }

    // Update the user's token balance in the database
    if ($customAmount) {
      $query = "UPDATE profile SET token = token + {$customAmount} WHERE Profile_ID = {$profileId}"; // if it's custom amount
    } else {
      $query = "UPDATE profile SET token = token + {$amountToBuy} WHERE Profile_ID = {$profileId}"; // if it's default amount
    }
    $result = mysqli_query($connect, $query);

    // Check if the query was successful
    if ($result) {
      $url = "view_profile.php?Profile_ID=" . urlencode($profileId);
      header('Location:' . $url);
      exit();
    } else {

      echo "Error updating token balance: " . mysqli_error($connect);
    }
  }
}

// calling buy function when buy button is clicked

if (isset($_POST['buy-btn'])) {
  buy($connect, $profileId);
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
  <link rel="stylesheet" href="./Style/Header.css?v=1.0" />

  <!-- css link -->
  <link rel="stylesheet" href="./Style/add_tokens.css?v=1.0" />
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Add Tokens</title>
</head>

<body>

  <div class="wrapper">

    <?php
    include('header.php');
    ?>

    <!-- Section design -->
    <section class="section">

      <div class="token-wrap">
        <h1>Buy Tokens</h1>

        <form action="#" class="token-form" method="post">

          <label for="avilable-tokens">Your avialable Tokens</label>
          <div class="token-amout display" id="avilable-tokens">

            <?php
            getToken($connect, $profileId);
            ?>

          </div>

          <label for="amount-to-buy">Select the amount to buy</label>
          <br>
          <select name="amount-to-buy" id="amount-to-buy">
            <option value="10">10 for 75bir</option>
            <option value="20">20 for 150bir</option>
            <option value="40">40 for 300bir</option>
            <option value="60">60 for 450bir</option>
            <option value="80">80 for 600bir</option>
            <option value="100">100 for 750bir</option>
            <option value="150">150 for 1,100bir</option>
            <option value="200">200 for 1,500bir</option>
            <option value="250">250 for 1,850bir</option>
            <option value="300">300 for 2,250bir</option>
            <option value="custome" id="custom-amount">Custom amount</option>
          </select>
          <br>

          <div class="input">
            <label for="input-custom-amount">Custom amount</label>
            <br>
            <input type="text" name="input-custom-amount" id="input-custom-amount" min="1" max="75000" step="1" maxlength="5">
            <br>
          </div>

          <label for="amount-tobe-charged">You account will be charged</label>
          <div class="account-charge display" id="amoutCharged"></div>

          <label for="new-balance">Your new Token balance will be</label>
          <div class="account-balance display" id="accountBalance">

          </div>

          <label for="expire-date">These Tokens will expire on</label>
          <div class="date display" id="expireDate"></div>

          <div class="statements">
            <p class="statement-1">This Token will expire 1year from today. unused Tokens rollover to the next month. <a href="#">Learn more</a></p>
            <p class="statement-2">You're authorizing Apollo to change your account. if you have suffieicent funds, we will withdraw from your account balance. if not, the full amount will be charged to your primary billing method. <a href="#">Learn more</a></p>
          </div>

          <div class="buttons">
            <button type="cancel" class="cancel-btn btn" name="cancel-btn">Cancel</button>
            <button type="submit" class="buy-btn btn" name="buy-btn">Buy Token</button>
          </div>

        </form> <!-- form end -->

      </div> <!-- token wrap end -->

    </section> <!-- section end -->

  </div> <!-- wrapper end -->

  <!-- js link -->
  <script src="./Script/add tokens.js"></script>
  <script src="./Script/Find Work.js"></script>
</body>

</html>