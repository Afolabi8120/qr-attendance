<?php

    include('../core/init.php');
    session_destroy();
    session_start();
    $_SESSION['SuccessMessage'] = "Logout Successful";
    header('location: index');

?>