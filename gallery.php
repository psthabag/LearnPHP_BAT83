<?php
include('data/connect.php');
?>
<div>
    <h1>Gallery</h1>
<p>
    <a href="index.php?id=addImage.php" class="btn btn-primary mb-2">Add Image</a>
</p>

  <div class="container-fluid">
  <?php
    $sql="SELECT * FROM gallery";
    $res=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($res))
    {
      $img_id=$row[0];
      $img_title=$row[2];
      $img_desc=$row[3];
      $img_cate=$row[1];
      $img_loc=$row[4];

  ?>
    <div class="card float-start" style="width: 18rem;margin:5 5 5 5;">
      <img src="<?php echo $img_loc;?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $img_cate; ?></h5>
        <p class="card-text"><?php echo $img_title;?></p>
      </div>
    </div>
    <?php
      }
    ?>
  </div>
</div>