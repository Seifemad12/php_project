<?php
//open connection
// $conn = mysqli_connect("localhost","root","","blog");
// if(! $conn){
//     echo mysqli_connect_error();
//     exit;
// }
// else{
//     $query = "select * from users;";
//     $result = mysqli_query($conn, $query);
//     while($row = mysqli_fetch_assoc($result)){
//         echo "Id:".$row['id']."<br />";
//         echo "Name: ".$row[ 'name']."<br />";
//         echo "Email:". $row['email']."<br />";
//         echo str_repeat("-", 50). "<br />";
//     }
//     //Close the connection 
//     mysqli_free_result($result);
//     mysqli_close ($conn);
// }

$error_validation = array();
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

    $query = "insert into users (name,email,pass) values('$name','$email','$password');";
    if(mysqli_query($conn,$query)){
        echo "Saved!";
    }else{
        echo $query;
        echo mysqli_error($conn);
    }
    // $result = mysqli_query($conn, $query);
    // while($row = mysqli_fetch_assoc($result)){
    //     echo "Id:".$row['id']."<br />";
    //     echo "Name: ".$row[ 'name']."<br />";
    //     echo "Email:". $row['email']."<br />";
    //     echo str_repeat("-", 50). "<br />";
    // }
    //Close the connection 
    // mysqli_free_result($result);
    mysqli_close ($conn);
}


?>