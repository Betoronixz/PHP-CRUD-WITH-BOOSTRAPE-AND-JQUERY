<?php

include "connect.php";
include "navbar.php";
$sql = "SELECT * FROM User";
$result = mysqli_query($con, $sql);
?>
<h2 class="text-center mt-3">User Data</h2>
<hr>

<div class="container mt-5">
    <table id="table_id" class="display mt-3">
        <thead>
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Mobile Number</th>
                <th>Image</th>
                <th>Gender</th>
                <th>Subject</th>
                <th>Delete</th>
                <th>Update </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" width="100" height="100" alt=""></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $("#table_id").dataTable();
    });
</script>