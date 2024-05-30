<?php 
session_start();
require __DIR__.'./config.php';
include __DIR__.'./scripts/status.php';
if(isset($_SESSION['DataAccount']['id'])){
    header("Location: ../pages/System.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?= $SERVER_NAME; ?> - Login</title>
        <meta name="description" content="Pagina principal do Pleiades">
        <meta name="author" content="Vitor G. Dantas">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/assets/base/favicon.png"/>
        <link rel="stylesheet" href="/styles/style.css"/>
        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="/vendor/fortawesome/font-awesome/css/all.css"/>
    </head>
    <body>
        <div class="bannerindex puff-in-center">
            <nav class="mainmenu" align="center">
                <img src="/assets/base/index_logo.png" alt="indexlogo"/>
                <p><?= $SERVER_NAME.' <cite>'.$SYSTEM_VERSION; ?></cite> <span class="badge rounded-pill text-bg-warning">Beta</span></p>
            </nav>
            <div class="msg" align="center">
                <?php
                    if(isset($_SESSION['Msg'])){
                        echo $_SESSION['Msg'];
                        unset($_SESSION['Msg']);
                    }
                    else{
                        unset($_SESSION['Msg']);
                    }
                ?>
            </div>
            <section class="formlogin" align="center">
                <form action="scripts/login.php" method="POST">
                    <div class="formmodel" align="left">
                        <label for="loginuser"><i class="fa-solid fa-at"></i> E-mail</label> 
                        <input class="form-control" name="loginuser" id="loginuser" type="email" placeholder="E-mail" maxlength="100" required/>
                        <label for="loginpass"><i class="fa-solid fa-key"></i> Password</label> 
                        <input class="form-control" name="loginpass" id="loginpass" type="password" placeholder="********" minlength="8" maxlength="32" required/>
                    </div>
                    <button type="submit" class="css-button-rounded--sky"><i class="fa-solid fa-right-to-bracket"></i> Sign in</button>
                </form>
            </section>
            <div class="systemsupport" align="center">
                <h6>If you don't have access to your login, contact your server administrator!</h6>
                <h6>In case you have an encrypted invitation, you can create your account <a href="pages/Create_Account.php">here!</a></h6>
            </div>
        </div>
        <footer align="center">
            <a href="https://github.com/r0t1v/pleiades" target="blank"><i class="fa-brands fa-github"></i></a>
            <a href="https://github.com/r0t1v/pleiades/wiki" target="blank"><i class="fa-solid fa-book-open"></i></a>  
        </footer>
        <script type="text/javascript" src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="/vendor/fortawesome/font-awesome/js/all.js"></script>
    </body>
</html>