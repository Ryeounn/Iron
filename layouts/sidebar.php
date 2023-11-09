<?php
require_once '../dbconnect.php';
require_once '../Iron.php';
$iron = new Iron();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title></title>
    </head>
    <body id="body">
        <div class="siderbar">
            <div class="logo_content">
                <div class="logo">
                    <img src="../img/iron.png">
                    <div class="logo_name">Iron</div>
                </div>
                <i class="fa-solid fa-bars" id="btn"></i>
            </div>
            <ul>
                <li>
                    <i class="fas fa-search"></i>
                    <input id="input" type="text" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </li>
                <li>
                    <a href="homeadmin.php">
                        <i class="fas fa-th-large"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="product.php">
                        <i class="fa-brands fa-codepen"></i>
                        <span class="links_name">Product</span>
                    </a>
                    <span class="tooltip">Product</span>
                </li>
                <li>
                    <a href="user.php">
                        <i class="fas fa-users"></i>
                        <span class="links_name">User</span>
                    </a>
                    <span class="tooltip">User</span>
                </li>
                <li>
                    <a href="order.php">
                        <i class="fas fa-clipboard-check"></i>
                        <span class="links_name">Order</span>
                    </a>
                    <span class="tooltip">Order</span>
                </li>
                <li>
                    <a href="revenue.php">
                        <i class="fas fa-database"></i>
                        <span class="links_name">Revenue</span>
                    </a>
                    <span class="tooltip">Revenue</span>
                </li>
                <li>
                    <a href="notification.php">
                        <i class="fas fa-bell"></i>
                        <span class="links_name">Notification</span>
                    </a>
                    <span class="tooltip">Notification</span>
                </li>
            </ul>
            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                        <?php
                        if (isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])) {
                            $user = $_SESSION['inforadmin'][0];
                            $pass = $_SESSION['inforadmin'][1];
                            $result = $iron->checkUser($conn, $user, $pass);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                        <a href="information.php"><img src="<?php echo $row['img'] ?>"></a>
                                    <div class="name_job">
                                        <div class="name"><?php echo $row['name'] ?></div>
                                        <div class="job">Admin</div>
                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            echo '<script>alert("Please Login!")</script>';
                            echo '<script>window.location = "../src/login.php"</script>';
                        }
                        ?>
                    </div>
                    <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i></a>
                </div>
            </div>
        </div>
        <script>
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".siderbar");
            let searchBtn = document.querySelector(".fa-search");

            btn.onclick = function () {
                sidebar.classList.toggle("active");
            };

            searchBtn.onclick = function () {
                sidebar.classList.toggle("active");
            };
        </script>

        <script>
            $('#input').keypress(function (event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    const input = document.getElementById('input').value;
                    if (input === 'dashboard' || input === 'Dashboard' || input === 'DASHBOARD') {
                        window.location = 'homeadmin.php';
                    } else if (input === 'product' || input === 'Product' || input === 'PRODUCT') {
                        window.location = 'product.php';
                    } else if (input === 'user' || input === 'User' || input === 'USER') {
                        window.location = 'user.php';
                    } else if (input === 'order' || input === 'Order' || input === 'ORDER') {
                        window.location = 'order.php';
                    } else if (input === 'revenue' || input === 'Revenue' || input === 'REVENUE') {
                        window.location = 'revenue.php';
                    } else if (input === 'logout' || input === 'Logout' || input === 'LOGOUT') {
                        window.location = 'logout.php';
                    } else if (input === 'information' || input === 'Information' || input === 'INFORMATION') {
                        window.location = 'information.php';
                    } else {
                        alert('No Result');
                    }
                }
            });
        </script>
    </body>
</html>
