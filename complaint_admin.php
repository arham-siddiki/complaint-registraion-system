<!DOCTYPE html>
<html>
<head>
    <title>Complaints</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>
<body style="padding: 10px; background-color: rgb(223, 216, 216);">
    <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
        <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left:0px; padding: 0px;">Here are all complaints registered in system.</p>
    </div>
    <?php
        session_start();
        if(isset($_SESSION["userId"])) {     
            $loggedIn = $_SESSION["userId"];
        } else {
            $redirectUrl = 'sign_in.php';
            echo '<script>window.location.href = "'.$redirectUrl.'";</script>';                  
        }

        $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
        $sql = "SELECT * FROM complaints";
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
                <th>Name</th> 
                <th>Contact</th> 
                <th>E-mail</th> 
                <th>Issue</th> 
                <th>Status</th>
                <th>Department</th>
                <th>Assigned to</th>
                <th>Employee Feedback</th>
                <th>Citizen Feedback</th>
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
            $name = $row['name'];
            $contact = $row['contact'];
            $email = $row['email'];
            $issue = $row['issue'];            
            $department = $row['department'];
            $assigned_to = $row['assigned_to'];
            $employee_feedback = $row['employee_feedback'];
            $citizen_feedback = $row['citizen_feedback'];

            echo '<tr>
                <td>' . $count . '</td>
                <td>' . $id . '</td>
                <td>' . $name . '</td>
                <td>' . $contact . '</td>
                <td>' . $email . '</td>
                <td>' . $issue . '</td>
                <td>' . $status . '</td>
                <td>' . $department . '</td>
                <td>' . $assigned_to . '</td>
                <td>' . $employee_feedback . '</td>
                <td>' . $citizen_feedback . '</td></tr>';
            $count++;
        }
        echo '</div>';
    ?>
</body>
</html>

<script>
    function handleStatusClick(event) {
        var id = event.target.getAttribute("data-id");
        var val = event.currentTarget.parentNode.querySelector(".status").value;

        // window.alert("status button clicked with ID: " + val + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'status', value: val })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error:', error);
        });
        location.reload();
    }

    function handleAssignClick(event) {
        var id = event.target.getAttribute("data-id");
        var val = event.currentTarget.parentNode.querySelector(".employeeSelect").value;

        // window.alert("assign button clicked with ID: " + val + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'assign', value: val })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error:', error);
        });
        location.reload();
    }

    function handleReassignClick(event) {
        var id = event.target.getAttribute("data-id");
        // window.alert("Reassign button clicked with ID: " + id);

        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'reassign', value:"" })
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

    function handleEmpFeedbackClick(event) {
        var id = event.target.getAttribute("data-id");
        var val = event.currentTarget.parentNode.querySelector(".emp-feedback").value;

        // window.alert("Feedback button clicked with ID: " + val);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'emp-feedback', value: val })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error:', error);
        });
        location.reload();
    }

    function handleEditEmpFeedbackClick(event) {
        var id = event.target.getAttribute("data-id");

        // window.alert("Edit feedback button clicked with ID: " + id);
        fetch('assign.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, action: 'edit-emp-feedback', value: "" })
        })
        .then(response => response.json())
        .then(data => {
            window.alert(data.message);
        })
        .catch(error => {
            window.alert('Error:', error);
        });
        location.reload();
    }

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
            window.alert('Error:', error);
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
            window.alert('Error:', error);
        });
        location.reload();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var statusButtons = document.querySelectorAll(".status-btn");
        var assignButtons = document.querySelectorAll(".assign-btn");
        var reassignButtons = document.querySelectorAll(".reassign-btn");
        var empFeedbackButtons = document.querySelectorAll(".emp-feedback-btn");        
        var editEmpFeedbackButtons = document.querySelectorAll(".edit-emp-feedback-btn");        
        var citFeedbackButtons = document.querySelectorAll(".cit-feedback-btn");        
        var editCitFeedbackButtons = document.querySelectorAll(".edit-cit-feedback-btn");        

        statusButtons.forEach(function(button) {
            button.addEventListener("click", handleStatusClick);
        });

        assignButtons.forEach(function(button) {
            button.addEventListener("click", handleAssignClick);
        });

        reassignButtons.forEach(function(button) {
            button.addEventListener("click", handleReassignClick);
        });

        empFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleEmpFeedbackClick);
        });

        editEmpFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleEditEmpFeedbackClick);
        });

        citFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleCitFeedbackClick);
        });

        editCitFeedbackButtons.forEach(function(button) {
            button.addEventListener("click", handleEditCitFeedbackClick);
        });
        // location.reload();
    });
</script>
