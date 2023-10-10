<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Shop</title>
        <?php include 'badminton_exs_actions.php'; ?>
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
                <li class="active">
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
                <h3 class="main--title">Table Badminton Exercise</h3>
                <div class="div--filter--button">
                    <div class="filter-options">
                        <label for="status-filter">Filter by training category:</label>
                        <select id="status-filter">
                        <option value="all">All</option>
                            <option value="Footwork Drills">Footwork Drills</option>
                            <option value="Agility and Speed Training">Agility & Speed Training</option>
                            <option value="Strength Training">Strength Training</option>
                            <option value="Endurance Training">Endurance Training</option>
                            <option value="Hand-Eye Coordination">Hand-Eye Coordination</option>
                            <option value="Balance and Core Strength">Balance & Core Strength</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn--add--news" onclick="tonggleAddForm()">Add New Exercise</button>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Num.</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Set Exercise</th>
                                <th>Duration</th>
                                <th>Calories Burn</th>
                                <th>Image</th>
                                <th>Video Link</th>
                            </tr>
                        </thead>
                        <tbody id="exs-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                onclick='openEditPopup('" . $row["id"] . "')'></i></td>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td class='description-cell'>" . $row["description"] . "</td>";
                                echo "<td>" . $row["training_category"] . "</td>";
                                echo "<td>" . $row["setExercise"] . "</td>";
                                echo "<td>" . $row["duration_minutes"] . "</td>";
                                echo "<td>" . $row["calories_burned"] . "</td>";
                                echo "<td><img src='data:image/*;base64," . $row["img_exr"] . "' alt='Event Poster' class='popup-image' onclick='openImage(\"" . $row["img_exr"] . "\")'></td>";
                                echo "<td><a href='" . $row["vid_exr"] . "' target='_blank'>Link</a></td>";
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

            <!-- Form for edit exercise -->
            <div class="form--wrapper" id="edit-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelEdit()">&times;</span>
                    <h2>Edit Exercise</h2>
                    <form id="event-edit-form" onsubmit="EditOldEvent(event); return false;">
                        <div class="form-group">
                            <label for="exsIDEdt">ID:</label>
                            <input type="text" id="exsIDEdt" name="exsIDEdt" readonly>
                        </div>

                        <div class="form-group">
                            <label for="exsNameEdt">Event Name:</label>
                            <input type="text" id="exsNameEdt" name="exsNameEdt">
                        </div>

                        <div class="form-group">
                            <label for="exsDescEdt">Description:</label>
                            <textarea id="exsDescEdt" name="exsDescEdt"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exsCtgEdt">Category:</label>
                            <select id="exsCtgEdt" name="exsCtgEdt">
                                <option value="Footwork Drills">Footwork Drills</option>
                                <option value="Agility and Speed Training">Agility & Speed Training</option>
                                <option value="Strength Training">Strength Training</option>
                                <option value="Endurance Training">Endurance Training</option>
                                <option value="Hand-Eye Coordination">Hand-Eye Coordination</option>
                                <option value="Balance and Core Strength">Balance & Core Strength</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exsSOEEdt">Set Of Exercise:</label>
                            <input type="number" id="exsSOEEdt" name="exsSOEEdt">
                        </div>

                        <div class="form-group">
                            <label for="exsDurEdt">Duration(min):</label>
                            <input type="number" id="exsDurEdt" name="exsDurEdt">
                        </div>

                        <div class="form-group">
                            <label for="exsCburnEdt">Calories Burn:</label>
                            <input type="number" id="exsCburnEdt" name="exsCburnEdt">
                        </div>

                        <div class="form-group">
                            <label for="exsVidEdt">Video Link:</label>
                            <input type="text" id="exsVidEdt" name="exsVidEdt">
                        </div>

                        <div class="form-group">
                            <label for="exsEdtImg">Image:</label>
                            <input type="file" id="exsEdtImg" accept="image/*" name="exsEdtImg">
                            <img id="prvIMG" src="" alt="Preview Image" style="max-width: 200px; display: none;">
                            <button type="button" id="removeEdtImgButton" onclick="removeEdtImage()">Remove Image</button>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="cancelEdit()">Cancel</button>
                            <button class="btnDel" type="button" onclick="msgDelExs(document.getElementById('exsIDEdt').value)">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form for adding exercise -->
            <div class="formAdd--wrapper" id="add-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelAdd()">&times;</span>
                    <h2>Add Exercise</h2>
                    <form id="event-add-form" onsubmit="AddNewEvent(event); return false;">
                        <div class="form-group">
                            <label for="exsName">Name:</label>
                            <input type="text" id="exsName" name="exsName">
                        </div>

                        <div class="form-group">
                            <label for="exsDesc">Description:</label>
                            <textarea id="exsDesc" name="exsDesc"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exsCtg">Category:</label>
                            <select id="exsCtg" name="exsCtg">
                                <option value="Footwork Drills">Footwork Drills</option>
                                <option value="Agility and Speed Training">Agility & Speed Training</option>
                                <option value="Strength Training">Strength Training</option>
                                <option value="Endurance Training">Endurance Training</option>
                                <option value="Hand-Eye Coordination">Hand-Eye Coordination</option>
                                <option value="Balance and Core Strength">Balance & Core Strength</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exsSOE">Set Of Exercise:</label>
                            <input type="number" id="exsSOE" name="exsSOE">
                        </div>

                        <div class="form-group">
                            <label for="exsDur">Duration(min):</label>
                            <input type="number" id="exsDur" name="exsDur">
                        </div>

                        <div class="form-group">
                            <label for="exsCburn">Calories Burn:</label>
                            <input type="number" id="exsCburn" name="exsCburn">
                        </div>

                        <div class="form-group">
                            <label for="exsVid">Video Link:</label>
                            <input type="text" id="exsVid" name="exsVid">
                        </div>

                        <div class="form-group">
                            <label for="exsImg">Image:</label>
                            <input type="file" id="exsImg" accept="image/*" name="exsImg">
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
            <div class="formDel--wrapper" id="delete-product-msg">
                <div class="popupDel">
                    <span class="popup-close" onclick="cancelDelExs()">&times;</span>
                    <h2>Are you sure to delete this execise?</h2>
                    <div class="delAction">
                        <input type="hidden" id="delExsId" name="delExsId">
                        <button type="button" 
                        onclick="deleteExercise(document.getElementById('delExsId').value)">Yes</button>
                        <button class="btnDel" type="button" onclick="cancelDelExs()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // add image new
            const previewImg = document.getElementById("previewImg");
            const exsImg = document.getElementById('exsImg');
            // edit image old
            const prvIMG = document.getElementById("prvIMG");
            const exsEdtImg = document.getElementById('exsEdtImg');

            exsEdtImg.addEventListener('change', function () {
                const file = exsEdtImg.files[0];
                if (file) {
                    convertImageToBase64Edt(file);
                }
            });

            function convertImageToBase64Edt(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    prvIMG.src = e.target.result;
                    prvIMG.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            exsImg.addEventListener('change', function () {
                const file = exsImg.files[0];
                if (file) {
                    convertImageToBase64(file);
                }
            });

            function convertImageToBase64(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
            
        </script>
        <script>
            const statusFilter = document.getElementById('status-filter');
            const tableBody = document.getElementById('exs-table-body');

            function fetchDataByOption(selectedOption) {
                fetch(`bdmtn_exs_by_ctgry.php?selectedOption=${selectedOption}`)
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
                                newRow.innerHTML = `
                                <td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                    onclick="openEditPopup('${row.id}')"></i></td>
                                    <td>${counter++}</td>
                                    <td>${row.id}</td>
                                    <td>${row.name}</td>
                                    <td class="description-cell">${row.description}</td>
                                    <td>${row.training_category}</td>
                                    <td>${row.setExercise}</td>
                                    <td>${row.duration_minutes}</td>
                                    <td>${row.calories_burned}</td>
                                    <td><img src="data:image/*;base64,${row.img_exr}" alt="Event Poster" class="popup-image" onclick="openImage('${row.img_exr}')"></td>
                                    <td><a href="${row.vid_exr}" target="_blank">Link</a></td>
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
                // Create a data URL from the Base64-encoded image
                    const dataUrl = `data:image/png;base64,${imageUrl}`;

                // Open the data URL in a new window
                const newWindow = window.open();
                newWindow.document.write(`<img src="${dataUrl}" width="800" height="600">`);
            }

        </script>
        <script>
            // start function for edit form
            function openEditPopup(id) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_exs_details.php?id=' + id, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var exerciseData = JSON.parse(xhr.responseText);

                            document.getElementById('exsIDEdt').value = id;
                            document.getElementById('exsNameEdt').value = exerciseData.name;
                            document.getElementById('exsDescEdt').value = exerciseData.description;
                            document.getElementById('exsCtgEdt').value = exerciseData.training_category;
                            document.getElementById('exsSOEEdt').value = exerciseData.setExercise;
                            document.getElementById('exsDurEdt').value = exerciseData.duration_minutes;
                            document.getElementById('exsCburnEdt').value = exerciseData.calories_burned;
                            document.getElementById('exsVidEdt').value = exerciseData.vid_exr;
                            //document.getElementById('exsEdtImg').value = exerciseData.img_exr;

                            // Load and display the exercise image
                            const imageUrl = exerciseData.img_exr;
                            document.getElementById('prvIMG').src = "data:image/*;base64," + imageUrl;
                            document.getElementById('prvIMG').style.display = 'block';

                            // Show edit exercise form
                            document.getElementById('edit-form').style.display = 'flex';
                        } else {
                            alert('Failed to fetch product details.');
                        }
                    }
                };

                xhr.send();
            }


            function removeEdtImage() {
                // Clear the image source and hide it
                document.getElementById('prvIMG').src = '';
                document.getElementById('prvIMG').style.display = 'none';

                // Clear the file input value (reset it)
                document.getElementById('exsEdtImgInput').value = '';

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
                document.getElementById('exsImgInput').value = '';

                // Optionally, you can also reset the hidden field that stores the image data if needed
                // document.getElementById('evtImg').value = '';

                // Show the "Add New Image" button again if needed
                // document.getElementById('addImgButton').style.display = 'block';
            }

            function msgDelExs(id){
                document.getElementById('delExsId').value = id;
                document.getElementById('delete-product-msg').style.display = 'flex';
            }

            function cancelDelExs(){
                document.getElementById('delete-product-msg').style.display = 'none';
            }

            function AddNewEvent(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                //var id = document.getElementById('evtID').value;
                /*var name = document.getElementById('exsName').value;
                var description = document.getElementById('exsDesc').value;
                var training_category = document.getElementById('exsCtg').value;
                var setExercise = document.getElementById('exsSOE').value;
                var duration_minutes = document.getElementById('exsDur').value;
                var calories_burned = document.getElementById('exsCburn').value;
                var vid_exr = document.getElementById('exsVid').value;*/

                const imageData = document.getElementById('previewImg').src.split(',')[1];

                var img_exr = imageData;

                // Define the data you want to send to the server here, e.g., user ID and updated fields
                const data = 'name=' + encodeURIComponent(document.getElementById('exsName').value) + '&' +
                    'description=' + encodeURIComponent(document.getElementById('exsDesc').value) + '&' +
                    'training_category=' + encodeURIComponent(document.getElementById('exsCtg').value) + '&' +
                    'setExercise=' + encodeURIComponent(document.getElementById('exsSOE').value) + '&' +
                    'duration_minutes=' + encodeURIComponent(document.getElementById('exsDur').value) + '&' +
                    'calories_burned=' + encodeURIComponent(document.getElementById('exsCburn').value) + '&' +
                    'img_exr=' + encodeURIComponent(imageData) + '&' +
                    'vid_exr=' + encodeURIComponent(document.getElementById('exsVid').value); // Use the base64-encoded image data
                
                // Validate the subject and body (you can add more validation)
                /*if (!name || !description || !training_category || !setExercise 
                || !duration_minutes || !calories_burned || !vid_exr || !img_exr) {
                    alert('Please fill out all fields in the add event form.');
                    return;
                }*/

                if (!imageData) {
                    alert('Profile image cannot be blank!');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'add_exs_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelAdd(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Add new exercise successfully!";
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

                /*var data = 'name=' + name + '&description=' + description +
                '&training_category=' + training_category + '&setExercise=' + setExercise + 
                '&duration_minutes=' + duration_minutes + '&calories_burned=' + calories_burned + 
                '&img_exr=' + img_exr + '&vid_exr=' + vid_exr;*/
                xhr.send(data);
            }

            function EditOldEvent(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                /*var id = document.getElementById('exsIDEdt').value;
                var name = document.getElementById('exsNameEdt').value;
                var description = document.getElementById('exsDescEdt').value;
                var training_category = document.getElementById('exsCtgEdt').value;
                var setExercise = document.getElementById('exsSOEEdt').value;
                var duration_minutes = document.getElementById('exsDurEdt').value;
                var calories_burned = document.getElementById('exsCburnEdt').value;
                var vid_exr = document.getElementById('exsVidEdt').value;*/

                const imageData = document.getElementById('prvIMG').src.split(',')[1];

                var img_exr = imageData;

                // Define the data you want to send to the server here, e.g., user ID and updated fields
                const data = 'id=' + encodeURIComponent(document.getElementById('exsIDEdt').value) + '&' +
                    'name=' + encodeURIComponent(document.getElementById('exsNameEdt').value) + '&' +
                    'description=' + encodeURIComponent(document.getElementById('exsDescEdt').value) + '&' +
                    'training_category=' + encodeURIComponent(document.getElementById('exsCtgEdt').value) + '&' +
                    'setExercise=' + encodeURIComponent(document.getElementById('exsSOEEdt').value) + '&' +
                    'duration_minutes=' + encodeURIComponent(document.getElementById('exsDurEdt').value) + '&' +
                    'calories_burned=' + encodeURIComponent(document.getElementById('exsCburnEdt').value) + '&' +
                    'img_exr=' + encodeURIComponent(imageData) + '&' +
                    'vid_exr=' + encodeURIComponent(document.getElementById('exsVidEdt').value); // Use the base64-encoded image data

                // Validate the subject and body (you can add more validation)
                /*if (!name || !description || !training_category || !setExercise 
                || !duration_minutes || !calories_burned || !vid_exr || !img_exr) {
                    alert('Please fill out all fields in the add event form.');
                    return;
                }*/

                if (!imageData) {
                    alert('Profile image cannot be blank!');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_exs_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Update data successfully!');
                            cancelEdit(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Update exercise successfully!";
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

                /*var data = 'id=' + id + '&name=' + name + '&description=' + description +
                '&training_category=' + training_category + '&setExercise=' + setExercise + 
                '&duration_minutes=' + duration_minutes + '&calories_burned=' + calories_burned + 
                '&img_exr=' + img_exr + '&vid_exr=' + vid_exr;*/
                xhr.send(data);
            }

            function deleteExercise(exsID){
                var exercise_id = exsID;

                // Validate the subject and body (you can add more validation)
                if (!exercise_id) {
                    alert('Exercise ID not detect');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'del_exs_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelDelExs();
                            cancelEdit(); // Close the popup after sending
                            // Display the popup
                            var checkDiv = document.getElementById('check');
                            checkDiv.style.display = 'flex';

                            // Center the popup on the screen
                            checkDiv.style.top = '50%';
                            checkDiv.style.left = '50%';
                            checkDiv.style.transform = 'translate(-50%, -50%)';

                            // Update the popup message
                            document.getElementById("check").innerHTML = "Exercise has been delete!";

                            // Set a timeout to hide the popup and reload the page
                            setTimeout(function () {
                                document.getElementById("check").innerHTML = "";
                                document.getElementById('check').style.display = 'none';
                                location.reload();
                            }, 3000);
                        } else {
                            alert('Failed to delete exercise.');
                        }
                    }
                };

                var data = 'id=' + exercise_id;
                xhr.send(data);
            }
        </script>
    </body>
</html>