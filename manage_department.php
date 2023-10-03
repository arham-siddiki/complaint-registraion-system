<!DOCTYPE html>
<html>
<head>
    <title>Complaints</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>
<body style="padding: 10px; background-color: rgb(223, 216, 216);">
    <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left:0px; padding: 0px;">These are the departments in your municipality.</p>
    </div>
    <?php
        session_start();
        if(isset($_SESSION["userId"])) { 
            $loginId = $_SESSION["userId"];                        
        }
        else {
            $redirectUrl = 'index.php';
            echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
        }
        
        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $sql = "SELECT * FROM department";
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
                <th>Department name</th> 
                <th>Department email</th> 
                <th>Department head</th>                 
            </tr>';

        $count=1;
        while ($row = mysqli_fetch_assoc($rs)) {
            $name = $row['name'];
            $email = $row['email'];            
            $head = $row['head'];

            echo '<tr>
                <td>' . $count . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $head . '</td>
                </tr>';            
            $count++;        
        }
        echo '</div>';
    ?>
</body>
</html>

