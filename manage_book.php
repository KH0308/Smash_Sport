<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Booking</title>
        <?php include 'manage_book_action.php'; ?>
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
                        <li class="active"><a href="manage_book.php">Booking List</a></li>
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

        <!--table booking-->

        <div class="tabular--wrapper">
            <h3 class="main--title">Table Booking</h3>
            <div class="filter-options">
                <label for="status-filter">Filter by Status:</label>
                <select id="status-filter">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="cancel">Cancel</option>
                    <option value="pass">Pass</option>
                </select>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Num.</th>
                            <th>Book ID</th>
                            <th>User ID</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Court No</th>
                            <th>Rent Racket</th>
                            <th>Pay. ID</th>
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
                            echo "<td>" . $row["startTime"] . "</td>";
                            echo "<td>" . $row["endTime"] . "</td>";
                            echo "<td>" . $row["courtNo"] . "</td>";
                            echo "<td>" . $row["rentRacket"] . "</td>";
                            echo "<td>" . $row["payID"] . "</td>";

                            switch ($row["status"]) {
                                case 'active':
                                    echo "<td style='color: green; text-transform: capitalize;'>" . $row["status"] . "</td>";
                                    break;
                                case 'cancel':
                                    echo "<td style='color: red; text-transform: capitalize;'>" . $row["status"] . "</td>";
                                    break;
                                case 'pass':
                                    echo "<td style='color: orange; text-transform: capitalize;'>" . $row["status"] . "</td>";
                                    break;
                                default:
                                    echo "<td>" . $row["status"] . "</td>";
                                    break;
                            }
                        
                            switch ($row["stsPay"]) {
                                case 'Valid':
                                    echo "<td style='color: green;'>" . $row["stsPay"] . "</td>";
                                    break;
                                case 'Expired':
                                    echo "<td style='color: red;'>" . $row["stsPay"] . "</td>";
                                    break;
                                case 'Pending':
                                    echo "<td style='color: orange;'>" . $row["stsPay"] . "</td>";
                                    break;
                                default:
                                    echo "<td>" . $row["stsPay"] . "</td>";
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
        <script>
            const statusFilter = document.getElementById('status-filter');
            const tableBody = document.getElementById('booking-table-body');

            function getStatusBook(status) {
                switch (status) {
                    case 'active':
                        return 'status-active';
                    case 'cancel':
                        return 'status-cancel';
                    case 'pass':
                        return 'status-pass';
                    default:
                        return '';
                }
            }

            function getStatusPay(stsPay) {
                switch (stsPay) {
                    case 'Valid':
                        return 'status-active';
                    case 'Expired':
                        return 'status-cancel';
                    case 'Pending':
                        return 'status-pass';
                    default:
                        return '';
                }
            }

            function fetchDataByOption(selectedOption) {
                fetch(`booklist_by_status.php?selectedOption=${selectedOption}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = ''; // Clear the table body
                        if (data.length === 0) {
                            // If there are no records, display a message or colspan the entire row.
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="11">No data available</td>
                            `;
                            tableBody.appendChild(noDataRow);
                        } else {
                            let counter = 1;
                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                const statusClass = getStatusBook(row.status);
                                const stsPayClass = getStatusPay(row.stsPay);
                                newRow.innerHTML = `
                                    <td>${counter++}</td>
                                    <td>${row.bookID}</td>
                                    <td>${row.userID}</td>
                                    <td>${row.dateBook}</td>
                                    <td>${row.startTime}</td>
                                    <td>${row.endTime}</td>
                                    <td>${row.courtNo}</td>
                                    <td>${row.rentRacket}</td>
                                    <td>${row.payID}</td>
                                    <td class="${statusClass}">${row.status}</td>
                                    <td class="${stsPayClass}">${row.stsPay}</td>
                                `;
                                tableBody.appendChild(newRow);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            fetchDataByOption(statusFilter.value);

            statusFilter.addEventListener('change', () => {
                fetchDataByOption(statusFilter.value);
            });
        </script>
    </body>
</html>