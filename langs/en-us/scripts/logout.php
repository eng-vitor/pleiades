<?php
session_start();
include __DIR__.'/../scripts/verifyauth.php';
session_destroy();
header("Location: ../index.php");
exit();