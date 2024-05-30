<?php
session_start();

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}

?>

HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Side Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous"/> 
    <style>
        body {
    min-height: 100vh;   /* Ensure the body always fills the viewport height */
    display: flex;       /* Enable flexbox */
    flex-direction: column;  /* Stack items vertically */
}
.main {
    flex-grow: 1; /* Allow the 'main' section to fill the remaining space */
}

        .sidenav {
            height: 100%; 
            width: 250px; 
            position: fixed; 
            z-index: 1;  
            top: 0;
            left: 0;
            background-color: #20262e; 
            padding-top: 60px;
        }

        .sidenav a {
            padding: 10px 20px; 
            text-decoration: none;
            font-size: 18px; 
            color: #ddd;
            display: block;
            margin-bottom: 5px;  /* Add spacing */
        }

        .sidenav a:hover {
            background-color: #14181d;
            color: #f8f9fa;
        }

        .sidenav a i { 
            margin-right: 10px; 
        }

        .main {
            margin-left: 250px; 
            padding: 20px;
        }

        .navbar-brand {
            color: #f8f9fa; 
            font-weight: bold;
        }

        /* Styling for main content area */
        .main h1 {
            color: #343a40;
            margin-bottom: 30px;
        }

        .admin-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        /* Inside your existing styles */

         /* Features Section */
    .features {
      padding: 60px 0; 
    }
    .feature-item {
      text-align: center;
      margin-bottom: 30px;
    }
    .feature-icon {
      font-size: 3rem;
      color: #2c6993;
      margin-bottom: 20px;
    }
    .feature-title {
      font-weight: bold;
      margin-bottom: 15px;
    }
    .feature-description {
      color: #6c757d;
    }

        .hero {
      background-image: url("bg.jpeg");
      background-size: cover;
      background-position: center;
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #ffffff;
    }
    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    .hero p {
      font-size: 1.5rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

   

    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Admin Panel</a>
</nav>

<div class="sidenav">
    <a href="admin_home.php"><i class="fas fa-home"></i> Home</a>
    <a href="create_building.php"><i class="fas fa-plus-circle"></i> Add Building</a>
    <a href="admin_building.php"><i class="fas fa-building"></i> Buildings</a>
    <a href="register.php"><i class="fas fa-user-plus"></i>  Registration</a>
    <a href="create_company.php"><i class="fas fa-industry"></i> Create Company</a> 
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a> 
</div>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Welcome to Inspect-tech</h1>
    <p>Ensuring the efficiency and safety of your structures</p>
  </div>
</section>

<!-- Features Section -->
<section class="features">
  <div class="container">
    <div class="row">
      <div class="col-md-4 feature-item">
        <i class="fas fa-check-square feature-icon"></i> 
        <h3 class="feature-title">Thorough Inspections</h3>
        <p class="feature-description">Our team conducts detailed assessments of building components and systems.</p>
      </div>
      <div class="col-md-4 feature-item">
        <i class="fas fa-chart-line feature-icon"></i>
        <h3 class="feature-title">Performance Analysis</h3>
        <p class="feature-description">We identify areas for energy efficiency and cost savings to optimize building performance.</p>
      </div>
      <div class="col-md-4 feature-item">
        <i class="fas fa-shield-alt feature-icon"></i>
        <h3 class="feature-title">Compliance Assurance</h3>
        <p class="feature-description">Ensuring adherence to building codes and regulations for your peace of mind.</p>
      </div>
    </div>
  </div>
</section>

<footer class="bg-dark text-white text-center p-3 fixed-bottom">
  <div class="container">
    <p>&copy; 2024 Inspitech. All rights reserved.</p>
  </div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>
</body>
</html>