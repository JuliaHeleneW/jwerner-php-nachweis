<?php

//Session beenden und zum Login-Screen zurückkehren
session_start();
session_destroy();

header("Location:login.php");
?>