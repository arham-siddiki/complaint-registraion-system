<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    // Check if the user is logged in (user ID is set in the session)
    if(isset($_SESSION["userId"])) {
        $loginId = $_SESSION["userId"];
        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM department WHERE email = '$loginId'";
        $result = mysqli_query($con, $checkSql);
        $row = mysqli_fetch_assoc($result);
        $depName = $row["name"];    
        // echo '<script>alert("'.$depName.'");</script>';
    
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $pass = $_POST["pass"];

        $checkSql = "SELECT * FROM employee WHERE email = '$email'";
        $result = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("An employee with the same ID already exists.");</script>';
        } else {
            $query1 = "INSERT INTO employee (name, email, contact, department) VALUES ('$name', '$email', '$contact', '$depName')";
            $query2 = "INSERT INTO user_role (email, pass, role) VALUES ('$email', '$pass', 'employee')";
            if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
                echo '<script>alert("Employee addtion successful.");</script>';
            } else {
                echo '<script>alert("Employee addtion failed.");</script>';
            }
        }
        mysqli_close($con);
    } else {
        $redirectUrl = 'sign_in.php';
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Employee</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
    <script>
    function validateForm() {
        var name = document.forms["myForm"]["name"].value;
        var contact = document.forms["myForm"]["contact"].value;
        var email = document.forms["myForm"]["email"].value;
        var pass = document.forms["myForm"]["pass"].value;

        // Regular expressions for email and contact number validation
        var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        var contactNumberRegex = /^[0-9]{10}$/; // Change this regex as needed

        if (name.trim() == "") {
            alert("Please enter the employee name.");
            return false;
        }
        if (contact.trim() == "") {
            alert("Please enter the employee contact.");
            return false;
        }
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
        if (!contactNumberRegex.test(contact)) {
            alert("Please enter a valid 10-digit contact number.");
            return false;
        }
        if (pass.trim() == "") {
            alert("Please enter the employee password.");
            return false;
        }

        // You can add more specific validation rules as needed

        return true;
    }
</script>

</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">

    <div style="align-items: center; background-color: #ac8a8f; padding: 30px; justify-content: space-between; border-radius: 0.5rem;">
        <div style="margin: auto; background-color: aliceblue; width: fit-content; padding: 20px; border-radius: 0.5rem;" >
            <form id="myForm" action="" method="post" onsubmit="return validateForm();">
                <input type="text" name="name" placeholder="Employee name" class="input-fields"><br><br>
                <input type="text" name="contact" placeholder="Employee contact" class="input-fields"><br><br>
                <input type="text" name="email" placeholder="Employee email" class="input-fields"><br><br>
                <input type="text" name="pass" placeholder="Employee password" class="input-fields"><br><br>
                <div style="text-align: center; margin-top: 0px;">
                    <input type="submit" class="action-buttons" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
