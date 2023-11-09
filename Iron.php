<?php

class Iron{
    public function checkUser($conn, $user, $pass) {
        $sql = "select * from user where username = '" . $user . "' and password = '" . $pass . "'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showProduct($conn, $key) {
        if ($key != '' && $key != 1) {
            $sql = "select * from product where category like '%".$key."%'";
        } else if ($key == '' || $key == 1) {
            $sql = "select * from product";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countProduct($conn) {
        $sql = "select count(id) from product";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function sumQuantity($conn) {
        $sql = "select sum(quantity) from product";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function createProduct($conn, $name, $phone, $email, $user, $pass, $role, $img) {
        $sql = "insert into user(name,phone,email,username,password,role,img) value ('$name','$phone','$email','$user','$pass','$role','$img')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countUser($conn) {
        $sql = "select count(id) from user";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countCustomer($conn) {
        $sql = "select count(id) from user where role = 2";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countAdmin($conn) {
        $sql = "select count(id) from user where role = 1";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showUser($conn, $key) {
        if ($key != '' && $key != 1) {
            $sql = "select * from user where name like '%".$key."%'";
        } else if ($key == '' || $key == 1) {
            $sql = "select * from user";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function deleteUser($conn,$id) {
        $sql = "delete from user where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showUserbyID($conn, $id) {
        $sql = "select * from user where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateUser($conn, $id, $name, $phone, $email, $user, $pass, $pos, $img) {
        $sql = "update user set name='$name',phone='$phone',email='$email',username='$user',password='$pass',role='$pos',img='$img' where id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function deleteProduct($conn,$id) {
        $sql = "delete from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addProduct($conn,$name,$type,$cate,$details,$price,$quan,$size,$kg,$img) {
        $sql = "insert into product(name,type,category,detail,price,quantity,size,kg,img) values('$name','$type','$cate','$details','$price','$quan','$size','$kg','$img')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countOrder($conn) {
        $sql = "select count(orderID) from orders";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countAccept($conn) {
        $sql = "select count(orderID) from orders where st='done'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countPending($conn) {
        $sql = "select count(orderID) from orders where st='pending'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrder($conn, $key) {
        if ($key != '' && $key != 1) {
            $sql = "select * from orders,orderdetails where orders.orderID = orderdetails.orderID and st like '%".$key."%'";
        } else if ($key == '' || $key == 1) {
            $sql = "select * from orders,orderdetails where orders.orderID = orderdetails.orderID";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderPending($conn,$st) {
        $sql = "select orders.orderID,user.id,user.name,user.phone,user.email,orders.date,orders.st from orders,user where orders.userID = user.id and orders.st = '$st'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateStatus($conn,$st,$id) {
        $sql = "update orders set st = '$st' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateStatusRefuse($conn,$st,$id) {
        $sql = "update orders set st = '$st' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderDetailbyID($conn, $id) {
        $sql = "select st from orders where orderID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateStatusOrder($conn,$id,$st) {
        $sql = "update orders set st='$st' where orderID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showProductbyID($conn, $id) {
        $sql = "select * from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateProduct($conn,$id,$name,$type,$category,$detail,$price,$quantity,$size,$kg,$img) {
        $sql = "update product set name='$name',type='$type',category='$category',detail='$detail',price='$price',quantity='$quantity',kg='$kg',size='$size',img='$img' where id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateInforAdmin($conn,$id,$name,$pass,$phone,$email,$img) {
        $sql = "update user set name='$name',password='$pass',phone='$phone',email='$email',img='$img' where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showContact($conn) {
        $sql = "select * from contact";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addContact($conn,$name,$phone,$email,$note,$date) {
        $sql = "insert into contact(name,phone,email,note,date) values('$name','$phone','$email','$note','$date')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function registerCustomer($conn,$name,$user,$pass,$phone,$email) {
        $sql = "insert into user(name,username,password,phone,email,role) values('$name','$user','$pass','$phone','$email','2')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function findPass($conn,$user,$email,$phone) {
        $sql = "select * from user where username='$user' and email='$email' and phone='$phone' ";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showProductClient($conn, $iddm) {
        if($iddm == 0 || $iddm == ''){
            $sql = "select * from product";
        }else if($iddm == 1){
            $sql = "select * from product where category='Circle'";
        }else if($iddm == 2){
            $sql = "select * from product where category='Equilateral Triangle'";
        }else if($iddm == 3){
            $sql = "select * from product where category='Unfinished Iron and Steel'";
        }else if($iddm == 4){
            $sql = "select * from product where category='Letter C'";
        }else if($iddm == 5){
            $sql = "select * from product where category='Rectangle'";
        }else if($iddm == 6){
            $sql = "select * from product where category='Square'";
        }else if($iddm == 7){
            $sql = "select * from product where category='Straight'";
        }else if($iddm == 8){
            $sql = "select * from product order by price asc";
        }else if($iddm == 9){
            $sql = "select * from product where price < 50 order by price asc";
        }else if($iddm == 10){
            $sql = "select * from product where price < 100 order by price asc";
        }else if($iddm == 11){
            $sql = "select * from product where price > 100 order by price asc";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showDetailbyID($conn, $id) {
        $sql = "select * from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function findProductById($conn,$id) {
        $sql = "select * from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addOrder($conn,$st,$date,$user) {
        $sql = "insert into orders(userID,date,st) values ('$user','$date','$st')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addOrdersDetails($conn,$product,$price,$quantity) {
        $last = mysqli_insert_id($conn);
        $sql = "insert into orderdetails(orderID,productName,price,quantity) values ('$last','$product','$price','$quantity')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function findCustomerbyPhone($conn, $phone, $email) {
        $sql = "select * from user where phone = '$phone' and email = '$email'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateInformationCustomer($conn,$name,$phone,$email,$pass,$img,$id) {
        $sql = "update user set name='$name',phone='$phone',email='$email',password='$pass',img='$img' where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderDetail($conn) {
        $sql = "select * from orderdetails";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showBestSeller($conn) {
        $sql = "select * from product where id > 2 and id < 7";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countIDOrder($conn,$user) {
        $sql = "select count(userID) from orders where userID = '$user'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showParaOrder($conn, $start, $limit, $user) {
        $sql = "select * from orders where userID = '$user' order by date asc limit $start,$limit";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showPara($conn, $start, $limit) {
        $sql = "select * from notifications order by date asc limit $start,$limit";
        $result = $conn->query($sql);
        return $result;
    }
}

