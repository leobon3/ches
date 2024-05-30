<?php

// Include database connection
include_once 'db_config.php';

session_start();
// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company = $_POST['company'];
    $buildingName = $_POST['buildingName'];
    $location = $_POST['location'];
    $yearEstablished = $_POST['yearEstablished'];
    $numOfStorey = $_POST['numOfStorey'];
    $buildingType = $_POST['buildingType'];
    $buildingStructure = $_POST['buildingStructure'];
    $designOccupancy = $_POST['designOccupancy'];
    $physicalCondition = $_POST['physicalCondition'];
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
    $parking1 =$_POST['parking1'];
    $parking2 =$_POST['parking2'];
    $parking3 =$_POST['parking3'];
    $elevator1 =$_POST['elevator1'];
    $elevator2 =$_POST['elevator2'];
    $elevator3 =$_POST['elevator3'];
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

    
    
    // Check if "vulnerability" is set before accessing it
    if (isset($_POST['vulnerability'])) {
        $vulnerability = $_POST['vulnerability'];
    } else {
        $vulnerability = ""; // Or handle it according to your requirements
    }
    
    // Handle file uploads for building images
    // Handle file uploads for building images
$buildingImages = [];
if (!empty($_FILES['images']['name'][0])) {
    $fileCount = count($_FILES['images']['name']);
    for ($i = 0; $i < $fileCount; $i++) {
        // Generate a unique filename for each image
        $targetDir = "uploads/";
        $targetFile = $targetDir . uniqid() . '_' . basename($_FILES["images"]["name"][$i]);
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFile)) {
            // Store the file path in the $buildingImages array
            $buildingImages[] = $targetFile;
        }
    }
}

// Handle file uploads for report images
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
}

