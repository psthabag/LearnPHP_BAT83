<?php
$txt_file = 'pages/authors/authors.txt';
$upload_dir = 'uploads/author/';

$line_id = isset($_GET['line_id']) ? (int) $_GET['line_id'] : -1;
if ($line_id < 0 || !file_exists($txt_file)) {
    http_response_code(404);
    die('Author not found.');
}
$authors = file(
    $txt_file,
    FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
);

if (!isset($authors[$line_id])) {
    http_response_code(404);
    die('Author not found.');
}

$line = $authors[$line_id];

$data = explode("||", $line);

// ------------------------------------------------------------
// Author data
// ------------------------------------------------------------
$name    = trim($data[0]);
$country = trim($data[1]);
$dob     = trim($data[2]);
$death   = trim($data[3]);
$genre   = trim($data[4]);
$bio     = trim($data[5]);
$photo   = trim($data[6]);

$safe_name    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$safe_country = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
$safe_genre   = htmlspecialchars($genre, ENT_QUOTES, 'UTF-8');

// ------------------------------------------------------------
// Format dates
// ------------------------------------------------------------
$dob_timestamp = strtotime($dob);

if ($dob_timestamp !== false) {
    $formatted_dob = date('F j, Y', $dob_timestamp);
} else {
    $formatted_dob = !empty($dob) ? htmlspecialchars($dob) : 'Unknown';
}

if (strcasecmp($death, 'Present') === 0) {

    $formatted_death = 'Present';

} elseif (!empty($death) && strtotime($death) !== false) {

    $formatted_death = date('F j, Y', strtotime($death));

} else {

    $formatted_death = 'Unknown';
}

// ------------------------------------------------------------
// Calculate age
// ------------------------------------------------------------
$age_text = 'Not available';

if ($dob_timestamp !== false) {

    if (strcasecmp($death, 'Present') === 0) {

        $birth_date = new DateTime($dob);
        $today = new DateTime();

        $age_text = $birth_date->diff($today)->y . ' years';

    } elseif (!empty($death) && strtotime($death) !== false) {

        $birth_date = new DateTime($dob);
        $death_date = new DateTime($death);

        $age_text = $birth_date->diff($death_date)->y . ' years';
    }
}

// ------------------------------------------------------------
// Photo
// ------------------------------------------------------------
if (!empty($photo) && file_exists($upload_dir . $photo)) {
    $image_src = $upload_dir . $photo;
} else {
    $image_src = 'https://placehold.co/600x750/e9ecef/6c757d?text=No+Photo';
}

$image_src = htmlspecialchars(
    $image_src,
    ENT_QUOTES,
    'UTF-8'
);

// ------------------------------------------------------------
// URLs
// ------------------------------------------------------------
$edit_url =
    'index.php?id=pages/authors/edit_author.php&line_id=' .
    urlencode($line_id);

$delete_url =
    'index.php?id=pages/authors/delete_author.php&line_id=' .
    urlencode($line_id);

?>
<head>
    <title>
        <?php echo $safe_name; ?> - Author Details
    </title>
</head>

