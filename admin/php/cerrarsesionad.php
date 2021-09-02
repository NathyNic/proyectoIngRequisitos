<?php
session_start();
unset($_SESSION['datos_logad']);
header("Location: ../login.php");
