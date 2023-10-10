<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Shop</title>
        <?php include 'mng_shop_action.php'; ?>
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
                <li class="has-submenu active">
                    <a>
                        <i class="fa-solid fa-bag-shopping" style="color: #000000;"></i>
                        <span>Sport Shop</span>
                    </a>
                    <ul class="submenuShop">
                        <li class="active"><a href="shop_mng.php">Sales List</a></li>
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
            <div class="tabular--wrapper">
                <h3 class="main--title">Table News and Event</h3>
                <div class="div--filter--button">
                    <div class="filter-options">
                        <label for="status-filter">Filter by Status:</label>
                        <select id="status-filter">
                        <option value="all">All</option>
                            <option value="Pending Pick-Up">Pending Pick-Up</option>
                            <option value="Not Valid">Pending Payment</option>
                            <option value="Pick-Up">Pick-Up</option>
                            <option value="Expired">Expired</option>
                        </select>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Num.</th>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Purchase Status</th>
                                <th>Payment Status</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="news-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                onclick='openUpdatePopup(" . $row["buyID"] . ", \"" . $row["CustomerName"] . "\",
                                 \"" . $row["ProductName"] . "\", \"" . $row["buyStatus"] . "\")'></i></td>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["buyID"] . "</td>";
                                echo "<td>" . $row["CustomerName"] . "</td>";
                                echo "<td>" . $row["ProductName"] . "</td>";
                                echo "<td>" . $row["prdClr"] . "</td>";
                                echo "<td>" . $row["prdSize"] . "</td>";
                                echo "<td>" . $row["prdQty"] . "</td>";
                                switch ($row["buyStatus"]) {
                                    case 'Pick-Up':
                                        echo "<td style='color: green;'>" . $row["buyStatus"] . "</td>";
                                        break;
                                    case 'Expired':
                                        echo "<td style='color: red;'>" . $row["buyStatus"] . "</td>";
                                        break;
                                    case 'Pending Pick-Up':
                                        echo "<td style='color: orange;'>" . $row["buyStatus"] . "</td>";
                                        break;
                                    case 'Not Valid':
                                        echo "<td style='color: orangered;'>" . $row["buyStatus"] . "</td>";
                                        break;
                                    default:
                                        echo "<td>" . $row["buyStatus"] . "</td>";
                                        break;
                                }
                            
                                switch ($row["PaymentStatus"]) {
                                    case 'Valid':
                                        echo "<td style='color: green;'>" . $row["PaymentStatus"] . "</td>";
                                        break;
                                    case 'Expired':
                                        echo "<td style='color: red;'>" . $row["PaymentStatus"] . "</td>";
                                        break;
                                    case 'Pending':
                                        echo "<td style='color: orange;'>" . $row["PaymentStatus"] . "</td>";
                                        break;
                                    default:
                                        echo "<td>" . $row["stsPay"] . "</td>";
                                        break;
                                }
                                echo "<td>" . $row["TotalPay"] . "</td>";
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
            <!-- Popup message for update status -->
            <div class="form--wrapper" id="edit-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelUpdate()">&times;</span>
                    <h2 style="align-items: center;">Comfirm Pick-Up</h2>
                    <form id="event-edit-form" onsubmit="sendUpdate(event); return false;">
                        <div class="form-group-shop">
                            <label for="pchID">Purchased ID:</label>
                            <input type="text" id="pchID" name="pchID" readonly>
                        </div>

                        <div class="form-group-shop">
                            <label for="cName">Customer Name:</label>
                            <input type="text" id="cName" name="cName" readonly>
                        </div>

                        <div class="form-group-shop">
                            <label for="pName">Product Name:</label>
                            <input type="text" id="pName" name="pName" readonly>
                        </div>

                        <div class="form-group-shop">
                            <label for="pSts">Purchase Status:</label>
                            <input type="text" id="pSts" name="pSts" readonly>
                        </div>

                        <div class="form-actions">
                            <button type="submit"><i class="fa-solid fa-check"></i></button>
                            <button type="button" onclick="cancelUpdate()"><i class="fa-solid fa-times"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const statusFilter = document.getElementById('status-filter');
            const tableBody = document.getElementById('news-table-body');

            function getStatusPurchase(buyStatus) {
                switch (buyStatus) {
                    case 'Pick-Up':
                        return 'status-active';
                    case 'Expired':
                        return 'status-cancel';
                    case 'Pending Pick-Up':
                        return 'status-pass';
                    case 'Not Valid':
                        return 'status-NV';
                    default:
                        return '';
                }
            }

            function getStatusPay(PaymentStatus) {
                switch (PaymentStatus) {
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
                fetch(`mng_shop_by_status.php?selectedOption=${selectedOption}`)
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
                                const stsPchClass = getStatusPurchase(row.buyStatus);
                                const stsPayClass = getStatusPay(row.PaymentStatus);
                                newRow.innerHTML = `
                                    <td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                    onclick='openUpdatePopup(${row.buyID}, \"${row.CustomerName}\",
                                    \"${row.ProductName}\", \"${row.buyStatus}\")'></i></td>
                                    <td>${counter++}</td>
                                    <td>${row.buyID}</td>
                                    <td>${row.CustomerName}</td>
                                    <td>${row.ProductName}</td>
                                    <td>${row.prdClr}</td>
                                    <td>${row.prdSize}</td>
                                    <td>${row.prdQty}</td>
                                    <td class="${stsPchClass}">${row.buyStatus}</td>
                                    <td class="${stsPayClass}">${row.PaymentStatus}</td>
                                    <td>${row.TotalPay}</td>
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
        <script>
            // start function for edit form
            function openUpdatePopup(buyID, custName, prdName, prcStatus) {
                // Set the form fields with default values or any specific information
                document.getElementById('pchID').value = buyID;
                document.getElementById('cName').value = custName;
                document.getElementById('pName').value = prdName;
                document.getElementById('pSts').value = prcStatus;

                // Show edit event form
                document.getElementById('edit-form').style.display = 'flex';
            }

            function cancelUpdate() {
                // Close the popup
                document.getElementById('edit-form').style.display = 'none';
            }

            function sendUpdate(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                var buyID = document.getElementById('pchID').value;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_purchase_sts.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Update status successfully!');
                            cancelUpdate(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Update status successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to update status.');
                        }
                    }
                };

                var data = 'buyID=' + buyID;
                xhr.send(data);
            }
        </script>
    </body>
</html>