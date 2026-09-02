<div class='rds'>
<h1>PHP Folder handling</h1>

<?php
  $path="D:\ICT\BIM\\";
    if(isset($_POST['make']))
    {
        if($_POST['text']!="" && $_POST['text']!=" ")
        {
          $dir_name=$path.$_POST['text'];
          if(file_exists($dir_name))
          {
            echo "Directory already exists.";
          }
          else
          {
            if(mkdir($dir_name))
            {
              echo "Directory created successfully.";
            }
          }
        }
        else
        {
            echo "Please enter directory name.";
        }
    }

    if(isset($_POST['del']))
    {
        if($_POST['text']!="" && $_POST['text']!=" ")
        {
          $dir_name=$path.$_POST['text'];
          if(file_exists($dir_name))
          {
            if(rmdir($dir_name))
            {
              echo "Directory deleted successfully.";
            }
            else
            {
              echo "Unable to deleted because of security reason.";
            }
          }
          else
          {
            echo "Directory not exists.";
          }
        }
        else
        {
            echo "Please enter directory name.";
        }
    }

    if(isset($_POST['rname']))
    {
        if($_POST['text']!="" && $_POST['text']!=" ")
        {
          $file_name=$_POST['text'].".txt";
          if(file_exists($file_name))
          {
            echo "File already exists.";
          }
          else
          {
            if(rename("Example.txt", $file_name))
            {
              echo "File renamed successfully.";
            }
          }
        }
        else
        {
            echo "Please enter new file name.";
        }
    }


    if(isset($_POST['cpy']))
    {
        if($_POST['text']!="" && $_POST['text']!=" ")
        {
          $file_name=$path.$_POST['text'].".txt";
          if(file_exists($file_name))
          {
            echo "File already exists.";
          }
          else
          {
            if(copy("Example.txt", $file_name))
            {
              echo "File copied successfully.";
            }
          }
        }
        else
        {
            echo "Please enter new file name.";
        }
    }
?>

<form method="POST" action="#">

<textarea name="text" class="form-control" id="t1" rows="2">
</textarea>
<br>

<input type="submit" name="make" value="Make Folder" class="btn btn-primary">
<input type="submit" name="del" value="Remove Folder" class="btn btn-primary">

&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

<input type="submit" name="rname" value="Rename File" class="btn btn-primary">

<input type="submit" name="cpy" value="Copy File" class="btn btn-primary">
</form>

</div>

<div>
  <?php
    $server="localhost";
    $username="root";
    $password="";
    $db="info_ssr";

    $conn=mysqli_connect($server,$username,$password,$db);
    if(!$conn)
    {
        die("Connection failed: ". mysqli_connect_error());
    }

  ?>
</div>