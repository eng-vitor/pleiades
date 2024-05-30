<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

if(isset($_GET['protocolticket'])){
    $Protocol = $_GET['protocolticket'];
    unset($_SESSION['DataTicketSelected'], $_SESSION['DataTicketChatSelected']);

    $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND protocolo='".$Protocol."'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
    
    if($TicketInfoResult==1){

        $_SESSION['DataTicketSelected'] = mysqli_fetch_assoc($TicketInfoExec);

        $TicketChatQuery = "SELECT id,msgcontent,isfile,enviadapor,namesended,socialsended,datamsg FROM chat WHERE ticketprotocolo='".$Protocol."' ORDER BY datamsg ASC";
        $TicketChatExec = mysqli_query($CONNECTION_DB, $TicketChatQuery);
        for($j=0; $j<mysqli_num_rows($TicketChatExec); $j++){
            $DataTools = mysqli_fetch_assoc($TicketChatExec);
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['msgcontent'];
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['isfile'];
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['enviadapor'];
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['namesended'];
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['socialsended'];
            $_SESSION['DataTicketChatSelected'][$j][] = $DataTools['datamsg'];
        
        }
        $_SESSION['DataTicketChatSelected']['CountMsgs'] = mysqli_num_rows($TicketChatExec);
        header("Location: ../pages/Ticket.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Este Ticket não existe ou é inválido!</div>';
        header("Location: ../pages/MyTickets.php");
        exit();
    }
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou um ticket</div>';
    header("Location: ../pages/MyTickets.php");
    exit();
}
mysqli_close($CONNECTION_DB);