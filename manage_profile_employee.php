<?php
    session_start();
    if(isset($_SESSION["userId"])) {
        $loginId = $_SESSION["userId"];
        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM employee WHERE email = '$loginId'";
        $result = mysqli_query($con, $checkSql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];    
        $department = $row["department"];    
        $emp_id = $row["emp_id"];
        $cont = $row["contact"];
        // echo '<script>alert("'.$depName.'");</script>';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $contact = $_POST["contact"];

            $sql = "UPDATE employee SET contact='$contact' WHERE email='$loginId'";
            $result = mysqli_query($con, $sql);
            echo '<script>alert("Contact updated successfully.");</script>';

            mysqli_close($con);
        } 
    } else {
        $redirectUrl = 'sign_in.php';
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">

    <div style="align-items: center; background-color: #ac8a8f; padding: 30px; justify-content: space-between; border-radius: 0.5rem;">
        <div style="margin: auto; background-color: aliceblue; width: fit-content; padding: 20px; border-radius: 0.5rem;" >
            <form id="myForm" action="" method="post"><br>                
                Name : <?php echo $name; ?><br><br>
                Email : <?php echo $loginId; ?><br><br>
                Department : <?php echo $department; ?><br><br>                
                Employee ID : <?php echo $emp_id; ?><br><br>
                Contact : <input type="text" name="contact" placeholder="Contact" value="<?php echo $cont; ?>"><br><br>
                <div style="text-align: center; margin-top: 0px;">
                    <input type="submit" class="action-buttons" value="UPDATE" style="font-size:18px; padding: 10px; ">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
