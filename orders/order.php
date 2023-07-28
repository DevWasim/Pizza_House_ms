<?php require_once '../database/connection.php'; ?>
<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM `orders`";

    $result = $conn->query($sql);

    $orders = array();

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
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
    <title>Order's</title>
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

<?php require_once '../item/admin_partials/sidebar.php';?>

    <div class="container">
        <div class="row">
            <h3 class="text-center mt-5 text-primary mb-5 font-monospace">New Orders</h3>

           
           
            
            <table>
                <thead class="mb-5">
                    <tr class="border-2 bg-light p-5 bold ">
                        <th>Order No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Order detials</th>
                        <th>Address</th>
                        <th>Time</th>
                        <th>Action's</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     if(!empty($orders)){
                         $itt = 1;
                         foreach($orders as $order){
                         ?>
                      <tr class="border-1 border-light  bg-dark text-light font-monospace p-2">
                         <td class="px-2"><?php echo $itt;?></td>
                         <td><?php echo $order['order_name'];?></td>
                         <td><?php echo $order['order_email'];?></td>
                         <td><?php echo $order['order_phone'];?></td>
                         <td><?php echo $order['order_details'];?></td>
                         <td><?php echo $order['order_address'];?></td>
                         <td><?php echo $order['order_time'];?></td>
                         <td>
                             <button type="button" class="btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteorder(<?php echo $order['order_id']; ?>)">Delete</button>
                         </td>
                     </tr>
                     <?php 
                       $itt++;
                      }
                     }else{
                        echo 'No orders found';
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
                <h1 class="modal-title fs-5 text-white" id="deleteModalLabel">Delete <?php echo $order['order_name']?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <?php echo $order['order_name']?>?
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
    function deleteorder(id) {
        btnDelete = document.getElementById('btn-delete');
        btnDelete.setAttribute('href', 'delete_order.php?id=' + id);
    }
</script>
</body>

</html>



