<?php
    $conn = mysqli_connect('localhost', 'michal', 'Queen2', 'bro_chat');

    if(!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>
