<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/ProposalDetail.css?v=4.1">
    <title> Proposals Detail Page </title>

</head>
<body>
    <div class="wrapper">
    <?php include('Connect.php');
           include('header.php');
           $conn = new Connect;
           $connect = $conn->getConnection();
           $jobid = $_GET['jobid'];

           $result = mysqli_query($connect,"SELECT * FROM `job` WHERE `Job_ID`=$jobid");
           $row = mysqli_fetch_assoc($result);
    
    ?>
    <main class="container">
        <h1>Proposal Detail</h1>
        <section class="mainContainer">
            <section class="jobDetails">
                <div class="jobTitle">
                <h2> <?php echo $row['Job_Title'] ?> </h2>                    
                <p>  Posted <?php echo $row['Date'] ?> </p>
                </div>
                <div class="jobDescription">
                    <span> <?php echo $row['Job_Position'] ?></span> 
                        <br><br>
                    <p>
                    <?php echo $row['Description'] ?>
                    
                    </p>
                </div>
                <div class="jobPriceExpertise">
                    <div>
                      <h4>Birr <span><?php echo $row['Payment'] ?></span></h4>   
                        <h5>Fixed Price</h5>
                    </div>
                    <div>
                     <h4> <?php echo $row['Experience'] ?> </h4>                    
                        <h5>Experience</h5>
                    </div>
                    <div>
                        <h4>Employment</h4>   
                        <?php echo ($row['Employment'] == "Contract") ? "<h5>This job has the potential to turn into a full time role</h5>" : "  <h5>This job is a full time role</h5>  ";?>                     
                        <h5></h5>
                    </div>
                    <div>
                        <h4>Token Spent</h4>
                        <?php echo $row['Token'] ?>
                    </div>
                </div>
                </section>
        </section>
      </main>
    </div>
</body>
</html>