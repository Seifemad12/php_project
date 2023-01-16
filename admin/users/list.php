<?php

//open connection
$conn = mysqli_connect("localhost","root","","blog");
if(! $conn){
    echo mysqli_connect_error();
    exit;
}
$query = "select * from users";

if(isset($_GET['search'])){
    $search = mysqli_escape_string($conn,$_GET['search']);

    $query .= " where name like '%".$search."%' or email like '%".$search."%' ;";
    // echo $query;
}

$result = mysqli_query($conn, $query);
?>

<html>
    <head>
        <title>Admin:: List USERS</title>
    </head>

    <body>
        <h1>List Users</h1>
        <div>
            <form method="get">
                <input type="text" name="search" id="search" placeholder = "Enter name or email">
                <input type="submit" value="search">
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= ($row['admin'])? 'Yes':'No' ?></td>
                    <td><a href="edit.php?id= <?=$row['id']?>">Edit</a></td>
                    <td><a href="delete.php?id= <?=$row['id']?>">Delete</a></td>
                </tr>
                <?php
                }
                ?>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center"><?mysqli_num_rows($result) ?>Users</td>
                        <td colspan="4" style="text-align: center"><a href="add.php">Add User</a></td>
                    </tr>
                </tfoot>



            </table>
        </div>
    </body>
</html>
<?php
mysqli_free_result($result);
mysqli_close ($conn);
?>