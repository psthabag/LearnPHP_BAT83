<title>Edit Student</title>
<?php
include('connect.php');
if(isset($_GET['sid']))
    {
        $sid=$_GET['sid'];
        $sql="DELETE FROM students WHERE std_id=$sid";
        $res=mysqli_query($conn, $sql);
            if($res)
                {
                    echo "<div class='alert alert-danger'>Data deleted successfully.</div>";
                    header("Refresh:2; url=index.php?id=students.php");
                    //header("Location:index.php?id=students.php");
                }
            else
                {
                    echo "<div class='alert alert-danger'>Error on data deletion.</div>";
                }
        }
?>
</div>