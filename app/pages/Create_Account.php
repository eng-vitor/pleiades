<?php 
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';

if(isset($_SESSION['DataAccount']['id'])){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Você está logado!</div>';
    header("Location: ../pages/System.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Criar conta - <?= $SERVER_NAME; ?></title>
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
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-user-plus"></i> Convite de conta</li>
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
            <form action="../scripts/accountquerys/validateinvite.php" method="POST" class="formcreateacc">
                <h4><i class="fa-solid fa-user-plus"></i> Convite de conta</h4>
                <h6>Insira abaixo o convite criptografado recebido, para iniciarmos a criação da conta!</h6>
                <div class="mb-3">
                    <label for="keyinvite" class="form-label"><i class="fa-solid fa-code"></i> Chave do convite</label>
                    <input class="form-control form-control-lg" type="text" id="keyinvite" name="keyinvite" placeholder="098f6bcd4621d373cade4e832627b4f6" aria-label="keyinvite" minlength="20" maxlength="99" required/>
                </div>
                <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-circle-chevron-up"></i> Validar chave do convite!</button>
            </form>
        </div>    
<?php
include __DIR__ . '/static/footer.php';
?>