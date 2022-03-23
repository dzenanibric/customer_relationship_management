<?php

include "includes/header.php";

checkAccess('username', true);
resetCrm();
redirect('index.php');

?>