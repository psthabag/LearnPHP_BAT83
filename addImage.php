<title>Add Image</title>
<?php
include('connect.php');
?>
<div class="mx-auto">
<form method="POST" action="#" enctype="multipart/form-data">
    <h1>Add Image</h1>
    <label class="form-label">Title</label>
    <input type="text" name="img_title" class="form-control" required>
    <label class="form-label mt-2">Description</label>
    <textarea name="img_desc" class="form-control" required></textarea>
    <label class="form-label mt-2">Category</label>
    <select class="form-control" name="img_cat">
        <option value="Landscape">Landscape</option>
        <option value="Protrait">Potrait</option>
    </select>
    <label class="form-label mt-2">Image</label>
    <img id="imagePreview" width="100px" class="d-block mb-2 rounded"/>
    <input id="imageInput" type="file" name="gal_image" class="form-control" accept="image/*" required>
    <input type="submit" name="submit" class="btn btn-primary mt-3">
</form>
<?php
if(isset($_POST['submit']))
        {
            $title=$_POST['img_title'];
            $desc=$_POST['img_desc'];
            $cate=$_POST['img_cat'];
            $image=$_FILES['gal_image']['name'];

            if($image!="")
            {
                $target_dir = "images/gallery/";
                $file_name = time()."_".basename($_FILES["gal_image"]["name"]); 
                $target_file_path = $target_dir . $file_name;

                if (move_uploaded_file($_FILES["gal_image"]["tmp_name"], $target_file_path))
                {
                $sql="INSERT INTO gallery(img_title, img_desc, img_category, imagepath) VALUES('$title', '$desc', '$cate','$target_file_path')";
                //echo $sql;
                $res=mysqli_query($conn,$sql);
                if($res)
                    {
                        echo "<div class='alert alert-success'>Image successfully inserted.</div>";
                        header("Refresh:1; url=index.php?id=gallery.php");
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