
<?php
include('Connect.php');
// include('header.php');


$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_parts = parse_url($current_url);

// Parse the query string
parse_str($url_parts['query'], $query);

// Get the job ID and profile ID
$reciever_ID = $query['Reciver_ID'];
$Profile_ID = $query['Sender_ID'];

$conn = new Connect;
$connect = $conn->getConnection();
// Retrieve chat messages from the database
$sql = "SELECT * FROM chat_messages where (reciever_ID = $reciever_ID and sender_ID = $Profile_ID) or (reciever_ID = $Profile_ID and sender_ID = $reciever_ID) ORDER BY timestamp ";

$result = mysqli_query($connect, $sql);

$test = mysqli_fetch_assoc($result);
// echo end($test);

// if (mysqli_num_rows($result) > 0) {
//     // Output each chat message as a HTML block
//     while ($row = mysqli_fetch_assoc($result)) {
//         $sender_id = $row['sender_ID'];
//         $receiver_id = $row['reciever_ID'];
//         $message = $row['message'];
//         $timestamp = $row['timestamp'];

//         echo "<div class='chat-message'>";
//         echo "<span class='sender'><br>" . $sender_id . "</span>";
//         echo "<span class='timestamp'><br>" . $timestamp . "</span>";
//         echo "<div class='message'>" . $message . "</div>";
//         echo "</div>";
//     }
// } else {
//     echo "No chat messages found";
// }
?>