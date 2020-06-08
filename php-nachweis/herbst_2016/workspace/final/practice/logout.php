<?php
session_start();
session_destroy();

header("Location:program1.php");
?>