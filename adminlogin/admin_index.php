<?php require_once '../database/connection.php'; ?>

<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM `admins` WHERE `admin_id` = $id";
    $result = $conn->query($sql);

    $admin = $result->fetch_assoc();
} else {
    header('location: ./admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <title>Our Website</title>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-5">
        <a class="navbar-brand text-center" href="#"><b><?php echo $admin['name']; ?></b></a>
        <a href="./admin_logout.php" class="btn btn-danger">Log Out</a>

        
    </nav> -->
    <script src="../bootstrap/bootstrap.js"></script>
    
</body>

</html>