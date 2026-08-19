<?php
$filename = "authors.txt";
$upload_dir = 'uploads/author/';
// 1. Check if the line ID index was sent via URL query parameters
if (isset($_GET['line_id'])) {
    // Cast to an integer for safety against injection attacks
    $line_id = (int)$_GET['line_id'];

    // Load all current entries as an array
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // 2. Check if the line array index exists before deleting
    if (isset($lines[$line_id])) {
        $current_data = explode("||", $lines[$line_id]);
        $profile=$current_data[6];
        // Delete the image file
        $img = $upload_dir."".$profile;
        unlink($img);
        // Drop the target array index entirely
        unset($lines[$line_id]);
        
        // 3. Re-index and rewrite remaining array rows to keep file sequence clean
        // implode adds clear break breaks between items; trailing \n avoids system overlap
        file_put_contents($filename, implode("\n", $lines) . "\n");
        
        // 4. Successful action redirection route 
        header("Location: index.php?id=authors.php");
        exit();
    } else {
        die("Error: The requested author row does not exist.");
    }
} else {
    die("Error: Invalid requests. No line identifier provided.");
}
?>