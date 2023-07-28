<?php include '../database/connection.php'; ?>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location: ./index.php');
}


$error = $success = $name = $email = $phone = $address = $password = $cPassword = '';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $password = htmlspecialchars($_POST['password']);
    $cPassword = htmlspecialchars($_POST['cpassword']);
    $file_error = $_FILES['picture']['error'];


    if (empty($name)) {
        $error = "Provide your Name";
    } elseif (empty($email)) {
        $error = "Provide your Email";
    } elseif (empty($phone)) {
        $error = "Provide your Phone";
    } elseif (empty($address)) {
        $error = "Enter your address";
    } elseif ($file_error != 0) {
        $error = "Please Atach your picture";
    } elseif (empty($password)) {
        $error = "Provide your Password";
    } else {

        $file_name = $_FILES['picture']['name'];
        $file_tmp_name = $_FILES['picture']['tmp_name'];

        $file_ext = explode('.', $file_name);
        $file_ext_end = strtolower(end($file_ext));
        $file_ext_arr = array('png', 'jpg', 'jpeg',);
        if (in_array($file_ext_end, $file_ext_arr)) {


            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                if (strlen($password) < 8) {
                    $error = "Password should be 8 or more";
                } else {
                    if ($password === $cPassword) {
                        $newPassword = md5(md5(md5(md5(md5(md5($password))))));

                        if (move_uploaded_file($file_tmp_name, '../uploadimages/' . $file_name)) {
                            $imagesave = 'uploadimages/' . $file_name;


                            $sql = "INSERT INTO `users`(`name`, `email`, `phone`, `address`,`picture`, `password`) VALUES ('$name','$email','$phone','$address','$imagesave','$newPassword')";
                            $result = $conn->query($sql);

                            if ($result) {
                                $success = "User has been succesfully resgistered!";
                            } else {
                                $error = "User has been failed to register";
                            }
                        } else {
                            $error = "Image failed to upload";
                        }
                    } else {
                        $error = 'Password does not match!';
                    }
                }
            } else {
                $error = "Email Already exists";
            }
        } else {
            $error =  "upload valid file";
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
            background: url(../starterpage/testimonial/bg-rr.png);
            background-size: 450px;
            background-repeat: no-repeat;
            padding-left: 130px;
            background-color: rgb(16, 27, 27);
        }

        @media only screen and (max-width: 480px) {
            body {
            padding-left: 10px;
            background: rgb(16, 27, 27);

            }
        }
        @media only screen and (max-width: 635px) {
            body {
            padding-left: 1px;

            }
        }
    </style>
</head>

<body class="text-light">
    <div class="container">
        <div class="row">
            <h3 class="col-md-12 mt-5 text-center mb-2" style="color: rgb(255, 247, 0);">Register Here !</h3>
            <!-- error -->
            <div>
                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-3"><b><?php echo $error ?></b></div>
            </div>
            <div>
                <div class="text-center bg-success text-light fw-bolder m-auto col-md-3"><b><?php echo $success ?></b></div>
            </div>
            <!-- Register form -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
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

                        <a href="./login.php"><input class="btn shadow rounded-1 mt-3" value="Already have account ?" style="background-color: chartreuse;" readonly></a>
                    </div>
            </form>
        </div>
    </div>


    <script src="../bootstrap/bootstrap.js"></script>
    <script>
        let input = document.getElementById('image');
        let imageName = document.getElementById('imageName');

        input.addEventListener('change', () => {
            let inputImage = document.querySelector('input[type:file]').files[0];
            imageName.innerText = inputImage.name;

        })
    </script>
</body>

</html>