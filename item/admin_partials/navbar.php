<?php require_once '../database/connection.php'; ?>
<?php

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM `admins`";

    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="px-5">
            <img src="../burgershopmangment/uploadimages/bg/logo2.png" class="rounded-5" id="profileImage" width="30px">
        </div>
        <a class="navbar-brand" href="#">Welecom <strong> <?php echo $admin['name']?></strong></a>
        
        </button>
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-row align-items-center">
            <li >
                <b><a class="nav-link" href="../item/index.php">Home</a></b>
            </li>
            <li>
            <a class="nav-link" href="../usersdetails/index.php">Users</a>
            </li>
            
        </ul>
        <?php
                if ($_SESSION['admin_id'] = $admin['admin_id']) { ?>
                <a href="../adminlogin/admin_logout.php" class="btn btn-outline-info" type="submit">Logout</a>
            <?php   } else{ ?>
                <a href="../item/index.php" class="btn btn-outline-info" type="submit">Logout</a>
            <?php }

                ?>
        <form class="d-flex">
               
        </form>
    </div>
    </div>
</nav>