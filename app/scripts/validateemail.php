<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

$ValidateEmail = filter_var($_POST['checkemailinput'], FILTER_SANITIZE_EMAIL);

if($_SESSION['DataAccount']['emailverificado']==0){
    $Validation = EmailValidation\EmailValidatorFactory::create($ValidateEmail);
    $Result = $Validation->getValidationResults()->asJson();

    if($ValidateEmail==$_SESSION['DataAccount']['email'] and strlen($ValidateEmail)>=5 and strlen($ValidateEmail)<100 and json_decode($Result)->valid_host==1){

        $QueryVerifyEmail = "UPDATE users SET emailverificado='1' WHERE id='".$_SESSION['DataAccount']['id']."'";
        mysqli_query($CONNECTION_DB, "$QueryVerifyEmail");

        /* Update DataAccount */
        unset($_SESSION['DataAccount']['emailverificado']);
        $QueryAccountDataRefresh = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE id='".$_SESSION['DataAccount']['id']."'";
        $QueryAccountDataRefreshExec = mysqli_query($CONNECTION_DB, $QueryAccountDataRefresh);
        $_SESSION['DataAccount'] = $QueryAccountDataRefreshExec->fetch_assoc();
        /* Update DataAccount */

        $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Email foi validado','3','".date('Y-m-d H:i:s')."','0')";
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

        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Seu email foi validado!</div>';
        header("Location: ../pages/MyProfile.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-xmark fa-beat"></i> Não foi possível validar o e-mail, pois um erro ocorreu ou ele é inválido!</div>';
        header("Location: ../pages/Verify_Email.php");
        exit();
    }
}else{
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> O seu e-mail já foi verificado!</div>';
    header("Location: ../pages/MyProfile.php");
	exit();
}

mysqli_close($CONNECTION_DB);