<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
</head>
<body>

    <h2>Insert New Student</h2>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>

        <label>Student Image:</label><br>
        <input type="file" name="student_image" accept="image/*" required><br><br>

        <button type="submit" name="submit">Save Student</button>
    </form>

</body>
</html>
