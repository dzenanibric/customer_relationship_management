<?php include "includes/header.php"; 
checkAccess('username', true);
addUser();
displayMessage();
?>

<div class="add_user_form">
    <form method="POST">
        <input type = "text" placeholder = "Name" name = "first_name">
        <input type = "text" placeholder = "Last name" name = "last_name">
        <input type = "email" placeholder = "Email" name = "email">
        <input type = "password" placeholder = "Password" name = "password">
        <input type = "password" placeholder = "Confirm password" name = "confirm_password">
        <input type = "submit" value = "Add" name = "add-user-btn">
    </form>
</div>

<?php include "includes/footer.php"; ?>