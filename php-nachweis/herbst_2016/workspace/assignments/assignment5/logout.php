<?php

//Session beenden und zu Login zurückkehren
session_start();
session_destroy();

header("Location:login.php");
?>