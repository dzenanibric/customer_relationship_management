<?php

include "includes/header.php";

checkAccess('username', true);
checkAccess('email', true);
deleteComplaint();
redirect('complaints.php');

?>