<?php
    $conn = mysqli_connect("localhost", "root", "", "cv");
        if (!$conn) {
            echo "database connected" . mysqli_connect_error();
        }
 ?>