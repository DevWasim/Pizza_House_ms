<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="px-5">
            <img src="../<?php echo $user['picture'] ?>" class="rounded-5" id="profileImage" width="30px">
        </div>
        <a class="navbar-brand" href="#">Welecom <strong><?php echo $user['name'] ?></strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex">
            <?php
                if ($_SESSION['user_id'] = $user['user_id']) { ?>
                <a href="./logout.php" class="btn btn-outline-info" type="submit">Logout</a>
            <?php   } else{ ?>
                <a href="../login/index.php" class="btn btn-outline-info" type="submit">Logout</a>
            <?php }

                ?>

        </form>
    </div>
    </div>
</nav>