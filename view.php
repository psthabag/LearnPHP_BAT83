<?php
// Include your existing database connection file here
include 'connect.php'; 

// --- HANDLE DELETE LOGIC ---
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // First, find the image path to delete the physical file from the server
    $img_query = mysqli_query($conn, "SELECT imagepath FROM students WHERE std_id = '$delete_id'");
    $row = mysqli_fetch_assoc($img_query);
    
    if ($row) {
        $image_to_delete = $row['imagepath'];
        if (file_exists($image_to_delete)) {
            unlink($image_to_delete); // Deletes file from "uploads/" folder
        }
    }

    // Delete record from database
    $delete_sql = "DELETE FROM students WHERE std_id = '$delete_id'";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: view.php?msg=Deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Fetch all students to display
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY std_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Students</title>
</head>
<body>

    <h2>Student Records</h2>
    <a href="index.php">Add New Student</a><br><br>

    <?php if (isset($_GET['msg'])) { echo "<p style='color:green;'>".$_GET['msg']."</p>"; } ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>SN</th>
            <th>Image</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['std_id']; ?></td>
            <td><img src="<?php echo $row['imagepath']; ?>" width="60" alt="Student Image"></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <a href="?id=edit.php?sn=<?php echo $row['std_id']; ?>">Edit</a> | 
                <a href="?id=view.php?delete_id=<?php echo $row['std_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>