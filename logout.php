<?php
session_start();
unset($_SESSION['P29']);
session_destroy();
header("Location: ./index.php");
?>