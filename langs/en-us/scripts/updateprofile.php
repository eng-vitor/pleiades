<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

$ChangeProfileUsername = filter_var($_POST['profileusername'], FILTER_SANITIZE_STRING);
$ChangeProfileSocial = filter_var($_POST['profileusersocial'], FILTER_SANITIZE_STRING);
$ChangeProfileEmail = filter_var($_POST['profileuseremail'], FILTER_SANITIZE_STRING);
$ChangeProfileUrl = filter_var($_POST['profileuserurl'], FILTER_SANITIZE_STRING);

if(strlen($ChangeProfileUsername)>=3 and strlen($ChangeProfileUsername)<100 and strlen($ChangeProfileSocial)>=4 and strlen($ChangeProfileSocial)<50 and strlen($ChangeProfileEmail)>=5 and strlen($ChangeProfileEmail)<100 and strlen($ChangeProfileUrl)>=5 and strlen($ChangeProfileUrl)<100){
   
    if($ChangeProfileSocial==$_SESSION['DataAccount']['social'] and $ChangeProfileEmail==$_SESSION['DataAccount']['email']){
        $QueryUpdateProfile = "UPDATE users SET nome='$ChangeProfileUsername',urlprofile='$ChangeProfileUrl' WHERE id='".$_SESSION['DataAccount']['id']."'";
        mysqli_query($CONNECTION_DB, $QueryUpdateProfile);

        /* Update DataAccount */
        unset($_SESSION['DataAccount']['nome'], $_SESSION['DataAccount']['social'], $_SESSION['DataAccount']['urlprofile'], $_SESSION['DataAccount']['email']);
        $QueryAccountDataRefresh = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE id='".$_SESSION['DataAccount']['id']."'";
	    $QueryAccountDataRefreshExec = mysqli_query($CONNECTION_DB, $QueryAccountDataRefresh);
        $_SESSION['DataAccount'] = $QueryAccountDataRefreshExec->fetch_assoc();
        /* Update DataAccount */

        $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Change in Profile','3','".date('Y-m-d H:i:s')."','0')";
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

        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been updated in the database!</div>';
        header("Location: ../pages/MyProfile.php");
        exit();

    }elseif($ChangeProfileSocial==$_SESSION['DataAccount']['social'] and $ChangeProfileEmail!=$_SESSION['DataAccount']['email']){
        $QueryUpdateProfile = "UPDATE users SET nome='$ChangeProfileUsername',email='$ChangeProfileEmail',urlprofile='$ChangeProfileUrl',emailverificado='0' WHERE id='".$_SESSION['DataAccount']['id']."'";
        mysqli_query($CONNECTION_DB, $QueryUpdateProfile);

        /* Update DataAccount */
        unset($_SESSION['DataAccount']['nome'], $_SESSION['DataAccount']['social'], $_SESSION['DataAccount']['urlprofile'], $_SESSION['DataAccount']['email']);
        $QueryAccountDataRefresh = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE id='".$_SESSION['DataAccount']['id']."'";
	    $QueryAccountDataRefreshExec = mysqli_query($CONNECTION_DB, $QueryAccountDataRefresh);
        $_SESSION['DataAccount'] = $QueryAccountDataRefreshExec->fetch_assoc();
        /* Update DataAccount */

        $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Change in Profile','3','".date('Y-m-d H:i:s')."','0')";
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

        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been updated in the database!</div>';
        header("Location: ../pages/MyProfile.php");
        exit();

    }elseif($ChangeProfileSocial!=$_SESSION['DataAccount']['social'] and $ChangeProfileEmail==$_SESSION['DataAccount']['email']){
        $QuerySocialExists = "SELECT social FROM users WHERE social='$ChangeProfileSocial'";
        $QuerySocialExistsExec = mysqli_query($CONNECTION_DB, $QuerySocialExists);
        $QuerySocialExistsResult = mysqli_num_rows($QuerySocialExistsExec);

        if($QuerySocialExistsResult==0){
            $QueryUpdateProfile = "UPDATE users SET nome='$ChangeProfileUsername',social='$ChangeProfileSocial',urlprofile='$ChangeProfileUrl' WHERE id='".$_SESSION['DataAccount']['id']."'";
            mysqli_query($CONNECTION_DB, $QueryUpdateProfile);

            /* Update DataAccount */
            unset($_SESSION['DataAccount']['nome'], $_SESSION['DataAccount']['social'], $_SESSION['DataAccount']['urlprofile'], $_SESSION['DataAccount']['email']);
            $QueryAccountDataRefresh = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE id='".$_SESSION['DataAccount']['id']."'";
            $QueryAccountDataRefreshExec = mysqli_query($CONNECTION_DB, $QueryAccountDataRefresh);
            $_SESSION['DataAccount'] = $QueryAccountDataRefreshExec->fetch_assoc();
            /* Update DataAccount */

            $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Change in Profile','3','".date('Y-m-d H:i:s')."','0')";
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

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been updated in the database!</div>';
            header("Location: ../pages/MyProfile.php");
            exit();
        }else{
            $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> The username already exists in our database, please try another one!</div>';
            header("Location: ../pages/MyProfile.php");
            exit();
        }

    }else{
        $QueryDataExists = "SELECT social FROM users WHERE social='$ChangeProfileSocial' AND email='$ChangeProfileEmail'";
        $QueryDataExistsExec = mysqli_query($CONNECTION_DB, $QueryDataExists);
        $QueryDataExistsResult = mysqli_num_rows($QueryDataExistsExec);

        if($QueryDataExistsResult==0){
            $QueryUpdateProfile = "UPDATE users SET nome='$ChangeProfileUsername',social='$ChangeProfileSocial',email='$ChangeProfileEmail',urlprofile='$ChangeProfileUrl',emailverificado='0' WHERE id='".$_SESSION['DataAccount']['id']."'";
            mysqli_query($CONNECTION_DB, $QueryUpdateProfile);

            /* Update DataAccount */
            unset($_SESSION['DataAccount']['nome'], $_SESSION['DataAccount']['social'], $_SESSION['DataAccount']['urlprofile'], $_SESSION['DataAccount']['email']);
            $QueryAccountDataRefresh = "SELECT id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao FROM users WHERE id='".$_SESSION['DataAccount']['id']."'";
            $QueryAccountDataRefreshExec = mysqli_query($CONNECTION_DB, $QueryAccountDataRefresh);
            $_SESSION['DataAccount'] = $QueryAccountDataRefreshExec->fetch_assoc();
            /* Update DataAccount */

            $QueryInsertNotification = "INSERT INTO notifications(id_conta,descricao,tipo_notification,data_notification,visualizado) VALUES ('".$_SESSION['DataAccount']['id']."','Change in Profile','3','".date('Y-m-d H:i:s')."','0')";
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

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Information has been updated in the database!</div>';
            header("Location: ../pages/MyProfile.php");
            exit();
        }else{
            $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> The username or email already exists in our database, please try another one!</div>';
            header("Location: ../pages/MyProfile.php");
            exit();
        }
    }
}else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-xmark fa-beat"></i> Conditions have not been met! Please try again.</div>';
    header("Location: ../pages/MyProfile.php");
	exit();
}

mysqli_close($CONNECTION_DB);