<!DOCTYPE html>
<html>
<head>
    <title>Complaints</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>
<body style="padding: 10px; background-color: rgb(223, 216, 216);">
    <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left:0px; padding: 0px;">Here are complaints made by you.</p>
    </div>
    <?php

        session_start();
        if(isset($_SESSION["userId"])) {     
            $loginId = $_SESSION["userId"];
            $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        } else {
            $redirectUrl = 'sign_in.php';
            echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
        }
        
        $sql = "SELECT * FROM complaints WHERE email = '$loginId'";
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
                <th>Complaint id</th>                  
                <th>Issue</th> 
                <th>Status</th>
                <th>Department</th>
                <th>Employee Feedback</th>
                <th>Citizen Feedback</th>
                <th>Actions</th>
            </tr>';

        $mode=$_GET['mode'];
        $count=1;
        while ($row = mysqli_fetch_assoc($rs)) {
            $status = $row['status'];
            if($mode==1 && ($status=='resolved' || $status=='unresolved'))
                continue;
            if($mode==2 && ($status!='resolved' && $status!='unresolved'))
                continue;
            $id = $row['complaint_id'];            
            $issue = $row['issue'];            
            $department = $row['department'];
            $assigned_to = $row['assigned_to'];
            $employee_feedback = $row['employee_feedback'];
            $citizen_feedback = $row['citizen_feedback'];

            echo '<tr>
                <td>' . $count . '</td>                
                <td>' . $id . '</td>                
                <td>' . $issue . '</td>
                <td>' . $status . '</td>
                <td>' . $department . '</td>
                <td>' . $employee_feedback . '</td>';            

            if ($citizen_feedback != "null" && $citizen_feedback != "") {
                echo '<td><div style="display:flex; margin:auto; justify-content: space-between;">' . $citizen_feedback .
                '<button class="edit-cit-feedback-btn" data-id=' . $id . ' style="margin-left: 15px;">Reset</button>
                </div></td>';

            } else {
                echo '<td><div style="display: flex;">
                    <textarea row="2" class="cit-feedback" style="margin-right: 15px;"></textarea>
                    <button class="cit-feedback-btn" data-id=' . $id . '>Submit</button></div></td>';
            }

            echo '<td><button class="delete-complaint" data-id=' . $id . '>Delete</button>
                    <button class="re-open" data-id=' . $id . '>Re-open</button></td>';
            echo '</tr>';
            $count++;
        }
        echo '</div>';
    ?>
</body>
</html>

<script>
    function handleCitFeedbackClick(event) {
        var id = event.target.getAttribute("data-id");
        var val = event.currentTarget.parentNode.querySelector(".cit-feedback").value;

        // window.alert("Citizen feedback button clicked with ID: " + val);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'cit-feedback', value: val })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error!! please refresh page. ', error);
        });
        location.reload();
    }

    function handleEditCitFeedbackClick(event) {
        var id = event.target.getAttribute("data-id");

        // window.alert("Edit citizen feedback button clicked with ID: " + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'edit-cit-feedback', value: "" })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error!! please refresh page. ', error);
        });
        location.reload();
    }

    function handleDeleteComplaintClick(event) {
        var id = event.target.getAttribute("data-id");

        // window.alert("delete button clicked with ID: " + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'delete-complaint', value: "" })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error!! please refresh page. ', error);
        });
        location.reload();
    }

    function handleReopenClick(event) {
        var id = event.target.getAttribute("data-id");

        // window.alert("reopen button clicked with ID: " + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'reopen', value: "" })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error!! please refresh page. ', error);
        });
        location.reload();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var citFeedbackButtons = document.querySelectorAll(".cit-feedback-btn");        
        var editCitFeedbackButtons = document.querySelectorAll(".edit-cit-feedback-btn");        
        var deleteComplaintButtons = document.querySelectorAll(".delete-complaint");
        var reopenComplaintButton = document.querySelectorAll(".re-open");        

        citFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleCitFeedbackClick);
        });

        editCitFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleEditCitFeedbackClick);
        });

        deleteComplaintButtons.forEach(function(button) {
            button.addEventListener("click", handleDeleteComplaintClick);
        });

        reopenComplaintButton.forEach(function(button) {
            button.addEventListener("click", handleReopenClick);
        });
        // location.reload();
    });
</script>
