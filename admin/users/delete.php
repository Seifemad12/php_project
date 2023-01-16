<?php
$conn = mysqli_connect("localhost", "root", "", "blog");
if (! $conn) {
    echo mysqli_connect_error();
    exit;
}
//Select the user S GETTid
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_NUMBER_INT);
$query = "delete from users where id = '$id' limit 1;";
if(mysqli_query($conn, $query) ){
    header("Location: list.php");
    // include('list.php');
    exit;
} 
else
{
//echo $query;
    echo mysqli_error($conn);
//Close the connection 
    mysqli_close($conn);
}
?>