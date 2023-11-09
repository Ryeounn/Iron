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
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/iron.png">
        <title>Edit User</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Edit User</div>
            <?php
            if (isset($_POST['update']) && ($_POST['update'])) {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $pos = $_POST['pos'];
                $id = $_SESSION['id_user'];

                $errror = [];
                $file = $_FILES['imageFiles'];
                $size_allow = 10;
                $filename = $file['name'];
                $filename = explode('.', $filename);
                $ext = end($filename);
                $new_file = md5(uniqid()) . '.' . $ext;
                $allow_ext = ['png', 'jpg', 'jpeg'];
                $img_final = "../img/uploads/" . $new_file;
                if (in_array($ext, $allow_ext)) {
                    $size = $file['size'] / 1024 / 1024;
                    if ($size <= $size_allow) {
                        $upload = move_uploaded_file($file['tmp_name'], '../img/uploads/' . $new_file);
                        if (!$upload) {
                            $errror[] = 'upload_err';
                        }
                    } else {
                        $errror[] = 'size_err';
                    }
                } else {
                    $errror[] = 'ext_err';
                }
                $result = $iron->updateUser($conn, $id, $name, $phone, $email, $user, $pass, $pos, $img_final);
                echo '<script>alert("Update User Successfully"); window.location = "user.php";</script>';
            }
            ?>
            <div class="container">
                <div class="add-items">
                    <?php
                    if (isset($_GET['action']) && ($_GET['action']) == 'edit') {
                        $id = $_GET['id'];
                        $_SESSION['id_user'] = $id;
                        $result = $iron->showUserbyID($conn, $id);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="title-form">Update User</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="email">Name</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['name'] ?>" placeholder="Enter Name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Phone</label>
                                                <input type="number" class="form-control width-input" value="<?php echo $row['phone'] ?>" placeholder="Enter Phone" name="phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control width-input" value="<?php echo $row['email'] ?>" placeholder="Enter Email" name="email" required>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="1" name="pos"><span class="marginright-span">Admin</span>
                                                    <input type="radio" class="form-check-input" value="2" name="pos"><span class="marginright-span">Customer</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" value="<?php echo $row['username'] ?>" placeholder="Enter Name" name="user" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" value="<?php echo $row['password'] ?>" placeholder="Enter Name" name="pass" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="avt">Avatar</label>
                                                <input type="file" class="form-control" name="imageFiles" accept=".png, .jpg, .jpeg" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                            <input type="submit" name="update" class="btn btn-primary width-input margintop-btn" id="btncreate" value="Update">
                                        </div>
                                        <div class="col-lg-4"></div>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>

</html>
