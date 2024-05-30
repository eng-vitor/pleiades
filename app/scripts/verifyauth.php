<?php 
if(!isset($_SESSION['DataAccount']['id'])){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não está logado!</div>';
    header("Location: ../index.php");
    exit();
}