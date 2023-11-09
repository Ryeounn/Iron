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
        <title>Forget Password</title>
    </head>
    <body class="login">
        <div class="box">
            <?php
            if(isset($_POST['forget']) && ($_POST['forget'])){
                $user = $_POST['user'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                
                $result = $iron->findPass($conn, $user, $email, $phone);
                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo '<script>alert("Hello, '.$user.'\nPassword: '.$row['password'].'")</script>';
                        echo '<script>window.location = "login.php"</script>';
                    }
                }
            }
            ?>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <h2>Forget Password</h2>
                    <div class="inputBox">
                        <input type="text" name="user" required>
                        <span>Username</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" required>
                        <span>Email</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="phone" required>
                        <span>Phone</span>
                        <i></i>
                    </div>
                    <div class="links">
                        <a href="login.php">Login?</a>
                        <a href="register.php">Register</a>
                    </div>
                    <input type="submit" name="forget" class="btnlogin btnforget" value="Forget Pasword">
                </form>
            </div>
        </div>
    </body>
</html>
