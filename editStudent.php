<title>Edit Student</title>
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
<form method="POST" action="#" enctype="multipart/form-data">
    <h1>Edit Student</h1>
    <label class="form-label">Name</label>
    <input type="text" name="std_name" class="form-control" value="<?php echo $sName;?>" required>
    <label class="form-label mt-2">Address</label>
    <input type="text" name="std_add" class="form-control" value="<?php echo $sAdd;?>" required>
    <label class="form-label mt-2">Phone</label>
    <input type="text" name="std_phone" class="form-control" value="<?php echo $sPh;?>" required>
    <label class="form-label mt-2">Image</label>
    <img id="imagePreview" src="<?php echo $sImg;?>" width="100px"/ class="d-block mb-2 rounded">
    <input id="imageInput" type="file" name="student_image" class="form-control" accept="image/*">
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
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
                            header("Location:index.php?id=students.php");
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
                                //header("Refresh:2; url=index.php?id=students.php");
                                header("Location:index.php?id=students.php");
                            }
                        else
                            {
                                echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                            }
                    }
                }
        }
?>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
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