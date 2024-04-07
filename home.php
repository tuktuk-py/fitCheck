<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<?php include('header.php');?>
<div class="right-links">

<?php 
// Query to fetch user details
$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

// Query to fetch items
$item_query = mysqli_query($con, "SELECT * FROM items WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_id = $result['Id'];
}

$items = mysqli_query($con, "SELECT COUNT(*) AS photo FROM items WHERE Id=$id");
while ($result = mysqli_fetch_assoc($items)) {
    $res_count = $result['photo'];
}
echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
?>
 <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

</div>
</div>
<main>
<div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome to your virtual closet!</p>
            </div>
            <div class="box">
            <p>You have <b><?php echo $res_Age ?> saved outfits</b>.</p> 
                
            </div>
          </div>
          <div class="bottom">
            <div class="box">
            <p>You have <b><?php echo $res_count ?></b> items in your closet. </p>
                <center> <a href='add.php'><button class='btn'> ADD AN ITEM </button></a> </center>
                <br> <br>
        <h2>Your Items:</h2>
        <br> <br>
        <div class="container">
            
    <?php
    $count = 0;
    while ($row = mysqli_fetch_assoc($item_query)) {
        // Construct the path to the image using the directory and filename
        $image_path = "clothing/" . $row['photo'];

        // Display the image using the img tag
        echo "<div class='item'>";
        echo "<img src='" . $image_path."' alt='" . $row['nameClothing'] . "' class='image-size'>";
        
        // Display other details of the item using popup
        echo "<div class='details-popup'>";
        echo "<p>Name: " . $row['nameClothing'] . "</p>";
        echo "<p>Kind: " . $row['kind'] . "</p>";
        echo "<p>Color: " . $row['color'] . "</p>";
        echo "<p>Notes: " . $row['notes'] . "</p>";
        echo "</div>";
        echo "</div>";

        // Increase count
        $count++;

        // Check if three items have been displayed
        if ($count % 3 == 0) {
            echo "</div><div class='container'>";
        }
    }
    ?>
</div>

    </div>

</main>

</html>
