<?php 
session_start();
include ('Connect.php');
    
if (isset($_POST['emailusername']) && isset($_POST['passwords']))   {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $email = validate($_POST['emailusername']);
    $password = validate($_POST['passwords']);

    if(empty($email)){
        header('Location: Login.php?error=email or username is required');
        exit();
    }
    if(empty($password)){
        header('Location: Login.php?error=password is required');
        exit();
    }
    if(!empty($email) && !empty($password) ) {
        $conn = new Connect;
        $connect = $conn->getConnection();
        $sql = "SELECT * FROM profile WHERE Email = '$email' or Username = '$email' ";
       
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) > 0){
            $row =mysqli_fetch_assoc($result);
            if ($row['password']==$password){
                $_SESSION['logged-in'] = true;
                $_SESSION['Profile_ID']=$row['Profile_ID'];
                
                header('Location: index.php');
                exit();

            }else{
                header('Location: Login.php?error=Incorrect Password');
                exit();   
            }

        }else{
            header('Location: Login.php?error= User not registered');
            exit();
        }

    }
}
else {
    header("Location: login.php?error = Enter a correct detail");
    exit();
}
