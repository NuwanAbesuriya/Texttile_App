<?php

if (!isset($_SESSION["customer"])) {
    header("Location: ../view/login.php");
}
