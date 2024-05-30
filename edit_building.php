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
    } else {
        // Building not found, handle accordingly
        $errorMessage = "No building found.";
    }
} else {
    // If building id is not provided in the URL, redirect to an error page or handle accordingly
    $errorMessage = "Building id not provided.";
}

// Handle form submission to update building details
if ($_SERVER["REQUEST_METHOD"] == "POST" && $loggedIn) {
    // Retrieve updated building details from the form
    $buildingName = $_POST['buildingName'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $yearEstablished = $_POST['yearEstablished'];
    $numOfStorey = $_POST['numOfStorey'];
    $buildingType = $_POST['buildingType'];
    $buildingStructure = $_POST['buildingStructure'];
    $designOccupancy = $_POST['designOccupancy'];
    
    $vulnerability = $_POST['vulnerability'];
    $door1 = $_POST['door1'];
    $door2 = $_POST['door2'];
    $door3 = $_POST['door3'];
    $entrance1 = $_POST['entrance1'];
    $entrance2 = $_POST['entrance2'];
    $corridor1 = $_POST['corridor1'];
    $corridor2 = $_POST['corridor2'];
    $corridor3 = $_POST['corridor3'];
    $corridor4 = $_POST['corridor4'];
    $signage1 = $_POST['signage1'];
    $signage2 = $_POST['signage2'];
    $signage3 = $_POST['signage3'];
    $signage4 = $_POST['signage4'];
    $washroom1 = $_POST['washroom1'];
    $washroom2 = $_POST['washroom2'];
    $washroom3 = $_POST['washroom3'];
    $washroom4 = $_POST['washroom4'];
    $washroom5 = $_POST['washroom5'];
    $washroom6 = $_POST['washroom6'];
    $washroom7 = $_POST['washroom7'];
    $washroom8 = $_POST['washroom8'];
    $washroom9 = $_POST['washroom9'];
    $washroom10 = $_POST['washroom10'];
    $washroom11 = $_POST['washroom11'];
    $ramps1 = $_POST['ramps1'];
    $ramps2 = $_POST['ramps2'];
    $ramps3 = $_POST['ramps3'];
    $ramps4 = $_POST['ramps4'];
    $ramps5 = $_POST['ramps5'];
    $ramps6 = $_POST['ramps6'];
    $ramps7 = $_POST['ramps7'];
    $ramps8 = $_POST['ramps8'];
    $ramps9 = $_POST['ramps9'];
    $parking1 = $_POST['parking1'];
    $parking2 = $_POST['parking2'];
    $parking3 = $_POST['parking3'];
    $elevator1 = $_POST['elevator1'];
    $elevator2 = $_POST['elevator2'];
    $elevator3 = $_POST['elevator3'];
    $stairs1 = $_POST['stairs1'];
    $stairs2 = $_POST['stairs2'];
    $stairs3 = $_POST['stairs3'];
    $stairs4 = $_POST['stairs4'];
    $stairs5 = $_POST['stairs5'];
    $recommendation = $_POST['recommendation'];
    $physical1 = $_POST['physical1'];
    $physical2 = $_POST['physical2'];
    $physical3 = $_POST['physical3'];
    $physical4 = $_POST['physical4'];
    $renovated = $_POST['renovated'];
    $rvs = $_POST['rvs'];

    // Check if new images are uploaded
    $buildingImages = [];
    if (!empty($_FILES['images']['name'][0])) {
        // Process new image uploads
        $fileCount = count($_FILES['images']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            // Upload new images and store their paths
            $targetDir = "uploads/";
            $targetFile = $targetDir . uniqid() . '_' . basename($_FILES["images"]["name"][$i]);
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFile)) {
                $buildingImages[] = $targetFile;
            }
        }
    } else {
        // No new images uploaded, retain existing image paths
        $sql = "SELECT images FROM buildings WHERE id = $buildingId";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $buildingImages = explode(",", $row['images']);
        }
    }

     // Report images
     $reportImages = [];
     if (isset($_FILES['reportImages']) && is_array($_FILES['reportImages']['name'])) {
         $fileCount = count($_FILES['reportImages']['name']);
         for ($i = 0; $i < $fileCount; $i++) {
             // Generate a unique filename for each image
             $targetDir = "uploads/";
             $targetFile = $targetDir . uniqid() . '_' . basename($_FILES["reportImages"]["name"][$i]);
             // Move the uploaded file to the target directory
             if (move_uploaded_file($_FILES["reportImages"]["tmp_name"][$i], $targetFile)) {
                 // Store the file path in the $reportImages array
                 $reportImages[] = $targetFile;
             }
         }
     
    } else {
        // No new images uploaded, retain existing image paths
        $sql = "SELECT report_images FROM buildings WHERE id = $buildingId";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $reportImages = explode(",", $row['report_images']);
        }
    }

  
 
    $imagePathsString = implode(",", $buildingImages);
 
     // Update the building details in the database
     
     $imagePathsString = implode(",", $buildingImages);

    $updateQuery = "UPDATE buildings SET 
        building_name = '$buildingName', 
        company = '$company', 
        location = '$location', 
        year_established = '$yearEstablished', 
        num_of_storey = '$numOfStorey', 
        building_type = '$buildingType', 
        building_structure = '$buildingStructure', 
        design_occupancy = '$designOccupancy',  
        vulnerability = '$vulnerability',
        door1 = '$door1',
        door2 = '$door2',
        door3 = '$door3',
        entrance1 = '$entrance1',
        entrance2 = '$entrance2',
        corridor1 = '$corridor1',
        corridor2 = '$corridor2',
        corridor3 = '$corridor3',
        corridor4 = '$corridor4',
        signage1 = '$signage1',
        signage2 = '$signage2',
        signage3 = '$signage3',
        signage4 = '$signage4',
        washroom1 = '$washroom1',
        washroom2 = '$washroom2',
        washroom3 = '$washroom3',
        washroom4 = '$washroom4',
        washroom5 = '$washroom5',
        washroom6 = '$washroom6',
        washroom7 = '$washroom7',
        washroom8 = '$washroom8',
        washroom9 = '$washroom9',
        washroom10 = '$washroom10',
        washroom11 = '$washroom11',
        ramps1 = '$ramps1',
        ramps2 = '$ramps2',
        ramps3 = '$ramps3',
        ramps4 = '$ramps4',
        ramps5 = '$ramps5',
        ramps6 = '$ramps6',
        ramps7 = '$ramps7',
        ramps8 = '$ramps8',
        ramps9 = '$ramps9',
        parking1 = '$parking1',
        parking2 = '$parking2',
        parking3 = '$parking3',
        elevator1 = '$elevator1',
        elevator2 = '$elevator2',
        elevator3 = '$elevator3',
        stairs1 = '$stairs1',
        stairs2 = '$stairs2',
        stairs3 = '$stairs3',
        stairs4 = '$stairs4',
        stairs5 = '$stairs5',
        recommendation = '$recommendation',
        physical1 = '$physical1',
        physical2 = '$physical2',
        physical3 = '$physical3',
        physical4 = '$physical4',
        renovated = '$renovated',
        rvs = '$rvs',
        images = '$imagePathsString',
        report_images = '" . implode(",", $reportImages) . "'
        WHERE id = $buildingId";

    if (mysqli_query($conn, $updateQuery)) {
        // Building details updated successfully
        $successMessage = "Building details updated successfully.";
        header("Location: building_page.php?id=$buildingId");
    } else {
        // Error updating building details
        $errorMessage = "Error updating building details: " . mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Side Navbar</title>
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
  <center><h1 class="header mt-5">Welcome to Create Buildings</h1></center>
  



<div class="container mt-5">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$buildingId"; ?>" enctype="multipart/form-data">


        <h2>Add Building</h2>
        <div class="form-group">
            <label for="company">Select Company</label>
            <select class="form-control" id="company" name="company">
                <option value="">Select Company</option>
                <?php
                // Fetch companies from the database and populate dropdown options
                $query = "SELECT DISTINCT companyName FROM company";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['companyName'] == $buildingDetails['company']) ? 'selected' : '';
                        echo '<option value="' . $row['companyName'] . '" ' . $selected . '>' . $row['companyName'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>


    <div class="form-group">
      <label for="buildingName">Building Name</label>
      <input type="text" class="form-control" id="buildingName"name="buildingName"  value="<?php echo $buildingDetails['building_name']; ?>" placeholder="Enter building name" >
    </div>
    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" class="form-control" id="location"name="location" value="<?php echo $buildingDetails['location']; ?>" placeholder="Enter location">
    </div>
    <div class="form-group">
      <label for="yearEstablished">Year Established</label>
      <input type="text" class="form-control" id="yearEstablished"name="yearEstablished"  value="<?php echo $buildingDetails['year_established']; ?>" placeholder="Enter year established">
    </div>
    <div class="form-group">
      <label for="numOfStorey">Number of Storey</label>
      <input type="text" class="form-control" id="numOfStorey"name="numOfStorey" value="<?php echo $buildingDetails['num_of_storey']; ?>" placeholder="Enter number of storey">
    </div>
    <div class="form-group">
      <label for="buildingType">Type of Building</label>
      <select class="form-control" id="buildingType" name="buildingType">
        <option value="" disabled>Select type of building</option>
        <option value="Concrete Frame" <?php echo ($buildingDetails['building_type'] == 'Concrete Frame') ? 'selected' : ''; ?>>Concrete Frame</option>
        <option value="Steel Frame" <?php echo ($buildingDetails['building_type'] == 'Steel Frame') ? 'selected' : ''; ?>>Steel Frame</option>
        <option value="Reinforced Concrete Shear Wall" <?php echo ($buildingDetails['building_type'] == 'Reinforced Concrete Shear Wall') ? 'selected' : ''; ?>>Reinforced Concrete Shear Wall</option>
        <option value="Timber Frame" <?php echo ($buildingDetails['building_type'] == 'Timber Frame') ? 'selected' : ''; ?>>Timber Frame</option>
        <option value="Composite Steel-Concrete" <?php echo ($buildingDetails['building_type'] == 'Composite Steel-Concrete') ? 'selected' : ''; ?>>Composite Steel-Concrete</option>
        <option value="Reinforced Masonary" <?php echo ($buildingDetails['building_type'] == 'Reinforced Masonary') ? 'selected' : ''; ?>>Reinforced Masonary</option>
        <option value="Unreinforced Masonary" <?php echo ($buildingDetails['building_type'] == 'Unreinforced Masonary') ? 'selected' : ''; ?>>Unreinforced Masonary</option>
      </select>
    </div>
    <div class="form-group">
      <label for="buildingStructure">Type of Structure</label>
      <select class="form-control" id="buildingStructure" name="buildingStructure">
        <option value="" disabled>Select type of structure</option>
        <option value="Build-up Section" <?php echo ($buildingDetails['building_structure'] == 'Build-up Section') ? 'selected' : ''; ?>>Build-up Section</option>
        <option value="Rolled Section" <?php echo ($buildingDetails['building_structure'] == 'Rolled Section') ? 'selected' : ''; ?>>Rolled Section</option>
        <option value="Pre-Cast" <?php echo ($buildingDetails['building_structure'] == 'Pre-Cast') ? 'selected' : ''; ?>>Pre-Cast</option>
        <option value="Cast-In-Place" <?php echo ($buildingDetails['building_structure'] == 'Cast-In-Place') ? 'selected' : ''; ?>>Cast-In-Place</option>
        <option value="Combination" <?php echo ($buildingDetails['building_structure'] == 'Combination') ? 'selected' : ''; ?>>Combination</option>
      </select>
    </div>
    <!-- renovated -->
    <div class="form-group">
      <label for="renovated">Renovation</label>
      <select class="form-control" id="renovated" name="renovated">
        <option value="Renovated" <?php if ($buildingDetails['renovated'] === 'Renovated') echo 'selected'; ?>>Renovated</option>
        <option value="Not Renovated" <?php if ($buildingDetails['renovated'] === 'Not Renovated') echo 'selected'; ?>>Not Renovated</option>
      </select>
    </div>
<!-- end renovated -->
    <div class="form-group">
      <label for="designOccupancy">Design Occupancy</label>
      <input type="text" class="form-control" id="designOccupancy"name="designOccupancy" value="<?php echo $buildingDetails['design_occupancy']; ?>"placeholder="Enter design occupancy">
    </div>

    
    
   
    <!-- Multiple Images Input -->
    <div class="form-group">
    <label for="images">Building Images</label>
    <?php
    // Check if there are existing images
    if (!empty($buildingDetails['images'])) {
        $existingImages = explode(",", $buildingDetails['images']);
        foreach ($existingImages as $image) {
            echo '<img src="' . $image . '" alt="Building Image" style="max-width: 100px; margin-right: 10px;">';
        }
    }
    ?>
    <input type="file" class="form-control-file" id="images" name="images[]" multiple required>
    <small class="form-text text-muted">You can select multiple images by holding down the Ctrl (Windows) or Command (Mac) key while selecting.</small>
</div>
<!-- buidling -->
    
    <hr>
    
    <h2>Summary Report</h2>

    <div class="form-group">
      <label for="rvs">RVS Score</label>
      <input type="text" class="form-control" id="rvs"name="rvs" value="<?php echo $buildingDetails['rvs']; ?>"placeholder="Enter rvs">
    </div>
    

    <hr>

    <h4>Physical Condition</h4>
    <div class="form-group">
      <label for="physical1">Structural Defects</label>
      <select class="form-control" id="physical1" name="physical1">
        <option value="" disabled>Select structural defects condition</option>
        <option value="No adverse defects" <?php if ($buildingDetails['physical1'] === 'No adverse defects') echo 'selected'; ?>>No adverse defects</option>
        <option value="Presence of minor structural defects" <?php if ($buildingDetails['physical1'] === 'Presence of minor structural defects') echo 'selected'; ?>>Presence of minor structural defects</option>
        <option value="Presence of some severe defect found (see photos)" <?php if ($buildingDetails['physical1'] === 'Presence of some severe defect found (see photos)') echo 'selected'; ?>>Presence of some severe defect found (see photos)</option>
        <option value="Presence of multiple severe defects requiring investigation" <?php if ($buildingDetails['physical1'] === 'Presence of multiple severe defects requiring investigation') echo 'selected'; ?>>Presence of multiple severe defects requiring investigation</option>
      </select>
    </div>
    <div class="form-group">
      <label for="physical2">Non-Structural Defects</label>
      <select class="form-control" id="physical2" name="physical2">
        <option value="" disabled>Select non-structural defects condition</option>
        <option value="No adverse defects" <?php if ($buildingDetails['physical2'] === 'No adverse defects') echo 'selected'; ?>>No adverse defects</option>
        <option value="Presence of minor structural defects" <?php if ($buildingDetails['physical2'] === 'Presence of minor structural defects') echo 'selected'; ?>>Presence of minor structural defects</option>
        <option value="Presence of some severe defect found (see photos)" <?php if ($buildingDetails['physical2'] === 'Presence of some severe defect found (see photos)') echo 'selected'; ?>>Presence of some severe defect found (see photos)</option>
        <option value="Presence of multiple severe defects requiring investigation" <?php if ($buildingDetails['physical2'] === 'Presence of multiple severe defects requiring investigation') echo 'selected'; ?>>Presence of multiple severe defects requiring investigation</option>
      </select>
    </div>
    <div class="form-group">
      <label for="physical3">Ancillary/Auxiliary Equipment and Facilities Defects</label>
      <select class="form-control" id="physical3" name="physical3">
        <option value="" disabled>Select auxiliary equipment defects condition</option>
        <option value="No adverse defects" <?php if ($buildingDetails['physical3'] === 'No adverse defects') echo 'selected'; ?>>No adverse defects</option>
        <option value="Presence of minor structural defects" <?php if ($buildingDetails['physical3'] === 'Presence of minor structural defects') echo 'selected'; ?>>Presence of minor structural defects</option>
        <option value="Presence of some severe defect found (see photos)" <?php if ($buildingDetails['physical3'] === 'Presence of some severe defect found (see photos)') echo 'selected'; ?>>Presence of some severe defect found (see photos)</option>
        <option value="Presence of multiple severe defects requiring investigation" <?php if ($buildingDetails['physical3'] === 'Presence of multiple severe defects requiring investigation') echo 'selected'; ?>>Presence of multiple severe defects requiring investigation</option>
      </select>
    </div>
    <div class="form-group">
      <label for="physical4">Ecological Consideration</label>
      <select class="form-control" id="physical4" name="physical4">
        <option value="" disabled>Select ecological consideration condition</option>
        <option value="No adverse defects" <?php if ($buildingDetails['physical4'] === 'No adverse defects') echo 'selected'; ?>>No adverse defects</option>
        <option value="Presence of minor structural defects" <?php if ($buildingDetails['physical4'] === 'Presence of minor structural defects') echo 'selected'; ?>>Presence of minor structural defects</option>
        <option value="Presence of some severe defect found (see photos)" <?php if ($buildingDetails['physical4'] === 'Presence of some severe defect found (see photos)') echo 'selected'; ?>>Presence of some severe defect found (see photos)</option>
        <option value="Presence of multiple severe defects requiring investigation" <?php if ($buildingDetails['physical4'] === 'Presence of multiple severe defects requiring investigation') echo 'selected'; ?>>Presence of multiple severe defects requiring investigation</option>
      </select>
    </div>


    <div class="form-group">
        <label for="vulnerability">Vulnerability</label>
        <textarea class="form-control" id="vulnerability" name="vulnerability" rows="5" placeholder="Enter vulnerability"><?php echo $buildingDetails['vulnerability']; ?></textarea>
    </div>

    <div class="form-group">
  <label for="multipleImages">Report Images</label>
  <input type="file" class="form-control-file" id="reportImages" name="reportImages[]" multiple require>
  <small class="form-text text-muted">You can select multiple images by holding down the Ctrl (Windows) or Command (Mac) key while selecting.</small>
</div>

<H1>Accessibilty Section</H1>
<!-- DOOR -->
<h3>Door</h3>
<div class="form-group">
  <label for="door1">DOOR ENTRANCE</label>
  <select class="form-control" id="door1" name="door1">
    <option value="Comply" <?php if ($buildingDetails['door1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['door1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['door1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<div class="form-group" >
  <label for="door2">0.80m DOOR WIDTH (MIN)</label>
  <select class="form-control" id="door2" name="door2">
    <option value="Comply" <?php if ($buildingDetails['door2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['door2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['door2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group" >
  <label for="door3">LEVER TYPE DOOR KNOB</label>
  <select class="form-control" id="door3" name="door3" >
  <option value="Comply" <?php if ($buildingDetails['door3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['door3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['door3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<!-- Entrance -->
<h3 class="entrance mt-4">Entrance</h3>
<div class="form-group">
  <label for="entrance1">DOOR ENTRANCE</label>
  <select class="form-control" id="entrance1" name="entrance1">
  <option value="Comply" <?php if ($buildingDetails['entrance1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['entrance1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['entrance1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="entrance2">0.80m DOOR WIDTH (MIN)</label>
  <select class="form-control" id="entrance2" name="entrance2">
  <option value="Comply" <?php if ($buildingDetails['entrance2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['entrance2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['entrance2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<!-- Corridors -->
<h3 class="corridor mt-4">Corridors</h3>
<div class="form-group">
  <label for="corridor1">1. 20 m WIDTH (MIN)</label>
  <select class="form-control" id="corridor1" name="corridor1">
    <option value="Comply" <?php if ($buildingDetails['corridor1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['corridor1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['corridor1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
    
  </select>
</div>
<div class="form-group">
  <label for="corridor2">1.50 m TURNING RADIUS PER 12 m </label>
  <select class="form-control" id="corridor2" name="corridor2">
  <option value="Comply" <?php if ($buildingDetails['corridor2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['corridor2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['corridor2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="corridor3">HEADROOM CLEARANCE NOT BELOW 2 m </label>
  <select class="form-control" id="corridor3" name="corridor3">
  <option value="Comply" <?php if ($buildingDetails['corridor3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['corridor3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['corridor3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="corridor4">TACTILE STRIPS</label>
  <select class="form-control" id="corridor4" name="corridor4">
  <option value="Comply" <?php if ($buildingDetails['corridor4'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['corridor4'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['corridor4'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<!-- SIGNAGE -->

<h3 class="signage mt-4">Signage</h3>
<div class="form-group">
  <label for="signage1">BETWEEN 1.4 - 1.6 m HEIGHT</label>
  <select class="form-control" id="signage1" name="signage1">
  <option value="Comply" <?php if ($buildingDetails['signage1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['signage1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['signage1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage2">WARNING (EXTERIOR)</label>
  <select class="form-control" id="signage2" name="signage2">
  <option value="Comply" <?php if ($buildingDetails['signage2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['signage2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['signage2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage3">PWD RAMP</label>
  <select class="form-control" id="signage3" name="signage3">
  <option value="Comply" <?php if ($buildingDetails['signage3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['signage3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['signage3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage4">PWD TOILETS</label>
  <select class="form-control" id="signage4" name="signage4">
  <option value="Comply" <?php if ($buildingDetails['signage4'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['signage4'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['signage4'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<!-- WASHROOMS -->

<h3 class="washroom mt-4">Washroom</h3>
<div class="form-group">
  <label for="washroom1">1.7 m x 1.8 m CUBICLE DIMENSION</label>
  <select class="form-control" id="washroom1" name="washroom1">
  <option value="Comply" <?php if ($buildingDetails['washroom1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom2">0.40 WC FROM CENTER </label>
  <select class="form-control" id="washroom2" name="washroom2">
  <option value="Comply" <?php if ($buildingDetails['washroom2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom3">2 GRAB BARS</label>
  <select class="form-control" id="washroom3" name="washroom3">
  <option value="Comply" <?php if ($buildingDetails['washroom3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom4">1.5 m TURNING RADIUS</label>
  <select class="form-control" id="washroom4" name="washroom4">
  <option value="Comply" <?php if ($buildingDetails['washroom4'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom4'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom4'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom5">0.80 - 0.85 cm LAVATORY HT</label>
  <select class="form-control" id="washroom5" name="washroom5">
  <option value="Comply" <?php if ($buildingDetails['washroom5'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom5'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom5'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom6">LEVER TYPE HANDLE FAUCET</label>
  <select class="form-control" id="washroom6" name="washroom6">
  <option value="Comply" <?php if ($buildingDetails['washroom6'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom6'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom6'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom7">0.75 - 0.80 m GRAB BAR HT</label>
  <select class="form-control" id="washroom7" name="washroom7">
  <option value="Comply" <?php if ($buildingDetails['washroom7'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom7'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom7'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom8">0.30 cm DIST OF GRAB BAR</label>
  <select class="form-control" id="washroom8" name="washroom8">
  <option value="Comply" <?php if ($buildingDetails['washroom8'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom8'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom8'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom9">0.45 - 0.50 m TOILET ELEV</label>
  <select class="form-control" id="washroom9" name="washroom9">
  <option value="Comply" <?php if ($buildingDetails['washroom9'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom9'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom9'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom10">NON-SKID FLOORING</label>
  <select class="form-control" id="washroom10" name="washroom10">
  <option value="Comply" <?php if ($buildingDetails['washroom10'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom10'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom10'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom11">DOOR SWINGS OUT</label>
  <select class="form-control" id="washroom11" name="washroom11">
  <option value="Comply" <?php if ($buildingDetails['washroom11'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['washroom11'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['washroom11'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<!-- RAMPS -->
<h3 class="ramps mt-4">Ramps</h3>
<div class="form-group">
  <label for="ramps1">LOCATED NEAR ENTRANCE</label>
  <select class="form-control" id="ramps1" name="ramps1">
  <option value="Comply" <?php if ($buildingDetails['ramps1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps2">GRADIENT (1:12 MAX)</label>
  <select class="form-control" id="ramps2" name="ramps2">
  <option value="Comply" <?php if ($buildingDetails['ramps2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps3">0.90 m & 0.7 HT OF HANDRAIL</label>
  <select class="form-control" id="ramps3" name="ramps3">
  <option value="Comply" <?php if ($buildingDetails['ramps3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps4">0.30 m EXTENSION </label>
  <select class="form-control" id="ramps4" name="ramps4">
  <option value="Comply" <?php if ($buildingDetails['ramps4'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps4'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps4'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps5">30 - 50 mm DIA OF HANDRAIL</label>
  <select class="form-control" id="ramps5" name="ramps5">
  <option value="Comply" <?php if ($buildingDetails['ramps5'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps5'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps5'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps6">50 mm CLEARANCE </label>
  <select class="form-control" id="ramps6" name="ramps6">
  <option value="Comply" <?php if ($buildingDetails['ramps6'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps6'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps6'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps7">6 m MAX. LENGTH</label>
  <select class="form-control" id="ramps7" name="ramps7">
  <option value="Comply" <?php if ($buildingDetails['ramps7'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps7'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps7'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps8">1.50 m PROVISION LANDING</label>
  <select class="form-control" id="ramps8" name="ramps8">
  <option value="Comply" <?php if ($buildingDetails['ramps8'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps8'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps8'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps9">1.20 m WIDTH</label>
  <select class="form-control" id="ramps9" name="ramps9">
    <option value="Comply" <?php if ($buildingDetails['ramps9'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['ramps9'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['ramps9'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
    <!-- PARKING -->
    <h3 class="parking mt-4">Parking</h3>
<div class="form-group">
  <label for="parking1">NEAR ACCESSIBLE BUILDING ENTRANCE</label>
  <select class="form-control" id="parking1" name="parking1">
  <option value="Comply" <?php if ($buildingDetails['parking1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['parking1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['parking1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="parking2">3.70 m x 5 m MIN DIMENSION</label>
  <select class="form-control" id="parking2" name="parking2">
  <option value="Comply" <?php if ($buildingDetails['parking2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['parking2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['parking2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="parking3">I.S.A. SIGNAGE</label>
  <select class="form-control" id="parking3" name="parking3">
    <option value="Comply" <?php if ($buildingDetails['parking3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['parking3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['parking3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<!-- Stairs -->

<h3 class="stairs mt-4">Stairs</h3>
<div class="form-group">
  <label for="stairs1">SLIP-RESISTANT TREAD SURFACE</label>
  <select class="form-control" id="stairs1" name="stairs1">
  <option value="Comply" <?php if ($buildingDetails['stairs1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['stairs1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['stairs1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs2">SLIPRESISTANT NOSING STRIPS</label>
  <select class="form-control" id="stairs2" name="stairs2">
  <option value="Comply" <?php if ($buildingDetails['stairs2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['stairs2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['stairs2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs3">SLANTED NOSINGS</label>
  <select class="form-control" id="stairs3" name="stairs3">
  <option value="Comply" <?php if ($buildingDetails['stairs3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['stairs3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['stairs3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs4">LEADING EDGE WITH PAINT OR NON-SKID MATERIAL</label>
  <select class="form-control" id="stairs4" name="stairs4">
  <option value="Comply" <?php if ($buildingDetails['stairs4'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['stairs4'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['stairs4'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs5">150 MM RISER (MAX) & 300 MM THREADS (MIN) </label>
  <select class="form-control" id="stairs5" name="stairs5">
  <option value="Comply" <?php if ($buildingDetails['stairs5'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['stairs5'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['stairs5'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<!-- Elevator -->
<h3 class="elevator mt-4">Elevator</h3>
<div class="form-group">
  <label for="parking1">2 WHEELCHAIRS ACCOMODATION</label>
  <select class="form-control" id="elevator1" name="elevator1">
    <option value="Comply" <?php if ($buildingDetails['elevator1'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['elevator1'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['elevator1'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="elevator2">BRAILLE SIGNS</label>
  <select class="form-control" id="elevator2" name="elevator2">
    <option value="Comply" <?php if ($buildingDetails['elevator2'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['elevator2'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['elevator2'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="elevator3">EQUIPPED WITH HANDRAILS</label>
  <select class="form-control" id="elevator3" name="elevator3">
    <option value="Comply" <?php if ($buildingDetails['elevator3'] === 'Comply') echo 'selected'; ?>>Comply</option>
    <option value="Not Comply" <?php if ($buildingDetails['elevator3'] === 'Not Comply') echo 'selected'; ?>>Not Comply</option>
    <option value="Not Applicable" <?php if ($buildingDetails['elevator3'] === 'Not Applicable') echo 'selected'; ?>>Not Applicable</option>
  </select>
</div>

<div class="form-group">
    <label for="recommendation">Recommendation</label>
    <textarea class="form-control" id="recommendation" name="recommendation" rows="5"><?php echo $buildingDetails['recommendation']; ?></textarea>
</div>


    <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
</form>
</body>
</html>
