<?php
    session_start();
    include('functions.php');
    if(isset($_POST['signup'])){
        $Fullname = $_POST['u_name'];
        $Username = $_POST['u_username'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $PhoneNum = $_POST['phone'];
        $Password = $_POST['u_password'];
        $C_Password = $_POST['c_password'];
        $Urole = 'user';
        $Gender = $_POST['gender'];

        if(empty($Fullname)){
            $_SESSION['warning'] = 'Please fill Full Name!';
            header("location: ../register.php");
        }
        else if(empty($Username)){
            $_SESSION['warning'] = 'Please fill Username!';
            header("location: ../register.php");
        }
        else if(empty($Email)){
            $_SESSION['warning'] = 'Please fill Email!';
            header("location: ../register.php");
        }
        else if(empty($Address)){
            $_SESSION['warning'] = 'Please fill Address!';
            header("location : ../register.php");
        }
        else if(empty($PhoneNum)){
            $_SESSION['warning'] = 'Please fill Phone Number!';
            header("location: ../register.php");
        }
        else if(empty($Password)){
            $_SESSION['warning'] = 'Please fill Password!';
            header("location: ../register.php");
        }
        else if(empty($C_Password)){
            $_SESSION['warning'] = 'Please fill Confirm Password!';
            header("location: ../register.php");
        }
        else if(empty($Gender)){
            $_SESSION['warning'] = 'Please fill Gender!';
            header("location: ../register.php");
        }
        else if($Password != $C_Password){
            $_SESSION['error'] = 'Password not match!';
            header("location: ../register.php");
        }
        else if(!empty($Fullname)&&!empty($Username)&&!empty($Email)&&!empty($Address)&&!empty($PhoneNum)&&!empty($Password)&&!empty($C_Password)&&!empty($Gender)){
            try{
                $check_username = $conn->prepare("SELECT u_username FROM users WHERE u_username = :u_username"); //check username from db :u_username is placeholder (sql injection protect)
                $check_username->bindParam(":u_username",$Username);
                $check_username->execute();
                $row = $check_username->fetch(PDO::FETCH_ASSOC);

                if($row['u_username'] == $Username){
                   $_SESSION['warning'] = "Have this username <a href='login.php'>Login Here</a>";
                   header("location: ../register.php");
                }
                else if(!isset($_SESSION['error'])){
                    $password_Hash=password_hash($password, PASSWORD_BCRYPT);//encrypt password
                    $stmt = $conn->prepare("INSERT INTO users(u_username,u_password,u_name,email,address,phone,gender,urole) VALUES(:u_username, :u_password, :u_name, :email, :address, :phone, :gender, :urole)");
                    $stmt->bindParam(":u_username",$Username);
                    $stmt->bindParam(":u_password",$password_Hash);
                    $stmt->bindParam(":u_name",$Fullname);
                    $stmt->bindParam(":email",$Email);
                    $stmt->bindParam(":address",$Address);
                    $stmt->bindParam(":phone",$PhoneNum);
                    $stmt->bindParam(":gender",$Gender);
                    $stmt->bindParam(":urole",$Urole);
                    $stmt->execute();//process
                    $_SESSION['success'] = "Register Success! <a href='login.php' class='alert-link'>Login Here</a>";
                    header("location: ../register.php");
                }else{
                    $_SESSION['error'] = "Something went wrong!";
                    header("location: ../register.php");
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>
