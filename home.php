<div class='rds'>
    <h1>Learn PHP</h1>
    <p>
    Learn the fundamentals of PHP, one of the most popular languages of modern web development. Includes PHP, PHP Basics, PHP and HTML, and more.
    </p>
    <?php
        /*
        $x=5; 
        $y=21;
        $sum =$x+$y;
        $mul =$x*$y;
        if(isset($_POST['submit']))
        {
            $name=$_POST['fname'];
            $class=$_POST['class'];
            echo "<h3>Name is : $name</h3>";
            echo "<h3>Class is : $class</h3>";
        }
        echo "<h2>The sum of two numbers is : ".$sum."</h2>";
        echo "<h2>The product of two numbers is : ".$mul."</h2>";
        */

        $name="Kanya Campus Pokhara";
        $phone=343434;

        echo "<h1>$name</h1>";
        echo "<h2>$phone</h2>";
    ?>

    <h2><?php echo $name?></h2>

    <?php
        $x=45;
        $y=34;
        $sum=$x+$y;
        $sub=$x-$y;
        $mul=$x*$y;
        $div=$x/$y;
        echo "<p>Sum : $sum</p>";
        echo "<p>Sub : $sub</p>";
        echo "<p>Mul : $mul</p>";
        echo "<p>Div : $div</p>";

        $file = "File.txt";
        if(file_exists($file))
            {
                echo "File Exists";
                $f=fopen($file,"a");
                $str="Hello we're learning file handling. ";
                fwrite($f, $str);
                fclose($f);
            }
        else
            {
                fopen($file,"a");
            }

    ?>
    <br/>
    <br/>
    <br/>
</div>