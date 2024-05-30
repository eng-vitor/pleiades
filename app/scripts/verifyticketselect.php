<?php
if(!isset($_SESSION['DataTicketChatSelected'])){
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou um ticket</div>';
    header("Location: MyTickets.php");
    exit();
}