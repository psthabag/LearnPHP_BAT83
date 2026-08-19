<?php
// Define file paths
$txt_file = 'authors.txt';
$upload_dir = 'uploads/author/';

// --- PAGINATION SETTINGS & LOGIC ---

// 1. Determine how many items to show per page (Default: 5)
$limit = 5; 
if (isset($_GET['limit'])) {
    $limit = ($_GET['limit'] === 'all') ? 'all' : (int)$_GET['limit'];
}

// 2. Get current page number (Default: page 1)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) { $current_page = 1; }

// 3. Load all authors from the text file into an array (Reversed for newest first)
$all_authors = [];
if (file_exists($txt_file)) {
    $raw_lines = file($txt_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $all_authors = array_reverse($raw_lines);
}

$total_authors = count($all_authors);

// 4. Calculate pagination metrics based on limit selection
if ($limit === 'all' || $total_authors === 0) {
    $per_page = $total_authors;
    $total_pages = 1;
    $current_page = 1;
    $start_index = 0;
} else {
    $per_page = in_array($limit, [5, 10, 15]) ? $limit : 5;
    $total_pages = ceil($total_authors / $per_page);
    
    // Adjust page bounds
    if ($current_page > $total_pages) { $current_page = $total_pages; }
    
    $start_index = ($current_page - 1) * $per_page;
}

// 5. Slice the array to get only the authors for this specific page
$displayed_authors = array_slice($all_authors, $start_index, $per_page);

?>
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

<div class="container">
    <h2>Author List</h2>
    <!-- Limit Selection Controller Bar -->
    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 10px; border-radius: 4px; border: 1px solid #e9ecef;">
        <div>Showing <strong><?php echo count($displayed_authors); ?></strong> of <strong><?php echo $total_authors; ?></strong> Authors</div>
        <form method="GET" action="" style="margin: 0; padding: 0; background: none; border: none; display: inline-flex; align-items: center; gap: 8px; width: auto;">
            <input type="hidden" name="id" value="authors.php">
            <input type="hidden" name="page" value="1">
            <label for="limit" style="margin: 0; font-weight: normal;">Authors per page:</label>
            <select name="limit" id="limit" onchange="this.form.submit()" style="width: auto; padding: 5px 10px;">
                <option value="5" <?php echo ($limit == 5) ? 'selected' : ''; ?>>5</option>
                <option value="10" <?php echo ($limit == 10) ? 'selected' : ''; ?>>10</option>
                <option value="15" <?php echo ($limit == 15) ? 'selected' : ''; ?>>15</option>
                <option value="all" <?php echo ($limit === 'all') ? 'selected' : ''; ?>>All</option>
            </select>
        </form>
    </div>

    <div class="author-list">
        <?php
        if (file_exists($txt_file)) {
            $authors = file($txt_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!empty($displayed_authors)) {
                foreach ($displayed_authors as $line) {

                    //Find the exact line number in the original TXT file
                    $line_id = array_search($line, $authors, true);

                    $data = explode("||", $line);
                    if (count($data) < 7) continue;

                    $name    = htmlspecialchars($data[0]);
                    $country = htmlspecialchars($data[1]);
                    $dob     = htmlspecialchars($data[2]);
                    $death   = htmlspecialchars($data[3]);
                    $genre   = htmlspecialchars($data[4]);
                    $bio     = htmlspecialchars($data[5]);
                    $photo   = htmlspecialchars($data[6]);
                    
                    $image_src = (file_exists($upload_dir . $photo)) ? $upload_dir . $photo : 'https://placeholder.com';
                    
                    // Format dates cleanly for display
                    $formatted_dob = date("M d, Y", strtotime($dob));
                    $formatted_death = ($death === 'Present') ? 'Present' : date("M d, Y", strtotime($death));

                    echo '<div class="author-card">';
                    echo '  <div class="photo-wrapper">';
                    echo '      <img src="' . $image_src . '" class="author-photo" alt="' . $name . '">';
                    echo '  </div>';
                    echo '  <div class="author-info">';
                    echo '      <h3>' . $name . '</h3>';
                    echo '      <div class="meta-container">';
                    echo '          <span class="badge">📍 ' . $country . '</span>';
                    echo '          <span class="badge">📅 ' . $formatted_dob . ' to ' . $formatted_death . '</span>';
                    echo '          <span class="badge badge-genre">📚 ' . $genre . '</span>';
                    echo '      </div>';
                    echo '      <p class="bio-text">' . $bio . '</p>';
                    $name = htmlspecialchars($data[0]);
                    echo '      <!-- NEW: Action Button Section Inside Card -->';
                    echo '      <div class="card-actions" style="margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">';
                    echo '          <a href="index.php?id=author_detail.php&line_id=' . $line_id . '" class="btn-edit" style="color: #007b00; text-decoration: none; margin-right: 15px; font-weight: bold;">ℹ️ Detail</a>';
                    echo '          <a href="index.php?id=edit_author.php&line_id=' . $line_id . '" class="btn-edit" style="color: #007bff; text-decoration: none; margin-right: 15px; font-weight: bold;">✏️ Edit</a>';
                    echo '          <a href="index.php?id=delete_author.php&line_id=' . $line_id . '" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete ' . addslashes($name) . '?\');" style="color: #dc3545; text-decoration: none; font-weight: bold;">🗑️ Delete</a>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';

                }
            } else {
                echo '<p>No author entries registered.</p>';
            }
        } else {
            echo '<p>No author records found.</p>';
        }
        ?>
    </div>
    <!-- Pagination Navigation Controls Links -->
    <?php if ($total_pages > 1): ?>
        <div style="display: flex; justify-content: center; gap: 5px; margin-top: 25px; padding-bottom: 20px;">
            
            <!-- Previous Button -->
            <?php if ($current_page > 1): ?>
                <a href="?id=authors.php&page=<?php echo $current_page - 1; ?>&limit=<?php echo $limit; ?>" style="padding: 8px 12px; background: #fff; border: 1px solid #ced4da; text-decoration: none; color: #007bff; border-radius: 4px;">&laquo; Prev</a>
            <?php endif; ?>

            <!-- Numbered Page Links -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $current_page): ?>
                    <span style="padding: 8px 12px; background: #007bff; border: 1px solid #007bff; color: white; font-weight: bold; border-radius: 4px;"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?id=authors.php&page=<?php echo $i; ?>&limit=<?php echo $limit; ?>" style="padding: 8px 12px; background: #fff; border: 1px solid #ced4da; text-decoration: none; color: #007bff; border-radius: 4px;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Next Button -->
            <?php if ($current_page < $total_pages): ?>
                <a href="?id=authors.php&page=<?php echo $current_page + 1; ?>&limit=<?php echo $limit; ?>" style="padding: 8px 12px; background: #fff; border: 1px solid #ced4da; text-decoration: none; color: #007bff; border-radius: 4px;">Next &raquo;</a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>