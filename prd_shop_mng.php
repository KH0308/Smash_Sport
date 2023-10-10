<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>SS Shop</title>
        <?php include 'prd_shop_action.php'; ?>
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
                        <li><a href="shop_mng.php">Sales List</a></li>
                        <li class="active"><a href="prd_shop_mng.php">Sport Items Sales</a></li>
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
                <h3 class="main--title">Table Sport Products</h3>
                <div class="div--filter--button">
                    <div class="filter-options">
                        <label for="status-filter">Filter by category:</label>
                        <select id="status-filter">
                        <option value="all">All</option>
                            <option value="Limited Edition">Limited Edition</option>
                            <option value="Jacket">Jacket</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Pants">Pants</option>
                            <option value="Legging">Legging</option>
                            <option value="Sport Bra">Sport Bra</option>
                            <option value="Sock and Footwear">Sock & Footwear</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Sport Equipments">Sport Equipments</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn--add--news" onclick="tonggleAddForm()">Add New Product</button>
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
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price(RM)</th>
                                <th>Rating</th>
                                <th>Image</th>
                                <th>Product Variant</th>
                            </tr>
                        </thead>
                        <tbody id="prd-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                onclick='openEditPopup(" . $row["id"] . ")'></i></td>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["category"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . $row["rating"] . "</td>";
                                echo "<td><img src='" . $row["imageUrl"] . "' alt='Image Product' class='popup-image' onclick='openImage(\"" . $row["imageUrl"] . "\")'></td>";
                                echo "<td><i class='fa-solid fa-eye' style='color: #000000;' 
                                onclick='openViewVariant(" . $row["id"] . ")'></i></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tabular--wrapper--variant">
                <div class="div--filter--button" style="margin-bottom: 10px;">
                    <h3 class="main--title">Table Variant Products</h3>
                    <span class="popup-close" onclick="closedVrtTbl()">&times;</span>
                </div>
                <div class="div--filter--button" style="margin-bottom: 20px;">
                    <div>
                        <h3>Product Information</h3>
                        <p>ID: <span id="productId"></span></p>
                        <p>Name: <span id="productName"></span></p>
                    </div>
                    <div>
                        <button class="btn--add--news" onclick="tonggleAddFormVariant()">Add New Variant Product</button>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Num.</th>
                                <th> Variant ID</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="prdVrt-table-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Popup message action -->
            <div id="check"></div>

            <!-- Form for edit product -->
            <div class="form--wrapper" id="edit-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelEdit()">&times;</span>
                    <h2>Edit Product</h2>
                    <form id="event-edit-form" onsubmit="EditOldProduct(event); return false;">
                        <div class="form-group">
                            <label for="prdIDEdt">ID:</label>
                            <input type="text" id="prdIDEdt" name="prdIDEdt" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prdNameEdt">Product Name:</label>
                            <input type="text" id="prdNameEdt" name="prdNameEdt">
                        </div>

                        <div class="form-group">
                            <label for="prdCtgEdt">Category:</label>
                            <input type="text" id="prdCtgEdt" name="prdCtgEdt">
                        </div>

                        <div class="form-group">
                            <label for="prdDescEdt">Description:</label>
                            <textarea id="prdDescEdt" name="prdDescEdt"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="prdPrcEdt">Price(RM):</label>
                            <input type="number" id="prdPrcEdt" name="prdPrcEdt">
                        </div>

                        <div class="form-group">
                            <label for="prdRtgEdt">Rating:</label>
                            <input type="number" id="prdRtgEdt" name="prdRtgEdt" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prdImgEdt">Image Link:</label>
                            <input type="text" id="prdEdtImgInput" name="prdImgEdt">
                            <img id="prvIMG" src="" alt="Preview Image" style="max-width: 200px; display: none;">
                            <button type="button" id="removeEdtImgButton" onclick="removeEdtImage()">Remove Image</button>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="cancelEdit()">Cancel</button>
                            <button class="btnDel" type="button" onclick="msgDelPrd(document.getElementById('prdIDEdt').value)">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form for adding product -->
            <div class="formAdd--wrapper" id="add-form">
                <div class="popup">
                    <span class="popup-close" onclick="cancelAdd()">&times;</span>
                    <h2>Add Product</h2>
                    <form id="event-add-form" onsubmit="AddNewProduct(event); return false;">
                        <div class="form-group">
                            <label for="prdName">Product Name:</label>
                            <input type="text" id="prdName" name="prdName">
                        </div>

                        <div class="form-group">
                            <label for="prdCtgy">Category:</label>
                            <input type="text" id="prdCtgy" name="prdCtgy">
                        </div>

                        <div class="form-group">
                            <label for="prdDesc">Description:</label>
                            <textarea id="prdDesc" name="prdDesc"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="prdPrc">Price(RM):</label>
                            <input type="text" id="prdPrc" name="prdPrc">
                        </div>

                        <div class="form-group">
                            <label for="prdRtg">Rating(Default):</label>
                            <input type="number" id="prdRtg" name="prdRtg" value="5.0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prdImg">Image Link:</label>
                            <input type="text" id="prdImgInput" name="prdImg">
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

            <!-- Form for edit product variant -->
            <div class="form--wrapper" id="edit-form-variant">
                <div class="popup">
                    <span class="popup-close" onclick="cancelEditVariant()">&times;</span>
                    <h2>Edit Product Variant</h2>
                    <form id="variant-edit-form" onsubmit="EditOldProductVariant(event); return false;">
                        <div class="form-group">
                            <label for="productIDEdt">Product ID:</label>
                            <input type="text" id="productIDEdt" name="productIDEdt" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="prdVrtIDEdt">Variant ID:</label>
                            <input type="text" id="prdVrtIDEdt" name="prdVrtIDEdt" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prdVrtClrEdt">Color:</label>
                            <select id="prdVrtClrEdt" name="prdVrtClrEdt">
                                <option value="blk">Black</option>
                                <option value="blu">Blue</option>
                                <option value="brn">Brown</option>
                                <option value="chlt">Chocholate</option>
                                <option value="gry">Gray</option>
                                <option value="nClr">No Color</option>
                                <option value="pnk">Pink</option>
                                <option value="rd">Red</option>
                                <option value="wht">White</option>
                                <option value="ylw">Yellow</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prdVrtSzEdt">Size:</label>
                            <select id="prdVrtSzEdt" name="prdVrtSzEdt">
                                <option value="1">XS</option>
                                <option value="2">S</option>
                                <option value="3">M</option>
                                <option value="4">L</option>
                                <option value="5">XL</option>
                                <option value="6">5</option>
                                <option value="7">5.5</option>
                                <option value="8">6</option>
                                <option value="9">6.5</option>
                                <option value="10">7</option>
                                <option value="11">7.5</option>
                                <option value="12">8</option>
                                <option value="13">8.5</option>
                                <option value="14">9</option>
                                <option value="15">9.5</option>
                                <option value="16">10</option>
                                <option value="17">11</option>
                                <option value="18">12</option>
                                <option value="19">13</option>
                                <option value="20">8C</option>
                                <option value="21">9C</option>
                                <option value="22">10C</option>
                                <option value="23">11C</option>
                                <option value="24">12C</option>
                                <option value="25">13C</option>
                                <option value="26">1Y</option>
                                <option value="27">2Y</option>
                                <option value="28">3Y</option>
                                <option value="29">No Sized</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prdVrtQtyEdt">Quantity:</label>
                            <input type="number" id="prdVrtQtyEdt" name="prdVrtQtyEdt">
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="cancelEditVariant()">Cancel</button>
                            <button class="btnDel" type="button" onclick="msgDelVrt(document.getElementById('prdVrtIDEdt').value)">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form for adding product variant-->
            <div class="formAdd--wrapper" id="add-form-variant">
                <div class="popup">
                    <span class="popup-close" onclick="cancelAddVariant()">&times;</span>
                    <h2>Add Product Variant</h2>
                    <form id="variant-add-form" onsubmit="AddNewProductVariant(event); return false;">
                        <div class="form-group">
                            <label for="productID">Product ID:</label>
                            <input type="text" id="productID" name="productID" readonly>
                        </div>    

                        <div class="form-group">
                            <label for="prdVrtClr">Color:</label>
                            <select id="prdVrtClr" name="prdVrtClr">
                                <option value="blk">Black</option>
                                <option value="blu">Blue</option>
                                <option value="brn">Brown</option>
                                <option value="chlt">Chocholate</option>
                                <option value="gry">Gray</option>
                                <option value="nClr">No Color</option>
                                <option value="pnk">Pink</option>
                                <option value="rd">Red</option>
                                <option value="wht">White</option>
                                <option value="ylw">Yellow</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prdVrtSz">Size:</label>
                            <select id="prdVrtSz" name="prdVrtSz">
                                <option value="1">XS</option>
                                <option value="2">S</option>
                                <option value="3">M</option>
                                <option value="4">L</option>
                                <option value="5">XL</option>
                                <option value="6">5</option>
                                <option value="7">5.5</option>
                                <option value="8">6</option>
                                <option value="9">6.5</option>
                                <option value="10">7</option>
                                <option value="11">7.5</option>
                                <option value="12">8</option>
                                <option value="13">8.5</option>
                                <option value="14">9</option>
                                <option value="15">9.5</option>
                                <option value="16">10</option>
                                <option value="17">11</option>
                                <option value="18">12</option>
                                <option value="19">13</option>
                                <option value="20">8C</option>
                                <option value="21">9C</option>
                                <option value="22">10C</option>
                                <option value="23">11C</option>
                                <option value="24">12C</option>
                                <option value="25">13C</option>
                                <option value="26">1Y</option>
                                <option value="27">2Y</option>
                                <option value="28">3Y</option>
                                <option value="29">No Sized</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prdVrtQty">Quantity:</label>
                            <input type="number" id="prdVrtQty" name="prdVrtQty">
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Save">
                            <button type="button" onclick="resetAddVariant()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="formDel--wrapper" id="delete-product-msg">
                <div class="popupDel">
                    <span class="popup-close" onclick="cancelDelProduct()">&times;</span>
                    <h2>Are you sure to delete this product?</h2>
                    <div class="delAction">
                        <input type="hidden" id="delPrdId" name="delPrdId">
                        <button type="button" 
                        onclick="deleteProduct(document.getElementById('delPrdId').value)">Yes</button>
                        <button class="btnDel" type="button" onclick="cancelDelProduct()">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="formDel--wrapper" id="delete-variant-msg">
                <div class="popupDel">
                    <span class="popup-close" onclick="cancelDelVariant()">&times;</span>
                    <h2>Are you sure to delete this product variant?</h2>
                    <div class="delAction">
                        <input type="hidden" id="delVrtPrdId" name="delVrtPrdId">
                        <button type="button" 
                        onclick="deleteVariant(document.getElementById('delVrtPrdId').value)">Yes</button>
                        <button class="btnDel" type="button" onclick="cancelDelVariant()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("prdImgInput").addEventListener("input", function() {
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

            document.getElementById("prdEdtImgInput").addEventListener("input", function() {
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
            const tableBody = document.getElementById('prd-table-body');

            function fetchDataByOption(selectedOption) {
                fetch(`prd_by_ctgry_action.php?selectedOption=${selectedOption}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = ''; // Clear the table body
                        if (data.length === 0) {
                            // If there are no records, display a message or colspan the entire row.
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="10">No data available</td>
                            `;
                            tableBody.appendChild(noDataRow);
                        } else {
                            let counter = 1;
                            data.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td><i class='fa-solid fa-pencil' style='color: #000000;' 
                                    onclick='openEditPopup(${row.id})'></i></td>
                                    <td>${counter++}</td>
                                    <td>${row.id}</td>
                                    <td>${row.name}</td>
                                    <td>${row.category}</td>
                                    <td>${row.description}</td>
                                    <td>${row.price}</td>
                                    <td>${row.rating}</td>
                                    <td><img src="${row.imageUrl}" alt="Image product" class="popup-image" onclick="openImage('${row.imageUrl}')"></td>
                                    <td><i class='fa-solid fa-eye' style='color: #000000;' 
                                    onclick='openViewVariant(${row.id})'></i></td>
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
            function openEditPopup(id) {
                // Make an AJAX request to fetch product details based on the ID
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_product_details.php?id=' + id, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var productData = JSON.parse(xhr.responseText);

                            // Set the form fields with the fetched product details
                            document.getElementById('prdIDEdt').value = productData.id;
                            document.getElementById('prdNameEdt').value = productData.name;
                            document.getElementById('prdCtgEdt').value = productData.category;
                            document.getElementById('prdDescEdt').value = productData.description;
                            document.getElementById('prdPrcEdt').value = productData.price;
                            document.getElementById('prdRtgEdt').value = productData.rating;
                            document.getElementById('prdEdtImgInput').value = productData.imageUrl;

                            // Update the image preview
                            document.getElementById('prvIMG').src = productData.imageUrl;
                            document.getElementById('prvIMG').style.display = 'block';

                            // Show the edit event form
                            document.getElementById('edit-form').style.display = 'flex';
                        } else {
                            alert('Failed to fetch product details.');
                        }
                    }
                };

                xhr.send();
            }

            function openViewVariant(id){
                const tableVariantBody = document.getElementById('prdVrt-table-body');
                const variantDiv = document.getElementById('tabular--wrapper--variant');
                const productIdSpan = document.getElementById('productId');
                const productNameSpan = document.getElementById('productName');
    
                if (variantDiv) {

                    fetch(`prd_variant_action.php?prdID=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const productInfo = data.productInfo;
                        const productVariants = data.productVariants;

                        // Display product information
                        productIdSpan.textContent = productInfo.id;
                        productNameSpan.textContent = productInfo.name;

                        tableVariantBody.innerHTML = ''; // Clear the table body
                        if (productVariants.length === 0) {
                            // If there are no variants, display a message
                            const noDataRow = document.createElement('tr');
                            noDataRow.innerHTML = `
                                <td colspan="6">No data available</td>
                            `;
                            tableVariantBody.appendChild(noDataRow);
                        } else {
                            let counter = 1;
                            productVariants.forEach(row => {
                                const newRow = document.createElement('tr');
                                newRow.innerHTML = `
                                    <td><i class='fa-solid fa-pencil' style='color: #000000;'
                                    onclick='openEditPrdVrt(${productInfo.id}, \"${row.id}\", \"${row.color_id}\",
                                    \"${row.size_id}\", \"${row.quantity}\")'></i></td>
                                    <td>${counter++}</td>
                                    <td>${row.id}</td>
                                    <td>${row.Color}</td>
                                    <td>${row.Size}</td>
                                    <td>${row.quantity}</td>
                                `;
                                tableVariantBody.appendChild(newRow);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));

                    variantDiv.style.display = 'block';
                    variantDiv.scrollIntoView({ behavior: 'smooth' }); // Smooth scrolling
                }
                 
            }

            function openEditPrdVrt(prdID, id, color, size, quantity){
                document.getElementById('productIDEdt').value = prdID;
                document.getElementById('prdVrtIDEdt').value = id;
                document.getElementById('prdVrtClrEdt').value = color;
                document.getElementById('prdVrtSzEdt').value = size;
                document.getElementById('prdVrtQtyEdt').value = quantity;

                // Show edit event form
                document.getElementById('edit-form-variant').style.display = 'flex';
            }

            function closedVrtTbl() {
                const variantDiv = document.getElementById('tabular--wrapper--variant');
                variantDiv.style.display = 'none';
            }

            function removeEdtImage() {
                // Clear the image source and hide it
                document.getElementById('prvIMG').src = '';
                document.getElementById('prvIMG').style.display = 'none';

                // Clear the file input value (reset it)
                document.getElementById('prdEdtImgInput').value = '';

                // Optionally, you can also reset the hidden field that stores the image data if needed
                // document.getElementById('evtImgEdt').value = '';

                // Show the "Add New Image" button again if needed
                // document.getElementById('evtEdtImgInput').style.display = 'block';
            }

            function cancelEdit() {
                // Close the popup
                document.getElementById('edit-form').style.display = 'none';
            }

            function cancelEditVariant(){
                // Close the popup
                document.getElementById('edit-form-variant').style.display = 'none';
            }

            //function for add form
            function tonggleAddForm(){
                //show add event form
                document.getElementById('add-form').style.display = 'flex';
            }

            function tonggleAddFormVariant(){
                //show add event form
                const productIdSpan = document.getElementById('productId');
                const productId = productIdSpan.textContent.trim(); // Get the product ID from the span
                openAddVariantForm(productId);
            }

            function openAddVariantForm(productId) {
                // Get the "Product ID" input element
                const productIDInput = document.getElementById('productID');

                // Set the value of the "Product ID" input field
                productIDInput.value = productId;

                // Show the add variant form
                const addVariantForm = document.getElementById('add-form-variant');
                addVariantForm.style.display = 'flex';
            }

            function resetAdd(){
                //reset form add
                const rstAdd = document.getElementById('event-add-form');
                rstAdd.reset();
            }

            function resetAddVariant(){
                //reset form add variant
                // Get the form element
                const variantAddForm = document.getElementById('variant-add-form');

                // Iterate through all form elements except "Product ID"
                const formElements = variantAddForm.elements;
                for (let i = 0; i < formElements.length; i++) {
                    const element = formElements[i];
                    if (element.id !== 'productID' && element.type !== 'submit') {
                        // Reset the value of the form element
                        element.value = '';
                    }
                }
            }

            function cancelAdd() {
                // Close the popup
                document.getElementById('add-form').style.display = 'none';
            }

            function cancelAddVariant() {
                // Close the popup
                document.getElementById('add-form-variant').style.display = 'none';
            }

            function removeAddImage() {
                // Clear the image source and hide it
                document.getElementById('previewImg').src = '';
                document.getElementById('previewImg').style.display = 'none';

                // Clear the file input value (reset it)
                document.getElementById('prdImgInput').value = '';

                // Optionally, you can also reset the hidden field that stores the image data if needed
                // document.getElementById('evtImg').value = '';

                // Show the "Add New Image" button again if needed
                // document.getElementById('addImgButton').style.display = 'block';
            }

            function msgDelPrd(id){
                document.getElementById('delPrdId').value = id;
                document.getElementById('delete-product-msg').style.display = 'flex';
            }

            function msgDelVrt(id){
                document.getElementById('delVrtPrdId').value = id;
                document.getElementById('delete-variant-msg').style.display = 'flex';
            }

            function cancelDelProduct(){
                document.getElementById('delete-product-msg').style.display = 'none';
            }

            function cancelDelVariant(){
                document.getElementById('delete-variant-msg').style.display = 'none';
            }

            function AddNewProduct(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                //var id = document.getElementById('evtID').value;
                var name = document.getElementById('prdName').value;
                var category = document.getElementById('prdCtgy').value;
                var description = document.getElementById('prdDesc').value;
                var price = document.getElementById('prdPrc').value;
                var rating = document.getElementById('prdRtg').value;
                var imageUrl = document.getElementById('prdImgInput').value;

                // Validate the subject and body (you can add more validation)
                if (!name || !category || !description || !price 
                || !rating || !imageUrl) {
                    alert('Please fill out all fields in the add product form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'add_prd_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelAdd(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Add new product successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to add product.');
                        }
                    }
                };

                var data = 'name=' + name + '&category=' + category +
                '&description=' + description + '&price=' + price + '&rating=' + rating + '&imageUrl=' + imageUrl;
                xhr.send(data);
            }

            function AddNewProductVariant(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                var product_id = document.getElementById('productID').value;
                var color_id = document.getElementById('prdVrtClr').value;
                var size_id = document.getElementById('prdVrtSz').value;
                var quantity = document.getElementById('prdVrtQty').value;

                // Validate the subject and body (you can add more validation)
                if (!product_id || !color_id || !size_id || !quantity) {
                    alert('Please fill out all fields in the add product variant form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'add_prd_vrt_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelAddVariant(); // Close the popup after sending
                            document.getElementById('check').style.display = 'block';
                            document.getElementById("check").innerHTML="Add new variety successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to add new variant.');
                        }
                    }
                };

                var data = 'product_id=' + product_id + '&color_id=' + color_id +
                '&size_id=' + size_id + '&quantity=' + quantity;
                xhr.send(data);
            }

            function EditOldProduct(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                var id = document.getElementById('prdIDEdt').value;
                var name = document.getElementById('prdNameEdt').value;
                var category = document.getElementById('prdCtgEdt').value;
                var description = document.getElementById('prdDescEdt').value;
                var price = document.getElementById('prdPrcEdt').value;
                var rating = document.getElementById('prdRtgEdt').value;
                var imageUrl = document.getElementById('prdEdtImgInput').value;

                // Validate the subject and body (you can add more validation)
                if (!id || !name || !category || !description || !price 
                || !rating || !imageUrl) {
                    alert('Please fill out all fields in the edit product form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_prd_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Update data successfully!');
                            cancelEdit(); // Close the popup after sending
                            document.getElementById('check').style.display = 'flex';
                            document.getElementById("check").innerHTML="Update product successfully!";
                            //set time out
                            setTimeout(function(){
                            document.getElementById("check").innerHTML="";
                            document.getElementById('check').style.display = 'none';
                            location.reload();
                            },3000,);
                        } else {
                            alert('Failed to update product.');
                        }
                    }
                };

                var data = 'id=' + id + '&name=' + name + '&category=' + category +
                '&description=' + description + '&price=' + price + '&rating=' + rating + '&imageUrl=' + imageUrl;
                xhr.send(data);
            }

            function EditOldProductVariant(event){
                // Prevent the default form submission behavior
                event.preventDefault();
                var product_id = document.getElementById('productIDEdt').value;
                var variant_id = document.getElementById('prdVrtIDEdt').value;
                var color_id = document.getElementById('prdVrtClrEdt').value;
                var size_id = document.getElementById('prdVrtSzEdt').value;
                var quantity = document.getElementById('prdVrtQtyEdt').value;

                // Validate the subject and body (you can add more validation)
                if (!product_id || !variant_id || !color_id || !size_id || !quantity) {
                    alert('Please fill out all fields in the edit product variant form.');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_prd_vrt_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelEditVariant(); // Close the popup after sending
                            // Display the popup
                            var checkDiv = document.getElementById('check');
                            checkDiv.style.display = 'flex';

                            // Center the popup on the screen
                            checkDiv.style.top = '50%';
                            checkDiv.style.left = '50%';
                            checkDiv.style.transform = 'translate(-50%, -50%)';

                            // Update the popup message
                            document.getElementById("check").innerHTML = "Update old variety successfully!";

                            // Set a timeout to hide the popup and reload the page
                            setTimeout(function () {
                                document.getElementById("check").innerHTML = "";
                                document.getElementById('check').style.display = 'none';
                                location.reload();
                            }, 3000);
                        } else {
                            alert('Failed to update old variety.');
                        }
                    }
                };

                var data = 'product_id=' + product_id + '&variant_id=' + variant_id + '&color_id=' + color_id +
                '&size_id=' + size_id + '&quantity=' + quantity;
                xhr.send(data);
            }

            function deleteProduct(prdID) {
                var product_id = prdID;

                // Validate the subject and body (you can add more validation)
                if (!product_id) {
                    alert('Product ID not detect');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'del_prd_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelDelProduct();
                            cancelEdit(); // Close the popup after sending
                            // Display the popup
                            var checkDiv = document.getElementById('check');
                            checkDiv.style.display = 'flex';

                            // Center the popup on the screen
                            checkDiv.style.top = '50%';
                            checkDiv.style.left = '50%';
                            checkDiv.style.transform = 'translate(-50%, -50%)';

                            // Update the popup message
                            document.getElementById("check").innerHTML = "Product has been delete!";

                            // Set a timeout to hide the popup and reload the page
                            setTimeout(function () {
                                document.getElementById("check").innerHTML = "";
                                document.getElementById('check').style.display = 'none';
                                location.reload();
                            }, 3000);
                        } else {
                            alert('Failed to delete product.');
                        }
                    }
                };

                var data = 'id=' + product_id;
                xhr.send(data);
            }

            function deleteVariant(vrtID) {
                var variant_id = vrtID;

                // Validate the subject and body (you can add more validation)
                if (!variant_id) {
                    alert('Variant ID not detect');
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'del_prd_vrt_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            //alert('Add data sent successfully!');
                            cancelDelVariant();
                            cancelEditVariant(); // Close the popup after sending
                            // Display the popup
                            var checkDiv = document.getElementById('check');
                            checkDiv.style.display = 'flex';

                            // Center the popup on the screen
                            checkDiv.style.top = '50%';
                            checkDiv.style.left = '50%';
                            checkDiv.style.transform = 'translate(-50%, -50%)';

                            // Update the popup message
                            document.getElementById("check").innerHTML = "Varient product has been delete!";

                            // Set a timeout to hide the popup and reload the page
                            setTimeout(function () {
                                document.getElementById("check").innerHTML = "";
                                document.getElementById('check').style.display = 'none';
                                location.reload();
                            }, 3000);
                        } else {
                            alert('Failed to delete variety product.');
                        }
                    }
                };

                var data = 'id=' + variant_id;
                xhr.send(data);
            }
        </script>
    </body>
</html>