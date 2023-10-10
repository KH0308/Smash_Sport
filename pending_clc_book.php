<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'external_lib/PHPMailer-master/src/Exception.php';
require 'external_lib/PHPMailer-master/src/PHPMailer.php';
require 'external_lib/PHPMailer-master/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Booking</title>
        <?php include 'mng_clc_rfnd_book.php'; ?>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    </head>

    <body class="bdyDB">
        <div class="sidebar">
            <div class="logo"><img src="img/SMASH_SPORT_LOGO.png" alt="smash sport logo"></div>
            <ul class="menu">
                <li>
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
                <li class="has-submenu active">
                    <a>
                        <i class="fas fa-tasks"></i>
                        <span>Booking</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="manage_book.php">Booking List</a></li>
                        <li class="active"><a href="pending_clc_book.php">Pending Refund</a></li>
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

        <!--table cancel booking-->
        <div class="main--content">
            <div class="tabular--wrapper">
                <h3 class="main--title">Pending Refund Booking List</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Num.</th>
                                <th>Book ID</th>
                                <th>User ID</th>
                                <th>Book Date</th>
                                <th>Pay. ID</th>
                                <th>Pay. Date</th>
                                <th>Pay. Time</th>
                                <th>Pay. Option</th>
                                <th>Total Value</th>
                                <th>Book Status</th>
                                <th>Pay. Status</th>
                            </tr>
                        </thead>
                        <tbody id="booking-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["bookID"] . "</td>";
                                echo "<td>" . $row["userID"] . "</td>";
                                echo "<td>" . $row["dateBook"] . "</td>";
                                echo "<td>" . $row["payID"] . "</td>";
                                echo "<td>" . $row["payDate"] . "</td>";
                                echo "<td>" . $row["payTime"] . "</td>";
                                echo "<td>" . $row["payOpt"] . "</td>";
                                echo "<td>" . $row["totalPay"] . "</td>";
                                
                                switch ($row["status"]) {
                                    case 'active':
                                        echo "<td style='color: green; text-transform: capitalize; font-weight: 500;'>" . $row["status"] . "</td>";
                                        break;
                                    case 'cancel':
                                        echo "<td style='color: red; text-transform: capitalize; font-weight: 500;'>" . $row["status"] . "</td>";
                                        break;
                                    case 'pass':
                                        echo "<td style='color: yellow; text-transform: capitalize; font-weight: 500;'>" . $row["status"] . "</td>";
                                        break;
                                    default:
                                        echo "<td>" . $row["status"] . "</td>";
                                        break;
                                }
                            
                                switch ($row["stsPay"]) {
                                    case 'Valid':
                                        echo "<td style='color: green; font-weight: 500;'>" . $row["stsPay"] . "
                                        <button style='font-weight: 600;' onclick='openRefundPopup(\"$row[userID]\", \"$row[payID]\", \"$row[totalPay]\")'>REFUND</button></td>";
                                        break;
                                    case 'Expired':
                                        echo "<td style='color: red; font-weight: 500;'>" . $row["stsPay"] . "
                                        <button style='font-weight: 600;' onclick='openRefundPopup(\"$row[userID]\", \"$row[payID]\", \"$row[totalPay]\")'>REFUND</button></td>";
                                        break;
                                    case 'Pending':
                                        echo "<td style='color: yellow; font-weight: 500;'>" . $row["stsPay"] . "
                                        <button style='font-weight: 600;' onclick='openRefundPopup(\"$row[userID]\", \"$row[payID]\", \"$row[totalPay]\")'>REFUND</button></td>";
                                        break;
                                    default:
                                        echo "<td style='font-weight: 500;'>" . $row["stsPay"] . "</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No records found.</td></tr>";
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
                    <h2>Refund Email</h2>
                    <form id="refundForm" onsubmit="sendRefundEmail(event); return false;">
                        <div class="form-group">
                            <label for="refundPayID">Payment Info:</label>
                            <input type="text" id="refundPayID" name="refundPayID" required><br>
                        </div>

                        <div class="form-group">
                            <label for="refundTo">To:</label>
                            <input type="text" id="refundTo" name="refundTo" required><br>
                        </div>

                        <div class="form-group">
                            <label for="refundSubject">Subject:</label>
                            <input type="text" id="refundSubject" name="refundSubject" required><br>
                        </div>

                        <div class="form-group">
                            <label for="refundBody">Message:</label>
                            <textarea id="refundBody" name="refundBody" required></textarea><br>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Send Refund Email">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function openRefundPopup(userID, payID, totalPay) {
                // Set the form fields with default values or any specific information
                document.getElementById('refundPayID').value = payID;
                document.getElementById('refundTo').value = userID;
                document.getElementById('refundSubject').value = 'Refund Information';
                document.getElementById('refundBody').value = 'Transaction ID: ' + payID +' \nTotal Refund Amount: RM' + totalPay;

                // Show the popup
                document.getElementById('refundPopup').style.display = 'block';
            }

            function closeRefundPopup() {
                // Close the popup
                document.getElementById('refundPopup').style.display = 'none';
            }

            function sendRefundEmail(event) {
                // Prevent the default form submission behavior
                event.preventDefault();
                // Get values from the popup form
                var refundTo = document.getElementById('refundTo').value;
                var refundSubject = document.getElementById('refundSubject').value;
                var refundBody = document.getElementById('refundBody').value;

                // Validate the subject and body (you can add more validation)
                if (!refundTo || !refundSubject || !refundBody) {
                    alert('Please fill out all fields in the refund form.');
                    return;
                }

                // Create and send the email
                var userID = refundTo;
                var Subject = refundSubject;
                var Body = refundBody;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_refund_email.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Update the stsPay field in the database to 'Refund in progress'
                            var payID = document.getElementById('refundPayID').value; // Add an input field with the payID
                            updateStsPayToRefundInProgress(payID);

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

            function updateStsPayToRefundInProgress(payID) {
                // Create a new XMLHttpRequest to update the stsPay field
                var updateXHR = new XMLHttpRequest();
                updateXHR.open('POST', 'update_stspay.php', true);
                updateXHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                updateXHR.onreadystatechange = function () {
                    if (updateXHR.readyState === XMLHttpRequest.DONE) {
                        if (updateXHR.status === 200) {
                            console.log('stsPay updated to "Refund in progress"');
                        } else {
                            console.error('Failed to update stsPay to "Refund in progress".');
                        }
                    }
                };
                
                var updateData = 'payID=' + payID;
                updateXHR.send(updateData);
            }
        </script>
    </body>
</html>