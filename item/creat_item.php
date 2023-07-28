<?php require_once '../database/connection.php'; ?>

<?php
$error = '';
$success = '';
$sno = '';
$name = '';
$flavor = '';
$price = '';
$description = '';


if (isset($_POST['submit'])) {
    $sno = htmlspecialchars($_POST['sno']);
    $name = htmlspecialchars($_POST['name']);
    $flavor = htmlspecialchars($_POST['flavor']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);


    if (empty($sno)) {
        $error = "Enter S.No";
    } elseif (empty($name)) {
        $error = "Enter item Name";
    } elseif (empty($flavor)) {
        $error = "Enter item flavor";
    } elseif (empty($price)) {
        $error = "Enter item Price";
    } elseif ($_FILES['image']['error'] != 0) {
        $error = "Enter item image";
    } elseif (empty($description)) {
        $error = "Item description can't be empty.";
    } else {

        $sql = "SELECT * FROM `items` WHERE `s_no` = $sno";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            $file_name = $_FILES['image']['name'];
            $file_tmp_name = $_FILES['image']['tmp_name'];

            $file_ext = explode('.', $file_name);
            $file_ext_end = strtolower(end($file_ext));
            $file_ext_arr = array('png', 'jpg', 'jpeg',);


            if (in_array($file_ext_end, $file_ext_arr)) {

                $new_name = "B-" . rand(1, 1000) . "-" . microtime(true) . "-" . $file_name;
                $imagesave = '../uploadimages/' . $new_name;

                if (move_uploaded_file($file_tmp_name, $imagesave)) {


                    $sql = "INSERT INTO `items`(`s_no`,`name`, `flavor`, `price`, `image`, `description`) VALUES ('$sno','$name','$flavor','$price','$imagesave','$description')";
                    $result = $conn->query($sql);

                    if ($result) {
                        $success = "item Successfuly Added !";

                        $error = '';
                        $sno = '';
                        $name = '';
                        $flavor = '';
                        $price = '';
                        $description = '';
                    } else {
                        $error = "item has been failed to add !";
                    }
                }
            }
        } else {
            $error = "S.No already exist";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add | library</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #161616;
            background-size: 100%;
            color: whitesmoke;
        }
        textarea{
            resize: none;
        }
        body {
            background: url(../starterpage/testimonial/1.png);
            /* background-size: 1000px; */
            background-repeat: no-repeat;
            padding-left: 130px;
            background-color: #161616;
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
            padding: 10px;
            }
        }

    </style>
</head>

<body class=" font-monospace">
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-5 text-primary font-monospace">Enter new item here !</h3>
            <div>
                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-2"><b><?php echo $error ?></b></div>
            </div>
            <div>
                <div class="text-center bg-success text-light fw-bolder m-auto col-md-2"><b><?php echo $success ?></b></div>
            </div>


        </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <div class="col-md-6 m-auto mt-5 fw-bolder ">
            <label for="sno"  class="mt-3">S.No</label>
            <input type="number" name="sno" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $sno; ?>">


            <label for="name" class="mt-3">Item Name</label>
            <input type="text" name="name" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $name; ?>">

            <label for="flavor"  class="mt-3">Flavor</label>
            <input type="text" name="flavor" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $flavor; ?>">

            <label for="price"  class="mt-3">Price Rs</label>
            <input type="number" name="price" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $price; ?>">

            <label for="image"  class="mt-3">Image of Item</label>
            <input type="file" name="image" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $image; ?>">

            <div>
                <label for="description" class="form-label mt-3">Description</label>
                <textarea name="description" class="form-control col-md-6 border-secondary-subtle" id="description" rows="5" ><?php echo $description; ?></textarea>
            </div>

            <div class="col-md-12 text-center mt-5">
                <input type="submit" name="submit" class="btn btn-outline-primary" value="submit">
                <a href="./index.php"><input class="btn btn-outline-success col-md-3" value="Back" readonly></a>
            </div>
        </div>
    </form>






    <script src="../bootstrap/bootstrap.js"></script>

    
</body>

</html>