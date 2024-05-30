<?php
if(substr($_SERVER['SCRIPT_NAME'], strlen($_SERVER['SCRIPT_NAME']) - 10) === substr(__FILE__, strlen(__FILE__) - 10)) {
    header("Location: ../pages/Error_404.php");
    exit();
}else{
	include __DIR__.'/../config.php';
	if(isset($errordb)){
		header("Location: ../pages/Error_404.php");
		exit();
	}
}