<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';

$ValidateInvite = filter_var($_POST['keyinvite'], FILTER_SANITIZE_STRING);

if($ValidateInvite!=' ' and !strpbrk($ValidateInvite,'!@#$%¨&*()-_+={}[]')){
    $InviteListQuery = "SELECT class_account,tag_account,email_account,is_expired FROM invites WHERE key_invite='".$ValidateInvite."' AND is_expired='0'";
    $InviteListExec = mysqli_query($CONNECTION_DB, $InviteListQuery);

    if(mysqli_num_rows($InviteListExec)==1){
        unset($_SESSION['NewAccountData']);
        $_SESSION['NewAccountData'] = mysqli_fetch_assoc($InviteListExec);
        header("Location: ../../pages/Save_Account.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Invitation code does not exist or has already been used!</div>';
        header("Location: ../../pages/Create_Account.php");
        exit();
    }
}
else{
    $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert" style="width: 100%"><i class="fa-solid fa-circle-exclamation fa-beat"></i> Invalid invitation code!</div>';
    header("Location: ../../pages/Create_Account.php");
    exit();
}

mysqli_close($CONNECTION_DB);