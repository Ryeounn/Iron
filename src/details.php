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
        <title>Detail Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <?php
        if(isset($_SESSION['user']) && ($_SESSION['user'])){
            if (isset($_GET['action']) && ($_GET['action'] == 'add')) {
            $id = intval($_GET["id"]);
            $_SESSION['id_product'] = $id;
            if (isset($_SESSION[$_SESSION['user']][$id])) {
                $_SESSION[$_SESSION['user']][$id]['quantity']++;
            } else {
                $result = $iron->findProductById($conn, $id);
                $row = $result->fetch_assoc();
                if (isset($row['id'])) {
                    $_SESSION[$_SESSION['user']][$row['id']] = array("name" => $row['name'], "quantity" => 1, "price" => $row['price'], "image" => $row['img'], "id"=> $row['id']);
                }
            }
        }
        }else{
            echo '<script>alert("Please login!")</script>';
            echo '<script>window.location = "./login.php"</script>';
        }
        ?>
        <div class="container">
            <?php
            if (isset($_SESSION[$_SESSION["user"]]) && $_SESSION[$_SESSION["user"]]) {
                $total_quantity = 0;
                $total_price = 0;
                foreach ($_SESSION[$_SESSION["user"]] as $id => $value) {
                    $arrProductID[] = $id;
                }
                $strIDs = implode(",", $arrProductID);
                $result = $iron->findProductById($conn, $strIDs);
                while ($row = $result->fetch_assoc()) {
                    $total_quantity += $row['quantity'];
                    $total_price += $row['price'] * $_SESSION[$_SESSION["user"]][$row['id']]['quantity'];
                }
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">Detail Product</p>
                </div>
            </div>
            <?php
            $id = $_GET['id'];
            $result = $iron->showDetailbyID($conn,$id);
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="item-img-details">
                        <img class="img-details" src="<?php echo $row['img']?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="title-name-details"><?php echo $row['name']?></p>
                    <p class="margintop-title"><b>Type:</b> <?php echo $row['type']?></p>
                    <p><b>Category:</b> <?php echo $row['category']?></p>
                    <p class=""><b>Detail:</b> <?php echo $row['detail']?></p>
                    <p class=""><b>Size:</b> <?php echo $row['size']?></p>
                    <p class=""><b>Price:</b> <?php echo $row['price']?>.000 VND / <?php echo $row['kg']?> kg</p>
                    <a href="?action=add&id=<?php echo $row['id'] ?>" class="btn btn-primary margintop-btn">Add to cart</a>
                </div>
            </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
