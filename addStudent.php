<title>Add Student</title>
<?php
include('connect.php');
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
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
<?php
if(isset($_POST['submit']))
        {
            $name=$_POST['std_name'];
            $add=$_POST['std_add'];
            $phone=$_POST['std_phone'];
            //echo $name, $add, $phone;
            $sql="INSERT INTO students(name, address, phone) VALUES('$name', '$add', '$phone')";
            //echo $sql;
            $res=mysqli_query($conn,$sql);
            if($res)
                {
                    echo "<div class='alert alert-success'>Data successfully inserted.</div>";
                    header("Refresh:3; url=index.php?id=students.php");
                    //header("Location:index.php?id=students.php");
                }
            else
                {
                    echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                }
        }
?>
</div>