<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifypermission.php';

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

header("Location: ../../pages/system/SystemAdmin.php");
exit();

mysqli_close($CONNECTION_DB);