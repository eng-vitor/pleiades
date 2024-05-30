<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';

$GetNewName = filter_var($_POST['namenewconta'], FILTER_SANITIZE_STRING);
$GetNewUser = filter_var($_POST['usernewconta'], FILTER_SANITIZE_STRING);
$GetNewPassword = filter_var($_POST['senhanewconta'], FILTER_SANITIZE_STRING);

$EmailExistsQuery = "SELECT email FROM users WHERE email='".$_SESSION['NewAccountData']['email_account']."'";
$EmailExistsExec = mysqli_query($CONNECTION_DB, $EmailExistsQuery);

if(mysqli_num_rows($EmailExistsExec)==0){
    $QuerySocialExists = "SELECT social FROM users WHERE social='$GetNewUser'";
    $QuerySocialExistsExec = mysqli_query($CONNECTION_DB, $QuerySocialExists);
    $QuerySocialExistsResult = mysqli_num_rows($QuerySocialExistsExec);

    if($QuerySocialExistsResult==0){

        if(strlen($GetNewName)>=3 and strlen($GetNewName)<100 and strlen($GetNewUser)>=4 and strlen($GetNewUser)<50 and strlen($GetNewPassword)>=8 and strlen($GetNewPassword)<=32 and strpbrk($GetNewPassword,'!@#$%¨&*()')){
            $CreateAccQuery = "INSERT INTO users(id,nome,social,classe,tag,urlprofile,email,senha,emailverificado,datacriacao,ultimovisto) VALUES ('','".$GetNewName."','".$GetNewUser."','".$_SESSION['NewAccountData']['class_account']."','".$_SESSION['NewAccountData']['tag_account']."','','".$_SESSION['NewAccountData']['email_account']."','".md5($GetNewPassword)."','0','".date('Y-m-d')."','')";
            mysqli_query($CONNECTION_DB, $CreateAccQuery);

            $UpdateInviteQuery = "UPDATE invites SET is_expired='1' WHERE email_account='".$_SESSION['NewAccountData']['email_account']."'";
            mysqli_query($CONNECTION_DB, $UpdateInviteQuery);

            $_SESSION['Msg'] = '<div class="alert alert-success" role="alert" style="width: 100%"><i class="fa-solid fa-circle-check fa-beat"></i> Sua conta foi criada, agora você pode logar!</div>';
            header("Location: ../../index.php");
            exit();
        }else{
            $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert" style="width: 100%"><i class="fa-solid fa-circle-exclamation fa-beat"></i> As condições de criação de conta não foram atendidas!</div>';
            header("Location: ../../pages/Save_Account.php");
            exit();
        }

    }else{
        $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> O nome de usuário já existe em nosso banco de dados, por favor digite outro!</div>';
        header("Location: ../../pages/Save_Account.php");
        exit();
    }
}else{
    unset($_SESSION['NewAccountData']);
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> O e-mail vinculado ao código de convite já está sendo utilizado por um usuário no sistema!</div>';
    header("Location: ../../pages/Create_Account.php");
    exit();
}

mysqli_close($CONNECTION_DB);