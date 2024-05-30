<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$CountCancel=0;
$CountPending=0;
$CountRejected=0;
$CountOK=0;

for($a=0; $a<$_SESSION['DataMyTickets']['count']; $a++){
    switch ($_SESSION['DataMyTickets'][$a][3]){
        case "Cancelado":
            $CountCancel++;
            break;
        case "Pendente":
            $CountPending++;
            break;
        case "Rejeitado":
            $CountRejected++;
            break;
        case "Resolvido":
            $CountOK++;
            break;   
    }
}
$TITLEPAGE = 'Sistema - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"> User</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-chart-pie"></i> Dashboard</li>
                </ol>
            </nav>
        </div>
        <?php
            if(isset($_SESSION['Msg'])){
                echo $_SESSION['Msg'];
                unset($_SESSION['Msg']);
            }
            else{
                unset($_SESSION['Msg']);
            }
        ?>
        <section class="dashboardicons">
            <div class="container text-center">
                <div class="row">
                    <a class="col" href="MyTickets.php">
                        <img src="../assets/tickets_ok.png" alt="ticketsok"/>
                        <br>
                        <strong><?= $CountOK; ?></strong>
                        <h5>Tickets Concluídos</h5>
                    </a>
                    <a class="col" href="MyTickets.php">
                    <img src="../assets/tickets_pending.png" alt="ticketspending"/>
                        <br>
                        <strong><?= $CountPending; ?></strong>
                        <h5>Tickets Pendentes</h5>
                    </a>
                    <a class="col" href="MyTickets.php">
                    <img src="../assets/tickets_rejected.png" alt="tickets_rejected"/>
                        <br>
                        <strong><?= $CountRejected; ?></strong>
                        <h5>Tickets Rejeitados</h5>
                    </a>
                    <a class="col" href="MyTickets.php">
                    <img src="../assets/tickets_exited.png" alt="tickets_exited"/>
                        <br>
                        <strong><?= $CountCancel; ?></strong>
                        <h5>Tickets Cancelados</h5>
                    </a>
                </div>
            </div>
        </section>
        <aside class="buttonsinteract" align="center">
            <h2><i class="fa-regular fa-circle-question fa-beat"></i> Precisa de ajuda?</h2>
            <a class="btn btn-info" href="Create_Ticket.php" role="button"><i class="fa-solid fa-circle-plus"></i> Abrir Ticket</a>
            <a class="btn btn-outline-primary" href="MyTickets.php" role="button"><i class="fa-solid fa-magnifying-glass"></i> Procurar Tickets</a>
        </aside>
        <article class="userview" align="center">
            <h1><i class="fa-solid fa-id-card-clip"></i> Informações da Conta</h1>
            <div class="card">
                <h5 class="card-header"><?php if($_SESSION['DataAccount']['classe']==1){ echo 'Conta de Usuário (Padrão)'; }else{ echo 'Pleiade/[ADM]'; } ?></h5>
                <div class="card-body">
                <img src="../assets/cracha_default.png" alt="crachadefault"/>
                    <ul align="left">
                        <li><i class="fa-solid fa-user"></i> Nome:<?= ' '.$_SESSION['DataAccount']['nome']; ?></li>
                        <li><i class="fa-regular fa-id-card"></i> Usuário:<?= ' '.$_SESSION['DataAccount']['social']; ?></li>
                        <li><i class="fa-solid fa-puzzle-piece"></i> Tag:<?= ' '.$_SESSION['DataAccount']['tag']; ?></li>
                        <li><i class="fa-solid fa-at"></i> Email:<?= ' '.$_SESSION['DataAccount']['email']; ?></li>
                    </ul>
                </div>
                <p><?php if($_SESSION['DataAccount']['urlprofile']==''){ echo '<a style="pointer-events: none; cursor: default; color: #b2bec3;" href="#"><i class="fa-brands fa-linkedin"></i></a>';}else{ echo '<a href="http://'.$_SESSION['DataAccount']['urlprofile'].'" target="blank"><i class="fa-brands fa-linkedin"></i></a>';} ?></p>
                <div class="card-footer">
                    <i class="fa-solid fa-calendar"></i> Conta criada em<?php $dataformatada = new DateTime($_SESSION['DataAccount']['datacriacao']); echo ' '.$dataformatada->format('d/m/Y'); ?>
                </div>
            </div>
        </article>
<?php
include __DIR__ . '/static/footer.php';
?>