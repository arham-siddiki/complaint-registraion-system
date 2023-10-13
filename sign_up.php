<?php
    session_start();
    if(isset($_SESSION["userId"])) {         
        $role = $_SESSION["role"];
        $redirectUrl = 'home_'.$role.'.php';
        // echo '<script>window.alert("abc'.$redirectUrl.'");</script>';        
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';        
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
    <script>
        function validateForm() {
            var name = document.forms["myForm"]["name"].value;
            var loginId = document.forms["myForm"]["loginId"].value;
            var contact = document.forms["myForm"]["contact"].value;
            var pass = document.forms["myForm"]["pass"].value;
            var confirmPassword = document.forms["myForm"]["cPass"].value;

            // Regular expressions for email and contact number validation
            var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
            var contactNumberRegex = /^[0-9]{10}$/; // Change this regex as needed

            if (name.trim() === "") {
                alert("Name must be filled out");
                return false;
            }

            if (loginId.trim() === "" || !emailRegex.test(loginId)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (contact.trim() === "" || !contactNumberRegex.test(contact)) {
                alert("Please enter a valid 10-digit contact number.");
                return false;
            }

            if (pass.trim() === "") {
                alert("Password must be filled out");
                return false;
            }

            if (confirmPassword.trim() === "" || pass !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            // If all validation checks pass, return true to allow form submission
            return true;
        }
    </script>

</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if the form is valid by calling the JavaScript validateForm function
    if (!empty($_POST["loginId"]) && !empty($_POST["pass"]) && !empty($_POST["cPass"]) && ($_POST["pass"] === $_POST["cPass"])) {
        $name = $_POST["name"];
        $loginId = $_POST["loginId"];
        $contact = $_POST["contact"];
        $pass = $_POST["pass"];

        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM user_role WHERE email = '$loginId'";
        $result = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("A user with the same ID already exists.");</script>';
        } else {
            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
            $query1 = "INSERT INTO citizen (name, email, contact) VALUES ('$name', '$loginId', '$contact')";
            $query2 = "INSERT INTO user_role (email, pass) VALUES ('$loginId', '$pass')";
            if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
                echo '<script>alert("Signed up successfully.");</script>';
                $redirectUrl = 'sign_in.php';
                echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
            } else {
                echo '<script>alert("Sign up failed.");</script>';
            }
        }
        mysqli_close($con);
    }
}
?>

<div>
<div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left: 0px; padding: 0px;">Welcome to sign-up</p>
        <a href="./index.php"><button class="action-buttons" style="margin-left: 15px;">HOME</button></a>
    </div>
    <div style="padding: 15px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <div style="padding: 20px; display: flex; flex-direction: column; align-items: center; width: 100%;">
            <form id="myForm" action="" method="post" style="text-align: center; margin: auto;" onsubmit="return validateForm();">
                <label style="font-size: 30px; text-align: center; margin-bottom: 20px; max-width: 200px; font-weight: 600; font-family: Arial;">SIGN UP</label><br><br>
                <input type="text" name="name" placeholder="Name" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="text" name="loginId" placeholder="E-mail" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="text" name="contact" placeholder="Contact" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="password" name="pass" placeholder="Password" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="password" name="cPass" placeholder="Confirm Password" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="submit" name="submit" value="SIGN UP" class="action-buttons" style="margin-bottom: 20px; max-width: 200px; padding: 20px; border-radius: 1.9rem;">
            </form>
        </div>
        <div style="width: 80%; text-align: center; margin: auto">
            <img src="./resources/images/login_page.jpg" style="max-width: 80%;">
        </div>
    </div>
</div>

</body>
</html>
