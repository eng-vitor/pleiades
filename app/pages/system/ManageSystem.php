<?php
session_start();
require __DIR__.'../../../config.php';
include __DIR__.'../../../scripts/status.php';
include __DIR__.'../../../scripts\verifyauth.php';
include __DIR__.'../../../scripts\verifypermission.php';

$KEY_GEN_USER = md5(date('ymd').'.'.date('His').$_SESSION['DataAccount']['id']);
$KEY_GEN_ADMIN = md5(date('ymd').'.'.date('His').$_SESSION['DataAccount']['id'].mt_rand(100, 999));

$TITLEPAGE = '[ADMIN] Gerenciando o sistema - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
    <div class="mininav">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="SystemAdmin.php"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-gears"></i> Sistema</li>
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
    <div class="buttonsmanagesystem">
        <button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalkeygenaccount"><i class="fa-solid fa-user-plus"></i> Gerar convite de usuário</button>
        <button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalkeygenadmin"><i class="fa-solid fa-user-secret"></i> Gerar convite pleiade</button>
        <button type="button" class="css-button-3d--sky"><i class="fa-regular fa-square-plus"></i> Em breve</button>
    </div>
        <div class="modal fade" id="modalkeygenaccount" tabindex="-1" aria-labelledby="modalkeygenaccount" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" align="left">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5">Gerador de convite(Usuário)</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../scripts/adminquerys/createinvite.php" method="POST" class="form-cards">
                            <label for="keygenerator" class="form-label">Chave de convite</label>
                                <input type="text" class="form-control" id="keygenerator" name="keygenerator" placeholder="Chave de convite" readonly value="<?=$KEY_GEN_USER?>">
                                <label for="emailinvite" class="form-label">Email do convidado</label>
                                <input type="email" class="form-control" id="emailinvite" name="emailinvite" placeholder="Email do convidado" required>
                                <label for="taginvite" class="form-label">Tag da conta</label>
                                <select class="form-select" id="taginvite" name="taginvite" aria-label="select tag usuário">
                                    <?php
                                    foreach($TICKET_TEAM as $item){
                                        echo '<option value="'.$item.'">'.$item.'</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-gift"></i> Gerar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalkeygenadmin" tabindex="-1" aria-labelledby="modalkeygenadmin" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" align="left">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5">Gerador de convite(Admin)</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../scripts/adminquerys/createinviteadmin.php" method="POST" class="form-cards">
                            <label for="keygeneratoradmin" class="form-label">Chave de convite</label>
                                <input type="text" class="form-control" id="keygeneratoradmin" name="keygeneratoradmin" placeholder="Chave de convite" readonly value="<?=$KEY_GEN_ADMIN?>">
                                <label for="emailinviteadmin" class="form-label">Email do convidado</label>
                                <input type="email" class="form-control" id="emailinviteadmin" name="emailinviteadmin" placeholder="Email do convidado" required>
                                <br>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-gift"></i> Gerar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
include __DIR__ . '/static/footer.php';
?>