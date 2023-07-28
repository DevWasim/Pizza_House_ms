<?php require_once '../database/connection.php'; ?>
<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM `items`";

    $result = $conn->query($sql);

    $items = array();

    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
    header('location: ../adminlogin/admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
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
            color: #A50905;
            font-weight: bolder;
            
        }

   
    </style>
</head>

<body >

<?php require_once './admin_partials/sidebar.php';?>

    <div class="container">
        <div class="row">
            <h3 class="text-center mt-5 text-primary mb-5 font-monospace">Item's in Pizza House</h3>

            <div class="col-md-12 text-end"><a href="./creat_item.php">
                <button class="btn btn-outline-success mb-5 " readonly>Add New Item</button></a>
            </div>
           
            
            <table>
                <thead class="mb-5">
                    <tr class="border-2 bg-light p-5 bold ">
                        <th>S.No</th>
                        <th>Item Name</th>
                        <th>Flavor</th>
                        <th>Price</th>
                        <th>Pic</th>
                        <th>Description</th>
                        <th>Time</th>
                        <th>Action's</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     if(!empty($items)){

                         foreach($items as $item){
                         ?>
                      <tr class="border-1 border-light  bg-dark text-light font-monospace">
                         <td class="px-2"><?php echo $item['s_no'];?></td>
                         <td><?php echo $item['name'];?></td>
                         <td><?php echo $item['flavor'];?></td>
                         <td><?php echo $item['price'];?> Rs</td>
                         <td><img src="<?php echo $item['image'];?>" id="image_input"></td>
                         <td><?php echo $item['description'];?></td>
                         <td><?php echo $item['time'];?></td>
                         <td>
                             <a href="edit.php?id=<?php echo $item['id'];?>"><input type="button" class="btn btn-outline-primary" value="Edit" readonly></a>
                             <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteitem(<?php echo $item['id']; ?>)">Delete</button>
                         </td>
                     </tr>
                     <?php 
                         }
                     }?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- delete Model -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="deleteModalLabel">Delete <?php echo $item['name']?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <?php echo $item['name']?>?
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
    function deleteitem(id) {
        btnDelete = document.getElementById('btn-delete');
        btnDelete.setAttribute('href', 'delete_item.php?id=' + id);
    }
</script>
</body>

</html>
