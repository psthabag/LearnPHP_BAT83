<form method="POST" action="#">
    Keyword : 
    <input type="text" name="exp" class="form-control" required>
    <br/>
    <input type="submit" name="submit" class="btn btn-primary"> 
</form>
<?php
    $str="PHP is a widely used server-side scripting language designed for web development. It is especially popular for creating dynamic and interactive websites because it can process user input, interact with databases, manage sessions, and generate web pages in real time. PHP is open-source, easy to learn, and compatible with many operating systems and web servers. It is commonly used with databases such as MySQL to build applications like blogs, e-commerce websites, and content management systems. One of the main advantages of PHP is its simplicity and flexibility. It supports a large number of frameworks and tools that help developers create secure and efficient web applications more quickly. PHP also has a strong community that provides extensive documentation and support for learners and professionals. Because of its reliability, scalability, and continuous updates, PHP remains one of the most popular programming languages for web development around the world.";

    if(isset($_POST['submit']))
    {
    $key=$_POST['exp'];
    $pattern = "/$key/i";
    $res=preg_match_all($pattern,$str,$array);
    if($res)
        {
            echo "<br>Regex Pattern: <b>" . $pattern."</b>";
            echo "<br>Match found $res times.<br/>";
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }
    else
        {
            echo "Match doesn't found.";
        }
    }
 
    // $sep=explode(" ",$key);
    
    // //$words = preg_split('/\s+/', trim($key));

    // $pattern = implode('|', array_map('preg_quote', $sep));

    // //print_r($words);

    // echo "<br>Regex Pattern: <b>/" . $pattern."/</b>";

    // $exp="/$pattern/i";

    // $res=preg_match_all($exp,$str,$array);

    // if($res)
    //     {
    //         echo "<br>Match found $res times.<br/>";
    //         echo "<pre>";
    //         print_r($array);
    //         echo "</pre>";
    //     }
    // else
    //     {
    //         echo "Match doesn't found.";
    //     }
    
?>