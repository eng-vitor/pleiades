<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifypermission.php';

if(isset($_GET['protocolticket'])){
    $Protocol = $_GET['protocolticket'];
    $TicketInfoQuery = "SELECT protocolo,solicitante,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE protocolo='".$Protocol."'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);

    if($TicketInfoResult==1){
        $RejectTicketQuery = "UPDATE tickets SET ticketstatus='Rejeitado',datafinalizado='".date('Y-m-d H:i:s')."' WHERE protocolo='".$Protocol."'";
        mysqli_query($CONNECTION_DB, $RejectTicketQuery);

        $DataTicketInfoQuery = mysqli_fetch_assoc($TicketInfoExec);
        $RejectTicketNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$DataTicketInfoQuery['solicitante']."','Seu ticket foi rejeitado!','2','".date('Y-m-d H:i:s')."','0')";
        mysqli_query($CONNECTION_DB, $RejectTicketNotification);

        /* Update Ticket Data */
        $TicketInfoQuery = "SELECT protocolo,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE protocolo='".$Protocol."'";
        $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
        $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
        unset($_SESSION['DataTicketAllSelected']);
        $_SESSION['DataTicketAllSelected'] = mysqli_fetch_assoc($TicketInfoExec);

        $TicketChatQuery = "SELECT id,msgcontent,isfile,enviadapor,namesended,socialsended,datamsg FROM chat WHERE ticketprotocolo='".$Protocol."' ORDER BY datamsg ASC";
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
        unset($_SESSION['DataTicketsAll']);
		$QueryTicketData = "SELECT protocolo,designacao,nometicket,sla,ticketstatus,datapedido,datasla FROM tickets WHERE ticketstatus='Pendente'";
		$QueryTicketDataExec = mysqli_query($CONNECTION_DB, $QueryTicketData);

		for($p=0; $p<mysqli_num_rows($QueryTicketDataExec); $p++){
			$DataTicket = mysqli_fetch_assoc($QueryTicketDataExec);
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['protocolo'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['designacao'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['nometicket'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['sla'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['ticketstatus'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['datapedido'];
            $_SESSION['DataTicketsAll'][$p][] = $DataTicket['datasla'];
		}
		$_SESSION['DataTicketsAll']['count'] = mysqli_num_rows($QueryTicketDataExec);

        unset($_SESSION['DataTotalTicket']);
        $TotalTicketQuery = "SELECT COUNT(protocolo)contagem FROM tickets WHERE ticketstatus='Resolvido' AND datafinalizado>='".date('Y-m-d 00:00:01')."' AND datafinalizado<='".date('Y-m-d 23:59:59')."'";
        $TotalTicketExec = mysqli_fetch_assoc(mysqli_query($CONNECTION_DB, $TotalTicketQuery));
        $_SESSION['DataTotalTicket'] = $TotalTicketExec['contagem'];
		/* TicketsAdmin*/
        
        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> O Ticket foi rejeitado!</div>';
        header("Location: ../../pages/system/ResolveTicket.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Este Ticket não existe ou é inválido!</div>';
        header("Location: ../../pages/system/ResolveTicket.php");
        exit();
    }
}
else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você precisa selecionar um ticket para cancelar!</div>';
    header("Location: ../../pages/system/ResolveTicket.php");
    exit();
}

mysqli_close($CONNECTION_DB);