<?php 
    include 'config.php';
    include 'function.php';
    session_start();

    if (isset($_POST['username']) && $_POST['username'] != '' && 
        isset($_POST['email']) && $_POST['email'] != '' && 
        isset($_POST['name']) && $_POST['name'] != '' && 
        isset($_POST['phone']) && $_POST['phone'] != '' &&
        isset($_POST['idcar']) && $_POST['idcar'] != '' &&  
        isset($_POST['address']) && $_POST['address'] != '' && 
        isset($_POST['password']) && $_POST['password'] != '' && 
        isset($_POST['repassword']) && $_POST['repassword'] != ''
    ) {
        // thực hiện xử lý khi người dùng ấn nút submit và điền đủ thông tin
        $username = $_POST["username"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $idcar = $_POST["idcar"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
   

        if ($password != $repassword) {
            warning("Mật khẩu không khớp.");
        }

        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        $old = mysqli_query($conn, $sql);
        $hash = md5($password);
        if (mysqli_num_rows($old) > 0) {
            warning("Tài khoản đã có người đăng kí.");
        }
        // check khớp mã xe
        $sql = "SELECT  idcar FROM `product` WHERE idcar = '$idcar'";
        $old = mysqli_query($conn, $sql);
        $hash = md5($password);
        if (mysqli_num_rows($old) < 1 ) {
            warning("Mã xe không khớp");
        }

    

        $sql = "INSERT INTO `user`(`username`, `name`,`email`,`phone`,`idcar`,`address`, `password`) VALUES ('$username','$name','$email','$phone','$idcar','$address','$hash')";
        mysqli_query($conn, $sql);
        success("Đăng kí tài khoản thành công");

    }
?>