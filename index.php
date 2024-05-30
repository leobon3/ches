<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inspitech - Home Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Navbar */
    .navbar {
      background-color: #343a40;
      padding: 1rem 0;
    }
    .navbar-brand {
      color: #ffffff;
      font-weight: bold;
    }
    .navbar-brand:hover {
      color: #ffffff;
    }
    .nav-link {
      color: #ffffff;
      font-weight: bold;
    }
    .nav-link:hover {
      color: #ffffff;
    }

    /* Hero Section */
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Inspect-tech</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="building.php">Buildings</a>
        </li>
      </ul>
      <ul class="navbar-nav">
      <li class="nav-item" style="margin-left: 10px;">
          <button class="btn bsb-btn-2xl btn-outline-primary rounded-pill" data-toggle="modal" data-target="#loginModal">Login</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Login Form -->
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <!-- Add this after your login form -->
          <?php
          if (isset($_GET['login_error']) && $_GET['login_error'] == 1) {
              echo "<div class='alert alert-danger' role='alert'>Login failed. Please check your username and password.</div>";
          }
          ?>
        </form>
      </div>
    </div>
  </div>
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

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    <p>&copy; 2024 Inspect-tech. All rights reserved.</p>
  </div>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>
</body>
</html>
