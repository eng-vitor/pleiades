<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <title><?= $TITLEPAGE; ?></title>
        <meta name="author" content="Vitor G. Dantas">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="../assets/base/favicon.png"/>
        <link rel="stylesheet" href="../styles/style.css"/>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css"/>
    </head>
    <body>
        <nav class="navmenu">
            <div class="menusystemadmin">
                <a href="System.php"><img src="../assets/base/system_logo.png" width="45px" height="45px" alt="logosystem"/></a>
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
                                            echo '<li><a class="dropdown-item" href="System.php"><span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-bell"></i> New</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>You have a system alert!</small></a></li>';
                                            break;
                                        case 2:
                                            echo '<li><a class="dropdown-item" href="MyTickets.php"><span class="badge rounded-pill text-bg-warning"><i class="fa-solid fa-bell"></i> New</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>You have a new notification!</small></a></li>';
                                            break;
                                        case 3:
                                            echo '<li><a class="dropdown-item" href="MyProfile.php"><span class="badge rounded-pill text-bg-info"><i class="fa-solid fa-bell"></i> New</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>New account change!</small></a></li>';
                                            break;
                                        case 4:
                                            echo '<li><a class="dropdown-item" href="Corporate_Page.php"><span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-bell"></i> New</span> '.$_SESSION['DataNotifications'][$i][0].'<br><small>New account change!</small></a></li>';
                                            break;
                                    }
                                }
                                echo '</div>','<hr class="dropdown-divider">','<a class="dropdown-item text-center" href="../../scripts/cleanallnotifications.php"><i class="fa-solid fa-list-check"></i> Clear all notifications</a>';
                            }else{
                                echo '<p class="text-center"><i class="fa-regular fa-circle-check"></i> You have no notifications!</p>';
                            }
                        ?>
                    </ul>
                    <button type="button" id="buttonsuser" class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?= $_SESSION['DataAccount']['email']; ?></small>
                    </button>
                    <ul class="dropdown-menu" id="userdropdown">
                        <li><a class="dropdown-item disabled" href="#"><i class="fa-regular fa-envelope-open"></i> E-mail:<?= ($_SESSION['DataAccount']['emailverificado']==1) ? ' <span style="color:#2ecc71">Verified</span>' : ' <span style="color:#e74c3c">Not verified</span>'; ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?= ($_SESSION['DataAccount']['classe']!=1) ? '<li><a class="dropdown-item" href="system/SystemAdmin.php"><i class="fa-solid fa-terminal"></i> Admin access</a></li>' : ''; ?>
                        <?php if($_SESSION['DataAccount']['classe']==1){ echo ''; }else{ echo '<li>'.(substr($_SERVER['SCRIPT_NAME'], strlen($_SERVER['SCRIPT_NAME']) - 10) === 'System.php') ? '<a class="dropdown-item disabled" href="#"><i class="fa-solid fa-ticket-simple"></i> User access</a>' : '<a class="dropdown-item" href="System.php"><i class="fa-solid fa-ticket-simple"></i> User access</a></li>'; } ?>
                        <li><?= (substr($_SERVER['SCRIPT_NAME'], strlen($_SERVER['SCRIPT_NAME']) - 13) === 'MyProfile.php') ? '<a class="dropdown-item disabled" href="#"><i class="fa-solid fa-user"></i> My profile</a>' : '<a class="dropdown-item" href="MyProfile.php"><i class="fa-solid fa-user"></i> My profile</a>'; ?></li>
                        <li><?= (substr($_SERVER['SCRIPT_NAME'], strlen($_SERVER['SCRIPT_NAME']) - 19) === 'Change_Password.php') ? '<a class="dropdown-item disabled" href="#"><i class="fa-solid fa-unlock-keyhole"></i> Change password</a>' : '<a class="dropdown-item" href="Change_Password.php"><i class="fa-solid fa-unlock-keyhole"></i> Change password</a>'; ?></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../scripts/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                    </ul>     
                </div>
        </nav>
        <div class="sidenav">
            <div class="profileindex">
                <img src="../assets/base/avatar_default.png" width="45px" height="45px" alt="logosystem"/><?= $_SESSION['DataAccount']['nome'].'<br>'.'<small><i class="fa-solid fa-id-badge"></i> '.$_SESSION['DataAccount']['tag'].'</small>'; ?>
            </div>
            <h6><i class="fa-solid fa-user"></i> User Panel</h6>
            <a href="System.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="Create_Ticket.php"><i class="fa-solid fa-circle-plus"></i> Open a ticket</a>
            <a href="MyTickets.php"><i class="fa-solid fa-ticket"></i> My tickets</a>
            <a href="Corporate_Page.php"><i class="fa-solid fa-users"></i> Corporate</a>
        </div>