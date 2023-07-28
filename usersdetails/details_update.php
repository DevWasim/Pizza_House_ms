<?php include '../database/connection.php'; ?>
<?php
session_start();
if (isset($_SESSION['admin_id'])) {


    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    } else {
        header('location: ./index.php');
    }


    $sql = "SELECT * FROM `users` WHERE `user_id` = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();


    $error = '';
    $success = '';
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $address = $user['address'];
    $file = $user['picture'];
    $password = $user['password'];


    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $password = htmlspecialchars($_POST['password']);
        $cPassword = htmlspecialchars($_POST['cpassword']);
        $file_error = $_FILES['picture'];


        if (empty($name)) {
            $error = "Provide your Name";
        } elseif (empty($email)) {
            $error = "Provide your Email";
        } elseif (empty($phone)) {
            $error = "Provide your Phone";
        } elseif (empty($address)) {
            $error = "Enter your address";
        } elseif (empty($password)) {
            $error = "Provide your Password";
        } else {


            $sql = "SELECT * FROM `users` WHERE `email`= '$email' AND `user_id` != '$id'";
            $result = $conn->query($sql); 

            if ($result->num_rows == 0) {
                if (strlen($password < 8)) {
                    $error = "Password should be 8 or more";
                } else {
                    if ($password === $cPassword) {
                        $newPassword = md5(md5(md5(md5(md5(md5($password))))));

                        if ($_FILES['picture']['error'] != 0) {
                            $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`picture`='$file',`password`='$newPassword' WHERE `user_id` = $id";

                            $result = $conn->query($sql);

                            if ($result) {
                                $success = "item Successfuly Updated !";
                            } else {
                                $error = "item has been failed to update !";
                            }
                        } else {


                            $file_name = $_FILES['picture']['name'];
                            $file_tmp_name = $_FILES['picture']['tmp_name'];

                            $file_ext = explode('.', $file_name);
                            $file_ext_end = strtolower(end($file_ext));
                            $file_ext_arr = array('png', 'jpg', 'jpeg',);


                            if (in_array($file_ext_end, $file_ext_arr)) {

                                $new_name = "B-" . rand(1, 1000) . "-" . microtime(true) . "-" . $file_name;
                                $imagesave = '../uploadimages/' . $new_name;

                                if (move_uploaded_file($file_tmp_name, $imagesave)) {


                                    $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`picture`='$imagesave',`password`='$password' WHERE `user_id` = $id";

                                    $result = $conn->query($sql);

                                    if ($result) {
                                        $success = "item Successfuly Updated !";
                                    } else {
                                        $error = "item has been failed to update !";
                                    }
                                }
                            }
                        }
                    } else {
                        $error = "Password doesn't match";
                    }
                }
            } else {
                $error = "S.No already exist";
            }
        }
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
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <title>Register</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #161616;
        background-size: 100%;
        color: whitesmoke;
        font-weight: bolder;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <h3 class="col-md-12 mt-5 font-monospace text-center mb-5" style="color: rgb(255, 247, 0);">Edit  :   <?php echo $name?></h3>

            <div class="card m-auto" style="width:18rem; ">
                <img src="../<?php echo $user['picture'] ?>" class="card-img-top mt-2" alt="<?php echo $user['picture'] ?>">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $name ?></h5>
                </div>
            </div>
            <!-- error -->
            <div>
                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-3 mt-2"><b><?php echo $error ?></b></div>
            </div>
            <div>
                <div class="text-center bg-success text-light fw-bolder m-auto col-md-3"><b><?php echo $success ?></b></div>
            </div>
            <!-- Register form -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="col-md-6 m-auto"><b>
                            <label for="name" class="mt-2">Name *</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" autocomplete="off">
                    </div>

                    <div class="col-md-6 m-auto">
                        <label for="email" class="mt-2">Email *</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" autocomplete="off">
                    </div>

                    <div class="col-md-6 m-auto">
                        <label for="phone" class="mt-2">Phone *</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>" autocomplete="off">
                    </div>


                    <div class="col-md-6 m-auto">
                        <label for="phone" class="mt-2">Adress *</label>
                        <textarea name="address" id="address" cols="90" rows="2" class="rounded-3 form-control" style="resize: none; outline: 0;"><?php echo $address ?></textarea>
                    </div>

                    <div class="col-md-6 m-auto">
                        <label for="picture" class="mt-2">Picture *</label>
                        <input type="file" name="picture" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg" autocomplete="off"><br>
                        <span id="imageName" class="text-success"></span>
                    </div>

                    <div class="col-md-6 m-auto">
                        <label for="password" class="mt-2">Password *</label>
                        <input type="password" name="password" class="form-control" autocomplete="off">
                    </div>

                    <div class="col-md-6 m-auto">
                        <label for="cpassword" class="mt-2">Confirm Password *</label>
                        <input type="password" name="cpassword" class="form-control" autocomplete="off">
                    </div>

                    </b>
                    <div class="col-md-12 text-center mt-3">

                        <input type="submit" name="submit" class="btn btn-primary  mt-3 rounded-1 mx-2 shadow text-black" style="background-color: rgb(35, 160, 156);" value="Sign Up">

                        <a href="./index.php"><input class="btn shadow rounded-1 mt-3" value="Back ?" style="background-color: chartreuse;" readonly></a>
                    </div>
            </form>
        </div>
    </div>


    <script src="../bootstrap/bootstrap.js"></script>

</body>

</html>