<div class="container py-4 py-md-5">

    <!-- =====================================================
         BACK BUTTON
    ====================================================== -->

    <div class="mb-4">

        <a
            href="javascript:history.back()"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back to Authors
        </a>

    </div>


    <!-- =====================================================
         MAIN AUTHOR CARD
    ====================================================== -->

    <div class="card border-0 shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-primary bg-gradient text-white">

            <div class="container-fluid py-5">

                <div class="row align-items-center">

                    <!-- Author Photo -->
                    <div class="col-md-4 col-lg-3 text-center mb-4 mb-md-0">

                        <img
                            src="<?php echo $image_src; ?>"
                            alt="<?php echo $safe_name; ?>"
                            class="img-fluid rounded-4 shadow border border-4 border-white"
                            style="max-height: 320px;"
                        >

                    </div>


                    <!-- Author Main Information -->
                    <div class="col-md-8 col-lg-9">

                        <div class="text-center text-md-start">

                            <span class="badge bg-light text-primary rounded-pill px-3 py-2 mb-3">
                                <i class="bi bi-book me-1"></i>
                                <?php echo $safe_genre; ?>
                            </span>

                            <h1 class="display-5 fw-bold mb-3">
                                <?php echo $safe_name; ?>
                            </h1>

                            <p class="fs-5 mb-0 opacity-75">

                                <i class="bi bi-geo-alt-fill me-1"></i>

                                <?php echo $safe_country; ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             AUTHOR INFORMATION
        ================================================== -->

        <div class="card-body p-4 p-md-5">

            <div class="row g-4">


                <!-- Country -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card h-100 border-0 bg-light">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">

                                    <i class="bi bi-geo-alt fs-4"></i>

                                </div>

                            </div>

                            <small class="text-uppercase text-muted fw-bold">
                                Country
                            </small>

                            <h5 class="fw-bold mt-1 mb-0">
                                <?php echo $safe_country; ?>
                            </h5>

                        </div>

                    </div>

                </div>


                <!-- Date of Birth -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card h-100 border-0 bg-light">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">

                                    <i class="bi bi-calendar-event fs-4"></i>

                                </div>

                            </div>

                            <small class="text-uppercase text-muted fw-bold">
                                Born
                            </small>

                            <h5 class="fw-bold mt-1 mb-0">
                                <?php echo $formatted_dob; ?>
                            </h5>

                        </div>

                    </div>

                </div>


                <!-- Date of Death -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card h-100 border-0 bg-light">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">

                                    <i class="bi bi-calendar-x fs-4"></i>

                                </div>

                            </div>

                            <small class="text-uppercase text-muted fw-bold">
                                Death
                            </small>

                            <h5 class="fw-bold mt-1 mb-0">
                                <?php echo $formatted_death; ?>
                            </h5>

                        </div>

                    </div>

                </div>


                <!-- Age -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card h-100 border-0 bg-light">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">

                                    <i class="bi bi-hourglass-split fs-4"></i>

                                </div>

                            </div>

                            <small class="text-uppercase text-muted fw-bold">
                                Age / Lifespan
                            </small>

                            <h5 class="fw-bold mt-1 mb-0">
                                <?php echo $age_text; ?>
                            </h5>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 BIOGRAPHY
            ================================================== -->

            <div class="card border-0 bg-light mt-5">

                <div class="card-body p-4 p-md-5">

                    <div class="d-flex align-items-center mb-4">

                        <div class="bg-primary text-white rounded-3 p-2 me-3">

                            <i class="bi bi-person-lines-fill fs-4"></i>

                        </div>

                        <div>

                            <h2 class="h3 fw-bold mb-1">
                                About <?php echo $safe_name; ?>
                            </h2>

                            <p class="text-muted mb-0">
                                Biography and background
                            </p>

                        </div>

                    </div>


                    <div class="fs-5 text-secondary lh-lg">

                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                $bio,
                                ENT_QUOTES,
                                'UTF-8'
                            )
                        );
                        ?>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 COMPLETE AUTHOR DETAILS
            ================================================== -->

            <div class="mt-5">
                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-info-circle-fill text-primary fs-3 me-3"></i>
                    <h2 class="h3 fw-bold mb-0">
                        Author Details
                    </h2>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 30%;">
                                    <i class="bi bi-person me-2 text-primary"></i>
                                    Full Name
                                </th>
                                <td class="fw-semibold">
                                    <?php echo $safe_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">
                                    <i class="bi bi-geo-alt me-2 text-primary"></i>
                                    Country
                                </th>
                                <td>
                                    <?php echo $safe_country; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">
                                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                                    Date of Birth
                                </th>
                                <td>
                                    <?php echo $formatted_dob; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">
                                    <i class="bi bi-calendar-x me-2 text-primary"></i>
                                    Date of Death
                                </th>
                                <td>
                                    <?php echo $formatted_death; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">
                                    <i class="bi bi-book me-2 text-primary"></i>
                                    Genre
                                </th>
                                <td>
                                    <span class="badge text-bg-primary rounded-pill px-3 py-2">
                                        <?php echo $safe_genre; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">
                                    <i class="bi bi-hourglass-split me-2 text-primary"></i>
                                    Age / Lifespan
                                </th>
                                <td>
                                    <?php echo $age_text; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- =================================================
                 ACTION BUTTONS
            ================================================== -->
            <div class="border-top mt-5 pt-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">
                    <!-- Back -->
                    <a
                        href="javascript:history.back()"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Authors
                    </a>

                    <!-- Actions -->
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a
                            href="<?php echo htmlspecialchars($edit_url, ENT_QUOTES, 'UTF-8'); ?>"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit Author
                        </a>
                        <a
                            href="<?php echo htmlspecialchars($delete_url, ENT_QUOTES, 'UTF-8'); ?>"
                            class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>?');"
                        >
                            <i class="bi bi-trash3 me-1"></i>
                            Delete Author
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
