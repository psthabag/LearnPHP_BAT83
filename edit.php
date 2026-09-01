<?php
// Include your existing database connection file here
include 'connect.php'; 

// Fetch existing data for the student
if (isset($_GET['sn'])) {
    $sn = $_GET['sn'];
    $get_student = mysqli_query($conn, "SELECT * FROM students WHERE std_id = '$sn'");
    $student = mysqli_fetch_assoc($get_student);
}

// --- HANDLE UPDATE LOGIC ---
if (isset($_POST['update'])) {
    $sn = $_POST['sn'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    
    $old_imagepath = $_POST['old_imagepath'];
    $final_image_path = $old_imagepath; // Default to old image path

    // Check if user uploaded a NEW image
    if ($_FILES['student_image']['name'] != "") {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["student_image"]["name"]);
        $target_file_path = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $target_file_path)) {
            // Delete the old file from the folder to save space
            if (file_exists($old_imagepath)) {
                unlink($old_imagepath);
            }
            $final_image_path = $target_file_path; // Set path to new image
        }
    }

    // Update database record
    $update_sql = "UPDATE students SET name='$name', address='$address', phone='$phone', imagepath='$final_image_path' WHERE std_id='$sn'";
    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: view.php?msg=Updated successfully");
        exit();
    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>

    <h2>Edit Student Details</h2>
    <form action="?id=edit.php" method="POST" enctype="multipart/form-data">
        <!-- Hidden inputs to track SN and old image -->
        <input type="hidden" name="sn" value="<?php echo $student['std_id']; ?>">
        <input type="hidden" name="old_imagepath" value="<?php echo $student['imagepath']; ?>">

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo $student['address']; ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required><br><br>

        <label>Current Image:</label><br>
        <img src="<?php echo $student['imagepath']; ?>" width="100"><br><br>

        <label>Upload New Image (Leave empty to keep current):</label><br>
        <input type="file" name="student_image" accept="image/*"><br><br>

        <button type="submit" name="update">Update Student</button>
        <a href="view.php">Cancel</a>
    </form>

</body>
</html>
