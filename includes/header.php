<?php include "functions/init.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Customer Relationship Management</title>
</head>
<body>
        <div class="container">
            <div class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if(!isset($_SESSION['username']) && !isset($_SESSION['email'])) : ?>
                    <li><a href="login.php">User Login</a></li>
                    <li><a href="adminlogin.php">Admin Login</a></li>
                    <?php elseif(isset($_SESSION['username']) || isset($_SESSION['email'])) : ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        
    