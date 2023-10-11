<?php
    session_start();

    if(isset($_SESSION["userId"])) {     
        $email = $_SESSION["userId"];
        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $checkSql = "SELECT * FROM citizen WHERE email = '$email'";
        $result = mysqli_query($con, $checkSql);
        $row = mysqli_fetch_assoc($result);  

        $name = $row['name'];
        $contact = $row['contact'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            $department = $_POST['department'];
            $issue = $_POST['issue'];

            $sql = "INSERT INTO complaints (complaint_id, name, contact, email, department, issue) VALUES ('0', '$name', '$contact', '$email', '$department', '$issue')";

            if(mysqli_query($con, $sql)) {
                echo '<script>alert("Complaint submitted successully.");</script>';
                echo '<script>window.location.href = "home_citizen.php";</script>';
                exit; // Important to terminate script execution after redirection
            }
            else {
                echo '<script>alert("Complaint submission failed.");</script>';
            }
        } 
    } else {
        $redirectUrl = 'sign_in.php';
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Add Complaint</title>
        <link href="./basic_styles.css" type="text/css" rel="stylesheet">
        <script>
            function validateForm() {
                var issue = document.forms["myForm"]["issue"].value;

                if (issue.trim() == "") {
                    alert("Please enter your issue.");
                    return false;
                }

                return true;
            }
        </script>
    </head>

    <body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">

    <div style="align-items: center; background-color: #ac8a8f; padding: 30px; justify-content: space-between; border-radius: 0.5rem;">    
        <div style="margin: auto; background-color: aliceblue; width: fit-content; padding: 20px; border-radius: 0.5rem;" >        
            <div style="padding: 20px;">
                <label style="max-width: 300px;">Following information will be submitted<br> automatically when you submit complaint : </label><br><br>
                <label>Name: <?php echo $name; ?></label><br><br>
                <label>Email: <?php echo $email; ?></label><br><br>
                <label>Contact: <?php echo $contact; ?></label><br><br>
            </div>

            <form id="myForm" action="" method="post" onsubmit="return validateForm();">            
                <textarea type="text" name="issue" placeholder="Write your issue here" class="input-fields" rows="3" cols="20"></textarea><br><br>
                <?php
                    $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
                    $sql = "SELECT name FROM department";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    
                    echo "<td><div style='display: flex; margin: auto; justify-content: space-between;''>
                        <select name='department' class='input-fields'>";
                    foreach ($row as $r) {
                        echo '<option value="' . $r["name"] . '">' . $r['name'] . '</option>';
                    }
                    echo "</select></div></td>";
                ?>                
                <div style="text-align: center; margin-top: 20px;">
                    <input type="submit" class="action-buttons" value="SUBMIT" style="margin-top: 10px;">
                </div>
            </form>
        </div>
    </div>

    </body>

    </html>
