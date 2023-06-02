<?php
// Insert new chat message into the database
// include('Connect.php');
include('get-messages.php');
include('send-message.php');
date_default_timezone_set('Africa/Addis_Ababa');
$current_time = date("h:i A");
// $Profile_ID = 1;
$current_urls = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_part = parse_url($current_urls);

// Parse the query string
parse_str($url_part['query'], $query);

// Get the job ID and profile ID
$getter = $query['Reciver_ID'];
$sender = $query['Sender_ID'];
$ID;

echo $getter;
echo $sender;

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./Style/message.css">
    <title>Message</title>
</head>
<body>
    <?php include('header.php');?>
    <main class="container">
        <section class="messageList">
            <?php 
            $sql3 = "SELECT DISTINCT p.Firstname,p.Profile_ID  
FROM profile p  
JOIN chat_messages cm  
ON p.Profile_ID = cm.reciever_ID  
WHERE cm.sender_ID = $Profile_ID OR cm.reciever_ID = $Profile_ID;";
            $result3 = mysqli_query($connect, $sql3);

            if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $messageName = $row3['Firstname'];
                        global $ID;
                        $ID = $row3['Profile_ID'];
                        if($ID == $Profile_ID){
                            continue;
                        }else{
                        echo "<a href='http://localhost/apollo/App/message.php?Sender_ID=".$Profile_ID."&Reciver_ID=$ID ' ><div class='person'>
                                <h3>".$messageName."</h3>
                              </div></a>";
                        }
                    }

            }else{
                echo 'You have not talked to anyone';
            }
            
            ?>
            
        </section>
        <section class="messaging">
            <div class="heading">
                <div class="name">
                    <h3>Henok Bekele</h3>
                    <p><?php echo $current_time ?></p>
                </div>
                <a href="https://zoom.us/" target="_blank"><div class="zoom"> Get On a Zoom Call</div></a>
            </div>
            <div id="chat-messages">
                <!-- Chat messages will be displayed here -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    // Output each chat message as a HTML block
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sender_id = $row['sender_ID'];
                        $receiver_id = $row['reciever_ID'];
                        $message = $row['message'];
                        $timestamp = $row['timestamp'];

                        $sql2 = "SELECT * FROM profile where Profile_ID = $sender_id";
                        $result2 = mysqli_query($connect, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $name = $row2['Firstname'];

                        if($sender_id == $Profile_ID|| $receiver_id == $Profile_ID){
                        echo "<div class='chat-message'>";
                        $sender_name = ($sender_id == $Profile_ID) ? 'You' : $name;
                         echo "<span class='sender'><br>" . $sender_name . "</span>";
                        echo "<div class='message'>" . $message . "</div>";
                        echo "<span class='timestamp'><br>" .date("H:i", strtotime($timestamp)) . "</span>";
                        echo "</div>";
                        } 
                       
                    }
                } else {
                    echo "No chat messages found";
                }
                ?>
            </div>

           <form id="chat-form" method="post">
    <input type="hidden" name="sender_id" value="<?php echo $sender; ?>">
            <input type="hidden" name="receiver_id" value="<?php echo $getter; ?>">
            <input class="input" type="text" name="message" placeholder="Enter your message">
            <button type="submit">Send</button>
        </form>
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    //      document.getElementById("person").addEventListener("click", function() {
    //     var receiverId = 4; // set the new receiver ID here
    //     window.location.href = "http://localhost/apollo/App/message.php?Sender_ID=<?php $Profile_ID ?>&Reciver_ID=" + <?php $ID ?>;
    // });
        // Function to refresh chat messages
        function refreshChatMessages() {
            $.get("get-messages.php", function(data) {
                $("#chat-messages").html(data);
            });
        }

        //Function to send chat messages
        $("#chat-form").submit(function(event) {
            event.preventDefault();
            $.post("send-message.php", $(this).serialize(), function(data) {
                alert(data);
                alert('sent');
                // refreshChatMessages();
            });
            $(this).trigger("reset");
        });

        // Refresh chat messages every 5 seconds
        // setInterval(refreshChatMessages, 5000);

        // Load chat messages when the page loads
        // $(document).ready(function() {
        //     refreshChatMessages();
        // });
    </script>
</body>
</html>