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
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
<?php
if(isset($_POST['submit']))
        {
            $name=$_POST['std_name'];
            $add=$_POST['std_add'];
            $phone=$_POST['std_phone'];
            //echo $name, $add, $phone;
            //$sql="INSERT INTO students(name, address, phone) VALUES('$name', '$add', '$phone')";
            $sql="UPDATE students SET name='$name', address='$add', phone='$phone' WHERE std_id=$sid";
            //echo $sql;
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
?>
</div>