<?php include "includes/header.php";
checkAccess('username', true);
?>

<div class="container">
    <h1>Recent complaints received:</h1>
    <div class="categories_menu">
        <ul>
            <li><a href="send_to_category.php">Category 1</a></li>
            <li><a href="send_to_category_two.php">Category 2</a></li>
            <li id="delete-btn"><a href="delete_complaint.php">Delete</a></li>
        </ul>
    </div>
    <?php listComplaints(); ?>
</div>

<?php include "includes/footer.php" ?>