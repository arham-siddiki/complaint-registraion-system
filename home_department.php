<?php
    session_start();
    if(isset($_SESSION["userId"])) { 
        if (isset($_POST["logout"])) {
            session_destroy();
            header("Location: index.php");
            exit();
        }
        $loginId = $_SESSION["userId"];
        $role = $_SESSION["role"];
        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM ".$role." WHERE email = '$loginId'";
        $result = mysqli_query($con, $checkSql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        // echo '<script>window.alert("'.$name.'");</script>';
    }
    else {
        $redirectUrl = 'index.php';
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
    }
?>


<html>

<head>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216);">    
    <div>
        <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
            <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left:0px; padding: 0px;">Hello department - <?php echo $name; ?></p>
            <form action="" method="post" style="margin-bottom: 0px;">
                <input type="submit" name="logout" class="action-buttons" value="LOG OUT">
            </form>
        </div>
        <div style="padding: 15px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
            <div style="width: 60%; text-align: center;">
                <img src="./resources/images/admin_home.jpg" style="max-width: 70%;">
            </div>            
            <div style="padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; width: 50%;">
                <a href="complaint_department.php?mode=1"><button class="action-buttons" style="margin-bottom: 50px; min-width: 400px;">CURRENT COMPLAINTS</button></a>
                <a href="complaint_department.php?mode=2"><button class="action-buttons" style="margin-bottom: 50px; min-width: 400px;">PAST COMPLAINTS</button></a>
                <a href="add_employee.php"><button class="action-buttons" style="margin-bottom: 50px; min-width: 400px;">ADD EMPLOYEE</button></a>
                <a href="manage_employee.php"><button class="action-buttons" style=" min-width: 400px;">MANAGE EMPLOYEES</button></a>
            </div>
        </div>
    </div>
</body>
</html>