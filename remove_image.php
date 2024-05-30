<?php
// remove_image.php
if (isset($_GET['image'])) {
    $image = $_GET['image'];
    $imagePath = 'path/to/uploads/' . $image;

    // Remove image file from server
    if (file_exists($imagePath) && unlink($imagePath)) {
        // Optionally, remove image entry from database here
        
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
