<?php
// Assuming your database connection details are stored in a separate file
include_once 'db_config.php';

session_start();

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}

$notification = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $first = $_POST['first'];
    $last = $_POST['last'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password (you should use a secure hashing algorithm like bcrypt)
    $hashedPassword = md5($password);

    // SQL query to insert the new user into the database
    $sql = "INSERT INTO account (first,last,username, password) VALUES ('$first','$last','$username', '$hashedPassword')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Registration successful
        $notification = '<div class="alert alert-success" role="alert">Registration successful!</div>';
    } else {
        // Registration failed
        $notification = '<div class="alert alert-danger" role="alert">Registration failed. Please try again.</div>';
    }
}
?>
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous"/> 
  <style>
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

<div class="main">
  <!-- Main content of the page goes here -->
  <center><h1 class="header mt-5">Registration Page</h1></center>
  <!-- Registration Form -->
<div class="container mt-5">
  <h2>Register</h2>
  <form action="register.php" method="post">
    <div class="form-group">
      <label for="username">First Name</label>
      <input type="text" class="form-control" id="first" name="first" placeholder="Enter first name">
    </div>
    <div class="form-group">
      <label for="username">Last Name</label>
      <input type="text" class="form-control" id="last" name="last" placeholder="Enter last name">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
    </div>
    <button type="submit" class="btn btn-primary rounded-pill">Register</button>
  </form>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>
</body>
</html>
