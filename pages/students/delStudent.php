<title>Edit Student</title>
<?php
include('data/connect.php');
if(isset($_GET['sid']))
    {
        $sid=$_GET['sid'];
        $sqd="SELECT * FROM students WHERE std_id=$sid";
        $red=mysqli_query($conn, $sqd);
        $row=mysqli_fetch_assoc($red);
        $img=$row['imagepath'];
        if($img=="")
            {
                $sql="DELETE FROM students WHERE std_id=$sid";
                $res=mysqli_query($conn, $sql);
                if($res)
                    {
                        echo "<div class='alert alert-danger'>Data deleted successfully.</div>";
                        header("Refresh:1; url=index.php?id=students.php");
                        //header("Location:index.php?id=students.php");
                    }
                else
                    {
                        echo "<div class='alert alert-danger'>Error on data deletion.</div>";
                }
            }
        else
            {
            if(file_exists($img))
            {
                if(unlink($img))
                {
                $sql="DELETE FROM students WHERE std_id=$sid";
                $res=mysqli_query($conn, $sql);
                if($res)
                    {
                        echo "<div class='alert alert-danger'>Data deleted successfully.</div>";
                        header("Refresh:1; url=index.php?id=students.php");
                        //header("Location:index.php?id=students.php");
                    }
                else
                    {
                        echo "<div class='alert alert-danger'>Error on data deletion.</div>";
                }
                }
            }
            }
        }
?>
</div>