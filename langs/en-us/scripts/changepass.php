<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

$ChangeNewPass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING);
$ChangeNewPassConfirm = filter_var($_POST['newpassconfirm'], FILTER_SANITIZE_STRING);

if($ChangeNewPass==$ChangeNewPassConfirm and strlen($ChangeNewPass)>=8 and strlen($ChangeNewPass)<=32 and strpbrk($ChangeNewPass,'!@#$%¨&*()')){
        
        $SenhaEncrypt = md5($ChangeNewPass);

        if($_SESSION['DataAccount']['senha']!=$SenhaEncrypt){
            
            $QueryUpdatePass = "UPDATE users SET senha='$SenhaEncrypt' WHERE email='".$_SESSION['DataAccount']['email']."'";
            mysqli_query($CONNECTION_DB, $QueryUpdatePass);

            $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Password changed','1','".date('Y-m-d H:i:s')."','0')";
            mysqli_query($CONNECTION_DB, $QueryInsertNotification);
            
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

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> The conditions have been met and the password has been changed!</div>';
            header("Location: ../pages/Change_Password.php");
            exit();
        }
        else{
            $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> The new password cannot be the same as the current one!</div>';
            header("Location: ../pages/Change_Password.php");
	        exit();
        }
}
else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-xmark fa-beat"></i> Conditions have not been met! Please try again.</div>';
    header("Location: ../pages/Change_Password.php");
	exit();
}

mysqli_close($CONNECTION_DB);