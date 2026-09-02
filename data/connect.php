<?php
    $server="localhost";
    $user="root";
    $pass="";
    $db="kcp";

    $conn=mysqli_connect($server, $user, $pass, $db);
    if($conn)
        {
            //echo "Connection Success";
        }
?>