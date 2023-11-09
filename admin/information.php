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
        <title>Information</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Information</div>
            <div class="container">
                <div class="addproduct-items">
                    <div class="row">
                        <?php
                        if(isset($_POST['save']) && ($_POST['save'])){
                            $name = $_POST['name'];
                            $pass = $_POST['pass'];
                            $cpass = $_POST['cpass'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];
                            
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
                            
                            if($pass == $cpass){
                                $result = $iron->updateInforAdmin($conn, $_SESSION['id_infor'], $name, $pass, $phone, $email, $img_final);
                                echo '<script>alert("Update Information Successfully")</script>';
                                echo '<script>window.location = "./information.php"</script>';
                            }else{
                              echo '<script>alert("Password and Confirm Password Not Match")</script>';  
                            }
                        }
                        ?>
                        <div class="col-lg-12">
                            <p class="title-form">Edit Information</p>
                        </div>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <?php
                                if (isset($_SESSION['useradmin']) && ($_SESSION['useradmin'])) {
                                    $user = $_SESSION['inforadmin'][0];
                                    $pass = $_SESSION['inforadmin'][1];

                                    $result = $iron->checkUser($conn, $user, $pass);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $_SESSION['id_infor'] = $row['id'];
                                            ?>

                                            <div class="form-group">
                                                <label for="text">Name</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['name'] ?>" placeholder="Enter Name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Password</label>
                                                <input type="password" class="form-control width-input" value="<?php echo $row['password'] ?>" placeholder="Enter Type" name="pass" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Confirm Password</label>
                                                <input type="password" class="form-control width-input" value="<?php echo $row['password'] ?>" placeholder="Enter Type" name="cpass" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Phone</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['phone'] ?>" placeholder="Enter Category" name="phone" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Email</label>
                                                <input type="email" class="form-control width-input" value="<?php echo $row['email'] ?>" placeholder="Enter Details" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="infor-items-img marginleft-img">
                                                <img class="infor-changer-avt" id="images" src="<?php echo $row['img'] ?>">
                                                <input type="file" id="imageFiles" name="imageFiles" onchange="chooseFile(this)" class="btnchangavt" accept=".png, .jpg, .jpeg">
                                                <p class="infor-img-accept">Accept: .JPG, .JPEG, .PNG</p>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <input type="submit" value="Save" class="btn btn-primary btn-save-infor" name="save"> 
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function chooseFile(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#images').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
    </div>
</body>
</html>
