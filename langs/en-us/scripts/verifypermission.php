<?php
if(!$_SESSION['DataAccount']['classe']==0 or $_SESSION['DataAccount']['classe']==3){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> Your user does not have permission to access this tab!</div>';
    header("Location: ..\System.php");
    exit;
}