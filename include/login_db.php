<?php 

    session_start();
    include('functions.php');

    if (isset($_POST['signin'])) {
        $username = $_POST['u_username'];
        $password = $_POST['u_password'];

      
        if(empty($username)){
            $_SESSION['warning'] = 'Please fill Username!';
            header("location: ../login.php");
        } else if(empty($password)){
            $_SESSION['warning'] = 'Please fill Password!';
            header("location: ../login.php");
        }else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE u_username = :u_username");
                $check_data->bindParam(":u_username", $username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {
                    if ($username == $row['u_username']) {
                        if (password_verify($password, $row['u_password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['uid'];
                                header("location: ../admin.php");
                            } else {
                                $_SESSION['user_login'] = $row['uid'];
                                header("location: ../index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'Wrong Password!';
                            // $passIsValid = password_verify($password, $row['u_password']);
                            // echo $passIsValid ? 'true' : 'false';
                            header("location: ../login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Wrong Username!';
                        header("location: ../login.php");
                    }
                } else {
                    $_SESSION['error'] = "Don't Have this account!";
                    header("location: ../login.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>