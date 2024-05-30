<?php
// Include database connection
include_once 'db_config.php';


// Define the number of items per page
$itemsPerPage = 10;

// Initialize variables for pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Initialize an empty array to store company names and their corresponding building counts
$companies = [];

// Fetch company names and their corresponding building counts from the database
$query = "SELECT c.companyName, COUNT(b.ID) AS buildingCount 
          FROM company c 
          LEFT JOIN buildings b ON c.companyName = b.company 
          GROUP BY c.companyName
          LIMIT $offset, $itemsPerPage"; // Add LIMIT clause for pagination
$result = mysqli_query($conn, $query);

// Check if query was successful and fetch company names and building counts
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Store company name and building count in the array
        $companies[] = $row;   
    }
}

// Fetch total number of companies for pagination
$totalCompaniesQuery = "SELECT COUNT(*) AS total FROM company";
$totalCompaniesResult = mysqli_query($conn, $totalCompaniesQuery);
$totalCompanies = mysqli_fetch_assoc($totalCompaniesResult)['total'];
$totalPages = ceil($totalCompanies / $itemsPerPage);

// Initialize an empty array to store filtered company names and their corresponding building counts
$filteredCompanies = [];

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Fetch filtered company names and their corresponding building counts from the database based on search query
    $filteredQuery = "SELECT c.companyName, COUNT(b.ID) AS buildingCount 
                      FROM company c 
                      LEFT JOIN buildings b ON c.companyName = b.company 
                      WHERE c.companyName LIKE '%$searchQuery%'
                      GROUP BY c.companyName
                      LIMIT $offset, $itemsPerPage";
    $filteredResult = mysqli_query($conn, $filteredQuery);
    
    // Check if query was successful and fetch filtered company names and building counts
    if ($filteredResult && mysqli_num_rows($filteredResult) > 0) {
        while ($row = mysqli_fetch_assoc($filteredResult)) {
            // Store filtered company name and building count in the array
            $filteredCompanies[] = $row;   
        }
    }
} else {
    // If no search query is provided, use the original array of companies
    $filteredCompanies = $companies;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buildings</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous"/> 

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/building.jpg');
      background-attachment: fixed;
      background-size: cover; /* Cover the entire container*/
      background-repeat: no-repeat;
      background-position: center;
    }
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

    /* Title */
    .title {
      margin-top: 2rem;
      margin-bottom: 2rem;
    }

    /* Table */
    table {
      width: 80%; 
      margin: 0 auto; 
      background-color: white; /* Set table background to white */
    }
    th, td {
      text-align: left;
      padding: 8px;
      background-color: white; /* Set cell background to white */
    }
    th {
      background-color: #343a40;
      color: white; /* Set text color to white for header */
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }

    /* Search Bar */
    .search-form {
      margin-bottom: 20px;
    }
    .search-input {
      width: 300px;
    }
    .title{
      font-size: 3.5rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    .search-button {
      background-color: white;
      color: black;
      border-color: white;
    }
    .search-button:hover {
      background-color: white;
      color: black;
      border-color: white;
    }
    .company{
      color:white;
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
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="building.php">Buildings<span class="sr-only">(current)</span></a>
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

<!-- Modal -->
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
          <?php if (isset($_GET['login_error']) && $_GET['login_error'] == 1): ?>
            <div class="alert alert-danger" role="alert">Login failed. Please check your username and password.</div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Body Content -->
<center><h1 class="title">Building List</h1></center>
<div class="container mt-5">
  
<p class="company">Total Company: <strong><?php echo $totalCompanies; ?></strong></p>

  
  <!-- Search Bar -->
<form class="search-form form-inline mb-3" method="GET" action="">
  <div class="input-group">
    <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search" aria-label="Search" name="search">
    <div class="input-group-append">
    


      <button class="btn btn-outline-primary search-button rounded-pill" type="submit"><i class="fas fa-search"></i>  Search</button>
    </div>
  </div>
</form>


  <!-- Display filtered company list -->
  <!-- Display filtered company list -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><strong>Building Name</strong></th>
            <th scope="col"><strong>No. of Buildings</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($filteredCompanies ?? [])): ?>
          <?php foreach ($filteredCompanies as $companyData): ?>
              <tr>
                  <td><strong><a href="company.php?name=<?php echo urlencode($companyData['companyName']); ?>" style="color: black;"><?php echo htmlspecialchars($companyData['companyName']); ?></a></strong></td>
                  <td><strong><?php echo htmlspecialchars($companyData['buildingCount']); ?></strong></td>
              </tr>
          <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="2">No companies found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
</div>

<!-- Footer -->
<!-- <footer class="bg-dark text-white text-center p-3 fixed-bottom">
  <div class="container">
    <p>&copy; 2024 Inspect-tech. All rights reserved.</p>
  </div>
</footer> -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>

</body>
</html>
