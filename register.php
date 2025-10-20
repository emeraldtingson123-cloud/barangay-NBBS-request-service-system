<?php
// register.php
include_once 'connection.php';
session_start();

// --- Redirect if already logged in ---
if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){
    $user_id = $_SESSION['user_id'];
    // --- Use Prepared Statements to prevent SQL Injection ---
    $sql_check = "SELECT user_type FROM users WHERE id = ?";
    $stmt = $con->prepare($sql_check);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result_check = $stmt->get_result();

    if ($result_check->num_rows > 0) {
        $row_check = $result_check->fetch_assoc();
        $account_type = $row_check['user_type'];
        $redirect_url = '';
        if ($account_type == 'admin') $redirect_url = "admin/dashboard.php";
        elseif ($account_type == 'secretary') $redirect_url = "secretary/dashboard.php";
        else $redirect_url = "resident/dashboard.php";
        echo "<script>window.location.href='$redirect_url';</script>";
        exit(); // --- Important: Stop script execution ---
    }
}

// --- Fetch Barangay Information ---
$barangay_info = [];
$sql_info = "SELECT * FROM `barangay_information` LIMIT 1";
$query_info = $con->query($sql_info);
if($query_info && $query_info->num_rows > 0){
    $barangay_info = $query_info->fetch_assoc();
}

// --- Set default values to avoid errors ---
$barangay = $barangay_info['barangay'] ?? 'Portal';
$image = $barangay_info['image'] ?? 'default_logo.png';
$postal_address = $barangay_info['postal_address'] ?? 'Official Barangay Address';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Barangay Portal</title>
    
    <!-- Modern CSS for this page -->
    <link rel="stylesheet" href="css/register-style.css">

    <!-- Font Awesome Icons & SweetAlert2 CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert2/css/sweetalert2.min.css">

</head>


<style> 
/* --- Google Font Import --- */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

/* --- CSS Variables for Easy Theming --- */
:root {
    --primary-color: #0037af;
    --accent-color: #28a745; /* Success Green */
    --danger-color: #dc3545;
    --text-color-light: #ffffff;
    --text-color-dark: #333;
    --body-bg-color: #f0f2f5;
    --panel-bg-color: #ffffff;
    --border-color: #dee2e6;
}

/* --- Global Reset and Base Styles --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: var(--text-color-dark);
    line-height: 1.6;
    background: 
        linear-gradient(rgba(0, 55, 175, 0.85), rgba(0, 55, 175, 0.85)),
        url('../assets/logo/cover.jpg') no-repeat center center/cover;
    background-attachment: fixed;
}

a {
    text-decoration: none;
    color: var(--primary-color);
}

ul {
    list-style: none;
}

img {
    max-width: 100%;
    display: block;
}

/* --- Page Structure --- */
.page-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.main-content {
    flex-grow: 1;
    padding: 40px 20px;
}

.register-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

/* --- Header & Footer (Consistent with other pages) --- */
.main-header, .main-footer {
    background-color: var(--primary-color);
    color: var(--text-color-light);
    flex-shrink: 0;
}
.main-header { height: 80px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
.nav-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; height: 100%; }
.brand { display: flex; align-items: center; gap: 15px; }
.brand__logo { height: 50px; width: 50px; border-radius: 50%; object-fit: cover; }
.brand__title { font-weight: 700; font-size: 1.2rem; color: var(--text-color-light); }
.nav-links { display: flex; gap: 30px; }
.nav-links a { color: var(--text-color-light); padding: 10px 5px; position: relative; }
.nav-links a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 3px; background-color: var(--danger-color); transition: width 0.3s ease; }
.nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
.nav-links i { margin-right: 8px; }
.main-footer { padding: 20px; text-align: center; }
.main-footer i { margin-right: 8px; color: var(--danger-color); }

/* --- Left Profile Panel --- */
.profile-panel {
    flex: 0 0 320px; /* Do not grow, do not shrink, base width 320px */
    background: var(--panel-bg-color);
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    position: sticky;
    top: 40px; /* Sticky position relative to viewport */
}

.image-uploader {
    text-align: center;
    margin-bottom: 20px;
}
.image-uploader .profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 15px auto;
    border: 4px solid var(--border-color);
    cursor: pointer;
    transition: all 0.3s ease;
}
.image-uploader .profile-image:hover {
    border-color: var(--primary-color);
    transform: scale(1.05);
}
.profile-name {
    text-align: center;
    font-weight: 600;
    font-size: 1.2rem;
    color: var(--primary-color);
    min-height: 25px;
    margin-bottom: 25px;
}

/* --- Right Form Panel with Tabs --- */
.form-panel {
    flex-grow: 1; /* Take up remaining space */
    background: var(--panel-bg-color);
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    overflow: hidden; /* To contain border-radius */
}

