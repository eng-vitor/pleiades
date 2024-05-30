<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifyticketselect.php';

if(isset($_GET['protocolticket'])){
    $Protocol = $_GET['protocolticket'];
    $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND protocolo='".$Protocol."' AND ticketstatus='Pendente'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);

    if($TicketInfoResult==1){
        $CancelTicketQuery = "UPDATE tickets SET ticketstatus='Cancelado',datafinalizado='".date('Y-m-d H:i:s')."' WHERE protocolo='".$Protocol."'";
        mysqli_query($CONNECTION_DB, $CancelTicketQuery);

        $CancelTicketNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Você cancelou um ticket','2','".date('Y-m-d H:i:s')."','0')";
        mysqli_query($CONNECTION_DB, $CancelTicketNotification);

        /* Update Ticket Data */
        $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND protocolo='".$_SESSION['DataTicketSelected']['protocolo']."'";
        $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
        $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
        unset($_SESSION['DataTicketSelected']);
        $_SESSION['DataTicketSelected'] = mysqli_fetch_assoc($TicketInfoExec);

        $TicketChatQuery = "SELECT id,msgcontent,isfile,enviadapor,namesended,socialsended,datamsg FROM chat WHERE ticketprotocolo='".$_SESSION['DataTicketSelected']['protocolo']."' ORDER BY datamsg ASC";
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
        /* Update Ticket Data */

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

        /* Notifications*/
        unset($_SESSION['DataNotifications']);
		$QueryNotifications = "SELECT descricao,tipo_notification FROM notifications WHERE visualizado='0' AND id_conta='".$_SESSION['DataAccount']['id']."' ORDER BY data_notification DESC";
		$QueryNotificationsExec = mysqli_query($CONNECTION_DB, $QueryNotifications);
		for($j=0; $j<mysqli_num_rows($QueryNotificationsExec); $j++){
			$DataTools = mysqli_fetch_assoc($QueryNotificationsExec);
			$_SESSION['DataNotifications'][$j][] = $DataTools['descricao'];
			$_SESSION['DataNotifications'][$j][] = $DataTools['tipo_notification'];
		}
		$_SESSION['DataNotifications']['CountNotifications'] = mysqli_num_rows($QueryNotificationsExec);
		/* Notifications*/
        
        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> O Ticket Foi cancelado!</div>';
        header("Location: ../../pages/Ticket.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Este Ticket não existe ou é inválido!</div>';
        header("Location: ../../pages/Ticket.php");
        exit();
    }
}
else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você precisa selecionar um ticket para cancelar!</div>';
    header("Location: ../../pages/MyTickets.php");
    exit();
}
mysqli_close($CONNECTION_DB);