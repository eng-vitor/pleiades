<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifyticketselect.php';

$SearchStringData = filter_var($_POST['searchbar'], FILTER_SANITIZE_STRING);
$SearchTypeData = filter_var($_POST['searchtype'], FILTER_SANITIZE_NUMBER_INT);

if(strlen($SearchStringData)>=3 and strlen($SearchStringData)<100){

    switch($SearchTypeData){
        case 0:
            $QuerySearch = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND protocolo LIKE '%".$SearchStringData."%'";
            $QuerySearchExec = mysqli_query($CONNECTION_DB, $QuerySearch);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QuerySearchExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QuerySearchExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }
            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QuerySearchExec);
            break; 
        case 1:
            $QuerySearch = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND tickethash LIKE '%".$SearchStringData."%'";
            $QuerySearchExec = mysqli_query($CONNECTION_DB, $QuerySearch);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QuerySearchExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QuerySearchExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }
            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QuerySearchExec);
            break;
        case 2:
            $QuerySearch = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND designacao LIKE '%".$SearchStringData."%'";
            $QuerySearchExec = mysqli_query($CONNECTION_DB, $QuerySearch);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QuerySearchExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QuerySearchExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }
            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QuerySearchExec);
            break;
        default:
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou um filtro válido!</div>';
            break;
    }
    header("Location: ../../pages/MyTickets.php");
    exit();

}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> A pesquisa não atendeu aos requisitos mínimos!</div>';
    header("Location: ../../pages/MyTickets.php");
    exit();
}
mysqli_close($CONNECTION_DB);