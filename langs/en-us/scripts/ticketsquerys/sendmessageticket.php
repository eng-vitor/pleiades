<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifyticketselect.php';

$NewMessageChat = filter_var($_POST['sendmsg'], FILTER_SANITIZE_STRING);

if(strlen($NewMessageChat)>=1 and strlen($NewMessageChat)<1000){

    $SendMsgTicketChat = "INSERT INTO chat(id,msgcontent,isfile,enviadapor,namesended,socialsended,ticketprotocolo,datamsg) VALUES ('','".$NewMessageChat."',0,'".$_SESSION['DataAccount']['id']."','".$_SESSION['DataAccount']['nome']."','".$_SESSION['DataAccount']['social']."','".$_SESSION['DataTicketSelected']['protocolo']."','".date('Y-m-d H:i:s')."')";
    mysqli_query($CONNECTION_DB, $SendMsgTicketChat);

    /* Update Ticket Data */
    $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND protocolo='".$_SESSION['DataTicketSelected']['protocolo']."'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
    unset($_SESSION['DataTicketSelected']);

    $_SESSION['DataTicketSelected'] = mysqli_fetch_assoc($TicketInfoExec);
    $TicketChatQuery = "SELECT id,msgcontent,isfile,enviadapor,namesended,socialsended,datamsg FROM chat WHERE ticketprotocolo='".$_SESSION['DataTicketSelected']['protocolo']."' ORDER BY datamsg ASC";
    $TicketChatExec = mysqli_query($CONNECTION_DB, $TicketChatQuery);
    unset($_SESSION['DataTicketChatSelected']);
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
    /* Update Ticket Data */
    
    header("Location: ../../pages/Ticket.php");
    exit();
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Unable to forward message! Please try again!</div>';
    header("Location: ../../pages/Ticket.php");
    exit();
}
mysqli_close($CONNECTION_DB);