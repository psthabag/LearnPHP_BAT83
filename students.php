<?php
    include('connect.php');

    $perPage = 8;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page); // Ensure page is at least 1
    $offset = ($page - 1) * $perPage;

    $totalQuery = mysqli_query($conn, "SELECT COUNT(*) FROM students");
    $totalRows = mysqli_fetch_row($totalQuery)[0];
    $totalPages = ceil($totalRows / $perPage);

    $sql="SELECT * FROM students LIMIT $offset, $perPage";
    $res=mysqli_query($conn,$sql);
?>
<h1>Students</h1>
<a href="index.php?id=addStudent.php" class="btn btn-primary mb-2">Add Student</a>
<table class="table table-striped">
    <tr>
        <th>StdID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    <?php
    while($row=mysqli_fetch_array($res))
    {
    ?>
    <tr>
        <td class="align-middle">
            <?php
                if($row[0]<10)
                    {
                        echo "KCP-100";
                    }
                elseif($row[0]<100)
                    {
                        echo "KCP-10";
                    }
                elseif($row[0]<1000)
                    {
                        echo "KCP-1";
                    }
                echo $row[0];
            ?>
        </td>
        <td class="align-middle"><img src="<?php echo $row[4];?>" width="50px"/></td>
        <td class="align-middle"><?php echo $row[1];?></td>
        <td class="align-middle"><?php echo $row[2];?></td>
        <td class="align-middle"><?php echo $row[3];?></td>
        <td class="align-middle">
            <a href="index.php?id=editStudent.php&sid=<?php echo $row[0];?>" class="text-decoration-none">
                <i class="bi bi-pencil-square"></i> 
                Edit
            </a>
            <a href="index.php?id=delStudent.php&sid=
            <?php echo $row[0];?>" 
            onclick="return confirm('Do you want to delete?');"
            class="text-danger text-decoration-none">
                <i class="bi bi-trash3"></i>
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>
<div class="pagination justify-content-center">
    <?php if ($page > 1): ?>
        <a href="?id=students.php&page=<?php echo $page - 1;?>">Previous</a>
    <?php endif; ?>

    <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?id=students.php&page=<?php echo $page + 1; ?>"> Next</a>
    <?php endif; ?>
</div>