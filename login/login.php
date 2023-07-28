<?php require_once '../database/connection.php'; ?>
<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header('location: ./index.php');
}

$error = '';
$success = '';
$email = '';
$password = '';

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($email)) {
        $error = "Please enter E-mail";
    } elseif (empty($password)) {
        $error = "Please enter you password";
    } else {
        $newPassword = md5(md5(md5(md5(md5(md5($password))))));

        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$newPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            header('location: ./index.php');
        } else {
            $error = "Invalid Combination";
        }
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <title>Register</title>
    <style>
        body {
            background: url(../starterpage/testimonial/bg-ss.png);
            background-repeat: no-repeat;
            padding-top: 130px;
            background-color: rgb(16, 27, 27)
        }
    </style>
</head>

<body class="text-light">
    <div class="container">
        <div class="row">
            <h3 class="col-md-12 mt-5 text-center mb-5" style="color: rgb(255, 247, 0);">LogIn Here !</h3>
            <!-- error -->
            <div>
                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-3"><b><?php echo $error ?></b></div>
            </div>
            <div>
                <div class="text-center bg-success text-light fw-bolder m-auto col-md-3"><b><?php echo $success ?></b></div>
            </div>
            <!-- LogIn form -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="col-md-12"><b>



                        <div class="col-md-6 m-auto">
                            <label for="email" class="mt-2">Email *</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
                        </div>


                        <div class="col-md-6 m-auto mt-2">
                            <label for="password" class="mt-2">Password *</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                    </b>


                    <div class="col-md-12 text-center mt-3">

                        <input type="submit" name="submit" class="btn btn-primary  mt-3 rounded-1 mx-2 shadow text-black" style="background-color: rgb(35, 160, 156);" value="Log In">

                        <a href="./register.php"><input class="btn shadow rounded-1 mt-3" value="Register" style="background-color: chartreuse;" readonly></a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="../bootstrap/bootstrap.js"></script>
</body>

</html>