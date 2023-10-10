<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS News</title>
        <?php include 'news_mng_actions.php'; ?>
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
                <li class="active">
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
                            <option value="upcoming">Upcoming</option>
                            <option value="pass">Pass</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn--add--news" onclick="tonggleAddForm()">Add New Event</button>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Num.</th>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Description</th>
                                <th>Organizer</th>
                                <th>Current Join</th>
                                <th>Limit Join</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Place</th>
                                <th>Poster</th>
                            </tr>
                        </thead>
                        <tbody id="news-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                onclick='openEditPopup(" . $row["id"] . ", \"" . $row["eventName"] . "\",
                                 \"" . $row["eventDesc"] . "\", \"" . $row["organizer"] . "\",
                                  " . $row["currentParticipant"] . ", " . $row["numOfParticipant"] . ",
                                   \"" . $row["eventDate"] . "\", \"" . $row["eventDay"] . "\", \"" . $row["timeRange"] . "\",
                                    \"" . $row["eventPlace"] . "\", \"" . $row["eventImg"] . "\")'></i></td>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["eventName"] . "</td>";
                                echo "<td>" . $row["eventDesc"] . "</td>";
                                echo "<td>" . $row["organizer"] . "</td>";
                                echo "<td>" . $row["currentParticipant"] . "</td>";
                                echo "<td>" . $row["numOfParticipant"] . "</td>";
                                echo "<td>" . $row["eventDate"] . "</td>";
                                echo "<td>" . $row["eventDay"] . "</td>";
                                echo "<td>" . $row["timeRange"] . "</td>";
                                echo "<td>" . $row["eventPlace"] . "</td>";
                                echo "<td><img src='" . $row["eventImg"] . "' alt='Event Poster' class='popup-image' onclick='openImage(\"" . $row["eventImg"] . "\")'></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='13'>No records found.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Popup message action -->
            <div class="check " id="check"></div>

            <!-- Form for edit news -->
            <div class="form--wrapper" id="edit-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelEdit()">&times;</span>
                    <h2>Edit Event</h2>
                    <form id="event-edit-form" onsubmit="EditOldEvent(event); return false;">
                        <div class="form-group">
                            <label for="evtIDEdt">ID:</label>
                            <input type="text" id="evtIDEdt" name="evtIDEdt" readonly>
                        </div>

                        <div class="form-group">
                            <label for="evtNameEdt">Event Name:</label>
                            <input type="text" id="evtNameEdt" name="evtNameEdt">
                        </div>

                        <div class="form-group">
                            <label for="orgnzEdt">Organizer:</label>
                            <input type="text" id="orgnzEdt" name="orgnzEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtDescEdt">Description:</label>
                            <textarea id="evtDescEdt" name="evtDescEdt"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cParticipateEdt">Current Participant:</label>
                            <input type="number" id="cParticipateEdt" name="cParticipateEdt">
                        </div>

                        <div class="form-group">
                            <label for="lParticipateEdt">Limit Participant:</label>
                            <input type="number" id="lParticipateEdt" name="lParticipateEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtDateEdt">Event Date:</label>
                            <input type="date" id="evtDateEdt" name="evtDateEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtDayEdt">Event Day:</label>
                            <input type="text" id="evtDayEdt" name="evtDayEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtTimeEdt">Time Range:</label>
                            <input type="text" id="evtTimeEdt" name="evtTimeEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtPlaceEdt">Place:</label>
                            <input type="text" id="evtPlaceEdt" name="evtPlaceEdt">
                        </div>

                        <div class="form-group">
                            <label for="evtImgEdt">Poster:</label>
                            <input type="text" id="evtEdtImgInput" name="evtImgEdt">
                            <img id="prvIMG" src="" alt="Preview Image" style="max-width: 200px; display: none;">
                            <button type="button" id="removeEdtImgButton" onclick="removeEdtImage()">Remove Image</button>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="cancelEdit()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form for adding news -->
            <div class="formAdd--wrapper" id="add-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelAdd()">&times;</span>
                    <h2>Add Event</h2>
                    <form id="event-add-form" onsubmit="AddNewEvent(event); return false;">
                        <div class="form-group">
                            <label for="evtName">Event Name:</label>
                            <input type="text" id="evtName" name="evtName">
                        </div>

                        <div class="form-group">
                            <label for="orgnz">Organizer:</label>
                            <input type="text" id="orgnz" name="orgnz">
                        </div>

                        <div class="form-group">
                            <label for="evtDesc">Description:</label>
                            <textarea id="evtDesc" name="evtDesc"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cParticipate">Current Participant:</label>
                            <input type="number" id="cParticipate" name="cParticipate">
                        </div>

                        <div class="form-group">
                            <label for="lParticipate">Limit Participant:</label>
                            <input type="number" id="lParticipate" name="lParticipate">
                        </div>

                        <div class="form-group">
                            <label for="evtDate">Event Date:</label>
                            <input type="date" id="evtDate" name="evtDate">
                        </div>

                        <div class="form-group">
                            <label for="evtDay">Event Day:</label>
                            <input type="text" id="evtDay" name="evtDay">
                        </div>

                        <div class="form-group">
                            <label for="evtTime">Time Range:</label>
                            <input type="text" id="evtTime" name="evtTime">
                        </div>

                        <div class="form-group">
                            <label for="evtPlace">Place:</label>
                            <input type="text" id="evtPlace" name="evtPlace">
                        </div>

                        <div class="form-group">
                            <label for="evtImg">Poster Link:</label>
                            <input type="text" id="evtImgInput" name="evtImg">
                            <img id="previewImg" src="" alt="Preview Image" style="max-width: 200px; display: none;">
                            <button type="button" id="removeAddImgButton" onclick="removeAddImage()">Remove Image</button>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="resetAdd()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("evtImgInput").addEventListener("input", function() {
            const imageUrl = this.value; // Get the URL from the input field
            const previewImg = document.getElementById("previewImg");

            if (imageUrl.trim() === "") {
                // If the URL is empty, hide the image preview
                previewImg.style.display = "none";
            } else {
                // Set the image source to the entered URL and show it
                previewImg.src = imageUrl;
                previewImg.style.display = "block";
            }
        });

            document.getElementById("evtEdtImgInput").addEventListener("input", function() {
            const imageEditUrl = this.value; // Get the URL from the input field
            const prvIMG = document.getElementById("prvIMG");

            if (imageEditUrl.trim() === "") {
                // If the URL is empty, hide the image preview
                prvIMG.style.display = "none";
            } else {
                // Set the image source to the entered URL and show it
                prvIMG.src = imageEditUrl;
                prvIMG.style.display = "block";
            }
        });
        </script>
        <script>
            const statusFilter = document.getElementById('status-filter');
            const tableBody = document.getElementById('news-table-body');

            function fetchDataByOption(selectedOption) {
                fetch(`news_by_status.php?selectedOption=${selectedOption}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = ''; // Clear the table body
                        if (data.length === 0) {
                            // If there are no records, display a message or colspan the entire row.
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="13">No data available</td>
                            `;
                            tableBody.appendChild(noDataRow);
                        } else {
                            let counter = 1;
                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                    onclick='openEditPopup(${row.id}, \"${row.eventName}\",
                                    \"${row.eventDesc}\", \"${row.organizer}\", \"${row.currentParticipant}\",
                                    \"${row.numOfParticipant}\", \"${row.eventDate}\", \"${row.eventDay}\",
                                    \"${row.timeRange}\", \"${row.eventPlace}\", \"${row.eventImg}\")'></i></td>
                                    <td>${counter++}</td>
                                    <td>${row.id}</td>
                                    <td>${row.eventName}</td>
                                    <td>${row.eventDesc}</td>
                                    <td>${row.organizer}</td>
                                    <td>${row.currentParticipant}</td>
                                    <td>${row.numOfParticipant}</td>
                                    <td>${row.eventDate}</td>
                                    <td>${row.eventDay}</td>
                                    <td>${row.timeRange}</td>
                                    <td>${row.eventPlace}</td>
                                    <td><img src="${row.eventImg}" alt="Event Poster" class="popup-image" onclick="openImage('${row.eventImg}')"></td>
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

            function openImage(imageUrl) {
                window.open(imageUrl, "Image Popup", "width=800,height=600");
            }

        </script>
        <script>
            // start function for edit form
            function openEditPopup(id, eventName, eventDesc, organizer, currentParticipant, numOfParticipant, eventDate,
            eventDay, timeRange, eventPlace, eventImg) {
                // Set the form fields with default values or any specific information
                document.getElementById('evtIDEdt').value = id;
                document.getElementById('evtNameEdt').value = eventName;
                document.getElementById('evtDescEdt').value = eventDesc;
                document.getElementById('orgnzEdt').value = organizer;
                document.getElementById('cParticipateEdt').value = currentParticipant;
                document.getElementById('lParticipateEdt').value = numOfParticipant;
                document.getElementById('evtDateEdt').value = eventDate;
                document.getElementById('evtDayEdt').value = eventDay;
                document.getElementById('evtTimeEdt').value = timeRange;
                document.getElementById('evtPlaceEdt').value = eventPlace;
                document.getElementById('evtEdtImgInput').value = eventImg;

                //const imageUrl = eventImg.src;
                document.getElementById('prvIMG').src = eventImg;
                document.getElementById('prvIMG').style.display = 'block';

                // Show edit event form
                document.getElementById('edit-form').style.display = 'flex';
            }

            function removeEdtImage() {
                // Clear the image source and hide it
                document.getElementById('prvIMG').src = '';
                document.getElementById('prvIMG').style.display = 'none';

                // Clear the file input value (reset it)
                document.getElementById('evtEdtImgInput').value = '';

                // Optionally, you can also reset the hidden field that stores the image data if needed
                // document.getElementById('evtImgEdt').value = '';

                // Show the "Add New Image" button again if needed
                // document.getElementById('evtEdtImgInput').style.display = 'block';
            }

            function cancelEdit() {
                // Close the popup
                document.getElementById('edit-form').style.display = 'none';
            }

            //function for add form
            function tonggleAddForm(){
                //show add event form
                document.getElementById('add-form').style.display = 'flex';
            }

            function resetAdd(){
                //reset form add
                const rstAdd = document.getElementById('event-add-form');
                rstAdd.reset();
            }

            function cancelAdd() {
                // Close the popup
                document.getElementById('add-form').style.display = 'none';
            }

            function removeAddImage() {
                // Clear the image source and hide it
                document.getElementById('previewImg').src = '';
                document.getElementById('previewImg').style.display = 'none';

                // Clear the file input value (reset it)
                document.getElementById('evtImgInput').value = '';

                // Optionally, you can also reset the hidden field that stores the image data if needed
                // document.getElementById('evtImg').value = '';

                // Show the "Add New Image" button again if needed
                // document.getElementById('addImgButton').style.display = 'block';
            }

            function AddNewEvent(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                //var id = document.getElementById('evtID').value;
                var eventName = document.getElementById('evtName').value;
                var eventDesc = document.getElementById('evtDesc').value;
                var organizer = document.getElementById('orgnz').value;
                var currentParticipant = document.getElementById('cParticipate').value;
                var limitParticipant = document.getElementById('lParticipate').value;
                var eventDate = document.getElementById('evtDate').value;
                var eventDay = document.getElementById('evtDay').value;
                var eventTime = document.getElementById('evtTime').value;
                var eventPlace = document.getElementById('evtPlace').value;
                var eventImg = document.getElementById('evtImgInput').value;

                // Validate the subject and body (you can add more validation)
                if (!eventName || !eventDesc || !organizer || !currentParticipant 
                || !limitParticipant || !eventDate || !eventDay || !eventTime || !eventPlace || !eventImg) {
                    alert('Please fill out all fields in the add event form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'add_event_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelAdd(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Add new event successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to add data.');
                        }
                    }
                };

                var data = 'eventName=' + eventName + '&eventDesc=' + eventDesc +
                '&organizer=' + organizer + '&currentParticipant=' + currentParticipant + '&limitParticipant=' + limitParticipant +
                '&eventDate=' + eventDate + '&eventDay=' + eventDay + '&eventTime=' + eventTime + '&eventPlace=' + eventPlace + '&eventImg=' + eventImg;
                xhr.send(data);
            }

            function EditOldEvent(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                var id = document.getElementById('evtIDEdt').value;
                var eventName = document.getElementById('evtNameEdt').value;
                var eventDesc = document.getElementById('evtDescEdt').value;
                var organizer = document.getElementById('orgnzEdt').value;
                var currentParticipant = document.getElementById('cParticipateEdt').value;
                var limitParticipant = document.getElementById('lParticipateEdt').value;
                var eventDate = document.getElementById('evtDateEdt').value;
                var eventDay = document.getElementById('evtDayEdt').value;
                var eventTime = document.getElementById('evtTimeEdt').value;
                var eventPlace = document.getElementById('evtPlaceEdt').value;
                var eventImg = document.getElementById('evtEdtImgInput').value;

                // Validate the subject and body (you can add more validation)
                if (!id || !eventName || !eventDesc || !organizer || !currentParticipant 
                || !limitParticipant || !eventDate || !eventDay || !eventTime || !eventPlace || !eventImg) {
                    alert('Please fill out all fields in the edit event form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_event_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Update data successfully!');
                            cancelEdit(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Update event successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to update data.');
                        }
                    }
                };

                var data = 'id=' + id + '&eventName=' + eventName + '&eventDesc=' + eventDesc +
                '&organizer=' + organizer + '&currentParticipant=' + currentParticipant + '&limitParticipant=' + limitParticipant +
                '&eventDate=' + eventDate + '&eventDay=' + eventDay + '&eventTime=' + eventTime + '&eventPlace=' + eventPlace + '&eventImg=' + eventImg;
                xhr.send(data);
            }
        </script>
    </body>
</html>