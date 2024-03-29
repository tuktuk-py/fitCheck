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
            <FORM action="add.php" method="post" name="form" enctype="multipart/form-data">
                <table align="center" class="backgrounds" width="100%" border="2" cellpadding="1" cellspacing="8">
                    <tr>
                        <td width="100%">Upload a photo of your item </td>
                        <td> <input type="file" name="photo" size="25" class="textfield"> </td>
                    </tr>            
                    <tr>
                    <td> Name of the clothing: </td>
                    <td> <input type="text" name="nameClothing" Class="shadeform"></td>
                    </tr>
                    <tr>
                        <td> What kind of clothing is this? </td>
                        <td><select name ="kind">
                            <option value="shirt"> Shirt
                            <option value="shortSleeve"> Short Sleeve
                            <option value="longSleeve"> Long Sleeve
                            <option value="shorts"> Shorts
                            <option value="pants"> Pants
                            <option value="dress"> Dress
                            <option value="jacket"> Jacket
                            <option value="skirt"> Skirt
                            <option value="shoes"> Shoes
                            <option value="accessories"> Accessories 
                        </select></td>
                    </tr>
                    <tr>
                        <td> Color </td>
                        <td><select name ="color">
                            <option value="red"> Red
                            <option value="blue"> Blue
                            <option value="green"> Green
                            <option value="yellow"> Yellow
                            <option value="black"> Black
                            <option value="white"> White
                            <option value="gray"> Gray
                            <option value="brown"> Brown
                            <option value="purple"> Purple
                            <option value="orange"> Orange
                            <option value="pink"> Pink 
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
            </FORM>
            </div>
</main>
<?php 

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
        $photo = mysqli_real_escape_string($con, $_FILES['photo']['name']); // Get the filename
        $notes = mysqli_real_escape_string($con, $_POST['notes']);

        // Move the uploaded file from temporary directory to desired location
        $target_directory = "/clothing"; // Specify the target directory
        $target_file = $target_directory . basename($_FILES["photo"]["name"]);
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
            // File uploaded successfully, now insert data into database
            $sql = "INSERT INTO items(photo, nameClothing, kind, color, notes) VALUES ('$photo', '$nameClothing', '$kind', '$color', '$notes')";
            
            if(mysqli_query($con, $sql)){
                echo "<div class='message'>
                              <p>This item has been added to your closet successfully!</p>
                          </div> <br>";
                echo "<a href='add.php'><button class='btn'>Add another one? </button></a>";
                echo "<a href='home.php'><button class='btn'> Home </button></a>";
            } else {
                echo 'Query error: ' . mysqli_error($con);
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
                    echo "Failed to write file to disk. Check permissions for the upload directory.";
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

