<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifyticketselect.php';

$FilterPeriod = filter_var($_POST['periodsearch'], FILTER_SANITIZE_NUMBER_INT);
$FilterStatus = filter_var($_POST['statussearch'], FILTER_SANITIZE_NUMBER_INT);
$FilterDateInit = filter_var($_POST['dateinitsearch'], FILTER_SANITIZE_STRING);
$FilterDateEnd = filter_var($_POST['dateendsearch'], FILTER_SANITIZE_STRING);

if($FilterDateInit=='' and $FilterDateInit==''){

    switch($FilterPeriod){
        case 0:

            switch($FilterStatus){
                case 0:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 1:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 2:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 3:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 4:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                default:
                    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
                    break;        
            }
            break;
        case 1:

            switch($FilterStatus){
                case 0:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".date('Y-m-d')."' OR datafinalizado>='".date('Y-m-d')."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 1:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".date('Y-m-d')."' OR datafinalizado>='".date('Y-m-d')."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 2:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".date('Y-m-d')."' OR datafinalizado>='".date('Y-m-d')."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 3:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".date('Y-m-d')."' OR datafinalizado>='".date('Y-m-d')."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 4:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".date('Y-m-d')."' OR datafinalizado>='".date('Y-m-d')."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                default:
                    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
                    break;        
            }
            break;
        case 2:

            switch($FilterStatus){
                case 0:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datapedido<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datafinalizado<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 1:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datapedido<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datafinalizado<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 2:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datapedido<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datafinalizado<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 3:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datapedido<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datafinalizado<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 4:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datapedido<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Day'))." 00:00:00' AND datafinalizado<='".date('Y-m-d',strtotime('-1 Day'))." 23:59:59'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                default:
                    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
                    break;        
            }
            break;
        case 3:

            switch($FilterStatus){
                case 0:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".date('Y-m-d',strtotime('-1 Week'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Week'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 1:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".date('Y-m-d',strtotime('-1 Week'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Week'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 2:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".date('Y-m-d',strtotime('-1 Week'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Week'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 3:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".date('Y-m-d',strtotime('-1 Week'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Week'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 4:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".date('Y-m-d',strtotime('-1 Week'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-1 Week'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                default:
                    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
                    break;        
            }
            break;
        case 4:
            
            switch($FilterStatus){
                case 0:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".date('Y-m-d',strtotime('-30 Day'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-30 Day'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 1:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".date('Y-m-d',strtotime('-30 Day'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-30 Day'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 2:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".date('Y-m-d',strtotime('-30 Day'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-30 Day'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 3:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".date('Y-m-d',strtotime('-30 Day'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-30 Day'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                case 4:
                    $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".date('Y-m-d',strtotime('-30 Day'))."' OR datafinalizado>='".date('Y-m-d',strtotime('-30 Day'))."'";
                    $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);
        
                    unset($_SESSION['DataMyTickets']);
                    for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                        $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                        $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
                    }

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

                    $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
                    break;
                default:
                    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
                    break;        
            }
            break;   
        default:
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
            break;             
    }
    header("Location: ../../pages/MyTickets.php");
    exit();
}elseif($FilterDateInit!='' and $FilterDateInit!=''){

    switch($FilterStatus){
        case 0:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".$FilterDateInit."' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 1:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".$FilterDateInit."' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 2:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".$FilterDateInit."' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 3:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".$FilterDateInit."' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 4:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".$FilterDateInit."' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        default:
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
            break;        
    }
    header("Location: ../../pages/MyTickets.php");
    exit();
}elseif($FilterDateInit=='' and $FilterDateInit!=''){

    switch($FilterStatus){
        case 0:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datafinalizado<='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 1:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 2:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 3:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 4:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datafinalizado>='".$FilterDateEnd."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        default:
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
            break;        
    }
    header("Location: ../../pages/MyTickets.php");
    exit();
}elseif($FilterDateInit!='' and $FilterDateInit==''){

    switch($FilterStatus){
        case 0:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND datapedido>='".$FilterDateInit."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 1:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Pendente' AND datapedido>='".$FilterDateInit."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 2:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Cancelado' AND datapedido>='".$FilterDateInit."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 3:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Rejeitado' AND datapedido>='".$FilterDateInit."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        case 4:
            $QueryFilter = "SELECT protocolo,designacao,nometicket,ticketstatus,datapedido,datafinalizado FROM tickets WHERE solicitante='".$_SESSION['DataAccount']['id']."' AND ticketstatus='Resolvido' AND datapedido>='".$FilterDateInit."'";
            $QueryFilterExec = mysqli_query($CONNECTION_DB, $QueryFilter);

            unset($_SESSION['DataMyTickets']);
            for($l=0; $l<mysqli_num_rows($QueryFilterExec); $l++){
                $DataTicket = mysqli_fetch_assoc($QueryFilterExec);
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['protocolo'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['designacao'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['nometicket'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['ticketstatus'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datapedido'];
                $_SESSION['DataMyTickets'][$l][] = $DataTicket['datafinalizado'];
            }

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

            $_SESSION['DataMyTickets']['count'] = mysqli_num_rows($QueryFilterExec);
            break;
        default:
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você não selecionou uma opção válida de filtro!</div>';
            break;        
    }
    header("Location: ../../pages/MyTickets.php");
	exit();
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Entrada de dados inválido nos filtros!</div>';
	header("Location: ../../pages/MyTickets.php");
	exit();
}
mysqli_close($CONNECTION_DB);