<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';

$NetCfgNameCreate = filter_var($_POST['userpcname'], FILTER_SANITIZE_STRING);
$NetCfgIpCreate = filter_var($_POST['userpcip'], FILTER_SANITIZE_STRING);

if(strlen($NetCfgNameCreate)>=4 and strlen($NetCfgNameCreate)<=50 and strlen($NetCfgIpCreate)>=7 and strlen($NetCfgIpCreate)<=32){
    /* Format Tools*/
    for($a=0; $a<$_SESSION['UserTools']['CountTools']; $a++){

        switch ($_SESSION['UserTools'][$a][2]) {
            case 1:
                $UserAnyDeskID = $_SESSION['UserTools'][$a][0];
                $UserAnyDeskPass = $_SESSION['UserTools'][$a][1];
                break;
            case 2:
                $UserTeamViewerID = $_SESSION['UserTools'][$a][0];
                $UserTeamViewerPass = $_SESSION['UserTools'][$a][1];
                break;
            case 3:
                $UserRealVncID = $_SESSION['UserTools'][$a][0];
                $UserRealVncPass = $_SESSION['UserTools'][$a][1];
                break;
            case 4:
                $UserPcName = $_SESSION['UserTools'][$a][0];
                $UserIP = $_SESSION['UserTools'][$a][1];
                break;
        }
    }
    /* Format Tools*/
        $QueryIfExists = "SELECT login,pass FROM usertools WHERE tipotool=4 AND id_conta='".$_SESSION['DataAccount']['id']."'";
        $QueryIfExistsExec = mysqli_query($CONNECTION_DB, $QueryIfExists);
        $QueryIfExistsRow = mysqli_num_rows($QueryIfExistsExec);

        if($QueryIfExistsRow==0){
            $QueryRegisterNetCfg = "INSERT INTO usertools(id,id_conta,tipotool,login,pass) VALUES ('','".$_SESSION['DataAccount']['id']."','4','$NetCfgNameCreate','$NetCfgIpCreate')";
            mysqli_query($CONNECTION_DB, $QueryRegisterNetCfg);

            $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Registration in tools','4','".date('Y-m-d H:i:s')."','0')";
            mysqli_query($CONNECTION_DB, $QueryInsertNotification);

            /* Update Tools */
            unset($_SESSION['UserTools']);
            $QueryAnydeskUser = "SELECT login,pass,tipotool FROM usertools WHERE id_conta='".$_SESSION['DataAccount']['id']."'";
            $QueryAnydeskUserExec = mysqli_query($CONNECTION_DB, $QueryAnydeskUser);

            for($k=0; $k<mysqli_num_rows($QueryAnydeskUserExec); $k++){
                $DataTools = mysqli_fetch_assoc($QueryAnydeskUserExec);
                $_SESSION['UserTools'][$k][] = $DataTools['login'];
                $_SESSION['UserTools'][$k][] = $DataTools['pass'];
                $_SESSION['UserTools'][$k][] = $DataTools['tipotool'];
            }
            $_SESSION['UserTools']['CountTools'] = mysqli_num_rows($QueryAnydeskUserExec);
            /* Update Tools */

            /* Update Notifications */
            unset($_SESSION['DataNotifications']);
            $QueryNotifications = "SELECT descricao,tipo_notification FROM notifications WHERE visualizado='0' AND id_conta='".$_SESSION['DataAccount']['id']."' ORDER BY data_notification DESC";
            $QueryNotificationsExec = mysqli_query($CONNECTION_DB, $QueryNotifications);
            for($j=0; $j<mysqli_num_rows($QueryNotificationsExec); $j++){
                $DataTools = mysqli_fetch_assoc($QueryNotificationsExec);
                $_SESSION['DataNotifications'][$j][] = $DataTools['descricao'];
                $_SESSION['DataNotifications'][$j][] = $DataTools['tipo_notification'];
            }
            $_SESSION['DataNotifications']['CountNotifications'] = mysqli_num_rows($QueryNotificationsExec);
            /* Update Notifications */

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been successfully saved to the database!</div>';
            header("Location: ../../pages/Corporate_Page.php");
            exit();

        }else{
            $QueryRegisterRealVNC = "UPDATE usertools SET login='$NetCfgNameCreate',pass='$NetCfgIpCreate' WHERE tipotool=4 AND id_conta='".$_SESSION['DataAccount']['id']."'";
            mysqli_query($CONNECTION_DB, $QueryRegisterRealVNC);

            $QueryInsertNotification = "INSERT INTO notifications (id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Registration in tools','4','".date('Y-m-d H:i:s')."','0')";
            mysqli_query($CONNECTION_DB, $QueryInsertNotification);

            /* Update Tools */
            unset($_SESSION['UserTools']);
            $QueryAnydeskUser = "SELECT login,pass,tipotool FROM usertools WHERE id_conta='".$_SESSION['DataAccount']['id']."'";
            $QueryAnydeskUserExec = mysqli_query($CONNECTION_DB, $QueryAnydeskUser);

            for($k=0; $k<mysqli_num_rows($QueryAnydeskUserExec); $k++){
                $DataTools = mysqli_fetch_assoc($QueryAnydeskUserExec);
                $_SESSION['UserTools'][$k][] = $DataTools['login'];
                $_SESSION['UserTools'][$k][] = $DataTools['pass'];
                $_SESSION['UserTools'][$k][] = $DataTools['tipotool'];
            }
            $_SESSION['UserTools']['CountTools'] = mysqli_num_rows($QueryAnydeskUserExec);
            /* Update Tools */

            /* Update Notifications */
            unset($_SESSION['DataNotifications']);
            $QueryNotifications = "SELECT descricao,tipo_notification FROM notifications WHERE visualizado='0' AND id_conta='".$_SESSION['DataAccount']['id']."' ORDER BY data_notification DESC";
            $QueryNotificationsExec = mysqli_query($CONNECTION_DB, $QueryNotifications);
            for($j=0; $j<mysqli_num_rows($QueryNotificationsExec); $j++){
                $DataTools = mysqli_fetch_assoc($QueryNotificationsExec);
                $_SESSION['DataNotifications'][$j][] = $DataTools['descricao'];
                $_SESSION['DataNotifications'][$j][] = $DataTools['tipo_notification'];
            }
            $_SESSION['DataNotifications']['CountNotifications'] = mysqli_num_rows($QueryNotificationsExec);
            /* Update Notifications */

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been successfully saved to the database!</div>';
            header("Location: ../../pages/Corporate_Page.php");
            exit();
        }

}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Unable to save information!</div>';
    header("Location: ../../pages/Corporate_Page.php");
	exit();
}

mysqli_close($CONNECTION_DB);