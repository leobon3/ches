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
    $door1 = $_POST['door1'];
    $door1 = $_POST['door2'];
    $door1 = $_POST['door3'];
    $entrance1= $_POST['entrance1'];
    $entrance2= $_POST['entrance2'];
    $corridor1= $_POST['corridor1'];
    $corridor2= $_POST['corridor2'];
    $corridor3= $_POST['corridor3'];
    $corridor4= $_POST['corridor4'];
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
    $rvs= $_POST['rvs'];

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
                    rvs = '$rvs'

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
            'vulnerability' => $vulnerability,
            'door1' => $door1,
            'door2' => $door2,
            'door3' => $door3,
            'entrance1' => $entrance1,
            'entrance2' => $entrance2,
            'corridor1' => $corridor1,
            'corridor2' => $corridor2,
            'corridor3' => $corridor3,
            'corridor4' => $corridor4,
            'signage1' => $signage1,
            'signage2' => $signage2,
            'signage3' => $signage3,
            'signage4' => $signage4,
            'washroom1' => $washroom1,
            'washroom2' => $washroom2,
            'washroom3' => $washroom3,
            'washroom4' => $washroom4,
            'washroom5' => $washroom5,
            'washroom6' => $washroom6,
            'washroom7' => $washroom7,
            'washroom8' => $washroom8,
            'washroom9' => $washroom9,
            'washroom10' => $washroom10,
            'washroom11' => $washroom11,
            'ramps1' => $ramps1,
            'ramps2' => $ramps2,
            'ramps3' => $ramps3,
            'ramps4' => $ramps4,
            'ramps5' => $ramps5,
            'ramps6' => $ramps6,
            'ramps7' => $ramps7,
            'ramps8' => $ramps8,
            'ramps9' => $ramps9,
            'parking1' => $parking1,
            'parking2' => $parking2,
            'parking3' => $parking3,
            'elevator1' => $elevator1,
            'elevator2' => $elevator2,
            'elevator3' => $elevator3,
            'stairs1' => $stairs1,
            'stairs2' => $stairs2,
            'stairs3'=> $stairs3,
            'stairs4' => $stairs4,
            'stairs5' => $stairs5,
            'recommendation'=> $recommendation,
            'physical1' => $physical1,
            'physical2' => $physical2,
            'physical3' => $physical3,
            'physical4' => $physical4,
            'renovated' => $renovated,
            'rvs' => $rvs

        ];
    } else {
        $errorMessage = "Failed to update building details.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $loggedIn) {
    // Retrieve updated building details from the form
    // Your existing form processing code here

    // Update the building details in the database
    // Your existing update query here

    // Handle success or failure messages
    // Your existing success or error handling code here
}

// Define $sections array
$sections = [
    'door' => ['door1', 'door2', 'door3'],
    'entrance' => ['entrance1', 'entrance2'],
    'corridors' => ['corridor1', 'corridor2', 'corridor3', 'corridor4'],
    'signage' => ['signage1', 'signage2', 'signage3', 'signage4'],
    'washrooms' => ['washroom1', 'washroom2', 'washroom3', 'washroom4', 'washroom5', 'washroom6', 'washroom7', 'washroom8', 'washroom9', 'washroom10', 'washroom11'],
    'ramps' => ['ramps1', 'ramps2', 'ramps3', 'ramps4', 'ramps5', 'ramps6', 'ramps7', 'ramps8', 'ramps9'],
    'parking' => ['parking1', 'parking2', 'parking3'],
    'elevator' => ['elevator1', 'elevator2', 'elevator3'],
    'stairs' => ['stairs1','stairs2','stairs3','stairs4','stairs5' ]
    
];

// Debug compliance data calculation
$totalComply = 0;
$totalNotComply = 0;
$totalNotApplicable=0;

foreach ($sections as $section => $criteria) {
    foreach ($criteria as $criterion) {
        
        // Update compliance counts based on status
        if (isset($buildingDetails[$criterion])) {
            if ($buildingDetails[$criterion] === 'Comply') {
                $totalComply++;
            } elseif ($buildingDetails[$criterion] === 'Not Comply') {
                $totalNotComply++;
            }
            elseif ($buildingDetails[$criterion] === 'Not Applicable') {
                $totalNotApplicable++;
            }
        } else {
            // Debug: Output if criterion status is missing
            echo "Missing status for criterion: $criterion<br>";
        }
    }
}

