<?php

// On efface la session
session_start();
$_SESSION = [];
session_destroy();

header('Location: index.php');
exit();