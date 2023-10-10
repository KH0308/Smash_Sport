<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Booking</title>
        <?php include 'mng_rpt_book_action.php'; ?>
        <?php include 'mng_rpt_prch_action.php'; ?>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <li class="active">
                    <a href="mng_report.php">
                        <i class="fas fa-chart-bar"></i>
                        <span>Report Sales</span>
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
            <!--pie chart report-->
            <div class="tabular--wrapper">
                <div>
                    <h3 class="main--title">Chart Sales</h3>
                </div>
                <div class="pie--wrapper">
                    <canvas id="bookingPieChart"></canvas>
                    <canvas id="paymentPieChart"></canvas>
                    <canvas id="purchasePieChart"></canvas>
                </div>
                <div class="pie--wrapper">
                    <h5>Booking Chart</h5>
                    <h5>Overall Chart</h5>
                    <h5>Purchase Chart</h5>
                </div>
            </div>
            <!--table pay booking-->
            <div class="tabular--wrapper">
                <h3 class="main--title">Booking Sales</h3>
                <div class="div--filter--button">
                    <div>
                        <div class="filter-options">
                            <label for="year-filter">Filter by year:</label>
                            <select id="year-filter">
                                <option value="all">All</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                            <label for="month-filter"> month:</label>
                            <select id="month-filter">
                                <option value="all">All</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="filter-options">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start-date">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end-date">
                            <button class="btn--add--news" onclick="filterBookDate()">Search</button>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Num.</th>
                                <th>Pay. ID</th>
                                <th>User ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Pay. Option</th>
                                <th>Pay. Type</th>
                                <th>Pay. Total</th>
                                <th>Pay. Status</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody id="booking-table-body">
                        <?php
                        if ($resultBooking->num_rows > 0) {
                            $counter = 1;
                            while ($row = $resultBooking->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["payID"] . "</td>";
                                echo "<td>" . $row["userID"] . "</td>";
                                echo "<td>" . $row["payDate"] . "</td>";
                                echo "<td>" . $row["payTime"] . "</td>";
                                echo "<td>" . $row["payOpt"] . "</td>";
                                echo "<td>" . $row["payType"] . "</td>";
                                echo "<td>" . $row["totalPay"] . "</td>";
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
                                echo "<td><img src='data:image/*;base64," . $row["receiptFile"] . "' 
                                alt='Event Poster' class='popup-image' onclick='openImage(\"" . $row["receiptFile"] . "\")'></td>";
                                echo "</tr>";

                                if ($row["stsPay"] == 'Valid') {
                                    $totalSumBook += $row["totalPay"];
                                }
                                else if ($row["stsPay"] == 'Pending') {
                                    $totalPdgSumBook += $row["totalPay"];
                                }
                                else if ($row["stsPay"] == 'Expired') {
                                    $totalExpSumBook += $row["totalPay"];
                                }
                                else {
                                    $totalRfdSumBook += $row["totalPay"];
                                }
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found.</td></tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8"></td>
                                <td>Total All:</td>
                                <td id= "total-pay-book"><?php echo $totalSumBook; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!--table pay Shop-->
            <div class="tabular--wrapper">
                <h3 class="main--title">Shop Sales</h3>
                <div class="div--filter--button">
                    <div>
                        <div class="filter-options">
                            <label for="yearShop-filter">Filter by year:</label>
                            <select id="yearShop-filter">
                                <option value="all">All</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                            <label for="monthShop-filter"> month:</label>
                            <select id="monthShop-filter">
                                <option value="all">All</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="filter-options">
                            <label for="start-date-shop">Start Date:</label>
                            <input type="date" id="start-date-shop" name="start-date-shop">
                            <label for="end-date-shop">End Date:</label>
                            <input type="date" id="end-date-shop" name="end-date-shop">
                            <button class="btn--add--news" onclick="filterShopDate()">Search</button>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Num.</th>
                                <th>Pay. ID</th>
                                <th>User ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Pay. Option</th>
                                <th>Pay. Type</th>
                                <th>Pay. Total</th>
                                <th>Pay. Status</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody id="purchase-table-body">
                        <?php
                        if ($resultPurchase->num_rows > 0) {
                            $counter = 1;
                            while ($row = $resultPurchase->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["payID"] . "</td>";
                                echo "<td>" . $row["userID"] . "</td>";
                                echo "<td>" . $row["payDate"] . "</td>";
                                echo "<td>" . $row["payTime"] . "</td>";
                                echo "<td>" . $row["payOpt"] . "</td>";
                                echo "<td>" . $row["payType"] . "</td>";
                                echo "<td>" . $row["totalPay"] . "</td>";
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
                                echo "<td><img src='data:image/*;base64," . $row["receiptFile"] . "' 
                                alt='Event Poster' class='popup-image' onclick='openImage(\"" . $row["receiptFile"] . "\")'></td>";
                                echo "</tr>";

                                if ($row["stsPay"] == 'Valid') {
                                    $totalSumPurchase += $row["totalPay"];
                                }
                                else if ($row["stsPay"] == 'Pending') {
                                    $totalPdgSumPurchase += $row["totalPay"];
                                }
                                else if ($row["stsPay"] == 'Expired') {
                                    $totalExpSumPurchase += $row["totalPay"];
                                }
                                else {
                                    $totalRfdSumPurchase += $row["totalPay"];
                                }
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found.</td></tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8"></td>
                                <td>Total All:</td>
                                <td id= "total-pay-purchase"><?php echo $totalSumPurchase; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Fetch data from your SQL query or use static data for testing
            //data booking table

            console.log("totalSumBook: " + <?php echo json_encode($totalSumBook); ?>);
            console.log("totalPdgSumBook: " + <?php echo json_encode($totalPdgSumBook); ?>);
            console.log("totalExpSumBook: " + <?php echo json_encode($totalExpSumBook); ?>);
            console.log("totalRfdSumBook: " + <?php echo json_encode($totalRfdSumBook); ?>);
            var ttlVldPayBooking = <?php echo json_encode($totalSumBook); ?>;
            var ttlPdgPayBooking = <?php echo json_encode($totalPdgSumBook); ?>;
            var ttlExpPayBooking = <?php echo json_encode($totalExpSumBook); ?>;
            var ttlRfdPayBooking = <?php echo json_encode($totalRfdSumBook); ?>;

            //data purchase table
            var ttlVldPayPurchase = <?php echo $totalSumPurchase; ?>;
            var ttlPdgPayPurchase = <?php echo $totalPdgSumPurchase; ?>;
            var ttlExpPayPurchase = <?php echo $totalExpSumPurchase; ?>;
            var ttlRfdPayPurchase = <?php echo $totalRfdSumPurchase; ?>;

            //data all totalpayment
            var ttlAllPayment = ttlVldPayBooking + ttlVldPayPurchase;

            function createPieCharts() {
                var bookingPieChart = new Chart(document.getElementById('bookingPieChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Valid Payment', 'Pending Payment', 'Expired Payment', 'Refund Payment'],
                        datasets: [{
                            data: [ttlVldPayBooking, ttlPdgPayBooking, ttlExpPayBooking, ttlRfdPayBooking],
                            backgroundColor: ['rgba(42, 86, 159, 1)', 'rgba(122, 177, 242, 1)',
                                'rgba(173, 169, 245, 1)', 'rgb(168, 239, 248)'],
                        }],
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Booking Pie Chart', // Add your title here
                        },
                    },
                });

                var purchasePieChart = new Chart(document.getElementById('purchasePieChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Valid Payment', 'Pending Payment', 'Expired Payment', 'Refund Payment'],
                        datasets: [{
                            data: [ttlVldPayPurchase, ttlPdgPayPurchase, ttlExpPayPurchase, ttlRfdPayPurchase],
                            backgroundColor: ['rgba(42, 86, 159, 1)', 'rgba(122, 177, 242, 1)',
                                'rgba(173, 169, 245, 1)', 'rgb(168, 239, 248)'],
                        }],
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Purchase Pie Chart', // Add your title here
                        },
                    },
                });

                var paymentPieChart = new Chart(document.getElementById('paymentPieChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Total Pay Booking', 'Total Pay Purchase'],
                        datasets: [{
                            data: [ttlVldPayBooking, ttlVldPayPurchase],
                            backgroundColor: ['rgba(43, 105, 192, 1)', 'rgba(10, 208, 253, 1)'],
                        }],
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Payment Pie Chart', // Add your title here
                        },
                    },
                });
            }

            // Call the function to create the pie charts
            createPieCharts();

            /*function updatePieChartBook(newTtlPayBook, newTtlPdgPayBook, newTtlExpPayBook, newTtlRfdPayBook) {
                // Get the existing chart instance
                var bookPieChart = Chart.getChart("bookingPieChart");

                // Update the dataset data with the new value
                bookPieChart.data.datasets[0].data[1] = newTtlPayBook;
                bookPieChart.data.datasets[0].data[2] = newTtlPdgPayBook;
                bookPieChart.data.datasets[0].data[3] = newTtlExpPayBook;
                bookPieChart.data.datasets[0].data[4] = newTtlRfdPayBook;

                // Update the chart
                bookPieChart.update();
            }

            function updatePieChartPurchase(newTtlPayPch, newTtlPdgPayPch, newTtlExpPayPch, newTtlRfdPayPch) {
                // Get the existing chart instance
                var purchasePieChart = Chart.getChart("purchasePieChart");

                // Update the dataset data with the new value
                purchasePieChart.data.datasets[0].data[1] = newTtlPayPch;
                purchasePieChart.data.datasets[0].data[2] = newTtlPdgPayPch;
                purchasePieChart.data.datasets[0].data[3] = newTtlExpPayPch;
                purchasePieChart.data.datasets[0].data[4] = newTtlRfdPayPch;

                // Update the chart
                purchasePieChart.update();
            }*/
        </script>
        
        <script>
            const yearFilter = document.getElementById('year-filter');
            const monthFilter = document.getElementById('month-filter');
            const tableBodyBooking = document.getElementById('booking-table-body');

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

            function fetchDataByOption(selectedYear, selectedMonth) {
                if (typeof selectedYear !== 'undefined' && selectedYear !== '' &&
                typeof selectedMonth !== 'undefined' && selectedMonth !== '') {
                    fetch(`booklist_by_YMDate.php?selectedYear=${selectedYear}&selectedMonth=${selectedMonth}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBodyBooking.innerHTML = ''; // Clear the table body
                        if (data.length === 0) {
                            // If there are no records, display a message or colspan the entire row.
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="11">No data available</td>
                            `;
                            tableBodyBooking.appendChild(noDataRow);
                            document.getElementById("total-pay-book").textContent = '0.00';
                        } else {
                            let counter = 1;
                            let filteredTotalPay = 0;
                            let filteredPdgTtlPay = 0;
                            let filteredExpTtlPay = 0;
                            let filteredRfdTtlPay = 0;
                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                const stsPayClass = getStatusPay(row.stsPay);
                                newRow.innerHTML = `
                                    <td>${counter++}</td>
                                    <td>${row.payID}</td>
                                    <td>${row.userID}</td>
                                    <td>${row.payDate}</td>
                                    <td>${row.payTime}</td>
                                    <td>${row.payOpt}</td>
                                    <td>${row.payType}</td>
                                    <td>${row.totalPay}</td>
                                    <td class="${stsPayClass}">${row.stsPay}</td>
                                    <td><img src="data:image/*;base64,${row.receiptFile}" 
                                    alt="Event Poster" class="popup-image" onclick="openImage('${row.receiptFile}')"></td>
                                `;
                                tableBodyBooking.appendChild(newRow);
                                // Calculate filtered total for 'totalPay'
                                if(row.stsPay == 'Valid'){
                                    filteredTotalPay += parseFloat(row.totalPay) || 0;
                                }
                                else if(row.stsPay == 'Pending'){
                                    filteredPdgTtlPay += parseFloat(row.totalPay) || 0;
                                }
                                else if(row.stsPay == 'Expired'){
                                    filteredExpTtlPay += parseFloat(row.totalPay) || 0;
                                }
                                else {
                                    filteredRfdTtlPay += parseFloat(row.totalPay) || 0;
                                }
                            });
                            document.getElementById("total-pay-book").textContent = filteredTotalPay.toFixed(2);
                            var newBookingData = [filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay];
                            updatePieChart("bookingPieChart", newBookingData);
                            //updatePieChartBook(filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay);
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
                }
                else {
                    // Handle the case where one or both values are not provided
                    console.error('Both selectedYear and selectedMonth must be provided.');
                }
            }

            fetchDataByOption(yearFilter.value, monthFilter.value);

            yearFilter.addEventListener('change', () => {
                fetchDataByOption(yearFilter.value, monthFilter.value);
            });

            monthFilter.addEventListener('change', () => {
                fetchDataByOption(yearFilter.value, monthFilter.value);
            });

            const yearShopFilter = document.getElementById('yearShop-filter');
            const monthShopFilter = document.getElementById('monthShop-filter');
            const tableBodyPurchase = document.getElementById('purchase-table-body');

            function fetchDataByOptionShop(selectedYearShop, selectedMonthShop) {
                if (typeof selectedYearShop !== 'undefined' && selectedYearShop !== '' &&
                typeof selectedMonthShop !== 'undefined' && selectedMonthShop !== '') {
                    fetch(`purchaselist_by_YMDate.php?selectedYear=${selectedYearShop}&selectedMonth=${selectedMonthShop}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBodyPurchase.innerHTML = ''; // Clear the table body
                        if (data.length === 0) {
                            // If there are no records, display a message or colspan the entire row.
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="11">No data available</td>
                            `;
                            tableBodyPurchase.appendChild(noDataRow);
                            document.getElementById("total-pay-purchase").textContent = '0.00';
                        } else {
                            let counter = 1;
                            let filteredTotalPay = 0;
                            let filteredPdgTtlPay = 0;
                            let filteredExpTtlPay = 0;
                            let filteredRfdTtlPay = 0;
                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                const stsPayClass = getStatusPay(row.stsPay);
                                newRow.innerHTML = `
                                    <td>${counter++}</td>
                                    <td>${row.payID}</td>
                                    <td>${row.userID}</td>
                                    <td>${row.payDate}</td>
                                    <td>${row.payTime}</td>
                                    <td>${row.payOpt}</td>
                                    <td>${row.payType}</td>
                                    <td>${row.totalPay}</td>
                                    <td class="${stsPayClass}">${row.stsPay}</td>
                                    <td><img src="data:image/*;base64,${row.receiptFile}" 
                                    alt="Event Poster" class="popup-image" onclick="openImage('${row.receiptFile}')"></td>
                                `;
                                tableBodyPurchase.appendChild(newRow);
                                // Calculate filtered total for 'totalPay'
                                if(row.stsPay == 'Valid'){
                                    filteredTotalPay += parseFloat(row.totalPay) || 0;
                                }
                                else if(row.stsPay == 'Pending'){
                                    filteredPdgTtlPay += parseFloat(row.totalPay) || 0;
                                }
                                else if(row.stsPay == 'Expired'){
                                    filteredExpTtlPay += parseFloat(row.totalPay) || 0;
                                }
                                else {
                                    filteredRfdTtlPay += parseFloat(row.totalPay) || 0;
                                }
                            });
                            document.getElementById("total-pay-purchase").textContent = filteredTotalPay.toFixed(2);
                            var newPurchaseData = [filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay];
                            updatePieChart("purchasePieChart", newPurchaseData);
                            //updatePieChartPurchase(filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay);
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
                } else {
                    // Handle the case where one or both values are not provided
                    console.error('Both selectedYear and selectedMonth must be provided.');
                }
            }

            fetchDataByOptionShop(yearShopFilter.value, monthShopFilter.value);

            yearShopFilter.addEventListener('change', () => {
                fetchDataByOptionShop(yearShopFilter.value, monthShopFilter.value);
            });

            monthShopFilter.addEventListener('change', () => {
                fetchDataByOptionShop(yearShopFilter.value, monthShopFilter.value);
            });

            // filter by date book
            function filterBookDate() {
                const startFilter = document.getElementById('start-date').value;
                const endFilter = document.getElementById('end-date').value;
                fetchDataByDate(startFilter, endFilter);
            }

            function fetchDataByDate(selectedStart, selectedEnd) {
                // Check if selectedStart and selectedEnd are valid dates
                if (!selectedStart || !selectedEnd || selectedStart > selectedEnd) {
                    // Handle the case where the selected date range is invalid
                    alert('Invalid date range');
                    return;
                }

                fetch(`booklist_by_date.php?start-date=${selectedStart}&end-date=${selectedEnd}`)
                .then(response => response.json())
                .then(data => {
                    tableBodyBooking.innerHTML = ''; // Clear the table body
                    if (data.length === 0) {
                        // If there are no records, display a message or colspan the entire row.
                        const noDataRow = document.createElement('tr');
                        noDataRow.innerHTML = `
                            <td colspan="11">No data available</td>
                        `;
                        tableBodyBooking.appendChild(noDataRow);
                        document.getElementById("total-pay-book").textContent = '0.00';
                    } else {
                        let counter = 1;
                        let filteredTotalPay = 0;
                        let filteredPdgTtlPay = 0;
                        let filteredExpTtlPay = 0;
                        let filteredRfdTtlPay = 0;
                        data.forEach(row => {
                            const newRow = document.createElement('tr');
                            const stsPayClass = getStatusPay(row.stsPay);
                            newRow.innerHTML = `
                                <td>${counter++}</td>
                                <td>${row.payID}</td>
                                <td>${row.userID}</td>
                                <td>${row.payDate}</td>
                                <td>${row.payTime}</td>
                                <td>${row.payOpt}</td>
                                <td>${row.payType}</td>
                                <td>${row.totalPay}</td>
                                <td class="${stsPayClass}">${row.stsPay}</td>
                                <td><img src="data:image/*;base64,${row.receiptFile}" 
                                alt="Event Poster" class="popup-image" onclick="openImage('${row.receiptFile}')"></td>
                            `;
                            tableBodyBooking.appendChild(newRow);
                            // Calculate filtered total for 'totalPay'
                            if(row.stsPay == 'Valid'){
                                filteredTotalPay += parseFloat(row.totalPay) || 0;
                            }
                            else if(row.stsPay == 'Pending'){
                                filteredPdgTtlPay += parseFloat(row.totalPay) || 0;
                            }
                            else if(row.stsPay == 'Expired'){
                                filteredExpTtlPay += parseFloat(row.totalPay) || 0;
                            }
                            else {
                                filteredRfdTtlPay += parseFloat(row.totalPay) || 0;
                            }
                        });
                        document.getElementById("total-pay-book").textContent = filteredTotalPay.toFixed(2);
                        var newBookingData = [filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay];
                        updatePieChart("bookingPieChart", newBookingData);
                        //updatePieChartBook(filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    // You can display more detailed error information like the stack trace
                    console.error('Error stack trace:', error.stack);
                });
            }

            // filter by date purchase
            function filterShopDate() {
                const startShopFilter = document.getElementById('start-date-shop').value;
                const endShopFilter = document.getElementById('end-date-shop').value;
                fetchDataByDateShop(startShopFilter, endShopFilter);
            }

            function fetchDataByDateShop(selectedShopStart, selectedShopEnd) {
                // Check if selectedStart and selectedEnd are valid dates
                if (!selectedShopStart || !selectedShopEnd || selectedShopStart > selectedShopEnd) {
                    // Handle the case where the selected date range is invalid
                    alert('Invalid date range');
                    return;
                }

                fetch(`purchaselist_by_date.php?start-date=${selectedShopStart}&end-date=${selectedShopEnd}`)
                .then(response => response.json())
                .then(data => {
                    tableBodyPurchase.innerHTML = ''; // Clear the table body
                    if (data.length === 0) {
                        // If there are no records, display a message or colspan the entire row.
                        const noDataRow = document.createElement('tr');
                        noDataRow.innerHTML = `
                            <td colspan="11">No data available</td>
                        `;
                        tableBodyPurchase.appendChild(noDataRow);
                        document.getElementById("total-pay-purchase").textContent = '0.00';
                    } else {
                        let counter = 1;
                        let filteredTotalPay = 0;
                        let filteredPdgTtlPay = 0;
                        let filteredExpTtlPay = 0;
                        let filteredRfdTtlPay = 0;
                        data.forEach(row => {
                            const newRow = document.createElement('tr');
                            const stsPayClass = getStatusPay(row.stsPay);
                            newRow.innerHTML = `
                                <td>${counter++}</td>
                                <td>${row.payID}</td>
                                <td>${row.userID}</td>
                                <td>${row.payDate}</td>
                                <td>${row.payTime}</td>
                                <td>${row.payOpt}</td>
                                <td>${row.payType}</td>
                                <td>${row.totalPay}</td>
                                <td class="${stsPayClass}">${row.stsPay}</td>
                                <td><img src="data:image/*;base64,${row.receiptFile}" 
                                alt="Event Poster" class="popup-image" onclick="openImage('${row.receiptFile}')"></td>
                            `;
                            tableBodyPurchase.appendChild(newRow);
                            // Calculate filtered total for 'totalPay'
                            if(row.stsPay == 'Valid'){
                                filteredTotalPay += parseFloat(row.totalPay) || 0;
                            }
                            else if(row.stsPay == 'Pending'){
                                filteredPdgTtlPay += parseFloat(row.totalPay) || 0;
                            }
                            else if(row.stsPay == 'Expired'){
                                filteredExpTtlPay += parseFloat(row.totalPay) || 0;
                            }
                            else {
                                filteredRfdTtlPay += parseFloat(row.totalPay) || 0;
                            }
                        });
                        document.getElementById("total-pay-purchase").textContent = filteredTotalPay.toFixed(2);
                        var newPurchaseData = [filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay];
                        updatePieChart("purchasePieChart", newPurchaseData);
                        //updatePieChartPurchase(filteredTotalPay, filteredPdgTtlPay, filteredExpTtlPay, filteredRfdTtlPay);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    // You can display more detailed error information like the stack trace
                    console.error('Error stack trace:', error.stack);
                });
            }

            // open image base64String in new tab 
            function openImage(imageUrl) {
                // Create a data URL from the Base64-encoded image
                    const dataUrl = `data:image/png;base64,${imageUrl}`;

                // Open the data URL in a new window
                const newWindow = window.open();
                newWindow.document.write(`<img src="${dataUrl}" width="800" height="600">`);
            }

            function updatePieChart(chartInstance, newData) {
                // Get the existing chart instance
                var chart = Chart.getChart(chartInstance);

                // Update the dataset data with the new values
                chart.data.datasets[0].data = newData;

                // Update the chart
                chart.update();
            }

        </script>
    </body>
</html>