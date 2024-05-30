<?php
session_start();
require __DIR__.'/../../config.php';
include __DIR__.'/../../scripts/status.php';
include __DIR__.'/../../scripts/verifyauth.php';
include __DIR__.'/../../scripts/verifypermission.php';

$GetKey = filter_var($_POST['keygeneratoradmin'], FILTER_SANITIZE_STRING);
$GetInvitedEmail = filter_var($_POST['emailinviteadmin'], FILTER_SANITIZE_STRING);

$EmailExistsQuery = "SELECT email FROM users WHERE email='".$GetInvitedEmail."'";
$EmailExistsExec = mysqli_query($CONNECTION_DB, $EmailExistsQuery);

if(mysqli_num_rows($EmailExistsExec)==0){

    if(strlen($GetKey)>=3 and strlen($GetKey)<100 and strlen($GetInvitedEmail)>=4 and strlen($GetInvitedEmail)<100){
        $InsertInvite = "INSERT INTO invites(id,key_invite,class_account,tag_account,email_account,is_expired) VALUES ('','".$GetKey."','3','Administrador','".$GetInvitedEmail."','0')";
        $InsertInvite = mysqli_query($CONNECTION_DB, $InsertInvite);

        $_SESSION['Msg'] = '<div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check fa-beat"></i> Invitation generated!</div>';
        header("Location: ../../pages/system/ManageSystem.php");
        exit();
    }else{
        $_SESSION['Msg'] = '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Account creation conditions are not met!</div>';
        header("Location: ../../pages/system/ManageSystem.php");
        exit();
    }
}else{
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> The email already has an invitation or is already being used by a user in the system!</div>';
    header("Location: ../../pages/system/ManageSystem.php");
    exit();
}

mysqli_close($CONNECTION_DB);