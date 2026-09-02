<?php
// Define file paths
$txt_file = 'pages/authors/authors.txt';
$upload_dir = 'uploads/author/';

// Create uploads directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// 1. HANDLE FORM SUBMISSION (WRITE EXPANDED DATA TO TXT FILE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_author'])) {
    $author_name = trim($_POST['author_name']);
    $country     = trim($_POST['country']);
    $dob         = trim($_POST['dob']);
    $death       = trim($_POST['death']);
    $genre       = trim($_POST['genre']);
    $author_bio  = trim($_POST['author_bio']);
    $photo_name  = 'default.jpg'; 

    // Handle File Upload
    if (isset($_FILES['author_photo']) && $_FILES['author_photo']['error'] === 0) {
        $file_ext = pathinfo($_FILES['author_photo']['name'], PATHINFO_EXTENSION);
        $photo_name = time() . '_' . uniqid() . '.' . $file_ext;
        $target_path = $upload_dir . $photo_name;
        move_uploaded_file($_FILES['author_photo']['tmp_name'], $target_path);
    }

    // Clean up bio text to prevent breaking our flat-file row system
    $author_bio = str_replace(["\r", "\n"], " ", $author_bio);
    
    // Fallback if author is still alive
    if (empty($death)) {
        $death = 'Present';
    }

    // Compile record using the "||" separator
    $data_line = implode("||", [
        $author_name,
        $country,
        $dob,
        $death,
        $genre,
        $author_bio,
        $photo_name
    ]) . PHP_EOL;

    // Save record securely
    file_put_contents($txt_file, $data_line, FILE_APPEND | LOCK_EX);
    
    header("Location: index.php?id=authors.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library System - Detailed Author Directory</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0px; background-color: #f0f2f5; color: #333; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-radius: 8px; }
        h2 { color: #1a1a1a; border-bottom: 2px solid #007bff; padding-bottom: 8px; margin-top: 10px; }
        h2:first-of-type { margin-top: 0; }
        
        /* Form Layout */
        form { background: #f8f9fa; padding: 20px; border-radius: 6px; border: 1px solid #e9ecef; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
        .full-width { grid-column: span 2; }
        label { font-weight: 600; font-size: 14px; display: block; margin-bottom: 5px; color: #495057; }
        input, textarea, select { padding: 10px; font-size: 14px; width: 100%; box-sizing: border-box; border: 1px solid #ced4da; border-radius: 4px; }
        input:focus, textarea:focus, select:focus { border-color: #007bff; outline: none; }
        button { background: #007bff; color: white; padding: 12px; border: none; cursor: pointer; font-size: 16px; font-weight: bold; border-radius: 4px; width: 100%; margin-top: 10px; }
        button:hover { background: #0056b3; }
        
        /* Author Card Layout */
        .author-card { display: flex; gap: 25px; border: 1px solid #e9ecef; padding: 20px; margin-bottom: 20px; background: #fff; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .photo-wrapper { flex-shrink: 0; text-align: center; }
        .author-photo { width: 120px; height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; }
        .author-info { flex-grow: 1; }
        .author-info h3 { margin: 0 0 10px 0; color: #007bff; font-size: 22px; }
        
        /* Metadata Badges */
        .meta-container { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 12px; }
        .badge { background: #e9ecef; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; color: #495057; }
        .badge-genre { background: #e7f5ff; color: #007bff; }
        
        .bio-text { line-height: 1.6; color: #4a4a4a; margin: 0; font-size: 14px; }
    </style>
</head>
<body>

<div class="container">
    <h2>New Author</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
            <div>
                <label>Author Full Name *</label>
                <input type="text" name="author_name" placeholder="e.g., George Orwell" required>
            </div>
            <div>
                <label>Country of Origin *</label>
                <input type="text" name="country" placeholder="e.g., United Kingdom" required>
            </div>
            <div>
                <label>Date of Birth *</label>
                <input type="date" name="dob" required>
            </div>
            <div>
                <label>Date of Death (Leave blank if alive)</label>
                <input type="date" name="death">
            </div>
            <div class="full-width">
                <label>Primary Literary Genre *</label>
                <select name="genre" required>
                    <option value="">-- Select Genre --</option>
                    
                    <!-- Academic & Educational Textbooks -->
                    <optgroup label="Educational & Textbooks">
                        <option value="Textbook: Science">Science (Physics, Chemistry, Bio)</option>
                        <option value="Textbook: Math">Mathematics</option>
                        <option value="Textbook: Statistics">Statistics & Data Science</option>
                        <option value="Textbook: Computer Science">Computer Science & IT</option>
                        <option value="Textbook: Engineering">Engineering & Technology</option>
                        <option value="Textbook: Medical">Medical & Health Sciences</option>
                        <option value="Textbook: Economics">Economics & Finance</option>
                        <option value="Textbook: Law">Law & Legal Studies</option>
                    </optgroup>

                    <!-- General Literature -->
                    <optgroup label="General Literature">
                        <option value="Fiction">General Fiction</option>
                        <option value="Non-Fiction">General Non-Fiction</option>
                        <option value="Sci-Fi / Fantasy">Sci-Fi / Fantasy</option>
                        <option value="Mystery / Thriller">Mystery / Thriller</option>
                        <option value="Biography / History">Biography / History</option>
                        <option value="Poetry">Poetry</option>
                    </optgroup>
                </select>

            </div>
            <div class="full-width">
                <label>Author Biography *</label>
                <textarea name="author_bio" placeholder="Write a short summary of the author's lifetime and prominent works..." rows="4" required></textarea>
            </div>
            <div class="full-width">
                <label>Author Profile Photo *</label>
                <input type="file" name="author_photo" accept="image/*" required>
            </div>
        </div>
        <button type="submit" name="add_author">Add Author Profile</button>
    </form>
</div>

</body>
</html>
