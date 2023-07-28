<?php require_once '../database/connection.php'; ?>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    $sql = "SELECT * FROM `users` WHERE `user_id` = $id";
    $result = $conn->query($sql);

    $users = $result->fetch_assoc();
} else {
    header('location: ./login.php');
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">

    <!-- Template Stylesheet -->
    <link href="../starterpage/css/style.css" rel="stylesheet">
    <style>
        #image_input {
            width: 200px;
            height: 150px;
            margin: auto;
            margin-bottom: 20px;
            margin-top: 20px;
            box-shadow: 0 0 5px whitesmoke;
        }

        #menu {
            width: 150px;
            display: flex;
            justify-content: end;
            margin-left: 44%;
            font-weight: 1000;
            font-size: 50px;
            font-family: 'Pacifico', cursive;

        }
    </style>
</head>

<body id="body">
    <div class="container-xxl bg-light p-0">

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="#" class="navbar-brand p-0">
                    <div>
                        <img src="../starterpage/testimonial/2.png">
                    </div>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="#service" class="nav-item nav-link">Menu</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <!-- <a href="menu.html" class="nav-item nav-link">Menu</a> -->
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div> -->
                        <a href="#ordernow" class="nav-item nav-link">Order Now</a>
                    </div>
                    <a href="./logout.php" class="btn btn-outline-danger text-light py-2 px-4">Log Out</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-light animated slideInLeft" id="enjoy_our">Welcome to<br>Pizza House <br><b><?php echo $users['name'] ?></b></h1>

                            <p class="text-warning mb-4 pb-2" id="enjoyour">Hello !

                                &nbsp; To enjoy our special deals Click on the bellow button.
                            </p>
                            <button class="btn btn-outline-warning py-sm-3 px-sm-5 me-3 animated slideInLeft text-light"><b>
                                    Click Here</b></button>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="../starterpage/colorful-round-tasty-pizza_1284-10219-removebg-preview.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- items display -->

        <?php
        $sql = "SELECT * FROM `items`";

        $result = $conn->query($sql);

        $items = array();

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        ?>


        <!-- Service Start -->
        <b id="menu" class="text-danger">Menu</b>
        <div class="container-xxl py-5" id="service">
            <div class="container">
                <div class="row g-4">
                    <?php
                    if (!empty($items)) {
                        foreach ($items as $item) {
                    ?>

                            <div class="card m-5 mb-5" style="width: 18rem;">
                                <img src="<?php echo $item['image']; ?>" class="card-img-top mt-2 rounded-2" id="image_input" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item['flavor']; ?></h5>
                                    <span class="card-text"><?php echo $item['description']; ?></span>
                                    <p class="card-text text-danger rounded-3"><strong>Price : <?php echo $item['price']; ?> PKR</strong></p>
                                    <a href="#" class="btn btn-warning col-md-12 m-auto"><b>Add to cart</b></a>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>


                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- About Start -->
    <div class="container-xxl py-5 bg-light" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded-3 w-100 wow zoomIn" data-wow-delay="0.1s" src="../starterpage/testimonial/hb.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded-3 w-75 wow zoomIn" data-wow-delay="0.3s" src="../starterpage/testimonial/hh.jpg" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded-3 w-75 wow zoomIn" data-wow-delay="0.5s" src="../starterpage/testimonial/ij.jpg">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded-3 w-100 wow zoomIn" data-wow-delay="0.7s" src="../starterpage/testimonial/iuoi.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title ff-secondary text-start text-danger fw-normal">About Us</h5>
                    <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-danger me-2"></i>Pizza House</h1>
                    <p class="mb-4"><strong>Pizza House</strong> is one of the best and oldest pizza and burger shop, we have 30+ emploies for fast devlivery <strong>Pizza House</strong> also have home delivery opertunity and about 1000+ special coustmers.</p>
                    <p class="mb-4"><strong>Pizza House</strong> have fastest serves of bikes for pizza and burger delivery.Our pizza is most famous pizza all over the country and <strong>Pizza House</strong> have 5 sub branchies in diffrent cities.</p>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-danger mb-0" data-toggle="counter-up">10+
                                </h1>
                                <div class="ps-4">
                                    <p class="mb-0">Years of</p>
                                    <h6 class="text-uppercase mb-0">Experience</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-danger mb-0" data-toggle="counter-up">30
                                </h1>
                                <div class="ps-4">
                                    <p class="mb-0">Popular</p>
                                    <h6 class="text-uppercase mb-0">Master Chefs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger py-3 px-5 mt-2" href="#ordernow">Home Deleviery Avilable</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!--order form  -->
    <?php

    $error = "";
    $success = "";
    $ordername = "";
    $orderemail = "";
    $orderphone = "";
    $orderdetails = "";
    $orderaddress = "";

    if (isset($_POST['submit'])) {
        $ordername = htmlspecialchars($_POST['name']);
        $orderemail = htmlspecialchars($_POST['email']);
        $orderphone = htmlspecialchars($_POST['phone']);
        $orderdetails = htmlspecialchars($_POST['order']);
        $orderaddress = htmlspecialchars($_POST['address']);

        if (empty($ordername)) {
            $error = "Provide your Name";
        } elseif (empty($orderemail)) {
            $error = "Provide your Email";
        } elseif (empty($orderphone)) {
            $error = "Provide your Phone";
        } elseif (empty($orderdetails)) {
            $error = "Provide your Order";
        } elseif (empty($orderaddress)) {
            $error = "Provide your Home address";
        } else {

            $sql = "INSERT INTO `orders`(`order_name`, `order_email`, `order_phone`, `order_details`, `order_address`) VALUES ('$ordername','$orderemail','$orderphone','$orderdetails','$orderaddress')";

            $result = $conn->query($sql);
            if ($result) {
                $success = "Thanks for order We Recived your order";
                $orderdetails = "";
            } else {
                $error = "Falied to recive your order";
            }
        }
    }
    ?>

    <!-- end order form  -->


    <!-- Login users details in old  -->
    <?php
    $username = $users['name'];
    $useremail = $users['email'];
    $userphone = $users['phone'];
    $useraddress = $users['address'];
    ?>



    <!-- Reservation Start -->
    
        <div class="container-xxl pt-5 pb-3 bg-light">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-0" id="ordernow">
                    <div class="col-md-6">
                        <div class="video">
                            <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/LZYu6D4XOE0" data-bs-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 bg-dark d-flex align-items-center">
                        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                            <h5 class="section-title ff-secondary text-start text-danger fw-normal">Home Delivery</h5>
                            <h1 class="text-light mb-4">Online Order</h1>

                            <!-- error  -->
                            <div>
                                <div class="text-center bg-danger text-light fw-bolder m-auto col-md-5 mt-2 mb-2 rounded-3"><b><?php echo $error ?></b></div>
                            </div>
                            <div>
                                <div class="text-center bg-success text-light fw-bolder m-auto col-md-6 mb-2 rounded-3"><b><?php echo $success ?></b></div>
                            </div>

                            <!-- erro end  -->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="<?php echo $username ? $username : $ordername; ?>">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" value="<?php echo $useremail ? $useremail : $orderemail; ?>">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="phone" name="phone" class="form-control" id="phone" placeholder="Your phone" value="<?php echo $userphone ? $userphone : $orderphone; ?>">
                                            <label for="phone">Your Phone No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <textarea name="order" class="form-control" placeholder="Special Request" id="message" style="height: 40px; resize: none;"><?php echo $orderdetails; ?></textarea>
                                            <label for="message">Your Order</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mb-3">
                                    <div class="form-floating">
                                        <textarea name="address" class="form-control" placeholder="Special Request" id="message" style="height: 90px; resize: none;"><?php echo $useraddress ? $useraddress : $orderaddress; ?></textarea>
                                        <label for="message">Home Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="submit" name="submit" class="btn btn-danger w-100 py-3" value="Order Now">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    

    <!-- Reservation Start -->


    <!-- item Start -->
    <div class="container-xxl pt-5 pb-3 bg-light">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-danger fw-normal">Items</h5>
                <h1 class="mb-5">Our latest deals</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <div class="rounded-circle overflow-hidden m-4">
                            <img class="img-fluid" src="../starterpage/testimonial/4.png" alt="">
                        </div>
                        <h5 class="mb-3">Meet Pizaa</h5>
                        <b>xl Pizza </b>
                        <div class="d-flex justify-content-center mt-3">
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <div class="rounded-circle overflow-hidden m-4">
                            <img class="img-fluid mt-3" id="burger_image" src="../starterpage/testimonial/2.png" alt="">
                        </div>
                        <h5 class="mb-0">Chess Pizza</h5>
                        <b>larg Pizza with 1 litter drink</b>
                        <div class="d-flex justify-content-center mt-3">
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <div class="rounded-circle overflow-hidden m-4">
                            <img class="img-fluid" src="../starterpage/testimonial/111.png" alt="">
                        </div>
                        <h5 class="mb-3">Special Fries</h5>
                        <b>Special Tasty Fries with ketchup</b>
                        <div class="d-flex justify-content-center mt-3">
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <div class="rounded-circle overflow-hidden m-4">
                            <img class="img-fluid" src="../starterpage/testimonial/jnn.png" alt="">
                        </div>
                        <h5 class="mb-3">Special Pizza</h5>
                        <b>xl pizza with fries and 1 litter drink</b>
                        <div class="d-flex justify-content-center mt-3">
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                            <p class="btn btn-square btn-danger mx-1" href="#"><i class="fab fa-"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp d-grid bg-light" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h5 class="section-title ff-secondary text-center text-danger fw-normal">Testimonial</h5>
                <h1 class="mb-5">Our Clients Review's</h1>
            </div>
            <div class="card card-body owl-carousel testimonial-carousel bg-body-secondary">
                <div class="testimonial-item border rounded p-4 m-1 bg-light">
                    <i class="fa fa-quote-left fa-2x text-danger mb-3"></i>
                    <b>The Pizza House Pizza and burger is super awsome specialy the meet pizza of Pizza House Great work.</b>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="../starterpage/img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Tom Cruose</h5>
                            <small>Hallywood Actor</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light border rounded p-4 m-1">
                    <i class="fa fa-quote-left fa-2x text-danger mb-3"></i>
                    <b>I am special custmer of Pizza House from past 3 years and my experience with Pizza House tast is Amzing</b>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="../starterpage/img/testimonial-2.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Valadi Mir Putin</h5>
                            <small>President of Russia</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light border rounded p-4 m-1">
                    <i class="fa fa-quote-left fa-2x text-danger mb-3"></i>
                    <b>Pizza House ! Ony of the amazing pizza prodeucer and on of my fevrite pizza avilable here!</b>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="../starterpage/img/testimonial-3.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Critiano Ronaldo</h5>
                            <small>Footballer</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light border rounded p-4 m-1">
                    <i class="fa fa-quote-left fa-2x text-danger mb-3"></i>
                    <b>The amazing thing about the Pizza House is the tast i never forget it and in my openion Pizza house is the best Pizza and burger shop.</b>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="../starterpage/img/testimonial-4.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Elon Musk</h5>
                            <small>Tesla owner / Bussines man</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    
    <div class="container-fluid bg-dark text-light footer pt-5 border-danger border-5 border-top wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-danger fw-normal mb-4">Company</h4>
                    <a class="btn btn-link" href="#about">About Us</a>
                    <a class="btn btn-link">Contact Us</a>
                    <a class="btn btn-link">Reservation</a>
                    <a class="btn btn-link">Privacy Policy</a>
                    <a class="btn btn-link">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-danger fw-normal mb-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Islamabad, Pakistan</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>pizzahouse@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="../index.php"><i class="fab fa-google"></i></a>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-danger fw-normal mb-4">Opening</h4>
                    <h5 class="text-light fw-normal">Monday - Saturday</h5>
                    <p>09AM - 03AM</p>
                    <h5 class="text-light fw-normal">Sunday</h5>
                    <p>10AM - 11PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-danger fw-normal mb-4">Newsletter</h4>
                    <p>Join our special costumer team.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email" readonly>

                        <a href="../login/index.php" class="btn btn-danger py-2 position-absolute top-0 end-0 mt-2 me-2">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Pizza House</a> | All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="#" class="btn">Home</a>
                            <a>Cookies</a>
                            <a>Help</a>
                            <a>FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>