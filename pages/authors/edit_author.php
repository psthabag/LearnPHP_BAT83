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
<?php
$filename = "pages/authors/authors.txt";
$upload_dir = 'uploads/author/';

// 1. Fetch current author data based on the line index
if (isset($_GET['line_id'])) {
    $line_id = (int)$_GET['line_id'];
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if (isset($lines[$line_id])) {
        $current_data = explode("||", $lines[$line_id]);
        $author_name = $current_data[0];
        $author_origin = $current_data[1];
        $author_dob=$current_data[2];
        $author_death=$current_data[3];
        $author_gerne=$current_data[4];
        $author_bio=$current_data[5];
        $author_img=$current_data[6];
    } else {
        die("Author row not found.");
    }
} else {
    die("No author selected.");
}

// 2. Process form submission and overwrite the text file
if (isset($_POST['update_author'])) {
    $line_id = (int)$_POST['line_id'];
    $author_id = trim($_POST['author_id']);
    // Strip out any accidental "||" characters user typed to prevent database corruption
    $new_name = str_replace("||", " ", trim($_POST['author_name'])); 

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Replace the specific line with updated data
    $lines[$line_id] = $author_id . "||" . $new_name;
    
    // Combine array elements back into a string with newlines and save
    file_put_contents($filename, implode("\n", $lines) . "\n");
    
    header("Location: author_list.php");
    exit();
}
?>
<div class="container">
    <h2>Edit Author</h2>
    <form action="edit_author.php?line_id=<?php echo $line_id; ?>" method="POST">
        <input type="hidden" name="line_id" value="<?php echo $line_id; ?>">
        <div class="form-grid">
            <div>
                <label>Author Full Name *</label>
                <input type="text" name="author_name" value="<?php echo $author_name; ?>" required>
            </div>
            <div>
                <label>Country of Origin *</label>
                <input type="text" name="country" value="<?php echo $author_origin; ?>" required>
            </div>
            <div>
                <label>Date of Birth *</label>
                <input type="date" name="dob" value="<?php echo $author_dob; ?>" required>
            </div>
            <div>
                <label>Date of Death (Leave blank if alive)</label>
                <input type="date" name="death" value="<?php echo $author_death; ?>">
            </div>
            <div class="full-width">
                <label>Primary Literary Genre *</label>
                <select name="genre" required>
                    <option value="<?php echo $author_gerne; ?>"><?php echo $author_gerne; ?></option>
                    
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
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Sci-Fi / Fantasy">Sci-Fi / Fantasy</option>
                        <option value="Mystery / Thriller">Mystery / Thriller</option>
                        <option value="Biography / History">Biography / History</option>
                        <option value="Poetry">Poetry</option>
                    </optgroup>
                </select>

            </div>
            <div class="full-width">
                <label>Author Biography *</label>
                <textarea name="author_bio" rows="4" required><?php echo $author_bio; ?></textarea>
            </div>
            <div class="full-width">
                <?php $img_file="uploads/author/$author_img"; ?>
                <img src="<?php echo $img_file; ?>" style="width:100px;border:1px solid rgba(128, 128, 128, 0.6);border-radius:8px;"/>
                <label>Profile Photo *</label>
                <input type="file" name="author_photo" accept="image/*" required>
            </div>
        </div>
        <button type="submit" name="update_author">Save Changes</button>
    </form>
</div>