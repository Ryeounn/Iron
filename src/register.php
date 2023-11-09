<?php
session_start();
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
        <link rel="shortcut icon" type="image/png" href="../img/iron.png">
        <title>Register</title>
    </head>
    <body>
        <body class="login">
        <div class="box boxer">
            <?php
            if (isset($_POST['register']) && ($_POST['register'])) {
                $name = $_POST['name'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                
                $result = $iron->registerCustomer($conn, $name, $user, $pass, $phone, $email);
                echo '<script>alert("Account registration successful")</script>';
                echo '<script>window.location = "login.php"</script>';
            }
            ?>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <h2>Register</h2>
                    <div class="inputBox">
                        <input type="text" name="name" required>
                        <span>Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="user" required>
                        <span>Username</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="pass" required>
                        <span>Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="number" name="phone" required>
                        <span>Phone</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" required>
                        <span>Email</span>
                        <i></i>
                    </div>
                    <div class="links">
                        <a href="forgetpass.php">Forgot Password?</a>
                        <a href="login.php">Login</a>
                    </div>
                    <input type="submit" name="register" class="btnlogin btnregister" value="Register">
                </form>
            </div>
        </div>
    </body>
</html>
