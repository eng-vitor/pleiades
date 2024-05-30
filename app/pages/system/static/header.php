<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?= $TITLEPAGE; ?></title>
        <meta name="author" content="Vitor G. Dantas">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="../../assets/base/favicon.png"/>
        <link rel="stylesheet" href="../../styles/style.css"/>
        <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../../vendor/fortawesome/font-awesome/css/all.css"/>
    </head>
    <body>
        <nav class="navmenu">
            <div class="menusystemadmin">
                <a href="SystemAdmin.php"><img src="../../assets/base/system_logo.png" width="45px" height="45px" alt="logosystem"/></a>
                <strong><?= $SERVER_NAME; ?></strong>
                <small><?= '<i class="fa-solid fa-code-branch"></i> '.$SYSTEM_VERSION; ?></small>
            </div>
                <div class="usernav">
                    <button type="button" class="dropdown-toggle" href="#" id="notifications" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= (($_SESSION['DataNotifications']['CountNotifications']>0)) ? '<i class="fa-solid fa-bell fa-shake"></i>' : '<i class="fa-regular fa-bell"></i>'; ?></button>
                        <ul class="dropdown-menu">
                            <?php 
                                if($_SESSION['DataNotifications']['CountNotifications']>=1){
                                    echo '<div class="notificationsscroll">';
                                    for($i=0; $i<$_SESSION['DataNotifications']['CountNotifications']; $i++){

                                        switch ($_SESSION['DataNotifications'][$i][1]) {
                                            case 1:
                                                echo '<li><a class="dropdown-item" href="../System.php"><span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-bell"></i> Novo</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>Você tem um alerta do sistema!</small></a></li>';
                                                break;
                                            case 2:
                                                echo '<li><a class="dropdown-item" href="../MyTickets.php"><span class="badge rounded-pill text-bg-warning"><i class="fa-solid fa-bell"></i> Novo</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>Você tem uma nova notificação!</small></a></li>';
                                                break;
                                            case 3:
                                                echo '<li><a class="dropdown-item" href="../MyProfile.php"><span class="badge rounded-pill text-bg-info"><i class="fa-solid fa-bell"></i> Novo</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>Nova alteração efetuada na conta!</small></a></li>';
                                                break;
                                            case 4:
                                                echo '<li><a class="dropdown-item" href="../Corporate_Page.php"><span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-bell"></i> Novo</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>Nova alteração efetuada na conta!</small></a></li>';
                                                break;
                                        }
                                    }
                                    echo '</div>','<hr class="dropdown-divider">','<a class="dropdown-item text-center" href="../../scripts/cleanallnotifications.php"><i class="fa-solid fa-list-check"></i> Limpar todas as notificações</a>';
                                }else{
                                    echo '<p class="text-center"><i class="fa-regular fa-circle-check"></i> Você não tem notificações!</p>';
                                }
                            ?>
                        </ul>
                    <button type="button" id="buttonsuser" class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?= $_SESSION['DataAccount']['email']; ?></small>
                    </button>
                    <ul class="dropdown-menu" id="userdropdown">
                        <li><a class="dropdown-item disabled" href="#"><i class="fa-regular fa-envelope-open"></i> E-mail:<?= ($_SESSION['DataAccount']['emailverificado']==1) ? ' <span style="color:#2ecc71">Verificado</span>' : ' <span style="color:#e74c3c">Não verificado</span>'; ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item disabled" href="#"><i class="fa-solid fa-terminal"></i> Acesso admin</a></li>
                        <li><a class="dropdown-item" href="../System.php"><i class="fa-solid fa-ticket-simple"></i> Acesso de usuário</a></li>
                        <li><a class="dropdown-item" href="../MyProfile.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="../Change_Password.php"><i class="fa-solid fa-unlock-keyhole"></i> Alterar senha</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../scripts/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Deslogar</a></li>
                    </ul>     
                </div>
        </nav>
        <div class="sidenav">
            <div class="profileindex">
                <img src="../../assets/base/avatar_default.png" width="45px" height="45px" alt="logosystem"/><?= $_SESSION['DataAccount']['nome'].'<br>'.'<small><i class="fa-solid fa-id-badge"></i> '.$_SESSION['DataAccount']['tag'].'</small>'; ?>
            </div>
            <h6><i class="fa-solid fa-user-secret"></i> Painel Admin</h6>
            <a href="SystemAdmin.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="ManageSystem.php"><i class="fa-solid fa-gears"></i> Sistema</a>
            <a href="TicketSystem.php"><i class="fa-solid fa-ticket-simple"></i> Tickets</a>
            <a href="#"><i class="fa-solid fa-database"></i> Database <span class="badge rounded-pill text-bg-secondary">Em breve</span></a>
            <a href="#"><i class="fa-solid fa-chart-simple"></i> Relatório <span class="badge rounded-pill text-bg-secondary">Em breve</span></a>
            <h6><i class="fa-solid fa-user"></i> Painel Usuário</h6>
            <a href="../System.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="../Create_Ticket.php"><i class="fa-solid fa-circle-plus"></i> Abrir ticket</a>
            <a href="../MyTickets.php"><i class="fa-solid fa-ticket"></i> Meus tickets</a>
            <a href="../Corporate_page.php"><i class="fa-solid fa-users"></i> Corporativo</a>
        </div>