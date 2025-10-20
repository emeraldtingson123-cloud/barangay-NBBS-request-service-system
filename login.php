<?php 
include_once 'connection.php';
session_start();

try {
    // --- Check if user is already logged in ---
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){
        $user_id = $_SESSION['user_id'];
        
        // --- Using PREPARED STATEMENTS to prevent SQL Injection ---
        $sql = "SELECT user_type FROM users WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $account_type = $row['user_type'];

            if ($account_type == 'admin') {
                echo '<script>window.location.href="admin/dashboard.php";</script>';
                exit(); // --- Important: stop script execution after redirect ---
            } elseif ($account_type == 'secretary') {
                echo '<script>window.location.href="secretary/dashboard.php";</script>';
                exit();
            } else {
                echo '<script>window.location.href="resident/dashboard.php";</script>';
                exit();
            }
        }
    }

    // --- Fetch Barangay Information ---
    $barangay_info = [];
    $sql_info = "SELECT * FROM `barangay_information` LIMIT 1";
    $query_info = $con->query($sql_info);
    if($query_info && $query_info->num_rows > 0){
        $barangay_info = $query_info->fetch_assoc();
    }

    // --- Set default values to avoid errors if DB query fails ---
    $barangay = $barangay_info['barangay'] ?? 'Portal';
    $image = $barangay_info['image'] ?? 'default_logo.png';
    $postal_address = $barangay_info['postal_address'] ?? 'Official Barangay Address';

} catch(Exception $e) {
    // A simple error handler. In a production environment, you might log this.
    die("An error occurred: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Barangay Management System</title>
    
    <!-- Modern CSS -->
    <link rel="stylesheet" href="css/login-style.css">
    
    <!-- Kept for Icons & Alerts -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert2/css/sweetalert2.min.css">

</head>
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
                <li><a href="register.php"><i class="fas fa-user-plus"></i> REGISTER</a></li>
                <li><a href="login.php" class="active"><i class="fas fa-user-alt"></i> LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <style>
      /* --- Google Font Import --- */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;900&display=swap');

/* --- CSS Variables for Easy Theming --- */
:root {
    --primary-color: #0037af;
    --accent-color: #e53935;
    --text-color-light: #ffffff;
    --text-color-dark: #333;
    --body-bg-color: #f0f2f5;
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
}

a {
    text-decoration: none;
    color: var(--primary-color);
    transition: color 0.3s ease;
}

a:hover {
    color: var(--accent-color);
}

ul {
    list-style: none;
}

img {
    max-width: 100%;
    display: block;
}

/* --- Wrapper for the entire page content --- */
.page-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* --- Main Header / Navigation (Consistent with previous design) --- */
.main-header {
    background-color: var(--primary-color);
    color: var(--text-color-light);
    height: 80px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    flex-shrink: 0; /* Prevents header from shrinking */
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
}

.brand {
    display: flex;
    align-items: center;
    gap: 15px;
}

.brand__logo {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.brand__title {
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--text-color-light);
}

.nav-links {
    display: flex;
    gap: 30px;
}

.nav-links a {
    color: var(--text-color-light);
    padding: 10px 5px;
    font-weight: 400;
    position: relative;
    transition: color 0.3s ease;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background-color: var(--accent-color);
    transition: width 0.3s ease;
}

.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}

.nav-links i {
    margin-right: 8px;
}

/* --- Login Section --- */
.login-container {
    flex-grow: 1; /* Allows this section to fill available space */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: 
        linear-gradient(rgba(0, 55, 175, 0.7), rgba(0, 55, 175, 0.7)),
        url('../assets/logo/cover.jpg') no-repeat center center/cover;
}

.login-panel {
    background-color: var(--text-color-light);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    text-align: center;
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.login-panel__logo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto 15px auto;
    border: 3px solid var(--primary-color);
}

.login-panel__title {
    font-size: 1.8rem;
    font-weight: 900;
    color: var(--primary-color);
    margin-bottom: 30px;
}

/* --- Form Styling --- */
.form-group {
    margin-bottom: 20px;
}

.input-wrapper {
    position: relative;
}

.input-wrapper i.fa-user, .input-wrapper i.fa-key {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
}

.form-control {
    width: 100%;
    padding: 12px 15px 12px 45px; /* Left padding for icon */
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0, 55, 175, 0.15);
}

