<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Meus tickets - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-ticket"></i> Meus Tickets</li>
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
        <nav class="menufilters">
            <h1><i class="fa-solid fa-ticket"></i> Meus tickets</h1>
            <form action="../scripts/ticketsquerys/searchticketheader.php" method="POST" class="formsearchtip">
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="searchlabel">Pesquisar</span>
                    <input type="text" class="form-control" id="searchbar" name="searchbar" placeholder="Digite algo para pesquisar" aria-describedby="searchlabel" minlength="3" maxlength="99" required/>
                    <select class="form-select" id="searchtype" name="searchtype">
                        <option value="0" selected>Filtrar por protocolo</option>
                        <option value="1">Filtrar por hash</option>
                        <option value="2">Filtrar por designação</option>
                    </select>
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <h5>ou</h5>
            <form action="../scripts/ticketsquerys/searchticketfilter.php" method="POST" class="formsearchfilter">
                    <div class="row" align="center">
                        <div class="col-md-3">
                            <label for="periodsearch" class="form-label"><i class="fa-solid fa-calendar-week"></i> Periodo</label>
                            <select id="periodsearch" name="periodsearch" class="form-select">
                                <option value="0" selected>Ver tudo</option>
                                <option value="1">Hoje</option>
                                <option value="2">Ontem</option>
                                <option value="3">Últimos 7 dias</option>
                                <option value="4">Últimos 30 dias</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="statussearch" class="form-label"><i class="fa-solid fa-bars-progress"></i> Status</label>
                            <select id="statussearch" name="statussearch" class="form-select">
                                <option value="0" selected>Ver tudo</option>
                                <option value="1">Aberto</option>
                                <option value="2">Cancelado</option>
                                <option value="3">Rejeitado</option>
                                <option value="4">Concluído</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dateinitsearch" class="form-label"><i class="fa-solid fa-hourglass-start"></i> Aberto em</label>
                            <input type="date" id="dateinitsearch" name="dateinitsearch" class="form-select"/>
                        </div>
                        <div class="col-md-3">
                            <label for="dateendsearch" class="form-label"><i class="fa-solid fa-hourglass-end"></i> Concluído em</label>
                            <input type="date" id="dateendsearch" name="dateendsearch" class="form-select"/>
                        </div>
                    </div>
                    <div class="row">
                        <small>Caso escolha uma data no "Aberto em" ou no "Concluído até", o "Periodo" será desconsiderado!</small>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-filter"></i> Filtrar</button>
                    </div>
            </form>
        </nav>
        <section class="ticketstable">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-hand"></i></th>
                        <th scope="col"><i class="fa-solid fa-ticket-simple"></i> Protocolo</th>
                        <th scope="col"><i class="fa-solid fa-envelope"></i> Titulo</th>
                        <th scope="col"><i class="fa-regular fa-paper-plane"></i> Designação</th>
                        <th scope="col"><i class="fa-solid fa-bars-progress"></i> Status</th>
                        <th scope="col"><i class="fa-solid fa-hourglass-start"></i> Aberto em</th>
                        <th scope="col"><i class="fa-solid fa-hourglass-end"></i> Concluído em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       for($j=0; $j<$_SESSION['DataMyTickets']['count']; $j++){
                            $DataTicketFormatadaAberto = new DateTime($_SESSION['DataMyTickets'][$j][4]);
                            $DataTicketFormatadaFechado = new DateTime($_SESSION['DataMyTickets'][$j][5]);
                            if($DataTicketFormatadaFechado->format('Y-m-d')=="-0001-11-30"){
                                $DataTicketFormatadaFechadoView = ' - ';
                            }else{
                                $DataTicketFormatadaFechadoView = $DataTicketFormatadaFechado->format('d/m/Y').' ás '.$DataTicketFormatadaFechado->format('H:i:s');
                            }
                            echo '<tr>
                                    <th scope="row"><a class="btn btn-success" href="'.'../scripts/selectticket.php?protocolticket='.$_SESSION['DataMyTickets'][$j][0].'" role="button"><i class="fa-solid fa-arrow-pointer"></i></a></th>
                                    <td>'.$_SESSION['DataMyTickets'][$j][0].'</td>
                                    <td>'.$_SESSION['DataMyTickets'][$j][2].'</td>
                                    <td>'.$_SESSION['DataMyTickets'][$j][1].'</td>
                                    <td>'.$_SESSION['DataMyTickets'][$j][3].'</td>
                                    <td>'.$DataTicketFormatadaAberto->format('d/m/Y').' ás '.$DataTicketFormatadaAberto->format('H:i:s').'</td>
                                    <td>'.$DataTicketFormatadaFechadoView.'</td>
                                </tr>';                  
                        }
                    ?>
                </tbody>
            </table>
            <?php
                if($_SESSION['DataMyTickets']['count']==0){
                    echo '<h2><i class="fa-regular fa-circle-xmark"></i> Não foi possível obter resultados na sua pesquisa</h2>';
                }
            ?>
        </section>
<?php
include __DIR__ . '/static/footer.php';
?>