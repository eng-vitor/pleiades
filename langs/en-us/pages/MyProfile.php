<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Profile of '.$_SESSION['DataAccount']['social'].' - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-user"></i> My profile</li>
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
            <h1><i class="fa-solid fa-user-pen"></i> Profile Information</h1>
            <form action="../scripts/updateprofile.php" method="POST" class="formprofile">
                <label for="profileusername" class="form-label">Name</label>
                <input class="form-control form-control-lg" type="text" id="profileusername" name="profileusername" placeholder="Name" minlength="3" maxlength="99" value="<?= $_SESSION['DataAccount']['nome']; ?>" required/>
                <label for="profileusersocial" class="form-label">Username</label>
                <input class="form-control form-control-lg" type="text" id="profileusersocial" name="profileusersocial" placeholder="Username" minlength="4" maxlength="49" value="<?= $_SESSION['DataAccount']['social']; ?>" required/>
                <label for="form-control" class="form-label">Tag</label>
                <input class="form-control form-control-lg" type="text" placeholder="Tag" id="form-control" name="form-control" value="<?= $_SESSION['DataAccount']['tag']; ?>" disabled/>
                <label for="profileuseremail" class="form-label">E-mail</label>
                <input class="form-control form-control-lg" type="text" id="profileuseremail" name="profileuseremail" placeholder="my_e-mail@e-mail.com" minlength="5" maxlength="99" value="<?= $_SESSION['DataAccount']['email']; ?>" required/>
                <label for="profileuserurl" class="form-label">Url of your professional profile</label>
                <input class="form-control form-control-lg" type="text" id="profileuserurl" name="profileuserurl" placeholder="www.linkedin.com/in/your-user" minlength="5" maxlength="99" value="<?= $_SESSION['DataAccount']['urlprofile']; ?>" required/>              
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
            </form>
        </section>
        <aside class="emailcheck" align="center">
            <?php
            if($_SESSION['DataAccount']['emailverificado']==0){
                echo'<a href="../pages/Verify_Email.php" style="color: #e67e22; text-decoration: none;"><i class="fa-solid fa-circle-xmark fa-beat"></i> Check email</a>';
            }
            else{
                echo'<p style="color: #2ecc71;"><i class="fa-solid fa-check-double"></i> Your email has already been verified!</p>';
            }
            ?>
        </aside>
<?php
include __DIR__ . '/static/footer.php';
?>