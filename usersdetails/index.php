<?php require_once '../database/connection.php'; ?>




<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

$users = $result->fetch_all(MYSQLI_ASSOC);
}else{
    header('location: ../adminlogin/admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <title>Users</title>
    <style>

        #image_input{
            width: 100px;
            height: 100px;
            margin-left: 15px;
            margin-right: 8px;
            margin-bottom: 5px;
            margin-top: 5px;
            border: 2px solid #161616;
            box-shadow: 0 0 5px whitesmoke;
        }
       
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #161616;
            background-size: 100%;
            color: #A50905;
            font-weight: bolder;
        }
        table{
            margin: auto;
        }
        table td{
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php require_once '../item/admin_partials/sidebar.php';?>

    

    <div class="container text-end">
    <h3 class="text-center mt-5 text-primary"><b>Users</b></h3>

        <a href="./details_create.php" class="btn btn-outline-primary my-5 text-light">Add User</a>

    </div>

    <div >
        <table>
            <thead class="border-2 bg-light p-5 bold text-center">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Adress</th>
                    <th>Pic</th>
                    <th>Created At</th>
                    <th>Action's</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($users) {
                    
                    foreach ($users as $user) {
                ?>
                        <tr class="border-1 border-light  bg-dark text-light font-monospace">
                            <td><?php echo $user['user_id']?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><img src="../<?php echo $user['picture'];?>"  id="image_input"></td>
                            <td><?php echo $user['timestamp']; ?></td>
                            <td>
                                <a href="../usersdetails/details_update.php?id=<?php echo $user['user_id'];?>" class="btn btn-outline-primary">Edit</a>
                                
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteuser(<?php echo $user['user_id']; ?>)">Delete</button>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                    echo "No Recod Found";
                }
                ?>
        </table>



            <!-- delete Model -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="deleteModalLabel">Delete <?php echo $user['name']?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete : <?php echo $user['name']?>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" class="btn btn-danger" id="btn-delete">Delete</a>
            </div>
        </div>
    </div>
</div>




    <script src="../bootstrap/bootstrap.js"></script>

    <script>
    function deleteuser(id) {
        btnDelete = document.getElementById('btn-delete');
        btnDelete.setAttribute('href', 'details_delete.php?id=' + id);
    }
</script>

</body>

</html>