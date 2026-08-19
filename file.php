<div class='rds'>
<h1>PHP File handling</h1>
<?php
if(isset($_POST['save']))
    {
        $txt=$_POST['text'];
        if(!empty($txt))
        {
        if(isset($_POST['mode']))
        {
            $md=$_POST['mode'];
        }
        else
        {
            $md='r';
        }
        $file=fopen("Example.txt",$md);
        fwrite($file, $txt);
        fclose($file);
        }
    }
?>
<form method="POST" action="#">
<textarea name="text" class="form-control" id="t1" rows="2"></textarea><br>
<?php
    $fname="Example.txt";
    if(file_exists($fname))
    {
        $file=fopen($fname,'r');
        // while(!feof($file)) 
        // {
        //     echo fgetc($file);
        // }
        // fclose($file);
        echo fread($file, filesize($fname));

    }
?>
<br><br>
  <input type="radio" name="mode" value="r"> Read Only = 'r'<br>
  <input type="radio" name="mode" value="r+"> Read/Write = 'r+'<br>
  <input type="radio" name="mode" value="w"> Write only = 'w'<br>
  <input type="radio" name="mode" value="w+"> Read/Write = 'w+'<br>
  <input type="radio" name="mode" value="a"> Append write mode = 'a'<br>
  <input type="radio" name="mode" value="a+"> Read and Append = 'a+'<br><br/>
<input type="submit" name="save" class="btn btn-primary">
</form>

<?php
    $fname="Example.txt";
    if(file_exists($fname))
    {
        $file=fopen($fname,'r');
        // $content = fread($file, filesize($fname));
        // echo $content."<br/>";

        // while(!feof($file))
        //   {
        //    $line = fgets($file);
        //    echo $line;
        //   }
        fclose($file);

        echo "<br/>File Size: ".filesize($fname);
        echo "<br/>File Type: ".filetype($fname);
        echo "<br/>File Name: ".pathinfo($fname,PATHINFO_BASENAME);
        echo "<br/>File Extension: ".pathinfo($fname,PATHINFO_EXTENSION);
        echo "<br/>Real Path: ".realpath($fname);

    }
?>

</div>