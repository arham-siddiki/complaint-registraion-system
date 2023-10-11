<?php
    require 'db.php';
?>

<html>

<head>
    <title>Home</title>
    <link href="./basic_styles.css" type="text/css" rel="stylesheet">
</head>

<body style="padding: 10px; background-color: rgb(223, 216, 216); color: rgb(91, 84, 84);">    
    <div>
        <div style="padding: 15px 15px; margin-bottom: 20px; display: flex; justify-content: space-between; background-color: aliceblue; border-radius: 0.5rem;">
            <p style="font-size: 40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; margin: auto; margin-left: 0px;">CITY GRIEVANCE HUB</p>
            <div style="display: flex;">
                <a href="./sign_in.php"><button class="action-buttons" style="margin-right: 15px;">LOG IN</button></a>
                <div style="border-left: 1px solid grey;"></div>
                <a href="./sign_up.php"><button class="action-buttons" style="margin-left: 15px;">SIGN UP</button></a>
            </div>
        </div>
        <div style="padding: 15px; display: flex; flex-direction: column; background-color: aliceblue; border-radius: 0.5rem;">
            <div style="align-items: center; display: flex; flex-direction: column;">
                <p style="font-size: 40px; margin: auto; font-family: Arial; font-weight: 600; margin-bottom: 20px;">Our major departments</p>
                <div style="display: flex; justify-content: space-between;">
                    <div class="dep-cards">                        
                        <div>
                            <img src="./resources/logos/health.png" style="max-width: 50%;">
                        </div>
                        <p>Health</p>
                    </div>
                    <div class="dep-cards">                        
                        <div>
                            <img src="./resources/logos/clean.png" style="max-width: 50%;">
                        </div>
                        <p>Cleanliness</p>
                    </div>
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/infra.png" style="max-width: 50%;">
                        </div>
                        <p>Infrastructure</p>
                    </div>
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/other.png" style="max-width: 50%;">
                        </div>
                        <p>Miscellaneous</p>
                    </div>
                </div>
            </div>

            <div style="align-items: center; display: flex; flex-direction: column;">
                <p style="font-size: 40px; margin: auto; font-family: Arial; font-weight: 600; margin-bottom: 20px;">Our services</p>
                <div style="display: flex; justify-content: space-between;">
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/registration.png" style="max-width: 50%;">
                        </div>
                        <p>Complaint registration</p>
                    </div>
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/tracking.png" style="max-width: 50%;">
                        </div>
                        <p>Issue tracking</p>
                    </div>
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/resolving.png" style="max-width: 50%;">
                        </div>
                        <p>Resolving action</p>
                    </div>
                    <div class="dep-cards">
                        <div>
                            <img src="./resources/logos/feedback.png" style="max-width: 50%;">
                        </div>
                        <p>Feedback</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>