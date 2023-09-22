<!-- <?php 
    $servername = "localhost";
    $userdb = "root";
    $passdb = "";
    $dbname = "pharmazy";
    $conn = mysqli_connect($servername,$userdb,$passdb,$dbname);
    
    //check connection
    if(!$conn){
        die("Connection failed!" . mysqli_connect_error());
    }
?> -->

<?php
    $servername = "localhost";
    $userdb = "root";
    $passdb = "";
    $dbname = "pharmazy";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;",$userdb,$passdb);
        //set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Connection Failed".$e->getMessage();
    }
?>