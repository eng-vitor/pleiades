<?php
require __DIR__.'/../config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>!Ops - <?= $SERVER_NAME; ?></title>
        <meta name="author" content="Vitor G. Dantas">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="../assets/base/favicon.png"/>
        <link rel="stylesheet" href="../styles/style.css"/>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css"/>
    </head>
    <body>
        <nav class="navmenu">
            <div class="menusystemadmin">
                <a href="SystemAdmin.php"><img src="../../assets/base/system_logo.png" width="45px" height="45px" alt="logosystem"/></a>
                <strong><?= $SERVER_NAME; ?></strong>
                <small><?= '<i class="fa-solid fa-code-branch"></i> '.$SYSTEM_VERSION; ?></small>
            </div>
        </nav>
        <div class="errorall puff-in-center" align="center">
            <img src="../assets/base/error_logo.png" alt="errorlogo"/>
            <h1><?=$SERVER_NAME; ?></h1>
            <h1><i class="fa-solid fa-circle-exclamation fa-bounce" style="color: #e84118"></i> Não foi possível alcançar a página!</h1>
            <p>Desculpe! Ocorreu um erro.</p>
            <?php
                if(isset($errordb)){
                    echo '<p><code><i class="fa-solid fa-database"></i> Erro no Banco de dados: '.$errordb.'</code></p>';
                }else{
                    header("Location: ../index.php");
                    exit(); 
                }
            ?>
            <a href="../index.php"><i class="fa-solid fa-circle-arrow-left"></i> Voltar</a>
        </div>
        <script>
                setTimeout(function(){ location.reload(); }, 6000);
        </script>
<?php
include __DIR__.'/static/footer.php';
?>