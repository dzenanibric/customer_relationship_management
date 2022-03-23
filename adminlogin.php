<?php
include "includes/header.php";
checkAccess('username', false);
checkAccess('email', false);
validateAdminLogin();
displayMessage();
?>

<a id="snd-pass-btn" href="set_admin_data.php">Send Password</a>

<div class="login_form">
    <form method = "POST">
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" placeholder="Login" name="submit" value = "Login"> 
    </form>
</div>

<?php include "includes/footer.php"; ?>