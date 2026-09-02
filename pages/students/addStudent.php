<title>Add Student</title>
<?php
include('data/connect.php');
?>
<div class="mx-auto">
<form method="POST" action="#" enctype="multipart/form-data">
    <h1>Add Student</h1>
    <label class="form-label">Name</label>
    <input type="text" name="std_name" class="form-control" required>
    <label class="form-label mt-2">Address</label>
    <input type="text" name="std_add" class="form-control" required>
    <label class="form-label mt-2">Phone</label>
    <input type="text" name="std_phone" class="form-control" required>
    <label class="form-label mt-2">Image</label>
    <input type="file" name="student_image" class="form-control" accept="image/*">
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
<?php
if(isset($_POST['submit']))
        {
            $name=$_POST['std_name'];
            $add=$_POST['std_add'];
            $phone=$_POST['std_phone'];
            $image=$_FILES['student_image']['name'];

            if($image!="")
            {
                $target_dir = "uploads/";
                $file_name = time()."_".basename($_FILES["student_image"]["name"]); 
                $target_file_path = $target_dir . $file_name;

                if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $target_file_path))
                {
                $sql="INSERT INTO students(name, address, phone, imagepath) VALUES('$name', '$add', '$phone','$target_file_path')";
                //echo $sql;
                $res=mysqli_query($conn,$sql);
                if($res)
                    {
                        echo "<div class='alert alert-success'>Data successfully inserted.</div>";
                        header("Refresh:1; url=index.php?id=students.php");
                        //header("Location:index.php?id=students.php");
                    }
                else
                    {
                        echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                    }
                }
                else
                {
                    echo "Error: Failed to upload the image file to the server folder.";
                }
            }
            else
            {
                $sql="INSERT INTO students(name, address, phone) VALUES('$name', '$add', '$phone')";
                //echo $sql;
                $res=mysqli_query($conn,$sql);
                if($res)
                    {
                        echo "<div class='alert alert-success'>Data successfully inserted.</div>";
                        header("Refresh:1; url=index.php?id=students.php");
                        //header("Location:index.php?id=students.php");
                    }
                else
                    {
                        echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                    }
            }
        }
?>
</div>