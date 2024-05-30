<?php
session_start();
require __DIR__.'../../../config.php';
include __DIR__.'../../../scripts/status.php';
include __DIR__.'../../../scripts/verifyauth.php';
include __DIR__.'../../../scripts/verifypermission.php';

$TITLEPAGE = '[ADMIN] Ticket - '.$_SESSION['DataTicketAllSelected']['protocolo'].' '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><?=isset($_SERVER['HTTP_REFERER']) ? '<a href="'.$_SERVER['HTTP_REFERER'].'">' : '<a href="SystemAdmin.php">'; ?><i class="fa-solid fa-circle-chevron-left"></i> Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-user"></i> Ticket <?= $_SESSION['DataTicketAllSelected']['protocolo']; ?></li>
                    <?= ($_SESSION['DataTicketAllSelected']['ticketstatus']=="Pendente") ? '<li class="breadcrumb-item"><a href="../../scripts/adminquerys/refreshticketadmin.php?protocolticket='.$_SESSION['DataTicketAllSelected']['protocolo'].'" id="refreshticketdata"><i class="fa-solid fa-arrows-rotate"></i> Atualizar dados</a></li>' : '<li class="breadcrumb-item active" id="refreshticketdata"><i class="fa-solid fa-arrows-rotate"></i> Atualizar dados</li>'; ?>
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
        <section class="ticketcontent">
            <h3><i class="fa-solid fa-ticket-simple"></i><?= ' '.$_SESSION['DataTicketAllSelected']['nometicket']; ?></h3>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-barcode" style="padding-right: 5px"></i> Ticket Nº</span>
                            <input type="text" class="form-control" name="ticketnumberadmin" value="<?= $_SESSION['DataTicketAllSelected']['protocolo']; ?>" aria-describedby="ticketlabel" disabled readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-hashtag" style="padding-right: 5px"></i> Ticket hash</span>
                            <input type="text" class="form-control" name="tickethashadmin" value="<?= $_SESSION['DataTicketAllSelected']['tickethash']; ?>" aria-describedby="tickethashlabel" disabled readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-regular fa-paper-plane" style="padding-right: 5px"></i> Setor de interesse</span>
                            <input type="text" class="form-control" name="tickettagadmin" value="<?= $_SESSION['DataTicketAllSelected']['designacao']; ?>" aria-describedby="ticketdesign" disabled readonly/>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-stopwatch" style="padding-right: 5px"></i> SLA</span>
                            <input type="text" class="form-control" name="ticketslaadmin" value="<?= $_SESSION['DataTicketAllSelected']['sla'].'hrs'; ?>" aria-describedby="ticketsla" disabled readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-day" style="padding-right: 5px"></i> Data de criação</span>
                            <input type="text" class="form-control" name="ticketdatecreateadmin" value="<?php $DataTicketFormatada = new DateTime($_SESSION['DataTicketAllSelected']['datapedido']); echo $DataTicketFormatada->format('d/m/Y').' ás '.$DataTicketFormatada->format('H:i:s'); ?>" aria-describedby="ticketdateinit" disabled readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-bars-progress" style="padding-right: 5px"></i> Situação do Ticket</span>
                            <input type="text" class="form-control" name="ticketstatusadmin" value="<?= $_SESSION['DataTicketAllSelected']['ticketstatus']; ?>" aria-describedby="ticketstatus" disabled readonly/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-week" style="padding-right: 5px"></i> Data combinada</span>
                            <input type="text" class="form-control" name="ticketdatefinishadmin" value="<?php $DataTicketFormatadaSla = new DateTime($_SESSION['DataTicketAllSelected']['datasla']); echo $DataTicketFormatadaSla->format('d/m/Y').' ás '.$DataTicketFormatadaSla->format('H:i:s'); ?>" aria-describedby="ticketdatasla" disabled readonly/>
                        </div>
                    </div>
                </div>
                <div class="row" align="center">
                    <?php 
                        for($z=0; $z<$_SESSION['AdminUserTools']['CountTools']; $z++){

                            switch ($_SESSION['AdminUserTools'][$z][2]){
                                case 1:
                                    if(isset($_SESSION['AdminUserTools'][$z][0])){
                                    echo '<div class="col-sm-3"><img src="../../assets/anydesk_user.png" alt="anydesklogo"/>
                                            <p>ID: '.$_SESSION['AdminUserTools'][$z][0].'<br>Pass: '.$_SESSION['AdminUserTools'][$z][1].'</p>
                                        </div>';
                                    }
                                    break;
                                case 2:
                                    if(isset($_SESSION['AdminUserTools'][$z][0])){
                                        echo '<div class="col-sm-3"><img src="../../assets/teamw_user.png" alt="teamviewerlogo"/>
                                            <p>ID: '.$_SESSION['AdminUserTools'][$z][0].'<br>Pass: '.$_SESSION['AdminUserTools'][$z][1].'</p>
                                        </div>';
                                    }
                                    break;
                                case 3:
                                    if(isset($_SESSION['AdminUserTools'][$z][0])){
                                        echo '<div class="col-sm-3"><img src="../../assets/realvnc_user.png" alt="realvnclogo"/>
                                            <p>ID: '.$_SESSION['AdminUserTools'][$z][0].'<br>Pass: '.$_SESSION['AdminUserTools'][$z][1].'</p>
                                        </div>';
                                    }
                                    break;
                                case 4:
                                    if(isset($_SESSION['AdminUserTools'][$z][0])){
                                        echo '<div class="col-sm-3"><img src="../../assets/network_user.png" alt="networklogo"/>
                                            <p>ID: '.$_SESSION['AdminUserTools'][$z][0].'<br>Pass: '.$_SESSION['AdminUserTools'][$z][1].'</p>
                                        </div>';
                                    }
                                    break;
                            }
                        }
                    ?>
                </div>
            </div>
            <label class="form-label"><i class="fa-solid fa-comments"></i> Bate-papo</label>
            <div class="chatticket">
                <?php
                        for($a=0; $a<$_SESSION['DataTicketAllChatSelected']['CountMsgs']; $a++){
                            if($_SESSION['DataTicketAllChatSelected'][$a][2]==$_SESSION['DataAccount']['id']){
                                $DataTicketFormatadaSla = new DateTime($_SESSION['DataTicketAllChatSelected'][$a][5]);
                                echo '<div class="chat-message-left">
                                        <div class="avatarchatuser">
                                            <img src="../../assets/base/avatar_default.png" class="rounded-circle mr-1" alt="Avatar_default" width="40" height="40">
                                        </div>
                                        <div class="message">
                                            <div class="titlemessage">
                                                <span>'.$_SESSION['DataTicketAllChatSelected'][$a][3].'</span><small>'.$_SESSION['DataTicketAllChatSelected'][$a][4].'</small>
                                            </div>
                                            '.$_SESSION['DataTicketAllChatSelected'][$a][0].'<br>
                                            <small><i class="fa-regular fa-calendar"></i> '.$DataTicketFormatadaSla->format('d/m/Y').' ás <i class="fa-regular fa-clock"></i> '.$DataTicketFormatadaSla->format('H:i:s').'</small>
                                        </div>
                                    </div>';
                            }else{
                                $DataTicketFormatadaSla = new DateTime($_SESSION['DataTicketAllChatSelected'][$a][5]);
                                echo '<div class="chat-message-right">
                                        <div class="avatarchatuser">
                                            <img src="../../assets/base/avatar_default.png" class="rounded-circle mr-1" alt="Avatar_default" width="40" height="40">
                                        </div>
                                        <div class="message">
                                            <div class="titlemessage">
                                                <span>'.$_SESSION['DataTicketAllChatSelected'][$a][3].'</span><small>'.$_SESSION['DataTicketAllChatSelected'][$a][4].'</small>
                                            </div>
                                            '.$_SESSION['DataTicketAllChatSelected'][$a][0].'<br>
                                            <small><i class="fa-regular fa-calendar"></i> '.$DataTicketFormatadaSla->format('d/m/Y').' ás <i class="fa-regular fa-clock"></i> '.$DataTicketFormatadaSla->format('H:i:s').'</small>
                                        </div>
                                    </div>';
                            }
                        }
                ?>
            </div>
            <?php
                if($_SESSION['DataTicketAllSelected']['ticketstatus']!="Pendente"){
                    $DataTicketFinalizadoFormatada = new DateTime($_SESSION['DataTicketAllSelected']['datafinalizado']);
                    echo ' <div class="alert alert-secondary" role="alert" style="width: 70%">
                        Este ticket já foi fechado com o status <strong>'.$_SESSION['DataTicketAllSelected']['ticketstatus'].'</strong> no dia <strong>'.$DataTicketFinalizadoFormatada->format('d/m/Y').' ás '.$DataTicketFinalizadoFormatada->format('H:i:s').'</strong>
                        </div>';
                }else{
                    echo '<form action="../../scripts/adminquerys/sendmessageadmin.php" class="sendmsgticket" method="POST" align="center">
                            <div class="input-group mb-3">
                                <input type="text" id="sendmsg" name="sendmsg" class="form-control" placeholder="Digite sua mensagem aqui" aria-describedby="submitmsg" maxlength="999" required/>
                                <button class="btn btn-primary" type="submit" id="submitmsg"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>';
                }
            ?>
            <div class="buttonticketfooter" align="center">
                <?php
                    if($_SESSION['DataTicketAllSelected']['ticketstatus']!="Pendente"){
                        echo '<a class="btn btn-outline-success disabled" href="#" role="button"><i class="fa-solid fa-circle-check"></i> Fechar como resolvido</a>
                                <a class="btn btn-outline-danger disabled" href="#" role="button"><i class="fa-solid fa-square-xmark"></i> Cancelar Ticket</a>';
                    }else{
                        echo '<a class="btn btn-outline-success" href="../../scripts/adminquerys/resolveticketok.php?protocolticket='.$_SESSION['DataTicketAllSelected']['protocolo'].'" role="button"><i class="fa-solid fa-circle-check"></i> Fechar como resolvido</a>
                                <a class="btn btn-outline-danger" href="../../scripts/adminquerys/rejectticket.php?protocolticket='.$_SESSION['DataTicketAllSelected']['protocolo'].'" role="button"><i class="fa-solid fa-square-xmark"></i> Rejeitar Ticket</a>';
                    }
                ?>
            </div>
        </section>
        <script src="../../src/domscripts.js" type="text/javascript" ></script>
<?php
include __DIR__ . '/static/footer.php';
?>