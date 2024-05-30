<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Trocar Senha - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-unlock-keyhole"></i> Alterar senha</li>
                </ol>
            </nav>
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
        <form action="../scripts/changepass.php" method="POST" class="formpassword" align="center">
            <strong><i class="fa-solid fa-repeat"></i> Troque sua senha!</i></strong>
            <h5>Para trocar a senha é simples, entretanto a nova senha deverá seguir o padrão a seguir:</h5>
            <div class="alert alert-secondary" role="alert" align="left">
                <ul>
                    <li><i class="fa-solid fa-circle-up"></i> Deve possuir no mínimo 8 caracteres.</li>
                    <li><i class="fa-solid fa-circle-down"></i> Deve possuir no máximo 32 caracteres.</li>
                    <li><i class="fa-solid fa-arrow-down-1-9"></i> Deve conter pelo menos um número.</li>
                    <li><i class="fa-solid fa-hashtag"></i> Deve conter pelo menos um caractere especial !@#$%¨&*().</li>
                </ul>
            </div>
            <label for="newpass"> Nova senha</label>
            <input class="form-control form-control-lg" type="password" id="newpass" name="newpass" placeholder="Digite sua nova senha" minlength="8" maxlength="32" required/>
            <label for="newpassconfirm"> Confirme a nova senha</label>
            <input class="form-control form-control-lg" type="password" id="newpassconfirm" name="newpassconfirm" placeholder="Confirme sua nova senha" minlength="8" maxlength="32" required/>
            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-arrow-up-from-bracket"></i> Trocar senha</button>
        </form>
<?php
include __DIR__ . '/static/footer.php';
?>