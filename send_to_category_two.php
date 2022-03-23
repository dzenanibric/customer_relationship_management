<?php
    include "includes/header.php";

    checkAccess('username', true);
    sendToCategory('category_two');
    redirect('complaints.php');

?>