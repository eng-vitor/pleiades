<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

$NewTicketTitle = filter_var($_POST['newtickettitle'], FILTER_SANITIZE_STRING);
$NewTicketMsg = filter_var($_POST['newticketmsg'], FILTER_SANITIZE_STRING);
$NewTicketDesign = filter_var($_POST['newticketdesign'], FILTER_SANITIZE_STRING);
$NewTicketSLA = filter_var($_POST['newticketsla'], FILTER_SANITIZE_NUMBER_INT);

$TICKET_GEN = date('ymd').'.'.date('Hi').$_SESSION['DataAccount']['id'].mt_rand(1, 99);
$TICKET_HASH = '#'.md5($TICKET_GEN);

if(strlen($NewTicketTitle)>5 and strlen($NewTicketTitle)<=80 and strlen($NewTicketMsg)>=5 and strlen($NewTicketMsg)<1000 and strlen($NewTicketDesign)>=2 and strlen($NewTicketDesign)<50 and strlen($NewTicketSLA)>0 and strlen($NewTicketSLA)<10){

    $DataSLA = strtotime(date('Y-m-d H:i:s')) + $NewTicketSLA*3600;
    $CreateTicketNew = "INSERT INTO tickets(protocolo,solicitante,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado) VALUES ('".$TICKET_GEN."','".$_SESSION['DataAccount']['id']."','".$TICKET_HASH."','".$NewTicketDesign."','".$NewTicketTitle."','".$NewTicketSLA."','Pendente','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s',$DataSLA)."','')";
    mysqli_query($CONNECTION_DB, $CreateTicketNew);

    $CreateTicketChat = "INSERT INTO chat(id,msgcontent,isfile,enviadapor,namesended,socialsended,ticketprotocolo,datamsg) VALUES ('','".$NewTicketMsg."',0,'".$_SESSION['DataAccount']['id']."','".$_SESSION['DataAccount']['nome']."','".$_SESSION['DataAccount']['social']."','".$TICKET_GEN."','".date('Y-m-d H:i:s')."')";
    mysqli_query($CONNECTION_DB, $CreateTicketChat);

    $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Ticket criado','2','".date('Y-m-d H:i:s')."','0')";
    mysqli_query($CONNECTION_DB, $QueryInsertNotification);

    /* Update TicketsCount */
    unset($_SESSION['TicketCount']);
	$QueryTicketData = "SELECT ticketstatus FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."'";
	$QueryTicketDataExec = mysqli_query($CONNECTION_DB, $QueryTicketData);
	for($l=0; $l<mysqli_num_rows($QueryTicketDataExec); $l++){
		$DataTools = mysqli_fetch_assoc($QueryTicketDataExec);
		$_SESSION['TicketCount'][$l] = $DataTools['ticketstatus'];
	}
	$_SESSION['TicketCount']['rows'] = mysqli_num_rows($QueryTicketDataExec);
    /* Update TicketsCount */

    /* Tickets */
    unset($_SESSION['DataMyTickets']);
    $QueryTicketData = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."'";
    $QueryTicketDataExec = mysqli_query($CONNECTION_DB, $QueryTicketData);
    for($l=0; $l<mysqli_num_rows($QueryTicketDataExec); $l++){
        $DataTicket = mysqli_fetch_assoc($QueryTicketDataExec);
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
    }
    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryTicketDataExec);
    /* Tickets */

    /* Update TicketsCount */
    unset($_SESSION['TicketCount']);
    $QueryTicketData = "SELECT ticketstatus FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."'";
    $QueryTicketDataExec = mysqli_query($CONNECTION_DB, $QueryTicketData);
    for($l=0; $l<mysqli_num_rows($QueryTicketDataExec); $l++){
        $DataTools = mysqli_fetch_assoc($QueryTicketDataExec);
        $_SESSION['TicketCount'][$l] = $DataTools['ticketstatus'];
    }
    $_SESSION['TicketCount']['rows'] = mysqli_num_rows($QueryTicketDataExec);
    /* Update TicketsCount */

    /* Update Notifications */
    unset($_SESSION['DataNotifications']);
    $QueryNotifications = "SELECT descricao,tipo_notification FROM notifications WHERE visualizado='0' AND id_conta='".$_SESSION['DataAccount']['id']."' ORDER BY data_notification DESC";
    $QueryNotificationsExec = mysqli_query($CONNECTION_DB, $QueryNotifications);
    for($j=0; $j<mysqli_num_rows($QueryNotificationsExec); $j++){
        $DataTools = mysqli_fetch_assoc($QueryNotificationsExec);
        $_SESSION['DataNotifications'][$j][] = $DataTools['descricao'];
        $_SESSION['DataNotifications'][$j][] = $DataTools['tipo_notification'];
    }
    $_SESSION['DataNotifications']['CountNotifications'] = mysqli_num_rows($QueryNotificationsExec);
    /* Update Notifications */

    $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Ticket criado!</div>';
    header("Location: selectticket.php?protocolticket=".$TICKET_GEN."");
    exit();
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> As condições não foram atendidas! Por favor, tente novamente!</div>';
    header("Location: ../pages/Create_Ticket.php");
    exit();
}

mysqli_close($CONNECTION_DB);