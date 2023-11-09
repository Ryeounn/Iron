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
        <title>Edit Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <?php
            if (isset($_POST['update']) && ($_POST['update'])) {
                $name = $_POST['name'];
                $type = $_POST['type'];
                $category = $_POST['category'];
                $detail = $_POST['detail'];
                $price = $_POST['price'];
                $quan = $_POST['quan'];
                $size = $_POST['size'];
                $kg = $_POST['kg'];

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
                $result = $iron->updateProduct($conn, $_SESSION['id_product'], $name, $type, $category, $detail, $price, $quan, $size, $kg, $img_final);
                echo '<script>alert("Update Product Successfully"); window.location = "product.php";</script>';
            }
            ?>
            <<div class="text">Edit Product</div>
            <div class="container">
                <div class="addproduct-items"><?php
                    if (isset($_GET['action']) && ($_GET['action'] == 'edit')) {
                        $id = $_GET['id'];
                        $_SESSION['id_product'] = $id;

                        $result = $iron->showProductbyID($conn, $id);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="title-form">Update Product</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="text">Name</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['name'] ?>" placeholder="Enter Name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Type</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['type'] ?>" placeholder="Enter Type" name="type" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Category</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['category'] ?>" placeholder="Enter Category" name="category" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Details</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['detail'] ?>" placeholder="Enter Details" name="detail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Price</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['price'] ?>" placeholder="Enter Price" name="price" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Quantity</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['quantity'] ?>" placeholder="Enter Quantity" name="quan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Size</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['size'] ?>" placeholder="Enter Size" name="size" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="number">Kg</label>
                                                <input type="text" class="form-control width-input" value="<?php echo $row['kg'] ?>" placeholder="Enter Kg" name="kg" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="file">File</label>
                                                <input type="file" class="form-control width-input" placeholder="Enter Image" name="imageFiles" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <input type="submit" name="update" class="btn btn-primary width-input margintop-btn" id="btncreate" value="Create">
                                        </div>
                                        <div class="col-lg-3"></div>
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
