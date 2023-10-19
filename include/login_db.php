<?php
    session_start();
    include('functions.php');
    // header('Content-Type: application/json');
    if (isset($_POST['signin'])) { 
        $Username = $_POST['u_username'];
        $Password = $_POST['u_password'];

        //change $_SESSION to JS validation

        // if(empty($Username)) {
        //     $_SESSION['warning_username'] = 'Please enter your username.';
        //     header("location: ../login.php");
        // }else if(empty($Password)) {
        //     $_SESSION['warning_password'] = 'Please enter your password.';
        //     header("location: ../login.php");
        // }else{
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
                                header("location: ../admin/admin.php");
                            }else{
                                $_SESSION['user_login'] = $row['uid'];//take session login from uid
                                header("location: ../index.php");
                            }
                        }else{
                            $_SESSION['error_password'] = 'Wrong password!';
                            header("location: ../login.php");
                        }
                    }else{
                        $_SESSION['error_username'] = 'Wrong username!';
                        header("location: ../login.php");
                    }
                } else {
                    $_SESSION['error_found'] = "No results Found!";
                    header("location: ../login.php");
                }

            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    // }
?>