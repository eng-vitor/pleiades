<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Perfil do '.$_SESSION['DataAccount']['social'].' - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-user"></i> Meu perfil</li>
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
        <section class="profileinfo">
            <h1><i class="fa-solid fa-user-pen"></i> Informações do Perfil</h1>
            <form action="../scripts/updateprofile.php" method="POST" class="formprofile">
                <label for="profileusername" class="form-label">Nome</label>
                <input class="form-control form-control-lg" type="text" id="profileusername" name="profileusername" placeholder="Nome" minlength="3" maxlength="99" value="<?= $_SESSION['DataAccount']['nome']; ?>" required/>
                <label for="profileusersocial" class="form-label">Nome de usuário</label>
                <input class="form-control form-control-lg" type="text" id="profileusersocial" name="profileusersocial" placeholder="Nome de usuário" minlength="4" maxlength="49" value="<?= $_SESSION['DataAccount']['social']; ?>" required/>
                <label for="form-control" class="form-label">Tag</label>
                <input class="form-control form-control-lg" type="text" placeholder="Tag" id="form-control" name="form-control" value="<?= $_SESSION['DataAccount']['tag']; ?>" disabled/>
                <label for="profileuseremail" class="form-label">E-mail</label>
                <input class="form-control form-control-lg" type="text" id="profileuseremail" name="profileuseremail" placeholder="meuemail@email.com" minlength="5" maxlength="99" value="<?= $_SESSION['DataAccount']['email']; ?>" required/>
                <label for="profileuserurl" class="form-label">Url do seu perfil profissional</label>
                <input class="form-control form-control-lg" type="text" id="profileuserurl" name="profileuserurl" placeholder="www.linkedin.com/in/seu-usuario" minlength="5" maxlength="99" value="<?= $_SESSION['DataAccount']['urlprofile']; ?>" required/>              
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
            </form>
        </section>
        <aside class="emailcheck" align="center">
            <?php
            if($_SESSION['DataAccount']['emailverificado']==0){
                echo'<a href="../pages/Verify_Email.php" style="color: #e67e22; text-decoration: none;"><i class="fa-solid fa-circle-xmark fa-beat"></i> Verificar e-mail</a>';
            }
            else{
                echo'<p style="color: #2ecc71;"><i class="fa-solid fa-check-double"></i> Seu e-mail já foi verificado!</p>';
            }
            ?>
        </aside>
<?php
include __DIR__ . '/static/footer.php';
?>