// Insert data into the database
$sql = "INSERT INTO buildings (company, building_name, location, year_established, num_of_storey, building_type, building_structure, design_occupancy, physical_condition, vulnerability, door1, door2, door3,entrance1,entrance2,corridor1,corridor2,corridor3,corridor4,signage1,signage2,signage3,
signage4,washroom1,washroom2,washroom3,washroom4,washroom5,washroom6,washroom7,washroom8,washroom9,washroom10,washroom11,ramps1,ramps2,ramps3,ramps4,ramps5,ramps6,ramps7,ramps8,ramps9,parking1,parking2,parking3,elevator1,elevator2,elevator3,stairs1,stairs2,stairs3,stairs4,stairs5,recommendation,physical1,physical2,physical3,physical4,renovated,rvs,  images, report_images) 
        VALUES ('$company', '$buildingName', '$location', '$yearEstablished', '$numOfStorey', '$buildingType', '$buildingStructure', '$designOccupancy', '$physicalCondition', '$vulnerability','$door1','$door2','$door3','$entrance1','$entrance2','$corridor1','$corridor2','$corridor3','$corridor4','$signage1','$signage2','$signage3',
        '$signage4','$washroom1','$washroom2','$washroom3','$washroom4','$washroom5','$washroom6','$washroom7','$washroom8','$washroom9','$washroom10','$washroom11','$ramps1','$ramps2','$ramps3','$ramps4','$ramps5','$ramps6','$ramps7','$ramps8','$ramps9','$parking1','$parking2','$parking3','$elevator1','$elevator2','$elevator3','$stairs1','$stairs2','$stairs3','$stairs4','$stairs5','$recommendation','$physical1','$physical2','$physical3','$physical4','$renovated','$rvs', '" . implode(",", $buildingImages) . "', '" . implode(",", $reportImages) . "')";



    if (mysqli_query($conn, $sql)) {
        // Data insertion successful
        $successMessage = "Building added successfully.";

        // Create a new PHP file for the building under the selected company
        $filename = "companies/" . $company . "/" . $buildingName . ".php";
        $content = "<?php\n\$buildingName = \"$buildingName\";\n\$location = \"$location\";\n\$yearEstablished = \"$yearEstablished\";\n\$numOfStorey = \"$numOfStorey\";\n\$buildingType = \"$buildingType\";\n\$buildingStructure = \"$buildingStructure\";\n\$designOccupancy = \"$designOccupancy\";\n\$physicalCondition = \"$physicalCondition\";\n\$vulnerability = \"$vulnerability\";\n\$door1 = \"$door1\";\n\$door2 = \"$door2\";\n\$door3 = \"$door3\";\n?>";
        if (!file_exists("companies/" . $company)) {
            mkdir("companies/" . $company, 0777, true);
        }
        file_put_contents($filename, $content);
    } else {
        // Data insertion failed
        $errorMessage = "Error: " . mysqli_error($conn);
    }
} else {
    // Display error message if required fields are not filled
    $errorMessage = "All fields are required.";
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
<form action="create_building.php" method="post" enctype="multipart/form-data">

        <h2>Add Building</h2>
        <div class="form-group">
            <label for="buildingName">Select Company</label>
            <select class="form-control" id="company" name="company">
                <option value="">Select Company</option>
                <?php
                // Fetch companies from the database and populate dropdown options
                $query = "SELECT DISTINCT companyName FROM company";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['companyName'] . '">' . $row['companyName'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

    <div class="form-group">
      <label for="buildingName">Building Name</label>
      <input type="text" class="form-control" id="buildingName"name="buildingName" placeholder="Enter building name">
    </div>
    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" class="form-control" id="location"name="location" placeholder="Enter location">
    </div>
    <div class="form-group">
      <label for="yearEstablished">Year Established</label>
      <input type="text" class="form-control" id="yearEstablished"name="yearEstablished" placeholder="Enter year established">
    </div>
    <div class="form-group">
      <label for="numOfStorey">Number of Storey</label>
      <input type="text" class="form-control" id="numOfStorey"name="numOfStorey" placeholder="Enter number of storey">
    </div>
    <div class="form-group">
      <label for="buildingType">Type of Building</label>
      <select class="form-control" id="buildingType" name="buildingType">
        <option value="" disabled selected>Select type of building</option>
        <option value="Concrete Frame">Concrete Frame</option>
        <option value="Steel Frame">Steel Frame</option>
        <option value="Reinforced Concrete Shear Wall">Reinforced Concrete Shear Wall</option>
        <option value="Timber Frame">Timber Frame</option>
        <option value="Composite Steel-Concrete">Composite Steel-Concrete</option>
        <option value="Reinforced Masonary">Reinforced Masonary</option>
        <option value="Unreinforced Masonary">Unreinforced Masonary</option>
      </select>
    </div>
    <div class="form-group">
      <label for="buildingStructure">Type of Structure</label>
      <select class="form-control" id="buildingStructure" name="buildingStructure">
        <option value="" disabled selected>Select type of structure</option>
        <option value="Build-up Section">Build-up Section</option>
        <option value="Rolled Section">Rolled Section</option>
        <option value="Pre-Cast">Pre-Cast</option>
        <option value="Cast-In-Place">Cast-In-Place</option>
        <option value="Combination">Combination</option>
      </select>
    </div>

    <div class="form-group">
      <label for="Renovated">Renovation</label>
      <select class="form-control" id="renovated" name="renovated">
        
        <option value="Renovated">Renovated</option>
        <option value="Not Renovated">Not Renovated</option>
       
      </select>
    </div>

    <div class="form-group">
      <label for="designOccupancy">Design Occupancy</label>
      <input type="text" class="form-control" id="designOccupancy"name="designOccupancy" placeholder="Enter design occupancy">
    </div>
    
   
    <!-- Multiple Images Input -->
    <div class="form-group">
        <label for="images">Building Images</label>
        <input type="file" class="form-control-file" id="images" name="images[]" multiple require>
        <small class="form-text text-muted">You can select multiple images by holding down the Ctrl (Windows) or Command (Mac) key while selecting.</small>
    </div>

    
    <hr>
    
    <h2>Summary Report</h2>
    <div class="form-group">
      <label for="rvs">RVS Score</label>
      <input type="text" class="form-control" id="rvs"name="rvs" placeholder="Enter RVS Score">
    </div>
    <hr>
    <div class="form-group mt-5">
      <h4>Physical Condition</h4>
      <div class="form-group">
        <label for="physical1">Structural Defects</label>
        <select class="form-control" id="physical1" name="physical1">
          <option value="" disabled selected>Select structural defects condition</option>
          <option value="No adverse defects">No adverse defects</option>
          <option value="Presence of minor structural defects">Presence of minor structural defects</option>
          <option value="Presence of some severe defect found (see photos)">Presence of some severe defect found (see photos)</option>
          <option value="Presence of multiple severe defects requiring investigation">Presence of multiple severe defects requiring investigation</option>
        </select>
      </div>
      <div class="form-group">
        <label for="physical2">Non-Structural Defects</label>
        <select class="form-control" id="physical2" name="physical2">
          <option value="" disabled selected>Select non-structural defects condition</option>
          <option value="No adverse defects">No adverse defects</option>
          <option value="Presence of minor structural defects">Presence of minor structural defects</option>
          <option value="Presence of some severe defect found (see photos)">Presence of some severe defect found (see photos)</option>
          <option value="Presence of multiple severe defects requiring investigation">Presence of multiple severe defects requiring investigation</option>
        </select>
      </div>
      <div class="form-group">
        <label for="physical3">Ancillary/Auxiliary Equipment and Facilities Defects</label>
        <select class="form-control" id="physical3" name="physical3">
          <option value="" disabled selected>Select auxiliary equipment defects condition</option>
          <option value="No adverse defects">No adverse defects</option>
          <option value="Presence of minor structural defects">Presence of minor structural defects</option>
          <option value="Presence of some severe defect found (see photos)">Presence of some severe defect found (see photos)</option>
          <option value="Presence of multiple severe defects requiring investigation">Presence of multiple severe defects requiring investigation</option>
        </select>
      </div>
      <div class="form-group">
        <label for="physical4">Ecological Consideration</label>
        <select class="form-control" id="physical4" name="physical4">
          <option value="" disabled selected>Select ecological consideration condition</option>
          <option value="No adverse defects">No adverse defects</option>
          <option value="Presence of minor structural defects">Presence of minor structural defects</option>
          <option value="Presence of some severe defect found (see photos)">Presence of some severe defect found (see photos)</option>
          <option value="Presence of multiple severe defects requiring investigation">Presence of multiple severe defects requiring investigation</option>
        </select>
      </div>


    </div>
    <div class="form-group">
      <label for="vulnerability">Vulnerability</label>
      <textarea class="form-control" id="vulnerability"name="vulnerability" rows="5" placeholder="Enter vulnerability"></textarea>
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
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="door2">0.80m DOOR WIDTH (MIN)</label>
  <select class="form-control" id="door2" name="door2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="door3">LEVER TYPE DOOR KNOB</label>
  <select class="form-control" id="door3" name="door3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<!-- Entrance -->
<h3 class="entrance mt-4">Entrance</h3>
<div class="form-group">
  <label for="entrance1">DOOR ENTRANCE</label>
  <select class="form-control" id="entrance1" name="entrance1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="entrance2">0.80m DOOR WIDTH (MIN)</label>
  <select class="form-control" id="entrance2" name="entrance2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<!-- Corridors -->
<h3 class="corridor mt-4">Corridors and Hallways</h3>
<div class="form-group">
  <label for="corridor1">1. 20 m WIDTH (MIN)</label>
  <select class="form-control" id="corridor1" name="corridor1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="corridor2">1.50 m TURNING RADIUS PER 12 m </label>
  <select class="form-control" id="corridor2" name="corridor2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="corridor3">HEADROOM CLEARANCE NOT BELOW 2 m </label>
  <select class="form-control" id="corridor3" name="corridor3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="corridor4">TACTILE STRIPS</label>
  <select class="form-control" id="corridor4" name="corridor4">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<!-- SIGNAGE -->

<h3 class="signage mt-4">Signage</h3>
<div class="form-group">
  <label for="signage1">BETWEEN 1.4 - 1.6 m HEIGHT</label>
  <select class="form-control" id="signage1" name="signage1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage2">WARNING (EXTERIOR)</label>
  <select class="form-control" id="signage2" name="signage2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage3">PWD RAMP</label>
  <select class="form-control" id="signage3" name="signage3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="signage4">PWD TOILETS</label>
  <select class="form-control" id="signage4" name="signage4">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>

<!-- WASHROOMS -->

<h3 class="washroom mt-4">Washroom and Toilet</h3>
<div class="form-group">
  <label for="washroom1">1.7 m x 1.8 m CUBICLE DIMENSION</label>
  <select class="form-control" id="washroom1" name="washroom1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom2">0.40 WC FROM CENTER </label>
  <select class="form-control" id="washroom2" name="washroom2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom3">2 GRAB BARS</label>
  <select class="form-control" id="washroom3" name="washroom3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom4">1.5 m TURNING RADIUS</label>
  <select class="form-control" id="washroom4" name="washroom4">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom5">0.80 - 0.85 cm LAVATORY HT</label>
  <select class="form-control" id="washroom5" name="washroom5">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom6">LEVER TYPE HANDLE FAUCET</label>
  <select class="form-control" id="washroom6" name="washroom6">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom7">0.75 - 0.80 m GRAB BAR HT</label>
  <select class="form-control" id="washroom7" name="washroom7">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom8">0.30 cm DIST OF GRAB BAR</label>
  <select class="form-control" id="washroom8" name="washroom8">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom9">0.45 - 0.50 m TOILET ELEV</label>
  <select class="form-control" id="washroom9" name="washroom9">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom10">NON-SKID FLOORING</label>
  <select class="form-control" id="washroom10" name="washroom10">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="washroom11">DOOR SWINGS OUT</label>
  <select class="form-control" id="washroom11" name="washroom11">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>

<!-- RAMPS -->
<h3 class="ramps mt-4">Ramps</h3>
<div class="form-group">
  <label for="ramps1">LOCATED NEAR ENTRANCE</label>
  <select class="form-control" id="ramps1" name="ramps1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps2">GRADIENT (1:12 MAX)</label>
  <select class="form-control" id="ramps2" name="ramps2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps3">0.90 m & 0.7 HT OF HANDRAIL</label>
  <select class="form-control" id="ramps3" name="ramps3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps4">0.30 m EXTENSION </label>
  <select class="form-control" id="ramps4" name="ramps4">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps5">30 - 50 mm DIA OF HANDRAIL</label>
  <select class="form-control" id="ramps5" name="ramps5">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps6">50 mm CLEARANCE </label>
  <select class="form-control" id="ramps6" name="ramps6">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps7">6 m MAX. LENGTH</label>
  <select class="form-control" id="ramps7" name="ramps7">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps8">1.50 m PROVISION LANDING</label>
  <select class="form-control" id="ramps8" name="ramps8">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="ramps9">1.20 m WIDTH</label>
  <select class="form-control" id="ramps9" name="ramps9">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
    <!-- PARKING -->
    <h3 class="parking mt-4">Parking</h3>
<div class="form-group">
  <label for="parking1">NEAR ACCESSIBLE BUILDING ENTRANCE</label>
  <select class="form-control" id="parking1" name="parking1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="parking2">3.70 m x 5 m MIN DIMENSION</label>
  <select class="form-control" id="parking2" name="parking2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="parking3">I.S.A. SIGNAGE</label>
  <select class="form-control" id="parking3" name="parking3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>

<!-- Stairs -->
<h3 class="stairs mt-4">Stairs</h3>
<div class="form-group">
  <label for="stairs1">SLIP-RESISTANT TREAD SURFACE</label>
  <select class="form-control" id="stairs1" name="stairs1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="elevator2">SLIPRESISTANT NOSING STRIPS</label>
  <select class="form-control" id="stairs2" name="stairs2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs3">SLANTED NOSINGS</label>
  <select class="form-control" id="stairs3" name="stairs3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs4">LEADING EDGE WITH PAINT OR NON-SKID MATERIAL</label>
  <select class="form-control" id="stairs4" name="stairs4">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="stairs5">150 MM RISER (MAX) & 300 MM THREADS (MIN) </label>
  <select class="form-control" id="stairs5" name="stairs5">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>

<!-- Elevator -->
<h3 class="elevator mt-4">Elevator</h3>
<div class="form-group">
  <label for="parking1">2 WHEELCHAIRS ACCOMODATION</label>
  <select class="form-control" id="elevator1" name="elevator1">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="elevator2">BRAILLE SIGNS</label>
  <select class="form-control" id="elevator2" name="elevator2">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>
<div class="form-group">
  <label for="elevator3">EQUIPPED WITH HANDRAILS</label>
  <select class="form-control" id="elevator3" name="elevator3">
    <option value="Comply">Comply</option>
    <option value="Not Comply">Not Comply</option>
    <option value="Not Applicable">Not Applicable</option>
  </select>
</div>

<div class="form-group">
      <label for="recommendation">Findings and Recommendations</label>
      <textarea class="form-control" id="recommendation"name="recommendation" rows="5" placeholder="Enter Recommendation"></textarea>
    </div>



    <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
</form>

    <!-- Display success or error message -->
    <?php
  if (isset($successMessage)) {
      echo '<div class="alert alert-success mt-3" role="alert">' . $successMessage . '</div>';
  } elseif (isset($errorMessage)) {
      echo '<div class="alert alert-danger mt-3" role="alert">' . $errorMessage . '</div>';
  }
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3419084a43.js" crossorigin="anonymous"></script>
</body>
</html>




