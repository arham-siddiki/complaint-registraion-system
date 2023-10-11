<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>
<body style="padding: 10px; background-color: rgb(223, 216, 216);">
    <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left:0px; padding: 0px;">These are the employees in your department.</p>
    </div>
    <?php
        session_start();
        if(isset($_SESSION["userId"])) { 
            $loginId = $_SESSION["userId"];  
            $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
            $checkSql = "SELECT * FROM department WHERE email = '$loginId'";
            $result = mysqli_query($con, $checkSql);
            $row = mysqli_fetch_assoc($result);
            $name = $row["name"];  
            $head = $row["head"];                    
        }
        else {
            $redirectUrl = 'index.php';
            echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
        }
        
        $sql = "SELECT * FROM employee WHERE department='$name'";
        $rs = mysqli_query($con, $sql);

        echo '<div style="padding:10px; background-color: aliceblue; border-radius:0.5rem;">';
        echo '<style>
                th, td {                                               
                    border: 1px solid white;
                }
            </style>
            <table cellspacing="8" cellpadding="10" class="table-style"> 
            <tr>
                <th>S. no.</th> 
                <th>Employee ID</th>
                <th>Employee name</th> 
                <th>Employee email</th>  
                <th>Action</th>                  
            </tr>';

        $count=1;
        while ($row = mysqli_fetch_assoc($rs)) {
            $emp_id = $row['emp_id'];
            $name = $row['name'];
            $email = $row['email'];                        

            echo '<tr>
                <td>' . $count . '</td>
                <td>' . $emp_id . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>';
                if($name!=$head)
                    echo '<td><button style="margin-left: 10px;" class="remove-btn" data-id='.$emp_id.'>Remove</button></td>';
                else
                    echo '<td style="text-align: center;">Head</td>';
            echo '</tr>';
            $count++;
        }
        echo '</div>';
    ?>
</body>
</html>


<script>
    function handleRemoveEmp(event) {
        var id = event.target.getAttribute("data-id");
        var name="<?php echo $email ?>";
        
        // window.alert("Reassign button clicked with ID: " + name);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'removeEmp', value:name })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
            location.reload();
        })
        .catch(error => {
            window.alert('Error:', error);
        });        
    }

    document.addEventListener('DOMContentLoaded', function() {
        var removeEmp = document.querySelectorAll(".remove-btn");
        
        removeEmp.forEach(function(button) {
            button.addEventListener("click", handleRemoveEmp);
        });
        // location.reload();
    });
</script>
