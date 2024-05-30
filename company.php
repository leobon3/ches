<?php
session_start(); // Start the session

include_once 'db_config.php';

// Pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// Check if the company name is provided in the URL
if (isset($_GET['name'])) {
    $companyName = $_GET['name'];

    // Prepare the SQL statement using a prepared statement
    $query = "SELECT * FROM company WHERE companyName = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the company name parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $companyName);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    // Check if company exists
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch company details
        $companyDetails = mysqli_fetch_assoc($result);

        // Count total number of buildings for pagination
        $countQuery = "SELECT COUNT(*) AS total FROM buildings WHERE company = ?";
        $stmt = mysqli_prepare($conn, $countQuery);
        mysqli_stmt_bind_param($stmt, "s", $companyName);
        mysqli_stmt_execute($stmt);
        $countResult = mysqli_stmt_get_result($stmt);
        $totalCount = mysqli_fetch_assoc($countResult)['total'];

        // Fetch buildings associated with this company with pagination
        $buildingQuery = "SELECT * FROM buildings WHERE company = ? LIMIT ? OFFSET ?";
        $stmt = mysqli_prepare($conn, $buildingQuery);
        mysqli_stmt_bind_param($stmt, "sii", $companyName, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $buildingResult = mysqli_stmt_get_result($stmt);

        // Check if buildings exist for this company
        if ($buildingResult && mysqli_num_rows($buildingResult) > 0) {
            // Fetch and store all building details in an array
            $buildingDetails = array();
            while ($row = mysqli_fetch_assoc($buildingResult)) {
                // Retrieve image URLs from the 'images' column and store them in the 'building_details' array
                $images = explode(",", $row['images']); // Assuming images are separated by commas
                $row['image_urls'] = $images;
                $buildingDetails[] = $row;
            }
        } else {
            // No buildings found for this company
            $buildingDetails = array(); // Empty array
        }
    } else {
        // Company not found, redirect to an error page or handle accordingly
        header("Location: error.php");
        exit;
    }
} else {
    // If company name is not provided in the URL, redirect to an error page or handle accordingly
    header("Location: error.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/company.jpg');
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-position: center;
    }
    /* Custom CSS for design enhancements */
    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
      height: 180px; /* Adjust this value as needed */
      overflow: hidden;
    }

    .card-img-top {
      
      max-width: 100%; /* Ensures image width fits within the card */
      max-height: 100%;
      object-fit: contain; 
    }

    .card-title {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .card-text {
      font-size: 1rem;
      color: #6c757d;
    }

    .list-group-item {
      font-size: 0.9rem;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .pagination {
      justify-content: center;
      margin-top: 20px;
    }
    .card-title1{
        font-size: 3.5rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    .list {
    font-size: 2em;
    color: #e0e0e0; /* Light text color for contrast */
    text-align: center;
    margin-top: 40px;
    padding: 10px;
    background-color: #333; /* Dark background color */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Darker shadow for dark theme */
    transition: background-color 0.3s ease;
}

.list:hover {
    background-color: #555; /* Slightly lighter dark color on hover */
}

.mt-4 {
    margin-top: 1.5rem; /* Adjusted for appropriate spacing */
}
.nobuilding{
  color: white;
}
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <center><h5 class="card-title1"><?php echo $companyDetails['companyName']; ?></h5></center>
      </div>
    </div>
    <h2 class="list mt-4">List of Buildings</h2>
    <?php if (!empty($buildingDetails)): ?>
        <div class="row">
            <?php foreach ($buildingDetails as $building): ?>
              <div class="col-md-4 mt-4">
              <a href="building_page.php?id=<?php echo $building['id']; ?>" style="text-decoration: none;">
                  <div class="card">
                      <div class="card-body">
                          <?php if (!empty($building['image_urls'])): ?>
                              <?php foreach ($building['image_urls'] as $image): ?>
                                  <img src="<?php echo $image; ?>" class="card-img-top" alt="Building Image">
                              <?php endforeach; ?>
                          <?php else: ?>
                              <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                  <img src="images/img.png" class="card-img-top" alt="Default Image">
                              </div>
                          <?php endif; ?>
                      </div>
                      <hr>
                      <div class="card-body">
                          <h5 class="card-title"> <?php echo $building['building_name']; ?></h5>
                          <p class="card-text">Location: <?php echo $building['location']; ?></p>
                          <?php if (isset($_SESSION['username'])): ?>
                              <form action="delete_building.php" method="POST">
                                  <input type="hidden" name="building_id" value="<?php echo $building['id']; ?>">
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
              </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
      <p class="nobuilding">No building found for this company.</p>
    <?php endif; ?>
    <div class="row mt-3">
      <div class="col-md-auto">
        <div class="button"> 
          <?php
          // Check if the user is logged in
          if (isset($_SESSION['username'])) {
            // If logged in, redirect to admin_building.php
            echo '<a class="btn btn-primary rounded-pill" href="admin_building.php" role="button">Back to buildings</a>';
          } else {
            // If not logged in, redirect to building.php
            echo '<a class="btn btn-primary rounded-pill" href="building.php" role="button">Back to buildings</a>';
          }
          ?>
        </div>
      </div>
      <div class="col-md">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
            $totalPages = ceil($totalCount / $limit);
            for ($i = 1; $i <= $totalPages; $i++) {
              echo "<li class='page-item'><a class='page-link' href='?name=$companyName&page=$i'>$i</a></li>";
            }
            ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
