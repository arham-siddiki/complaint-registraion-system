<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $con = mysqli_connect('localhost', 'root', '', 'crs_demo');
    
    // Get data from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $val=$data['value'];

    // Handle different actions
    if (isset($data['action'])) {
        $action = $data['action'];
        switch ($action) {
            case 'status':
                $sql = "UPDATE complaints SET `status`='$val' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "status updated successfully";
                break;
            case 'assign':
                $sql = "UPDATE complaints SET assigned_to='$val' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Assignment successful";
                break;
            case 'reassign':
                $sql = "UPDATE complaints SET assigned_to='none' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Reassignment successful";
                break;
            case 'emp-feedback':
                $sql = "UPDATE complaints SET employee_feedback='$val' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Employee feedback submitted";
                break;
            case 'edit-emp-feedback':
                $sql = "UPDATE complaints SET employee_feedback='null' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Employee feedback reset";
                break;
            case 'cit-feedback':
                $sql = "UPDATE complaints SET citizen_feedback='$val' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Citizen feedback submitted";
                break;
            case 'edit-cit-feedback':
                $sql = "UPDATE complaints SET citizen_feedback='null' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Citizen feedback reset";
                break;
            case 'delete-complaint':
                $sql = "DELETE FROM complaints WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Complaint deleted successfully.";
                break;
            case 'reopen':
                $sql = "UPDATE complaints SET status='re-opened' WHERE complaint_id='$id'";
                $rs = mysqli_query($con, $sql);
                $message = "Complaint re-opened successfully.";
                break;
            case 'removeEmp':
                $sql1 = "UPDATE complaints SET assigned_to='none' WHERE assigned_to='$val'";
                $sql2 = "DELETE FROM employee WHERE emp_id='$id'";
                $sql3 = "DELETE FROM user_role WHERE email='$val'";
                $rs = mysqli_query($con, $sql1);
                $rs = mysqli_query($con, $sql2);
                $rs = mysqli_query($con, $sql3);
                $message = "Employee removed successfully.";
                break;
            default:
                $message = "Unknown action";
                break;
        }

        // $message = $data['action'];
        // Respond with a message
        $response = ['message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    mysqli_close($con);
}
?>
