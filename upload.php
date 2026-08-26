<div class='rds'>
<h1>PHP File uploading</h1>
<?php
    //Initialize the uploadOk as 1 means true or everything is fine to upload.
    $uploadOk=0;
    $target_file="";
    $tmp_file="";
    $data="data.txt";
    $file="file.txt";
    //The location to upload and save files
    $dir="files/";
    //The location to upload and save images
    $dir_img="images/";
    //Check the directory existance if not create the folder with proper name.
    if(!file_exists($dir))
    {
        mkdir($dir);
    }
    if(!file_exists($dir_img))
    {
        mkdir($dir_img);
    }
    //Make Data file for storing image data if not exist.
    if(!file_exists($data))
    {
        $fp=fopen($data,'a+');
        fclose($fp);
    }

    //Make File for storing text files if not exist.
    if(!file_exists($file))
    {
        $flp=fopen($file,'a+');
        fclose($flp);
    }

    //After submitting the form with file.
    if(isset($_POST['save']))
    {
        $target_file=$dir.$_FILES["filetoUpload"]["name"];      //target location with file name
        $target_img=$dir_img.$_FILES["filetoUpload"]["name"];   //target location with image name
        $tmp_file=$_FILES["filetoUpload"]["tmp_name"];          //temporary file name as source
        $file_name=$_FILES["filetoUpload"]["name"];
        $file_type=pathinfo($file_name,PATHINFO_EXTENSION);      //extension of file to check proper file type.
        $size=filesize($tmp_file);                              //file size of file for purpose of size limitation.
        
        //First check file size for limitation not more than 1MB.
        //5MB = 5*1024*1024 Bytes = 5242880 Bytes
        $size_limit = 5242880;
        if($size>=$size_limit)
        {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Size limit exceded, please upload file of lesser size";
            echo "</div>";
        }
        else
        {
            if($file_type=='txt' || $file_type=='pdf' ||$file_type=='docx' || $file_type=='xlsx' || $file_type=='pptx')
            {
                $uploadOk=1;
                // echo "<div class='alert alert-primary' role='alert'>";
                // echo "File type is document.$file_type";
                // echo "</div>";
            }

            elseif($file_type=='jpg' || $file_type=='png' ||$file_type=='jpeg' || $file_type=='gif' || $file_type=='pptx')
            {
                $uploadOk=2;
                // echo "<div class='alert alert-primary' role='alert'>";
                // echo "File type is image.";
                // echo "</div>";
            }
            else
            {
                //$uploadOk=0;
                echo "<div class='alert alert-danger' role='alert'>";
                echo "File type mismatched, please proper image or file type.";
                echo "</div>";
            }
        }
    }

    if($uploadOk==1)
    {
        if(file_exists($target_file))
        {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "File is already exists.";
            echo "</div>";
        }
        else
        {
            if(move_uploaded_file($tmp_file,$target_file))
            {
                $flp=fopen($file,'a+');
                fwrite($flp,"$target_file\n");
                fclose($flp);
                echo "<div class='alert alert-primary' role='alert'>";
                echo "File successfully uploaded.";
                echo "</div>"; 
                header("Location: index.php?id=download.php");
            }
        }
    }
    if($uploadOk==2)
    {
        if(file_exists($target_img))
        {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Image already exists.";
            echo "</div>";
        }
        else
        {
            if(move_uploaded_file($tmp_file,$target_img))
            {
                $fp=fopen($data,'a+');
                fwrite($fp,"\n$target_img");
                fclose($fp);
                echo "<div class='alert alert-primary' role='alert'>";
                echo "Image successfully uploaded.";
                echo "</div>"; 
                header("Location: index.php?id=gallery.php");
            }
        }
    }

    //Display image in browser.
    if(isset($_FILES["filetoUpload"]) && $uploadOk == 2)
    {
        echo "<img src='$target_img' alt='Uploaded Image' height='150'><br><br>";
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