
<?php 

session_start();
include ('Connect.php');
 if(isset($_POST['title']) && isset($_POST['position']) && isset($_POST['decscription'])  && isset($_POST['tokens'])
   && isset($_POST['job-experience']) && isset($_POST['job-Employment']) && isset($_POST['payment']) && isset($_POST['estimateddate']) ){
  
    function validate($data){
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
      $CurrDate = date('Y-m-d');

    if (empty($Title)) {
      header('Location: Postajob.php?error=Job title is required&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
      exit();
    }else{
        if(strlen($Title)>50){
          header('Location: Postajob.php?error=Job title must not be morethan 50 letters&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
          exit();
        } 
    }
    if (empty($Position)) {
      header('Location: Postajob.php?error=Job position is required&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
      exit();
    }else{
        if(strlen($Position)>50){
          header('Location: Postajob.php?error=Job Position must not be morethan 50 letters&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
          exit();
        }
    }
    if (empty($Description)) {
      header('Location: Postajob.php?error=Please Enter the Job Description&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
      exit();        
    }
    if (empty($Payment)) {
      header('Location: Postajob.php?error=Payment is required&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
      exit();
    }
    if (empty($Tokens)) {
      header('Location: Postajob.php?error=Enter how many tokens will be used&Title='.$Title.'&pos='.$Position.'&Des='.$Description.'&Pay='.$Payment.'&tokens'.$Tokens);
      exit();
    }
    if(!empty($Tokens) && !empty($Payment) && !empty($Description) && !empty($Position) && !empty($Title)
       && !empty($Estimated_date) && !empty($Employment) && !empty($Experience)){

      $conn = new Connect;
      $connect = $conn->getConnection();
      $sql =     $sql = "INSERT INTO job (  `Job_ID`, `Job_Title`, `Job_Position`, `Description`, `Payment`, `Experience`, `Date`, `Proposals`, `Token`, `Employment`, `Profile_ID`, `Estimated_Time`, `Status`) 
                                  VALUES ( NULL,'$Title', '$Position', '$Description', '$Payment', '$Experience', '$CurrDate', 0, '$Tokens', '$Employment', 2,'$Estimated_date', 'Interviewing')";
      
                        // INSERT INTO `job` (`Job_ID`, `Job_Title`, `Job_Position`, `Description`, `Payment`, `Experience`, `Date`, `Proposals`, `Token`, `Employment`, `Profile_ID`, `Estimated_Time`, `Status`) 
                          //        VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '', '') 

      $result = mysqli_query($connect, $sql);

      if($result){
        echo "<script>alert('Data is registered')</script>";
        header('Location:Postajob.php');
      }else{
        echo "<script>alert('Failed to registor')</script>";
        
      }
    } else{
      echo 'nope';
    }                 
}
else {
  header('Location: Postajob.php?error = Incorrect Details');
  exit();
}
 


?>