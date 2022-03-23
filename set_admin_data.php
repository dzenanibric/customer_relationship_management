<?php
    include "includes/header.php";

    checkAccess('username', false);
    checkAccess('email', false);
    setAdminData();
    sendPassword(getPassword());
    redirect('adminlogin.php');
?>