<title>Add Student</title>
<?php
include('connect.php');
if(isset($_GET['s_id']))
    {
        $sid=$_GET['s_id'];
        $sql1="SELECT name, address, phone FROM students WHERE std_id=$sid";
        $res1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_array($res1);
        $name1=$row1[0];
        $add1=$row1[1];
        $ph1=$row1[2];
    }

?>
<div class="mx-auto">
<form method="POST" action="#" enctype="multipart/form-data">
    <h1>Add Student</h1>
    <input type="hidden" name="std_id" value="<?php echo $sid;?>">
    <label class="form-label">Name</label>
    <input type="text" name="std_name" class="form-control" value="<?php echo $name1;?>" required>
    <label class="form-label mt-2">Address</label>
    <input type="text" name="std_add" class="form-control" value="<?php echo $add1;?>" required>
    <label class="form-label mt-2">Phone</label>
    <input type="text" name="std_phone" class="form-control" value="<?php echo $ph1;?>" required>
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
<?php
if(isset($_POST['submit']))
        {
            $std_id=$_POST['std_id'];
            $name=$_POST['std_name'];
            $add=$_POST['std_add'];
            $phone=$_POST['std_phone'];
            //echo $name, $add, $phone;
            $sql="UPDATE students SET name='$name', address='$add', phone='$phone' WHERE std_id=$std_id";
            //echo $sql;
            $res=mysqli_query($conn,$sql);
            if($res)
                {
                    echo "<div class='alert alert-success'>Data successfully edited.</div>";
                    header("Refresh:2; url=index.php?id=students.php");
                }
            else
                {
                    echo "<div class='alert alert-danger'>Error on data insertion.</div>";
                }
        }
?>
</div>