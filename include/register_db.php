<?php 
    session_start();
    include('functions.php');

    if (isset($_POST['signup'])) {
        $Fullname = $_POST['u_name'];
        $Username = $_POST['u_username'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $PhoneNum = $_POST['phone'];
        $Password = $_POST['u_password'];
        $C_password = $_POST['c_password'];
        $Gender = $_POST['gender'];
        $Urole = 'user';

        if(empty($Fullname)) {
            $_SESSION['warning'] = 'กรุณากรอกชื่อ';
            header("location: ../register.php");
        }else if(empty($Username)) {
            $_SESSION['warning'] = 'กรุณากรอกสมาชิก';
            header("location: ../register.php");
        }else if(empty($Email)) {
            $_SESSION['warning'] = 'กรุณากรอกอีเมล';
            header("location: ../register.php");
        }else if(empty($Address)){
            $_SESSION['warning'] = 'กรุณากรอกที่อยู่';
            header("location: ../register.php");
        }else if(empty($PhoneNum)){
            $_SESSION['warning'] = 'กรุณากรอกเบอร์โทรศัพท์';
            header("location: ../register.php");
        }else if(empty($Password)){
            $_SESSION['warning'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ../register.php");
        }else if(empty($C_password)) {
            $_SESSION['warning'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: ../register.php");
        }else if($Password != $C_password) {
            $_SESSION['warning'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: ../register.php");
        }else if(empty($Gender)){
            $_SESSION['warning'] = 'กรุณาระบุเพศ';
            header("location: ../register.php");
        }else{
            try{
                $check_user = $pdo->prepare("SELECT u_username FROM users WHERE u_username = :u_username");
                $check_user->bindParam(":u_username", $Username);
                $check_user->execute();
                $row = $check_user->fetch(PDO::FETCH_ASSOC);

                if($row['u_username'] == $Username){
                    $_SESSION['warning'] = "มีสมาชิกนี้อยู่ในระบบแล้ว <a href='login.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: ../register.php");
                }else if(!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users(u_name, u_username, email, address, phone, u_password, gender, urole) 
                                            VALUES(:u_name, :u_username, :email, :address, :phone, :u_password, :gender, :urole)");
                    $stmt->bindParam(":u_name", $Fullname);
                    $stmt->bindParam(":u_username", $Username);
                    $stmt->bindParam(":email", $Email);
                    $stmt->bindParam(":address", $Address);
                    $stmt->bindParam(":phone", $PhoneNum);
                    $stmt->bindParam(":u_password", $passwordHash);
                    $stmt->bindParam(":gender", $Gender);
                    $stmt->bindParam(":urole", $Urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='login.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: ../register.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ../register.php");
                }

            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>