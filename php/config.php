<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$con = mysqli_connect("mysql", "root", "outfitadmin123", "outfitt");

// Check if connection is successful
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>
