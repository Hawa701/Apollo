<?php

require_once('Connect.php');

$conn2 = new Connect;
$connect2 = $conn2->getConnection();

if (isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $sender_id = mysqli_real_escape_string($connect2, $_POST['sender_id']);
    $receiver_id = mysqli_real_escape_string($connect2, $_POST['receiver_id']);
    $message = mysqli_real_escape_string($connect2, $_POST['message']);

    
    $sql4 = "INSERT INTO `chat_messages` (`chat_ID`, `sender_ID`, `reciever_ID`, `message`, `timestamp`) VALUES (NULL, '$sender_id', '$receiver_id', '$message', current_timestamp())";
    if (mysqli_query($connect2, $sql4)) {
        echo "Message sent successfully";
        // $to = "recipient@email.com";
        // $subject = "Test Email";
        // $message = "This is a test email.";
        // $headers = "From: sender@email.com";

        // // Send email
        // if (mail($to, $subject, $message, $headers)) {
        //     echo "Email sent successfully.";
        // } else {
        //     echo "Email sending failed.";
        // }
    } else {
        echo "Error: " . $sql4 . "<br>" . mysqli_error($connect2);
    }
    
}

?>
