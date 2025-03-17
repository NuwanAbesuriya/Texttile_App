<?php

session_start();

if (isset($_SESSION["customer"])) {
    header("Location: view/dashboard.php");
} else {
    header("Location: view/home.php");
}
