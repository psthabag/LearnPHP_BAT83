<?php session_start();
if(isset($_SESSION['user']))
  {
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/style.css">
<link rel="icon" href="images/icon.png" type="image/icon type">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  .navbar{
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
  }
  .bi{
    font-size:12pt;
  }
</style>
<?php
include('menu.php');
?>
<div class="container" style="margin-top:85px;margin-bottom:65px;">
<?php
if(isset($_GET['id']))
{
    $page=$_GET['id'];
}
else
{
    $page='home.php';
}
include($page);
?>
</div>
<?php
include('footer.php');
  }
  else
    {
      header("Location:login.php");
    }
?>