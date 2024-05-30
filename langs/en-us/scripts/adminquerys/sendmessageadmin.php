<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifypermission.php';

$NewMessageChat = filter_var($_POST['sendmsg'], FILTER_SANITIZE_STRING);

if(strlen($NewMessageChat)>=1 and strlen($NewMessageChat)<1000){
    $SendMsgTicketChat = "INSERT INTO chat(id,msgcontent,isfile,enviadapor,namesended,socialsended,ticketprotocolo,datamsg) VALUES ('','".$NewMessageChat."',0,'".$_SESSION['DataAccount']['id']."','".$_SESSION['DataAccount']['nome']."','".$_SESSION['DataAccount']['social']."','".$_SESSION['DataTicketAllSelected']['protocolo']."','".date('Y-m-d H:i:s')."')";
    $SendMsgTicketChatQuery = mysqli_query($CONNECTION_DB, $SendMsgTicketChat);

    /* Update Ticket Data */
    $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE protocolo='".$_SESSION['DataTicketAllSelected']['protocolo']."'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
    unset($_SESSION['DataTicketAllSelected']);
    $_SESSION['DataTicketAllSelected'] = mysqli_fetch_assoc($TicketInfoExec);
    $TicketChatQuery = "SELECT id,msgcontent,isfile,enviadapor,namesended,socialsended,datamsg FROM chat WHERE ticketprotocolo='".$_SESSION['DataTicketAllSelected']['protocolo']."' ORDER BY datamsg ASC";
    $TicketChatExec = mysqli_query($CONNECTION_DB, $TicketChatQuery);
    unset($_SESSION['DataTicketAllChatSelected']);
    for($j=0; $j<mysqli_num_rows($TicketChatExec); $j++){
        $DataTools = mysqli_fetch_assoc($TicketChatExec);
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['msgcontent'];
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['isfile'];
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['enviadapor'];
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['namesended'];
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['socialsended'];
        $_SESSION['DataTicketAllChatSelected'][$j][] = $DataTools['datamsg'];
    }
    $_SESSION['DataTicketAllChatSelected']['CountMsgs'] = mysqli_num_rows($TicketChatExec);
    /* Update Ticket Data */

	/* TicketsAdmin*/
	unset($_SESSION['DataTicketsPending']);
	$QueryTicketData = "SELECT protocolo,designacao,nometicket,sla,ticketstatus,datapedido,datasla FROM tickets WHERE ticketstatus='Pendente'";
	$QueryTicketDataExec = mysqli_query($CONNECTION_DB, $QueryTicketData);
	
	for($p=0; $p<mysqli_num_rows($QueryTicketDataExec); $p++){
		$DataTicket = mysqli_fetch_assoc($QueryTicketDataExec);
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['protocolo'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['designacao'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['nometicket'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['sla'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['ticketstatus'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['datapedido'];
		$_SESSION['DataTicketsPending'][$p][] = $DataTicket['datasla'];
	}
	$_SESSION['DataTicketsPending']['count'] = mysqli_num_rows($QueryTicketDataExec);
	unset($_SESSION['DataTotalTicket']);
	$TotalTicketQuery = "SELECT COUNT(protocolo)contagem FROM tickets WHERE ticketstatus='Resolvido' AND datafinalizado>='".date('Y-m-d 00:00:01')."' AND datafinalizado<='".date('Y-m-d 23:59:59')."'";
	$TotalTicketExec = mysqli_fetch_assoc(mysqli_query($CONNECTION_DB, $TotalTicketQuery));
	$_SESSION['DataTotalTicket'] = $TotalTicketExec['contagem'];
	/* TicketsAdmin*/

    header("Location: ../../pages/system/ResolveTicket.php");
    exit();
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Unable to forward message! Please try again!</div>';
    header("Location: ../../pages/system/ResolveTicket.php");
    exit();
}

mysqli_close($CONNECTION_DB);