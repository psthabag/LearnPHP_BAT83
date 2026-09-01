<?php
// 1. Include your existing database connection file here
include 'connect.php'; 

if (isset($_POST['submit'])) {
    
    // Capture text fields
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // File upload settings
    $target_dir = "uploads/"; // Make sure this folder exists in your directory
    $file_name = time() . "_" . basename($_FILES["student_image"]["name"]); // Adds timestamp to avoid duplicate names
    $target_file_path = $target_dir . $file_name;

    // Move file from temporary location to your "uploads" folder
    if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $target_file_path)) {
        
        // 2. Prepare SQL Query (SN is skipped assuming it is AUTO_INCREMENT)
        $sql = "INSERT INTO students (name, address, phone, imagepath) VALUES ('$name', '$address', '$phone', '$target_file_path')";

        // 3. Execute the query using your existing connection variable (e.g., $conn or $db)
        if (mysqli_query($conn, $sql)) {
            echo "Student data and image uploaded successfully!";
            echo "<br><a href='index.php'>Go Back</a>";
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }

    } else {
        echo "Error: Failed to upload the image file to the server folder.";
    }
}
?>
