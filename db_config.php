<?php
    

    $conn=mysqli_connect('localhost','root','','audit');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>