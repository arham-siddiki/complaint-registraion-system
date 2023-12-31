<?php
    session_start();

    if(isset($_SESSION["userId"])) {     
        $email = $_SESSION["userId"];
    } else {
        $redirectUrl = 'sign_in.php';
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $departmentName = $_POST["name"];
        $departmentEmail = $_POST["email"];
        $departmentPass = $_POST["pass"];
        $headName = $_POST["hName"];
        $headEmail = $_POST["hEmail"];
        $headPass = $_POST["hPass"];

        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM department WHERE name = '$departmentName'";
        $result = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("A department with the same name already exists.");</script>';
        } else {
            $query1 = "INSERT INTO department (name, email, head) VALUES ('$departmentName', '$departmentEmail', '$headName')";
            $query2 = "INSERT INTO employee (name, email, department) VALUES ('$headName', '$headEmail', '$departmentName')";
            $query3 = "INSERT INTO user_role (email, pass, role) VALUES ('$departmentEmail', '$departmentPass', 'department'), ('$headEmail', '$headPass', 'employee')";
            if (mysqli_query($con, $query1) && mysqli_query($con, $query2) && mysqli_query($con, $query3)) {
                echo '<script>alert("Deaprtment addtion successful.");</script>';            
            } else {
                echo '<script>alert("Deaprtment addtion failed.");</script>';
            }
        }
        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Department</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
    <script>
    function validateForm() {
        var departmentName = document.forms["myForm"]["name"].value;
        var departmentEmail = document.forms["myForm"]["email"].value;
        var departmentPass = document.forms["myForm"]["pass"].value;
        var headName = document.forms["myForm"]["hName"].value;
        var headEmail = document.forms["myForm"]["hEmail"].value;
        var headPass = document.forms["myForm"]["hPass"].value;

        // Regular expressions for email and contact number validation
        var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        var contactNumberRegex = /^[0-9]{10}$/; // Change this regex as needed

        if (departmentName.trim() == "" || departmentEmail.trim() == "" || departmentPass.trim() == "" ||
            headName.trim() == "" || headEmail.trim() == "" || headPass.trim() == "") {
            alert("Please fill in all fields.");
            return false;
        }

        if (!emailRegex.test(departmentEmail) || !emailRegex.test(headEmail)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // You can add more specific validation for contact numbers here
        if (!contactNumberRegex.test(departmentContact) || !contactNumberRegex.test(headContact)) {
            alert("Please enter a valid contact number.");
            return false;
        }

        return true;
    }
</script>
In 
</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">

    <div style="align-items: center; background-color: #ac8a8f; padding: 30px; justify-content: space-between; border-radius: 0.5rem;">
        <div style="margin: auto; background-color: aliceblue; width: fit-content; padding: 20px; border-radius: 0.5rem;" >
            <form id="myForm" action="" method="post" onsubmit="return validateForm();">
                <input type="text" name="name" placeholder="Department name" class="input-fields"><br><br>
                <input type="text" name="email" placeholder="Department e-mail" class="input-fields"><br><br>
                <input type="text" name="pass" placeholder="Department Password" class="input-fields"><br><br>
                <input type="text" name="hName" placeholder="Head name" class="input-fields"><br><br>
                <input type="text" name="hEmail" placeholder="Head e-mail" class="input-fields"><br><br>
                <input type="text" name="hPass" placeholder="Head password" class="input-fields"><br><br>
                <div style="text-align: center; margin-top: 0px;">
                    <input type="submit" class="action-buttons" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
