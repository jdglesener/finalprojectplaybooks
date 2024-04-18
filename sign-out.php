<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    setcookie("userid", "", time() - 3600, "/");
    setcookie("loggedin", false, time() - 3600, "/");
    $msg = "Signed Out Successfully";
    echo "<script>alert('$msg');</script>"; ;
    echo "<script>window.location.href = 'index.php' </script>";
    }