/* Custom Tabs */
.form-tabs {
    display: flex;
    background-color: #f8f9fa;
    border-bottom: 1px solid var(--border-color);
}
.tab-button {
    padding: 15px 20px;
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    color: #6c757d;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}
.tab-button.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
}
.tab-button:hover:not(.active) {
    color: var(--primary-color);
}

.form-content {
    padding: 30px;
}
.tab-pane {
    display: none; /* Hide all panes by default */
    animation: fadeIn 0.5s ease;
}
.tab-pane.active {
    display: block; /* Show only the active one */
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}
.form-grid .full-width {
    grid-column: 1 / -1;
}
.tab-pane > .lead {
    font-size: 1.2rem;
    font-weight: 600;
    text-align: center;
    margin-bottom: 25px;
    color: var(--primary-color);
}

/* --- Universal Form Styling --- */
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    font-size: 0.9rem;
}
.form-control {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 55, 175, 0.25);
}
/* For jquery-validation */
.form-control.is-invalid {
    border-color: var(--danger-color);
}
.form-control.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}
.invalid-feedback {
    color: var(--danger-color);
    font-size: 0.875em;
    display: block;
    margin-top: .25rem;
}

/* Account Fields specific styling */
.input-wrapper {
    position: relative;
}
.input-wrapper i.fas {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
}
.input-wrapper .form-control {
    padding-left: 45px;
}
#show_hide_password a, #show_hide_password_confirm a {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
}

