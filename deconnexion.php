<?php
require("function.php");
    session_start();
    $_SESSION = array();
    session_destroy();
    redirectTo("index.php");
?>