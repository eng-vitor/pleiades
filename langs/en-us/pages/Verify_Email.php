<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

if($_SESSION['DataAccount']['emailverificado']==1){
    $_SESSION['Msg'] = '<div class="alert alert-warning" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> Your email has already been verified!</div>';
    header("Location: MyProfile.php");
	exit();
}

$TITLEPAGE = 'Check e-mail - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-envelope-circle-check"></i> Validate e-mail</li>
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
            <strong><i class="fa-solid fa-envelope-circle-check"></i> Validating your e-mail!</i></strong>
            <h5>To validate your e-mail is very simple, we will test and validate it with your e-mail provider.</h5>
            <div class="formvalidateemail" align="left">
                <label for="checkemailinput">E-mail</label>
                <input class="form-control form-control-lg" type="email" id="checkemailinput" name="checkemailinput" placeholder="Type your e-mail" required/>
            </div>
            <small>Don't worry, your email and password are protected and encrypted, and this information will not be saved on our server.!</small>
            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-envelope-circle-check"></i> Validate Email</button>
        </form>
<?php
include __DIR__ . '/static/footer.php';
?>