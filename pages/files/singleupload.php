<div class='rds'>
<h1>PHP File uploading</h1>
<?php
    $target_file="";
    $tmp_file="";
    $dir_img="images/";
    if(!file_exists($dir_img))
    {
        mkdir($dir_img);
    }
    //After submitting the form with file.
    if(isset($_POST['save']))
    {
        $target_img=$dir_img.$_FILES["filetoUpload"]["name"];
        $tmp_file=$_FILES["filetoUpload"]["tmp_name"];
        $file_name=$_FILES["filetoUpload"]["name"];
        $file_type=$_FILES["filetoUpload"]["type"];
        if($file_type=='image/jpeg'||$file_type=='image/jpg'||$file_type=='image/png'||$file_type=='application/pdf')
        {
            if(move_uploaded_file($tmp_file,$target_img))
            {
                echo "<div class='alert alert-primary' role='alert'>";
                echo "Image successfully uploaded.";
                echo "</div>"; 
            }
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "File type doesn't matched.";
            echo "</div>"; 
        }
    }
?>
<form method="POST" action="#" enctype="multipart/form-data">
    <div class="mb-3">
        <input class="form-control" type="file" id="formFile" name="filetoUpload" required>
    </div>
    <input type="submit" name="save" value="Upload" class="btn btn-primary">
</form>
<br><br>
</div>