// Calculate total items
$totalItems = $totalComply + $totalNotComply +$totalNotApplicable;

// Calculate percentages only if $totalItems is greater than zero
if ($totalItems > 0) {
    $compliancePercentage = ($totalComply / $totalItems) * 100;
    $nonCompliancePercentage = ($totalNotComply / $totalItems) * 100;
    $nonApplicablePercentage = ($totalNotApplicable / $totalItems) * 100;
    $formattedCompliance = number_format($compliancePercentage, 3);
    $formattedNonCompliance = number_format($nonCompliancePercentage, 3);
    $formattedNonApplicable = number_format($nonApplicablePercentage, 3);
} else {
    $compliancePercentage = 0;
    $nonCompliancePercentage = 0;
    $nonApplicablePercentage = 0;
    
}


?>

<!-- Include Chart.js library -->


<!-- Display pie chart -->




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Building Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous"/> 
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
        margin-top: 20px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
        
      background-image: url('images/building.jpg');
      background-attachment: fixed;
      background-size: cover; /* Cover the entire container*/
      background-repeat: no-repeat;
      background-position: center;
    
    }
    .main-body {
        padding: 15px;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }
    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }
    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }
    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }
    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
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
    /* Style for the centered container */
    .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 450px;
            height: 550px;
            margin: 0 auto; /* Center the container itself horizontally */
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .percentage {
            font-weight: bold;
            color: #007bff;
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
.container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
        }
   
  </style>
</head>
<body>
    <!-- Debug PHP variables -->





<div class="container">
<header class="text-center mb-5 pb-5 text-black">
            <h1 class="list mt-4 display-4">Building Details</h1>
            
        </header>
<div class="col-md-auto">
    <div class="button"> 
        <?php
        // Check if the user is logged in
        
            // If logged in, redirect to admin_building.php
            echo '<a class="btn btn-primary rounded-pill" href="company.php?name=' . urlencode($buildingDetails['company']) . '" role="button">Back to Company</a>';
        
        ?>
    </div>
