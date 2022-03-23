<?php
    include "includes/header.php";

    checkAccess('username', true);
    sendToCategory('category_one');
    redirect('complaints.php');

?>