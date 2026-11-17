<?php
require_once '../dbc.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name     = mysqli_real_escape_string($connection , trim($_POST['name']));
    $email    = mysqli_real_escape_string($connection , trim($_POST['email']));
    $password = $_POST['password'];

    //validation
    $errors = [];
    if(strlen($name) < 2 || strlen($name) > 100 || !preg_match('/^[\p{L}\s.\'-]+$/u' , $name)){
        $errors[] = "Name must be 2-100 letters";
    }
    if(strlen($email) > 100 || !filter_var($email , FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email";
    }
    if(strlen($password) < 6 || strlen($password) > 50){
        $errors[] = "Password must be 6-50 characters";
    }

    if(empty($errors)){
        $check = mysqli_query($connection , "SELECT id FROM `customers2` WHERE email = '$email'");
        if(mysqli_num_rows($check) > 0){
            $errors[] = "Email already registered";
        }
    }

    if(!empty($errors)){
        $_SESSION['errors'] = implode(' - ' , $errors);
        header('location:../register.php');
        exit();
    }

    $password = password_hash($password , PASSWORD_DEFAULT);

    $query = "INSERT INTO customers2(`name`,`email`,`password`,`salary`,`city`)
    VALUES('$name' , '$email' , '$password' , 0 , 'Cairo')";

    $result = mysqli_query($connection , $query);
    if($result){
        $_SESSION['success'] = "Register Successfully";
        header('location:../login.php');
        exit();
    }
    else{
        $_SESSION['errors'] = "no data inserted";
        header('location:../register.php');
        exit();
    }

}else{
    echo "method Should be POST";
}