</div>
    <div class="main-body">
        <?php if (isset($errorMessage)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php } elseif (isset($buildingDetails)) { ?>
          <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo $imageUrls[0]; ?>" alt="Building Image" class="img-fluid">
                            <div class="mt-3">
                                <h4><?php echo $buildingDetails['building_name']; ?></h4>
                                <p class="text-secondary mb-1"><?php echo $buildingDetails['building_type']; ?></p>
                                <p class="text-muted font-size-sm"><?php echo $buildingDetails['location']; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-3">
                        <div id="reportImageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($reportImageUrls as $index => $reportImageUrl) { ?>
                                    <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                                        <img src="<?php echo $reportImageUrl; ?>" class="d-block w-100" alt="Report Image <?php echo $index + 1; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#reportImageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#reportImageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                                
                </div>
                
                <div class="col-md-8">
                  
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="post">
                            <h4 >Building Details</h4>
                            <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Building Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="buildingName" name="buildingName" value="<?php echo $buildingDetails['building_name']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="company"name="company" value="<?php echo $buildingDetails['company']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Location</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $buildingDetails['location']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Year Established</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="yearEstablished" name="yearEstablished" value="<?php echo $buildingDetails['year_established']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Number of Storey</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="numOfStorey" name="numOfStorey" value="<?php echo $buildingDetails['num_of_storey']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Building Type</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="buildingType" name="buildingType" value="<?php echo $buildingDetails['building_type']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Building Structure</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="buildingStructure" name="buildingStructure" value="<?php echo $buildingDetails['building_structure']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Design Occupancy</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="designOccupancy" name="designOccupancy" value="<?php echo $buildingDetails['design_occupancy']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Renovation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="renovated" name="renovated" value="<?php echo $buildingDetails['renovated']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <h4>Summary Report</h4>
                               <hr>
                               <center><h5>Rapid Visual Screening of Building for Potential Seismic Hazard</h5></center>
                                <div class="row mt-4">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">RVS Score</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="rvs" name="rvs" value="<?php echo $buildingDetails['rvs']; ?>"disabled>
                                    </div>
                                </div>
                                
                                <hr>
                                 <!-- Phyiscal start -->
                                <center><h5>Physical Condition</h5></center>
                                <div class="row mt-4">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Structural Defects</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="physical1" name="physical1" value="<?php echo $buildingDetails['physical1']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Non-Structural Defects </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="physical1" name="physical1" value="<?php echo $buildingDetails['physical2']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ancillary/Auxiliary Equipment and Facilities Defects</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="physical1" name="physical1" value="<?php echo $buildingDetails['physical3']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ecological Consideration</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id="physical1" name="physical1" value="<?php echo $buildingDetails['physical4']; ?>"disabled>
                                    </div>
                                </div>
                                <hr>
                                <!-- Phyiscal end -->
                                <center><h5>Vulnerability of Building Site / Location</h5></center>
                                <div class="row mt-4">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vulnerability</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" id="vulnerability" name="vulnerability" disabled><?php echo $buildingDetails['vulnerability']; ?></textarea>
                                    </div>
                                </div>

                                <hr>
                                <?php if ($loggedIn) : ?>
                                <!-- Edit button for logged-in users -->
                                <a href="edit_building.php?id=<?php echo $buildingId; ?>" class="btn btn-primary btn rounded-pill">Edit</a>
                                <?php endif; ?>
                                                
                    
               
                                        
                        </div>
                    </div>
                    

                    

                </div>
            </div>
            <!-- This is for the nav pill -->
            <section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 text-black">
            <h1 class="list mt-4 display-4">Accessibility Section</h1>
            <div id="chartContainer" class="chart-container mt-5">
                <canvas id="complianceChart"></canvas>
                <form>
                    <label for="compliance">Compliance Percentage: <span class="percentage"><?php echo number_format($compliancePercentage, 3); ?>%</span></label>
                    <label for="nonCompliance">Non-Compliance Percentage: <span class="percentage"><?php echo number_format($nonCompliancePercentage, 3); ?>%</span></label>
                    <label for="nonCompliance">Non-Applicable Percentage: <span class="percentage"><?php echo number_format($nonApplicablePercentage, 3); ?>%</span></label>
                </form>
            </div>
        </header>

        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-door-tab" data-toggle="pill" href="#v-pills-door" role="tab" aria-controls="v-pills-door" aria-selected="false">
                        <i class="fa fa-user-circle-o mr-2"></i> Door
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-entrance-tab" data-toggle="pill" href="#v-pills-entrance" role="tab" aria-controls="v-pills-entrance" aria-selected="false">
                        <i class="fa fa-calendar-minus-o mr-2"></i> Entrance
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-corridors-tab" data-toggle="pill" href="#v-pills-corridors" role="tab" aria-controls="v-pills-corridors" aria-selected="false">
                    Corridors and Hallways
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-signage-tab" data-toggle="pill" href="#v-pills-signage" role="tab" aria-controls="v-pills-signage" aria-selected="false">
                         Signage
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-washrooms-tab" data-toggle="pill" href="#v-pills-washrooms" role="tab" aria-controls="v-pills-washrooms" aria-selected="false">
                    Washroom and Toilet
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-ramps-tab" data-toggle="pill" href="#v-pills-ramps" role="tab" aria-controls="v-pills-ramps" aria-selected="false">
                        Ramps
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-parking-tab" data-toggle="pill" href="#v-pills-parking" role="tab" aria-controls="v-pills-parking" aria-selected="false">
                         Parking
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-elevator-tab" data-toggle="pill" href="#v-pills-elevator" role="tab" aria-controls="v-pills-elevator" aria-selected="false">
                        Elevator
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-stairs-tab" data-toggle="pill" href="#v-pills-stairs" role="tab" aria-controls="v-pills-stairs" aria-selected="false">
                        Stairs
                    </a>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-recommendation-tab" data-toggle="pill" href="#v-pills-recommendation" role="tab" aria-controls="v-pills-recommendation" aria-selected="false">
                    Findings and Recommendation
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-door" role="tabpanel" aria-labelledby="v-pills-door-tab">
                      <h4 class="font-italic mb-4">Door</h4>
                      <!-- Bootstrap table -->
                      <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>DOOR ENTRANCE</th>
                                      <th>0.80m DOOR WIDTH (MIN)</th>
                                      <th>LEVER TYPE DOOR KNOB</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td class="door" id="door1" name="door1"><?php echo $buildingDetails['door1']; ?></td>
                                      <td class="door" id="door2" name="door2"><?php echo $buildingDetails['door2']; ?></td>
                                      <td class="door" id="door2" name="door2"> <?php echo $buildingDetails['door3']; ?></td>
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>

                  </div>

                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-entrance" role="tabpanel" aria-labelledby="v-pills-entrance-tab">
                        <h4 class="font-italic mb-4">Entrance</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>25 mm THRESHOLD</th>
                                      <th>0.80 m CLEARANCE</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['entrance1']; ?></td>
                                      <td><?php echo $buildingDetails['entrance2']; ?></td>
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-corridors" role="tabpanel" aria-labelledby="v-pills-corridors-tab">
                        <h4 class="font-italic mb-4">Corridors and Hallways</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>1. 20 m WIDTH (MIN)</th>
                                      <th>1.50 m TURNING RADIUS PER 12 m </th>
                                      <th>HEADROOM CLEARANCE NOT BELOW 2 m </th>
                                      <th>TACTILE STRIPS</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['corridor1']; ?></td>
                                      <td><?php echo $buildingDetails['corridor2']; ?></td>
                                      <td><?php echo $buildingDetails['corridor3']; ?></td>
                                      <td><?php echo $buildingDetails['corridor4']; ?></td>
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-signage" role="tabpanel" aria-labelledby="v-pills-signage-tab">
                        <h4 class="font-italic mb-4">Signage</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>BETWEEN 1.4 - 1.6 m HEIGHT</th>
                                      <th>WARNING (EXTERIOR)</th>
                                      <th>PWD RAMP</th>
                                      <th>PWD TOILETS</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['signage1']; ?></td>
                                      <td><?php echo $buildingDetails['signage2']; ?></td>
                                      <td><?php echo $buildingDetails['signage3']; ?></td>
                                      <td><?php echo $buildingDetails['signage4']; ?></td>
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-washrooms" role="tabpanel" aria-labelledby="v-pills-washrooms-tab">
                        <h4 class="font-italic mb-4">Washroom and Toilet</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>1.7 m x 1.8 m CUBICLE DIMENSION</th>
                                      <th>0.40 WC FROM CENTER </th>
                                      <th>2 GRAB BARS</th>
                                      <th>1.5 m TURNING RADIUS</th>
                                      <th>0.80 - 0.85 cm LAVATORY HT</th>
                                      <th>LEVER TYPE HANDLE FAUCET</th>
                                      <th>0.75 - 0.80 m GRAB BAR HT</th>
                                      <th>0.30 cm DIST OF GRAB BAR</th>
                                      <th>0.45 - 0.50 m TOILET ELEV</th>
                                      <th>NON-SKID FLOORING</th>
                                      <th>DOOR SWINGS OUT</th>
                                    
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['washroom1']; ?></td>
                                      <td><?php echo $buildingDetails['washroom2']; ?></td>
                                      <td><?php echo $buildingDetails['washroom3']; ?></td>
                                      <td><?php echo $buildingDetails['washroom4']; ?></td>
                                      <td><?php echo $buildingDetails['washroom5']; ?></td>
                                      <td><?php echo $buildingDetails['washroom6']; ?></td>
                                      <td><?php echo $buildingDetails['washroom7']; ?></td>
                                      <td><?php echo $buildingDetails['washroom8']; ?></td>
                                      <td><?php echo $buildingDetails['washroom9']; ?></td>
                                      <td><?php echo $buildingDetails['washroom10']; ?></td>
                                      <td><?php echo $buildingDetails['washroom11']; ?></td>
                                      
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-ramps" role="tabpanel" aria-labelledby="v-pills-ramps-tab">
                        <h4 class="font-italic mb-4">Ramps</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>LOCATED NEAR ENTRANCE</th>
                                      <th>GRADIENT (1:12 MAX)</th>
                                      <th>0.90 m & 0.7 HT OF HANDRAIL</th>
                                      <th>0.30 m EXTENSION </th>
                                      <th>30 - 50 mm DIA OF HANDRAIL</th>
                                      <th>50 mm CLEARANCE </th>
                                      <th>6 m MAX. LENGTH</th>
                                      <th>1.50 m PROVISION LANDING</th>
                                      <th>1.20 m WIDTH</th>
                                      
                                    
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['ramps1']; ?></td>
                                      <td><?php echo $buildingDetails['ramps2']; ?></td>
                                      <td><?php echo $buildingDetails['ramps3']; ?></td>
                                      <td><?php echo $buildingDetails['ramps4']; ?></td>
                                      <td><?php echo $buildingDetails['ramps5']; ?></td>
                                      <td><?php echo $buildingDetails['ramps6']; ?></td>
                                      <td><?php echo $buildingDetails['ramps7']; ?></td>
                                      <td><?php echo $buildingDetails['ramps8']; ?></td>
                                      <td><?php echo $buildingDetails['ramps9']; ?></td>
                                      
                                      
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-parking" role="tabpanel" aria-labelledby="v-pills-parking-tab">
                        <h4 class="font-italic mb-4">Parking</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>NEAR ACCESSIBLE BUILDING ENTRANCE</th>
                                      <th>3.70 m x 5 m MIN DIMENSION</th>
                                      <th>I.S.A. SIGNAGE</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['parking1']; ?></td>
                                      <td><?php echo $buildingDetails['parking2']; ?></td>
                                      <td><?php echo $buildingDetails['parking3']; ?></td>
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <!-- Stairs -->
                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-stairs" role="tabpanel" aria-labelledby="v-pills-stairs-tab">
                        <h4 class="font-italic mb-4">Stairs</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>SLIP-RESISTANT TREAD SURFACE</th>
                                      <th>SLIPRESISTANT NOSING STRIPS </th>
                                      <th>SLANTED NOSINGS </th>
                                      <th>LEADING EDGE WITH PAINT OR NON-SKID MATERIAL</th>
                                      <th>150 MM RISER (MAX) & 300 MM THREADS (MIN) </th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['stairs1']; ?></td>
                                      <td><?php echo $buildingDetails['stairs2']; ?></td>
                                      <td><?php echo $buildingDetails['stairs3']; ?></td>
                                      <td><?php echo $buildingDetails['stairs4']; ?></td>
                                      <td><?php echo $buildingDetails['stairs5']; ?></td>
                                      
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-elevator" role="tabpanel" aria-labelledby="v-pills-elevator-tab">
                        <h4 class="font-italic mb-4">Elevator</h4>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>2 WHEELCHAIRS ACCOMODATION</th>
                                      <th>BRAILLE SIGNS</th>
                                      <th>EQUIPPED WITH HANDRAILS</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $buildingDetails['elevator1']; ?></td>
                                      <td><?php echo $buildingDetails['elevator2']; ?></td>
                                      <td><?php echo $buildingDetails['elevator3']; ?></td>
                                  </tr>
                                 
                                  <!-- Add more rows as needed -->
                              </tbody>
                          </table>
                      </div>
                    </div>

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-recommendation" role="tabpanel" aria-labelledby="v-pills-recommendation-tab">
                        <h4 class="font-italic mb-4">Findings and Recommendation</h4>
                        <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Recommendation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" id="recommendation" name="recommendation" disabled><?php echo $buildingDetails['recommendation']; ?></textarea>
                                    </div>
                                </div>
                    </div>

                </div>
                
            </div>
            </form>
                           


            
        </div>
    </div>
</section>

        <?php } ?>
    </div>
    <?php if (isset($successMessage)) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('complianceChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Comply', 'Not Comply', 'Non Applicable'],
            datasets: [{
                label: 'Accessibility Compliance',
                data: [<?php echo $compliancePercentage; ?>, <?php echo $nonCompliancePercentage; ?>, <?php echo $nonApplicablePercentage; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // Comply color
                    'rgba(255, 99, 132, 0.2)', // Not Comply color
                    'rgba(201, 203, 207, 0.2)' // Non Applicable color
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(201, 203, 207, 1)' // Non Applicable border color
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Accessibility Compliance'
                }
            }
        }
    });
</script>







</body>
</html>
