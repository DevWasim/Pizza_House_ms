<?php require_once '../database/connection.php'; ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location, ./index.php');
}

$sql = "SELECT * FROM `items` WHERE `id` = $id";

$result = $conn->query($sql);
$item = $result->fetch_assoc();


$error = '';
$success = '';
$sno = $item['s_no'];
$name = $item['name'];
$flavor = $item['flavor'];
$price = $item['price'];
$file = $item['image'];
$description = $item['description'];


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
    } elseif (empty($description)) {
        $error = "Item description can't be empty.";
    } else {



        $sql = "SELECT * FROM `items` WHERE `s_no` = $sno AND `id` != $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {

            if($_FILES['image']['error'] != 0){

                $sql = "UPDATE `items` SET `s_no`='$sno',`name`='$name',`flavor`='$flavor',`price`='$price',`image`='$file',`description`='$description' WHERE `id` = $id";
                   
                    $result = $conn->query($sql);

                    if ($result) {
                        $success = "item Successfuly Updated !";
                    } else {
                        $error = "item has been failed to update !";
                    }
            }else{

           
            $file_name = $_FILES['image']['name'];
            $file_tmp_name = $_FILES['image']['tmp_name'];

            $file_ext = explode('.', $file_name);
            $file_ext_end = strtolower(end($file_ext));
            $file_ext_arr = array('png', 'jpg', 'jpeg',);


            if (in_array($file_ext_end, $file_ext_arr)) {

                $new_name = "B-" . rand(1, 1000) . "-" . microtime(true) . "-" . $file_name;
                $imagesave = '../uploadimages/' . $new_name;

                if (move_uploaded_file($file_tmp_name, $imagesave)) {


                    $sql = "UPDATE `items` SET `s_no`='$sno',`name`='$name',`flavor`='$flavor',`price`='$price',`image`='$imagesave',`description`='$description' WHERE `id` = $id";
                   
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
    <title>Edit | House items</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        #body{
            background-color: #161616;
            background-size: 100%;
        }
        textarea{
            resize: none;
        }

    </style>
</head>

<body id="body">
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-3 text-light"><b>Edit item : <?php echo $name ?></b></h3>
            
            <div class="card m-auto" style="width:18rem; ">
                <img src="<?php echo $item['image'] ?>" class="card-img-top mt-2" alt="<?php echo $item['flavor'] ?>">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $item['flavor'] ?></h5>
                </div>
            </div>
            
            <div class="mt-2">
                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-3"><b><?php echo $error ?></b></div>
            </div>
            <div>
                <div class="text-center bg-success text-light fw-bolder m-auto col-md-3"><b><?php echo $success ?></b></div>
            </div>
            


        </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="col-md-6 m-auto mt-5 fw-bolder text-light">
            <label for="sno">S.No</label>
            <input type="number" name="sno" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $sno; ?>">


            <label for="name" class="mt-3">Item Name</label>
            <input type="text" name="name" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $name; ?>">

            <label for="flavor" class="mt-3">Flavor</label>
            <input type="text" name="flavor" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $flavor; ?>">

            <label for="price" class="mt-3">Price Rs</label>
            <input type="number" name="price" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $price; ?>">

            <label for="image" class="mt-3">Image of Item</label>
            <input type="file" name="image" class="form-control col-md-6 border-secondary-subtle" value="<?php echo $image; ?>">

            <div>
                <label for="description" class="form-label mt-3">Description</label>
                <textarea name="description" class="form-control col-md-6 border-secondary-subtle" id="description" rows="5"><?php echo $description; ?></textarea>
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