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
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Login</title>
    </head>
    <body class="login">
        <div class="box">
            <?php
            if (isset($_POST['login']) && ($_POST['login'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $result = $iron->checkUser($conn, $user, $pass);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['role'] == 1) {
                            $_SESSION['useradmin'] = $row['username'];
                            $myinfor = array($row['username'], $row['password'], $row['name'], $row['phone'], $row['email'], $row['role'], $row['img'], $row['date']);
                            $_SESSION['inforadmin'] = $myinfor;
                            header('location: ../admin/homeadmin.php');
                        } else if ($row['role'] == 2) {
                            $_SESSION['user'] = $row['username'];
                            $myinfor = array($row['username'], $row['password'], $row['name'], $row['phone'], $row['email'], $row['role'], $row['img'], $row['date'],$row['id']);
                            $_SESSION['infor'] = $myinfor;
                            header('location: ./home.php');
                        } else if ($row['role'] == 0) {
                            header('location: login.php');
                        }
                    }
                }
            }
            ?>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <h2>Login</h2>
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
                    <div class="links">
                        <a href="forgetpass.php">Forgot Password?</a>
                        <a href="register.php">Register</a>
                    </div>
                    <input type="submit" name="login" class="btnlogin" value="Login">
                </form>
            </div>
        </div>
    </body>
</html>
