<?php
//index.php
include_once 'connection.php';
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){ // Added isset for user_type for robustness

  $user_id = $_SESSION['user_id'];
  // Using prepared statements to prevent SQL injection
  $sql = "SELECT user_type FROM users WHERE id = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $account_type = $row['user_type'];

      if ($account_type == 'admin') {
          echo '<script>window.location.href="admin/dashboard.php";</script>';
          exit();
      } elseif ($account_type == 'secretary') {
          echo '<script>window.location.href="secretary/dashboard.php";</script>';
          exit();
      } else {
          echo '<script>window.location.href="resident/dashboard.php";</script>';
          exit();
      }
  }
}

// Fetch Barangay Information
$barangay_info = [];
$sql = "SELECT * FROM `barangay_information` LIMIT 1";
$query = $con->query($sql) or die ($con->error);
if($query->num_rows > 0){
    $barangay_info = $query->fetch_assoc();
}

// Set default values in case the query fails or returns no rows
$barangay = $barangay_info['barangay'] ?? 'Barangay Name';
$zone = $barangay_info['zone'] ?? 'Zone';
$district = $barangay_info['district'] ?? 'District';
$image = $barangay_info['image'] ?? 'default_logo.png';
$postal_address = $barangay_info['postal_address'] ?? 'Default Postal Address';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Barangay <?php echo htmlspecialchars($barangay); ?> Portal</title>
    
    <!-- Modern CSS -->
   
    
    <!-- Font Awesome Icons (Kept for icons) -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    
</head>
<style>
  /* --- Google Font Import --- */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;900&display=swap');

/* --- CSS Variables for Easy Theming --- */
:root {
    --primary-color: #0037af;
    --accent-color: #e53935; /* A modern red */
    --text-color-light: #ffffff;
    --text-color-dark: #333333;
    --header-height: 80px;
    --footer-height: 60px;
}

/* --- Global Reset and Base Styles --- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9;
    color: var(--text-color-dark);
    line-height: 1.6;
}

a {
    text-decoration: none;
    color: inherit;
}

ul {
    list-style: none;
}

img {
    max-width: 100%;
    display: block;
}

/* --- Main Header / Navigation --- */
.main-header {
    background-color: var(--primary-color);
    color: var(--text-color-light);
    height: var(--header-height);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
}

.nav-links {
    display: flex;
    gap: 30px;
}

.nav-links a {
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

.nav-links a:hover,
.nav-links a.active {
    color: var(--text-color-light);
}

.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}

.nav-links i {
    margin-right: 8px;
}

/* --- Hero Section --- */
.hero-section {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding-top: var(--header-height); /* Offset for fixed header */
    color: var(--text-color-light);
    text-align: center;
    
    /* Background with semi-transparent overlay */
    background: 
        linear-gradient(rgba(0, 55, 175, 0.8), rgba(0, 55, 175, 0.8)),
        url('../assets/logo/cover.jpg') no-repeat center center/cover;
}

.hero-content {
    max-width: 800px;
    padding: 20px;
    /* Fade-in animation */
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero-content__logo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 20px auto;
    border: 4px solid var(--text-color-light);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 10px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
}

.hero-content .subtitle {
    font-size: 2.5rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 40px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
}

.hero-actions {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap; /* Allow buttons to wrap on small screens */
}


/* --- Modern Buttons --- */
.btn {
    padding: 15px 35px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: var(--accent-color);
    color: var(--text-color-light);
}

.btn-primary:hover {
    background-color: #c4312e;
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.btn-secondary {
    background-color: transparent;
    color: var(--text-color-light);
    border-color: var(--text-color-light);
}

.btn-secondary:hover {
    background-color: var(--text-color-light);
    color: var(--primary-color);
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}


/* --- Footer --- */
.main-footer {
    background-color: var(--primary-color);
    color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    text-align: center;
    font-size: 0.9rem;
    height: var(--footer-height);
}

.main-footer i {
    margin-right: 8px;
    color: var(--accent-color);
}


/* --- Responsive Design --- */
@media (max-width: 768px) {
    :root {
        --header-height: auto; /* Allow header to grow */
    }

    .nav-container {
        flex-direction: column;
        padding: 15px;
    }

    .nav-links {
        margin-top: 15px;
        gap: 20px;
    }

    .hero-section {
        padding-top: 120px; /* Adjust for taller mobile header */
    }

    .hero-content h1 {
        font-size: 2.5rem;
    }

    .hero-content .subtitle {
        font-size: 1.5rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .btn {
        width: 80%;
        max-width: 300px;
    }
}
</style>
<body>

    <!-- Header -->
    <header class="main-header">
        <nav class="nav-container">
            <a href="index.php" class="brand">
                <img src="assets/dist/img/barangaylogo.png" alt="Barangay Logo" class="brand__logo">
                <span class="brand__title">BARANGAY NBBS PROPER</span>
            </a>
            <ul class="nav-links">
                <li><a href="index.php" class="active">HOME</a></li>
                <li><a href="register.php"><i class="fas fa-user-plus"></i> REGISTER</a></li>
                <li><a href="login.php"><i class="fas fa-user-alt"></i> LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content (Hero Section) -->
    <main class="hero-section">
        <div class="hero-content">
            <h1>WELCOME</h1>
            <img src="assets/dist/img/barangaylogo.png" alt="Barangay Logo" class="hero-content__logo">
            <p class="subtitle"><?php echo htmlspecialchars($barangay . ' ' . $zone . ', ' . $district); ?></p>
            <div class="hero-actions">
                <a href="register.php" class="btn btn-primary">Register Now</a>
                <a href="login.php" class="btn btn-secondary">Login</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($postal_address); ?></p>
    </footer>

</body>
</html>