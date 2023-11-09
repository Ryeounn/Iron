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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
    </head>
    <body>
        <header>
            <img class="logo" src="../img/iron.png">
            <nav id="header">
                <ul class="nav__links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="product.php">Menu</a></li>
<!--                    <li><a href="about.php">About</a></li>-->
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION['user']) && ($_SESSION['user'])) {
                        $card = "Shopping Cart";
                        echo '<li><a href="cart.php">' . $card . '</a></li>'
                        . '<li><a href="information.php">' . $_SESSION['infor'][2] . '</a></li>'
                        . '<a class="icon-logout" href="logout.php"><i class="fas fa-power-off"></i></a>';
                    } else {
                        $_SESSION['user'] = "";
                    }
                    ?>
                </ul>
            </nav>
            <?php
            if(empty($_SESSION['user'])){
                echo '<a class="cta" href="../src/login.php">Account</a>';
            }
            ?>
            
        </header>
    </body>
</html>
