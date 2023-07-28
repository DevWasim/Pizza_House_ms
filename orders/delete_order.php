<?php require_once '../database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./order.php');
}

$sql = "DELETE FROM `orders` WHERE `order_id` = $id";

if ($conn->query($sql)) {
    header('Location: ./order.php');
} else {
    echo 'User has failed to delete';
}