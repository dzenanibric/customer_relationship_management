<?php include "includes/header.php"; 
checkAccess('email', false);
checkAccess('username', false);
validateUserLogin();
displayMessage();
?>

<div class="user_login_form">
    <form method="POST">
        <input type = "email" placeholder = "Email" name = "email">
        <input type = "password" placeholder = "Password" name = "password">
        <input type = "submit" value = "Login" name = "user-login-btn">
    </form>
</div>

<?php include "includes/footer.php"; ?>