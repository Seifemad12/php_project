<?php
$error_validation = array();
if($_SERVER['REQUEST_METHOD']){
    if(! (isset($_POST['name'])) && !empty($_POST['name'])){
        $error_validation[]='name';
    }
    if(! (isset($_POST['email'])) && filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)){
        $error_validation[]='email';
    }
    if(! (isset($_POST['password'])) && strlen($_POST['password'])){
        $error_validation[]='password';
    }
    if($error_validation){
        header("Location: login.php?error_fields=".implode(",",$error_validation));
        exit;
    }
    
    $conn = mysqli_connect("localhost","root","","blog");
    if(! $conn){
        echo mysqli_connect_error();
        exit;
    }
    else{
        $name = mysqli_escape_string($conn,$_POST['name']);
        $email = mysqli_escape_string($conn,$_POST['email']);
        $password = mysqli_escape_string($conn,$_POST['password']);
        $admin = (isset($_POST['admin']))? 1 : 0;
    
        $query = "insert into users (name,email,pass,admin) values('$name','$email','$password','$admin');";
        if(mysqli_query($conn,$query)){
            header("Location: list.php");
            exit;
        }else{
            // echo $query;
            echo mysqli_error($conn);
        }
        mysqli_close ($conn);
    }
}
?>