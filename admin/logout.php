<?php

session_start();
session_unset();
session_destroy();
header("Location: /crud/admin/login.php");
exit();
?>