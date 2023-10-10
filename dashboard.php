<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Dashboard</title>
        <?php include 'dashboard_action.php'; ?>
        <?php include 'dash_feed_action.php'; ?>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'external_lib/PHPMailer-master/src/Exception.php';
        require 'external_lib/PHPMailer-master/src/PHPMailer.php';
        require 'external_lib/PHPMailer-master/src/SMTP.php';
        ?>
    </head>

    <body class="bdyDB">
        <div class="sidebar">
            <div class="logo"><img src="img/SMASH_SPORT_LOGO.png" alt="smash sport logo"></div>
            <ul class="menu">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="has-submenu">
                    <a>
                        <i class="fas fa-tasks"></i>
                        <span>Booking</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="manage_book.php">Booking List</a></li>
                        <li><a href="pending_clc_book.php">Pending Refund</a></li>
                        <li><a href="mng_court.php">Court Management</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a>
                        <i class="fa-solid fa-bag-shopping" style="color: #000000;"></i>
                        <span>Sport Shop</span>
                    </a>
                    <ul class="submenuShop">
                        <li><a href="shop_mng.php">Sales List</a></li>
                        <li><a href="prd_shop_mng.php">Sport Items Sales</a></li>
                    </ul>
                </li>
                <li>
                    <a href="badminton_exs.php">
                        <img src="img/badminton.png" alt="Badminton Icon" width="26" height="26">
                        <span>Badminton Exercises</span>
                    </a>
                </li>
                <li>
                    <a href="news_mng.php">
                        <i class="fa-regular fa-newspaper" style="color: #000000;"></i>
                        <span>Sport News</span>
                    </a>
                </li>
                <li>
                    <a href="mng_report.php">
                        <i class="fas fa-chart-bar"></i>
                        <span>Report</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Primary</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="user--info">
                    <div class="search--box">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" placeholder="search" id="">
                    </div>
                    <div class="prof--section">
                        <a href="profile.php"> <!-- Add this anchor tag -->
                            <img src="data:image/jpg;base64,<?php echo $sImg; ?>" alt="Profile Picture">
                        </a>
                        <h6><?php echo $sName; ?></h6>
                    </div>
                </div>
            </div>

            <div class="card--container">
                <h1 class="main--title">Today's Data</h1>
                <div class="card--wrapper">
                    <div class="payment--card periwinkle-purple">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Booking Sales</span>
                                <span class="amount--value">RM <?php echo $ttlPayBook; ?></span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card--detail lastUpdate">Last Update:</span>
                    </div>
                    <div class="payment--card light-blue">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Sport Sales</span>
                                <span class="amount--value">RM <?php echo $ttlPayPch; ?></span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card--detail lastUpdate">Last Update:</span>
                    </div>
                    <div class="payment--card rudy-blue">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Total Apps User</span>
                                <span class="amount--value"><?php echo $ttlUser; ?> user</span>
                            </div>
                            <i class="fas fa-users icon"></i>
                        </div>
                        <span class="card--detail lastUpdate">Last Update:</span>
                    </div>
                    <div class="payment--card yilmin-blue">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Total Customer</span>
                                <span class="amount--value"><?php echo $ttlCust; ?> customer</span>
                            </div>
                            <i class="fas fa-users icon"></i>
                        </div>
                        <span class="card--detail lastUpdate">Last Update:</span>
                    </div>
                </div>
                <script src="js/index.js"></script>
            </div>
            <!-- table feedback action -->
            <div class="tabular--wrapper--feedback">
                <h3 class="main--title">Customer Feedback</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Action.</th>
                                <th>Num.</th>
                                <th>Feedback ID</th>
                                <th>User ID</th>
                                <th>Feedback Type</th>
                                <th>Feedback Details</th>
                                <th>FeedBack Status</th>
                            </tr>
                        </thead>
                        <tbody id="booking-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                switch ($row["fbkStatus"]) {
                                    case 'Pending':
                                        echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                        onclick='openRefundPopup(" . $row["id"] . ")'></i></td>";
                                        break;
                                    case 'Responded':
                                        echo "<td><i class='fa-solid fa-pencil' style='display: none;' 
                                        onclick='openRefundPopup(" . $row["id"] . ")'></i></td>";
                                        break;
                                    default:
                                        echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                        onclick='openRefundPopup(" . $row["id"] . ")'></i></td>";
                                        break;
                                }
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["userID"] . "</td>";
                                echo "<td>" . $row["fbkType"] . "</td>";
                                echo "<td>" . $row["fbkDetails"] . "</td>";
                            
                                switch ($row["fbkStatus"]) {
                                    case 'Pending':
                                        echo "<td style='color: gold; font-weight: 500;'>" . $row["fbkStatus"] . "</td>";
                                        break;
                                    case 'Responded':
                                        echo "<td style='color: green; font-weight: 500;'>" . $row["fbkStatus"] . "</td>";
                                        break;
                                    default:
                                        echo "<td style='font-weight: 500;'>" . $row["fbkStatus"] . "</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No records found.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Popup message action -->
            <div class="check " id="check"></div>

            <!-- Popup for refund email -->
            <div class="popup-form" id="refundPopup">
                <div class="popup-content">
                    <span class="popup-close" onclick="closeRefundPopup()">&times;</span>
                    <h2>Feedback Respond Email</h2>
                    <form id="refundForm" onsubmit="sendRefundEmail(event); return false;">
                        <div class="form-group">
                            <label for="feedbackID">Feedback ID:</label>
                            <input type="text" id="feedbackID" name="feedbackID" required readonly><br>
                        </div>

                        <div class="form-group">
                            <label for="feedbackTo">To:</label>
                            <input type="text" id="feedbackTo" name="feedbackTo" required readonly><br>
                        </div>

                        <div class="form-group">
                            <label for="feedbackSubject">Subject:</label>
                            <input type="text" id="feedbackSubject" name="feedbackSubject" required readonly><br>
                        </div>

                        <div class="form-group">
                            <label for="feedbackBody">Message:</label>
                            <textarea id="feedbackBody" name="feedbackBody" required></textarea><br>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Send Feedback Email">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function openRefundPopup(id) {
                // Make an AJAX request to fetch product details based on the ID
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_feedback_details.php?id=' + id, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var feedbackData = JSON.parse(xhr.responseText);

                            // Set the form fields with the fetched product details
                            document.getElementById('feedbackID').value = feedbackData.id;
                            document.getElementById('feedbackTo').value = feedbackData.userID;
                            document.getElementById('feedbackSubject').value = 
                            'Feedback '+ feedbackData.fbkType +' Respond-ID ' + feedbackData.id;
                            document.getElementById('feedbackBody').value = 
                            'Details Feedback: \n\n' + feedbackData.fbkDetails +' \n\nRespond message: \n\n';

                            // Show the edit event form
                            document.getElementById('refundPopup').style.display = 'flex';
                        } else {
                            alert('Failed to fetch feedback details.');
                        }
                    }
                };

                xhr.send();
            }

            function closeRefundPopup() {
                // Close the popup
                document.getElementById('refundPopup').style.display = 'none';
            }

            function sendRefundEmail(event) {
                // Prevent the default form submission behavior
                event.preventDefault();
                // Get values from the popup form
                var feedbackTo = document.getElementById('feedbackTo').value;
                var feedbackSubject = document.getElementById('feedbackSubject').value;
                var feedbackBody = document.getElementById('feedbackBody').value;

                // Validate the subject and body (you can add more validation)
                if (!feedbackTo || !feedbackSubject || !feedbackBody) {
                    alert('Please fill out all fields in the refund form.');
                    return;
                }

                // Create and send the email
                var userID = feedbackTo;
                var Subject = feedbackSubject;
                var Body = feedbackBody;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_feedback_email.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Update the stsPay field in the database to 'Refund in progress'
                            var fbID = document.getElementById('feedbackID').value; // Add an input field with the payID
                            updateStsToRefundInProgress(fbID);

                            //alert('Refund email sent successfully!');
                            closeRefundPopup(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Refund email sent successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to send refund email.');
                        }
                    }
                };

                var data = 'email=' + userID + '&subject=' + Subject + '&body=' + Body;
                xhr.send(data);
            }

            function updateStsToRefundInProgress(fbID) {
                // Create a new XMLHttpRequest to update the stsPay field
                var updateXHR = new XMLHttpRequest();
                updateXHR.open('POST', 'update_fbSts.php', true);
                updateXHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                updateXHR.onreadystatechange = function () {
                    if (updateXHR.readyState === XMLHttpRequest.DONE) {
                        if (updateXHR.status === 200) {
                            console.log('status updated to "Responded"');
                        } else {
                            console.error('Failed to update status to "Responded".');
                        }
                    }
                };
                
                var updateData = 'fbID=' + fbID;
                updateXHR.send(updateData);
            }
        </script>
    </body>
</html>