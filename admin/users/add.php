<?php
$error = array();
if(isset($_GET['error_fields'])){
    $error = explode(",",$_GET['error_fields']);
}
// if(isset($_POST)){
//     echo $_POST['email'];
// }
// value="<?= (isset($_POST['name']))? $_POST['name']:''
?>
<html>
    <body>
        <form method="post" action="add_db.php">
            <input type="text" name="name" id="name" >
            <?php
            if(in_array("name",$error)){
                echo "Enter Your name";
            }

            ?>
            <br>
            <input type="email" name="email" id="email" >
            <?php
            if(in_array("email",$error)){
                echo "Enter Your email";
            }?>
            
            <br>
            <input type="password"  name="password" id="password">
            <?php
            if(in_array("password",$error)){
                echo "Enter Your password";
            }

            ?>
            
            <br>

            <input type="checkbox" name="admin">Admin

            <br>
            <input type="submit" name="submit" value="Register">


        </form>        
    </body>
</html>