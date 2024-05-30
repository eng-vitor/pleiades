<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

if($_SESSION['DataAccount']['emailverificado']==1){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> O seu e-mail já foi verificado!</div>';
    header("Location: MyProfile.php");
	exit();
}

$TITLEPAGE = 'Verificar e-mail - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-envelope-circle-check"></i> Validar email</li>
                </ol>
            </nav>
        </div>
        <form action="../scripts/validateemail.php" method="POST" class="checkemail" align="center">
            <?php
                if(isset($_SESSION['Msg'])){
                    echo $_SESSION['Msg'];
                    unset($_SESSION['Msg']);
                }
                else{
                    unset($_SESSION['Msg']);
                }
            ?>
            <strong><i class="fa-solid fa-envelope-circle-check"></i> Validando seu e-mail!</i></strong>
            <h5>Para validar seu e-mail é bem simples, iremos testa-lo e validá-lo junto ao provedor de seu e-mail.</h5>
            <div class="formvalidateemail" align="left">
                <label for="checkemailinput">Email</label>
                <input class="form-control form-control-lg" type="email" id="checkemailinput" name="checkemailinput" placeholder="Digite seu e-mail" required/>
            </div>
            <small>Não se preocupe, seu e-mail e sua senha estão protegidas e criptografadas, além disso, estas informações não serão dados salvas em nosso servidor!</small>
            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-envelope-circle-check"></i> Validar E-mail</button>
        </form>
<?php
include __DIR__ . '/static/footer.php';
?>