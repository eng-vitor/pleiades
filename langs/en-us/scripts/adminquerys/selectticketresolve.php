<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifypermission.php';

if(isset($_GET['protocolticket'])){
    $Protocol = $_GET['protocolticket'];
    unset($_SESSION['DataTicketAllChatSelected']);

    $TicketInfoQuery = "SELECT protocolo,solicitante,tickethash,designacao,nometicket,sla,ticketstatus,datapedido,datasla,datafinalizado FROM tickets WHERE protocolo='".$Protocol."'";
    $TicketInfoExec = mysqli_query($CONNECTION_DB, $TicketInfoQuery);
    $TicketInfoResult = mysqli_num_rows($TicketInfoExec);
    
    if($TicketInfoResult==1){

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

        /* Tools*/
        unset($_SESSION['AdminUserTools']);
		$QueryToolsUser = "SELECT login,pass,tipotool FROM usertools WHERE id_conta='".$_SESSION['DataTicketAllSelected']['solicitante']."'";
		$QueryToolsUserExec = mysqli_query($CONNECTION_DB, $QueryToolsUser);

		for($k=0; $k<mysqli_num_rows($QueryToolsUserExec); $k++){
			$DataTools = mysqli_fetch_assoc($QueryToolsUserExec);
			$_SESSION['AdminUserTools'][$k][] = $DataTools['login'];
			$_SESSION['AdminUserTools'][$k][] = $DataTools['pass'];
			$_SESSION['AdminUserTools'][$k][] = $DataTools['tipotool'];
		}
		$_SESSION['AdminUserTools']['CountTools'] = mysqli_num_rows($QueryToolsUserExec);
		/* Tools*/
        header("Location: ../../pages/system/ResolveTicket.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> This Ticket does not exist or is invalid!</div>';
        header("Location: ../../pages/system/SystemAdmin.php");
        exit();
    }
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> You have not selected a ticket!</div>';
    header("Location: ../../pages/system/SystemAdmin.php");
    exit();
}
mysqli_close($CONNECTION_DB);