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
    <title>Sign In</title>
    <head>
        <link href="./basic_styles.css" type="text/css" rel="stylesheet">
        <script>
            function validateForm() {
                
                var loginId = document.forms["myForm"]["loginId"].value;
                var password = document.forms["myForm"]["pass"].value;

                // Check if loginId is empty
                if (loginId.trim() === "") {
                    alert("Login ID must be filled out");
                    return false;
                }

                // Check if password is empty
                if (password.trim() === "") {
                    alert("Password must be filled out");
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
        if (!empty($_POST["loginId"]) && !empty($_POST["pass"])) {
            $loginId = $_POST["loginId"];
            $pass = $_POST["pass"];

            $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
            $checkSql = "SELECT * FROM user_role WHERE email = '$loginId'";
            $result = mysqli_query($con, $checkSql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $storedPassHash = $row["pass"];
                $role=$row["role"];            

                if ($pass==$storedPassHash) {  
                    $_SESSION["userId"] = $row["email"];
                    $_SESSION["role"] = $role;

                    $redirectUrl = '';
                    if ($role === 'admin') {
                        $redirectUrl = 'home_admin.php';
                    } else if($role === 'department') {
                        $redirectUrl = 'home_department.php';
                    } else if($role === 'employee') {
                        $redirectUrl = 'home_employee.php';
                    } else {
                        $redirectUrl = 'home_citizen.php';
                    }
                    echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
                    // echo '<script>alert("'.$role.'");</script>';                
                } else {
                    echo '<script>alert("Password is incorrect. Authentication failed.");</script>';
                }

            } else {
                echo '<script>alert("No such user exist.");</script>';
            }
            mysqli_close($con);
        }
    }
    ?>

<div>
<div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left: 0px; padding: 0px;">Welcome to sign-in</p>
        <a href="./index.php"><button class="action-buttons" style="margin-left: 15px;">HOME</button></a>
    </div>
    <div style="padding: 15px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <div style="padding: 20px; display: flex; flex-direction: column; align-items: center; width: 100%;">
            <form id="myForm" action="" method="post" style="text-align: center; margin: auto;" onsubmit="return validateForm();">
                <label style="font-size: 30px; text-align: center; margin-bottom: 20px; max-width: 200px; font-weight: 600; font-family: Arial;">SIGN IN</label><br><br>
                <input type="text" name="loginId" placeholder="Login ID" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="password" name="pass" placeholder="Password" class="input-fields" style="margin-bottom: 20px;"/><br><br>
                <input type="submit" name="submit" value="LOG IN" class="action-buttons" style="margin-bottom: 20px; max-width: 200px; padding: 20px; border-radius: 1.9rem;">
            </form>
        </div>
        <div style="width: 80%; text-align: right;">
            <img src="./resources/images/login_page.jpg" style="max-width: 80%;">
        </div>
    </div>
</div>

</body>
</html>
