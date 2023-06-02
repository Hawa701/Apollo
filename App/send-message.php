<?php

// require_once('Connect.php');

// $conn = new Connect;
// $connect = $conn->getConnection();

if (isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $sender_id = mysqli_real_escape_string($connect);
    $receiver_id = mysqli_real_escape_string($connect, $_POST['receiver_id']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    $sql = "INSERT INTO chat_messages (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";
    if (mysqli_query($connect, $sql)) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}

?>