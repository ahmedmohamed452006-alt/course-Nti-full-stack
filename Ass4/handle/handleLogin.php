<?php
require_once '../dbc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email    = mysqli_real_escape_string($connection , trim($_POST['email']));
    $password = $_POST['password'];

    //validation
    $errors = [];
    if(empty($email) || strlen($email) > 100 || !filter_var($email , FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email";
    }
    if(empty($password) || strlen($password) > 50){
        $errors[] = "Invalid password";
    }

    if(!empty($errors)){
        $_SESSION['errors'] = implode(' - ' , $errors);
        header('location:../login.php');
        exit();
    }

    $query  = "SELECT * FROM `customers2` WHERE email = '$email'";
    $result = mysqli_query($connection , $query);
    $user   = mysqli_fetch_assoc($result);

    if($user && !empty($user['password']) && password_verify($password , $user['password'])){
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['success']   = "login Successfully";
        header('location:../home.php');
        exit();
    }
    else{
        $_SESSION['errors'] = "Invalid email or password";
        header('location:../login.php');
        exit();
    }

}else{
    echo "method Should be POST";
}
