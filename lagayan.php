<?php
include_once 'db_config.php';
session_start(); // Start the session to access session variables

// Check if the user is logged in
$loggedIn = isset($_SESSION['username']);



// Check if the building id is provided in the URL
if (isset($_GET['id'])) {
    $buildingId = $_GET['id'];

    // Fetch building information from the database based on the building id
    $query = "SELECT * FROM buildings WHERE id = $buildingId";
    $result = mysqli_query($conn, $query);

    // Check if building exists
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch building details
        $buildingDetails = mysqli_fetch_assoc($result);

        // Retrieve image URLs from the 'images' column and store them in an array
        $imageUrls = explode(",", $buildingDetails['images']); // Assuming images are separated by commas

        // Retrieve report image URLs from the 'report_images' column and store them in an array
        $reportImageUrls = explode(",", $buildingDetails['report_images']); // Assuming report images are separated by commas
    } else {
        // Building not found, handle accordingly
        $errorMessage = "No building found.";
    }
} else {
    // If building id is not provided in the URL, redirect to an error page or handle accordingly
    $errorMessage = "Building id not provided.";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated building details from the form
    $buildingName = $_POST['buildingName'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $yearEstablished = $_POST['yearEstablished'];
    $numOfStorey = $_POST['numOfStorey'];
    $buildingType = $_POST['buildingType'];
    $buildingStructure = $_POST['buildingStructure'];
    $designOccupancy = $_POST['designOccupancy'];
    $physicalCondition = $_POST['physicalCondition'];
    $vulnerability = $_POST['vulnerability'];

    // Update the building details in the database
    $updateQuery = "UPDATE buildings SET 
                    building_name = '$buildingName', 
                    company = '$company', 
                    location = '$location', 
                    year_established = '$yearEstablished', 
                    num_of_storey = '$numOfStorey', 
                    building_type = '$buildingType', 
                    building_structure = '$buildingStructure', 
                    design_occupancy = '$designOccupancy', 
                    physical_condition = '$physicalCondition', 
                    vulnerability = '$vulnerability'
                    WHERE id = $buildingId";
    $updateResult = mysqli_query($conn, $updateQuery);

    // Check if the update was successful
    if ($updateResult) {
        $successMessage = "Building details updated successfully.";
        // Refresh building details after update
        $buildingDetails = [
            'building_name' => $buildingName,
            'company' => $company,
            'location' => $location,
            'year_established' => $yearEstablished,
            'num_of_storey' => $numOfStorey,
            'building_type' => $buildingType,
            'building_structure' => $buildingStructure,
            'design_occupancy' => $designOccupancy,
            'physical_condition' => $physicalCondition,
            'vulnerability' => $vulnerability
        ];
    } else {
        $errorMessage = "Failed to update building details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Building Details</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  /* Custom styles */
  /* Add your custom CSS styles here */
  .carousel-item img {
    max-width: 100%;
    max-height: 100%;
    margin: auto;
  }

  .carousel-control-prev, .carousel-control-next {
    width: 10%;
    color: blue; /* Change the color of the arrows to blue */
  }

  .carousel-control-prev-icon, .carousel-control-next-icon {
    filter: invert(100%);
  }

  .carousel-indicators {
    bottom: -30px; /* Adjust the position of the indicators */
    list-style: none; /* Remove default list styling */
    text-align: center; /* Center align the indicators */
  }

  .carousel-indicators li {
    display: inline-block;
    width: 10px; /* Set the width of each indicator */
    height: 10px; /* Set the height of each indicator */
    background-color: #ccc; /* Set the background color of inactive indicators */
    border-radius: 50%; /* Make the indicators round */
    margin: 0 5px; /* Add some spacing between the indicators */
    cursor: pointer;
  }

  .carousel-indicators .active {
    background-color: blue; /* Set the background color of the active indicator */
  }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand">Inspect-tech</a>
</nav>

<div class="container">
  <div class="building-details">
    <h2>Building Details</h2>
    <?php if (isset($buildingDetails)): ?>
      <div class="container md-6">
        <div class="building-details md-6">
          <!-- Display images if available -->
          <?php if (!empty($imageUrls)): ?>
            <center><div class="form-group mt-4">
              
              <?php foreach ($imageUrls as $imageUrl): ?>
                <img src="<?php echo $imageUrl; ?>" class="img-thumbnail" alt="Building Image" style="max-width: 200px;">
              <?php endforeach; ?>
            </div>
          <?php endif; ?></center>
            <form method="post" id="buildingDetailsForm">
            <div class="form-group ">
                <label for="buildingName">Building Name:</label>
                <input type="text" class="form-control" id="buildingName" name="buildingName" value="<?php echo $buildingDetails['building_name']; ?>" disabled>
            </div>
            <div class="form-group ">
                <label for="company">Company:</label>
                <input type="text" class="form-control" id="company" name="company" value="<?php echo $buildingDetails['company']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $buildingDetails['location']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="yearEstablished">Year Established:</label>
                <input type="text" class="form-control" id="yearEstablished" name="yearEstablished" value="<?php echo $buildingDetails['year_established']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="numOfStorey">Number of Storey:</label>
                <input type="text" class="form-control" id="numOfStorey" name="numOfStorey" value="<?php echo $buildingDetails['num_of_storey']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="buildingType">Type of Building:</label>
                <input type="text" class="form-control" id="buildingType" name="buildingType" value="<?php echo $buildingDetails['building_type']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="buildingStructure">Type of Structure:</label>
                <input type="text" class="form-control" id="buildingStructure" name="buildingStructure" value="<?php echo $buildingDetails['building_structure']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="designOccupancy">Design Occupancy:</label>
                <input type="text" class="form-control" id="designOccupancy" name="designOccupancy" value="<?php echo $buildingDetails['design_occupancy']; ?>" disabled>
            </div>
           
            <hr>
           <!-- Carousel for report images -->
          <?php if (!empty($reportImageUrls)): ?>
            <h2 class="title mt-4">Summary Report</h2>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php foreach ($reportImageUrls as $index => $reportImageUrl): ?>
                  <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $reportImageUrl; ?>" class="d-block w-100" alt="Report Image">
                  </div>
                <?php endforeach; ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              <ol class="carousel-indicators">
                <?php foreach ($reportImageUrls as $index => $reportImageUrl): ?>
                  <li data-target="#carouselExampleControls" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
              </ol>
            </div>
            <hr>
          <?php endif; ?>

            <div class="form-group">
                <label for="physicalCondition">Physical Condition:</label>
                <textarea class="form-control" id="physicalCondition" name="physicalCondition" rows="3" disabled><?php echo $buildingDetails['physical_condition']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="vulnerability">Vulnerability:</label>
                <textarea class="form-control" id="vulnerability" name="vulnerability" rows="3" disabled><?php echo $buildingDetails['vulnerability']; ?></textarea>
            </div>
        
            <!-- This is for edit button -->
            <?php if ($loggedIn): ?>
            <button type="button" class="btn btn-primary mb-3 rounded-pill" id="editButton">Edit</button>
            <?php endif; ?>

            </form>
            <!-- This is for delete button -->
            <?php if ($loggedIn): ?>
            <form method="post" action="delete_building.php">
                <input type="hidden" name="buildingId" value="<?php echo $buildingId; ?>">
                <button type="submit" class="btn btn-danger mb-3 rounded-pill" onclick="return confirm('Are you sure you want to delete this building?')">Delete</button>
            </form>
            <?php endif; ?>
        </div>
        
    </div>
<div class="col-md-auto">
    <div class="button"> 
        <?php
        // Check if the user is logged in
        
            // If logged in, redirect to admin_building.php
            echo '<a class="btn btn-primary rounded-pill" href="company.php?name=' . urlencode($buildingDetails['company']) . '" role="button">Back to Company</a>';
        
        ?>
    </div>
</div>

    <?php else: ?>
      <div class="alert alert-danger" role="alert">
        <?php echo isset($errorMessage) ? $errorMessage : "No building found."; ?>
      </div>
    <?php endif; ?>
  </div>
</div>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>

<script>
// JavaScript code to handle edit button functionality
document.getElementById("editButton").addEventListener("click", function() {
    // Check if the button text is "Edit" or "Save"
    if (this.textContent === "Edit") {
        // Enable all input fields for editing
        document.querySelectorAll("input[type=text], textarea").forEach(function(input) {
            input.removeAttribute("disabled");
        });

        // Focus on the first input field after enabling editing
        document.querySelector("input[type=text]").focus();

        // Change the button text to "Save" for the user to save changes
        this.textContent = "Save";

        // Change the button color to indicate saving action
        this.classList.remove("btn-primary");
        this.classList.add("btn-success");
    } else {
        // Submit the form
        document.getElementById("buildingDetailsForm").submit();
    }
});
</script>
</body>
</html>
