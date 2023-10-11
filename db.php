<?php
    // Create a connection
    $conn = new mysqli('localhost', 'root', '', '');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $databaseName = "crs_demo";
    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";

    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        $createDatabaseQuery = "CREATE DATABASE $databaseName";
        if ($conn->query($createDatabaseQuery) === TRUE) {
            echo "Database created successfully. ";
            mysqli_select_db($conn, $databaseName);

            // Load and execute the SQL file
            $sqlFile = "./crs_demo.sql"; // Provide the path to your exported SQL file

            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                // echo "SQL file content: <pre>$sql</pre>";
                if ($conn->multi_query($sql) === TRUE) {
                    echo " Data populated successfully";
                } else {
                    echo "Error importing database: " . $conn->error;
                }
            } else {
                echo "SQL file not found.";
            }
        }
    } else {
        // echo "Database already exists";
    }

    // Close the connection
    $conn->close();
?>


<?php

    // $conn = new mysqli('localhost', 'root', '', '');

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // $databaseName = "crs_demo";
    // $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";

    // $result = $conn->query($query);

    // if ($result->num_rows == 0) {
    //     // The database doesn't exist; you can create it
    //     $createDatabaseQuery = "CREATE DATABASE $databaseName";
    //     if ($conn->query($createDatabaseQuery) === TRUE) {
    //         echo "Database created successfully";
    //         mysqli_select_db($conn, $databaseName);

    //         //creating tables

    //         $table1 = "CREATE TABLE `user_role` (
    //             `email` varchar(40) NOT NULL,
    //             `pass` varchar(20) NOT NULL,
    //             `role` varchar(20) NOT NULL DEFAULT 'citizen',
    //             PRIMARY KEY (`email`)
    //         )";

    //         $table2 = "CREATE TABLE `admin` (
    //             `email` varchar(40) NOT NULL,
    //             `name` varchar(40) DEFAULT NULL,
    //             PRIMARY KEY (`email`)
    //         )";

    //         $table3 = "CREATE TABLE `department` (
    //             `name` varchar(40) NOT NULL,
    //             `email` varchar(40) NOT NULL,
    //             `head` varchar(40) NOT NULL,
    //             PRIMARY KEY (`name`)
    //         )";

    //         $table4 = "CREATE TABLE `employee` (
    //             `emp_id` int(11) NOT NULL AUTO_INCREMENT,
    //             `name` varchar(40) NOT NULL,
    //             `email` varchar(40) NOT NULL,
    //             `contact` int(15) NOT NULL,
    //             `department` varchar(40) NOT NULL,
    //             PRIMARY KEY (`emp_id`),
    //             KEY `test` (`department`),
    //             CONSTRAINT `test` FOREIGN KEY (`department`) REFERENCES `department` (`name`)
    //         )";

    //         $table5 = "CREATE TABLE `citizen` (
    //             `name` varchar(40) NOT NULL,
    //             `contact` int(15) DEFAULT NULL,
    //             `email` varchar(40) NOT NULL,
    //             PRIMARY KEY (`email`)
    //         )";

    //         $table6 = "CREATE TABLE `complaints` (
    //             `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
    //             `name` varchar(20) NOT NULL,
    //             `contact` int(11) NOT NULL,
    //             `email` varchar(36) NOT NULL,
    //             `issue` text NOT NULL,
    //             `status` varchar(40) NOT NULL DEFAULT 'pending',
    //             `department` varchar(40) NOT NULL,
    //             `assigned_to` varchar(30) NOT NULL DEFAULT 'none',
    //             `employee_feedback` text DEFAULT 'null',
    //             `citizen_feedback` text NOT NULL DEFAULT 'null',
    //             PRIMARY KEY (`complaint_id`),
    //             KEY `email` (`email`),
    //             KEY `department` (`department`),
    //             CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`email`) REFERENCES `citizen` (`email`),
    //             CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`name`)
    //         )";

    //         if ($conn->query($table1) === TRUE && $conn->query($table2) === TRUE && $conn->query($table3) === TRUE && 
    //             $conn->query($table4) === TRUE && $conn->query($table5) === TRUE && $conn->query($table6) === TRUE) {
    //             echo "All tables created successfully";
    //         } else {
    //             echo "Error creating tables : " . $conn->error;
    //         }

    //     } else {
    //         echo "Error creating database: " . $conn->error;
    //     }
    // } else {        
    //     // echo "Database already exists";
    // }

    // $conn->close();

?>