<?php
$contrasena = 'password123';
$hash = password_hash($contrasena, PASSWORD_DEFAULT);
echo $hash;
?>