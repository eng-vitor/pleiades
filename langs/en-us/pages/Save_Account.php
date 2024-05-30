<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';

if(!isset($_SESSION['NewAccountData']) and isset($_SESSION['DataAccount']['id'])){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert" style="width: 100%"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> No permission to access this page</div>';
    header("Location: Create_Account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <title>Create an account - <?= $SERVER_NAME; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="../assets/base/favicon.png"/>
        <link rel="stylesheet" href="../styles/style.css"/>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css"/>
    </head>
    <body>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php"><i class="fa-solid fa-circle-chevron-left"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="Create_Account.php"><i class="fa-solid fa-user-plus"></i> Account invitation</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-floppy-disk"></i> Create an account</li>
                </ol>
            </nav>
        </div>
        <div class="bannercreateac">
            <div class="logobanner" align="center">
                <img src="../assets/base/index_logo_min.png" alt="indexlogominimal"/>
                <p><?= $SERVER_NAME.' <cite>'.$SYSTEM_VERSION; ?></cite></p>
            </div>
            <?php
                if(isset($_SESSION['Msg'])){
                    echo $_SESSION['Msg'];
                    unset($_SESSION['Msg']);
                }
                else{
                    unset($_SESSION['Msg']);
                }
            ?>
            <form action="../scripts/accountquerys/createnewaccount.php" method="POST" class="formcreateacctwo">
                <h4><i class="fa-solid fa-floppy-disk"></i> Account Creation</h4>
                <div class="row g-3">
                    <div class="col">
                        <label class="form-label">Accout type</label>
                        <input type="text" class="form-control" value="<?php if($_SESSION['NewAccountData']['class_account']==1){ echo 'User account (Default)'; }else{ echo 'Pleiade/[ADM]'; } ?>" disabled/>
                    </div>
                    <div class="col">
                        <label class="form-label">Tag</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['NewAccountData']['tag_account']; ?>" disabled/>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" value="<?= $_SESSION['NewAccountData']['email_account']; ?>" disabled/>
                </div>
                <div class="mb-3">
                    <label for="namenewconta" class="form-label">Name</label>
                    <input type="text" class="form-control" id="namenewconta" name="namenewconta" placeholder="Nome" minlength="3" maxlength="99" required/>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="usernewconta" class="form-label">Usermame</label>
                        <input type="text" class="form-control" id="usernewconta" name="usernewconta" placeholder="@myuser" minlength="4" maxlength="49" required/>
                    </div>
                    <div class="col">
                        <label for="senhanewconta" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senhanewconta" name="senhanewconta" placeholder="********" minlength="8" maxlength="32" required/>
                    </div>
                </div>
                <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Create!</button>
            </form>       
        </div>
<?php
include __DIR__ . '/static/footer.php';
?>