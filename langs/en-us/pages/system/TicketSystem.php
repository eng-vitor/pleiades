<?php
session_start();
require __DIR__.'../../../config.php';
include __DIR__.'../../../scripts/status.php';
include __DIR__.'../../../scripts/verifyauth.php';
include __DIR__.'../../../scripts/verifypermission.php';

$QueryPaginationAdminCount = mysqli_query($CONNECTION_DB, "SELECT a.protocolo, b.social, a.designacao, a.nometicket, a.sla, a.ticketstatus, a.datapedido, a.datasla, a.datafinalizado FROM tickets AS a, users AS b WHERE a.solicitante=b.id");
$QueryPaginationAdminCountResult = mysqli_num_rows($QueryPaginationAdminCount);

if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
} 

$ResultCache = ($page-1) * $RESULTS_PER_PAGE;
$QueryTicketData = "SELECT a.protocolo, b.social, a.designacao, a.nometicket, a.sla, a.ticketstatus, a.datapedido, a.datasla, a.datafinalizado FROM tickets AS a, users AS b WHERE a.solicitante=b.id LIMIT ".$ResultCache.",".$RESULTS_PER_PAGE."";
$QueryTicketDataExec = mysqli_query($CONNECTION_DB,$QueryTicketData);

$PageNumber = ceil ($QueryPaginationAdminCountResult / $RESULTS_PER_PAGE);

unset($_SESSION['DataTicketsAll']);
for($r=0; $r<mysqli_num_rows($QueryTicketDataExec); $r++){
	$DataTicket = mysqli_fetch_assoc($QueryTicketDataExec);
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['protocolo'];
    $_SESSION['DataTicketsAll'][$r][] = $DataTicket['social'];
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['nometicket'];
    $_SESSION['DataTicketsAll'][$r][] = $DataTicket['designacao'];
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['sla'];
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['ticketstatus'];
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['datapedido'];
	$_SESSION['DataTicketsAll'][$r][] = $DataTicket['datasla'];
    $_SESSION['DataTicketsAll'][$r][] = $DataTicket['datafinalizado'];
}
$_SESSION['DataTicketsAll']['count'] = mysqli_num_rows($QueryTicketDataExec);

$TITLEPAGE = '[ADMIN] System tickets - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>

    <div class="mininav">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="SystemAdmin.php">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-ticket-simple"></i> Tickets</li>
            </ol>
        </nav>
    </div>
    <section class="allticket">
        <h3><i class="fa-solid fa-ticket-simple"></i> System tickets</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-hand"></i></th>
                        <th scope="col"><i class="fa-solid fa-ticket-simple"></i> Protocol</th>
                        <th scope="col"><i class="fa-solid fa-user"></i> Username</th>
                        <th scope="col"><i class="fa-solid fa-tag"></i> Title</th>
                        <th scope="col"><i class="fa-solid fa-paper-plane"></i> Tag</th>
                        <th scope="col"><i class="fa-solid fa-stopwatch"></i> SLA</th>
                        <th scope="col"><i class="fa-solid fa-bars-progress"></i> Status</th>
                        <th scope="col"><i class="fa-solid fa-calendar-day"></i> Creation date</th>
                        <th scope="col"><i class="fa-solid fa-calendar-week"></i> Planned date</th>
                        <th scope="col"><i class="fa-solid fa-calendar-check"></i> Resolution date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       for($t=0; $t<$_SESSION['DataTicketsAll']['count']; $t++){
                            $DataTicketFormatadaCriacao = new DateTime($_SESSION['DataTicketsAll'][$t][6]);
                            $DataTicketFormatadaSLA = new DateTime($_SESSION['DataTicketsAll'][$t][7]);
                            if($_SESSION['DataTicketsAll'][$t][8]==''){
                                $DataTicketFormatadaFechamento = '0000-00-00 00:00:00'; 
                            }else{ 
                                $DataTicketFormatadaFechamento = new DateTime($_SESSION['DataTicketsAll'][$t][8]);
                            }
                            echo '<tr>
                                    <th scope="row"><a class="btn btn-success" href="'.'../../scripts/adminquerys/selectticketresolve.php?protocolticket='.$_SESSION['DataTicketsAll'][$t][0].'" role="button"><i class="fa-solid fa-arrow-pointer"></i></a></th>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][0].'</td>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][1].'</td>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][2].'</td>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][3].'</td>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][4].'hrs</td>
                                    <td>'.$_SESSION['DataTicketsAll'][$t][5].'</td>
                                    <td>'.$DataTicketFormatadaCriacao->format('d/m/Y').' at '.$DataTicketFormatadaSLA->format('H:i:s').'</td>
                                    <td>'.$DataTicketFormatadaSLA->format('d/m/Y').' at '.$DataTicketFormatadaSLA->format('H:i:s').'</td>
                                    <td>'.$DataTicketFormatadaFechamento->format('d/m/Y').' at '.$DataTicketFormatadaFechamento->format('H:i:s').'</td>
                                </tr>';                  
                        }
                    ?>
                </tbody>
            </table>
            <?php
             if($PageNumber>1){
                echo '<nav aria-label="Page navigation example" class="pagedivisor">
                        <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="TicketSystem.php?page=1" aria-label="First page">
                                <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                            </a>
                        </li>';
                    for($page = 1; $page<= $PageNumber; $page++) {  
                            echo '<li class="page-item"><a class="page-link" href="TicketSystem.php?page='.$page.'">'.$page.'</a></li>';  
                    }  
                    echo ' <li class="page-item">
                                <a class="page-link" href="TicketSystem.php?page='.$PageNumber.'" aria-label="Last page">
                                    <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>';
             }else{
                echo '<nav aria-label="Page navigation example" class="pagedivisor">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link disabled" href="#" aria-label="First page">
                                    <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link disabled" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link disabled" href="#" aria-label="Last page">
                                    <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>';
             }
            ?>
            <?php
                if($_SESSION['DataTicketsAll']['count']==0){
                    echo '<h2><i class="fa-regular fa-folder-open"></i> No tickets between filters!</h2>';
                }
            ?>
    </section>
<?php
include __DIR__ . '/static/footer.php';
?>