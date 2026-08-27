<?php
include('connect.php');
?>
<div>
    <h1>Students</h1>
    <a href="index.php?id=addStudent.php" class="btn btn-primary mb-2">Add Student</a>
    <table class="table table-striped">
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php
            $sql="SELECT * FROM students";
            $res=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($res))
            {
                $sn=$row['std_id'];
                $name=$row['name'];
                $add=$row['address'];
                $phone=$row['phone'];
        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $add; ?></td>
            <td><?php echo $phone; ?></td>
            <td><a href="index.php?id=editStudent.php&s_id=<?php echo $sn;?>">Edit</a></td>
        </tr>
        <?php } ?>
    </table>
</div>