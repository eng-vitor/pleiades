<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Open a ticket - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-circle-plus"></i> Open a ticket</li>
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
        <section class="createticketheader">
            <h1><i class="fa-solid fa-ticket-simple"></i> Ticket opening</h1>
            <form class="formticket" action="../scripts/createnewticket.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="newtickettitlelabel"><i class="fa-solid fa-envelope"></i> Ticket subject</span>
                                <input type="text" id="newtickettitle" name="newtickettitle" class="form-control" placeholder="Enter the subject of the ticket" aria-describedby="newtickettitlelabel" minlength="5" maxlength="80" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="newticketmsg" class="form-label"><i class="fa-solid fa-comments"></i> Ticket message</label>
                                <textarea class="form-control" id="newticketmsg" name="newticketmsg" rows="9" minlength="5" maxlength="1000" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="newticketdesign" class="form-label"><i class="fa-regular fa-paper-plane"></i> Tag</label>
                                <select class="form-select" id="newticketdesign" name="newticketdesign" aria-label="Seleção de setor" required>
                                    <?php 
                                        for($b=0; $b<count($TICKET_TEAM); $b++){
                                            echo '<option value="'.$TICKET_TEAM[$b].'">'.$TICKET_TEAM[$b].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="newticketsla" class="form-label"><i class="fa-solid fa-stopwatch"></i> SLA</label>
                                <select class="form-select" id="newticketsla" name="newticketsla" aria-label="Seleção de SLA" required>
                                    <?php 
                                        for($c=0; $c<count($TICKET_SLA); $c++){
                                            echo '<option value="'.$TICKET_SLA [$c].'">'.$TICKET_SLA[$c].'hour</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-circle-plus"></i> Open ticket</button>
                    </div>
                </div>
            </form>
        </section>
<?php
include __DIR__ . '/static/footer.php';
?>