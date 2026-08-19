<?php
// process.php
require_once 'StudentManager.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Extract post variables securely
    $id    = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
    $name  = isset($_POST['name']) ? trim($_POST['name']) : '';
    $age   = isset($_POST['age']) ? (int)$_POST['age'] : 0;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

    // Validate entries are populated properly
    if (!empty($id) && !empty($name) && $age > 0 && !empty($phone)) {
        
        $manager = new StudentManager('students.txt');
        $isSaved = $manager->addStudent($id, $name, $age, $phone);

        if ($isSaved) {
            header("Location: student.php?status=success");
            exit();
        }
    }
    
    // Redirect with error tracking if something fails
    header("Location: student.php?status=error");
    exit();
} else {
    // Block direct page access URL hits
    header("Location: student.php");
    exit();
}
