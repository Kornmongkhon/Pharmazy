<?php 
    session_start();
    include('functions.php');

    if (isset($_POST['signup'])) { //when hit button sighup
        $Fullname = $_POST['u_name'];
        $Username = $_POST['u_username'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $PhoneNum = $_POST['phone'];
        $Password = $_POST['u_password'];
        $C_password = $_POST['c_password'];
        $Gender = $_POST['gender'];
        $Urole = 'user';
        $defaultAvatars = [ //set default avatar url
            'male' => 'assets/avatar/male.png',
            'female' => 'assets/avatar/female.png',
        ];

        if(isset($Gender) && array_key_exists($Gender,$defaultAvatars)){//check if $Gender equal $defaultAvatars take url avatar to new var
            $Avatar = $defaultAvatars[$Gender];
        } 


        if(empty($Fullname)) {
            $_SESSION['warning_name'] = 'Please enter your name';
            header("location: ../register.php");
        }else if(empty($Username)) {
            $_SESSION['warning_username'] = 'Please enter your username';
            header("location: ../register.php");
        }else if(empty($Email)) {
            $_SESSION['warning_email'] = 'Please enter your email';
            header("location: ../register.php");
        }else if(empty($Address)){
            $_SESSION['warning_address'] = 'Please enter your address';
            header("location: ../register.php");
        }else if(empty($PhoneNum)){
            $_SESSION['warning_phone'] = 'Please enter your phone number';
            header("location: ../register.php");
        }else if(empty($Password)){
            $_SESSION['warning_password'] = 'Please enter your password';
            header("location: ../register.php");
        }else if(empty($C_password)) {
            $_SESSION['warning_cpassword'] = 'Please enter your confirm password';
            header("location: ../register.php");
        }else if($Password != $C_password) {
            $_SESSION['warning_inpass'] = 'Password not match';
            header("location: ../register.php");
        }
        else if(empty($Gender)){
            $_SESSION['warning_gender'] = 'Please enter your gender';
            header("location: ../register.php");
        }
        else{
            try{
                $check_user = $pdo->prepare("SELECT u_username FROM users WHERE u_username = :u_username"); // search username
                $check_user->bindParam(":u_username", $Username);
                $check_user->execute();
                $row = $check_user->fetch(PDO::FETCH_ASSOC);

                if($row['u_username'] == $Username){
                    $_SESSION['error_already'] = "มีสมาชิกนี้อยู่ในระบบแล้ว";
                    header("location: ../register.php");
                }else if(!isset($_SESSION['error_already'])) {
                    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users(u_name, u_username, email, address, phone, u_password, gender, urole, avatar) 
                                            VALUES(:u_name, :u_username, :email, :address, :phone, :u_password, :gender, :urole, :avatar)");
                    $stmt->bindParam(":u_name", $Fullname);
                    $stmt->bindParam(":u_username", $Username);
                    $stmt->bindParam(":email", $Email);
                    $stmt->bindParam(":address", $Address);
                    $stmt->bindParam(":phone", $PhoneNum);
                    $stmt->bindParam(":u_password", $passwordHash);
                    $stmt->bindParam(":gender", $Gender);
                    $stmt->bindParam(":urole", $Urole);
                    $stmt->bindParam(":avatar", $Avatar);
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