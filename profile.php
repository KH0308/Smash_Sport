<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Profile</title>
        <?php include 'profile_action.php'; ?>
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
                <li class="active">
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

        <div class="main--cont--prof">
            <div class="eml-pic">
                <div class="image--with--icon">
                    <img id= "profileImage" src="data:image/*;base64,<?php echo $sImg; ?>" alt="Profile Picture">
                    <i class="fa fa-pencil" id="pclEdt" onclick="openUploadPic()"></i> 
                </div>
                <div id="uploadIMG">
                    <label for="profileUpload" class="profile-upload-label">Upload New Image</label>
                    <input type="file" id="profileUpload" accept="image/*" style="display: none;">
                    <button type="button" onclick="cancelUpload()">Cancel</button>
                </div>
                <h6><?php echo $FName;?></h6>
                <h6><?php echo $sMail;?></h6>
            </div>
            <div class="acc--info">
                <h3>Account Information</h3>
                <div class="row--info">
                    <label for="FName">First Name</label>
                    <input type="text" id="FName" placeholder="First Name" value="<?php echo $FName;?>" readonly>
                    <label for="LName">Last Name</label>
                    <input type="text" id="LName" placeholder="Last Name" value="<?php echo $LName;?>" readonly>
                </div>
                <div class="row--info">
                    <label for="Gender">Gender</label>
                    <input type="text" id="Gender" placeholder="Gender" value="<?php echo $sGdr;?>" readonly>
                    <label for="Age">Age</label>
                    <input type="text" id="Age" placeholder="Age" value="<?php echo $sAge;?>" readonly>
                </div>
                <div class="row--info">
                    <label for="Birthdate">Birthdate</label>
                    <input type="date" id="Birthdate" placeholder="Birthdate" value="<?php echo $sBirth;?>" readonly>
                    <label for="Position">Position</label>
                    <input type="text" id="Position" placeholder="Position" value="<?php echo $sPst;?>" readonly>
                </div>
                <div class="row--info">
                    <label for="Contact">Contact</label>
                    <input type="text" id="Contact" placeholder="Contact" value="<?php echo $sPhone;?>" readonly>
                    <label for="Email">Email</label>
                    <input type="text" id="Email" placeholder="Email" value="<?php echo $sMail;?>" readonly>
                </div>
                <div class="row--info">
                    <label for="Password">Account Password</label>
                    <input type="text" id="Password" placeholder="Password" value="<?php echo $sPwd;?>" readonly>
                </div>
                <div class="row--btn-edt-save">
                    <button class="btnEdt" id="editButton" type="button">Edit Profile</button>
                    <button class="btnSave" id="saveButton" type="button">Save Profile</button>
                </div>
                <!-- Popup message action -->
                <div class="check " style="background-color: rgb(168, 239, 248);" id="check"></div>
            </div>
        </div>
        <script>
            const profileImage = document.getElementById('profileImage');
            const profileUpload = document.getElementById('profileUpload');

            profileUpload.addEventListener('change', function () {
                const file = profileUpload.files[0];
                if (file) {
                    convertImageToBase64(file);
                }
            });

            function convertImageToBase64(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImage.src = e.target.result;
                    profileImage.style.display = 'flex';
                };
                reader.readAsDataURL(file);
            }
        </script>
        <script>
            const editButton = document.getElementById('editButton');
            const saveButton = document.getElementById('saveButton');
            const inputFields = document.querySelectorAll('.row--info input');
    
            editButton.addEventListener('click', function () {
                enableEditFields();
            });
    
            saveButton.addEventListener('click', function () {
                disableEditFields();
                sendUpdateRequest();
            });
    
            function enableEditFields() {
                inputFields.forEach(field => {
                    field.removeAttribute('readonly');
                });
    
                editButton.style.display = 'none';
                saveButton.style.display = 'block';
            }
    
            function disableEditFields() {
                inputFields.forEach(field => {
                    field.setAttribute('readonly', 'readonly');
                });
    
                editButton.style.display = 'block';
                saveButton.style.display = 'none';
            }

            function openUploadPic(){
                document.getElementById('uploadIMG').style.display = 'flex';
            }

            function cancelUpload() {
                document.getElementById('uploadIMG').style.display = 'none';
            }

            function sendUpdateRequest() {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_prof_action.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Get the base64-encoded image data from the profileImage element
                const imageData = profileImage.src.split(',')[1]; // Assuming the src is "data:image/*;base64,actualImageData"

                // Define the data you want to send to the server here, e.g., user ID and updated fields
                const data = 'FName=' + encodeURIComponent(document.getElementById('FName').value) + '&' +
                    'LName=' + encodeURIComponent(document.getElementById('LName').value) + '&' +
                    'Gender=' + encodeURIComponent(document.getElementById('Gender').value) + '&' +
                    'Age=' + encodeURIComponent(document.getElementById('Age').value) + '&' +
                    'Birthdate=' + encodeURIComponent(document.getElementById('Birthdate').value) + '&' +
                    'Position=' + encodeURIComponent(document.getElementById('Position').value) + '&' +
                    'Contact=' + encodeURIComponent(document.getElementById('Contact').value) + '&' +
                    'Email=' + encodeURIComponent(document.getElementById('Email').value) + '&' +
                    'Password=' + encodeURIComponent(document.getElementById('Password').value) + '&' +
                    'profImg=' + encodeURIComponent(imageData); // Use the base64-encoded image data

                // Validate the subject and body (you can add more validation)
                if (!imageData) {
                    alert('Profile image cannot be blank!');
                    return;
                }

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Update profile data successfully!');
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Update profile data successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to update data profile.');
                        }
                    }
                };

                // Send the data to the server
                xhr.send(data);
            }
        </script>
    </body>
</html>