<?php
session_start();
require __DIR__.'../../../config.php';
include __DIR__.'../../../scripts/status.php';
include __DIR__.'../../../scripts/verifyauth.php';
include __DIR__.'../../../scripts/verifypermission.php';

$ContForToday=0;
$ContExpired=0;

for($h=0; $h<$_SESSION['DataTicketsPending']['count']; $h++){
    if(strtotime(date('Y-m-d H:i:s',strtotime($_SESSION['DataTicketsPending'][$h][6])))>=strtotime(date('Y-m-d 00:00:01')) and strtotime(date('Y-m-d H:i:s',strtotime($_SESSION['DataTicketsPending'][$h][6])))<=strtotime(date('Y-m-d 23:59:59'))){
        $ContForToday++;
    }elseif(strtotime(date('Y-m-d H:i:s',strtotime($_SESSION['DataTicketsPending'][$h][6])))<strtotime(date('Y-m-d 23:59:59'))){
        $ContExpired++;
    }
}
$TITLEPAGE = '[ADMIN] System - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
    <div class="mininav">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="SystemAdmin.php">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-chart-line"></i> Dashboard</li>
                <li class="breadcrumb-item" aria-current="page"><a href="../../scripts/adminquerys/refreshdatadashboard.php"><i class="fa-solid fa-rotate"></i> Update</a></li>
            </ol>
        </nav>
    </div>
    <div class="buttonsdashboard">
        <button type="button" class="css-button-rounded--sky"><h1><i class="fa-regular fa-square-check"></i></h1><h2><?= $_SESSION['DataTotalTicket']; ?></h2>Resolved tickets</button>
        <button type="button" class="css-button-rounded--sky"><h1><i class="fa-solid fa-hourglass-start fa-fade"></i></h1><h2><?= $_SESSION['DataTicketsPending']['count']; ?></h2>Pending tickets</button>
        <button type="button" class="css-button-rounded--sky"><h1><i class="fa-solid fa-hourglass-half fa-beat-fade"></i></h1><h2><?= $ContForToday; ?></h2>Tickets expiring today</button>
        <button type="button" class="css-button-rounded--sky"><h1><i class="fa-solid fa-hourglass-end fa-shake"></i></h1><h2><?= $ContExpired; ?></h2>Late tickets</button>
    </div>
    <section class="ticketslist">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-hand"></i></th>
                        <th scope="col"><i class="fa-solid fa-ticket-simple"></i> Protocol</th>
                        <th scope="col"><i class="fa-solid fa-tag"></i> Title</th>
                        <th scope="col"><i class="fa-solid fa-paper-plane"></i> Tag</th>
                        <th scope="col"><i class="fa-solid fa-stopwatch"></i> SLA</th>
                        <th scope="col"><i class="fa-solid fa-calendar-week"></i> SLA date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       for($j=0; $j<$_SESSION['DataTicketsPending']['count']; $j++){
                            $DataTicketFormatadaSLA = new DateTime($_SESSION['DataTicketsPending'][$j][6]);
                            echo '<tr>
                                    <th scope="row"><a class="btn btn-success" href="'.'../../scripts/adminquerys/selectticketresolve.php?protocolticket='.$_SESSION['DataTicketsPending'][$j][0].'" role="button"><i class="fa-solid fa-arrow-pointer"></i></a></th>
                                    <td>'.$_SESSION['DataTicketsPending'][$j][0].'</td>
                                    <td>'.$_SESSION['DataTicketsPending'][$j][2].'</td>
                                    <td>'.$_SESSION['DataTicketsPending'][$j][1].'</td>
                                    <td>'.$_SESSION['DataTicketsPending'][$j][3].'</td>
                                    <td>'.$DataTicketFormatadaSLA->format('d/m/Y').' at '.$DataTicketFormatadaSLA->format('H:i:s').'</td>
                                </tr>';                  
                        }
                    ?>
                </tbody>
            </table>
            <?php
                if($_SESSION['DataTicketsPending']['count']==0){
                    echo '<h2><i class="fa-regular fa-folder-open"></i> No tickets between filters!</h2>';
                }
            ?>
    </section>
<?php
include __DIR__ . '/static/footer.php';
?>