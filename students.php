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
            // while($row=mysqli_fetch_assoc($res))
            // {
            //     $sn=$row['std_id'];
            //     $name=$row['name'];
            //     $add=$row['address'];
            //     $phone=$row['phone'];
            while($row=mysqli_fetch_array($res))
            {
                $sn=$row[0];
                $name=$row[1];
                $add=$row[2];
                $phone=$row[3];
        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $add; ?></td>
            <td><?php echo $phone; ?></td>
            <td><a href="index.php?id=editStudent.php&s_id=<?php echo $sn;?>"><i class="bi bi-pencil-square"></i></a></td>
        </tr>
        <?php } ?>
    </table>
</div>