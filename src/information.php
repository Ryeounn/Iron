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
        <title>Information</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>

        <?php
        if (isset($_POST['save']) && ($_POST['save'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

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
            $result = $iron->updateInformationCustomer($conn, $name, $phone, $email, $pass, $img_final, $_SESSION['id_users']);
            echo '<script>alert("Update Information Successfully!")</script>';
            
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">MY ACCOUNT</p>
                </div>
            </div>
            <?php
            if (isset($_SESSION['user']) && ($_SESSION['user'])) {
                $result = $iron->checkUser($conn, $_SESSION['infor'][0], $_SESSION['infor'][1]);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['id_users'] = $row['id'];
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img class="img-infor-cus" id="image" onchange="chooseFile(this)" src="<?php echo $row['img'] ?>">

                                    <ul id="information-list">
                                        <li><a href="information.php">My Information</a></li>
                                        <li><a href="myorder.php">My Order</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="email">Name:</label>
                                        <input type="text" class="form-control" value="<?php echo $row['name']?>" name="name" placeholder="Enter name" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Phone:</label>
                                        <input type="number" class="form-control" value="<?php echo $row['phone']?>" name="phone" placeholder="Enter phone" id="pwd">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Email:</label>
                                        <input type="email" class="form-control" value="<?php echo $row['email']?>" name="email" placeholder="Enter email" id="pwd">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input type="password" class="form-control" value="<?php echo $row['password']?>" name="pass" placeholder="Enter pass" id="pwd">
                                    </div>
                                    <input type="submit" class="btn btn-primary btninfor-save" name="save" value="Save">
                                </div>
                                <div class="col-lg-3">
                                    <div class="infor-items-img fix-div-img">
                                        <img class="infor-changer-avt" id="images" onchange="chooseFile(this)" src="<?php echo $row['img'] ?>">
                                        <input type="file" id="imageFiles" name="imageFiles" onchange="chooseFile(this)" class="btnchangavt" accept=".png, .jpg, .jpeg">
                                        <p class="infor-img-accept">Accept: .JPG, .JPEG, .PNG</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </form>
            <script>
                            function chooseFile(fileInput) {
                                if (fileInput.files && fileInput.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#image').attr('src', e.target.result);
                                        $('#images').attr('src', e.target.result);
                                        $('#imageFiles').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(fileInput.files[0]);
                                }
                            }
            </script>
        </div>
    </body>
</html>
