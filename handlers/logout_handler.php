<?php

$time = time() - 604800;
setcookie('email', 'vvv', $time, '/');

header('location: ../index.php?alert=logout_s');