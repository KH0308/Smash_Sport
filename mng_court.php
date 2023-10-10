<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Booking</title>
        <?php include 'mng_clc_rfnd_book.php'; ?>
        <?php
        include 'mng_court_action.php'; // Include the database actions
        $courtData = fetchCourtInformation(); // Fetch court information
        ?>
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
                        <li><a href="pending_clc_book.php">Pending Refund</a></li>
                        <li class="active"><a href="mng_court.php">Court Management</a></li>
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

        <div class="court--wrapper">
            <h3 class="main--title">Badminton Court Management</h3>
            <div class="courts-container">
                <?php
                foreach ($courtData as $court) {
                    // Generate court HTML dynamically using data from $court
                    echo '<div class="court ' . $court['courtStatus'] . '" id="court' . $court['id'] . '" 
                    onclick="toggleCourtStatus(' . $court['id'] . ', \'' . $court['StaffIncharge'] . '\')">';
                    echo 'Court ' . $court['courtNum'] . '<br>' . $court['courtStatus'];
                    if (!empty($court['descStatus'])) {
                        echo '<br>Description: ' . $court['descStatus'];
                    }
                    echo '<br>Update by: ' . $court['StaffIncharge'];
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <script>
            // Function to toggle the status of a court
            function toggleCourtStatus(courtId, satffIncharge) {
                var court = document.getElementById('court' + courtId);
                var newStatus = '';
                var newIncharge = satffIncharge;

                if (court.classList.contains('Closed')) {
                    newStatus = 'Open';
                } else if (court.classList.contains('Open')) {
                    newStatus = 'Closed';
                }

                if (newStatus === 'Closed') {
                    var description = prompt('Provide a description for the status change to '+newStatus+':');
                    if (description === null) {
                        // User canceled the prompt, do not change the status
                        return;
                    }
                    if (description.trim() === '') {
                        alert('Description cannot be empty. Status not changed.');
                        return;
                    }

                    // Create a new XMLHttpRequest to update the court status field
                    var updateXHR = new XMLHttpRequest();
                    updateXHR.open('POST', 'mng_court_action.php', true);
                    updateXHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    updateXHR.onreadystatechange = function () {
                        if (updateXHR.readyState === XMLHttpRequest.DONE) {
                            if (updateXHR.status === 200) {
                                // Update the court's visual status and text
                                court.classList.remove('Open', 'Closed');
                                court.classList.add(newStatus);
                                court.innerHTML = 'Court ' + courtId + '<br>' + newStatus + '<br>' +'Description: ' + description
                                + '<br>' +'Update by: ' + newIncharge;
                                console.log('Court status updated successfully.');
                            } else {
                                console.error('Failed to update court status.');
                            }
                        }
                    };

                    // Construct the query string for POST data
                    var updateData = 'courtId=' + courtId + '&newStatus=' + newStatus + '&description=' + description;
                    updateXHR.send(updateData);
                }
                else {
                    // Create a new XMLHttpRequest to update the court status field
                    var updateXHR = new XMLHttpRequest();
                    var defDesc = 'On Services';
                    updateXHR.open('POST', 'mng_court_action.php', true);
                    updateXHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    updateXHR.onreadystatechange = function () {
                        if (updateXHR.readyState === XMLHttpRequest.DONE) {
                            if (updateXHR.status === 200) {
                                // Update the court's visual status and text
                                court.classList.remove('Open', 'Closed');
                                court.classList.add(newStatus);
                                court.innerHTML = 'Court ' + courtId + '<br>' + newStatus + '<br>' +'Description: ' + defDesc
                                + '<br>' +'Update by: ' + newIncharge;
                                console.log('Court status updated successfully.');
                            } else {
                                console.error('Failed to update court status.');
                            }
                        }
                    };

                    // Construct the query string for POST data
                    var updateData = 'courtId=' + courtId + '&newStatus=' + newStatus + '&description=' + defDesc;
                    updateXHR.send(updateData);
                }
            }
        </script>
    </body>
</html>