<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
<div class="nav">
        <div class="logo">
        <p><a href="home.php"><img align="left" src='fit.png' alt="logo" class="logo" height="100" width="100" ></a> </p>
        </div>
<div class="container">
    <div class="box form-box">

        <?php

        include("php/config.php");
        $email = ''; // Initialize email variable
        $password = ''; // Initialize password variable

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

            $errors = array('email' => '', 'password' => '');

            if (empty($email)) {
                $errors['email'] = 'An email is required <br/>';
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Email must be a valid email address";
                }
            }
            if (empty($password)) {
                $errors['password'] = 'A password is required <br/>';
            } else {
                if (strlen($password) < 8) {
                    $errors['password'] = 'Your password must be at least 8 characters long.';
                } elseif (!preg_match('#[0-9]+#', $password)) {
                    $errors['password'] = 'Your password must contain at least one number';
                } elseif (!preg_match('#[A-Z]+#', $password)) {
                    $errors['password'] = 'Your password must contain at least one uppercase letter.';
                } elseif (!preg_match('#[a-z]+#', $password)) {
                    $errors['password'] = 'Your password must contain at least one lowercase letter.';
                } elseif (!preg_match("/[\!@#$%^&*+_=]/", $password)) {
                    $errors['password'] = 'Your password must contain at least one special character.';
                }
            }

            if (!empty($errors['email']) || !empty($errors['password'])) {
                // If there are errors, display them and do not proceed with database insertion
                foreach ($errors as $error) {
                    echo "<div class='message'>$error</div>";
                }
            } else {
                // If there are no errors, proceed with database insertion

                // Check if the email already exists in the database
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                          <p>This email is used, Try another One Please!</p>
                      </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    // Insert user data into the database
                    $username = mysqli_real_escape_string($con, $username);
                    $email = mysqli_real_escape_string($con, $email);
                    $age = mysqli_real_escape_string($con, $age);
                    $password = mysqli_real_escape_string($con, $password);

                    $sql = "INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')";
                    if (mysqli_query($con, $sql)) {
                        // Success message
                        echo "<div class='message'>
                              <p>Registration successfully!</p>
                          </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    } else {
                        // Error message if the query fails
                        echo 'query error: ' . mysqli_error($con);
                    }
                }
            }
        } else {
            ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
</body>
</html>
