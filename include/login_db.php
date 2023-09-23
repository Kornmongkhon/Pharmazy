<?php
    session_start();
    include('functions.php');

    if (isset($_POST['signin'])) {
        $Username = $_POST['u_username'];
        $Password = $_POST['u_password'];

        session_unset(); // clear prev session data

        if(empty($Username)) {
            $_SESSION['warning_username'] = 'กรุณากรอกสมาชิก';
            header("location: ../login.php");
        }else if(empty($Password)) {
            $_SESSION['warning_password'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ../login.php");
        }else{
            try{
                $check_data = $pdo->prepare("SELECT * FROM users WHERE u_username = :u_username");
                $check_data->bindParam(":u_username", $Username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if($check_data->rowCount() > 0) {
                    if($Username == $row['u_username']){
                        if(password_verify($Password,$row['u_password'])){
                            if($row['urole'] == 'admin'){//role admin
                                $_SESSION['admin_login'] = $row['uid'];//take session login from uid
                                header("location: ../admin.php");
                            }else{
                                $_SESSION['user_login'] = $row['uid'];//take session login from uid
                                header("location: ../index.php");
                                
                            }
                        }else{
                            $_SESSION['error_password'] = 'รหัสผ่านผิด';
                            header("location: ../login.php");
                        }
                    }else{
                        $_SESSION['error_username'] = 'สมาชิกผิด';
                        header("location: ../login.php");
                    }
                } else {
                    $_SESSION['error_found'] = "ไม่มีข้อมูลในระบบ";
                    header("location: ../login.php");
                }

            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>