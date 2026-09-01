<title>Student Detail</title>
<?php
include('connect.php');
if(isset($_GET['sid']))
    {
        $sid=$_GET['sid'];
        $sql_Single="SELECT * FROM students WHERE std_id=$sid";
        $res_Single=mysqli_query($conn, $sql_Single);
        $row_Single=mysqli_fetch_assoc($res_Single);

        $sName=$row_Single['name'];
        $sAdd=$row_Single['address'];
        $sPh=$row_Single['phone'];
        $sImg=$row_Single['imagepath'];
    }

?>
<div class="mx-auto">
<body class="bg-light">

<div class="container py-5">
    <!-- Page Header & Navigation Link -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Profile</h1>
        <a href="?id=students.php" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row g-4">
        <!-- Left Column: Profile Card -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body pt-5">
                    <!-- Profile Picture Placeholder -->
                    <div class="mb-4">
                        <img src="<?php echo $sImg; ?>" 
                             alt="Student Profile Picture" 
                             class="rounded-circle img-thumbnail shadow-sm" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    
                    <h3 class="card-title fw-bold text-dark mb-1"><?php echo $sName;?></h3>
                    <p class="text-muted mb-3">
                        <?php
                            if($sid<10)
                                {
                                    echo "KCP-100";
                                }
                            elseif($sid<100)
                                {
                                    echo "KCP-10";
                                }
                            elseif($sid<1000)
                                {
                                    echo "KCP-1";
                                }
                            echo $sid;
                        ?>
                    </p>
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">Active</span>
                </div>
                <div class="card-footer bg-transparent border-0 pb-4">
                    <div class="d-grid gap-2 mx-auto" style="max-width: 200px;">
                        <a class="btn btn-primary" type="button" href="?id=editStudent.php&sid=<?php echo $sid;?>">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Information Tabs & Detailed Lists -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <ul class="nav nav-tabs card-header-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-semibold" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Personal Details</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content" id="profileTabContent">
                        <!-- Personal Details Tab Content -->
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row g-4">
                                <!-- Name -->
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="p-2 bg-primary-subtle text-primary rounded-3 me-3">
                                            <i class="bi bi-person fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Full Name</small>
                                            <span class="fs-6 fw-medium text-dark">
                                                <?php echo $sName;?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="p-2 bg-success-subtle text-success rounded-3 me-3">
                                            <i class="bi bi-telephone fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Phone Number</small>
                                            <span class="fs-6 fw-medium text-dark">
                                                <?php echo $sPh;?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="p-2 bg-info-subtle text-info rounded-3 me-3">
                                            <i class="bi bi-envelope fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Email Address</small>
                                            <span class="fs-6 fw-medium text-dark">
                                                email@university.edu
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Primary Address -->
                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        <div class="p-2 bg-warning-subtle text-warning rounded-3 me-3">
                                            <i class="bi bi-geo-alt fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Residential Address</small>
                                            <span class="fs-6 fw-medium text-dark">
                                                <?php echo $sAdd;?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://jsdelivr.net"></script>
</div>