/* Password toggle icon */
#show_hide_password a {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
}

.forgot-password {
    text-align: right;
    margin-top: -10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.btn-submit {
    width: 100%;
    padding: 15px;
    background-color: var(--primary-color);
    color: var(--text-color-light);
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-submit:hover {
    background-color: #002a8c;
    transform: translateY(-2px);
}

/* --- Footer --- */
.main-footer {
    background-color: var(--primary-color);
    color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    text-align: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.main-footer i {
    margin-right: 8px;
    color: var(--accent-color);
}

/* --- Responsive --- */
@media(max-width: 768px) {
    .nav-container {
        flex-direction: column;
        height: auto;
        padding: 15px;
    }
    .nav-links {
        margin-top: 15px;
    }
    .login-panel {
        padding: 30px;
    }
}
    </style>

    <!-- Main Content -->
    <main class="login-container">
        
        <div class="login-panel">
            <img src="assets/dist/img/barangaylogo.png" alt="logo" class="login-panel__logo">
            <h1 class="login-panel__title">LOGIN</h1>
            
            <form id="loginForm" method="post">
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" class="form-control" placeholder="USERNAME OR RESIDENT NUMBER" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-wrapper" id="show_hide_password">
                        <i class="fas fa-key"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="PASSWORD" required>
                        <a href="#"><i class="fas fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                </div>
                
                <div class="forgot-password">
                    <a href="forgot.php">Forgot Password?</a>
                </div>
                
                <button type="submit" class="btn-submit">Sign In</button>
            </form>
        </div>

    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($postal_address) ?></p>
    </footer>

</div> <!-- ./page-wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Kept for any dependency, can often be removed -->
<script src="assets/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>

<!-- Your existing Login Script -->
<script>
$(document).ready(function() {
    $("#loginForm").submit(function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();

        if(username.trim() === '' || password.trim() === ''){
            Swal.fire({
                title: '<strong>Warning</strong>',
                icon: 'warning',
                html: '<b>Username and Password are required.</b>',
                confirmButtonColor: '#0037af'
            });
            return;
        }

        $.ajax({
            url: 'loginForm.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'text', // Explicitly set the expected data type
            success:function(data){
                const response = data.trim(); // Trim whitespace from response
                if(response === 'errorUsername' || response === 'errorPassword'){
                    Swal.fire({
                        title: '<strong>Login Failed</strong>',
                        icon: 'error',
                        html: '<b>Incorrect username or password. Please try again.</b>',
                        confirmButtonColor: '#d33'
                    });
                } else if(response === 'admin' || response === 'secretary' || response === 'resident'){
                    Swal.fire({
                        title: '<strong>Success!</strong>',
                        icon: 'success',
                        html: '<b>Login successful. Redirecting...</b>',
                        timer: 2000,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    }).then(() => {
                        // Determine redirect URL based on response
                        let redirectUrl = '';
                        if (response === 'admin') redirectUrl = 'admin/dashboard.php';
                        if (response === 'secretary') redirectUrl = 'secretary/dashboard.php';
                        if (response === 'resident') redirectUrl = 'resident/dashboard.php';
                        window.location.href = redirectUrl;
                    });
                } else {
                    // Handle unexpected responses
                    Swal.fire({
                        title: '<strong>Error</strong>',
                        icon: 'error',
                        html: 'An unexpected error occurred. Please try again later.',
                        confirmButtonColor: '#d33'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: '<strong>Connection Error</strong>',
                    icon: 'error',
                    html: 'Could not connect to the server. Please check your connection.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        const passwordInput = $('#show_hide_password input');
        const passwordIcon = $('#show_hide_password i.fas');
        
        if(passwordInput.attr("type") === "text"){
            passwordInput.attr('type', 'password');
            passwordIcon.addClass("fa-eye-slash").removeClass("fa-eye");
        } else if(passwordInput.attr("type") === "password"){
            passwordInput.attr('type', 'text');
            passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
</script>

</body>
</html>