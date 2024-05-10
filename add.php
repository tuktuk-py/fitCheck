<?php 
session_start();

include("php/config.php");
if(!isset($_SESSION['valid'])){
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
    <title>Add items to your closet</title>
</head>
<body>
<?php include('header.php');?>
<div class="right-links">

<?php 

$id = $_SESSION['id'];
$query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id");

while($result = mysqli_fetch_assoc($query)){
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_id = $result['Id'];
}

echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
?>

<a href="php/logout.php"> <button class="btn">Log Out</button> </a>
</div>
</div>
<main>
<div class="box">
    <p>Hello <b><?php echo $res_Uname ?></b>, Welcome to your virtual closet!</p>
    <p>Let's add an item into your closet!</p>
    <form action="add.php" method="post" name="form" enctype="multipart/form-data">
        <table align="center" class="backgrounds" width="100%" border="2" cellpadding="1" cellspacing="8">
            <tr>
                <td width="100%">Upload a photo of your item </td>
                <td> <input type="file" name="photo" size="25" class="textfield"> </td>
            </tr>            
            <tr>
                <td> Name of the clothing: </td>
                <td> <input type="text" name="nameClothing" class="shadeform"></td>
            </tr>
            <tr>
                <td> What kind of clothing is this? </td>
                <td><select name="kind">
                    <option value="shirt"> Shirt </option>
                    <option value="shortSleeve"> Short Sleeve </option>
                    <option value="longSleeve"> Long Sleeve </option>
                    <option value="shorts"> Shorts </option>
                    <option value="pants"> Pants </option>
                    <option value="dress"> Dress </option>
                    <option value="jacket"> Jacket </option>
                    <option value="skirt"> Skirt </option>
                    <option value="shoes"> Shoes </option>
                    <option value="accessories"> Accessories </option>
                </select></td>
            </tr>
            <tr>
                <td> Color </td>
                <td><select name="color">
                    <option value="red"> Red </option>
                    <option value="blue"> Blue </option>
                    <option value="green"> Green </option>
                    <option value="yellow"> Yellow </option>
                    <option value="black"> Black </option>
                    <option value="white"> White </option>
                    <option value="gray"> Gray </option>
                    <option value="brown"> Brown </option>
                    <option value="purple"> Purple </option>
                    <option value="orange"> Orange </option>
                    <option value="pink"> Pink </option>
                    <option value="others"> Others </option>
                </select></td>
            </tr>
            <tr>
                <td> Notes: </td>
                <td> <textarea name="notes" rows="5" cols="40" wrap="physical" placeholder="How does it fit you? What is the material? Where are you storing it? Which season is it for?"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="submit" value="  Add this item to your closet!  "/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</main>
</body>
</html>
<?php 

$user_id = $_SESSION['id'];

if(isset($_POST["submit"])){
    $errors=array();
    if(empty($_POST['nameClothing'])){
        $errors[]="You forgot to enter the name of this clothing.";
    } else {
        $nameClothing=trim($_POST['nameClothing']);
    }
    if(empty($_POST['kind'])){
        $errors[]="You forgot to select the kind of this clothing.";
    } else {
        $kind=trim($_POST['kind']);
    }
    if(empty($_POST['color'])){
        $errors[]="You forgot to select the color of this clothing.";
    } else {
        $color=trim($_POST['color']);
    } 
    if(array_filter($errors)){
        foreach($errors as $error){
            echo $error . "<br>";
        }
    }else {
        $notes = mysqli_real_escape_string($con, $_POST['notes']);

        // Create the target directory if it doesn't exist
        $target_directory = __DIR__ . '/clothing';
        if (!file_exists($target_directory)) {
            mkdir($target_directory, 0777, true);
        }

        // Handle file upload and conversion
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo_tmp_name = $_FILES["photo"]["tmp_name"];
            $photo_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $photo_name = uniqid() . "." . $photo_extension; // Generate a unique name for the file
            
            // Move the uploaded file to target directory
            $target_file = $target_directory . '/' . $photo_name;
            if(move_uploaded_file($photo_tmp_name, $target_file)){
                // File uploaded successfully, now insert data into database
                $sql = "INSERT INTO items(photo, nameClothing, kind, color, notes, id) VALUES ('$photo_name', '$nameClothing', '$kind', '$color', '$notes','$user_id')";
                
                if(mysqli_query($con, $sql)){
                    echo "<br> <br> <div class='message'>
                                <p>This item has been added to your closet successfully!</p>
                            </div> <br>";
                    echo "<center> <right> <a href='home.php'><button class='btn'> Home </button></a>";
                } else {
                    echo 'Query error: ' . mysqli_error($con);
                }
            } else {
                echo "Failed to move the uploaded file.";
            }
        } else {
            // Echo a more descriptive error message
            switch ($_FILES['photo']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Missing a temporary folder. Check your upload_tmp_dir directive in php.ini.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "A PHP extension stopped the file upload.";
                    break;
                default:
                    echo "Unknown file upload error.";
                    break;
            }
        }
    }
}
?>
