<title>Edit Student</title>
<?php
include('data/connect.php');
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
        <h1 class="h3 mb-0 text-gray-800">Edit Student Profile</h1>
    </div>

    <?php
    if(isset($_POST['submit']))
            {
                $name=$_POST['std_name'];
                $add=$_POST['std_add'];
                $phone=$_POST['std_phone'];
                $image=$_FILES['student_image']['name'];
                if($image=="")
                    {
                        $sql="UPDATE students SET name='$name', address='$add', phone='$phone' WHERE std_id=$sid";
                        $res=mysqli_query($conn,$sql);
                        if($res)
                            {
                                echo "<div class='alert alert-success'>Data successfully updated.</div>";
                                //header("Refresh:2; url=index.php?id=students.php");
                                header("Location:index.php?id=pages/students/students.php");
                            }
                        else
                            {
                                echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                            }
                    }
                else
                    {
                        $target_dir = "uploads/";
                        $file_name = time()."_".basename($_FILES["student_image"]["name"]); 
                        $target_file_path = $target_dir . $file_name;

                        if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $target_file_path))
                        {
                            $sql="UPDATE students SET name='$name', address='$add', phone='$phone', imagepath='$target_file_path' WHERE std_id=$sid";

                            $res=mysqli_query($conn,$sql);
                            if($res)
                                {
                                    echo "<div class='alert alert-success'>Data successfully updated.</div>";
                                    header("Refresh:2; url=index.php?id=pages/students/students.php");
                                    //header("Location:index.php?id=students.php");
                                    exit();
                                }
                            else
                                {
                                    echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                                }
                        }
                    }
            }
    ?>

    <form method="POST" class="needs-validation" action="#" enctype="multipart/form-data" novalidate>
        <div class="row g-4">
            <!-- Left Column: Profile Picture Management -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body pt-5">
                        <!-- Current Profile Picture -->
                        <div class="mb-4 position-relative d-inline-block">
                            <img src="<?php echo $sImg;?>"
                                 alt="Student Profile Picture"
                                 id="imagePreview" 
                                 class="rounded-circle img-thumbnail shadow-sm" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <label for="profilePicInput" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle p-2 shadow" style="transform: translate(-10%, -10%); cursor: pointer;" title="Change Photo">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                        
                        <!-- Hidden File Input for Picture Upload -->
                        <div class="mx-auto" style="max-width: 250px;">
                            <input class="form-control form-control-sm d-none" type="file" id="profilePicInput" name="student_image" accept="image/*">
                            <p class="small text-muted mb-1">Click the camera icon to change picture</p>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-3">Active Status</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Edit Details Form Fields -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <span class="nav-link active fw-semibold text-primary">Modify Information</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <!-- Student ID (Read Only) -->
                            <div class="col-md-6">
                                <label for="studentId" class="form-label small text-uppercase text-muted fw-bold">Student ID</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="text" class="form-control bg-light text-muted" id="studentId" value="<?php
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
                                " readonly>
                                </div>
                            </div>

                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label for="fullName" class="form-label small text-uppercase text-muted fw-bold">Full Name</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="bi bi-person text-primary"></i></span>
                                    <input type="text" class="form-control" name="std_name" id="fullName" value="<?php echo $sName;?>" required>
                                    <div class="invalid-feedback">Please enter the student's name.</div>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="phoneNumber" class="form-label small text-uppercase text-muted fw-bold">Phone Number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="bi bi-telephone text-success"></i></span>
                                    <input type="tel" class="form-control" id="phoneNumber" name="std_phone" value="<?php echo $sPh;?>" required>
                                    <div class="invalid-feedback">Please enter a valid phone number.</div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6">
                                <label for="emailAddress" class="form-label small text-uppercase text-muted fw-bold">Email Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope text-info"></i></span>
                                    <input type="email" class="form-control" id="emailAddress" name="std_mail" value="email.doe@university.edu" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>

                            <!-- Residential Address -->
                            <div class="col-12">
                                <label for="residentialAddress" class="form-label small text-uppercase text-muted fw-bold">Residential Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="bi bi-geo-alt text-warning"></i></span>
                                    <textarea class="form-control" name="std_add" id="residentialAddress" rows="3" required><?php echo $sAdd;?></textarea>
                                    <div class="invalid-feedback">Please enter the current residential address.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions Footer -->
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2 p-4 pt-0">
                        <a href="?id=students.php" class="btn btn-outline-secondary px-4">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-primary px-4" value="Save Changes">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</div>

<script>
document.getElementById('profilePicInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    
    if (file) {
        // Create a temporary local URL for the selected file
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Update the src of the image element
            document.getElementById('imagePreview').src = e.target.result;
        }
        
        // Read the local file as a data URL
        reader.readAsDataURL(file);
    }
});
</script>