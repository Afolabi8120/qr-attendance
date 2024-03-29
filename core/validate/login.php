<?php
    include('../core/init.php');

    if(isset($_POST['btnLogin']) AND !empty($_POST['btnLogin'])){
       
        $email = $globalclass->validateInput($_POST['email']);
        $password = $globalclass->validateInput($_POST['password']);

        if(empty($email) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            $hash_password = sha1(md5($password));
            $pass = substr($hash_password, 3, 12);

            if($globalclass->login($email,$pass) === true){ 
                    
                $getlogin = $globalclass->selectByOneColumn('email','tbluser',$email);

                if($getlogin->usertype == "Admin"){
                    $_SESSION['user'] = $getlogin->email;
                    header('location: dashboard');
                }elseif($getlogin->usertype == "Lecturer"){
                    $_SESSION['lecturer'] = $getlogin->email;
                    header('location: dashboard');
                }
                

            }else{
                $_SESSION['ErrorMessage'] = "Invalid Details Provided";
            }
        }
    }elseif(isset($_POST['btnForgetPassword'])){
       
        $email = $globalclass->validateInput($_POST['email']);

        if(empty($email)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{
            if($globalclass->checkEmail($email) === true){
                $_SESSION['reset-email'] = $email;
                header('location: reset-password');
            }else{
                $_SESSION['ErrorMessage'] = "Invalid Email Address Provided";
            }

        }
    }elseif(isset($_POST['btnResetPassword'])){
       
        $password = $globalclass->validateInput($_POST['password']);
        $cpassword = $globalclass->validateInput($_POST['cpassword']);

        if(empty($cpassword) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }elseif($password != $cpassword){
            $_SESSION['ErrorMessage'] = "Both Password Provided Do Not Match";
        }else{
            $email = $_SESSION['reset-email'];
            $pass = md5($password);

            if($globalclass->updateResetPassword($email,$pass)){
                $_SESSION['SuccessMessage'] = "Password Has Been Changed Successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Failed To Change Password";
            }

        }
    }

?>