.form-footer {
    padding: 20px 30px;
    background-color: #f8f9fa;
    border-top: 1px solid var(--border-color);
    text-align: right;
}
.btn-submit {
    background-color: var(--accent-color);
    color: var(--text-color-light);
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn-submit:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.btn-submit i {
    margin-right: 8px;
}

/* --- Responsive Design --- */
@media (max-width: 992px) {
    .register-container {
        flex-direction: column;
    }
    .profile-panel {
        width: 100%;
        position: static; /* Remove sticky behavior on mobile */
    }
}
@media (max-width: 768px) {
    .nav-container { flex-direction: column; height: auto; padding: 15px; }
    .nav-links { margin-top: 15px; }
    .form-grid { grid-template-columns: 1fr; } /* Stack grid items */
    .form-grid .full-width { grid-column: auto; } /* Reset grid column span */
    .form-tabs { flex-wrap: wrap; }
    .tab-button { flex-grow: 1; }
}
</style>
<body>

<div class="page-wrapper">

    <!-- Header -->
    <header class="main-header">
        <nav class="nav-container">
            <a href="index.php" class="brand">
                <img src="assets/dist/img/barangaylogo.png" alt="logo" class="brand__logo">
                <span class="brand__title">BARANGAY MANAGEMENT SYSTEM</span>
            </a>
            <ul class="nav-links">
                <li><a href="index.php">HOME</a></li>
                <li><a href="register.php" class="active"><i class="fas fa-user-plus"></i> REGISTER</a></li>
                <li><a href="login.php"><i class="fas fa-user-alt"></i> LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <form id="registerResidentForm" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="register-container">

                <!-- Left Panel: Profile Image & Details -->
                <div class="profile-panel">
                    <div class="image-uploader">
                        <img class="profile-image" src="assets/dist/img/blank_image.png" alt="User profile picture" id="image_residence" title="Click to upload an image">
                        <input type="file" name="add_image_residence" id="add_image_residence" style="display: none;">
                    </div>
                    <h3 class="profile-name"><span id="keyup_first_name"></span> <span id="keyup_last_name"></span></h3>
                    
                    <div class="form-group">
                        <label for="add_gender">Gender</label>
                        <select name="add_gender" id="add_gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_birth_date">Date of Birth</label>
                        <input type="date" class="form-control" id="add_birth_date" name="add_birth_date">
                    </div>
                    <div class="form-group">
                        <label for="add_birth_place">Place of Birth</label>
                        <input type="text" class="form-control" id="add_birth_place" name="add_birth_place">
                    </div>
                     <div class="form-group">
                        <label for="add_voters">Registered Voter?</label>
                        <select name="add_voters" id="add_voters" class="form-control">
                            <option value=""></option>
                            <option value="NO">NO</option>
                            <option value="YES">YES</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_pwd">Person with Disability (PWD)?</label>
                        <select name="add_pwd" id="add_pwd" class="form-control">
                            <option value=""></option>
                            <option value="NO">NO</option>
                            <option value="YES">YES</option>
                        </select>
                    </div>
                    <div class="form-group" id="pwd_check" style="display: none;">
                        <label for="add_pwd_info">Type of Disability</label>
                        <input type="text" class="form-control" id="add_pwd_info" name="add_pwd_info">
                    </div>
                    <div class="form-group">
                        <label for="add_single_parent">Single Parent?</label>
                        <select name="add_single_parent" id="add_single_parent" class="form-control">
                            <option value=""></option>
                            <option value="NO">NO</option>
                            <option value="YES">YES</option>
                        </select>
                    </div>
                </div>

                <!-- Right Panel: Tabbed Form -->
                <div class="form-panel">
                    <div class="form-tabs">
                        <button type="button" class="tab-button active" data-tab="basic-info">Basic Info</button>
                        <button type="button" class="tab-button" data-tab="other-info">Other Info</button>
                        <button type="button" class="tab-button" data-tab="guardian">Guardian</button>
                        <button type="button" class="tab-button" data-tab="account">Account</button>
                    </div>
                    <div class="form-content">
                        <!-- Tab 1: Basic Info -->
                        <div class="tab-pane active" id="basic-info">
                            <p class="lead">Personal Details</p>
                            <div class="form-grid">
                                <div class="form-group full-width">
                                    <label for="add_first_name">First Name</label>
                                    <input type="text" class="form-control" id="add_first_name" name="add_first_name">
                                </div>
                                <div class="form-group full-width">
                                    <label for="add_middle_name">Middle Name (Optional)</label>
                                    <input type="text" class="form-control" id="add_middle_name" name="add_middle_name">
                                </div>
                                <div class="form-group full-width">
                                    <label for="add_last_name">Last Name</label>
                                    <input type="text" class="form-control" id="add_last_name" name="add_last_name">
                                </div>
                                <div class="form-group">
                                    <label for="add_suffix">Suffix (e.g., Jr., Sr., III) (Optional)</label>
                                    <input type="text" class="form-control" id="add_suffix" name="add_suffix">
                                </div>
                                <div class="form-group">
                                    <label for="add_civil_status">Civil Status</label>
                                    <select name="add_civil_status" id="add_civil_status" class="form-control">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="add_religion">Religion</label>
                                    <input type="text" class="form-control" id="add_religion" name="add_religion">
                                </div>
                                <div class="form-group">
                                    <label for="add_nationality">Nationality</label>
                                    <input type="text" class="form-control" id="add_nationality" name="add_nationality">
                                </div>
                            </div>
                        </div>
                        <!-- Tab 2: Other Info -->
                        <div class="tab-pane" id="other-info">
                             <p class="lead">Address & Contact</p>
                             <div class="form-grid">
                                <div class="form-group"><label for="add_house_number">House/Unit No.</label><input type="text" class="form-control" id="add_house_number" name="add_house_number"></div>
                                <div class="form-group"><label for="add_street">Street</label><input type="text" class="form-control" id="add_street" name="add_street"></div>
                                <div class="form-group"><label for="add_barangay">Barangay</label><input type="text" class="form-control" id="add_barangay" name="add_barangay"></div>
                                <div class="form-group"><label for="add_municipality">Municipality/City</label><input type="text" class="form-control" id="add_municipality" name="add_municipality"></div>
                                <div class="form-group"><label for="add_zip">Zip Code</label><input type="text" class="form-control" id="add_zip" name="add_zip"></div>
                                <div class="form-group"><label for="add_address">Address Line</label><input type="text" class="form-control" id="add_address" name="add_address"></div>
                                <div class="form-group"><label for="add_contact_number">Contact Number</label><input type="text" maxlength="11" class="form-control" id="add_contact_number" name="add_contact_number"></div>
                                <div class="form-group"><label for="add_email_address">Email Address (Optional)</label><input type="email" class="form-control" id="add_email_address" name="add_email_address"></div>
                             </div>
                        </div>
                        <!-- Tab 3: Guardian -->
                        <div class="tab-pane" id="guardian">
                            <p class="lead">Guardian Information</p>
                            <div class="form-grid">
                                <div class="form-group full-width"><label for="add_fathers_name">Father's Name (Optional)</label><input type="text" class="form-control" id="add_fathers_name" name="add_fathers_name"></div>
                                <div class="form-group full-width"><label for="add_mothers_name">Mother's Name (Optional)</label><input type="text" class="form-control" id="add_mothers_name" name="add_mothers_name"></div>
                                <div class="form-group full-width"><label for="add_guardian">Guardian's Name (if not parents)</label><input type="text" class="form-control" id="add_guardian" name="add_guardian"></div>
                                <div class="form-group full-width"><label for="add_guardian_contact">Guardian's Contact No.</label><input type="text" class="form-control" maxlength="11" id="add_guardian_contact" name="add_guardian_contact"></div>
                            </div>
                        </div>
                        <!-- Tab 4: Account -->
                        <div class="tab-pane" id="account">
                            <p class="lead">Create Your Account</p>
                            <div class="form-group">
                                <label for="add_username">Username</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="add_username" name="add_username" class="form-control" placeholder="Minimum 8 characters">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="add_password">Password</label>
                                <div class="input-wrapper" id="show_hide_password">
                                    <i class="fas fa-key"></i>
                                    <input type="password" id="add_password" name="add_password" class="form-control" placeholder="Minimum 8 characters">
                                    <a href="#"><i class="fas fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="add_confirm_password">Confirm Password</label>
                                <div class="input-wrapper" id="show_hide_password_confirm">
                                    <i class="fas fa-key"></i>
                                    <input type="password" id="add_confirm_password" name="add_confirm_password" class="form-control" placeholder="Retype your password">
                                    <a href="#"><i class="fas fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn-submit"><i class="fas fa-user-plus"></i> Register</button>
                    </div>
                </div>

            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($postal_address) ?></p>
    </footer>

</div>

<!-- REQUIRED SCRIPTS -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="assets/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>

<!-- New Tab-switching script + Your original scripts -->
<script>
$(document).ready(function(){

    // --- NEW: Custom Tab Switching Logic ---
    $('.tab-button').on('click', function(){
        // Remove active class from all buttons and panes
        $('.tab-button').removeClass('active');
        $('.tab-pane').removeClass('active');

        // Add active class to clicked button
        $(this).addClass('active');
        // Show the corresponding tab pane
        $('#' + $(this).data('tab')).addClass('active');
    });

    // --- YOUR EXISTING SCRIPTS (UNMODIFIED) ---

    // Update profile name display on keyup
    $('#add_first_name').on('keyup', function() { $('#keyup_first_name').text($(this).val()); });
    $('#add_last_name').on('keyup', function() { $('#keyup_last_name').text($(this).val()); });

    $("#add_pwd").change(function(){
        if($(this).val() == 'YES'){
            $("#pwd_check").slideDown();
            $("#add_pwd_info").prop('disabled', false);
        } else {
            $("#pwd_check").slideUp();
            $("#add_pwd_info").prop('disabled', true).val('');
        }
    });

    // jQuery Validation
    $.validator.setDefaults({
        submitHandler: function (form) {
            Swal.fire({
                title: 'Processing...',
                html: 'Please wait while we create your account.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: 'signup/newResidence.php',
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                cache: false,
                success:function(data){
                    const response = data.trim();
                    if(response == 'errorPassword'){
                        Swal.fire('Error!', 'Passwords do not match.', 'error');
                    } else if(response == 'errorUsername'){
                        Swal.fire('Error!', 'This username is already taken.', 'error');
                    } else {
                        Swal.fire('Success!', 'You have been registered successfully!', 'success')
                        .then(() => {
                            window.location.href = 'login.php'; // Redirect to login page
                        });
                    }
                }
            }).fail(function(){
                Swal.fire('Oops!', 'Something went wrong with the submission.', 'error');
            });
        }
    });
    
    $('#registerResidentForm').validate({
        rules: {
            add_first_name: { required: true, minlength: 2 },
            add_last_name: { required: true, minlength: 2 },
            add_birth_date: { required: true },
            add_gender: { required: true },
            add_contact_number: { required: true, minlength: 11, maxlength: 11 },
            add_voters: { required: true },
            add_pwd: { required: true },
            add_single_parent: { required: true },
            add_pwd_info: { required: "#add_pwd[value='YES']" },
            add_address: { required: true },
            add_username:{ required: true, minlength: 8 },
            add_password:{ required: true, minlength: 8 },
            add_confirm_password:{ required: true, minlength: 8, equalTo: "#add_password" },
        },
        messages: {
            add_confirm_password: { equalTo: "Please enter the same password as above" },
            // You can add more custom messages here if needed
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    // Show/Hide Password toggles
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        const input = $('#show_hide_password input');
        const icon = $('#show_hide_password i.fas');
        if(input.attr("type") == "text"){
            input.attr('type', 'password');
            icon.addClass("fa-eye-slash").removeClass("fa-eye");
        } else {
            input.attr('type', 'text');
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
    $("#show_hide_password_confirm a").on('click', function(event) {
        event.preventDefault();
        const input = $('#show_hide_password_confirm input');
        const icon = $('#show_hide_password_confirm i.fas');
        if(input.attr("type") == "text"){
            input.attr('type', 'password');
            icon.addClass("fa-eye-slash").removeClass("fa-eye");
        } else {
            input.attr('type', 'text');
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    // Image Uploader
    $("#image_residence").click(function(){
        $("#add_image_residence").click();
    });

    $("#add_image_residence").change(function(){
        if(this.files && this.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#image_residence").attr('src', e.target.result).hide().fadeIn(650);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>

</body>
</html>