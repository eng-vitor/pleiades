<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'/../scripts/status.php';
include __DIR__.'/../scripts/verifyauth.php';

/* Format Tools*/
for($a=0; $a<$_SESSION['UserTools']['CountTools']; $a++){

    switch ($_SESSION['UserTools'][$a][2]) {
        case 1:
            $UserAnyDeskID = $_SESSION['UserTools'][$a][0];
            $UserAnyDeskPass = $_SESSION['UserTools'][$a][1];
            break;
        case 2:
            $UserTeamViewerID = $_SESSION['UserTools'][$a][0];
            $UserTeamViewerPass = $_SESSION['UserTools'][$a][1];
            break;
        case 3:
            $UserRealVncID = $_SESSION['UserTools'][$a][0];
            $UserRealVncPass = $_SESSION['UserTools'][$a][1];
            break;
        case 4:
            $UserPcName = $_SESSION['UserTools'][$a][0];
            $UserIP = $_SESSION['UserTools'][$a][1];
            break;
    }
}
/* Format Tools*/

$TITLEPAGE = 'Corporate page of '.$_SESSION['DataAccount']['social'].' - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>        
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-users"></i> Corporate</li>
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
        <section class="cardstool">
            <h1><i class="fa-solid fa-screwdriver-wrench"></i> My tools</h1>
                        <?php
                        if(isset($UserAnyDeskID)){
                            echo'<div class="card">
                                    <div class="card-body">
                                        <img src="../assets/anydesk_user.png" alt="anydesklogo"/>
                                        <h5 class="card-title">Client Anydesk</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.$_SESSION['DataAccount']['social'].'</h6>
                                        <form action="../scripts/mytoolsquerys/uploadanydesk.php" method="POST" class="form-cards">
                                            <label for="useranydeskid" class="form-label">ID</label>
                                            <input type="text" class="form-control" id="useranydeskid" name="useranydeskid" minlength="9" maxlength="12" value='.$UserAnyDeskID.' required/>
                                            <label for="useranydeskpass" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="useranydeskpass" name="useranydeskpass" minlength="8" maxlength="32" value='.$UserAnyDeskPass.' required/>
                                            <button type="submit" class="card-link btn btn-primary">Update</button>
                                            <a href="../scripts/mytoolsquerys/cleananydesk.php" class="card-link btn btn-outline-danger">Clean</a>
                                        </form>
                                    </div>
                                </div>';
                        }
                        else{
                            echo'<button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalanydesk"><img src="../assets/anydesk_user.png" alt="anydesklogo"/><h5 class="card-title">Anydesk</h5></button>
                                <div class="modal fade" id="modalanydesk" tabindex="-1" aria-labelledby="modalanydesk" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" align="left">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5">Registar AnyDesk</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../scripts/mytoolsquerys/uploadanydesk.php" method="POST" class="form-cards">
                                                    <label for="useranydeskid" class="form-label">ID</label>
                                                    <input type="text" class="form-control" id="useranydeskid" name="useranydeskid" placeholder="ID Anydesk" minlength="9" maxlength="12" required/>
                                                    <label for="useranydeskpass" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="useranydeskpass" name="useranydeskpass" placeholder="Password" minlength="8" maxlength="32" required/>
                                                    <div class="d-grid gap-2 col-6 mx-auto">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                        <?php
                        if(isset($UserTeamViewerID)){
                            echo'<div class="card">
                                    <div class="card-body">
                                        <img src="../assets/teamw_user.png" alt="teamviewerlogo"/>
                                        <h5 class="card-title">Client Team Viewer</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.$_SESSION['DataAccount']['social'].'</h6>
                                        <form action="../scripts/mytoolsquerys/uploadteamw.php" method="POST" class="form-cards">
                                            <label for="userteamwid" class="form-label">ID</label>
                                            <input type="text" class="form-control" id="userteamwid" name="userteamwid" minlength="9" maxlength="12" value='.$UserTeamViewerID.' required/>
                                            <label for="userteamwpass" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="userteamwpass" name="userteamwpass" minlength="8" maxlength="32" value='.$UserTeamViewerPass.' required/>
                                            <button type="submit" class="card-link btn btn-primary">Update</button>
                                            <a href="../scripts/mytoolsquerys/cleanteamw.php" class="card-link btn btn-outline-danger">Clean</a>
                                        </form>
                                     </div>
                                </div>';
                        }
                        else{
                            echo'<button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalteamviewer"><img src="../assets/teamw_user.png" alt="teamviewerlogo"/><h5 class="card-title">Team Viewer</h5></button>
                                <div class="modal fade" id="modalteamviewer" tabindex="-1" aria-labelledby="modalteamviewer" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" align="left">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5">Registar Team Viewer</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../scripts/mytoolsquerys/uploadteamw.php" method="POST" class="form-cards">
                                                    <label for="userteamwid" class="form-label">ID</label>
                                                    <input type="text" class="form-control" id="userteamwid" name="userteamwid" placeholder="ID Team Viewer">
                                                    <label for="userteamwpass" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="userteamwpass" name="userteamwpass" placeholder="Password">
                                                    <div class="d-grid gap-2 col-6 mx-auto">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                        <?php
                        if(isset($UserRealVncID)){
                            echo'<div class="card">
                                    <div class="card-body">
                                        <img src="../assets/realvnc_user.png" alt="realvnclogo"/>
                                        <h5 class="card-title">Client RealVNC</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.$_SESSION['DataAccount']['social'].'</h6>
                                        <form action="../scripts/mytoolsquerys/uploadrealvnc.php" method="POST" class="form-cards">
                                            <label for="userrealvncid" class="form-label">ID</label>
                                            <input type="text" class="form-control" id="userrealvncid" name="userrealvncid" minlength="9" maxlength="12" value='.$UserRealVncID.' required/>
                                            <label for="userrealvncpass" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="userrealvncpass" name="userrealvncpass" minlength="8" maxlength="32" value='.$UserRealVncPass.' required/>
                                            <button type="submit" class="card-link btn btn-primary">Update</button>
                                            <a href="../scripts/mytoolsquerys/cleanrealvnc.php" class="card-link btn btn-outline-danger">Clean</a>
                                        </form>
                                    </div>
                                </div>';
                        }
                        else{
                            echo'<button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalrealvnc"><img src="../assets/realvnc_user.png" alt="realvnclogo"/><h5 class="card-title">RealVNC</h5></button>
                                <div class="modal fade" id="modalrealvnc" tabindex="-1" aria-labelledby="modalrealvnc" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" align="left">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5">Registar RealVNC</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../scripts/mytoolsquerys/uploadrealvnc.php" method="POST" class="form-cards">
                                                <label for="userrealvncid" class="form-label">ID</label>
                                                <input type="text" class="form-control" id="userrealvncid" name="userrealvncid" placeholder="ID RealVNC">
                                                <label for="userrealvncpass" class="form-label">Password</label>
                                                <input type="text" class="form-control" id="userrealvncpass" name="userrealvncpass" placeholder="Password">
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                        <?php
                        if(isset($UserPcName)){
                            echo'<div class="card">
                                    <div class="card-body" align="center">
                                        <img src="../assets/network_user.png" alt="networklogo"/>
                                        <h5 class="card-title">Configurações de rede</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.$_SESSION['DataAccount']['social'].'</h6>
                                        <form action="../scripts/mytoolsquerys/uploadnetcfg.php" method="POST" class="form-cards">
                                            <label for="userpcname" class="form-label">ID</label>
                                            <input type="text" class="form-control" id="userpcname" name="userpcname" minlength="9" maxlength="12" value='.$UserPcName.' required/>
                                            <label for="userpcip" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="userpcip" name="userpcip" minlength="8" maxlength="32" value='.$UserIP.' required/>
                                            <button type="submit" class="card-link btn btn-primary">Update</button>
                                            <a href="../scripts/mytoolsquerys/cleannetcfg.php" class="card-link btn btn-outline-danger">Clean</a>
                                        </form>
                                    </div>
                                </div>';
                        }
                        else{
                            echo'<button type="button" class="css-button-3d--sky" data-bs-toggle="modal" data-bs-target="#modalnetworkuser"><img src="../assets/network_user.png" alt="networklogo"/><h5 class="card-title">Network config./h5></button>
                                <div class="modal fade" id="modalnetworkuser" tabindex="-1" aria-labelledby="modalnetworkuser" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" align="left">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5">Registrar configurações de rede</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../scripts/mytoolsquerys/uploadnetcfg.php" method="POST" class="form-cards">
                                                    <label for="userpcname" class="form-label">Computer name</label>
                                                    <input type="text" class="form-control" id="userpcname" name="userpcname" placeholder="Computer name">
                                                    <label for="userpcip" class="form-label">IP Address</label>
                                                    <input type="text" class="form-control" id="userpcip" name="userpcip" placeholder="Ipv4">
                                                    <div class="d-grid gap-2 col-6 mx-auto">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>  
        </section>
<?php
include __DIR__ . '/static/footer.php';
?>