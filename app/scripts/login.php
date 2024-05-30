<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';

if(isset($_SESSION['DataAccount']['id'])){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você já está logado!</div>';
    header("Location: ../pages/System.php");
    exit();
}

$UserData = filter_var($_POST['loginuser'], FILTER_SANITIZE_EMAIL);
$PassData = md5(filter_var($_POST['loginpass'], FILTER_SANITIZE_STRING));

$QueryEmailExists = "SELECT email FROM users WHERE email='$UserData'";
$QueryEmailExistsExec = mysqli_query($CONNECTION_DB, $QueryEmailExists);
$QueryEmailExistsResult = mysqli_num_rows($QueryEmailExistsExec);

if($QueryEmailExistsResult){
	$QueryAccountData = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE email='$UserData' AND senha='$PassData'";
	$QueryAccountDataExec = mysqli_query($CONNECTION_DB, $QueryAccountData);
	$QueryAccountDataResult = mysqli_num_rows($QueryAccountDataExec);

	if ($QueryAccountDataResult){
		$_SESSION['DataAccount'] = $QueryAccountDataExec->fetch_assoc();

		/* AccountUpdate */
		$QueryUpdateLastView = "UPDATE users SET ultimovisto='".date('Y-m-d H:i:s')."' WHERE email='$UserData'";
		mysqli_query($CONNECTION_DB, $QueryUpdateLastView);
		/* AccountUpdate */

		/* Tickets */
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
		$QueryNotifications = "SELECT descricao,tipo_notification FROM notifications WHERE visualizado='0' AND id_conta='".$_SESSION['DataAccount']['id']."' ORDER BY data_notification DESC";
		$QueryNotificationsExec = mysqli_query($CONNECTION_DB, $QueryNotifications);
		for($j=0; $j<mysqli_num_rows($QueryNotificationsExec); $j++){
			$DataTools = mysqli_fetch_assoc($QueryNotificationsExec);
			$_SESSION['DataNotifications'][$j][] = $DataTools['descricao'];
			$_SESSION['DataNotifications'][$j][] = $DataTools['tipo_notification'];
		}
		$_SESSION['DataNotifications']['CountNotifications'] = mysqli_num_rows($QueryNotificationsExec);
		/* Notifications*/

		/* Tools*/
		$QueryToolsUser = "SELECT login,pass,tipotool FROM usertools WHERE id_conta='".$_SESSION['DataAccount']['id']."'";
		$QueryToolsUserExec = mysqli_query($CONNECTION_DB, $QueryToolsUser);

		for($k=0; $k<mysqli_num_rows($QueryToolsUserExec); $k++){
			$DataTools = mysqli_fetch_assoc($QueryToolsUserExec);
			$_SESSION['UserTools'][$k][] = $DataTools['login'];
			$_SESSION['UserTools'][$k][] = $DataTools['pass'];
			$_SESSION['UserTools'][$k][] = $DataTools['tipotool'];
		}
		$_SESSION['UserTools']['CountTools'] = mysqli_num_rows($QueryToolsUserExec);
		/* Tools*/

			if($_SESSION['DataAccount']['classe']==0 or $_SESSION['DataAccount']['classe']==3){
				
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
				
				header("Location: ../pages/system/SystemAdmin.php");
				exit();
			}else{
				header("Location: ../pages/System.php");
				exit();
			}
	}else{
		$_SESSION['Msg'] = '<div class="alert alert-danger" role="alert" style="width: 100%"><i class="fa-solid fa-xmark fa-beat"></i> A senha informada está incorreta!</div>';
		header("Location: ../index.php");
		exit();
	}
}else{
	$_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-exclamation fa-beat"></i> O email informado não está no banco de dados do servidor!</div>';
	header("Location: ../index.php");
	exit();
}

mysqli_close($CONNECTION_DB);