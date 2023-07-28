<?php require_once '../database/connection.php'; ?>
<?php

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM `admins`";

    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <style>
            @import url('<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100 &display=swap" rel="stylesheet" > ');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100px;
    background: #161616;
    /* padding: 6px 14px; */
    transition: all 0.5s ease;
    border: 1px solid whitesmoke;
    box-shadow: 0 0 10px black;
}
.sidebar.active{
    width: 240px;
}
.sidebar .logo_content .logo {
    color: #fff;
    display: flex;
    height: 50px;
    width: 100%;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: all 0.5s ease;
}
.sidebar.active .logo_content .logo{
    opacity: 1;
}
.logo_content .logo i {
    font-size: 28px;
    margin-right: 5px;
    font-weight: 400;
}
.sidebar #btn {
    position: absolute;
    color: #fff;
    left: 50%;
    top: 6px;
    font-size: 20px;
    height: 50px;
    line-height: 50px;
    transform: translateX(-50%);
}
.sidebar.active #btn{
    left: 90%;
}
.sidebar ul {
    margin-top: 20px;
}
.sidebar ul li {
    position: relative;
    height: 50px;
    width: 100%;
    margin: 0 5px;
    list-style: none;
    line-height: 50px;

}
.sidebar ul li .tooltip{
    position: absolute;
    left: 122px;
    top: 50%;
    transform: translate(-50%,-50%);
    border-radius: 6px;
    height: 35px;
    width: 122px;
    background: #fff;
    line-height: 35px;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    transition: 0s;
    opacity: 0;
    pointer-events: none;
    display:block;

}
.sidebar.active ul li .tooltip{
    display:none;
}
.sidebar ul li:hover .tooltip{
    transition: all 0.5s ease;
    opacity: 1;
    top: 50%;
}
.sidebar ul li a {
    color: #fff;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
    border-radius: 12px;
    white-space: nowrap;
}
.sidebar ul li input {
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    border-radius: 12px;
    outline: none;
    border: none;
    background: #161616;
    padding-left: 50px;
    font-size: 18px;
    color: #fff;
}
.sidebar ul li .bx-search-alt-2 {
    position: absolute;
    z-index: 99;
    color: #fff;
    font-size: 22px;
    transition: all 0.5s ease;
}
.sidebar ul li .bx-search-alt-2:hover{
background: #fff;
color: #161616;
}
.sidebar ul li a:hover {
    color: #161616;
    background: #fff;

}
.sidebar ul li i {
    height: 50px;
    min-width: 50px;
    border-radius: 12px;
    line-height: 50px;
    text-align: center;
}
.sidebar .link_name{
    opacity: 0;
    pointer-events: none;
    transition: all 0.5s ease;
}
.sidebar.active .link_name{
    opacity: 1;
    pointer-events: auto;
}
.sidebar .profile_content {
    position: absolute;
    color: #fff;
    bottom: 0;
    left: 0;
    width: 100%;
}
.sidebar .profile_content .profile {
    position: relative;
    padding: 10px 6px;
    height: 60px;
    transition:all 0.4s ease;
    background: none;
}
.sidebar.active .profile_content .profile{
    background: #161616;
}
.profile_content .profile .profile_details {
    display: flex;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    white-space: nowrap;

}
.sidebar.active .profile .profile_details{
    opacity: 1;
    pointer-events: auto;
}
.profile .profile_details img {
    height: 45px;
    width: 45px;
    object-fit: cover;
    border-radius: 12px;
}
.profile .profile_details .name_job {
    margin-left: 10px;
}
.profile .profile_details .name {
    font-size: 15px;
    font-weight: 400;
}
.profile .profile_details .job {
    font-size: 12px;
}
.profile #log_out {
    position: absolute;
    left: 50%;
    bottom: 5px;
    transform: translateX(-50%);
    min-width: 50px;
    line-height: 50px;
    font-size: 20px;
    border-radius: 12px;
    text-align: center;
    transition:all 0.4s ease;
    background: #161616;
}
.sidebar.active .profile #log_out{
    left: 88%;
}
.sidebar.active .profile #log_out{
    background: none;
}
.home_content {
    position: absolute;
    height: 100%;
    left:78px;
    width: calc(100% - 78px);
    transition: all 0.5s ease;
}
.home_content .text {
    font-size: 25px;
    font-weight: 500;
    color: #161616;
    margin: 12px;
}
.sidebar.active ~ .home_content{
    width: calc(100% - 240px);
    left: 240px;
}
        </style>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <i class='bx b'></i>
                    <b><div class="logo_name"><a href="../index.php" class="btn text-light">Pizza House</a></div></b>
                </div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav_list">
        </li>
        <li>
            <a href="../item/index.php">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="../usersdetails/index.php">
                <i class='bx bx-user'></i>
                <span class="link_name">User</span>
            </a>
            <span class="tooltip">User</span>
        </li>
        <li>
            <a href="../orders/order.php">
                <i class='bx bx-chat'></i>
                <span class="link_name">Orders</span>
            </a>
            <span class="tooltip">Orders</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-stats'></i>
                <span class="link_name">Stats</span>
            </a>
            <span class="tooltip">Stats</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bxl-codepen'></i>
                <span class="link_name">Admin Panel</span>
            </a>
            <span class="tooltip">Admin Panel</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
   </ul>
   <div class="profile_content">
       <div class="profile">
           <div class="profile_details">
<img src="../burgershopmangment//uploadimages/bg/admin2.png" alt="">
               <div class="name_job">
                   <div class="name"><?php echo $admin['name']?></div>
                   <div class="job">Admin</div>
               </div>
           </div>
           <a href="../adminlogin/admin_logout.php">
           <i class='bx bx-log-out' id="log_out"></i>
           </a>
       </div>
   </div>
</div>

<!--Scripts-->
<script>
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let searchBtn = document.querySelector(".bx-search-alt-2");

    btn.onclick = function(){
        sidebar.classList.toggle("active");
    }
    searchBtn.onclick = function(){
        sidebar.classList.toggle("active");
    }
    
    
</script>
</body>
</html>
