<?php 
include "includes/header.php"; 
if(!isset($_SESSION['username']) && !isset($_SESSION['email'])) : 
?>

<div class="homepage">
    <h3>Welcome to our CRM system!</h3>
    <p>Improve your user experience!</p>
    <img src="css/images/homepage.png">
</div>

<?php endif;
if(isset($_SESSION['username'])){
    include "admin_screen.php";   
}
elseif(isset($_SESSION['email'])){
    include "user_screen.php";   
}
?>

<?php include "includes/footer.php"; ?>